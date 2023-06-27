<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MafiController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicioMafi() {
        return view('vistas.admin.mafi');
    }
}
