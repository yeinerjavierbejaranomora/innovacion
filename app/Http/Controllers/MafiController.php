<?php

namespace App\Http\Controllers;

use App\Models\AlertasTempranas;
use App\Models\Estudiante;
use App\Models\IndiceCambiosMafi;
use App\Models\LogAplicacion;
use App\Models\Mafi;
use App\Models\MafiReplica;
use App\Models\MateriasPorVer;
use App\Models\Periodo;
use Exception;
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
        /// para activar el perodo activo en la base de datos
        $this->periodo();
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

        $log = DB::table('logAplicacion')->where([['accion', '=', 'Insert'], ['tabla_afectada', '=', 'datosMafiReplica']])->orderBy('id', 'desc')->first();
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
                    if ($value->sello === 'TIENE RETENCION') :
                        $consultaActivoPlataforma = DB::table('datosMafi')->where([['id', '=', $value->id], ['sello', '=', $value->sello]])->whereIn('autorizado_asistir', ['ACTIVO EN PLATAFORMA', 'ACTIVO EN PLATAFORMA ICETEX'])->first();
                        if ($consultaActivoPlataforma) :
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
                    else :
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
                'descripcion' => 'Se realizo la insercion en la tabla datosMafiRelica desde la tabla datosMafi, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $numeroRegistros . ' registros',
            ]);

            $insertIndiceCambio = IndiceCambiosMafi::create([
                'idbanner' => $idBannerUltimoRegistro,
                'accion' => 'Insert',
                'descripcion' => 'Se realizo la insercion en la tabla datosMafiRelica desde la tabla datosMafi, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $numeroRegistros . ' registros',
                'fecha' => date('Y-m-d H:i:s'),
            ]);
            if ($insertLog && $insertIndiceCambio) :
                return "Numero de registros: '.$numeroRegistros.'=> primer id registrado: " . $primerId . ', Ultimo id registrado ' . $ultimoRegistroId;
            endif;
        else :
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
        /**Ingresar la materias faltantes por ver de los estudiantes ANTIGUOS  */
        $estudiantesAntiguosC = DB::table('estudiantes')
            ->where('tipo_estudiante', 'LIKE', 'ESTUDIANTE ANTIGUO%')
            ->whereNull('programaActivo')
            ->whereNull('materias_faltantes')
            ->orWhere('tipo_estudiante', 'LIKE', 'PSEUDO ACTIVOS%')
            ->whereNull('programaActivo')
            ->whereNull('materias_faltantes')
            ->orderBy('id')->count();
        dd(ceil($estudiantesAntiguosC/2));
        /**Ingresar la materias faltantes por ver de los estudiantes transferentes */
        $log = DB::table('logAplicacion')->where([['accion', '=', 'Insert-Transferente'], ['tabla_afectada', '=', 'materiasPorVer']])->orderBy('id', 'desc')->first();
        if (empty($log)) :
            $offset = 0;
        else :
            $offset = $log->idFin;
        endif;
        $estudiantesTransferentes = $this->falatntesTranferentes($offset);
        if (!empty($estudiantesTransferentes[0])) :
            $fechaInicio = date('Y-m-d H:i:s');
            $registroMPV = 0;
            $primerId = $estudiantesTransferentes[0]->id;
            $ultimoRegistroId = 0;
            //dd($transferente);
            foreach ($estudiantesTransferentes as $estudiante) :
                $historial = $this->historialAcademico($estudiante->homologante);
                //dd($historial['codprograma']);
                $mallaCurricular = $this->BaseAcademica($estudiante->homologante,$estudiante->programa);
                //dd($mallaCurricular);
                $diff = array_udiff($mallaCurricular, $historial, function($a, $b) {
                    return $a['codMateria'] <=> $b['codMateria'];
                });
                foreach ($diff as $key => $value) :
                    //dd($value);
                    $insertMateriaPorVer = MateriasPorVer::create([
                        "codBanner"      => $value['codBanner'],
                        "codMateria"      => $value['codMateria'],
                        "orden"      => $value['orden'],
                        "codprograma"      => $value['codprograma'],
                    ]);
                    $registroMPV++;
                endforeach;
                DB::table('estudiantes')->where([['homologante','=',$estudiante->homologante],['id','=',$estudiante->id]])->update(['materias_faltantes'=>'OK']);

                $ultimoRegistroId = $estudiante->id;
                $idBannerUltimoRegistro = $estudiante->homologante;
            endforeach;
            $fechaFin = date('Y-m-d H:i:s');
            $insertLog = LogAplicacion::create([
                'idInicio' => $primerId,
                'idFin' => $ultimoRegistroId,
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'accion' => 'Insert-Transferente',
                'tabla_afectada' => 'materiasPorVer',
                'descripcion' => 'Se realizo la insercion en la tabla materiasPorVer insertando las materias por ver del estudiante transferente, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $registroMPV . ' registros',
            ]);

            $insertIndiceCambio = IndiceCambiosMafi::create([
                'idbanner' => $idBannerUltimoRegistro,
                'accion' => 'Insert-Transferente',
                'descripcion' => 'Se realizo la insercion en la tabla materiasPorVer insertando las materias por ver del estudiante transferente, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $registroMPV . ' registros',
                'fecha' => date('Y-m-d H:i:s'),
            ]);
            echo $registroMPV . "-Fecha Inicio: " . $fechaInicio . "Fecha Fin: " . $fechaFin;
        else :
            echo "No hay estudiantes TRANSFERENTES";
        endif;
        /**Ingresar la materias faltantes por ver de los estudiantes de primer ingreso e ingreso singular */
        $log = DB::table('logAplicacion')->where([['accion', '=', 'Insert-PrimerIngreso'], ['tabla_afectada', '=', 'materiasPorVer']])->orderBy('id', 'desc')->first();
        if (empty($log)) :
            $offset = 0;
        else :
            $offset = $log->idFin;
        endif;
        $primerIngreso = $this->falatntesPrimerIngreso($offset);
        if (!empty($primerIngreso[0])) :
            $fechaInicio = date('Y-m-d H:i:s');
            $registroMPV = 0;
            $primerId = $primerIngreso[0]->id;
            $ultimoRegistroId = 0;
            foreach ($primerIngreso as $estudiante) :
                $mallaCurricular = $this->BaseAcademica($estudiante->homologante,$estudiante->programa);
                foreach ($mallaCurricular as $key => $malla) :
                    $insertMateriaPorVer = MateriasPorVer::create([
                        "codBanner"      => $malla['codBanner'],
                        "codMateria"      => $malla['codMateria'],
                        "orden"      => $malla['orden'],
                        "codprograma"      => $malla['codprograma'],
                    ]);
                    $registroMPV++;
                endforeach;
                DB::table('estudiantes')->where([['homologante','=',$estudiante->homologante],['id','=',$estudiante->id]])->update(['materias_faltantes'=>'OK']);
                $ultimoRegistroId = $estudiante->id;
                $idBannerUltimoRegistro = $estudiante->homologante;
            endforeach;
            $fechaFin = date('Y-m-d H:i:s');
            $insertLog = LogAplicacion::create([
                'idInicio' => $primerId,
                'idFin' => $ultimoRegistroId,
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'accion' => 'Insert-PrimerIngreso',
                'tabla_afectada' => 'materiasPorVer',
                'descripcion' => 'Se realizo la insercion en la tabla materiasPorVer insertando las materias por ver del estudiante de primer ingreso, modificando el valor del campo materias_faltantes en la tabla estudiantes de NULL a "OK" en cada estudiante, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $registroMPV . ' registros',
            ]);

            $insertIndiceCambio = IndiceCambiosMafi::create([
                'idbanner' => $idBannerUltimoRegistro,
                'accion' => 'Insert-PrimerIngreso',
                'descripcion' => 'Se realizo la insercion en la tabla materiasPorVer insertando las materias por ver del estudiante de primer ingreso, modificando el valor del campo materias_faltantes en la tabla estudiantes de NULL a "OK" en cada estudiante, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $registroMPV . ' registros',
                'fecha' => date('Y-m-d H:i:s'),
            ]);
            echo $registroMPV . "-Fecha Inicio: " . $fechaInicio . "Fecha Fin: " . $fechaFin;
        else :
            echo "No hay estudiantes de primer ingreso";
        endif;
        /** Replicar los datos en estudiantes desde datosMafiReplica Aplicando los flitros */
        $log = DB::table('logAplicacion')->where([['accion', '=', 'Insert'], ['tabla_afectada', '=', 'estudiantes']])->orderBy('id', 'desc')->first();
        if (empty($log)) :
            $offset = 0;
        else :
            $offset = $log->idFin;
        endif;
        /**SELECT dmr.*,p.activo AS programaActivo FROM `datosMafiReplica` dmr
            INNER JOIN programas p ON p.codprograma=dmr.programa
            INNER JOIN periodo pe ON pe.periodos=dmr.periodo
            WHERE dmr.id > 0
            AND pe.periodoActivo = 1
            ORDER BY dmr.id ASC */
        $data = DB::table('datosMafiReplica')
            ->join('programas', 'datosMafiReplica.programa', '=', 'programas.codprograma')
            ->join('periodo', 'datosMafiReplica.periodo', '=', 'periodo.periodos')
            ->select('datosMafiReplica.*', 'programas.activo AS programaActivo')
            ->where([['datosMafiReplica.id', '>', $offset], ['periodo.periodoActivo', '=', 1]])
            ->orderBy('datosMafiReplica.id')
            ->get()
            ->chunk(200);

        if (!empty($data[0])) :
            $numeroRegistros = 0;
            $numeroRegistrosAlertas = 0;
            $primerId = $data[0][0]->id;
            $ultimoRegistroId = 0;
            $fechaInicio = date('Y-m-d H:i:s');
            foreach ($data as $keys => $estudiantes) :
                foreach ($estudiantes as $key => $value) :
                    if (str_contains($value->tipoestudiante, 'TRANSFERENTE EXTERNO') || str_contains($value->tipoestudiante, 'TRANSFERENTE INTERNO')) :
                        /**SELECT ha.codMateria FROM `datosMafiReplica` dmr
                        INNER JOIN historialAcademico ha ON ha.codBanner=dmr.idbanner
                        WHERE dmr.idbanner = [idbanner] */
                        $historial = DB::table('datosMafiReplica')
                            ->select('historialAcademico.codMateria')
                            ->join('historialAcademico', 'datosMafiReplica.idbanner', '=', 'historialAcademico.codBanner')
                            ->where('datosMafiReplica.idbanner', '=', $value->idbanner)->count();
                        if ($historial == 0) :
                            /**Insert tabla estudiantes en campo  tiene_historial "Sin Historial" */
                            if ($value->programaActivo < 1) :
                                $insertEstudinate = Estudiante::create([
                                    'homologante' => $value->idbanner,
                                    'nombre' => $value->primer_apellido,
                                    'programa' => $value->programa,
                                    'bolsa' => $value->ruta_academica,
                                    'operador' => $value->operador,
                                    'nodo' => 'nodo',
                                    'tipo_estudiante' => $value->tipoestudiante,
                                    'tiene_historial' => 'SIN HISTORIAL',
                                    'programaActivo' => 'NO SE ABRIO PROGRAMA',
                                    'marca_ingreso' => $value->periodo,
                                ]);
                                /**Insert tabla alertas_tempranas, transferente sin historial academico */
                                $insertAlerta = AlertasTempranas::create([
                                    'idbanner' => $value->idbanner,
                                    'tipo_estudiante' => $value->tipoestudiante,
                                    'desccripcion' => 'El estudiante con idBanner' . $value->idbanner . ' es "TRANSFERENTE EXTERENO" O  y no tiene historial academico',
                                ]);

                                if ($insertAlerta) :
                                    $numeroRegistrosAlertas++;
                                endif;
                            else :
                                /**Insert tabla estudiantes */
                                $insertEstudinate = Estudiante::create([
                                    'homologante' => $value->idbanner,
                                    'nombre' => $value->primer_apellido,
                                    'programa' => $value->programa,
                                    'bolsa' => $value->ruta_academica,
                                    'operador' => $value->operador,
                                    'nodo' => 'nodo',
                                    'tipo_estudiante' => $value->tipoestudiante,
                                    'tiene_historial' => 'SIN HISTORIAL',
                                    'marca_ingreso' => $value->periodo,
                                ]);

                                $insertAlerta = AlertasTempranas::create([
                                    'idbanner' => $value->idbanner,
                                    'tipo_estudiante' => $value->tipoestudiante,
                                    'desccripcion' => 'El estudiante con idBanner' . $value->idbanner . ' es "TRANSFERENTE EXTERENO" y no tiene historial academico',
                                ]);

                                if ($insertAlerta) :
                                    $numeroRegistrosAlertas++;
                                endif;

                                $insertAlerta = AlertasTempranas::create([
                                    'idbanner' => $value->idbanner,
                                    'tipo_estudiante' => $value->tipoestudiante,
                                    'desccripcion' => 'NO SE ABRIO PROGRAMA ' . $value->programa,
                                ]);

                            endif;
                            if ($insertAlerta) :
                                $numeroRegistrosAlertas++;
                            endif;

                            if ($insertEstudinate) :
                                $numeroRegistros++;
                            endif;
                        else :
                            if ($value->programaActivo > 0) :
                                /**Insert tabla estudiantes */
                                $insertEstudinate = Estudiante::create([
                                    'homologante' => $value->idbanner,
                                    'nombre' => $value->primer_apellido,
                                    'programa' => $value->programa,
                                    'bolsa' => $value->ruta_academica,
                                    'operador' => $value->operador,
                                    'nodo' => 'nodo',
                                    'tipo_estudiante' => $value->tipoestudiante,
                                    'marca_ingreso' => $value->periodo,
                                ]);
                            else :
                                /**Insert tabla estudiantes */
                                $insertEstudinate = Estudiante::create([
                                    'homologante' => $value->idbanner,
                                    'nombre' => $value->primer_apellido,
                                    'programa' => $value->programa,
                                    'bolsa' => $value->ruta_academica,
                                    'operador' => $value->operador,
                                    'nodo' => 'nodo',
                                    'tipo_estudiante' => $value->tipoestudiante,
                                    'programaActivo' => 'NO SE ABRIO PROGRAMA',
                                    'marca_ingreso' => $value->periodo,
                                ]);

                                $insertAlerta = AlertasTempranas::create([
                                    'idbanner' => $value->idbanner,
                                    'tipo_estudiante' => $value->tipoestudiante,
                                    'desccripcion' => 'NO SE ABRIO PROGRAMA ' . $value->programa,
                                ]);

                            endif;
                            if ($insertAlerta) :
                                $numeroRegistrosAlertas++;
                            endif;

                            if ($insertEstudinate) :
                                $numeroRegistros++;
                            endif;
                        endif;
                    else :
                        if ($value->programaActivo > 0) :
                            /**Insert tabla estudiantes */
                            $insertEstudinate = Estudiante::create([
                                'homologante' => $value->idbanner,
                                'nombre' => $value->primer_apellido,
                                'programa' => $value->programa,
                                'bolsa' => $value->ruta_academica,
                                'operador' => $value->operador,
                                'nodo' => 'nodo',
                                'tipo_estudiante' => $value->tipoestudiante,
                                'marca_ingreso' => $value->periodo,
                            ]);
                        else :
                            /**Insert tabla estudiantes */
                            $insertEstudinate = Estudiante::create([
                                'homologante' => $value->idbanner,
                                'nombre' => $value->primer_apellido,
                                'programa' => $value->programa,
                                'bolsa' => $value->ruta_academica,
                                'operador' => $value->operador,
                                'nodo' => 'nodo',
                                'tipo_estudiante' => $value->tipoestudiante,
                                'programaActivo' => 'NO SE ABRIO PROGRAMA',
                                'marca_ingreso' => $value->periodo,
                            ]);

                            $insertAlerta = AlertasTempranas::create([
                                'idbanner' => $value->idbanner,
                                'tipo_estudiante' => $value->tipoestudiante,
                                'desccripcion' => 'NO SE ABRIO PROGRAMA ' . $value->programa,
                            ]);

                            if ($insertAlerta) :
                                $numeroRegistrosAlertas++;
                            endif;
                        endif;

                        if ($insertEstudinate) :
                            $numeroRegistros++;
                        endif;
                    endif;
                    $ultimoRegistroId = $value->id;
                    $idBannerUltimoRegistro = $value->idbanner;
                endforeach;
            endforeach;
            $fechaFin = date('Y-m-d H:i:s');
            $insertLog = LogAplicacion::create([
                'idInicio' => $primerId,
                'idFin' => $ultimoRegistroId,
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'accion' => 'Insert',
                'tabla_afectada' => 'estudiantes',
                'descripcion' => 'Se realizo la insercion en la tabla estudiantes desde la tabla datosMafiReplica, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $numeroRegistros . ' registros',
            ]);

            $insertIndiceCambio = IndiceCambiosMafi::create([
                'idbanner' => $idBannerUltimoRegistro,
                'accion' => 'Insert',
                'descripcion' => 'Se realizo la insercion en la tabla estudiantes desde la tabla datosMafiReplica, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $numeroRegistros . ' registros',
                'fecha' => date('Y-m-d H:i:s'),
            ]);
            echo  "Numero de registros: " . $numeroRegistros . "=> primer id registrado: " . $primerId . ', Ultimo id registrado ' . $ultimoRegistroId .
                "<br> Numero de registrosen alertas: " . $numeroRegistrosAlertas .
                "<br> inicio:" . $fechaInicio . "-- Fin:" . $fechaFin;
        else :
            echo "No hay registros para replicar";
        endif;
    }

    public function falatntesPrimerIngreso($offset)
    {
        /**SELECT * FROM `estudiantes`
            WHERE `id` > 0
            AND `tipo_estudiante` LIKE 'PRIMER%'
            AND `programaActivo` IS NULL
            AND `materias_faltantes` = ''
            OR `tipo_estudiante` LIKE 'INGRESO%'
            AND `programaActivo` IS NULL
            AND `materias_faltantes` = '' */
        $estudiantesPrimerIngreso = DB::table('estudiantes')
            ->where('id','>',$offset)
            ->where('tipo_estudiante', 'LIKE', 'PRIMER%')
            ->whereNull('programaActivo')
            ->where('materias_faltantes','=','')
            ->orWhere('tipo_estudiante', 'LIKE', 'INGRESO%')
            ->whereNull('programaActivo')
            ->where('materias_faltantes','=','')
            ->orderBy('id')
            ->get();

        //dd($estudiantesPrimerIngreso);

        return $estudiantesPrimerIngreso;
    }

    public function falatntesTranferentes($offset)
    {
        /**SELECT * FROM `estudiantes`
            WHERE `id` > 0
            AND `tipo_estudiante` like 'TRANSFERENTE%'
            AND `programaActivo` IS NULL
            AND `tiene_historial` IS NULL
            AND `materias_faltantes` IS NULL */
        $estudiantesPrimerIngreso = DB::table('estudiantes')
            ->where('id','>',$offset)
            ->where('tipo_estudiante', 'LIKE', 'TRANSFERENTE%')
            ->whereNull('programaActivo')
            ->whereNull('tiene_historial')
            ->whereNull('materias_faltantes')
            ->orderBy('id')
            ->get();

        return $estudiantesPrimerIngreso;
    }

    public function faltantesAntiguos($offset,$limit)
    {

        /**SELECT * FROM `estudiantes`
        WHERE `tipo_estudiante` LIKE 'ESTUDIANTE ANTIGUO%'
        AND `programaActivo` IS NULL
        AND `materias_faltantes` = ''
        OR `tipo_estudiante` LIKE 'PSEUDO ACTIVOS%'
        AND `programaActivo` IS NULL
        AND `materias_faltantes` = ''
        AND `id` > 1
        ORDER BY `id` ASC
        LIMIT 200 */
        $estudiantesAntiguos = DB::table('estudiantes')
            ->where('id','>',$offset)
            ->where('tipo_estudiante', 'LIKE', 'ESTUDIANTE ANTIGUO%')
            ->whereNull('programaActivo')
            ->where('materias_faltantes','=','')
            ->orWhere('tipo_estudiante', 'LIKE', 'PSEUDO ACTIVOS%')
            ->whereNull('programaActivo')
            ->where('materias_faltantes','=','')
            ->orderBy('id')
            ->limit($limit)
            ->get();


        return $estudiantesAntiguos;
    }

    public function BaseAcademica($idbanner,$programa)
    {
        //Obtener la base academica del programa seleccionado

        $data = [];
        $mallaCurricular = DB::table('mallaCurricular')
        ->join('programas', 'programas.codprograma', '=', 'mallaCurricular.codprograma')
        ->select('mallaCurricular.codigoCurso', 'mallaCurricular.orden', 'mallaCurricular.codprograma')
        ->where([['programas.activo', '=', 1], ['mallaCurricular.codprograma', '=', $programa]])
            ->orderBy('semestre', 'asc')
            ->orderBy('orden', 'asc')
            ->get();

        foreach ($mallaCurricular as $key => $value) :
            $data[] = [
                'codBanner' => $idbanner,
                'codMateria'=>$value->codigoCurso,
                'orden'=>$value->orden,
                'codprograma'=>$value->codprograma,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        endforeach;
        //dd($data);
        //return $mallaCurricular;
        return $data;
    }


    public function historialAcademico($idBanner)
    {

        $data = [];
        $historial = DB::table('historialAcademico')
            ->select('codMateria', 'codprograma')
            ->where([['codBanner', '=', $idBanner],['codMateria','<>','na']])
            ->get()->toArray();

        foreach($historial as $key => $value):
            $data[] = [
                'codMateria'=>$value->codMateria,
                'codprograma'=>$value->codprograma];
        endforeach;
        //dd($data);

        return $data;
    }

    //*** funcion para activar los periodos automaticamente */
    public function periodo()
    {

        /** traemos la fecha actual para poder comparar con el periodo */
        $fechaActual = date('Y-m-d');
        $mes = explode('-', $fechaActual);
        $periodo = DB::table('periodo')->get();

        $mes[1] = 06;


        foreach ($periodo as $key => $value) {



            $ciclo1 = explode('-', $value->fechaInicioCiclo1);
            $ciclo2 = explode('-', $value->fechaInicioCiclo2);


            if (in_array($mes[1], $ciclo1) || in_array($mes[1], $ciclo2)) {

                DB::table('periodo')
                    ->where('id', $value->id)
                    ->update(['periodoActivo' => 1]);

                if (in_array((int)$mes[1], $ciclo1)) {
                    DB::table('periodo')
                        ->where('id', $value->id)
                        ->update(['activoCiclo1' => 1]);
                } else {
                    DB::table('periodo')
                        ->where('id', $value->id)
                        ->update(['activoCiclo1' => 0]);
                }

                if (in_array((int)$mes[1], $ciclo2)) {
                    DB::table('periodo')
                        ->where('id', $value->id)
                        ->update(['activoCiclo2' => 1]);
                } else {
                    DB::table('periodo')
                        ->where('id', $value->id)
                        ->update(['activoCiclo2' => 0]);
                }
            } else {
                DB::table('periodo')
                    ->where('id', $value->id)
                    ->update(['periodoActivo' => 0]);
            }
        }

        $periodo = DB::table('periodo')
            ->where(['periodoActivo' => 1])
            ->get();




        return  $periodo;
    }

    /** funcion para traer todos los programas activos en la plataforma */
    public function get_programas(){

        /* consulta sql para traer los programas activos
        * SELECT * FROM `programas` WHERE activo=1;
        */
        $programas= DB::table('programas')
            ->where('activo','=',1)
            ->get();

        return $programas;

    }

    /** para generar materias faltantes de los estudiantes  */
    public function Generar_faltantes()
    {


         /// para activar el perodo activo en la base de datos
         $periodo = $this->periodo();
         $marcaIngreso = "";
         foreach ($periodo as $key => $value) {
             $marcaIngreso .= (int)$value->periodos . ",";
         }

         // para procesasr las marcas de ingreso en los periodos
         $marcaIngreso=trim($marcaIngreso,",");
         // Dividir la cadena en elementos individuales
         $marcaIngreso = explode(",", $marcaIngreso);
         // Convertir cada elemento en un número
         $marcaIngreso = array_map('intval', $marcaIngreso);
         /* traemos todos los programas activos para la consulta */
         $programas= $this->get_programas();



        // Estudiantes para generar faltantes
        $consulta_homologante = 'SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333)ORDER BY id ASC';  //   AND observacion = "OMG"




        /* select `id`, `homologante`, `programa`
                    from `estudiantes`
            where `materias_faltantes` = 'OK'
            and `programado_ciclo1` is null
            and `programado_ciclo2` is null
            and `programa` = 'PCPV'
            and `marca_ingreso` in (202305, 202312, 202332, 202342, 202352, 202306, 202313, 202333, 202343, 202353);


            $consulta_homologante = 'SELECT id, homologante, programa FROM homologantes WHERE materias_faltantes="" AND programado_ciclo1="" AND programado_ciclo2="" AND programa="PCPV" AND marca_ingreso IN (202313, 202333)ORDER BY id ASC';


        */

        // Estudiantes para generar faltantes por programa
        $consulta_homologante= DB::table('estudiantes')
        ->select('id', 'homologante', 'programa')
        ->where('materias_faltantes',' ')
        ->whereNull('programado_ciclo1')
        ->whereNull('programado_ciclo2')
        ->where('programa', "PPSV")
        ->whereIn('marca_ingreso',$marcaIngreso)
        ->orderBy('id','ASC')
        ->chunk(200, function($estudiantes){

            foreach ($estudiantes as $estudiante) :

                $id_homologante=$estudiante->id;
                $codHomologante=$estudiante->homologante;
                $programa_homologante=$estudiante->programa;

             // Materias vistas por estudiante
                $consulta_vistas = 'SELECT codMateria, codBanner FROM historialAcademico WHERE codBanner='.$codHomologante.';';
                //echo $consulta_vistas . "<br />";
                //exit();

                $resultado_visitas = DB::select($consulta_vistas);




                $contacor_vistas=0;
                $codprograma='';
                $codbanner='';
                $materias_vistas = array();

                while($fila =  $resultado_visitas) {
                    dd($fila);
                    $codbanner= $fila['codBanner'];
                    $codprograma= $programa_homologante;
                    $codmateria= $fila['codMateria'];
                    $materias_vistas[$contacor_vistas]= strtoupper($codmateria);
                    $contacor_vistas++;
                }
                $materias_vistas = $materias_vistas;
                //var_dump($materias_vistas);

                //echo "Programa:" . $codprograma . "<br />";
                //echo "Cod Banner: " .  $codbanner . "<br />";
                //exit();



                // Materias del programa
                $consulta_baseacademica = 'SELECT codigoCurso FROM mallaCurricular WHERE codprograma="'.$codprograma.'"  ORDER BY semestre, orden, ciclo DESC;';
                //echo $consulta_baseacademica . "<br />";
                //exit();

                $resultado_baseacademica = DB::select($consulta_baseacademica);


                $orden=1;
                while($fila = $resultado_baseacademica) {
                    $codcurso= $fila['codigoCurso'];

                    //echo "CodCurs: " . $codcurso . "<br />";
                    //var_dump($materias_vistas);
                    //exit();

                    if (!in_array($codcurso, $materias_vistas)) {
                        $insert_porver = 'INSERT INTO materias_porver (id, codBanner, codMateria, orden, codprograma) VALUES (NULL, '.$codbanner.', "'.$codcurso.'", '.$orden.', "'.$programa_homologante.'");';
                        echo $insert_porver . "<br />";

                        $resultado_porver = DB::select($insert_porver);
                        //echo $insert_porver . "<br />";
                        $orden++;
                    }
                }
                echo "<br />Insertadas las materias por ver de: " . $codbanner;


                $update_homologante = 'UPDATE homologantes SET materias_faltantes="OK" WHERE homologantes.id='.$id_homologante.';';
                $resultado_updatehomologante =DB::select($update_homologante);


            endforeach;
        });





        /**utilizamos la función array_filter() y in_array() para filtrar los elementos de $array1 que existen en $array2. El resultado se almacena en $intersection. Luego, verificamos si $intersection contiene al menos un elemento utilizando count($intersection) > 0. */

        //    $intersection = array_filter($array1, function ($item) use ($array2) {
        //         return in_array($item, $array2);
        //     });


        //     $diff = array_udiff($array1, $array2, function($a, $b) {
        //         return $a['name'] <=> $b['name'];
        //     });
        //     dd($diff);




        die();




    }
}
