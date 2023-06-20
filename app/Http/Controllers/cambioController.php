<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ActualizarPassRequest;

class cambioController extends Controller
{
    public function index()
    {
        return view('reestablecerpassword.index');
    }

    public function nueva()
    {
        return view('reestablecerpassword.nueva');
    }

    // * Método que consulta los datos ingresados por el usuario para verificar si existe en la base de datos
    // y así poder llevar a cabo del cambio de contraseña *

    public function consultar(Request $request)
    {
        $consulta = DB::table('users')->where([
            ['id_banner', '=', $request->idbanner],
            ['email', '=', $request->correo],
            ['documento', '=', $request->documento]
            ])->get();
            $id= $consulta[0]->id;    

        if ($consulta == '[]') {
            return redirect()->route('reesablecerpassword.index')->with('consultaFallida', 'OK');
        } else {
            return view('reestablecerpassword.nueva',['id'=>$id]);
        }
    }

    public function actualizar(ActualizarPassRequest $request)
    {
        return $request;
        $cambioPass = User::where('id', '=', $request->id)->update(['password' => bcrypt($request->confirmar)]);
        if ($cambioPass) :
            return redirect()->route('login.index');
        endif;
    }
}
