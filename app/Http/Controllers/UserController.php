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

// use Yajra\DataTables\DataTables;


/** campos de usuario auth()->user()
 *
 *
 * id":2,
 * "id_banner":789,
 * "documento":789,
 * "nombre":"ihbkj",
 * "email":"juan@juan.com",
 * "id_rol":2,
 * "id_facultad":1,
 * "programa":"3;6;",
 * "ingreso_plataforma":1,
 * "activo":1,
 * "email_verified_at":null,
 * "created_at":"2023-06-20T14:45:03.000000Z",
 * "updated_at":"2023-06-20T17:08:15.000000Z"}
 *
 *
 */
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /// cargamos la vista dependiendo el usuario
    /**
     * 
     */
    public function home()
    {

        //return auth()->user()->id;
        // redirect()->route('login.home');

        /** para poder cargar las vistas especificas comproba,os los roles de usuario  */
        /** roles de usuario
         *Decano       = 1
         *Director     = 2
         *Coordinador  = 3
         *Lider        = 4
         *Docente      = 5
         *Estudiante   = 6
         */

        /** definimos la variable usuario */

        $user = auth()->user();


        $rol_db = DB::table('roles')->where([['id', '=', $user->id_rol]])->get();


        $nombre_rol = $rol_db[0]->nombreRol;
        auth()->user()->nombre_rol = $nombre_rol;

        if (!empty($user->id_facultad)) {
            $facultad = DB::table('facultad')->where([['id', '=', $user->id_facultad]])->get();
        } else {
            $facultad = DB::table('facultad')->get();
        }

        $datos = array(
            'rol' => $nombre_rol,
            'facultad' => $facultad
        );

        if ($nombre_rol === 'Admin') {
            $nombre_rol = strtolower($nombre_rol);
        }

        if ($nombre_rol === 'Decano') {
            // $facultades = DB::table('users as u')->join('facultad as f', 'f.id', '=', 'u.id_facultad')->select('f.nombre as name')->get();
            $idfacultad = trim($user->id_facultad, ',');
            $facultades = explode(",", $idfacultad);
            foreach ($facultades as $key => $value) {

                $consulta = DB::table('facultad')->where('id', $value)->select('nombre')->first();
                $nombreFacultades[$value] = $consulta->nombre;
            }
            return view('vistas.Decano', ['facultades' => $nombreFacultades])->with('datos', $datos);
        }

        if ($nombre_rol === 'Director' || $nombre_rol === 'Coordinador' || $nombre_rol === 'Lider') {
            $idPrograma = trim($user->programa, ';');
            $programas = explode(';', $idPrograma);
            foreach ($programas as $key => $value) {
                $consulta = DB::table('programas')->where('id', $value)->select('programa', 'codprograma')->first();
                $data[$value] = $consulta;
            }
            return view('vistas.' . $nombre_rol, ['programas' => $data])->with('datos', $datos);
        }


        /** cargamos la vista predeterminada para cada rol con la data */
        return view('vistas.' . $nombre_rol)->with('datos', $datos);
    }

    // funcion para traer todos los usuarios a la vista de administracion

    public function userView()
    {
        /**Se retorna la vista del listado usuarios */
        return view('vistas.admin.usuarios');
    }

    public function get_users()
    {
        /**Realiza la consulta anidada para onbtener el usuario con su rol */
        $users = DB::table('users')->join('roles', 'roles.id', '=', 'users.id_rol')
            ->select('users.id', 'users.id_banner', 'users.documento', 'users.activo', 'users.nombre', 'users.email', 'roles.nombreRol')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $users));
    }

    public function get_roles()
    {
        $roles = DB::table('roles')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $roles));
    }

    public function facultad_view()
    {
        /**Se retorna la vista del listado de facultades */
        return view('vistas.admin.administracionfacultades');
    }

    public function roles_view()
    {
        /**Se retorna la vista del listado usuarios */
        return view('vistas.admin.roles');
    }

    ///** funcion para cargar vistas de facultades */
    public function get_facultades()
    {
        /* Consulta para obtener las facultades */
        $facultades = DB::table('facultad')->select('facultad.id', 'facultad.codFacultad', 'facultad.nombre', 'facultad.activo')->get();
        /* Mostrar los datos en formato JSON*/
        header("Content-Type: application/json");
        /* Se pasa a formato JSON el arreglo de facultades */
        echo json_encode(array('data' => $facultades));
    }

    // *Método para mostrar todos sus datos al Usuario
    public function perfil()
    {
        // *Se llama la función para obtener facultad y programa del usuario*
        list($nombre_programas, $facultad) = $this->getfacultadyprograma();
        // * Función para obtener el rol del usuario
        $roles = $this->getrol();
        // *Array para retornar todos los datos obtenidos
        $datos = array(
            'facultad' => $facultad,
            'rol' => $roles[0]->nombreRol,
            'programa' => $nombre_programas
        );
        // *Retornar vista y arreglo con los datos*
        return view('vistas.perfil')->with('datos', $datos);
    }

    // *Método para cargar la vista de edicion de datos del usuario*
    public function editar($id_llegada)
    {
        $id = base64_decode(urldecode($id_llegada));

        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }

        $consulta = DB::table('users')->select('*')->where('id', '=', $id)->get();

        // *Condicional para determinar si el usuario cuenta con una facultad
        if ($consulta[0]->id_facultad != NULL) {
            // *Consulta para obtener el nombre de la facultad
            $facultad = DB::table('facultad')->select('facultad.nombre')->where('id', '=', $consulta[0]->id_facultad)->first();
            $facultad = $facultad->nombre;
            // *Explode para que muestre los programas por separado
            $programa = trim($consulta[0]->programa, ';');
            $programas = explode(";", $programa);
            //$programas = explode(";", $user->programa);
            // *Una vez obtenido el arreglo, se procede a obtener el nombre cada uno según su id
            //dd($programas);
            if (empty($programa)) :
                $nombre_programas = NULL;
            else :
                foreach ($programas as $key => $value) {
                    $nombres = DB::table('programas')->select('programa')->where('id', '=', $value)->get();
                    $nombre_programas[$value] = $nombres[0]->programa;
                }
            endif;
        }
        // *Si el usuario no tiene un facultad se preocede a dejar vacío dicho campo
        else {
            $facultad =  $nombre_programas = NULL;
        }
        $rol = DB::table('roles')->select('roles.nombreRol')->where('id', '=', $consulta[0]->id_rol)->get();
        $roles = Roles::all();
        $facultades = DB::table('facultad')->get();
        // *Arreglo con los datos obtenudos dentro del método
        $datos = array(
            'facultad' => $facultad,
            'rol' => $rol[0]->nombreRol,
            'programa' => $nombre_programas,
            'user' => $consulta[0]
        );
        return view('vistas.editarperfil', ['datos' => $datos, 'roles' => $roles, 'facultades' => $facultades]);
    }

    // *Función que captura la facultad y el programa del usuario
    public function getfacultadyprograma()
    {
        // *Obtenemos los datos del usuario*
        $user = auth()->user();
        // *Validación para determinar si el usuario cuenta con una facultad*
        if ($user->id_facultad != "NULL" || $user->programa != "NULL") {
            if ($user->id_facultad != "NULL" && !empty($user->id_facultad)) {
                $facultad = DB::table('facultad')->select('facultad.nombre')->where('id', '=', $user->id_facultad)->first();
                $facultad = $facultad->nombre;
            } else {
                $facultad = NULL;
            }
            $programa = trim($user->programa, ';');
            $programas = explode(";", $programa);
            //$programas = explode(";", $user->programa);
            // *Una vez obtenido el arreglo, se procede a obtener el nombre cada uno según su id
            if (empty($programa) || $programa == NULL) :
                $nombre_programas = NULL;
            else :
                foreach ($programas as $key => $value) {
                    $consulta = DB::table('programas')->select('programa')->where('id', '=', $value)->get();
                    $nombre_programas[$value] = $consulta[0]->programa;
                }
            endif;
        } else {
            $facultad =  $nombre_programas = NULL;
        }
        // *Retornar programas y facultad
        return [$nombre_programas, $facultad];
    }

    // *Función que captura el rol del usuario

    public function getrol()
    {
        // *Obtenemos los datos del usuario
        $user = auth()->user();
        // *Se obtiene el nombre del rol del usuario
        $roles = DB::table('roles')->select('roles.nombreRol')->where('id', '=', $user->id_rol)->get();
        // *Retornar nombre del rol
        return $roles;
    }

    /**
     * Metodo para obtener todos los datos de un usuario
     * @param id Id del usuario a actualizar 
     * @return usuarioActualizar Objeto con los datos del usuario
     */
    public function obtenerUsuario($id)
    {
        $usuarioActualizar = DB::table('users')->where('id', '=', $id)->select('*')->get();
        return $usuarioActualizar;
    }

    /**
     * Metodo que actualiza la tabla Log de Usuarios
     * @param id Id del usuario a actualizar 
     */
    public function registrarLog($id, $informacionOriginal, $request)
    {
        $request->merge(['id' => $id]);
        $parametros = collect($request->all())->except(['_token'])->toArray();
        $request->replace($parametros);
        LogUsuariosController::registrarLog('UPDATE', "El usuario " . $informacionOriginal[0]->nombre . " fue actualizado", 'Users',  json_encode($informacionOriginal), json_encode($request->all()));
    }

    // *Método que actualiza en la base de datos la edición del usuario
    public function actualizar($id, Request $request)
    {
        $id = decrypt($id);
        $id_banner = $request->id_banner;
        $documento = $request->documento;
        $nombre = $request->nombre;
        $email = $request->email;
        $idRol = $request->id_rol;
        $idFacultad = $request->facultades;
        $programa = $request->programa;
        $Programas = '';
        if ($idFacultad == 0) :
            $idFacultad = NULL;
        endif;
        /**se comprueba que el campo no este vacio*/
        if (isset($programa)) :
            /** Se recorre el arreglo recibido, y se añade a la variable $Programa
             *  en cada iteracion, añadiendole el ; como separador
             */
            foreach ($request->programa as $programa) :
                $Programas .= $programa . ";";
            endforeach;
            /**En el campo programa se añade el contenido de la variable $Programa */

        else :
            /** Si el valor recibido es vacio se pasa al campo este valor vacio */
            $Programas = '';
        endif;
        //return $Programas;
        //return $activo;
        if (isset($request->estado)) {
            if ($request->estado != 'on') :
                $activo = 0;
            else :
                $activo = 1;
            endif;
        } else {
            $activo = 1;
        }

        $informacionOriginal = $this->obtenerUsuario($id);

        $actualizar = DB::table('users')->where('id', $id)
            ->update([
                'id_banner' => $id_banner,
                'documento' => $documento,
                'nombre' => $nombre,
                'email' => $email,
                'id_rol' => $idRol,
                'id_facultad' => $idFacultad,
                'programa' => $Programas,
                'activo' => $activo,
            ]);

        if ($id === auth()->user()->id) :
            if ($actualizar) :
                $this->registrarLog($id, $informacionOriginal, $request);
                return  redirect()->route('user.perfil', ['id' => encrypt($id)])->with('Sucess', 'Actualizacion exitosa!');
            else :
                return redirect()->route('user.perfil', ['id' => encrypt($id)])->withErrors('Error', 'Error al actuaizar los datos del usuario');
            endif;
        else :
            if ($actualizar) :
                $this->registrarLog($id, $informacionOriginal, $request);
                return  redirect()->route('admin.users')->with('Sucess', 'Actualizacion exitosa!');
            else :
                return redirect()->route('admin.users')->withErrors('Error', 'Error al actuaizar los datos del usuario');
            endif;
        endif;
    }

    /** Funcion para activar o inactivar usuario */
    public function inactivar_usuario()
    {
        $id = $_POST['id'];
        $informacionOriginal = DB::table('users')->where('id', '=', $id)->select('id', 'nombre', 'activo')->get();
        $inactivarUsuario = DB::table('users')->where('id', '=', $id)->update(['activo' => 0]);
        $informacionActualizada = DB::table('users')->where('id', '=', $id)->select('id', 'nombre', 'activo')->get();
        if ($inactivarUsuario) :
            LogUsuariosController::registrarLog('UPDATE', "El usuario " . $informacionActualizada[0]->nombre . " fue inactivado", 'Users', json_encode($informacionOriginal), json_encode($informacionActualizada));
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    /** Funcion para activar o inactivar */
    public function activar_usuario()
    {
        $id = $_POST['id'];
        $informacionOriginal = DB::table('users')->where('id', '=', $id)->select('id', 'nombre', 'activo')->get();
        $activarUsuario = DB::table('users')->where('id', '=', $id)->update(['activo' => 1]);
        $informacionActualizada = DB::table('users')->where('id', '=', $id)->select('id', 'nombre', 'activo')->get();
        if ($activarUsuario) :
            LogUsuariosController::registrarLog('UPDATE', "El usuario " . $informacionActualizada[0]->nombre . " fue activado", 'Users', json_encode($informacionOriginal), json_encode($informacionActualizada));
            return  "habilitado";
        else :
            return "false";
        endif;
    }

    public function inactivar_rol()
    {
        $id = $_POST['id'];
        $informacionOriginal = DB::table('roles')->where('id', '=', $id)->select('id', 'nombreRol', 'activo')->get();
        $inactivarRol = DB::table('roles')->where('id', '=', $id)->update(['activo' => 0]);
        $informacionActualizada = DB::table('roles')->where('id', '=', $id)->select('id', 'nombreRol', 'activo')->get();
        if ($inactivarRol) :
            LogUsuariosController::registrarLog('UPDATE', "El rol " . $informacionActualizada[0]->nombreRol . " fue inactivado", 'Roles', json_encode($informacionOriginal), json_encode($informacionActualizada));
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    public function activar_rol()
    {
        $id = $_POST['id'];
        $informacionOriginal = DB::table('roles')->where('id', '=', $id)->select('id', 'nombreRol', 'activo')->get();
        $activarRol = DB::table('roles')->where('id', '=', $id)->update(['activo' => 1]);
        $informacionActualizada = DB::table('roles')->where('id', '=', $id)->select('id', 'nombreRol', 'activo')->get();
        if ($activarRol) :
            LogUsuariosController::registrarLog('UPDATE', "El rol " . $informacionActualizada[0]->nombreRol . " fue activado", 'Roles', json_encode($informacionOriginal), json_encode($informacionActualizada));
            return  "habilitado";
        else :
            return "false";
        endif;
    }

    /** @author Ruben Charry
     * Método para obtener los datos de la tabla roles del usuario según su id
     */
    public function obtenerRol($id)
    {
        $rolActualizar = DB::table('roles')->where('id', '=', $id)->select('*')->get();
        return $rolActualizar;
    }


    public function update_rol(Request $request)
    {
        $id_llegada = $_POST['id'];
        $nombre = $_POST['nombre'];


        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }
        $informacionOriginal = $this->obtenerRol($id);

        $update = DB::table('roles')->where('id', '=', $id)->update(['nombreRol' => $nombre]);

        $request->merge(['id' => $id]);
        $informacionAcualizada = $request->except(['_token']);

        if ($update) :
            LogUsuariosController::registrarLog('UPDATE', "El rol " . $informacionOriginal[0]->nombreRol . " fue actualizado", 'Roles', json_encode($informacionOriginal), json_encode($informacionAcualizada));
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return "actualizado";
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return "false";
        endif;
    }

    public function crear_rol(Request $request)
    {
        $nombre = $_POST['nombre'];

        $crear = DB::table('roles')->insert([
            'nombreRol' => $nombre,
        ]);

        $parametros = collect($request->all())->except(['_token'])->toArray();
        $request->replace($parametros);

        if ($crear) :
            LogUsuariosController::registrarLog('INSERT', "Rol creado", 'Roles', json_encode($request->all()), NULL);
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('admin.roles')->with('success', 'Rol creado correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('admin.roles')->with(['errors' => 'El rol no ha podido ser creado']);
        endif;
    }

    /**
     * Metodo que trae los programas de varias facultades
     * @param request recibe los nombres de los programas
     * @return JSON retorna los ids y nombres de programas según las facultades seleccionadas
     */
    public function traerProgramas(Request $request)
    {
        $idsFacultad = $request->input('idfacultad');
        $programas = DB::table('programas')->whereIn('Facultad', $idsFacultad)->select('id', 'programa', 'codprograma')->get();
        foreach ($programas as $programa) {
            $arreglo[] = [
                'id' => $programa->id,
                'nombre' => $programa->programa,
                'codprograma' => $programa->codprograma
            ];
        }
        header("Content-Type: application/json");
        echo json_encode($arreglo);
    }

    public function traerProgramasUsuarios (Request $request)
    {
        $codFacultad = $request->input('codfacultad');
        $nombreFacultad = DB::table('facultad')->whereIn('codfacultad',$codFacultad)->select('nombre')->get();
        foreach ($nombreFacultad as $facultad){
            echo $facultad->nombre;
        }
        die();
        $programas = DB::table('programas')->whereIn('Facultad', $nombreFacultad)->select('id', 'programa', 'codprograma')->get();
        foreach ($programas as $programa) {
            $arreglo[] = [
                'id' => $programa->id,
                'nombre' => $programa->programa,
                'codprograma' => $programa->codprograma
            ];
        }
        header("Content-Type: application/json");
        echo json_encode($arreglo);
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
    public function selloEstudiantesActivos()
    {
        /**
         * SELECT COUNT(sello) AS TOTAL, sello FROM `datosMafi`
         *GROUP BY sello
         */
        $sello = DB::table('datosMafi')
            ->select(DB::raw('COUNT(sello) AS TOTAL, sello'))
            ->groupBy('sello')
            ->get();

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
         *WHERE tipoestudiante = 'PRIMER INGRESO'
         *GROUP BY sello
         */
        $primerIngreso = DB::table('datosMafi')
            ->where('tipoestudiante', 'PRIMER INGRESO')
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
    public function tiposEstudiantes()
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
            ->limit(5)
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $tipoEstudiantes));
    }

    /**
     * Método que muestra los 5 operadores que mas estudiantes traen
     * @return JSON retorna un JSON con estos 5 operadores, agrupados por operador
     */
    public function operadores()
    {
        /**
         * SELECT COUNT(operador) AS TOTAL,operador FROM `datosMafi`
         *GROUP BY operador
         *ORDER BY TOTAL DESC
         *LIMIT 5
         */
        $operadores = DB::table('datosMafi')
            ->select(DB::raw('COUNT(operador) AS TOTAL, operador'))
            ->groupBy('operador')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $operadores));
    }

    /**
     * Método que muestra los 5 programas con mayor cantidad de estudiantes inscritos
     * @return JSON retorna un JSON con estos 5 programas, agrupados por programa
     */

    public function estudiantesProgramas()
    {
        /**
         * SELECT COUNT(codprograma) AS TOTAL, codprograma FROM `datosMafi`
         *GROUP BY codprograma
         *ORDER BY TOTAL DESC
         *LIMIT 5
         */

        $programas = DB::table('datosMafi')
            ->select(DB::raw('COUNT(codprograma) AS TOTAL, codprograma'))
            ->groupBy('codprograma')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();

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
         * SELECT  COUNT(dm.estado) AS TOTAL, dm.estado, p.Facultad FROM `datosMafi` dm
         *INNER JOIN programas p ON p.codprograma = dm.programa
         *WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         *GROUP BY dm.estado
         */
        $facultades = $request->input('idfacultad');
        $estudiantes = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
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
    public function selloEstudiantesFacultad(Request $request)
    {
        /**
         * SELECT COUNT(dm.sello) AS TOTAL, dm.sello FROM `datosMafi` dm
         *INNER JOIN programas p ON p.codprograma = dm.programa
         *WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         *GROUP BY dm.sello
         */
        $facultades = $request->input('idfacultad');
        $sello = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
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
    public function retencionEstudiantesFacultad(Request $request)
    {
        /**
         * SELECT COUNT(dm.autorizado_asistir) AS TOTAL, dm.autorizado_asistir FROM datosMafi dm
         *INNER JOIN programas p ON p.codprograma = dm.programa
         *WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         *WHERE dm.sello = 'TIENE RETENCION' 
         *GROUP BY dm.autorizado_asistir
         */
        $facultades = $request->input('idfacultad');
        $retencion = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
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
    public function primerIngresoEstudiantesFacultad(Request $request)
    {
        /**
         * SELECT COUNT(dm.sello) AS TOTAL, dm.sello
         *FROM datosMafi AS dm
         *JOIN programas AS p ON p.codprograma = dm.programa
         *WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         *AND dm.tipoestudiante = 'PRIMER INGRESO'
         *GROUP BY dm.sello;
         */

        $facultades = $request->input('idfacultad');
        $primerIngreso = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
            ->whereIn('p.Facultad', $facultades)
            ->where('dm.tipoestudiante', 'PRIMER INGRESO')
            ->select(DB::raw('COUNT(dm.sello) AS TOTAL, dm.sello'))
            ->groupBy('dm.sello')->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $primerIngreso));
    }

    /**
     * Método que muestra los 5 tipos de estudiantes con mayor cantidad de datos, de algunas facultades en específico
     * @return JSON retorna los tipos de estudiantes, agrupados por tipo de estudiante
     */
    public function tiposEstudiantesFacultad(Request $request)
    {
        /**
         * SELECT COUNT(tipoestudiante) AS 'TOTAL', tipoestudiante.dm
         * FROM datosMafi AS dm
         * JOIN programas AS p ON p.codprograma = dm.programa
         * WHERE p.Facultad IN ('') -- Reemplaza con las facultades específicas
         * GROUP BY tipoestudiante
         */
        $facultades = $request->input('idfacultad');
        $tipoEstudiantes = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
            ->whereIn('p.Facultad', $facultades)
            ->select(DB::raw('COUNT(dm.tipoestudiante) AS TOTAL, dm.tipoestudiante'))
            ->groupBy('dm.tipoestudiante')
            ->orderByDesc('TOTAL')
            ->limit(5)
            ->get();

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
        $operadores = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
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
        $programas = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
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
        $estudiantes = DB::table('datosMafi')
            ->whereIn('programa', $programas)
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
        $sello = DB::table('datosMafi')
            ->whereIn('programa', $programas)
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
        $retencion = DB::table('datosMafi')
            ->whereIn('programa', $programas)
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

        $programas = $request->input('programa');
        $primerIngreso = DB::table('datosMafi')
            ->whereIn('programa', $programas)
            ->where('tipoestudiante', 'PRIMER INGRESO')
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
        $tipoEstudiantes = DB::table('datosMafi')
            ->whereIn('programa', $programas)
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
         *LIMIT 5
         */
        $programas = $request->input('programa');
        $operadores = DB::table('datosMafi')
            ->whereIn('programa', $programas)
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
        $operadores = DB::table('datosMafi')
            ->whereIn('programa', $programas)
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
        $operadores = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
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
        $programas = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
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
        $facultades = $request->input('idfacultad');
        $tipoEstudiantes = DB::table('datosMafi as dm')
            ->join('programas as p', 'p.codprograma', '=', 'dm.programa')
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
        $programas = $request->input('programa');
        $tipoEstudiantes = DB::table('datosMafi')
            ->whereIn('programa', $programas)
            ->select(DB::raw('COUNT(tipoestudiante) AS TOTAL, tipoestudiante'))
            ->groupBy('tipoestudiante')
            ->orderByDesc('TOTAL')
            ->get();

        header("Content-Type: application/json");
        echo json_encode(array('data' => $tipoEstudiantes));
    }
}
