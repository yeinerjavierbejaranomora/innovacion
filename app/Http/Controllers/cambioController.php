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

    public function consultar() {
    
    }

    public function cambiar() {

    }
}