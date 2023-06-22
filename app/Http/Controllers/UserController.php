<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CambioPassRequest;
use App\Http\Requests\UsuarioLoginRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


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

        /** cargamos la vista predeterminada para cada rol con la data */
        return view('vistas/' . $nombre_rol)->with('datos', $datos);
    }

    // funcion para traer todos los usuarios a la vista de administracion

    public function userView(Request $request)
    {
        if ($request->ajax()) :
            return datatables()->of(User::All())->toJson();
        endif;
        return view('vistas.admin.usuarios');
    }

    public function get_users()
    {
        $users = User::all();
        $users = json_encode($users);
        return $users;
    }

    // *Método para mostrar todos sus datos al Usuario, recibe el id de usuario como parámetro
    public function perfil($id)
    {
        // *Inicialmente decripta el id*
        $id = decrypt($id);
        // *Definimos la variable usuario con todos sus datos*
        $user = auth()->user();

        if ($user->id_facultad != NULL) {
           list( $nombre_programas, $facultad) = $this->getfacultadyprograma($id);
        } else {
            $facultad =  $nombre_programas = NULL;
        }
        
        $roles = $this->getrol($id);

        $datos = array(
            'facultad' => $facultad,
            'rol' => $roles[0]->nombreRol,
            'programa' => $nombre_programas
        );

        return view('vistas.perfil')->with('datos', $datos);
    }


    // *Función que captura la facultad y el programa del usuario
    public function getfacultadyprograma($id)
    {
        $user = auth()->user();
        $facultad = DB::table('facultad')->select('facultad.nombre')->where('id', '=', $user->id_facultad)->first();
        $facultad = $facultad->nombre;

        $programas = explode(";", $user->programa);
        foreach ($programas as $key => $value) {
            $consulta = DB::table('programas')->select('programa')->where('id', '=', $value)->get();
            $nombre_programas[$value] = $consulta[0]->programa;
        }
        return [$nombre_programas, $facultad];
    }

    // *Función que captura el rol del usuario

    public function getrol($id)
    {
        $user = auth()->user();
        $roles = DB::table('roles')->select('roles.nombreRol')->where('id', '=', $user->id_rol)->get();
        return $roles;
    }


    // *Método para actualizar los datos del usuario*
    public function editar($id)
    {
        $id = decrypt($id);
        list( $nombre_programas, $facultad) = $this->getfacultadyprograma($id);
        $roles = $this->getrol($id);

        $datos = array(
            'facultad' => $facultad,
            'rol' => $roles[0]->nombreRol,
            'programa' => $nombre_programas
        );

        return view('vistas.editarperfil')->with('datos', $datos);
    }

    ///** funcion para cargar vistas de facultades */
    public function facultad()
    {
        dd(auth()->user());
        return auth()->user()->nombre;
    }
}
