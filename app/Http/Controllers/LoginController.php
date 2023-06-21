<?php

namespace App\Http\Controllers;

use App\Http\Requests\CambioPassRequest;
use App\Http\Requests\UsuarioLoginRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    /** funcion para iniciasr session */
    public function home()
    {
        /** verificamos  si el no se a logueado */
        if (Auth::check()) :
            /** si es la primera vez en la plataforma se le solicita cambio de contraseña */
            if(auth()->user()->ingreso_plataforma == 0):

                return  redirect()->route('login.cambio');

            endif;
        /** de lo contrario redirigimos a la vista correspondiente */

        //return "Hola Usuario".auth()->user()->nombre;

        return redirect()->route('home.index');
        endif;

        return redirect()->route('login.index');
    }

    /** funcion para llamar kla vista de cambio de contraseña */
    public function cambio(){
        return view('password.index');
    }

    /** funcion para realizar el  cambio de la contraseña */
    public function cambioPass(CambioPassRequest $request){

        /** verificamos la base de datos  con los datos necesarios para realizar el cambio de contraseña */
        $user = DB::table('users')->select('users.email','users.password')->where('id','=',$request->id)->where('documento','=',$request->password_actual)->first();
        /** varificamos si la contraseña actual es identica a la guarda en la DB cuando se creo el usuario, se usa Hash::check para decifrar la contraseña guardada */
        if(Hash::check($request->password_actual,$user->password)):
            /** Se realiza el update de la password si el id y el documento son iguales a los datos que vienen del formulario  */
            $cambioPass = User::where('id','=',$request->id)->where('documento','=',$request->password_actual)->update(['password'=> bcrypt($request->password),'ingreso_plataforma'=>1]);
            /**si el update se hace correctamente se redirige al formulario de login */
            if($cambioPass):
                return redirect()->route('login.index');
            endif;
        endif;
    }

    /** funcion de verificacion de usuario */
    public function login(UsuarioLoginRequest $req)
    {
        /**  autenticar al usuario en el sistema, realizando la validacion con el metodo getCredentials del Request
         * solo se valida el email y la password
         */
        $credentials = $req->getCredentials();
        /** Si regresa True, se regresa una instancion del proveedor de auteticación, para recuperar los datos e interartuar con la DB
         * y obtener las credenciales del usuario
         */
        if (Auth::attempt($credentials)) {
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($user, $remember = true);
            /**se llama el metodo authenticated para realizar el redireccionamiento al home  */
            return $this->authenticated($req, $user);
        }

        return redirect()
            ->back()
            ->withErrors(['errors' => 'Invalid Credentials']);
    }


    /** funcion para redirigir al home si el usuario esta autenticado */
    public function authenticated(Request  $request, $user)
    {
        return redirect()->route('login.home');
    }

    /** funcion para cerrar sesion  */
    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login.index');
    }
}
