<?php

namespace App\Http\Controllers;

use App\Models\Mafi;
use App\Models\Periodo;
use Illuminate\Http\Request;

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
        return date('n');
        $periodos = Periodo::all();
        return $periodos;
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

        $periodo='SELECT * FROM `periodo` WHERE  `mes`='+$mes+ '';

        $consulta_estudiantes ='SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="OK" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333) AND tipo_estudiante!="XXXXX" ORDER BY id ASC LIMIT 20000';

        $consulta_estudiantes = 'SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="OK" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333) AND tipo_estudiante!="XXXXX" ORDER BY id ASC LIMIT 20000';

    }



}
