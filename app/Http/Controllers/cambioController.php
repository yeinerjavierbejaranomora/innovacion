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
    public function nueva($id)
    {
        $id =decrypt($id);
        return view('reestablecerpassword.nueva',['id'=>$id]);
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
        
        /* Si encuentra el usuario en la base de datos le permite acceder al formulario para 
        cambiar la contraseña */
            if ($consulta == '[]') {
                return redirect()->route('cambio.index')->with('error','Credenciales invalidos!');
            } else {
            $id= encrypt($consulta[0]->id);
            return redirect()->route('cambio.nueva',['id'=>$id]);
        }
    }

    // * Método que actualiza la contraseña del usuario

    public function actualizar(ActualizarPassRequest $request)
    {
        $cambioPass = User::where('id', '=', $request->id)->update(['password' => bcrypt($request->confirmar)]);
        if ($cambioPass) {
            return redirect()->route('login.index')->with('Sucess', 'Contraseña actualizada');
        }
        else {
            return redirect()->route('cambio.nueva')-> with('Error', 'Cambio no valido!');
        }
    }

    public function consultaCambio($idBanner){
        $idBanner = decrypt($idBanner);
        $user = User::where('id_banner',$idBanner)->first();
        if($user != []):
            return view('reestablecerpassword.cambio');
        else:
            return redirect()->route('home.index');
        endif;
    }

    public function cambioSave(CambioRequest $request){
        dd($request->all());
    }
}
