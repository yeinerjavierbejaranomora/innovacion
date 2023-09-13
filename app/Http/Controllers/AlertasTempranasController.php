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

    public function graficaAlertas(){

        $consulta = DB::table('alertas_tempranas')
        ->select(DB::raw('COUNT(idbanner) as TOTAL'), 'codprograma')
        ->groupBy('codprograma')
        ->orderByDesc('TOTAL')
        ->limit(10)
        ->get();
        return $consulta;
    }

    public function graficaAlertasFacultad(){

        $periodos = $_POST['periodos'];
        $facultades = $_POST['facultad'];

        $consulta = DB::table('alertas_tempranas as a')
        ->join('programas as p','p.codprograma','=','a.codprograma')
        ->whereIn('a.periodo',$periodos)
        ->whereIn('p.Facultad',$facultades)
        ->select(DB::raw('COUNT(a.idbanner) as TOTAL'), 'a.codprograma')
        ->groupBy('a.codprograma')
        ->orderByDesc('TOTAL')
        ->limit(10)
        ->get();

        return $consulta;
    }

    public function graficaAlertasProgramas(){
        $periodos = $_POST['periodos'];
        $programas = $_POST['programas'];

        $consulta = DB::table('alertas_tempranas as a')
        ->join('programas as p','p.codprograma','=','a.codprograma')
        ->whereIn('a.periodo',$periodos)
        ->whereIn('a.codprograma',$programas)
        ->select(DB::raw('COUNT(a.idbanner) as TOTAL'), 'a.codprograma')
        ->groupBy('a.codprograma')
        ->orderByDesc('TOTAL')
        ->limit(10)
        ->get();

        return $consulta;
    }

    public function numeroAlertas(){
        $numeroAlertas = DB::table('alertas_tempranas')->select(DB::raw('count(id) as total_alertas'))->where('activo',1)->get();
        //var_dump($numeroAlertas[0]->total_alertas);die();
        return $numeroAlertas[0]->total_alertas;
    }

    public function numeroAlertasFacultad(){
        $idFacultad = $_GET['id_facultad'];
        $idFacultad = trim($idFacultad,';');
        $idFacultades = explode(';',$idFacultad);
        $consultaFacultades = DB::table('facultad')->select('nombre')->wherein('id',$idFacultades)->get();
        $facultades = array();
        foreach($consultaFacultades as $facultad):
            array_push($facultades,$facultad->nombre);
        endforeach;
        $consultaProgramas = DB::table('programas')->select('codprograma')->whereIn('Facultad',$facultades)->get();
        //$programas = '';
        $programas = array();
        foreach($consultaProgramas as $programa):
            //$programas = $programas.','.$programa->codprograma;
            array_push($programas,$programa->codprograma);
        endforeach;
        //var_dump($programas);die();
        $numeroAlertas = DB::table('alertas_tempranas')->select(DB::raw('count(id) as total_alertas'))->where('activo',1)->whereIn('codprograma',$programas)->get();
        //var_dump($numeroAlertas[0]->total_alertas);die();
        return $numeroAlertas[0]->total_alertas;
    }

    public function numeroAlertasPrograma(){
        $idPrograma = $_GET['id_programa'];
        $idPrograma = trim($idPrograma,';');
        $idProgramas = explode(';',$idPrograma);
        var_dump($idProgramas);die();
        $programas = array();
        foreach($idProgramas as $programa):
            //$programas = $programas.','.$programa->codprograma;
            array_push($programas,$programa[0]);
        endforeach;
        var_dump($programas);die();
        $numeroAlertas = DB::table('alertas_tempranas')->select(DB::raw('count(id) as total_alertas'))->where('activo',1)->whereIn('codprograma',$idProgramas)->get();
        var_dump($numeroAlertas);die();
    }
}
