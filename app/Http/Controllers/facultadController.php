<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CambioPassRequest;
use App\Http\Requests\UsuarioLoginRequest;
use App\Http\Requests\CrearFacultadRequest;
use App\Http\Requests\ProgramasRequest;
use App\Models\Facultad;
use App\Models\Roles;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Yajra\DataTables\DataTables;

class facultadController extends Controller
{
    /** Función para cargar la vista de los programas */
    public function view_programas()
    {
        /**Se retorna la vista de los programas de pregado */
        return view('vistas.admin.programas');
    }

    /** Función para cargar la vista de las especializaciones */
    public function view_especializacion()
    {
        /**Se retorna la vista de la especialización */
        return view('vistas.admin.especializacion');
    }

    /** Función para cargar la vista de las maestrías */
    public function view_maestria()
    {
        /**Se retorna la vista de la maestría */
        return view('vistas.admin.maestria');
    }

    /** Función para cargar la vista de educación continua */
    public function view_continua()
    {
        /**Se retorna la vista de educación continua */
        return view('vistas.admin.educacioncontinua');
    }

    /** Función para cargar la vista de periodos */
    public function view_periodos()
    {
        /**Se retorna la vista de los periodos */
        return view('vistas.admin.periodos');
    }

    /** Función para cargar la vista de las reglas de negocio */
    public function view_reglas()
    {
        /**Se retorna la vista de las reglas de negocio */
        return view('vistas.admin.reglasnegocio');
    }


    /** Función para traer todos los programas */
    public function get_programas()
    {
        /**Realiza la consulta anidada para onbtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'programas.activo','programas.idFacultad', 'facultad.nombre')
            ->where('programas.tabla', '=', 'pregrado')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $programas));
    }

    /** Función para traer todas las especializaciones */

    public function get_especializacion()
    {
        /**Realiza la consulta anidada para onbtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'facultad.nombre')
            ->where('programas.tabla', '=', 'especializacion')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $programas));
    }

    /** Función para traer todas las maestrías */

    public function get_maestria()
    {
        /**Realiza la consulta anidada para onbtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'facultad.nombre')
            ->where('programas.tabla', '=', 'MAESTRIA')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $programas));
    }

    public function get_continua()
    {
        /**Realiza la consulta anidada para onbtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'facultad.nombre')
            ->where('programas.tabla', '=', 'EDUCACION CONTINUA')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $programas));
    }

    public function get_periodos()
    {
        /** Se obtiene toda la tabla de periodo*/
        $periodos = DB::table('periodo')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $periodos));
    }

    public function get_reglas()
    {
        /** Se obtiene toda la tabla de reglas de negocio */
        $reglas = DB::table('reglasNegocio')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $reglas));
    }

    public function facultad(Request $request)
    {
        $nombre = DB::table('facultad')->select('nombre')->where('id', '=', decrypt($request->id))->get();
        return view('vistas.admin.facultad', ['id' => $request->id], ['nombre' => $nombre[0]->nombre]);
    }

    /** Función para mostrar los programas según el id de la facultad */
    public function mostrarfacultad($id_llegada)
    {
        // Decripta el id que recibe
        $id = decrypt($id_llegada);
        // Consulta para obtener los programas según id de facultad
        $facultad = DB::table('programas')->select('id', 'codprograma', 'programa', 'tabla')
            ->where('idFacultad', '=', $id)
            ->where('activo', '=', 1)->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $facultad));
    }

    public function malla($codigo)
    {
        $nombre = DB::table('programas')->select('programa')->where('codprograma', '=', $codigo)->get();

        return view('vistas.admin.malla', ['codigo' => $codigo], ['nombre' => $nombre[0]->programa]);
    }

    public function mostrarmallacurricular($codigo)
    {
        // Consulta para obtener la malla curricular del programa
        $malla = DB::table('mallaCurricular')->where('codprograma', '=', $codigo)->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $malla));
    }


    /* Método para inactivar programa */

    public function inactivar_programa()
    {
        $cod_llegada = $_POST['codigo'];
        $inactivarPrograma = DB::table('programas')->where('codprograma', '=', $cod_llegada)->update(['activo' => 0]);
        if ($inactivarPrograma) :
            return  "deshabilitado";
        else :
            return "false";
        endif;
    }

    public function activar_programa()
    {
        $cod_llegada = $_POST['codigo'];
        $inactivarPrograma = DB::table('programas')->where('codprograma', '=', $cod_llegada)->update(['activo' => 1]);
        if ($inactivarPrograma) :
            return  "habilitado";
        else :
            return "false";
        endif;
    }

    public function crear_programa()
    {
        $codigo = $_POST['codPrograma'];
        $nombre = $_POST['nombre'];
        $codFacultad = $_POST['codFacultad'];
        $tabla = $_POST['tabla'];

        $crear = DB::table('programas')->insert([
            'codprograma' => $codigo,
            'programa' => $nombre,
            'idFacultad' => $codFacultad,
            'tabla' =>$tabla,
        ]);

        if ($crear) :
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return redirect()->route('facultad.programas')->with('message','Programa creado correctamente');
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return redirect()->route('facultad.programas')->with(['errors' => 'El programa no ha podido ser creado']);
        endif;
    }

    /** Función que actualiza los datos de programa */
    public function update_programa()
    {
        $id_llegada = $_POST['id'];
        $codigo = $_POST['codigo'];
        $nombre = $_POST['programa'];
        $idfacultad = $_POST['idfacultad'];

        $id = base64_decode(urldecode($id_llegada));
        if (!is_numeric($id)) {
            $id = decrypt($id_llegada);
        }

        $update = DB::table('programas')->where('id', '=', $id)->update(['codprograma' => $codigo, 'programa' => $nombre , 'idFacultad' =>$idfacultad]);

        if ($update) :
            /** Redirecciona al formulario registro mostrando un mensaje de exito */
            return "actualizado";
        else :
            /** Redirecciona al formulario registro mostrando un mensaje de error */
            return "false";
        endif;
    }

    /** Función para visualizar la vista de los programas del usuario */

    public function programasUsuario($nombre)
    {     

        $consulta = DB::table('facultad')->where('nombre','=',$nombre)->get();
        $idFacultad=$consulta[0]->id;
        
        $programas = DB::table('programas')->where('idFacultad','=',$idFacultad)->where('activo','=',1)->select('programa','id')->get();
        
        foreach ($programas as $key => $value)
        {
            $cantidad = DB::table('datosMafiReplica')->where('codprograma','=',$value)->count();

        }
        dd($cantidad);

        $datos= array(
            'facultad' => $nombre,
            'programas' => $programas,
        );
        
        return view('vistas.admin.facultades')->with('datos', $datos);
    }


    /**Función para visualizar los estudiantes de cada facultad */
    public function estudiantesFacultad($id)
    {
        $consulta = DB::table('programas')->where('id','=',$id)->get();
        $codigo=$consulta[0]->codprograma;
        $estudiantes = DB::table('datosMafiReplica')->where('programa', '=', $codigo)->get();
        

        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $estudiantes));

    }
}
