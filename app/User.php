<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $connection = 'mysql2';

    protected $fillable = [
        'department_id', 'subdepartment_id','name','email','avatar','username','status',
    ];

    protected $hidden = ['remember_token'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     *
     */
    public function subdepartment()
    {
        return $this->belongsTo(Subdepartment::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function jutifications()
    {
        return $this->hasMany(Justification::class);
    }

    /**
     * @param integer Department's id
     * @return App\User
     */
    public function manager($departmentId)
    {
        return $this->where('department_id', $departmentId)
            ->whereHas('roles', function ($query) {
                $query->whereId(2);
            })->first();
    }

    /**
     * @return boolean
     */
    public function isCEO()
    {
        return in_array(1, $this->roles->pluck('id')->all());
    }

    /**
     * @return boolean
     */
    public function isManager()
    {
        return in_array(2, $this->roles->pluck('id')->all());
    }

    /**
     * @return boolean
     */
    public function isSupport()
    {
        return in_array(3, $this->roles->pluck('id')->all());
    }

    /**
     * @return string
     */
    public function role()
    {
        if ($this->isCEO()) {
            return 'ceo';
        }

        if ($this->isManager()) {
            return 'manager';
        }

        if ($this->isSupport()) {
            return 'support';
        }

        return 'regular';
    }

    // public static function atendentes()
    // {
    //     return Departamento::whereIn(
    //             'cod_grupo',
    //             array_intersect(
    //                 auth()->user()->departamentos->pluck('cod_grupo')->all(),
    //                 Departamento::areasSuporte()->pluck('cod_grupo')->all()
    //             )
    //         )->whereHas('usuarios', function ($query){
    //             $query->where('status', 1);
    //         })->with('usuarios')
    //         ->get()
    //         ->pluck('usuarios')
    //         ->all();
    // }

    // public function areaSuporte()
    // {
    //     return array_intersect(Departamento::areasSuporte()->pluck('cod_grupo')->all(), $this->departamentos->pluck('cod_grupo')->all())[0];
    // }
}
