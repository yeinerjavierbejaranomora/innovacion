<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioLoginRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function login(UsuarioLoginRequest $request){
        $credentials = $request->getCredentials();
        return $credentials;
    }
}
