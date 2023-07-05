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

        /*$estudiantesAntiguos = $this->faltantesAntiguos()->chunk(200);
        foreach ($estudiantesAntiguos as $keys => $estudiantes) :
            foreach ($estudiantes as $key => $estudiante) :
                dd($estudiante);
            endforeach;
        endforeach;*/
        $log = DB::table('logAplicacion')->where([['accion', '=', 'Insert-Antiguo'], ['tabla_afectada', '=', 'materiasPorVer']])->orderBy('id', 'desc')->first();
        if (empty($log)) :
            //$estudiantesAntiguos = $this->faltantesAntiguos();
            $estudiantesAntiguos = $this->faltantesAntiguos()->chunk(200);
            else :
            return "No hay estudiantes de primer ingreso";
        endif;

        if(!empty($estudiantesAntiguos)):
            //dd($estudiantesAntiguos[0]->id);
            $fechaInicio = date('Y-m-d H:i:s');
            $registroMPV = 0;
            dd($estudiantesAntiguos[0][0]->id);
            $primerId = $estudiantesAntiguos[0][0]->id;
            $ultimoRegistroId = 0;
            //foreach($estudiantesAntiguos as $key => $estudiante):
            foreach ($estudiantesAntiguos as $keys => $estudiantes) :
                foreach ($estudiantes as $key => $estudiante) :
                    //dd($estudiante);

                    $historial = $this->historialAcademico($estudiante->homologante);
                    $mallaCurricular = $this->BaseAcademica($historial['programa']);
                    foreach ($mallaCurricular as $key => $malla) :
                        foreach ($malla as $key => $value) :
                            if (!in_array($value->codigoCurso, $historial['materias'])) :
                                $insertMateriaPorVer = MateriasPorVer::create([
                                    "codBanner"      => $estudiante->homologante,
                                    "codMateria"      => $value->codigoCurso,
                                    "orden"      => $value->orden,
                                    "codprograma"      => $value->codprograma,
                                ]);
                            endif;
                            $registroMPV++;
                        endforeach;
                    endforeach;
                    $ultimoRegistroId = $estudiante->id;
                    $idBannerUltimoRegistro = $estudiante->homologante;
                endforeach;
            endforeach;
            //endforeach;
            $fechaFin = date('Y-m-d H:i:s');
            $insertLog = LogAplicacion::create([
                'idInicio' => $primerId,
                'idFin' => $ultimoRegistroId,
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'accion' => 'Insert-Antiguo',
                'tabla_afectada' => 'materiasPorVer',
                'descripcion' => 'Se realizo la insercion en la tabla materiasPorVer insertando las materias por ver del estudiante antiguo, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $registroMPV . ' registros',
            ]);

            $insertIndiceCambio = IndiceCambiosMafi::create([
                'idbanner' => $idBannerUltimoRegistro,
                'accion' => 'Insert-Antiguo',
                'descripcion' => 'Se realizo la insercion en la tabla materiasPorVer insertando las materias por ver del estudiante antiguo, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $registroMPV . ' registros',
                'fecha' => date('Y-m-d H:i:s'),
            ]);
            echo $registroMPV . "-Fecha Inicio: " . $fechaInicio . "Fecha Fin: " . $fechaFin;
        else:
            return "No hay estudiantes ANTIGUOS";
        endif;
        die();

        $log = DB::table('logAplicacion')->where([['accion', '=', 'Insert-Transferente'], ['tabla_afectada', '=', 'materiasPorVer']])->orderBy('id', 'desc')->first();
        if (empty($log)) :
            $transferente = $this->falatntesTranferentes();
        else :
            return "No hay estudiantes de primer ingreso";
        endif;

        //dd($transferente[0]->id);
        if (!empty($transferente)) :
            $fechaInicio = date('Y-m-d H:i:s');
            $registroMPV = 0;
            $primerId = $transferente[0]->id;
            $ultimoRegistroId = 0;
            foreach ($transferente as $estudiante) :
                $historial = $this->historialAcademico($estudiante->homologante);
                //dd($historial['programa'][0]);

                $mallaCurricular = $this->BaseAcademica($historial['programa']);
                //dd($mallaCurricular[0][21]);
                foreach ($mallaCurricular as $key => $malla) :
                    foreach ($malla as $key => $value) :
                        //dd($value);
                        if (!in_array($value->codigoCurso, $historial['materias'])) :
                            $insertMateriaPorVer = MateriasPorVer::create([
                                "codBanner"      => $estudiante->homologante,
                                "codMateria"      => $value->codigoCurso,
                                "orden"      => $value->orden,
                                "codprograma"      => $value->codprograma,
                            ]);
                        endif;
                        $registroMPV++;
                    endforeach;
                endforeach;
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
            return "No hay estudiantes TRANSFERENTES";
        endif;
        $log = DB::table('logAplicacion')->where([['accion', '=', 'Insert-PrimerIngreso'], ['tabla_afectada', '=', 'materiasPorVer']])->orderBy('id', 'desc')->first();
        if (empty($log)) :
            $primerIngreso =  $this->falatntesPrimerIngreso();
        else :
            return "No hay estudiantes de primer ingreso";
        endif;
        //dd($log);
        if (!empty($primerIngreso)) :
            $fechaInicio = date('Y-m-d H:i:s');
            $registroMPV = 0;
            $primerId = $primerIngreso[0]->id;
            $ultimoRegistroId = 0;
            foreach ($primerIngreso as $estudiante) :

                $mallaCurricular = $this->BaseAcademica($estudiante->programa);
                //dd($mallaCurricular);
                foreach ($mallaCurricular as $key => $malla) :
                    foreach ($malla as $key => $value) :
                        $insertMateriaPorVer = MateriasPorVer::create([
                            "codBanner"      => $estudiante->homologante,
                            "codMateria"      => $value->codigoCurso,
                            "orden"      => $value->orden,
                            "codprograma"      => $value->codprograma,
                        ]);
                        $registroMPV++;
                    endforeach;
                endforeach;
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
                'descripcion' => 'Se realizo la insercion en la tabla materiasPorVer insertando las materias por ver del estudiante de primer ingreso, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $registroMPV . ' registros',
            ]);

            $insertIndiceCambio = IndiceCambiosMafi::create([
                'idbanner' => $idBannerUltimoRegistro,
                'accion' => 'Insert-PrimerIngreso',
                'descripcion' => 'Se realizo la insercion en la tabla materiasPorVer insertando las materias por ver del estudiante de primer ingreso, iniciando en el id ' . $primerId . ' y terminando en el id ' . $ultimoRegistroId . ',insertando ' . $registroMPV . ' registros',
                'fecha' => date('Y-m-d H:i:s'),
            ]);
            echo $registroMPV . "-Fecha Inicio: " . $fechaInicio . "Fecha Fin: " . $fechaFin;
        else :
            return "No hay estudiantes de primer ingreso";
        endif;
        $this->periodo();
        $log = DB::table('logAplicacion')->where([['accion', '=', 'Insert'], ['tabla_afectada', '=', 'estudiantes']])->orderBy('id', 'desc')->first();
        //return $log;
        if (empty($log)) :
            $data = DB::table('datosMafiReplica')
                ->join('programas', 'datosMafiReplica.programa', '=', 'programas.codprograma')
                ->join('periodo', 'datosMafiReplica.periodo', '=', 'periodo.periodos')
                ->select('datosMafiReplica.*', 'programas.activo AS programaActivo')
                ->where([['periodo.periodoActivo', '=', 1]])
                ->orderBy('datosMafiReplica.id')
                ->get()
                ->chunk(200);
        else :
        endif;
        //dd($data);

        if (!empty($data[0])) :
            $numeroRegistros = 0;
            $numeroRegistrosAlertas = 0;
            $primerId = $data[0][0]->id;
            $ultimoRegistroId = 0;
            $fechaInicio = date('Y-m-d H:i:s');
            foreach ($data as $keys => $estudiantes) :
                foreach ($estudiantes as $key => $value) :
                    if (str_contains($value->tipoestudiante, 'TRANSFERENTE EXTERNO') || str_contains($value->tipoestudiante, 'TRANSFERENTE INTERNO')) :
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
                                    'materias_faltantes' => "OK",
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
                                    'materias_faltantes' => "OK",
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
                                    'materias_faltantes' => "OK",
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
                                    'materias_faltantes' => "OK",
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
                                'materias_faltantes' => "OK",
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
                                'materias_faltantes' => "OK",
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
            return "No hay registros para replicar";
        endif;
    }

    public function falatntesPrimerIngreso()
    {
        $estudiantesPrimerIngreso = DB::table('estudiantes')
            ->where('tipo_estudiante', 'LIKE', 'PRIMER%')
            ->whereNull('programaActivo')
            ->orderBy('id')
            ->get();

        return $estudiantesPrimerIngreso;
    }

    public function falatntesTranferentes()
    {
        $estudiantesPrimerIngreso = DB::table('estudiantes')
            ->where('tipo_estudiante', 'LIKE', 'TRANSFERENTE%')
            ->whereNull('programaActivo')
            ->whereNull('tiene_historial')
            ->orderBy('id')
            ->get();

        return $estudiantesPrimerIngreso;
    }

    public function faltantesAntiguos()
    {
        $estudiantesAntiguos = DB::table('estudiantes')
            ->where('tipo_estudiante', 'LIKE', 'ESTUDIANTE ANTIGUO%')
            ->whereNull('programaActivo')
            ->orderBy('id')
            ->get();


        return $estudiantesAntiguos;
    }

    public function BaseAcademica($programa)
    {
        //Obtener la base academica del programa seleccionado
        if (!is_array($programa)) :
            $programa = [
                '0' => $programa,
            ];
        endif;
        //dd($programa);
        foreach ($programa as $value) :
            $mallaCurricular[] = DB::table('mallaCurricular')
                ->join('programas', 'programas.codprograma', '=', 'mallaCurricular.codprograma')
                ->select('mallaCurricular.codigoCurso', 'mallaCurricular.orden', 'mallaCurricular.codprograma')
                ->where([['programas.activo', '=', 1], ['mallaCurricular.codprograma', '=', $value]])
                ->orderBy('semestre', 'asc')
                ->orderBy('orden', 'asc')
                ->get();

        endforeach;
        //dd($mallaCurricular);
        return $mallaCurricular;
    }


    public function historialAcademico($idBanner)
    {
        $contacor_vistas = 0;
        $materias_vista = array();
        $programa = array();
        $historial = DB::table('historialAcademico')
            ->select('codMateria', 'codprograma')
            ->where('codBanner', '=', $idBanner)
            ->get();
        foreach ($historial as $key => $value) :
            $materias_vistas[$contacor_vistas] = strtoupper($value->codMateria);
            $programa[$value->codprograma] = $value->codprograma;
            $contacor_vistas++;
        endforeach;

        if (empty($materias_vistas)) {

            dd($idBanner);
        }


        //dd($materias_vistas);

        $data = [
            'materias' => $materias_vistas,
            'programa' => $programa,
        ];

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



          // WHERE materias_faltantes="OK"
            // AND programado_ciclo1 IS NULL
            // AND programado_ciclo2   IS NULL
            // AND programa="PCPV"
            // AND marca_ingreso IN (202305,202312,202332,202342,202352,202306,202313,202333,202343,202353)
            // AND tipo_estudiante!="XXXXX"
            // ORDER BY id ASC
            // LIMIT 20000;

        // Estudiantes para generar faltantes
        $consulta_homologante= DB::table('estudiantes')
            ->select('id', 'homologante', 'programa')
            ->where('materias_faltantes','OK')
            ->whereNull('programado_ciclo1')
            ->whereNull('programado_ciclo2')
            ->where('programa','PCPV')
            ->whereIn('marca_ingreso',$marcaIngreso)
            ->get();


        if(!$consulta_homologante) {
            die("Error: no se pudo realizar la consulta homologantes 1");
            exit();
        }

        foreach ($consulta_homologante as $key => $value) {

            $id_homologante=$value->id;
            $codHomologante=$value->homologante;
            $programa_homologante=$value->programa;


            // Materias que debe ver el estudiante
            // $consulta_porver = 'SELECT mv.codBanner, mv.codMateria, mv.orden, ba.creditos, ba.ciclo FROM materiasPorVer mv INNER JOIN mallaCurricular ba ON mv.codMateria=ba.codigoCurso WHERE codBanner='.$codHomologante.' AND ba.ciclo IN (1, 12) AND mv.codprograma = "'.$programa_homologante.'" AND ba.codprograma = "'.$programa_homologante.'" ORDER BY mv.orden ASC';

                /*select materiasPorVer.codBanner,materiasPorVer.codMateria,materiasPorVer.orden,mallaCurricular.creditos,mallaCurricular.ciclo
                from
                `materiasPorVer`
                inner join `mallaCurricular` on `materiasPorVer`.`codMateria` = `mallaCurricular`.`codigoCurso`
                where
                `codBanner` = 100152879
                and mallaCurricular.ciclo   in (1, 12)
                and materiasPorVer.codprograma= 'PPSV'
                and mallaCurricular.codprograma = 'PPSV'
                order by
                materiasPorVer.orden ASC;*/


            $consulta_porver= DB::table('materiasPorVer')
            ->join('mallaCurricular ', 'materiasPorVer.codMateria', '=', 'mallaCurricular.codigoCurso')
            ->select('materiasPorVer.codBanner', 'materiasPorVer.codMateria', 'materiasPorVer.orden' ,'mallaCurricular.creditos', 'mallaCurricular.ciclo ')
            ->where('materiasPorVer.codBanner','100152879')
            ->whereIn('mallaCurricular.ciclo',[1,12])
            ->where('materiasPorVer.codprograma',"PPSV")
            ->where('mallaCurricular.codprograma',"PPSV")
            ->orderBy('materiasPorVer.orden', 'ASC')
            ->get();


            dd( $consulta_porver);
        }

        while($homologantes =$consulta_homologante) {

            $consulta_porver = 'SELECT mv.codBanner, mv.codMateria, mv.orden, ba.creditos, ba.ciclo FROM materias_porver mv INNER JOIN base_acdemica ba ON mv.codMateria=ba.codigoCurso WHERE codBanner='.$codHomologante.' AND ba.ciclo IN (1, 12) AND mv.codprograma = "'.$programa_homologante.'" AND ba.codprograma = "'.$programa_homologante.'" ORDER BY mv.orden ASC';

            //echo "Materias por ver de: " . $codHomologante . " -> " . $consulta_porver . "<br />";
            //exit();

            // No. de creditos para el homologante
            $consulta_sumacreditos = 'SELECT p.codBanner, SUM(ba.creditos) AS CreditosPlaneados FROM base_acdemica ba INNER JOIN planeacion p ON ba.codigoCurso=p.codMateria WHERE p.codBanner='. $codHomologante .' group by p.codbanner ';
            //echo "Consulta creditos aprobados de : " . $codHomologante . " -> " .  $consulta_sumacreditos . "<br />";
            //exit();
            $resultado_sumacreditos = mysql_query($consulta_sumacreditos, $link);
            $filas = mysql_fetch_assoc($resultado_sumacreditos);
            $creditos_homologantes = $filas['CreditosPlaneados'];
            //echo "creditos planeados antes:  " . $creditos_homologantes;
            $creditos_homologantes = $creditos_homologantes=='' ? "0" : $creditos_homologantes;
            //echo "  creditos planeados después: " . $creditos_homologantes;
            //exit();

            // Crécitos ciclo 1
            $consulta_creditos_C1 = 'SELECT SUM(ba.creditos) screditos, COUNT(ba.creditos) ccursos  FROM `planeacion` p INNER JOIN base_acdemica ba ON ba.codigoCurso=p.CodMateria where p.codBanner='. $codHomologante .' AND ba.ciclo IN (1, 12)';

            //echo "consulta_creditos_C1 " . $consulta_creditos_C1;
            //exit();

            $resultado_creditos_ciclo1 = mysql_query($consulta_creditos_C1, $link);
            //echo "  creditos planeados ciclo 1: " . $consulta_creditos_C1;
            $fila_creditos_ciclo1 = mysql_fetch_assoc($resultado_creditos_ciclo1);
            @ $cuenta_cursos_ciclo1 = $cuenta_cursos_cre1['ccursos'];
            @ $suma_creditos_ciclo1 = $suma_creditos_ciclo1['screditos'];
            @ $cuenta_cursos_ciclo1 = $cuenta_cursos_ciclo1=='' ? "0" : $cuenta_cursos_ciclo1;
            @ $suma_creditos_ciclo1 = $suma_creditos_ciclo1=='' ? "0" : $suma_creditos_ciclo1;

            //echo "<br />- suma créditos ciclo 1:  " . $suma_creditos_ciclo1 . " - cuenta cursos ciclo 1: " . $cuenta_cursos_ciclo1 . "<br />";
            //exit();

            //echo $consulta_porver;
            //exit();
            $resultado_porver = mysql_query($consulta_porver, $link);
            if(!$resultado_porver) {
                die("Error 69: no se pudo realizar la consulta materias por ver de " . $codHomologante);
                exit();
            }
            $orden2=1;

        /*
        PEEV	LIC EDUC ESPECIAL VIRTUAL
        PPIV	LIC. EN PEDAG INFANTIL VIRTUAL
        PLIV	LIC EN EDUCACION INFANTIL VIR
        PPSV	PSICOLOGIA VIRTUAL
        PCPV	CONTADURIA PUBLICA VIRTUAL
        PNIV	NEGOCIOS INTERNACIONALES VIR
        PECV	ECONOMIA VIRT
        PAEV	ADMINISTRACIÓN DE EMPRESAS VIR
        PII		INGENIERIA INDUSTRIAL VIRT
        PISV	INGENIERIA DE SOFTWARE VIRT
        GLV		Tec Logística
        PSSV	Ing. de sistemas
        PICD	Inc. Ciencia de datos
        PLMA	Lic en matemáticas
        PASV	ADMINISTRACION EN SALUD VIR
        PDFV 	ADMINISTRACION FINANCIERA VIR
        */


        // PLMA: Todos ven 6 en ciclo 1
        // PEEV: 5 en ciclo 1
        // PPIV: 5 en ciclo 1
        // PLCV: 5 en ciclo 1
        // PLIV: 5 en ciclo 1
            if ($programa_homologante== 'PPIV' || $programa_homologante== 'PEEV' ||  $programa_homologante == 'PLIV' ||  $programa_homologante == 'PLMA' ||  $programa_homologante == 'PLCV'){
                $num_creditos=18;
                $num_materias=5;

        //PMPV: Todos ven 4 materias en ciclo 1
        //PPSV
        //PNIV: 4 en ciclo 1
            } elseif ($programa_homologante== 'PCPV' || $programa_homologante== 'PECV' || $programa_homologante== 'PNIV' || $programa_homologante== 'PAEV' || $programa_homologante== 'PPSV'   || $programa_homologante=='PMPV' || $programa_homologante=='PDFV'){
                $num_creditos=18;




                $num_materias=4;

        // PII Ruta SENA 22 Diego Ramirez 20 Dic - Cambia Información OScar Gauldron
        // PII Todos ven 5 en ciclo 1
        // PICD: Todos ven  4 en ciclo 1
        // PSSV: Todos ven 5 en ciclo 1
        // PISV2: Todos ven  4 en ciclo 1
        // GLV: Primer ingreso 3 en ciclo 1. El resto 4
            } elseif ($programa_homologante== 'PII2' ||  $programa_homologante == 'PISV'  || $programa_homologante== 'GLV'  || $programa_homologante== 'PSSV'  || $programa_homologante== 'PICD2'){
                $num_creditos=18;
                $num_materias=5;

        // PASV: Dos ven 4 en ciclo 2 Ivon correo 12 de abril 2023
        // PSTV: Dos ven 4 en ciclo 2 Ivon correo 12 de abril 2023
        // Todos los homologantes deben ser programados con 19 créditos
            } elseif ($programa_homologante== 'PASV' || $programa_homologante== 'PSTV' ){
                $num_creditos=18;
                $num_materias=4;
            }


            while($fila = mysql_fetch_assoc($resultado_porver)) {
                $codBanner= $fila['codBanner'];
                $codMateria = $fila['codMateria'];	//EEV22022=2	EEV22003=0    PIV22012=1 //
                $creditoMateria = $fila['creditos'];	//EEV22022=2	EEV22003=0    PIV22012=1 //
                $ciclo= $fila['ciclo'];

                //echo "Cod Materia: " . $codMateria . " Credito de la materia: " . $creditoMateria . "<br />";
                //exit();
                $consulta_prerequisitos = 'SELECT prerequisito FROM base_acdemica WHERE codigoCurso="'.$codMateria.'" AND codprograma = "'.$programa_homologante.'";';
                //echo "Consulta preequisitos de : " . $codMateria . " -> " .  $consulta_prerequisitos . "<br />";
                // exit();
                $resultado_prerequisitos = mysql_query($consulta_prerequisitos, $link);
                $filas = mysql_fetch_assoc($resultado_prerequisitos);
                $prerequisitos = $filas['prerequisito'];
                //echo $prerequisitos;

                /*
                echo "prerequisito: " . $prerequisitos . "  ciclo: " . $ciclo . "Cuenta ciclos " . $cuenta_cursos_ciclo1;
                exit();
                */

                if($prerequisitos=='' && $ciclo!=2 && $cuenta_cursos_ciclo1<$num_materias) {
                    //echo "vacio";
                    $consulta_estaenplaneacion = 'SELECT codMateria FROM planeacion WHERE codMateria="'.$codMateria.'" AND  	codBanner="'.$codBanner.'";';
                    //echo $consulta_estaenplaneacion;
                    $codBanner=$codBanner;
                    $resultado_planeacion = mysql_query($consulta_estaenplaneacion, $link);
                    $filas_planeada = mysql_fetch_assoc($resultado_planeacion);
                    $planeada = $filas_planeada['prerequisito'];
                    if($planeada=='' && $creditos_homologantes<$num_creditos) {
                        $creditos_homologantes = $creditos_homologantes + $creditoMateria;
                        $insert_planeada = 'INSERT INTO planeacion (id, codBanner, codMateria, orden, semestre, programada, codprograma) VALUES (NULL, '.$codBanner.', "'.$codMateria.'", '.$orden2.',"1", "", "'.$programa_homologante.'");';
                        $resultado_planeada = mysql_query($insert_planeada, $link);
                        $cuenta_cursos_ciclo1++;
                        //echo "1  " . $insert_planeada . "<br />";
                        //exit();
                        //echo "Actualziado Crd Hom:" . $creditos_homologantes . "<br />";
                    }
                } else {
                    //echo "Con prerequisito <br />";
                    $consulta_estaenplaneacion = 'SELECT codMateria FROM planeacion WHERE codMateria IN ("'.$prerequisitos.'") AND codBanner="'.$codBanner.'";';
                    $resultado_estaenplaneacion = mysql_query($consulta_estaenplaneacion, $link);
                    //echo "Consulta de prerequisitos para estudiante y materia específica: " . $consulta_estaenplaneacion;
                    @ $prerequisito_programado=$filas = mysql_fetch_assoc($resultado_estaenplaneacion);
                    $preprogramado = $filas['codMateria'];
                    //echo "<br />está programado: " . $preprogramado. "<br />";
                    //exit ();

                    $consulta_estaporver = 'SELECT codMateria FROM materias_porver WHERE codMateria IN ("'.$prerequisitos.'") AND codBanner="'.$codBanner.'" ORDER BY id ASC;';
                    $resultado_estaporver = mysql_query($consulta_estaporver, $link);
                    //echo "Consulta de prerequisitos para estudiante y materia específica: " . $consulta_estaporver;
                    @ $prerequisito_estaporver=$filaspv = mysql_fetch_assoc($resultado_estaporver);
                    $estaporver = $filaspv['codMateria'];


                    if($preprogramado=='' && $estaporver=='' && $ciclo!=2 && $cuenta_cursos_ciclo1<$num_materias) {
                        $creditos_homologantes = $creditos_homologantes + $creditoMateria;
                        $insert_planeada = 'INSERT INTO planeacion (id, codBanner, codMateria, orden, semestre, programada, codprograma) VALUES (NULL, '.$codBanner.', "'.$codMateria.'", '.$orden2.',"1", "", "'.$programa_homologante.'");';
                        $resultado_planeada = mysql_query($insert_planeada, $link);
                        $cuenta_cursos_ciclo1++;
                        // echo "22  " . $insert_planeada . "<br />";
                        // exit();
                        //echo "Actualziado Crdeditos Hom:" . $creditos_homologantes . "<br />";
                    }
                }
                $orden2++;
            $update_homologante = 'UPDATE homologantes SET programado_ciclo1="OK" WHERE homologantes.id='.$id_homologante.';';
            $resultado_updatehomologante = mysql_query($update_homologante, $link);
            echo "Planeación realizada para : " . $codBanner . " y " . $codMateria . "<br />";

            }
        }
    }
}
