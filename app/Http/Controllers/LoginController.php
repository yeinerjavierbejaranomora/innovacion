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

        return redirect()->route('login.index');
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
        //dd($request->all());
        $user = DB::table('users')->select('users.email','users.password')->where('id','=',$request->id)->where('documento','=',$request->password_actual)->get();
        if(Hash::check($request->password_actual,$user[0]->password)):
            $cambioPass = User::where('id','=',$request->id)->where('documento','=',$request->password_actual)->update(['password'=> bcrypt($request->password),'ingreso_plataforma'=>1]);
            if($cambioPass):
                return redirect()->route('login.index');
            endif;
        endif;
        //return $user;
    }

    /** funcion de verificacion de usuario */
    public function login(UsuarioLoginRequest $req)
    {
        /** traemos las credenciales del usuario  */
        $credentials = $req->getCredentials();
        //return $credentials;
        if (Auth::attempt($credentials)) {
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            //return $user;
            Auth::login($user, $remember = true);

            return $this->authenticated($req, $user);
            //return redirect()->intended('/');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }


    /** funcion para redirigir al home si el usuario esta autenticado */
    public function authenticated(Request  $request, $user)
    {
        //return $user;
        return redirect()->route('login.home');
    }

    /** funcion para cerrar sesion  */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()
            ->route('login.index');
    }
}
