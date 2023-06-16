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
        $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        return "Exito";
    }

    return 'email The provided credentials do not match our records.';
    }
}
