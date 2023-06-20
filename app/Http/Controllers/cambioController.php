<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cambioController extends Controller
{
    public function index() {
        return view('cambio.index');
    }

    public function nueva() {
        return view('nuevacontraseña.index');
    }

    public function consultar(Request $request ) {

        $password = DB::table('users')->where('id','=',$request->id,
        'email','=',$request->email,
        'documento','=',$request->documento)->get();

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