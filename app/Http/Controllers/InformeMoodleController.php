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

    public function riesgoFacultad(Request $request)
    {

        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $riesgos = DB::table('datos_moodle')
            ->whereIn('Facultad', $facultades)
            ->whereIn('Periodo_Rev', $periodos)
            ->select(DB::raw('COUNT(Riesgo) AS TOTAL, Riesgo'))->groupBy('Riesgo')->get();

        $Total = DB::table('datos_moodle')
            ->whereIn('Facultad', $facultades)
            ->whereIn('Periodo_Rev', $periodos)
            ->select(DB::raw('COUNT(Riesgo) AS TOTAL'))->get();



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

    public function riesgoPrograma(Request $request)
    {

        $programas = $request->input('programa');
        $periodos = $request->input('periodos');

        $riesgos = DB::table('datos_moodle AS dm')
            ->join('programas AS p', 'dm.Programa', '=', 'p.programa')
            ->whereIn('p.codprograma', $programas)
            ->whereIn('dm.Periodo_Rev', $periodos)
            ->select(DB::raw('COUNT(Riesgo) AS TOTAL, Riesgo'))
            ->groupBy('Riesgo')
            ->get();

        $Total = DB::table('datos_moodle AS dm')
            ->join('programas AS p', 'dm.Programa', '=', 'p.programa')
            ->whereIn('p.codprograma', $programas)
            ->whereIn('dm.Periodo_Rev', $periodos)
            ->select(DB::raw('COUNT(Riesgo) AS TOTAL'))->get();

        $alto = [];
        $medio = [];
        $bajo = [];

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

    public function sello()
    {
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

    public function retencion()
    {
        $retencion = DB::table('datos_moodle')
            ->where('Sello', 'NO EXISTE')
            ->select(DB::raw('COUNT(Autorizado_ASP) AS TOTAL, Autorizado_ASP'))
            ->groupBy('Autorizado_ASP')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $retencion));
    }

    function estudiantesRiesgo($riesgo)
    {
        $riesgo = trim($riesgo);
        $estudiantes = DB::table('datos_moodle')
            ->where('Riesgo', $riesgo)
            ->select('Id_Banner', 'Nombre', 'Apellido', 'Facultad', 'Programa')
            ->groupBy('Id_Banner', 'Nombre', 'Apellido', 'Facultad', 'Programa')
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
            ->groupBy('Id_Banner', 'Nombre', 'Apellido', 'Facultad', 'Programa')
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
            ->groupBy('dm.Id_Banner', 'dm.Nombre', 'dm.Apellido', 'dm.Facultad', 'dm.Programa')
            ->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    function dataAlumno(Request $request)
    {
        $idBanner = $request->input('idBanner');
        $data = DB::table('datos_moodle')->where('Id_Banner', $idBanner)->select('*')->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $data));
    }

    function riesgoAsistencia(Request $request)
    {

        $idBanner = $request->input('idBanner');
        $bajo = [];
        $medio = [];
        $alto = [];
        $riesgos = DB::table('datos_moodle')->where('Id_Banner', $idBanner)->select('Riesgo', 'Nombrecurso')->get();
        $totalRiesgo = DB::table('datos_moodle')
            ->where('Id_Banner', $idBanner)
            ->select(DB::raw("COALESCE(SUM(CASE WHEN Riesgo = 'ALTO' THEN 1 ELSE 0 END), 0) AS ALTO,
                      COALESCE(SUM(CASE WHEN Riesgo = 'BAJO' THEN 1 ELSE 0 END), 0) AS BAJO,
                      COALESCE(SUM(CASE WHEN Riesgo = 'MEDIO' THEN 1 ELSE 0 END), 0) AS MEDIO"))
            ->first();

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
            ->get();

        $fechaActual = date("d-m-Y");
        $fechaObj1 = DateTime::createFromFormat("d-m-Y", $fechaActual);
        $definitivas = [];

        foreach ($Notas as $nota) {

            $nota2 = floatval($nota->Segundo_Corte);
            $nota3 = floatval($nota->Tercer_Corte);


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

            $fechaInicio = (new DateTime($nota->FechaInicio))->format("d-m-Y");
            $nombre = $nota->nombreCurso;
            $duracion = $nota->Duracion_8_16_Semanas;
            $fechaObj2 = DateTime::createFromFormat("d-m-Y", $fechaInicio);
            $diferencia = $fechaObj1->diff($fechaObj2);
            $diasdif = $diferencia->days;

            /** Validación Notas */
            if ($nota1 != 0 && $nota2 != 0 && $nota3 != 0 && !in_array("Sin Actividad", [$nota1, $nota2, $nota3])) {
                $definitivas[$nombre] = $nota->Nota_Acumulada;
            } else {
                if ($nota1 != 0 && $nota2 != 0 && !in_array("Sin Actividad", [$nota1, $nota2])) {
                    if ($diasdif >= 56) {
                        if ($nota3 != "Sin Actividad") {
                            $definitivas[$nombre] =  1.48 + $nota1 * 0.3 + $nota2 * 0.3;
                        } else {
                            $definitivas[$nombre] =  $nota->Nota_Acumulada;
                        }
                    } else {
                        $definitivas[$nombre] = ($nota1 + $nota2) * (10 / 6);
                    }
                } else {
                    if ($nota1 != 0 && $nota1 != "Sin Actividad") {
                        if ($diasdif >= 42) {
                            if ($nota2 != "Sin Actividad") {
                                $definitivas[$nombre] =  $nota->Primer_Corte;
                            } else {
                                $definitivas[$nombre] =  $nota->Nota_Acumulada;
                            }
                        }
                        else{
                            $definitivas[$nombre] =  $nota1;
                        }
                    }
                }
            }
        }

        dd($definitivas);
        $datos = array(
            'alto' => $alto,
            'medio' => $medio,
            'bajo' => $bajo,
            'total' => $totalRiesgo,
            'notas' => $definitivas
        );

        header("Content-Type: application/json");
        echo json_encode(array('data' => $datos));
    }
}
