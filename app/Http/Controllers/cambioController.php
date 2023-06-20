<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cambioController extends Controller
{
    public function index() {
        return view('cambio.index');
    }

    public function nueva() {
        return view('nuevacontraseña.index');
    }

    public function consultar($id, $email, $documento) {

        $password = DB::table('users')->select('users.password')->where('id','=',$id->id,
        'email','=',$email->email,
        'documento','=',$documento->documento);

        if(!empty($password))
        {
            return view('nuevacontraseña.index');
        }
        else
        {
            return redirect()->route('cambio.index')->with('consultaFallida', 'Usuario no encontrado');
        }
    }

    public function cambiar() {

    }
}