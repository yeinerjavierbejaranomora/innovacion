<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistorialEstudianteController extends Controller
{
    /** 
     * Función para cargar la vista del historial academico de  los estudiantes
     * @return view del historial de los estudiantes
     * */
    function index(){
              
        return view('vistas.historial.estudiantes');
    }

}
