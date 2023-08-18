<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CambioPassRequest;
use App\Http\Requests\UsuarioLoginRequest;
use App\Http\Requests\CrearFacultadRequest;
use App\Http\Requests\ProgramasRequest;
use App\Models\Facultad;
use App\Models\Roles;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Yajra\DataTables\DataTables;
use App\Http\Util\Constantes;
use App\Http\Controllers\LogUsuariosController;

/**
 * Controlador de facultades
 */
class facultadController extends Controller
{
    /** 
     * Función para cargar la vista de los programas 
     * @return view de los programas de pregrado
     * */
    public function view_programas()
    {
        return view('vistas.admin.programas');
    }

    /** 
     * Función para cargar la vista de las especializaciones
     * @return view de los programas de especialización
     * */
    public function view_especializacion()
    {
        return view('vistas.admin.especializacion');
    }

    /** 
     * Función para cargar la vista de las maestrías
     * @return view de los programas de maestría
     * */
    public function view_maestria()
    {
        return view('vistas.admin.maestria');
    }

    /** 
     * Función para cargar la vista de educación continua
     * @return view de los programas de educación continua
     * */
    public function view_continua()
    {
        return view('vistas.admin.educacioncontinua');
    }

    /** 
     * Función para cargar la vista de los periodos
     * @return view de los periodos de inscripción la Universidad
     * */
    public function view_periodos()
    {
        return view('vistas.admin.periodos');
    }

    /** 
     * Función para cargar las reglas de negocio
     * Estas son las condiciones para inscribir materias en cada uno de los programas
     * según varios criterios como la cantidad de créditos, cantidad de materias
     * @return view de las reglas negocio
     * */
    public function view_reglas()
    {
        return view('vistas.admin.reglasnegocio');
    }

    public function view_planeacion()
    {
        return view('vistas.admin.planeacion');
    }

