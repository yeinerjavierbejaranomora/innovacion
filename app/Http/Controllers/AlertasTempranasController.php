<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlertasTempranasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('vistas.admin.alertastempranas');
    }

    public function tablaProgramasP(Request $request){
        $periodos = $request->input('periodos');
        $programas = $request->input('programas');

        var_dump($programas);die();
    }
}
