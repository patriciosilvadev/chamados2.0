<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'user_id','support_area_id','support_area_type',
        'environment_id','spot_id','sector_id','service_id',
        'description','execution_by','attach_file_name',
        'status','desired_date','expected_date','real_date',
        'expected_hours','real_hours','done_by','recurrent',
    ];

    protected $casts = [ 'done_by' => 'array' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    public function area()
    {
        return $this->morphTo();
    }

    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function justification()
    {
        return $this->hasOne(Jutification::class);
    }

    public static function regularUser($user, $filtro)
    {
        return Chamado::with(['usuario', 'local', 'servico', 'ambiente', 'setor', 'departamento'])
            ->whereIn('status', $filtro->status)
            // ->where('usuario_id', $user->id)
            ->whereHas('usuario.departamentos', function ($query) use ($filtro) {
                $query->whereIn('i_grupo.cod_grupo', auth()->user()->departamentos->pluck('cod_grupo')->all());
            })
            ->where(function ($query) use ($filtro) {
                $query->orWhere('id', 'like', "%$filtro->search%")
                    ->orWhereHas('local', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('setor', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('servico', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('ambiente', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    });
            })
            ->orderBy('status')
            // ->orderBy('data_desejada', 'asc')
            ->latest('updated_at')
            ->paginate($filtro->paginate);
    }

    public static function adminUser($user, $filtro)
    {
        return Chamado::with(['usuario', 'local', 'servico', 'ambiente', 'setor', 'departamento'])
            ->whereIn('status', $filtro->status)
            ->whereIn('departamento_id', $user->departamentos->pluck('cod_grupo')->all())
            ->whereHas('usuario', function ($query) use ($filtro) {
                $query->where('nome', 'like', "%$filtro->solicitante%");
            })
            ->whereBetween('created_at', $filtro->data)
            ->where(function ($query) use ($filtro) {
                $query->orWhere('id', 'like', "%$filtro->search%")
                    ->orWhereHas('local', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('setor', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('servico', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('ambiente', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('usuario', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    });
            })
            ->orderBy('status')
            // ->orderBy('data_desejada', 'asc')
            ->latest('updated_at')
            ->paginate($filtro->paginate);
    }

    public static function gestorUser($user, $filtro)
    {
        return Chamado::with(['usuario', 'local', 'servico', 'ambiente', 'setor', 'departamento'])
            ->whereIn('status', $filtro->status)
            ->whereIn('departamento_id', $filtro->departamento)
            ->whereHas('usuario.departamentos', function ($query) use ($filtro) {
                $query->whereIn('i_grupo.cod_grupo', auth()->user()->departamentos->pluck('cod_grupo')->all());
            })
            ->whereHas('usuario', function ($query) use ($filtro) {
                $query->where('nome', 'like', "%$filtro->solicitante%");
            })
            ->whereBetween('created_at', $filtro->data)
            ->where(function ($query) use ($filtro) {
                $query->orWhere('id', 'like', "%$filtro->search%")
                    ->orWhereHas('local', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('setor', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('servico', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('ambiente', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('usuario', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    });
            })
            ->orderBy('status')
            // ->orderBy('data_desejada', 'asc')
            ->orderBy('departamento_id')
            ->latest('updated_at')
            ->paginate($filtro->paginate);
    }

    public static function diretorUser($user, $filtro)
    {
        return Chamado::with(['usuario', 'local', 'servico', 'ambiente', 'setor', 'departamento'])
            ->whereIn('status', $filtro->status)
            ->whereIn('departamento_id', $filtro->departamento)
            ->whereHas('usuario', function ($query) use ($filtro) {
                $query->where('nome', 'like', "%$filtro->solicitante%");
            })
            ->whereBetween('created_at', $filtro->data)
            ->where(function ($query) use ($filtro) {
                $query->orWhere('id', 'like', "%$filtro->search%")
                    ->orWhereHas('local', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('setor', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('servico', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('ambiente', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    })
                    ->orWhereHas('usuario', function ($query) use ($filtro) {
                        $query->where('nome', 'like', "%$filtro->search%");
                    });
            })
            ->orderBy('status')
            // ->orderBy('data_desejada', 'asc')
            ->orderBy('departamento_id')
            ->latest('updated_at')
            ->paginate($filtro->paginate);
    }

    public function notificationTrigger()
    {
        return $this->messages()
            ->whereBetween('created_at', [Carbon::now()->subMinutes(30), Carbon::now()])
            ->count();
    }
}