    /** 
     * Función para obtener todos los programas de pregrado
     * Esta función hace una consulta a la base de datos para traer los datos de los programas
     * de pregrado en un arreglo y lo convierte a formato json para mostrarlo en la vista
     * @return json(array())
     */
    public function get_programas()
    {
        $programas = DB::table('programas')->where('nivelFormacion', '=', 'PROFESIONAL')->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $programas));
    }

    /** 
     * Función para obtener todos los programas de especialización
     * Esta función hace una consulta a la base de datos para traer los datos de los programas
     * de especialización en un arreglo y lo convierte a formato json para mostrarlo en la vista
     * @return json(array())
     */
    public function get_especializacion()
    {
        $especializacion = DB::table('programas')->where('nivelFormacion', '=', 'ESPECIALISTA')->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $especializacion));
    }

    /** 
     * Función para obtener todos los programas de maestría
     * Esta función hace una consulta a la base de datos para traer los datos de los programas
     * de maestría en un arreglo y lo convierte a formato json para mostrarlo en la vista
     * @return json(array())
     */
    public function get_maestria()
    {
        $programas = DB::table('programas')->where('nivelFormacion', '=', 'MAESTRIA')->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $programas));
    }

    /** 
     * Función para obtener todos los programas de maestría
     * Esta función hace una consulta a la base de datos para traer los datos de los programas
     * de maestría en un arreglo y lo convierte a formato json para mostrarlo en la vista
     * @return json(array())
     */
    public function get_continua()
    {
        $programas = DB::table('programas')->where('nivelFormacion', '=', 'EDUCACION CONTINUA')->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $programas));
    }

    /** 
     * Función para obtener todos los periodos de inscripción
     * Esta función hace una consulta a la base de datos para traer los datos de los periodos
     * en un arreglo y lo convierte a formato json para mostrarlo en la vista
     * @return json(array())
     */
    public function get_periodos()
    {
        $periodos = DB::table('periodo')->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $periodos));
    }

    /** 
     * Función para obtener todas las reglas de negocio
     * Esta función hace una consulta a la base de datos para traer los datos de las reglas de negocio
     *  y lo convierte a formato json para mostrarlo en la vista
     * @return json(array())
     */
    public function get_reglas()
    {
        DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad');
        $reglas = DB::table('reglasNegocio')->join('programas', 'programas.codprograma', '=', 'reglasNegocio.programa')
            ->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select(
                'programas.codprograma',
                'reglasNegocio.creditos',
                'reglasNegocio.materiasPermitidas',
                'reglasNegocio.tipoEstudiante',
                'reglasNegocio.ciclo',
                'reglasNegocio.activo',
                'programas.programa',
                'programas.tabla',
                'facultad.nombre'
            )
            ->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $reglas));
    }

    /** 
     * Función para obtener los datos de la tabla planeación
     * Esta función hace una consulta a la base de datos para traer los datos de la tabla de planeación
     * y lo convierte a formato json para mostrarlo en la vista
     * @return json(array())
     */
    public function get_planeacion()
    {
        $planeacion = DB::table('planeacion')->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $planeacion));
    }

    /** 
     * Función para obtener los datos de una facultad según su id y retornar a la vista de
     * administración de facultades
     * @param Request $request id de la facultad
     * @return view(vista.admin) $Vista de administración de facultades
     * $[request->id] id de facultad 
     * $[nombre[0]->nombre] nombre de la facultad
     * */
    public function facultad(Request $request)
    {
        $nombre = DB::table('facultad')->select('nombre')->where('id', '=', decrypt($request->id))->get();
        return view('vistas.admin.facultad', ['id' => $request->id], ['nombre' => $nombre[0]->nombre]);
    }

    /** 
     * Función para obtener el nombre de un programa a partir de su código y retornar a la vista de malla curricular
     * de cada programa
     * @param codigo $codigo del programa
     * @return view(vista.malla) $Vista de administración de malla curricular 
     * $[request->id] id de facultad 
     * $[nombre[0]->nombre] nombre de la facultad
     * */
    public function malla($codigo)
    {
        $nombre = DB::table('programas')->select('programa')->where('codprograma', '=', $codigo)->get();

        return view('vistas.admin.malla', ['codigo' => $codigo], ['nombre' => $nombre[0]->programa]);
    }

    public function mostrarmallacurricular($id)
    {
        $codigo = DB::table('programas')->where('id', '=', $id)->select('codprograma')->get();
        // Consulta para obtener la malla curricular del programa
        $malla = DB::table('mallaCurricular')->where('codprograma', '=', $codigo[0]->codprograma)->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $malla));
    }

    public function getDatosPrograma($codigo)
    {
        $datos = DB::table('programas')->where('codprograma', '=', $codigo)->select('tabla', 'id', 'programa', 'activo')->get();
        return $datos;
    }


    /* Método para inactivar programa */
    public function inactivar_programa()
    {
        $cod_llegada = $_POST['codigo'];
        $informacionOriginal = $this->getDatosPrograma($cod_llegada);
        $inactivarPrograma = DB::table('programas')->where('codprograma', '=', $cod_llegada)->update(['activo' => 0]);
        $informacionActualizada = $this->getDatosPrograma($cod_llegada);

        if ($inactivarPrograma) :
            $this->updateLogUsuarios("El programa " . $informacionOriginal[0]->programa . " fue desactivado", "programa", $informacionOriginal, $informacionActualizada);
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    public function activar_programa()
    {
        $cod_llegada = $_POST['codigo'];
        $informacionOriginal = $this->getDatosPrograma($cod_llegada);
        $activarPrograma = DB::table('programas')->where('codprograma', '=', $cod_llegada)->update(['activo' => 1]);
        $informacionActualizada = $this->getDatosPrograma($cod_llegada);

        $datos = $this->getDatosPrograma($cod_llegada);
        if ($activarPrograma) :
            $this->updateLogUsuarios("El programa " . $informacionOriginal[0]->programa . " fue activado", "programa", $informacionOriginal, $informacionActualizada);

            return  "habilitado";
        else :
            return "false";
        endif;
    }

    public function crear_programa(Request $request)
    {
        // Recibe los parámetros del formulario por Post
        $codigo = $_POST['codPrograma'];
        $nombre = $_POST['nombre'];
        $codFacultad = $_POST['codFacultad'];
        // Consulta para insertar nuevo programa
        $crear = DB::table('programas')->insert([
            'codprograma' => $codigo,
            'programa' => $nombre,
            'idFacultad' => $codFacultad,
            'tabla' => 'pregrado',
        ]);
        $request->merge(['tabla' => 'pregrado']);
        $informacionOriginal = $request->except(['_token']);
        if ($crear) :
            $this->insertLogUsuarios("Programa creado", "programa", $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.programas')->with('sucess', 'Programa creado correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('facultad.programas')->with(['errors' => 'El programa no ha podido ser creado']);
        endif;
    }

    public function crear_esp(Request $request)
    {
        $codigo = $_POST['codEsp'];
        $nombre = $_POST['nombre'];
        $codFacultad = $_POST['idFacultad'];

        // Consulta para insertar nueva especialización
        $crear = DB::table('programas')->insert([
            'codprograma' => $codigo,
            'programa' => $nombre,
            'idFacultad' => $codFacultad,
            'tabla' => 'especializacion',
        ]);
        $request->merge(['tabla' => 'especializacion']);
        $informacionOriginal = $request->except(['_token']);
        if ($crear) :
            $this->insertLogUsuarios("Especialización creada", "programa", $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.especializacion')->with('sucess', 'Especialización creada correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('facultad.especializacion')->with(['errors' => 'La especialización no ha podido ser creada']);
        endif;
    }

    public function crear_maestria(Request $request)
    {
        $codigo = $_POST['codMaestria'];
        $nombre = $_POST['nombre'];
        $codFacultad = $_POST['idFacultad'];
        // Consulta para insertar nueva especialización
        $crear = DB::table('programas')->insert([
            'codprograma' => $codigo,
            'programa' => $nombre,
            'idFacultad' => $codFacultad,
            'tabla' => 'MAESTRIA',
        ]);
        $request->merge(['tabla' => 'maestria']);
        $informacionOriginal = $request->except(['_token']);
        if ($crear) :
            $this->insertLogUsuarios("Maestría creada", "programa", $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.maestria')->with('success', 'Maestria creada correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('facultad.maestria')->with(['errors' => 'La maestria no ha podido ser creada']);
        endif;
    }

    /** Metodo para crear programa de educacion continua */
    public function crear_edudacioncont(Request $request)
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $codFacultad = $_POST['codFacultad'];
        // Consulta para insertar nueva especialización
        $crear = DB::table('programas')->insert([
            'codprograma' => $codigo,
            'programa' => $nombre,
            'idFacultad' => $codFacultad,
            'tabla' => 'EDUCACION CONTINUA',
        ]);
        $request->merge(['tabla' => 'educacion continua']);
        $informacionOriginal = $request->except(['_token']);
        if ($crear) :
            $this->insertLogUsuarios("Programa de educación continua creado", "programa", $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.continua')->with('success', 'Programa creado correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('facultad.continua')->with(['errors' => 'El programa no ha podido ser creado']);
        endif;
    }

    /** Función que actualiza los datos de programa */
    public function update_programa(Request $request)
    {
        $id_llegada = $_POST['id'];
        $codigo = $_POST['codigo'];
        $nombre = $_POST['programa'];
        $idfacultad = $_POST['idfacultad'];

        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }

        $informacionOriginal = DB::table('programas')->where('id', '=', $id)->get();

        $update = DB::table('programas')->where('id', '=', $id)->update(['codprograma' => $codigo, 'programa' => $nombre, 'idFacultad' => $idfacultad]);

        $request->merge(['id' => $id]);
        $informacionActualizada = $request->except(['_token']);

        if ($update) :
            $this->updateLogUsuarios("El programa " . $informacionOriginal[0]->programa . " fue actualizado", "programa", $informacionOriginal, $informacionActualizada);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return "actualizado";
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return "false";
        endif;
    }

    /** 
     * Función para visualizar la vista de los programas del usuario 
     * */
    public function programasUsuario($nombre)
    {
        return view('vistas.admin.facultades', ['nombre' => $nombre]);
    }

    /**
     * Función para visualizar los estudiantes de cada facultad 
     * */
    public function estudiantesFacultad($id)
    {
        $consulta = DB::table('programas')->where('id', '=', $id)->get();
        $codigo = $consulta[0]->codprograma;
        $estudiantes = DB::table('estudiantes')->where('programa', '=', $codigo)->get();
        header("Content-Type: application/json");
        echo json_encode(array('data' => $estudiantes));
    }

    public function planeacionPrograma($id)
    {
        $consulta = DB::table('programas')->where('id', '=', $id)->get();
        $codigo = $consulta[0]->codprograma;
        $planeacion = DB::table('planeacion')->where('codprograma', '=', $codigo)->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $planeacion));
    }

    /** 
     * Método para obtener los datos de la tabla facultad del usuario según su id
     */
    public function obtenerFacultad($id)
    {
        $facultadActualizar = DB::table('facultad')->where('id', '=', $id)->select('*')->get();
        return $facultadActualizar;
    }

    public function savefacultad(Request $request)
    {
        /** Consulta para insertar los datos obtenidos en el Request a la base de datos de facultad */
        $facultad = DB::table('facultad')->insert([
            'codFacultad' => $_POST['codFacultad'],
            'nombre' => $_POST['nombre'],
        ]);
        $informacionOriginal = $request->except(['_token']);
        if ($facultad) :
            $this->insertLogUsuarios("Facultad creada", 'facultad', $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('admin.facultades')->with('success', 'Facultad creada correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('admin.facultades')->withErrors(['errors' => 'La facultad no se ha podido crear']);
        endif;
    }

    public function updatefacultad(Request $request)
    {
        $id_llegada = $_POST['id'];
        $codFacultad = $_POST['codFacultad'];
        $nombre = $_POST['nombre'];
        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = $this->obtenerFacultad($id);
        /** Consulta para actualizar facultad */
        $facultad = DB::table('facultad')
            ->where('id', $id)
            ->update([
                'codFacultad' => $codFacultad,
                'nombre' => $nombre
            ]);
        $request->merge(['id' => $id]);
        $informacionActualizada = $request->except(['_token']);
        if ($facultad) :
            $this->updateLogUsuarios("La facultad " . $informacionOriginal[0]->nombre . " fue actualizada", 'facultad', $informacionOriginal, $informacionActualizada);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return "actualizado";
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return "false";
        endif;
    }

    /** Metodo para inactivar facultad */
    public function inactivar_facultad()
    {
        $id = $_POST['id'];
        $informacionOriginal = DB::table('facultad')->where('id', '=', $id)->select('nombre', 'id', 'activo')->get();
        $inactivarFacultad = DB::table('facultad')->where('id', '=', $id)->update(['activo' => 0]);
        $informacionActualizada = DB::table('facultad')->where('id', '=', $id)->select('nombre', 'id', 'activo')->get();
        if ($inactivarFacultad) :
            $this->updateLogUsuarios("La facultad " . $informacionOriginal[0]->nombre . " fue desactivada", 'facultad', $informacionOriginal, $informacionActualizada);
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    /** Metodo para activar facultad */
    public function activar_facultad()
    {
        $id = $_POST['id'];
        $informacionOriginal = DB::table('facultad')->where('id', '=', $id)->select('nombre', 'id', 'activo')->get();
        $activarPrograma = DB::table('facultad')->where('id', '=', $id)->update(['activo' => 1]);
        $informacionActualizada = DB::table('facultad')->where('id', '=', $id)->select('nombre', 'id', 'activo')->get();
        if ($activarPrograma) :
            $this->updateLogUsuarios("La facultad " . $informacionOriginal[0]->nombre . " fue activada", 'facultad', $informacionOriginal, $informacionActualizada);
            return  "habilitado";
        else :
            return "false";
        endif;
    }

    public function obtenerPeriodo($id)
    {
        $periodoActualizar = DB::table('periodo')->where('id', '=', $id)->select('*')->get();
        return $periodoActualizar;
    }

    public function crear_periodo(Request $request)
    {
        $nombre = $_POST['name'];
        $fecha1 = $_POST['ciclo1'];
        $fecha2 = $_POST['ciclo2'];
        $temprano = $_POST['temprano'];
        $periodo = $_POST['periodo'];
        $año = $_POST['fecha'];

        $crear = DB::table('periodo')->insert([
            'periodos' => $nombre,
            'fechaInicioCiclo1' => $fecha1,
            'fechaInicioCiclo2' => $fecha2,
            'fechaInicioTemprano' => $temprano,
            'fechaInicioPeriodo' => $periodo,
            'activoCiclo1' => 0,
            'activoCiclo2' => 0,
            'periodoActivo' => 0,
            'year' => $año,
        ]);
        $informacionOriginal = $request->except(['_token']);
        if ($crear) :
            $this->insertLogUsuarios("Periodo creado", 'periodo', $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.periodos')->with('success', 'Periodo creado correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('facultad.periodos')->with(['errors' => 'El periodo no ha podido ser creado']);
        endif;
    }

    /** Metodo para actualizar los datos de periodo */
    public function updateperiodo(Request $request)
    {
        $id_llegada = $_POST['id'];
        $nombre = $_POST['nombre'];
        $fecha1 = $_POST['fecha1'];
        $fecha2 = $_POST['fecha2'];
        $temprano = $_POST['temprano'];
        $periodo = $_POST['periodo'];
        $año = $_POST['año'];

        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = $this->obtenerPeriodo($id);
        /** Consulta para actualizar facultad */
        $periodo = DB::table('periodo')
            ->where('id', $id)
            ->update([
                'periodos' => $nombre,
                'fechaInicioCiclo1' => $fecha1,
                'fechaInicioCiclo2' => $fecha2,
                'fechaInicioTemprano' => $temprano,
                'fechaInicioPeriodo' => $periodo,
                'year' => $año,
            ]);
        $request->merge(['id' => $id]);
        $informacionActualizada = $request->except(['_token']);
        if ($periodo) :
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            $this->updateLogUsuarios("El periodo " . $informacionOriginal[0]->periodos . " fue actualizado ", 'periodo', $informacionOriginal, $informacionActualizada);
            return "actualizado";
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return "false";
        endif;
    }

    /** Función para activar los periodos */
    public function activar_periodo()
    {
        $id_llegada = $_POST['id'];
        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = DB::table('periodo')->where('id', '=', $id)->select('periodos', 'id', 'periodoActivo')->get();
        $activarPeriodo = DB::table('periodo')->where('id', '=', $id)->update(['periodoActivo' => 1]);
        $informacionActualizada = DB::table('periodo')->where('id', '=', $id)->select('periodos', 'id', 'periodoActivo')->get();
        if ($activarPeriodo) :
            $this->updateLogUsuarios("El periodo " . $informacionOriginal[0]->periodos . " fue activado ", 'periodo', $informacionOriginal, $informacionActualizada);
            return  "habilitado";
        else :
            return "false";
        endif;
    }

    /** Función para desactivar los periodos */
    public function inactivar_periodo()
    {
        $id_llegada = $_POST['id'];
        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = DB::table('periodo')->where('id', '=', $id)->select('periodos', 'id', 'periodoActivo')->get();
        $inactivarPeriodo = DB::table('periodo')->where('id', '=', $id)->update(['periodoActivo' => 0]);
        $informacionActualizada = DB::table('periodo')->where('id', '=', $id)->select('periodos', 'id', 'periodoActivo')->get();
        if ($inactivarPeriodo) :
            $this->updateLogUsuarios("El periodo " . $informacionOriginal[0]->periodos . " fue inactivado ", 'periodo', $informacionOriginal, $informacionActualizada);
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }


    /** Método para obtener regla de negocio según si id
     * 
     */
    public function obtenerRegla($id)
    {
        $reglaActualizar = DB::table('reglasNegocio')->where('id', '=', $id)->select('*')->get();
        return $reglaActualizar;
    }

    public function crear_regla(Request $request)
    {
        $programa = $_POST['codigo'];
        $creditos = $_POST['creditos'];
        $materias = $_POST['materias'];
        $estudiante = $_POST['estudiante'];

        if (isset($_POST['ciclo1'])) {
            $ciclo = $_POST['ciclo1'];
        } else {
            $ciclo = $_POST['ciclo2'];
        }

        $crear = DB::table('reglasNegocio')->insert([
            'programa' => $programa,
            'creditos' => $creditos,
            'materiasPermitidas' => $materias,
            'tipoEstudiante' => $estudiante,
            'ruta' => 0,
            'ciclo' => $ciclo,
        ]);
        $informacionOriginal = $request->except(['_token']);
        if ($crear) :
            $this->insertLogUsuarios("Regla creada", 'ReglasNegocio', $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.reglas')->with('success', 'Regla creada correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('facultad.reglas')->with(['errors' => 'La regla no ha podido ser creada']);
        endif;
    }

    public function updateregla(Request $request)
    {
        $id_llegada = $_POST['id'];
        $programa = $_POST['programa'];
        $creditos = $_POST['creditos'];
        $materias = $_POST['materias'];
        $estudiante = $_POST['estudiante'];
        $ciclo = $_POST['ciclo'];

        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }

        $informacionOriginal = $this->obtenerRegla($id);
        $regla = DB::table('reglasNegocio')
            ->where('id', $id)
            ->update([
                'programa' => $programa,
                'creditos' => $creditos,
                'materiasPermitidas' => $materias,
                'tipoEstudiante' => $estudiante,
                'ciclo' => $ciclo,
            ]);

        $request->merge(['id' => $id]);
        $informacionActualizada = $request->except(['_token']);

        if ($regla) :
            $this->updateLogUsuarios("La regla " . $informacionOriginal[0]->programa . " fue actualizada ", 'reglasNegocio', $informacionOriginal, $informacionActualizada);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return "actualizado";
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return "false";
        endif;
    }

    public function activarregla()
    {
        $id_llegada = $_POST['id'];
        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = DB::table('reglasNegocio')->where('id', '=', $id)->select('programa', 'id', 'activo')->get();
        $activarRegla = DB::table('reglasNegocio')->where('id', '=', $id)->update(['activo' => 1]);
        $informacionActualizada = DB::table('reglasNegocio')->where('id', '=', $id)->select('programa', 'id', 'activo')->get();
        if ($activarRegla) :
            $this->updateLogUsuarios("La regla " . $informacionOriginal[0]->programa . " fue activada ", 'reglasNegocio', $informacionOriginal, $informacionActualizada);
            return  "habilitado";
        else :
            return "false";
        endif;
    }

    public function inactivarregla()
    {
        $id_llegada = $_POST['id'];
        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = DB::table('reglasNegocio')->where('id', '=', $id)->select('programa', 'id', 'activo')->get();
        $inactivarRegla = DB::table('reglasNegocio')->where('id', '=', $id)->update(['activo' => 0]);
        $informacionActualizada = DB::table('reglasNegocio')->where('id', '=', $id)->select('programa', 'id', 'activo')->get();
        if ($inactivarRegla) :
            $this->updateLogUsuarios("La regla " . $informacionOriginal[0]->programa . " fue activada ", 'reglasNegocio', $informacionOriginal, $informacionActualizada);
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    /**
     * Método para registrar en el Log de Usuarios la acción de update  
     */

    public function updateLogUsuarios($mensaje, $tabla, $informacionOriginal, $informacionActualizada)
    {

        LogUsuariosController::registrarLog('UPDATE', $mensaje, $tabla, json_encode($informacionOriginal), json_encode($informacionActualizada));
    }

    /**
     * Método para registrar en el Log de Usuarios la acción de insert 
     */

    public function insertLogUsuarios($mensaje, $tabla, $informacionOriginal)
    {
        LogUsuariosController::registrarLog('INSERT', $mensaje, $tabla, json_encode($informacionOriginal), NULL);
    }

    public function vistaProgramasPeriodos()
    {
        return view('vistas.admin.programasPeriodos');
    }

    public function getProgramasPeriodos(Request $request)
    {
        $periodos = $request->input('periodos');
        
        $data = DB::table('programasPeriodos')->whereIn('periodo', $periodos)->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $data));
    }

    public function getProgramasPeriodosFacultad(Request $request)
    {
        $periodos = $request->input('periodos');
        $facultades = $request->input('idfacultad');
        $data = DB::table('programasPeriodos as Pp')
            ->join('programas as p', 'Pp.codPrograma', '=', 'p.codprograma')
            ->whereIn('Pp.periodo', $periodos)
            ->whereIn('p.Facultad', $facultades)
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $data));
    }

    /** Función para desactivar los periodos */
    public function inactivarProgramaPeriodo()
    {
        $id_llegada = $_POST['id'];
        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = DB::table('programasPeriodos')->where('id', '=', $id)->select('codPrograma', 'id', 'periodo', 'estado')->get();
        $inactivarPeriodo = DB::table('programasPeriodos')->where('id', '=', $id)->update(['estado' => 0]);
        $informacionActualizada = DB::table('programasPeriodos')->where('id', '=', $id)->select('codPrograma', 'id', 'periodo', 'estado')->get();
        if ($inactivarPeriodo) :
            $this->updateLogUsuarios("El periodo " . $informacionOriginal[0]->codPrograma . " - " . $informacionOriginal[0]->periodo . " fue inactivado ", 'programasPeriodos', $informacionOriginal, $informacionActualizada);
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    /** 
     * Función para activar los periodos 
     * */
    public function activarProgramaPeriodo()
    {
        $id_llegada = $_POST['id'];
        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = DB::table('programasPeriodos')->where('id', '=', $id)->select('codPrograma', 'id', 'periodo', 'estado')->get();
        $activarPeriodo = DB::table('programasPeriodos')->where('id', '=', $id)->update(['estado' => 1]);
        $informacionActualizada = DB::table('programasPeriodos')->where('id', '=', $id)->select('codPrograma', 'id', 'periodo', 'estado')->get();
        if ($activarPeriodo) :
            $this->updateLogUsuarios("El periodo " . $informacionOriginal[0]->codPrograma . " - " . $informacionOriginal[0]->periodo . " fue activado ", 'programasPeriodos', $informacionOriginal, $informacionActualizada);
            return  "habilitado";
        else :
            return "false";
        endif;
    }

    /**
     * Método que trae los periodos activos de cada programas
     */
    public function programasActivos()
    {
        $periodosActivos = DB::table('periodo')->where('periodoActivo',1)->select('periodos')->get();

        $periodos = [];

        foreach ($periodosActivos as $key){
            $dosUltimosDigitos = substr($key->periodos, -2);
            $periodos[] = $dosUltimosDigitos;
        }

        return $periodos;
    }
}
