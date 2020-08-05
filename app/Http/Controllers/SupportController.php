<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Support;
use App\Department;
use App\Subdepartment;
use App\Exports\SupportSeparateExport;
use App\Exports\SupportOSExport;
use App\Exports\SupportsExport;
use App\Role;
use App\Jobs\GoogleCalendar;
use App\Jobs\GoogleDriveUpload;
use App\Justification;
use App\Environment;
use App\Mail\SupportUpdated;
use App\Mail\SupportCreated;
use App\Sector;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SupportController extends Controller
{
    protected $directory = 'supports_file';

    public function index()
    {
        return view('support.index')->with([
            'departments' => Department::supportAreas(),
            'users' => User::orderBy('name')->where('status', 1)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('support.create')->with([
            'environments' => Environment::all(),
            'user' => User::where('id', auth()->user()->id)->with(['support_area', 'subdepartment', 'roles'])->firstOrfail(),
            'supportAreas' => json_encode([
                'departments' => Department::supportAreas(),
                'subdepartments' => Subdepartment::supportAreas()
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'environment' => request('support_area') == 13 ? 'required|exists:locais,id' : 'nullable',
            'spot' => request('support_area') == 13 ? 'required|exists:spots,id' : 'nullable',
            'sector' => 'required|exists:sector,id',
            'service' => 'required|exists:services,id',
            'description' => 'required',
            'attach_file_name' => 'nullable|file',
            'support_area' => 'required',
            'desired_date' => 'nullable',
            'expected_date' => request('recorrencia') ? 'required' : 'nullable',
            'tipo_recorrencia' => request('recorrencia') ? 'required' : 'nullable',
        ]);

        $expected_date = request('expected_date') !== null && request('recorrencia') ? Carbon::createFromFormat('Y-m-d', request('expected_date')) : null;
        $support = Support::create([
            'support_area' => request('support_area'),
            'usuario_id' => auth()->user()->id,
            'environment_id' => request('support_area') == 13 ? request('environment') : null,
            'spot_id' => request('support_area') == 13 ? request('spot') : null,
            'sector' => request('sector'),
            'service_id' => request('service'),
            'description' => request('description'),
            'expected_date' => $expected_date,
            'desired_date' => request('desired_date') !== null && !request('recorrencia') ? Carbon::createFromFormat('Y-m-d', request('desired_date')) : null,
            'status' => 1,
            'attach_file_name' => request()->file('attach_file_name') !== null ? $this->attach_file_name() : null,
            'recurrent' => request('tipo_recorrencia')
        ]);

        $this->recordActivity($support, "[
            'status' => {$support->status},
            'description' => {$support->description},
            'execution_by' => {$support->execution_by},
            'expected_hours' => {$support->expected_hours},
            'done_by' => " . json_encode($support->done_by) .
        "]");

        try {
            Mail::to($support->area->email)->send(new SupportCreated($support));
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function show($support)
    {
        $user = User::where('id', auth()->user()->id)->with(['department', 'subdepartment', 'roles'])->firstOrfail();
        $support = Support::whereId($support)
            ->with([ 'user', 'environment', 'service', 'spot', 'sector', 'area', 'messages.user', 'justification' ])
            ->first();

        if (
            auth()->user()->id == $support->usuario_id ||
            (
                array_intersect(auth()->user()->roles->pluck('id')->all(), [2, 8]) &&
                array_intersect(auth()->user()->departments->pluck('id')->all(), (array) $support->area)
            )
        ) {
            return view('support.show')->with([
                'support' => $support,
                'user' => $user,
                'sector' => Sector::where('support_area', $support->area)->get(),
                'atendentes' => json_encode(User::atendentes())
            ]);
        } else {
            return abort(403);
        }
    }

    protected function attach_file_name()
    {
        $attach_file_name = time() . '.' . request()->file('attach_file_name')->getClientOriginalExtension();

        request()->file('attach_file_name')->move(public_path($this->directory), $attach_file_name);

        GoogleDriveUpload::dispatch($attach_file_name);

        return $attach_file_name;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        if (request()->has('execution_by')) {
            $support->update([
                'execution_by' => request('execution_by'),
            ]);
        }

        if (request()->has('sector') && request()->has('service')) {
            $support->update([
                'sector_id' => request('sector'),
                'service_id' => request('service')
            ]);
        }

        if (request()->has('description')) {
            request()->validate([
                'description' => 'required'
            ]);

            $support->update([
                'description' => request('description')
            ]);
        }

        if (request()->has('status')) {
            if (request('status') == 3) {
                request()->validate([
                    'justification' => 'required'
                ]);

                $support->update([
                    'status' => request('status'),
                ]);

                return Justification::create([
                    'support_id' => $support->id,
                    'usuario_id' => auth()->user()->id,
                    'description' => request('justification')
                ]);
            } elseif (request('status') == 2) {
                request()->validate([
                    'horas_previstas' => 'required|integer|min:1',
                    'expected_date' => 'required',
                    'atendentes' => 'array|min:1'
                ]);

                $support->update([
                    'status' => request('status'),
                    'horas_previstas' => request('horas_previstas'),
                    'expected_date' => Carbon::createFromFormat('Y-m-d', request('expected_date')),
                    'done_by' => request('atendentes')
                ]);
            } elseif (request('status') == 0) {
                request()->validate([
                    'horas_real' => 'required|integer|min:1',
                    'data_real' => 'required',
                    'atendentes' => 'array|min:1'
                ]);

                $support->update([
                    'status' => request('status'),
                    'data_real' => Carbon::createFromFormat('Y-m-d', request('data_real')),
                    'horas_real' => request('horas_real'),
                    'done_by' => request('atendentes')
                ]);
            }
        }

        $support = Support::whereId($support->id)->with(['sector', 'service'])->first();

        try {
            Mail::to($support->usuario->email)->send(new SupportUpdated($support));
        } catch (Exception $e) {
            Log::error($e);
        }

        $this->recordActivity($support, "[
            'status' => {$support->status},
            'description' => {$support->description},
            'execution_by' => {$support->execution_by},
            'sector' => {$support->sector->nome},
            'service' => {$support->service->nome},
            'expected_hours' => {$support->expected_hours},
            'done_by' => " . json_encode($support->done_by) .
        "]");

        return $support;
    }

    public function getAttach_file_name($attach_file_name)
    {
        try {
            $dir = '/';
            $recursive = false;
            $contents = collect(Storage::cloud()->listContents($dir, $recursive));
            $file = $contents
                ->where('type', '=', 'file')
                ->where('filename', '=', pathinfo($attach_file_name, PATHINFO_FILENAME))
                ->where('extension', '=', pathinfo($attach_file_name, PATHINFO_EXTENSION))
                ->first();
            $rawData = Storage::cloud()->get($file['path']);

            return response($rawData, 200)
                ->header('ContentType', $file['mimetype'])
                ->header('Content-Disposition', "attachment; filename=$attach_file_name");
        } catch (Exception $e) {
            // $file = public_path("{$this->directory}\\") . $attach_file_name; // Windows Server
            $file = public_path("{$this->directory}") . $attach_file_name; // Linux Server
            return Response::download($file);
        }
    }

    public function fetch($filter)
    {
        $filter = $this->formatarFiltro($filter);

        // Meus supports
        if ($filter->owner == 1) {
            return Support::regularUser(auth()->user(), $filter);
        }

        // Diretoria
        if (in_array(3, auth()->user()->roles->pluck('id')->all())) {
            return Support::diretorUser(auth()->user(), $filter);
        }

        // Gestor
        if (in_array(2, auth()->user()->roles->pluck('id')->all()) &&
            count(                    auth()->user()->departments->pluck('id')->all(), Department::supportAreas()->pluck('id')->all()  &&
            $filter->owner == 0
        ) {
            return Support::adminUser(auth()->user(), $filter);
        } elseif (in_array(2, auth()->user()->roles->pluck('id')->all())) {
            return Support::gestorUser(auth()->user(), $filter);
        }


        return count(
            array_intersect(
                Role::where('id', 2)
                    ->orWhere('id', 8)
                    ->get()
                    ->pluck('id')
                    ->all(),
                auth()->user()->roles->pluck('id')->all()
            )
        ) &&
        count(                auth()->user()->departments->pluck('id')->all(), Department::supportAreas()->pluck('id')->all() // array com os ids dos departments que tem suporte: TI e Engenharia.
        ? Support::adminUser(auth()->user(), $filter)
        : Support::regularUser(auth()->user(), $filter);
    }

    protected function recordActivity($support, $description)
    {
        Activity::create([
            'support_id' => $support->id,
            'usuario_id' => auth()->user()->id,
            'description' => $description,
        ]);
    }

    protected function formatarFiltro($filter)
    {
        $filter = json_decode($filter);

        if ($filter->data[0] != null && $filter->data[1] != null) {
            $filter->data[0] = explode('T', $filter->data[0]);
            $filter->data[1] = explode('T', $filter->data[1]);
            $filter->data[0] = Carbon::createFromFormat('Y-m-d', $filter->data[0][0]);
            $filter->data[1] = Carbon::createFromFormat('Y-m-d', $filter->data[1][0]);
        } else {
            $filter->data[0] = Carbon::now()->subMonths(12);
            $filter->data[1] = Carbon::now();
        }
->paginate = $filter->paginate == '' ? 10 : $filter->paginate $filter->status = $filter->status == '' ? [1, 2] : json_decode($filter->status); Department = $filter->Department == '' ? Department::supportAreas()->pluck('id')->all() : json_decode($filter->Department);
        return $filter;
    }

    public function export($filter)
    {
        $filter = $this->formatarFiltro($filter);

        if (auth()->user()->diretoria() || auth()->user()->gestor() || auth()->user()->gestorSuporte() || auth()->user()->suporte()) {
            return Excel::download(new SupportsExport($filter), 'supports.xlsx');
        } else {
            return abort(403);
        }
    }

    public function print(Support $support)
    {
        if (
                (
                    array_intersect(auth()->user()->roles->pluck('id')->all(), [2, 8]) &&
                    array_intersect(auth()->user()->departments->pluck('id')->all(), (array) $support->area)
                ) &&
                ($support->status == 2 || $support->status == 0)
        ) {
            new SupportOSExport($support);
        } else {
            return abort(403);
        }
    }

    public function printAvulsa()
    {
        if (array_intersect(auth()->user()->roles->pluck('id')->all(), [2, 8]) && array_intersect(auth()->user()->departments->pluck('id')->all(), Department::supportAreas()->pluck('id')->all())) {
            new SupportSeparateExport();
        } else {
            return abort(403);
        }
    }
}
