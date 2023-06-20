<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioLoginRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function cambio()
    {
        if (Auth::check()) :
            return view('contrasena.index');
        endif;
        return redirect()->route('login.index');
    }


    public function login(UsuarioLoginRequest $req)
    {
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

    public function authenticated(Request  $request, $user)
    {
        //return $user;
        return redirect()->route('home');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()
            ->route('login.index');
    }
}
