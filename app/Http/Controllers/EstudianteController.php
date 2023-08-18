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
        var_dump($consultaEstudiante->homologante);die();
    }
}
