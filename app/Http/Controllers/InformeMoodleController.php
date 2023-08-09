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
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class InformeMoodleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function riesgo(){

        $riesgos = DB::table('datos_moodle')->select(DB::raw('COUNT(riesgo) AS TOTAL, riesgo'))->groupBy('riesgo')->get();

        foreach ($riesgos as $riesgo){
            $tipo = $riesgo->riesgo;
            if($tipo == 'alto'){
                $alto[] = $tipo;
            }elseif($tipo == 'medio'){
                $medio[] = $tipo;
            }else{
                $bajo[] = $tipo;
            }
        }

        $datos = array(
          'alto'=>$alto,
          'medio'=>$medio,
          'bajo'=>$bajo  
        );

        return $datos;
    }
}
