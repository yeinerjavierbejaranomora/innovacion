<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    //

    public function inicio(){
        return view('estudiante.index');
    }

    public function consultaEstudiante(){
        var_dump($_POST);die();
    }
}
