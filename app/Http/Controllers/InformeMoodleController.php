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
use DateTime;
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

    public function riesgo()
    {

        $riesgos = DB::table('datos_moodle')->selectRaw('COUNT(Id_Banner) AS TOTAL, Riesgo')->groupBy('Riesgo')->get();

        $alto = [];
        $medio = [];
        $bajo = [];

        foreach ($riesgos as $key) {
            $riesgo = $key->Riesgo;
            if ($riesgo == 'ALTO') {
                $alto[] = $key->TOTAL;
            }
            if ($riesgo == 'MEDIO') {
                $medio[] = $key->TOTAL;
            }
            if ($riesgo == 'BAJO') {
                $bajo[] = $key->TOTAL;
            }
        }

        $Total = DB::table('datos_moodle')->selectRaw('COUNT(Id_Banner) AS TOTAL')->get();

        $datos = array(
            'alto' => $alto,
            'medio' => $medio,
            'bajo' => $bajo,
            'total' => $Total[0]->TOTAL
        );
        return $datos;
    }

    public function riesgoFacultad(Request $request)
    {

        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $riesgos = DB::table('datos_moodle')
            ->selectRaw('COUNT(Id_Banner) AS TOTAL, Riesgo')
            ->whereIn('Facultad', $facultades)
            ->whereIn('Periodo_Rev', $periodos)
            ->groupBy('Riesgo')
            ->get();

        $alto = [];
        $medio = [];
        $bajo = [];

        foreach ($riesgos as $key) {
            $riesgo = $key->Riesgo;
            if ($riesgo == 'ALTO') {
                $alto[] = $key->TOTAL;
            }
            if ($riesgo == 'MEDIO') {
                $medio[] = $key->TOTAL;
            }
            if ($riesgo == 'BAJO') {
                $bajo[] = $key->TOTAL;
            }
        }

        $Total = DB::table('datos_moodle')
            ->whereIn('Facultad', $facultades)
            ->whereIn('Periodo_Rev', $periodos)
            ->selectRaw('COUNT(Id_Banner) AS TOTAL')->get();

        $datos = array(
            'alto' => $alto,
            'medio' => $medio,
            'bajo' => $bajo,
            'total' => $Total[0]->TOTAL
        );
        return $datos;
    }

    public function riesgoPrograma(Request $request)
    {

        $programas = $request->input('programa');
        $periodos = $request->input('periodos');

        $riesgos = DB::table('datos_moodle AS dm')
            ->join('programas AS p', 'dm.Programa', '=', 'p.programa')
            ->whereIn('p.codprograma', $programas)
            ->whereIn('dm.Periodo_Rev', $periodos)
            ->selectRaw('COUNT(dm.Id_Banner) AS TOTAL, dm.Riesgo')
            ->groupBy('dm.Riesgo')
            ->get();

        $alto = [];
        $medio = [];
        $bajo = [];

        foreach ($riesgos as $key) {
            $riesgo = $key->Riesgo;
            if ($riesgo == 'ALTO') {
                $alto[] = $key->TOTAL;
            }
            if ($riesgo == 'MEDIO') {
                $medio[] = $key->TOTAL;
            }
            if ($riesgo == 'BAJO') {
                $bajo[] = $key->TOTAL;
            }
        }

        $Total = DB::table('datos_moodle AS dm')
            ->join('programas AS p', 'dm.Programa', '=', 'p.programa')
            ->whereIn('p.codprograma', $programas)
            ->whereIn('dm.Periodo_Rev', $periodos)
            ->selectRaw('COUNT(dm.Id_Banner) AS TOTAL')
            ->get();

        $datos = array(
            'alto' => $alto,
            'medio' => $medio,
            'bajo' => $bajo,
            'total' => $Total[0]->TOTAL
        );
        return $datos;
    }

    function estudiantesRiesgo($riesgo)
    {
        $riesgo = trim($riesgo);
        $estudiantes = DB::table('datos_moodle')
            ->select('Id_Banner', 'Riesgo', 'Nombre', 'Apellido', 'Facultad', 'Programa')
            ->where('Riesgo', $riesgo)
            ->groupBy('Id_Banner')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    function estudiantesRiesgoFacultad(Request $request, $riesgo)
    {
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $riesgo = trim($riesgo);
        $estudiantes = DB::table('datos_moodle')
            ->where('Riesgo', $riesgo)
            ->whereIn('Facultad', $facultades)
            ->whereIn('Periodo_Rev', $periodos)
            ->select('Id_Banner', 'Nombre', 'Apellido', 'Facultad', 'Programa')
            ->distinct()
            ->groupBy('Id_Banner')
            ->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    function estudiantesRiesgoPrograma(Request $request, $riesgo)
    {
        $programas = $request->input('programa');
        $periodos = $request->input('periodos');
        $riesgo = trim($riesgo);
        $estudiantes = DB::table('datos_moodle AS dm')
            ->join('programas AS p', 'dm.Programa', '=', 'p.programa')
            ->whereIn('p.codprograma', $programas)
            ->whereIn('dm.Periodo_Rev', $periodos)
            ->where('Riesgo', $riesgo)
            ->select('dm.Id_Banner', 'dm.Nombre', 'dm.Apellido', 'dm.Facultad', 'dm.Programa')
            ->distinct()
            ->groupBy('dm.Id_Banner')
            ->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    function dataAlumno(Request $request)
    {
        $idBanner = $request->input('idBanner');
        $data = DB::table('datos_moodle')->where('Id_Banner', $idBanner)->select('*')
            ->groupBy('Nombrecurso')
            ->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $data));
    }

    function riesgoAsistencia(Request $request)
    {

        $idBanner = $request->input('idBanner');
        $bajo = [];
        $medio = [];
        $alto = [];
        $riesgos = DB::table('datos_moodle')->where('Id_Banner', $idBanner)->select('Riesgo', 'Nombrecurso')
            ->groupBy('Nombrecurso')
            ->get();

        $totalRiesgo = DB::table('datos_moodle')
            ->where('Id_Banner', $idBanner)
            ->select(DB::raw("COALESCE(SUM(CASE WHEN Riesgo = 'ALTO' THEN 1 ELSE 0 END), 0) AS ALTO,
            COALESCE(SUM(CASE WHEN Riesgo = 'BAJO' THEN 1 ELSE 0 END), 0) AS BAJO,
            COALESCE(SUM(CASE WHEN Riesgo = 'MEDIO' THEN 1 ELSE 0 END), 0) AS MEDIO"))
            ->groupBy('nombreCurso')
            ->get();

        $contAlto = 0;
        $contBajo = 0;
        $contMedio = 0;


        foreach ($totalRiesgo as $total) {

            if ($total->ALTO >= 1) {
                $contAlto += 1;
            }
            if ($total->BAJO >= 1) {
                $contBajo += 1;
            }
            if ($total->MEDIO >= 1) {
                $contMedio += 1;
            }
        }
        $cursosRiesgo = [
            'ALTO' => $contAlto,
            'BAJO' => $contBajo,
            'MEDIO' => $contMedio,
        ];

        foreach ($riesgos as $riesgo) {
            $aux = $riesgo->Riesgo;
            $nombreCurso = $riesgo->Nombrecurso;
            $nombreCursoFormateado = trim(substr($nombreCurso, 0, strpos($nombreCurso, '(')));
            if (strlen($nombreCursoFormateado) > 35) {
                $nombreCursoFormateado = substr($nombreCursoFormateado, 0, 35) . '...';
            }
            if ($aux == 'ALTO') {
                $alto[] = $nombreCursoFormateado;
            } elseif ($aux == 'MEDIO') {
                $medio[] = $nombreCursoFormateado;
            } elseif ($aux == 'BAJO') {
                $bajo[] = $nombreCursoFormateado;
            }
        }

        if (empty($alto)) {
            $alto[] = 'Ninguno';
        }
        if (empty($medio)) {
            $medio[] = 'Ninguno';
        }
        if (empty($bajo)) {
            $bajo[] = 'Ninguno';
        }

        $Notas = DB::table('datos_moodle')
            ->where('Id_Banner', $idBanner)
            ->select(DB::raw("TRIM(SUBSTRING_INDEX(Nombrecurso, '(', 1)) AS nombreCurso, 
            Nota_Acumulada, Primer_Corte, Segundo_Corte, Tercer_Corte, FechaInicio, Duracion_8_16_Semanas"))
            ->groupBy('nombreCurso')
            ->get();

        $fechaActual = date("d-m-Y");
        $fechaObj1 = DateTime::createFromFormat("d-m-Y", $fechaActual);
        $definitivas = [];

        foreach ($Notas as $nota) {

            if ($nota->Primer_Corte != "Sin Actividad") {
                $nota1 = floatval($nota->Primer_Corte);
            } else {
                $nota1 = $nota->Primer_Corte;
            }

            if ($nota->Segundo_Corte != "Sin Actividad") {
                $nota2 = floatval($nota->Segundo_Corte);
            } else {
                $nota2 = $nota->Segundo_Corte;
            }

            if ($nota->Tercer_Corte != "Sin Actividad") {
                $nota3 = floatval($nota->Tercer_Corte);
            } else {
                $nota3 = $nota->Tercer_Corte;
            }

            $notaAcum = floatval($nota->Nota_Acumulada);

            $fechaInicio = (new DateTime($nota->FechaInicio))->format("d-m-Y");
            $nombre = $nota->nombreCurso;
            $duracion = $nota->Duracion_8_16_Semanas;
            $fechaObj2 = DateTime::createFromFormat("d-m-Y", $fechaInicio);
            $diferencia = $fechaObj1->diff($fechaObj2);
            $diasdif = $diferencia->days;

            /** Validación Notas */
            if ($nota1 != 0 && $nota2 != 0 && $nota3 != 0 && !in_array("Sin Actividad", [$nota1, $nota2, $nota3])) {
                $definitivas[$nombre] = $notaAcum;
            } else {
                if ($nota1 == 0 && $nota2 == 0 && $nota3 == 0 || in_array("Sin Actividad", [$nota1, $nota2, $nota3])) {
                    $definitivas[$nombre] = $notaAcum;
                } else {
                    if ($duracion == "8 SEMANAS") {
                        if ($nota1 != 0 && $nota2 != 0 && !in_array("Sin Actividad", [$nota1, $nota2])) {
                            if ($diasdif >= 56) {
                                if ($nota3 != "Sin Actividad") {
                                    $definitivas[$nombre] =  1.48 + $nota1 * 0.3 + $nota2 * 0.3;
                                } else {
                                    $definitivas[$nombre] =  $notaAcum;
                                }
                            } else {
                                $definitivas[$nombre] = $notaAcum * (10 / 6);
                            }
                        } else {
                            if ($nota1 != 0 && $nota1 != "Sin Actividad") {
                                if ($diasdif >= 42) {
                                    if ($nota2 != "Sin Actividad") {
                                        $definitivas[$nombre] =  $nota->Primer_Corte;
                                    } else {
                                        $definitivas[$nombre] =  $notaAcum;
                                    }
                                } else {
                                    $definitivas[$nombre] =  $nota1;
                                }
                            } else {
                                if ($nota1 == "Sin Actividad") {
                                    $definitivas[$nombre] =  $notaAcum;
                                }
                            }
                        }
                    } else {
                        if ($nota1 != 0 && $nota2 != 0 && !in_array("Sin Actividad", [$nota1, $nota2])) {
                            if ($diasdif >= 112) {
                                if ($nota3 != "Sin Actividad") {
                                    $definitivas[$nombre] =  1.48 + $nota1 * 0.3 + $nota2 * 0.3;
                                } else {
                                    $definitivas[$nombre] =  $notaAcum;
                                }
                            } else {
                                $definitivas[$nombre] = $notaAcum * (10 / 6);
                            }
                        } else {
                            if ($nota1 != 0 && $nota1 != "Sin Actividad") {
                                if ($diasdif >= 77) {
                                    if ($nota2 != "Sin Actividad") {
                                        $definitivas[$nombre] =  $nota->Primer_Corte;
                                    } else {
                                        $definitivas[$nombre] =  $notaAcum;
                                    }
                                } else {
                                    $definitivas[$nombre] =  $nota1;
                                }
                            } else {
                                if ($nota1 == "Sin Actividad") {
                                    $definitivas[$nombre] =  $notaAcum;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = array(
            'alto' => $alto,
            'medio' => $medio,
            'bajo' => $bajo,
            'total' => $cursosRiesgo,
            'notas' => $definitivas,
        );

        header("Content-Type: application/json");
        echo json_encode(array('data' => $datos));
    }

    function tablaCursos()
    {

        /**
         * SELECT Nombrecurso, IdCurso, NombreTutor, COUNT(id), Grupo  FROM `datos_moodle`  
            WHERE Nombrecurso LIKE '%Estadística descriptiva%'
            GROUP BY IdCurso,Grupo 
            ORDER BY IdCurso;
         */

        $consultaCursos = DB::table('datos_moodle')
            ->select('Nombrecurso', 'IdCurso', 'NombreTutor', DB::raw('COUNT(id) AS TOTAL'))
            ->groupBy('IdCurso')
            ->get()
            ->toArray();

        foreach ($consultaCursos as $Curso) {
            $id = $Curso->IdCurso;
            $total = $Curso->TOTAL;

            $consultaSello = DB::table('datos_moodle')
                ->where('IdCurso', $id)
                ->where('Sello', 'TIENE SELLO FINANCIERO')
                ->select(DB::raw('COUNT(id) AS TOTAL'))
                ->get();

            $sello = $consultaSello[0]->TOTAL;

            $consultaASP = DB::table('datos_moodle')
                ->where('IdCurso', $id)
                ->where('Sello', 'TIENE RETENCION')
                ->select(DB::raw('COUNT(id) AS TOTAL'))
                ->get();

            $ASP = $consultaASP[0]->TOTAL;
            $inactivos = $total - $sello - $ASP;

            $consultaGrupos =  DB::table('datos_moodle')->where('IdCurso', $id)->selectRaw('COUNT(Grupo) AS TOTAL')->groupBy('Grupo')->get();

            $grupo = $consultaGrupos->count();

            $datos[] = [
                'NombreCurso' => $Curso->Nombrecurso,
                'id' => $id,
                'Tutor' => $Curso->NombreTutor,
                'Total' => $total,
                'Sello' => $sello,
                'ASP' => $ASP,
                'Inactivo' => $inactivos,
                'Cursos' => $grupo
            ];
        }

        return $datos;
    }

    function tablaCursosFacultad()
    {

        /**
         * SELECT Nombrecurso, IdCurso, NombreTutor, COUNT(id), Grupo  FROM `datos_moodle`  
            WHERE Nombrecurso LIKE '%Estadística descriptiva%'
            GROUP BY IdCurso,Grupo 
            ORDER BY IdCurso;
         */

        $periodos = $_POST['periodos'];
        $facultades = $_POST['idfacultad'];
        $consultaCursos = DB::table('datos_moodle')
            ->whereIn('Periodo_Rev', $periodos)
            ->whereIn('Facultad', $facultades)
            ->select('Nombrecurso', 'IdCurso', 'NombreTutor', DB::raw('COUNT(id) AS TOTAL'))
            ->groupBy('IdCurso')
            ->get()
            ->toArray();

        foreach ($consultaCursos as $Curso) {
            $id = $Curso->IdCurso;
            $total = $Curso->TOTAL;

            $consultaSello = DB::table('datos_moodle')
                ->where('IdCurso', $id)
                ->whereIn('Periodo_Rev', $periodos)
                ->whereIn('Facultad', $facultades)
                ->where('Sello', 'TIENE SELLO FINANCIERO')
                ->select(DB::raw('COUNT(id) AS TOTAL'))
                ->get();

            $sello = $consultaSello[0]->TOTAL;

            $consultaASP = DB::table('datos_moodle')
                ->where('IdCurso', $id)
                ->where('Sello', 'TIENE RETENCION')
                ->whereIn('Periodo_Rev', $periodos)
                ->whereIn('Facultad', $facultades)
                ->select(DB::raw('COUNT(id) AS TOTAL'))
                ->get();

            $ASP = $consultaASP[0]->TOTAL;
            $inactivos = $total - $sello - $ASP;

            $consultaGrupos =  DB::table('datos_moodle')->where('IdCurso', $id)
                ->whereIn('Periodo_Rev', $periodos)
                ->whereIn('Facultad', $facultades)
                ->selectRaw('COUNT(Grupo) AS TOTAL')->groupBy('Grupo')->get();

            $grupo = $consultaGrupos->count();

            $datos[] = [
                'NombreCurso' => $Curso->Nombrecurso,
                'id' => $id,
                'Tutor' => $Curso->NombreTutor,
                'Total' => $total,
                'Sello' => $sello,
                'ASP' => $ASP,
                'Inactivo' => $inactivos,
                'Cursos' => $grupo
            ];
        }

        return $datos;
    }

    function tablaCursosProgramas()
    {

        /**
         * SELECT Nombrecurso, IdCurso, NombreTutor, COUNT(id), Grupo  FROM `datos_moodle`  
            WHERE Nombrecurso LIKE '%Estadística descriptiva%'
            GROUP BY IdCurso,Grupo 
            ORDER BY IdCurso;
         */

        $periodos = $_POST['periodos'];
        $programas = $_POST['programa'];
        $consultaCursos = DB::table('datos_moodle as d')
            ->join('programas as p','d.Programa', '=', 'p.programa')
            ->whereIn('d.Periodo_Rev', $periodos)
            ->whereIn('p.codprograma', $programas)
            ->select('d.Nombrecurso', 'd.IdCurso', 'd.NombreTutor', DB::raw('COUNT(d.id) AS TOTAL'))
            ->groupBy('d.IdCurso')
            ->get()
            ->toArray();

        foreach ($consultaCursos as $Curso) {
            $id = $Curso->IdCurso;
            $total = $Curso->TOTAL;

            $consultaSello = DB::table('datos_moodle as d')
                ->join('programas as p','d.Programa', '=', 'p.programa')
                ->whereIn('d.Periodo_Rev', $periodos)
                ->whereIn('p.codprograma', $programas)
                ->where('d.IdCurso', $id)
                ->where('d.Sello', 'TIENE SELLO FINANCIERO')
                ->select(DB::raw('COUNT(d.id) AS TOTAL'))
                ->get();

            $sello = $consultaSello[0]->TOTAL;

            $consultaASP = DB::table('datos_moodle as d')
                ->join('programas as p','d.Programa', '=', 'p.programa')
                ->whereIn('d.Periodo_Rev', $periodos)
                ->whereIn('p.codprograma', $programas)
                ->where('d.IdCurso', $id)
                ->where('d.Sello', 'TIENE RETENCION')
                ->select(DB::raw('COUNT(d.id) AS TOTAL'))
                ->get();

            $ASP = $consultaASP[0]->TOTAL;
            $inactivos = $total - $sello - $ASP;

            $consultaGrupos =  DB::table('datos_moodle as d')
                ->where('d.IdCurso', $id)
                ->join('programas as p','d.Programa', '=', 'p.programa')
                ->whereIn('d.Periodo_Rev', $periodos)
                ->whereIn('p.codprograma', $programas)
                ->selectRaw('COUNT(d.Grupo) AS TOTAL')->groupBy('d.Grupo')->get();

            $grupo = $consultaGrupos->count();

            $datos[] = [
                'NombreCurso' => $Curso->Nombrecurso,
                'id' => $id,
                'Tutor' => $Curso->NombreTutor,
                'Total' => $total,
                'Sello' => $sello,
                'ASP' => $ASP,
                'Inactivo' => $inactivos,
                'Cursos' => $grupo
            ];
        }

        return $datos;
    }
}
