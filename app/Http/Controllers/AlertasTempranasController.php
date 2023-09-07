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

    public function tablaAlertasP(Request $request){
        $periodos = $_POST['periodos'];
        $programas = $_POST['programas'];
        var_dump($_POST);die();
    }

    public function tablaAlertasFacultad(Request $request){
        $periodos = $_POST['periodos'];
        $programas = $_POST['programas'];
        var_dump($_POST);die();
    }

    public function tablaAlertas(Request $request){
        $periodos = $_POST['periodos'];
        var_dump($_POST);die();
    }
}
