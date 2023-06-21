<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ActualizarPassRequest;
use App\Http\Requests\CambioPassRequest;
use Illuminate\Support\Facades\Hash;

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

    public function cambioSave(CambioPassRequest $request){
        /** verificamos la base de datos  con los datos necesarios para realizar el cambio de contraseña */
        $user = DB::table('users')->select('users.email','users.password','users.id_banner')->where('id','=',$request->id)->first();
        /** varificamos si la contraseña actual es identica a la guarda en la DB cuando se creo el usuario, se usa Hash::check para decifrar la contraseña guardada */
        if(Hash::check($request->password_actual,$user->password)):
            /** Se realiza el update de la password si el id y el documento son iguales a los datos que vienen del formulario  */
            $cambioPass = User::where('id','=',$request->id)->update(['password'=> bcrypt($request->password)]);
            /**si el update se hace correctamente se redirige al formulario de login */
            if($cambioPass):
                return redirect()->route('login.index');
            else:
                return redirect()->route('cambio.cambio',['idbanner'=>encrypt($user->id_banner)])->withErrors(['errors'=>'Error al modificar la contraseña']);
            endif;
        else:
            return redirect()->route('cambio.cambio',['idbanner'=>encrypt($user->id_banner)])->withErrors(['errors'=>'Ingrese contraseña actual']);
        endif;
    }
}
