<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    //
    public function index() {
        /*$roles = DB::table('roles')->get();
        var_dump($roles);*/
        return view('registro.index');
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
        $idFacultad = $_POST['idFacultad'];
        var_dump($_POST);die();
        $programas = DB::select('SELECT `id`, `programa` FROM `programas` WHERE `idFacultad` = :id', ['id' => $idFacultad]);
        var_dump($programas);die();
    }
}
