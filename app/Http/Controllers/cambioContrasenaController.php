<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cambiocontrasenaController extends Controller
{
    public function index() {
        return view('cambioContrasena.index');
    }
}