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
        /** Año y Mes Actual*/
        $yearActual = date('Y');
        $mesActual =  date('n');
        /** Consulta para traer los periodos por el año actual*/
        $periodos = Periodo::all()->where('year',$yearActual);
        //return $periodos;
        /** Recorrer el array de los periodos optenidos */
        foreach($periodos as $periodo):
            /** Comparar de los periodos cual corresponde con mes actual */
            if($periodo->mes == $mesActual):
                /** Se crea variables para cada periodo*/
                $formacionContinua = $periodo->formacion_continua;
                $pregradoCuatrimestral = $periodo->year.$periodo->Pregrado_cuatrimestral;
                $pregradoSemestral = $periodo->year + $periodo->Pregrado_semestral;
                $especializacion = $periodo->year + $periodo->especializacion;
                $maestria = $periodo->year + $periodo->maestria;
            endif;
        endforeach;

        /** Consulta de los datos tabla datMafi */
        $data = DB::table('users')
                ->where('estado','<>','Inactivo')
                ->whereIn('sello',['TIENE RETENCION','TIENE SELLO FINANCIERO'])
                ->whereIn('autorizado_asistir',['ACTIVO EN PLATAFORMA','ACTIVO EN PLATAFORMA ICETEX'])
                ->whereIn('periodo',['202313','202333','202343','202353'])
                ->get();

        return count($data);
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

        $sql='SELECT * FROM `periodo` WHERE  `mes`=6';

        $periodo = DB::select($sql);
        dd($periodo);

        $consulta_estudiantes ='SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="OK" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333) AND tipo_estudiante!="XXXXX" ORDER BY id ASC LIMIT 20000';

        $consulta_estudiantes = 'SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="OK" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333) AND tipo_estudiante!="XXXXX" ORDER BY id ASC LIMIT 20000';

    }



}
