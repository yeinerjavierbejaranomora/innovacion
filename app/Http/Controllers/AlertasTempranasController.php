<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $consultaAlertas = DB::table('alertas_tempranas')
                        ->whereIn('periodo',$periodos)
                        ->whereIn('codprograma',$programas)
                        //->orderBy('created_at','desc')
                        ->get();
        return $consultaAlertas;
    }

    public function tablaAlertasFacultad(Request $request){
        $periodos = $_POST['periodos'];
        $programas = $_POST['programas'];
        $consultaAlertas = DB::table('alertas_tempranas')
                        ->whereIn('periodo',$periodos)
                        ->whereIn('codprograma',$programas)
                        //->orderBy('created_at','desc')
                        ->get();
        return $consultaAlertas;

    }

    public function tablaAlertas(Request $request){
        $periodos = $_POST['periodos'];
        var_dump($_POST);die();
    }
}
