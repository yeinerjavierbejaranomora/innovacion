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

class facultadController extends Controller
{
    /** Función para cargar la vista de los programas */
    public function view_programas()
    {
        /**Se retorna la vista de los programas de pregado */
        return view('vistas.admin.programas');
    }

    /** Función para cargar la vista de las especializaciones */
    public function view_especializacion()
    {
        /**Se retorna la vista de la especialización */
        return view('vistas.admin.especializacion');
    }

    /** Función para cargar la vista de las maestrías */
    public function view_maestria()
    {
        /**Se retorna la vista de la maestría */
        return view('vistas.admin.maestria');
    }

    /** Función para cargar la vista de educación continua */
    public function view_continua()
    {
        /**Se retorna la vista de educación continua */
        return view('vistas.admin.educacioncontinua');
    }

    /** Función para cargar la vista de periodos */
    public function view_periodos()
    {
        /**Se retorna la vista de los periodos */
        return view('vistas.admin.periodos');
    }

    /** Función para cargar la vista de las reglas de negocio */
    public function view_reglas()
    {
        /**Se retorna la vista de las reglas de negocio */
        return view('vistas.admin.reglasnegocio');
    }


    /** Función para traer todos los programas */
    public function get_programas()
    {
        /**Realiza la consulta anidada para obtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'programas.activo', 'programas.idFacultad', 'facultad.nombre')
            ->where('programas.tabla', '=', 'pregrado')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $programas));
    }

    /** Función para traer todas las especializaciones */

    public function get_especializacion()
    {
        /**Realiza la consulta anidada para onbtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'facultad.nombre', 'programas.activo', 'programas.idFacultad')
            ->where('programas.tabla', '=', 'especializacion')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de programas */
        echo json_encode(array('data' => $programas));
    }

    /** Función para traer todas las maestrías */

    public function get_maestria()
    {
        /**Realiza la consulta anidada para onbtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'facultad.nombre', 'programas.activo', 'programas.idFacultad')
            ->where('programas.tabla', '=', 'MAESTRIA')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $programas));
    }

    public function get_continua()
    {
        /**Realiza la consulta anidada para onbtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'facultad.nombre', 'programas.activo', 'programas.idFacultad')
            ->where('programas.tabla', '=', 'EDUCACION CONTINUA')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $programas));
    }

    public function get_periodos()
    {
        /** Se obtiene toda la tabla de periodo*/
        $periodos = DB::table('periodo')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $periodos));
    }

    public function get_reglas()
    {
        /** Se obtiene toda la tabla de reglas de negocio */
        $reglas = DB::table('reglasNegocio')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $reglas));
    }

    public function facultad(Request $request)
    {
        $nombre = DB::table('facultad')->select('nombre')->where('id', '=', decrypt($request->id))->get();
        return view('vistas.admin.facultad', ['id' => $request->id], ['nombre' => $nombre[0]->nombre]);
    }

    /** Función para mostrar los programas según el id de la facultad */
    /*  public function mostrarfacultad($id_llegada)
    {
        // Decripta el id que recibe
        $id = decrypt($id_llegada);
        // Consulta para obtener los programas según id de facultad
        $facultad = DB::table('programas')->select('id', 'codprograma', 'programa', 'tabla','activo')
            ->where('idFacultad', '=', $id)
            ->where('activo', '=', 1)->get();
        mostrar los datos en formato JSON 
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users 
        echo json_encode(array('data' => $facultad));
    }
    */

    public function malla($codigo)
    {
        $nombre = DB::table('programas')->select('programa')->where('codprograma', '=', $codigo)->get();

        return view('vistas.admin.malla', ['codigo' => $codigo], ['nombre' => $nombre[0]->programa]);
    }

    public function mostrarmallacurricular($codigo)
    {
        // Consulta para obtener la malla curricular del programa
        $malla = DB::table('mallaCurricular')->where('codprograma', '=', $codigo)->get();
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
            $this->updateLogUsuarios("El programa ". $informacionOriginal[0]->programa . " fue desactivado", "programa", $informacionOriginal, $informacionActualizada);
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
            $this->updateLogUsuarios("El programa ". $informacionOriginal[0]->programa . " fue activado","programa", $informacionOriginal, $informacionActualizada);
            
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
        $informacionOriginal= $request->except(['_token']);
        if ($crear) :
            $this->createLogUsuarios("Programa creado", "programa", $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.programas')->with('message', 'Programa creado correctamente');
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
        $informacionOriginal= $request->except(['_token']);
        if ($crear) :
            $this->createLogUsuarios("Especialización creada", "programa", $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.especializacion')->with('message', 'Especialización creada correctamente');
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
        $informacionOriginal= $request->except(['_token']);
        if ($crear) :
            $this->createLogUsuarios("Maestría creada", "programa", $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.maestria')->with('message', 'Maestria creada correctamente');
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
        $informacionOriginal= $request->except(['_token']);
        if ($crear) :
            $this->createLogUsuarios("Programa de educación continua creado", "programa", $informacionOriginal);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.continua')->with('message', 'Programa creado correctamente');
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
            $this->updateLogUsuarios("El programa ".$informacionOriginal[0]->programa." fue actualizado","programa",$informacionOriginal,$informacionActualizada); 
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return "actualizado";
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return "false";
        endif;
    }

    /** Función para visualizar la vista de los programas del usuario */

    public function programasUsuario($nombre)
    {
        // Se obtiene el id del programa que recibe el metodo
        $consulta = DB::table('facultad')->where('nombre', '=', $nombre)->get();
        $idFacultad = $consulta[0]->id;
        // Se consulta cuales son los programas que se encuentran activos
        $programas = DB::table('programas')->where('idFacultad', '=', $idFacultad)->where('activo', '=', 1)->select('programa', 'id', 'codprograma')->get();
        $cuenta = array();
        // Con este foreach se cuentan los alumnos inscritos en el programa
        foreach ($programas as $key => $value) {
            $cantidad = DB::table('estudiantes')->where('programa', '=', $value->codprograma)->count();
            // array_push($cuenta, $cantidad);
            $cuenta[$value->codprograma] = $cantidad;
        }
        // Se almacena el nombre de la facultad y los programas que se encuentra activos en la variable datos 
        $datos = array(
            'facultad' => $nombre,
            'programas' => $programas,
        );

        return view('vistas.admin.facultades', ['estudiantes' => $cuenta])->with('datos', $datos);
    }

    /**Función para visualizar los estudiantes de cada facultad */
    public function estudiantesFacultad($id)
    {
        $consulta = DB::table('programas')->where('id', '=', $id)->get();
        $codigo = $consulta[0]->codprograma;
        $estudiantes = DB::table('estudiantes')->where('programa', '=', $codigo)->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $estudiantes));
    }

    /** @author Ruben Charry
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
        $informacionOriginal= $request->except(['_token']);
        if ($facultad) :
            $this->createLogUsuarios("Facultad creada",'facultad',$informacionOriginal);
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
            $this->updateLogUsuarios("La facultad ". $informacionOriginal[0]->nombre ." fue actualizada",'facultad',$informacionOriginal,$informacionActualizada);
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
            $this->updateLogUsuarios("La facultad ". $informacionOriginal[0]->nombre ." fue desactivada",'facultad', $informacionOriginal, $informacionActualizada);
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
            $this->updateLogUsuarios("La facultad ". $informacionOriginal[0]->nombre ." fue activada",'facultad', $informacionOriginal, $informacionActualizada);
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
        $informacionOriginal= $request->except(['_token']);
        if ($crear) :
            $this->createLogUsuarios("Periodo creado",'periodo',$informacionOriginal);
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
            $this->updateLogUsuarios( "El periodo ". $informacionOriginal[0]->periodos . " fue actualizado ",'periodo',$informacionOriginal,$informacionActualizada);
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
            $this->updateLogUsuarios("El periodo ". $informacionOriginal[0]->periodos . " fue activado ",'periodo', $informacionOriginal,$informacionActualizada);
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
            $this->updateLogUsuarios("El periodo ". $informacionOriginal[0]->periodos . " fue inactivado ",'periodo', $informacionOriginal,$informacionActualizada);
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    public function crear_regla()
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
            'Programa' => $programa,
            'creditos' => $creditos,
            'materiasPermitidas' => $materias,
            'tipoEstudiante' => $estudiante,
            'ruta' => "",
            'ciclo' => $ciclo,
        ]);

        if ($crear) :
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.reglas')->with('message', 'Regla creada correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('facultad.reglas')->with(['errors' => 'La regla no ha podido ser creada']);
        endif;
    }

    public function updateregla()
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

        $regla = DB::table('reglasNegocio')
            ->where('id', $id)
            ->update([
                'Programa' => $programa,
                'creditos' => $creditos,
                'materiasPermitidas' => $materias,
                'tipoEstudiante' => $estudiante,
                'ciclo' => $ciclo,
            ]);

        if ($regla) :
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
        $activarPeriodo = DB::table('reglasNegocio')->where('id', '=', $id)->update(['activo' => 1]);
        if ($activarPeriodo) :
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
        $inactivarPeriodo = DB::table('reglasNegocio')->where('id', '=', $id)->update(['activo' => 0]);
        if ($inactivarPeriodo) :
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    /**
     * Método para registrar en el Log de Usuarios la acción de activar algún dao en la base de datos
     * @author Ruben Charry 
     */

    public function updateLogUsuarios($mensaje,$tabla, $informacionOriginal, $informacionActualizada)
    {

        LogUsuariosController::registrarLog('UPDATE',$mensaje ,$tabla, json_encode($informacionOriginal), json_encode($informacionActualizada));
    }

  

    public function createLogUsuarios($mensaje,$tabla, $informacionOriginal)
    {
        LogUsuariosController::registrarLog('INSERT', $mensaje , $tabla, json_encode($informacionOriginal), NULL);
    }
    
}
