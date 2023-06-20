<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_banner',
        'documento',
        'email',
        'password',
        'nombre',
        'id_rol',
        'id_facultad',
        'programa',
        'ingreso_plataforma',
        'activo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setDocumentoAttribute($value){
        /**Recibe el valor del campo documento delformulario de registro */
        /**se agrega al campo documento */
        $this->attributes['documento'] = $value;
        
        $this->attributes['password'] = bcrypt($value);
    }

    public function setProgramaAttribute($value)
    {
        $Programas = '';
        if (isset($value)) :
            foreach ($value as $programa) :
                $Programas .= $programa . ";";
            endforeach;
            $this->attributes['programa'] = $Programas;
        else:
            $this->attributes['programa'] = '';
        endif;
    }


}
