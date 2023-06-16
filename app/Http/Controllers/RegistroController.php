<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRegistroRequest;
use App\Models\Usuario;
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

    public function saveRegistro(UsuarioRegistroRequest $request){
        return $request;
        if (isset($request->programa)) {
            return "Existe";
        } else {
            return "No existe";
        }
        
        if($request->facultad == ''):
            return "No se puede registrar sin seleccionar una Facultad";
            /*$usuario = Usuario::create([
                'idBanner'=>$request->idbanner,
                'documentoDeIdentidad'=>$request->documento,
                'correo'=>$request->correo,
                'password'=>bcrypt($request->documento),
                'nombre'=>$request->nombre,
                'idRol'=>$request->idrol,
                'fecha' => date('Y-m-d h:i:s'),
                'ingreso_plataforma'=>0,
                'activo' => 1
            ]);*/
        else:
        endif;

        /*$usuario = Usuario::create([
            'idBanner'=>$request->idbanner,
            'documentoDeIdentidad'=>$request->documento,
            'correo'=>$request->correo,
            'password'=>bcrypt($request->documento),
            'nombre'=>$request->nombre,
            'idRol'=>$request->idrol,
            'idFacultad'=>$request->idfacultad,
            'fecha' => date('Y-m-d h:i:s'),
            'ingreso_plataforma'=>0,
            'activo' => 1
        ]);*/
    }
}
