<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CambioPassRequest;
use App\Http\Requests\UsuarioLoginRequest;
use App\Http\Requests\CrearFacultadRequest;
use App\Models\Facultad;
use App\Models\Roles;
use App\Models\User;
use App\Models\Usuario;
use App\Http\Util\Constantes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class InformeMafiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Método que trae los periodos activos
     * @return JSON Retorna un Json con los periodos activos
     */
    public function periodosActivos(){
        $periodos = DB::table('periodo')->where('periodoActivo',1)->get();
        return $periodos;
    }




}

