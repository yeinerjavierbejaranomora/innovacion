<?php

namespace App\Http\Controllers;

use App\Models\Mafi;
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

    public function getDataMafi(){
        $data = Mafi::all();
        return $data;
    }
}
