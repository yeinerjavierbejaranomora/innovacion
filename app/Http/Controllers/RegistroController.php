<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    //
    public function index() {
        return view('registro.index');
    }

    public function indexPrueba() {
        return view('registroprueba.index');
    }
    
    public function roles() {
        $roles = DB::table('roles')->get();
        return $roles;
    }
    public function facultades() {
        $facultades = DB::table('facultad')->get();
        return $facultades;
    }

    public function programas() {
        $idFacultad = $_POST['idfacultad'];
        $programas = DB::select('SELECT `id`, `programa` FROM `programas` WHERE `idFacultad` = :id', ['id' => $idFacultad]);
        return $programas;
    }

    public function saveRegistro(Request $request){
        return $request;
    }
}
