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

    // * Método que consulta los datos ingresados por el usuario para verificar si existe en la base de datos
    // y así poder llevar a cabo del cambio de contraseña *
    
    public function consultar(Request $request ) {
    
        $consulta = DB::table('users')->where([['id_banner','=',$request->idbanner],
        ['email','=',$request->correo],
        ['documento','=',$request->documento]])->get();

        if($consulta == '[]'){
            
            return redirect()->route('cambio.index')->with('consultaFallida', 'Usuario no encontrado');
        }
        else{
            return view('nuevacontraseña.index');
        }
    }

    public function cambiar() {

    }
}