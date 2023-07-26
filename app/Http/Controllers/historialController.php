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
use App\Http\Util\Constantes;
use App\Http\Controllers\LogUsuariosController;

/**
 * Controlador de facultades
 */
class historialController extends Controller
{
    /** 
     * Función para cargar la vista del historial academico de los estudiantes
     * @return view el historial academico de los estudiantes
     * */
    public function view_programas()
    {
        return view('vistas.estudiantes.index');
    }


}
