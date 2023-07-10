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
    public function __construct()
    {
        $this->middleware('auth',['only'=>['consultaCambio','cambioSave']]);
    }
    
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

    /** Funcicon para mostrar el formulario para cambiar la contraseña
     * recibe como parametro el idBanner cifrado
      */
    public function consultaCambio($idBanner){

        /** Se decifra el idBanner */
        $idBanner = decrypt($idBanner);

        $user = auth()->user();

        /// traemos los roles de la base de datos para poder cargar la vista
        $rol_db = DB::table('roles')->where([['id', '=', $user->id_rol]])->get();

        /*traempos el nombre del rol para cargar la vista*/
        $nombre_rol = $rol_db[0]->nombreRol;
        auth()->user()->nombre_rol = $nombre_rol;
        $facultad = DB::table('facultad')->where([['id', '=', $user->id_facultad]])->get();

        $datos = array(
            'rol' => $nombre_rol,
            'facultad' => $facultad
        );
        dd($datos);
        /**Se realiza la consulta para comprobrar que exista el usuario */
        $user = User::where('id_banner',$idBanner)->first();
        /** Si es diferente al vacio lleva a la vista  */
        if($user != []):
            return view('reestablecerpassword.cambio');
        /** En caso contrario redirige al inicio */
        else:
            return redirect()->route('home.index')->with('datos', $datos);
        endif;
    }

    /** Funcion para realizar el update de la contraseña
     * recibiendo los datos del formulario por medio del CambioPassRequest
     * validando que se traigan datos y que las contraseñas nuevas coincidan
     */
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
            /**si el update falla redirige nuevamente al formulario de cambio de contraseña */
                return redirect()->route('cambio.cambio',['idbanner'=>encrypt($user->id_banner)])->withErrors(['errors'=>'Error al modificar la contraseña.']);
            endif;
        else:
            /** si la contraseña actual no corresponde a la registrada en la DB, redirige al formulario de cambio de contraseña */
            return redirect()->route('cambio.cambio',['idbanner'=>encrypt($user->id_banner)])->withErrors(['errors'=>'Ingrese contraseña actual.']);
        endif;
    }
}
