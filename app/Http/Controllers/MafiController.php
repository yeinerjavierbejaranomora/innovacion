<?php

namespace App\Http\Controllers;

use App\Models\IndiceCambiosMafi;
use App\Models\LogAplicacion;
use App\Models\Mafi;
use App\Models\MafiReplica;
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

    public function inicioMafi()
    {
        return view('vistas.admin.mafi');
    }

    public function getDataMafi()
    {
        /** Año y Mes Actual*/
        $yearActual = date('Y');
        $mesActual =  date('n');
        /** Consulta para traer los periodos por el año actual*/
        $periodos = Periodo::all()->where('year', $yearActual);
        //return $periodos;
        /** Recorrer el array de los periodos optenidos */
        foreach ($periodos as $periodo) :
            /** Comparar de los periodos cual corresponde con mes actual */
            if ($periodo->mes == $mesActual) :
                /** Se crea variables para cada periodo*/
                $formacionContinua = $periodo->formacion_continua;
                $pregradoCuatrimestral = $periodo->year . $periodo->Pregrado_cuatrimestral;
                $pregradoSemestral = $periodo->year . $periodo->Pregrado_semestral;
                $especializacion = $periodo->year . $periodo->especializacion;
                $maestria = $periodo->year . $periodo->maestria;
            endif;
        endforeach;

        $log = DB::table('logAplicacion')->where([['accion','=','Insert'],['tabla_afectada','=','datosMafiReplica']])->orderBy('id', 'desc')->first();
        //return $log->idFin;
        if (empty($log)) :
            /** Consulta de los datos tabla datMafi */
            $data = DB::table('datosMafi')
                ->where('estado', '=', 'Activo')
                ->whereIn('sello', ['TIENE RETENCION', 'TIENE SELLO FINANCIERO'])
                //->where('autorizado_asistir', 'LIKE', 'ACTIVO%')
                //->whereIn('periodo', [$pregradoCuatrimestral, $pregradoSemestral, $especializacion, $maestria])
                ->orderBy('id')
                ->get()
                ->chunk(200);

        else :
            $data = DB::table('datosMafi')
                ->where('estado', '=', 'Activo')
                ->whereIn('sello', ['TIENE RETENCION', 'TIENE SELLO FINANCIERO'])
                //->where('autorizado_asistir', 'LIKE', 'ACTIVO%')
                //->whereIn('periodo', [$pregradoCuatrimestral, $pregradoSemestral, $especializacion, $maestria])
                ->where('id', '>', $log->idFin)
                ->orderBy('id')
                ->get()
                ->chunk(200);

        endif;

        if (!empty($data[0])) :
            $numeroRegistros = 0;
            $primerId = $data[0][0]->id;
            $ultimoRegistroId = 0;
            $fechaInicio = date('Y-m-d H:i:s');
            foreach ($data as $keys => $estudiantes) :
                foreach ($estudiantes as $key => $value) :
                    //dd($value->sello);
                    if($value->sello === 'TIENE RETENCION'):
                        $consultaActivoPlataforma = DB::table('datosMafi')->where([['id','=',$value->id],['sello','=',$value->sello]])->whereIn('autorizado_asistir',['ACTIVO EN PLATAFORMA', 'ACTIVO EN PLATAFORMA ICETEX'])->first();
                        if($consultaActivoPlataforma):
                            $insertar = MafiReplica::create([
                                'idbanner' => $value->idbanner,
                                'primer_apellido' => $value->primer_apellido,
                                'programa' => $value->programa,
                                'codprograma' => $value->codprograma,
                                'cadena' => $value->cadena,
                                'periodo' => $value->periodo,
                                'estado' => $value->estado,
                                'tipoestudiante' => $value->tipoestudiante,
                                'ruta_academica' => $value->ruta_academica,
                                'sello' => $value->sello,
                                'operador' => $value->operador,
                                'autorizado_asistir' => $value->autorizado_asistir,
                            ]);
                            $numeroRegistros++;
                        endif;
                    else:
                        $insertar = MafiReplica::create([
                            'idbanner' => $value->idbanner,
                            'primer_apellido' => $value->primer_apellido,
                            'programa' => $value->programa,
                            'codprograma' => $value->codprograma,
                            'cadena' => $value->cadena,
                            'periodo' => $value->periodo,
                            'estado' => $value->estado,
                            'tipoestudiante' => $value->tipoestudiante,
                            'ruta_academica' => $value->ruta_academica,
                            'sello' => $value->sello,
                            'operador' => $value->operador,
                            'autorizado_asistir' => $value->autorizado_asistir,
                        ]);
                        $numeroRegistros++;
                    endif;

                    $ultimoRegistroId = $value->id;
                    $idBannerUltimoRegistro = $value->idbanner;
                endforeach;
            endforeach;
            $fechaFin = date('Y-m-d H:i:s');

            //return "Fecha inicio: " .$fechaInicio. ', Fecha Fin '. $fechaFin;
            $insertLog = LogAplicacion::create([
                'idInicio' => $primerId,
                'idFin' => $ultimoRegistroId,
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'accion' => 'Insert',
                'tabla_afectada' => 'datosMafiReplica',
                'descripcion' => 'Se realizo la insercion en la tabla datosMafiRelica desde la tabla datosMafi, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId .',insertando '.$numeroRegistros .' registros',
            ]);

            $insertIndiceCambio = IndiceCambiosMafi::create([
                'idbanner' => $idBannerUltimoRegistro,
                'accion' => 'Insert',
                'descripcion' => 'Se realizo la insercion en la tabla datosMafiRelica desde la tabla datosMafi, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId .',insertando '.$numeroRegistros .' registros',
                'fecha' => date('Y-m-d H:i:s'),
            ]);
            if($insertLog && $insertIndiceCambio):
                return "Numero de registros: '.$numeroRegistros.'=> primer id registrado: " .$primerId. ', Ultimo id registrado '. $ultimoRegistroId;
            endif;
        else:
            return "No hay registros para replicar";
        endif;

        //$contData = count($data);
        /*$contKeys = 0;
        //$data = (array) $data;
        //dd($data);
        $numeroDatos = 200;
        $contadorGeneral = ceil($contData / $numeroDatos);
        dd(array_chunk($data,$contadorGeneral));
        for ($i=0; $i < $contadorGeneral; $i++):

            foreach ($data as $key => $value) {
                if($key === $contKeys):

                    return 'entra';
                else:
                    return 'No entro';
                endif;
            }
        endfor;*/
        /*$data = Mafi::where([['estado','<>','Inactivo']]);
        $dataLongitud = count($data);*/
    }


    public function getDataMafiReplica()
    {

        $log = DB::table('logAplicacion')->where([['accion','=','Insert'],['tabla_afectada','=','estudiantes']])->orderBy('id', 'desc')->first();
        //return $log;
        if (empty($log)) :
            $data = DB::table('datosMafiReplica')
                ->join('programas','datosMafiReplica.programa','=','programas.codprograma')
                ->join('periodo','datosMafiReplica.periodo','=','periodo.periodos')
                ->select('datosMafiReplica.*')
                ->where([['programas.activo','=',1],['periodo.periodoActivo','=',1]])
                ->orderBy('datosMafiReplica.id')
                ->get()
                ->chunk(200);
        else:
        endif;
        dd($data);
        if(str_contains($data[0][3]->tipoestudiante,'TRANSFERENTE EXTERNO')):
            $concultaTrasferente = DB::table('datosMafiReplica')
            ->join('historialAcademico','datosMafiReplica.idbanner','=','historialAcademico.codBanner')
            ->where('datosMafiReplica.idbanner','=',$data[0][3]->idbanner)->count();
            if($concultaTrasferente == 0):
                return "No tiene historial";
            else:
                return "Tiene historial";
            endif;
        else:
            return "No";
        endif;


        if (!empty($data[0])) :
            $numeroRegistros = 0;
            $primerId = $data[0][0]->id;
            $ultimoRegistroId = 0;
            $fechaInicio = date('Y-m-d H:i:s');
            foreach ($data as $keys => $estudiantes) :
                foreach ($estudiantes as $key => $value) :
                    if(str_contains($value->tipoestudiante,'TRANSFERENTE EXTERNO')):
                        $concultaTrasferente = DB::table('datosMafiReplica')
                        ->join('historialAcademico','datosMafiReplica.idbanner','=','historialAcademico.codBanner')
                        ->where('datosMafiReplica.idbanner','=',$value->idbanner)->first();
                        if($concultaTrasferente):
                        else:
                        endif;
                    else:
                        return "No";
                    endif;
                endforeach;
            endforeach;
        else:
            return "No hay registros para replicar";
        endif;
    }


    public function periodo(){

         /** traemos la fecha actual para poder comparar con el periodo */
         $fechaActual = date('Y-m-d');
         
         $mes =explode('-',$fechaActual) ;
         //dd($mes);

         $periodo = DB::table('periodo')->get();

         foreach ($periodo as $key => $value) {

            $ciclo1=explode('-',$value->fechaInicioCiclo1);
            $ciclo2=explode('-',$value->fechaInicioCiclo2);

            if($ciclo1[1]=== $mes[1]|| $ciclo2[1]=== $mes[1]){
                dd($value->fechaInicioCiclo1);
            }



         }

         dd($periodo);

         $periodo = $periodo[0];


         dd($periodo[0]->mes);
         /** marca de ingreso */
         //$marca_de_ingreso = $periodo;

         dd($periodo);

    }

    public function Generar_faltantes()
    {

        /** consultamos el periodo en la base de datos teniendo en cuenta la fecha actual */



        $consulta_estudiantes = 'SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="OK" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333) AND tipo_estudiante!="XXXXX" ORDER BY id ASC LIMIT 20000';

        $consulta_estudiantes = 'SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="OK" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333) AND tipo_estudiante!="XXXXX" ORDER BY id ASC LIMIT 20000';
    }
}
