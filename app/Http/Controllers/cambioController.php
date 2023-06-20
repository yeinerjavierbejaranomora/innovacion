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
    
        $consulta = DB::table('users')->where([['id_banner','=',$request->idbanner],
        ['email','=',$request->correo],
        ['documento','=',$request->documento]])->get();
        
        return $consulta;
        if(strlen($consulta)>0){
           // return view('nuevacontraseña.index');
        }
        else{
           // return redirect()->route('cambio.index')->with('consultaFallida', 'Usuario no encontrado');
        }
    }

    public function cambiar() {

    }
}