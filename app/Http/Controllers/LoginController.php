<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function login(Request $request){
        //return $request;
        /*$credenciales = $request->getCredentials();

        if(!Auth::validate($credenciales)):
            return "Error";
        endif;

        $usuario = Auth::getProvider()->retrieveByCredentials($credenciales);
        return $usuario;*/
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            return "Exito";
           /* $request->session()->regenerate();

            return redirect()->intended('dashboard');*/
        }

        return "fallo";
    }
}
