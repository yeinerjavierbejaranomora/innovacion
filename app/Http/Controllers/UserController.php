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

        /** definimos la variable usuario */
        $user=auth()->user();

        /// traemos los roles de la base de datos para poder cargar la vista
        $rol_db=DB::table('roles')->where([['id','=',$user->id_rol]])->get();

        /*traempos el nombre del rol para cargar la vista*/
        $nombre_rol=$rol_db[0]->nombreRol;

        /** traemos las facultades del sistema  */
        if(!empty($user->id_facultad)){

            /** trae la facultad asignada */
            $facultad=DB::table('facultad')->where([['id','=',$user->id_facultad]])->get();

        }else{
            
            /** si es super admin trae todas las facultades */
            $facultad=DB::table('facultad')->get();

        }

if($user->nombre=="yeiner javier bejarano mora"){
return ($user);
}
           
       
        /** creamos el array con los datos necesarios */
        $datos=array(
            'rol'=>$nombre_rol,
            'facultad'=>$facultad
        );
       
        /** cargamos la vista predeterminada para cada rol con la data */
        return view('vistas/'.$nombre_rol)->with('datos',$datos);


    }
    // funcion para traer todos los usuarios a la vista de administracion

    public function userView(){
        return view('vistas.admin.usuarios');
    }

    public function get_users(){


    }

    public function perfil($id){
        $id = decrypt($id);

        $user = DB::table('users')->select('users.id_banner','users.documento',
        'users.nombre', 'users.email', 'users.id_rol', 'users.id_facultad',
         'users.programa','users.activo')->where('id','=',$id)->first();
         
        dd($user);
        $facultad = DB::table('facultad')->select('facultad.nombre')->where('id','=',$user[0]->id_facultad); 
        
        $rol = DB::table('roles')->select('roles.nombreRol')->where('id','=',$user[0]->id_rol);
        return view('vistas.perfil',$user, $facultad, $rol);
    }

    public function actualizar(){
        
    }


}
