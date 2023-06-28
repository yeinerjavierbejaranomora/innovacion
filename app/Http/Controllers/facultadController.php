<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CambioPassRequest;
use App\Http\Requests\UsuarioLoginRequest;
use App\Http\Requests\CrearFacultadRequest;
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
            ->select('programas.id', 'programas.codprograma', 'programas.programa', 'facultad.nombre')
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
        return view('vistas.admin.facultad',['id'=>$request->id]);
    }

    /** Función para mostrar los programas según el id de la facultad */
    public function mostrarfacultad($id_llegada)
    {
        dd($id_llegada);
        // Decripta el id que recibe
        $id = decrypt($id_llegada);
        // Consulta para obtener los programas según id de facultad
        $facultad = DB::table('programas')->select('id', 'codprograma', 'programa')
            ->where('id_facultad', '=', $id)->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $facultad));
    }

    public function mostrarmallacurricular($cod_llegada)
    {
        // Decripta el id que recibe
        $codigo = decrypt($id_llegada);
        // Consulta para obtener la malla curricular del programa
        $malla = DB::table('mallaCurricular')->where('codprograma', '=', $codigo)->get();
         /**mostrar los datos en formato JSON */
         header("Content-Type: application/json");
         /**Se pasa a formato JSON el arreglo de users */
         echo json_encode(array('data' => $malla));
    }

    
}
