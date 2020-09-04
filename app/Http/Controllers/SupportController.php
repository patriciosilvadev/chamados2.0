<?php

namespace App\Http\Controllers;

use App\User;
use App\Sector;
use App\Support;
use App\Activity;
use Carbon\Carbon;
use App\Department;
use App\Environment;
use App\Justification;
use App\Subdepartment;
use App\Jobs\GoogleCalendar;
use App\Mail\SupportCreated;
use App\Mail\SupportUpdated;
use Illuminate\Http\Request;
use App\Exports\SupportsExport;
use App\Jobs\GoogleDriveUpload;
use App\Exports\SupportOSExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SupportRequest;
use App\Exports\SupportSeparateExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SupportController extends Controller
{
    protected $directory = 'supports_file';

    public function index()
    {
        if (request()->wantsJson()) {
            $supports = new Support;
            return $supports->search(request()->all());
        }

        $departments = new Department;
        return view('support.index')->with([
            'departments' => $departments->supportAreas(),
            'users' => User::orderBy('name')->where('status', 1)->whereNotNull('email')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = new Department;
        return view('support.create')->with(['departments' => $departments->supportAreas()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupportRequest $request)
    {
        if (request('subdepartment')) {
            $subdepartment = Subdepartment::whereId(request('subdepartment'))->first();
            $subdepartment->supports()->create([
                'department' => request('department'),
                'user_id' => auth()->user()->id,
                'environment_id' => request('subdepartment') == 13 ? request('environment') : null,
                'spot_id' => request('subdepartment') == 13 ? request('spot') : null,
                'sector_id' => request('sector'),
                'service_id' => request('service'),
                'description' => request('description'),
                'expected_date' => request('expected_date') !== null ? new Carbon(request('expected_date')) : null,
                'desired_date' => request('desired_date') !== null && !request('recurrent') ? new Carbon(request('desired_date')) : null,
                'status' => 1,
                'attached_file_name' => request()->file('attached_file_name') !== null ? $this->attach_file_name() : null,
                'recurrent' => request('recurrent')
            ]);
            $support = $subdepartment->supports->last();
        } else {
            $department = Department::whereId(request('department'))->first();
            $department->supports()->create([
                'user_id' => auth()->user()->id,
                'environment_id' => request('subdepartment') == 13 ? request('environment') : null,
                'spot_id' => request('subdepartment') == 13 ? request('spot') : null,
                'sector_id' => request('sector'),
                'service_id' => request('service'),
                'description' => request('description'),
                'expected_date' => request('expected_date') !== null ? new Carbon(request('expected_date')) : null,
                'desired_date' => request('desired_date') !== null && !request('recurrent') ? new Carbon(request('desired_date')) : null,
                'status' => 1,
                'attached_file_name' => request()->file('attached_file_name') !== null ? $this->attach_file_name() : null,
                'recurrent' => request('recurrent')
            ]);
            $support = $department->supports->last();
        }

        $support->activities()->create([
            'description' => [
                'status' => $support->status,
                'description' => $support->description,
                'execution_by' => $support->execution_by,
                'expected_hours' => $support->expected_hours,
                'done_by' => $support->done_by,
                'created_by' => $support->user->name,
            ],
        ]);

        try {
            Mail::to($support->area->email)->send(new SupportCreated($support));
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function show(Support $support)
    {
        $support = Support::whereId($support->id)->with(['user', 'environment', 'service', 'spot', 'sector', 'area'])->first();
        return view('support.show')->with(['support' => $support]);
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
                    'user_id' => auth()->user()->id,
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

        try {
            Mail::to($support->user->email)->send(new SupportUpdated($support));
        } catch (Exception $e) {
            Log::error($e);
        }

        $support->activities()->create([
            'description' => [
                'status' => $support->status,
                'description' => $support->description,
                'execution_by' => $support->execution_by,
                'sector' => $support->sector->name,
                'service' => $support->service->name,
                'expected_hours' => $support->expected_hours,
                'done_by' => $support->done_by,
                'created_by' => $support->user->name,
            ],
        ]);

        return $support->fresh();
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
