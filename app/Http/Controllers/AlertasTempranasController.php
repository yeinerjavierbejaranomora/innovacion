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
        var_dump($_POST);die();
    }
}
