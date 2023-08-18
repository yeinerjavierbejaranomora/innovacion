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
        $mallaCurricular = DB::table('mallaCurricular')->where('codprograma','=',$consultaEstudiante->programa)->get();
        var_dump($mallaCurricular);die();
    }
}
