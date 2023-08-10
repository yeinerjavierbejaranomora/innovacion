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

        $datos = array(
            'alto' => $alto,
            'medio' => $medio,
            'bajo' => $bajo,
            'total' => $Total[0]->TOTAL           
        );
        return $datos;
    }


    public function sello(){
            /**
             * SELECT COUNT(sello) AS TOTAL, sello FROM `datos_Moodle`
             *GROUP BY sello
             */
            $sello = DB::table('datos_moodle')
                ->select(DB::raw('COUNT(Sello) AS TOTAL, Sello'))
                ->groupBy('Sello')
                ->get();
       
        header("Content-Type: application/json");
        echo json_encode(array('data' => $sello));
    }

    public function retencion(){
            
        $retencion = DB::table('datos_moodle')
                ->where('Sello', 'NO EXISTE')
                ->select(DB::raw('COUNT(Autorizado_ASP) AS TOTAL, Autorizado_ASP'))
                ->groupBy('Autorizado_ASP')
                ->get();
        
        header("Content-Type: application/json");
        echo json_encode(array('data' => $retencion));
    }

    function estudiantesRiesgo($riesgo){
        $riesgo = trim($riesgo);
        $estudiantes = DB::table('datos_moodle')
        ->where('Riesgo', $riesgo)
        ->select('Id_Banner','Nombre','Apellido','Facultad','Programa')
        ->groupBy('Id_Banner','Nombre','Apellido','Facultad','Programa')
        ->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    function dataAlumno(Request $request){
        $idBanner = $request->input('idBanner');
        $data = DB::table('datos_moodle')->where('Id_Banner',$idBanner)->select('*')->first();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $data));
    }
}
