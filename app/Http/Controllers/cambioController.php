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
        
        if($consulta)
        {
            return view('nuevacontraseña.index');
        }
    }

    public function cambiar() {

    }
}