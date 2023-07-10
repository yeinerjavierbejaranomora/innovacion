<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Util\Constantes;
use App\Http\Controllers\LogUsuariosController;

class RegistroController extends Controller
{
    //
    /** Carga la vista del formulario de registro */
    public function index() {
        return view('registro.index');
    }

    public function indexPrueba() {
        return view('registroprueba.index');
    }

    /** Traer los datos de la tabla roles */
    public function roles() {
        $roles = DB::table('roles')->get();
        return $roles;
    }

    /** Trae los datos de la tabla facultades */
    public function facultades() {
        $facultades = DB::table('facultad')->get();
        return $facultades;
    }

    /** Trae los datos dela tabla programas si el id coincide con el que se ricibe por POST desde el formulario de registro */
    public function programas() {
        $idFacultad = $_POST['idfacultad'];
        $programas = DB::select('SELECT `id`, `programa` FROM `programas` WHERE `idFacultad` = :id', ['id' => $idFacultad]);
        return $programas;
    }


    /** Recibe los datos validados del formulario de registro luego de pasar por el UsuarioRegistroRequet
     * y realiza la insercion del usuario en la tabla users
     */
    public function saveRegistro(UsuarioRegistroRequest $request){
        /** Inserta los datos validades en la tabla users usando el model Userphp */
        $usuario = User::create($request->validated());
        /** si la insercion es correcta */
        if($usuario):
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('registro.index')->with('success','Usuario creado correctamente');
        else:
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('registro.index')->withErrors(['errors' => 'Usuario no se ha podido crear']);
        endif;
    }

    public function crearUsuario(UsuarioRegistroRequest $request){
        /** Inserta los datos validades en la tabla users usando el model Userphp */
        $usuario = User::create($request->validated());
        $parametros = collect($request->all())->except(['_token'])->toArray();
        $request->replace($parametros);

        LogUsuariosController::registrarLog(Constantes::CREAR, 'Users', NULL, json_encode($request->all()));

        /** si la insercion es correcta */
        if($usuario):
            /** Redirecciona a la vista de administración de usuarios con un mensaje de exito */
            return redirect()->route('admin.users')->with('success','Usuario creado correctamente');
        else:
            /** Redirecciona a la vista de administración de usuarios con un mensaje de error */
            return redirect()->route('admin.users')->withErrors(['errors' => 'Usuario no se ha podido crear']);
        endif;
    }
}
