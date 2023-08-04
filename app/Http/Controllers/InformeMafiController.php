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

class InformeMafiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Método que trae los periodos activos
     * @return JSON Retorna un Json con los periodos activos
     */
    public function periodosActivos()
    {
        $periodos = DB::table('periodo')->where('periodoActivo', 1)->get();
        return $periodos;
    }

    /**
     * Método que trae los estudiantes activos de toda la Ibero
     * @return JSON retorna los estudiantes agrupados en activos e inactivos
     */
    public function estudiantesActivosGeneral()
    {
        /**
         * SELECT COUNT(estado) AS TOTAL, estado FROM `datosMafi`
         *GROUP BY estado
         */
        $estudiantes = DB::table('datosMafi')
            ->select(DB::raw('COUNT(estado) AS TOTAL, estado'))
            ->groupBy('estado')
            ->get();


        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    /**
     * Método que muestra el estado del sello financiero de todos los estudiantes
     * @return JSON retorna los estudiantes agrupados según su sello financiero
     */
    public function selloEstudiantesActivos($tabla)
    {
        if ($tabla == 'Mafi') {
            /**
             * SELECT COUNT(sello) AS TOTAL, sello FROM `datosMafi`
             *GROUP BY sello
             */
            $sello = DB::table('datosMafi')
                ->select(DB::raw('COUNT(sello) AS TOTAL, sello'))
                ->groupBy('sello')
                ->get();
        }
        if ($tabla == 'planeacion') {
        }

        header("Content-Type: application/json");
        echo json_encode(array('data' => $sello));
    }

    /**
     * Método que trae los estudiantes con retención
     * @return JSON retorna los estudiantes que tienen retención agrupados según 'autorizado_asistir'
     */
    public function estudiantesRetencion()
    {
        /**
         * SELECT COUNT(autorizado_asistir) AS TOTAL, autorizado_asistir FROM datosMafi 
         *WHERE sello = 'TIENE RETENCION' 
         *GROUP BY autorizado_asistir
         */

        $retencion = DB::table('datosMafi')
            ->where('sello', 'TIENE RETENCION')
            ->select(DB::raw('COUNT(autorizado_asistir) AS TOTAL, autorizado_asistir'))
            ->groupBy('autorizado_asistir')
            ->get();



        header("Content-Type: application/json");
        echo json_encode(array('data' => $retencion));
    }

    /**
     * Método que muestra el sello de los estudiantes de primer ingreso 
     * @return JSON retorna los estudiantes de primer ingreso, agrupados por sello
     */
    public function estudiantesPrimerIngreso()
    {
        /**
         * SELECT COUNT(sello) AS TOTAL, sello FROM `datosMafi`
         * WHERE  tipoestudiante IN('PRIMER INGRESO','PRIMER INGRESO PSEUDO INGRES', 'TRANSFERENTE EXTERNO', 'TRANSFERENTE EXTERNO (ASISTEN)', 'TRANSFERENTE EXTERNO PSEUD ING', 'TRANSFERENTE INTERNO')
         * GROUP BY sello;
         */
        $tiposEstudiante = [
            'PRIMER INGRESO',
            'PRIMER INGRESO PSEUDO INGRES',
            'TRANSFERENTE EXTERNO',
            'TRANSFERENTE EXTERNO (ASISTEN)',
            'TRANSFERENTE EXTERNO PSEUD ING',
            'TRANSFERENTE INTERNO',
        ];


        $primerIngreso = DB::table('datosMafi')
            ->whereIn('tipoestudiante', $tiposEstudiante)
            ->select(DB::raw('COUNT(sello) AS TOTAL, sello'))
            ->groupBy('sello')
            ->get();


        header("Content-Type: application/json");
        echo json_encode(array('data' => $primerIngreso));
    }

    /**
     * Método que trae todos los 5 tipos de estudiantes con mayor cantidad de datos
     * @return JSON retorna todos los tipos de estudiantes
     */
    public function tiposEstudiantes($tabla)
    {
        /**
         * SELECT COUNT(tipoestudiante) AS 'TOTAL', 
         * tipoestudiante FROM `datosMafi` 
         * GROUP BY tipoestudiante
         */
        if ($tabla == "Mafi") {
            $tipoEstudiantes = DB::table('datosMafi')
                ->select(DB::raw('COUNT(tipoestudiante) AS TOTAL, tipoestudiante'))
                ->groupBy('tipoestudiante')
                ->orderByDesc('TOTAL')
                ->limit(5)
                ->get();
        }
        if ($tabla == "planeacion") {
            $tipoEstudiantes = DB::table('estudiantes')
                ->select(DB::raw('COUNT(tipo_estudiante) AS TOTAL, tipo_estudiante'))
                ->groupBy('tipo_estudiante')
                ->orderByDesc('TOTAL')
                ->limit(5)
                ->get();
        }


        header("Content-Type: application/json");
        echo json_encode(array('data' => $tipoEstudiantes));
    }

    /**
     * Método que muestra los 5 operadores que mas estudiantes traen
     * @return JSON retorna un JSON con estos 5 operadores, agrupados por operador
     */
    public function operadores($tabla){
        if ($tabla == "Mafi") {
            /**
        SELECT COUNT(operador) AS TOTAL,operador FROM `datosMafi`
        GROUP BY operador
        ORDER BY TOTAL DESC
        LIMIT 5
             */
            $operadores = DB::table('datosMafi')
                ->select(DB::raw('COUNT(operador) AS TOTAL, operador'))
                ->groupBy('operador')
                ->orderByDesc('TOTAL')
                ->limit(5)
                ->get();
        }

        if ($tabla == "planeacion") {
            /*  SELECT COUNT(operador) AS TOTAL,operador FROM `estudiantes`
        GROUP BY operador
        ORDER BY TOTAL DESC
        LIMIT 5
        */
            $operadores = DB::table('estudiantes')
                ->select(DB::raw('COUNT(operador) AS TOTAL, operador'))
                ->groupBy('operador')
                ->orderByDesc('TOTAL')
                ->limit(5)
                ->get();
        }
        header("Content-Type: application/json");
        echo json_encode(array('data' => $operadores));
    }

    /**
     * Método que muestra los 5 programas con mayor cantidad de estudiantes inscritos
     * @return JSON retorna un JSON con estos 5 programas, agrupados por programa
     */

    public function estudiantesProgramas($tabla){

        if ($tabla == 'Mafi') {
        /**
        SELECT COUNT(codprograma) AS TOTAL, codprograma FROM `datosMafi`
        GROUP BY codprograma
        ORDER BY TOTAL DESC
        LIMIT 5
        */
            $programas = DB::table('datosMafi')
                ->select(DB::raw('COUNT(codprograma) AS TOTAL, codprograma'))
                ->groupBy('codprograma')
                ->orderByDesc('TOTAL')
                ->limit(5)
                ->get();
        }

        if ($tabla == 'planeacion') {
        /**  
         SELECT COUNT(programa) AS TOTAL, programa FROM `estudiantes`
         GROUP BY programa
         ORDER BY TOTAL DESC
         LIMIT 5
        */
        $programas = DB::table('estudiantes')
        ->select(DB::raw('COUNT(programa) AS TOTAL, programa'))
        ->groupBy('programa')
        ->orderByDesc('TOTAL')
        ->limit(5)
        ->get();
        }

        header("Content-Type: application/json");
        echo json_encode(array('data' => $programas));
    }

    /**
     * Método que trae los estudiantes activos e inactivos de las facultades seleccionadas por el usuario
     * @return JSON retorna los estudiantes agrupados en activos e inactivos
     */
    public function estudiantesActivosFacultad(Request $request)
    {
        /**
         *SELECT  COUNT(dm.estado) AS TOTAL, dm.estado, p.Facultad FROM `datosMafi` dm
         *INNER JOIN programas p ON p.codprograma = dm.programa
         *WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         *GROUP BY dm.estado
         */
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $estudiantes = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.estado) AS TOTAL'), 'dm.estado')
            ->groupBy('dm.estado')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    /**
     * Método que muestra el estado del sello financiero de los estudiantes de las facultades seleccionadas por el usuario
     * @return JSON retorna los estudiantes agrupados según su sello financiero
     */
    public function selloEstudiantesFacultad(Request $request){
        /**
         * SELECT COUNT(dm.sello) AS TOTAL, dm.sello FROM `datosMafi` dm
         *INNER JOIN programas p ON p.codprograma = dm.programa
         *WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         *GROUP BY dm.sello
         */
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $sello = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.sello) AS TOTAL, dm.sello'))
            ->groupBy('dm.sello')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $sello));
    }

    /**
     * Método que trae los estudiantes con retención de las facultades seleccionadas por el usuario
     * @return JSON retorna los estudiantes que tienen retención agrupados según 'autorizado_asistir'
     */
    public function retencionEstudiantesFacultad(Request $request){
        /**
         * SELECT COUNT(dm.autorizado_asistir) AS TOTAL, dm.autorizado_asistir FROM datosMafi dm
         *INNER JOIN programas p ON p.codprograma = dm.codprograma
         *WHERE p.Facultad IN ('') AND dm.periodo IN ('')
         *WHERE dm.sello = 'TIENE RETENCION' 
         *GROUP BY dm.autorizado_asistir
         */
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $retencion = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->where('dm.sello', 'TIENE RETENCION')
            ->select(DB::raw('COUNT(dm.autorizado_asistir) AS TOTAL, dm.autorizado_asistir'))
            ->groupBy('dm.autorizado_asistir')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $retencion));
    }

    /**
     * Método que muestra el sello de los estudiantes de primer ingreso de las facultades seleccionadas por el usuario
     * @return JSON retorna los estudiantes de primer ingreso, agrupados por sello
     */
    public function primerIngresoEstudiantesFacultad(Request $request){
        /**
         * SELECT COUNT(dm.sello) AS TOTAL, dm.sello
         *FROM datosMafi AS dm
         *JOIN programas AS p ON p.codprograma = dm.programa
         *WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         *AND dm.tipoestudiante = 'PRIMER INGRESO'
         *GROUP BY dm.sello;
         */
        $tiposEstudiante = [
            'PRIMER INGRESO',
            'PRIMER INGRESO PSEUDO INGRES',
            'TRANSFERENTE EXTERNO',
            'TRANSFERENTE EXTERNO (ASISTEN)',
            'TRANSFERENTE EXTERNO PSEUD ING',
            'TRANSFERENTE INTERNO',
        ];

        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $primerIngreso = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->whereIn('dm.tipoestudiante', $tiposEstudiante)
            ->select(DB::raw('COUNT(dm.sello) AS TOTAL, dm.sello'))
            ->groupBy('dm.sello')->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $primerIngreso));
    }

    /**
     * Método que muestra los 5 tipos de estudiantes con mayor cantidad de datos, de algunas facultades en específico
     * @return JSON retorna los tipos de estudiantes, agrupados por tipo de estudiante
     */
    public function tiposEstudiantesFacultad(Request $request, $tabla){
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $tabla = trim($tabla);
        if($tabla == "Mafi")
        {
            /**
        SELECT COUNT(tipoestudiante) AS 'TOTAL', tipoestudiante.dm
        FROM datosMafi AS dm
        JOIN programas AS p ON p.codprograma = dm.programa
        WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
        GROUP BY dm.tipoestudiante
         */
        $tipoEstudiantes = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.tipoestudiante) AS TOTAL, dm.tipoestudiante'))
            ->groupBy('dm.tipoestudiante')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();
        }

        if($tabla == "planeacion")
        {
            /**
        SELECT COUNT(e.tipo_estudiante) AS 'TOTAL', e.tipo_estudiante
        FROM estudiantes e
        JOIN programas p ON p.codprograma = e.programa
        WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
        GROUP BY e.tipo_estudiante
        */
        $tipoEstudiantes = DB::table('estudiantes AS e')
            ->join('programas AS p', 'p.codprograma', '=', 'e.programa')
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(e.tipo_estudiante) AS TOTAL'), 'e.tipo_estudiante')
            ->groupBy('e.tipo_estudiante')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();

        }

        header("Content-Type: application/json");
        echo json_encode(array('data' => $tipoEstudiantes));
    }

    /**
     * Método que muestra los tipos de estudiantes de las facultades seleccionadas por el usuario
     * @return JSON retorna un JSON con estos 5 operadores, agrupados por operador
     */
    public function operadoresFacultad(Request $request)
    {
        /**
         * SELECT COUNT(dm.operador) AS TOTAL, dm.operador 
         * FROM datosMafi AS dm
         * JOIN programas AS p ON p.codprograma = dm.programa
         * WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         * GROUP BY dm.operador
         * ORDER BY TOTAL DESC
         *LIMIT 5
         */
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $operadores = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.operador) AS TOTAL, dm.operador'))
            ->groupBy('dm.operador')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $operadores));
    }

    /**
     * Método que muestra los 5 programas con mayor cantidad de estudiantes inscritos de las facultades seleccionadas por el usuario
     * @return JSON retorna un JSON con estos 5 programas, agrupados por programa
     */

    public function estudiantesProgramasFacultad(Request $request)
    {
        /**
         * SELECT COUNT(dm.codprograma) AS TOTAL, dm.codprograma 
         * * FROM datosMafi AS dm
         * JOIN programas AS p ON p.codprograma = dm.programa
         * WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         * GROUP BY dm.codprograma
         * ORDER BY TOTAL DESC
         * LIMIT 5
         */
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $programas = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.codprograma) AS TOTAL, dm.codprograma'))
            ->groupBy('dm.codprograma')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $programas));
    }

    /**
     * Métodos para gráficos de programas
     */

    /**
     * Método que trae los estudiantes activos e inactivos de las facultades seleccionadas por el usuario
     * @return JSON retorna los estudiantes agrupados en activos e inactivos
     */
    public function estudiantesActivosPrograma(Request $request)
    {
        /**
         * SELECT  COUNT(estado) AS TOTAL, estado FROM `datosMafi`
         *WHERE programa IN ('') -- Reemplaza con los programas específicos
         *GROUP BY estado
         */
        $programas = $request->input('programa');
        $periodos = $request->input('periodos');

        $estudiantes = DB::table('datosMafi')
            ->whereIn('periodo', $periodos)
            ->whereIn('codprograma', $programas)
            ->select(DB::raw('COUNT(estado) AS TOTAL'), 'estado')
            ->groupBy('estado')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    /**
     * Método que muestra el estado del sello financiero de los estudiantes de los programas seleccionados por el usuario
     * @return JSON retorna los estudiantes agrupados según su sello financiero
     */
    public function selloEstudiantesPrograma(Request $request)
    {
        /**
         * SELECT COUNT(sello) AS TOTAL, sello FROM `datosMafi` 
         *WHERE programa IN ('') -- Reemplaza con los programas específicos
         *GROUP BY sello
         */
        $programas = $request->input('programa');
        $periodos = $request->input('periodos');
        $sello = DB::table('datosMafi')
            ->whereIn('periodo', $periodos)
            ->whereIn('codprograma', $programas)
            ->select(DB::raw('COUNT(sello) AS TOTAL, sello'))
            ->groupBy('sello')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $sello));
    }

    /**
     * Método que trae los estudiantes con retención de los programas seleccionados por el usuario
     * @return JSON retorna los estudiantes que tienen retención agrupados según 'autorizado_asistir'
     */
    public function retencionEstudiantesPrograma(Request $request)
    {
        /**
         * SELECT COUNT(autorizado_asistir) AS TOTAL, autorizado_asistir FROM datosMafi
         *WHERE programa IN ('') -- Reemplaza con los programas específicos
         *WHERE sello = 'TIENE RETENCION' 
         *GROUP BY autorizado_asistir
         */
        $programas = $request->input('programa');
        $periodos = $request->input('periodos');
        $retencion = DB::table('datosMafi')
            ->whereIn('periodo', $periodos)
            ->whereIn('codprograma', $programas)
            ->where('sello', 'TIENE RETENCION')
            ->select(DB::raw('COUNT(autorizado_asistir) AS TOTAL, autorizado_asistir'))
            ->groupBy('autorizado_asistir')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $retencion));
    }

    /**
     * Método que muestra el sello de los estudiantes de primer ingreso de los programas seleccionados por el usuario
     * @return JSON retorna los estudiantes de primer ingreso, agrupados por sello
     */
    public function primerIngresoEstudiantesPrograma(Request $request)
    {
        /**
         * SELECT COUNT(sello) AS TOTAL, sello
         *FROM datosMafi
         *WHERE programa IN ('') -- Reemplaza con los programas específicos
         *AND tipoestudiante = 'PRIMER INGRESO'
         *GROUP BY sello;
         */
        $tiposEstudiante = [
            'PRIMER INGRESO',
            'PRIMER INGRESO PSEUDO INGRES',
            'TRANSFERENTE EXTERNO',
            'TRANSFERENTE EXTERNO (ASISTEN)',
            'TRANSFERENTE EXTERNO PSEUD ING',
            'TRANSFERENTE INTERNO',
        ];

        $programas = $request->input('programa');
        $periodos = $request->input('periodos');
        $primerIngreso = DB::table('datosMafi')
            ->whereIn('periodo', $periodos)
            ->whereIn('codprograma', $programas)
            ->whereIn('tipoestudiante', $tiposEstudiante)
            ->select(DB::raw('COUNT(sello) AS TOTAL, sello'))
            ->groupBy('sello')->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $primerIngreso));
    }

    /**
     * Método que muestra los 5 tipos de estudiantes con mayor cantidad de datos de los programas seleccionados por el usuario
     * @return JSON retorna los tipos de estudiantes, agrupados por tipo de estudiante
     */
    public function tiposEstudiantesPrograma(Request $request)
    {
        /**
         * SELECT COUNT(tipoestudiante) AS 'TOTAL', tipoestudiante
         * FROM datosMafi
         * WHERE programa IN ('') -- Reemplaza con los programas específicos
         * GROUP BY tipoestudiante
         */
        $programas = $request->input('programa');
        $periodos = $request->input('periodos');
        $tipoEstudiantes = DB::table('datosMafi')
            ->whereIn('periodo', $periodos)
            ->whereIn('codprograma', $programas)
            ->select(DB::raw('COUNT(tipoestudiante) AS TOTAL, tipoestudiante'))
            ->groupBy('tipoestudiante')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $tipoEstudiantes));
    }

    /**
     * Método que muestra los tipos de estudiantes de los programas seleccionados por el usuario
     * @return JSON retorna un JSON con estos 5 operadores, agrupados por operador
     */
    public function operadoresPrograma(Request $request)
    {
        /**
         * SELECT COUNT(operador) AS TOTAL, operador 
         * FROM datosMafi
         * WHERE programa IN ('') -- Reemplaza con los programas específicos
         * GROUP BY operador
         * ORDER BY TOTAL DESC
         * LIMIT 5
         */
        $programas = $request->input('programa');
        $periodos = $request->input('periodos');
        $operadores = DB::table('datosMafi')
            ->whereIn('periodo', $periodos)
            ->whereIn('codprograma', $programas)
            ->select(DB::raw('COUNT(operador) AS TOTAL, operador'))
            ->groupBy('operador')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $operadores));
    }


    /**
     * Método que muestra todos los operadores que traen estudiantes de los programas seleccionados por el usuario
     * @return JSON retorna los tipos de estudiantes, agrupados por tipo de estudiante
     */
    public function operadoresProgramaTotal(Request $request)
    {
        /**
         * SELECT COUNT(operador) AS TOTAL, operador 
         * FROM datosMafi
         * WHERE programa IN ('') -- Reemplaza con los programas específicos
         * GROUP BY operador
         * ORDER BY TOTAL DESC
         */
        $programas = $request->input('programa');
        $periodos = $request->input('periodos');
        $operadores = DB::table('datosMafi')
            ->whereIn('periodo', $periodos)
            ->whereIn('codprograma', $programas)
            ->select(DB::raw('COUNT(operador) AS TOTAL, operador'))
            ->groupBy('operador')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $operadores));
    }

    /**
     * Método que muestra todos los operadores que traen estudiantes de las facultades seleccionadas por el usuario
     * @return JSON retorna los operadores, agrupados por operador
     */
    public function operadoresFacultadTotal(Request $request)
    {
        /**
         * SELECT COUNT(dm.operador) AS TOTAL, dm.operador 
         * FROM datosMafi AS dm
         * JOIN programas AS p ON p.codprograma = dm.programa
         * WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         * GROUP BY dm.operador
         * ORDER BY TOTAL DESC
         */
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $operadores = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.operador) AS TOTAL, dm.operador'))
            ->groupBy('dm.operador')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $operadores));
    }

    /**
     * Método que muestra los operadores ordenados de forma descendente en función de la cantidad de estudiantes que traen
     * @return JSON retorna un JSON con los operadores, agrupados por operador
     */
    public function operadoresTotal()
    {
        /**
         * SELECT COUNT(operador) AS TOTAL,operador FROM `datosMafi`
         *GROUP BY operador
         *ORDER BY TOTAL DESC
         */

        $operadores = DB::table('datosMafi')
            ->select(DB::raw('COUNT(operador) AS TOTAL, operador'))
            ->groupBy('operador')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $operadores));
    }

    /**
     * Método que muestra los 5 programas con mayor cantidad de estudiantes inscritos
     * @return JSON retorna un JSON con estos 5 programas, agrupados por programa
     */

    public function estudiantesProgramasTotal()
    {
        /**
         * SELECT COUNT(codprograma) AS TOTAL, codprograma FROM `datosMafi`
         *GROUP BY codprograma
         *ORDER BY TOTAL DESC
         */

        $programas = DB::table('datosMafi')
            ->select(DB::raw('COUNT(codprograma) AS TOTAL, codprograma'))
            ->groupBy('codprograma')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $programas));
    }



    /**
     * Método que muestra los estudiantes inscritos en cada programa, organizados de forma descendente
     * @return JSON retorna un JSON todos los programas, agrupados por programa
     */

    public function estudiantesFacultadTotal(Request $request)
    {
        /**
         * SELECT COUNT(dm.codprograma) AS TOTAL, dm.codprograma 
         * * FROM datosMafi AS dm
         * JOIN programas AS p ON p.codprograma = dm.programa
         * WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         * GROUP BY dm.codprograma
         * ORDER BY TOTAL DESC
         */
        $facultades = $request->input('idfacultad');
        $periodos = $request->input('periodos');
        $programas = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.codprograma) AS TOTAL, dm.codprograma'))
            ->groupBy('dm.codprograma')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $programas));
    }

    /**
     * Método que trae todos los tipos de estudiantes
     * @return JSON retorna todos los tipos de estudiantes
     */
    public function tiposEstudiantesTotal()
    {
        /**
         * SELECT COUNT(tipoestudiante) AS 'TOTAL', 
         * tipoestudiante FROM `datosMafi` 
         * GROUP BY tipoestudiante
         */
        $tipoEstudiantes = DB::table('datosMafi')

            ->select(DB::raw('COUNT(tipoestudiante) AS TOTAL, tipoestudiante'))
            ->groupBy('tipoestudiante')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $tipoEstudiantes));
    }

    /**
     * Método que trae todos los tipos de estudiantes por facultad
     * @return JSON retorna todos los tipos de estudiantes
     */
    public function tiposEstudiantesFacultadTotal(Request $request)
    {
        /**
         * SELECT COUNT(tipoestudiante) AS 'TOTAL', tipoestudiante.dm
         * FROM datosMafi AS dm
         * JOIN programas AS p ON p.codprograma = dm.programa
         * WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         * GROUP BY tipoestudiante
         */
        $periodos = $request->input('periodos');
        $facultades = $request->input('idfacultad');
        $tipoEstudiantes = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.codprograma')
            ->whereIn('dm.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.tipoestudiante) AS TOTAL, dm.tipoestudiante'))
            ->groupBy('dm.tipoestudiante')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $tipoEstudiantes));
    }

    /**
     * Método que muestra los tipos de estudiantes de los programas seleccionados por el usuario
     * @return JSON retorna los tipos de estudiantes, agrupados por tipo de estudiante
     */
    public function tiposEstudiantesProgramaTotal(Request $request)
    {
        /**
         * SELECT COUNT(tipoestudiante) AS 'TOTAL', tipoestudiante
         * FROM datosMafi
         * WHERE programa IN ('') -- Reemplaza con los programas específicos
         * GROUP BY tipoestudiante
         */
        $periodos = $request->input('periodos');
        $programas = $request->input('programa');
        $tipoEstudiantes = DB::table('datosMafi')
            ->whereIn('periodo', $periodos)
            ->whereIn('codprograma', $programas)
            ->select(DB::raw('COUNT(tipoestudiante) AS TOTAL, tipoestudiante'))
            ->groupBy('tipoestudiante')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $tipoEstudiantes));
    }
}
