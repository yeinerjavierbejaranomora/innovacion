<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    //

    public function inicio(){
        return view('estudiante.index');
    }

    public function consultaEstudiante(){
        $estudiante = $_POST['codBanner'];
        $consultaEstudiante = DB::table('estudiantes')->where('homologante','=',$estudiante)->first();
        return $consultaEstudiante;
    }

    public function consultaMalla(){
        $programa = $_POST['programa'];
        $mallaCurricular = DB::table('mallaCurricular')->where('codprograma','=',$programa)->get()->toArray();
        return $mallaCurricular;
    }

    public function consultaHistorial(){
        $estudiante = $_POST['codBanner'];
        $url="https://services.ibero.edu.co/utilitary/v1/MoodleAulaVirtual/GetPersonByIdBannerQuery/".$estudiante;
        $historialAcademico = json_decode(file_get_contents($url),true);
        return $historialAcademico;
    }
    public function consultaProgramacion(){
        $estudiante = $_POST['codBanner'];
        $programacion = DB::table('programacion')->where('codBanner','=',$estudiante)->get();
        return $programacion;
    }
}
