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


/** campos de usuario
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
    public function home(){

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
        // extraemos el rol del usuario logueado
        $id_rol=auth()->user()->id_rol;

        /// traemos los roles de la base de datos para poder cargar la vista
        $rol_db=DB::table('roles')->where([['id','=',$id_rol]])->get();

        /*traempos el nombre del rol para cargar la vista*/
        $nombre_rol=$rol_db[0]->nombreRol;

        //return view('login_prueba/login');
        return view('vistas/'.$nombre_rol);


    }
    // funcion para traer todos los usuarios a la vista de administracion

    public function get_users(){


    }



}
