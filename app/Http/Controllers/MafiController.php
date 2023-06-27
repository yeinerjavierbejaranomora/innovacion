<?php

namespace App\Http\Controllers;

use App\Models\Mafi;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MafiController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicioMafi() {
        return view('vistas.admin.mafi');
    }

    public function getDataMafi(){
        $mesActual =  date('n');
        $periodos = Periodo::all();
        //return $periodos;
        foreach($periodos as $periodo):
            if($periodo->mes == $mesActual):
                $formacionContinua = $periodo->formacion_continua;
                $pregradoCuatrimestral = $periodo->year.$periodo->Pregrado_cuatrimestral;
                $pregradoSemestral = $periodo->year + $periodo->Pregrado_semestral;
                $especializacion = $periodo->year + $periodo->especializacion;
                $maestria = $periodo->year + $periodo->maestria;
            endif;
        endforeach;
        return $pregradoCuatrimestral;
        die();
        /*$data = Mafi::where([['estado','<>','Inactivo']]);
        $dataLongitud = count($data);*/
    }


    public function Generar_faltantes(){
        /** traemos la fecha actual para poder comparar con el periodo */
        $fechaActual=date('Y-m-d h:i:s');
        $fechaSegundos=strtotime($fechaActual);

        $dia=date('j',$fechaSegundos);
        $mes=date('n',$fechaSegundos);
        $año=date('Y',$fechaSegundos);

        /** consultamos el periodo en la base de datos teniendo en cuenta la fecha actual */

        $sql='SELECT * FROM `periodo` WHERE  `mes`=$mes';

        $periodo = DB::select($sql);
        dd($periodo);

        $consulta_estudiantes ='SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="OK" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333) AND tipo_estudiante!="XXXXX" ORDER BY id ASC LIMIT 20000';

        $consulta_estudiantes = 'SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="OK" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333) AND tipo_estudiante!="XXXXX" ORDER BY id ASC LIMIT 20000';

    }



}
