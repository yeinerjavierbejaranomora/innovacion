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

    public function tablaAlertasP(){
        $periodos = $_POST['periodos'];
        $programas = $_POST['programas'];
        $consultaAlertas = DB::table('alertas_tempranas as a')
                        ->join('programas as p','p.codprograma','=','a.codprograma')
                        ->select('a.*','p.programa')
                        ->whereIn('a.periodo',$periodos)
                        ->whereIn('a.codprograma',$programas)
                        ->orderBy('a.created_at','desc')
                        ->get();
        return $consultaAlertas;
    }

    public function tablaAlertasFacultad(){
        $periodos = $_POST['periodos'];
        $facultades = $_POST['facultad'];
        //var_dump($facultades);die();
        $consultaAlertas = DB::table('alertas_tempranas as a')
                        ->join('programas as p','p.codprograma','=','a.codprograma')
                        ->select('a.*','p.programa')
                        ->whereIn('a.periodo',$periodos)
                        ->whereIn('p.Facultad',$facultades)
                        ->orderBy('a.created_at','desc')
                        ->get();
        return $consultaAlertas;

    }

    public function tablaAlertas(){
        $periodos = $_POST['periodos'];
        $consultaAlertas = DB::table('alertas_tempranas as a')
                        ->join('programas as p','p.codprograma','=','a.codprograma')
                        ->select('a.*','p.programa')
                        ->whereIn('a.periodo',$periodos)
                        ->orderBy('a.created_at','desc')
                        ->get();
        return $consultaAlertas;
    }

    

}
