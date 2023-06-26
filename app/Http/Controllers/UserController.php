<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CambioPassRequest;
use App\Http\Requests\UsuarioLoginRequest;
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

        /// traemos los roles de la base de datos para poder cargar la vista
        $rol_db = DB::table('roles')->where([['id', '=', $user->id_rol]])->get();

        /*traempos el nombre del rol para cargar la vista*/
        $nombre_rol = $rol_db[0]->nombreRol;
        auth()->user()->nombre_rol = $nombre_rol;
        /** traemos las facultades del sistema  */
        if (!empty($user->id_facultad)) {

            /** trae la facultad asignada */
            $facultad = DB::table('facultad')->where([['id', '=', $user->id_facultad]])->get();
        } else {

            /** si es super admin trae todas las facultades */
            $facultad = DB::table('facultad')->get();
        }


        // dd($user->nombre_rol);
        /**  if(auth()->user()->nombre=="yeiner javier bejarano mora"){
         * return ( $facultad);
         *}
         */


        /** creamos el array con los datos necesarios */
        $datos = array(
            'rol' => $nombre_rol,
            'facultad' => $facultad
        );

        if ($nombre_rol === 'Admin') {
            $nombre_rol = strtolower($nombre_rol);
        }

        /** cargamos la vista predeterminada para cada rol con la data */
        return view('vistas.' . $nombre_rol)->with('datos', $datos);
    }

    // funcion para traer todos los usuarios a la vista de administracion

    public function userView(Request $request)
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

    public function facultadView(Request $request)
    {
        /**Se retorna la vista del listado de facultades */
        return view('vistas.admin.facultades');
    }

    ///** funcion para cargar vistas de facultades */
    public function get_facultades()
    {
        /* Consulta para obtener las facultades */
        $facultades = DB::table('facultad')->select('facultad.codFacultad','facultad.nombre')->get();
        /* Mostrar los datos en formato JSON*/
        header("Content-Type: application/json");
        /* Se pasa a formato JSON el arreglo de facultades */
        echo json_encode(array('data'=>$facultades));
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
        // *Condición para descencriptar el id del usuario
        $id = base64_decode(urldecode($id_llegada));

        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }

        //return $id;
        // *Consulta SQL para obtener todos los datos del id
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
            foreach ($programas as $key => $value) {
                $nombres = DB::table('programas')->select('programa')->where('id', '=', $value)->get();
                $nombre_programas[$value] = $nombres[0]->programa;
            }
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
        if ($user->id_facultad != NULL) {
            // *Consulta para obtener el nombre de la facultad según el ID de esta
            $facultad = DB::table('facultad')->select('facultad.nombre')->where('id', '=', $user->id_facultad)->first();
            $facultad = $facultad->nombre;
            // *Explode para que muestre los programas por separado
            $programa = trim($user->programa, ';');
            $programas = explode(";", $programa);
            //$programas = explode(";", $user->programa);
            // *Una vez obtenido el arreglo, se procede a obtener el nombre cada uno según su id
            foreach ($programas as $key => $value) {
                $consulta = DB::table('programas')->select('programa')->where('id', '=', $value)->get();
                $nombre_programas[$value] = $consulta[0]->programa;
            }
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

    // *Método que actualiza en la base de datos la edición del usuario
    public function actualizar($id, Request $request)
    {
        //dd($request->all());
        $id = decrypt($id);
        $idBanner = $request->id_banner;
        $documento = $request->documento;
        $nombre = $request->nombre;
        $email = $request->email;
        $idBanner = $request->id_banner;
        $idRol = $request->id_rol;
        $idFacultad = $request->facultades;
        $programa = $request->programa;
        $activo = $request->estado;
        $Programas = '';
        if($idFacultad == 0):
            $idFacultad = '';
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

        else:
            /** Si el valor recibido es vacio se pasa al campo este valor vacio */
            $Programas = '';
        endif;
        //return $Programas;
        //return $activo;
        if ($request->activo != 'on') :
            $activo = 0;
        else :
            $activo = 1;
        endif;

        $actualizar = DB::table('users')->where('id', $id)
            ->update([
                'id_banner' => $idBanner,
                'documento' => $documento,
                'nombre' => $nombre,
                'email' => $email,
                'id_rol' => $idRol,
                'id_facultad' => $idFacultad,
                'programa' => $Programas,
                'activo' => $activo,
            ]);
        if ($actualizar) :
            return  redirect()->route('user.perfil',['id'=> encrypt($id)])->with('Sucess', 'Actualizacion exitosa!');
        else :
            return redirect()->route('user.perfil',['id'=> encrypt($id)])->withErrors('Error', 'Error al actuaizar los datos del usuario');
        endif;
    }
}
