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

        $consulta = DB::table('users')->where('id','=',$request->id,
        'email','=',$request->email,
        'documento','=',$request->documento)->get();
        
        if(!empty($consulta))
        {
            //* return view('nuevacontraseña.index');
        }
        else
        {
            return false;
            // return redirect()->route('cambio.index')->with('consultaFallida', 'Usuario no encontrado');
        }
        return $consulta;
    }

    public function cambiar() {

    }
}