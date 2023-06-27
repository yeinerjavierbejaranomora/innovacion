<?php

namespace App\Http\Controllers;

use App\Models\Mafi;
use App\Models\Periodo;
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
        $periodos = Periodo::all();
        return $periodos;
        /*$data = Mafi::where([['estado','<>','Inactivo']]);
        $dataLongitud = count($data);*/
    }
}
