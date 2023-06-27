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
        /**Se retorna la vista del listado usuarios */
        return view('vistas.admin.programas');
    }

    /** Función para traer todos los programas */
    public function get_programas()
    {
        /**Realiza la consulta anidada para onbtener el programa con su facultad */
        $programas = DB::table('programas')->join('facultad', 'facultad.id', '=', 'programas.idFacultad')
            ->select('programas.codprograma', 'programas.programa', 'facultad.nombre')
            ->where('programas.tabla','=','pregrado')->get();
        /**mostrar los datos en formato JSON */
        header("Content-Type: application/json");
        /**Se pasa a formato JSON el arreglo de users */
        echo json_encode(array('data' => $programas));
    }

}