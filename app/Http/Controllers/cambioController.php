<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ActualizarPassRequest;

class cambioController extends Controller
{
    // * Método para acceder a la vista de reestablecer contraseña *
    public function index()
    {
        return view('reestablecerpassword.index');
    }
    // * Método para acceder a la vista de cambio de contraseña *
    public function nueva()
    {
        return view('reestablecerpassword.nueva');
    }

    // * Método que consulta los datos ingresados por el usuario para verificar si existe en la base de datos
    // y así poder llevar a cabo del cambio de contraseña *

    public function consultar(Request $request)
    {
        // * Consulta MySQL *
        $consulta = DB::table('users')->where([
            ['id_banner', '=', $request->idbanner],
            ['email', '=', $request->correo],
            ['documento', '=', $request->documento]
            ])->get();

            if ($consulta == '[]') {
                $error = 'OK';
                return view('reestablecerpassword.index')->$error;
            } else {
            $id= $consulta[0]->id;
            return view('reestablecerpassword.nueva',['id'=>$id]);
        }
    }

    // * Métodod que actualiza la contraseña del usuario

    public function actualizar(ActualizarPassRequest $request)
    {
        $cambioPass = User::where('id', '=', $request->id)->update(['password' => bcrypt($request->confirmar)]);
        if ($cambioPass) {
            return redirect()->route('login.index')->with('Sucess', 'Contraseña actualizada');
        }
        else {
            return with('Fail', 'Error');
        }
    }


    public function consultaCambio($idBanner){
        $idBanner = decrypt($idBanner);
        $user = User::find($idBanner);
        return $user;
    }
}
