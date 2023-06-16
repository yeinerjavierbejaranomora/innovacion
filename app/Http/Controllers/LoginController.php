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

    public function login(UsuarioLoginRequest $request){
        $credenciales = $request->getCredentials();

        if(!Auth::validate($credenciales)):
            return "Error";
        endif;

        $usuario = Auth::getProvider()->retrieveByCredentials($credenciales);
        return $usuario;
    }
}
