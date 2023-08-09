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

class InformeMoodleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function riesgo(){

        $riesgos = DB::table('datos_moodle')->select(DB::raw('COUNT(Riesgo) AS TOTAL, Riesgo'))->groupBy('Riesgo')->get();
        $Total = DB::table('datos_moodle')->select(DB::raw('COUNT(Riesgo) AS TOTAL'))->get();

        $alto = [];
        $medio = [];
        $bajo = [];
        $total = [];

        foreach ($riesgos as $riesgo) {
            $tipo = $riesgo->Riesgo;
            $cantidad = $riesgo->TOTAL;

            if ($tipo == 'ALTO') {
                $alto[] = $cantidad;
            } elseif ($tipo == 'MEDIO') {
                $medio[] = $cantidad;
            } elseif ($tipo == 'BAJO') {
                $bajo[] = $cantidad;
            }
        }

        dd($Total['TOTAL']);

        $datos = array(
            'alto' => $alto,
            'medio' => $medio,
            'bajo' => $bajo,
            'total' => $Total           
        );
        return $datos;
    }
}

?>