<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model implements Authenticatable
{
    protected $table = 'usuarios';
    protected $fillable =[
        'idBanner','documentoDeIdentidad','correo','password','nombre','idRol','idFacultad','idPrograma','fecha','ingreso_plataforma','activo'
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}
