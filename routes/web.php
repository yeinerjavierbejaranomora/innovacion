<?php

/** definimos losb controladores para que funcionen las rutas  */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\contrasenaController;
use App\Http\Controllers\cambioController;
use App\Http\Controllers\MafiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\facultadController;
use App\Http\Controllers\HistorialEstudianteController;
use App\Http\Controllers\InformeMafiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('login/index');
});

/** definimos las rutas por controlador en este caso son las del usuario logueado */
Route::controller(UserController::class)->group(function () {

    /** cuando el login es correcto y existe la sesion del usuario va a la pagina de inicio  */
    Route::get('/home', 'home')->middleware('auth')->name('home.index');

    /** Vista al pulsar el botón "Informe Mafi" */
    Route::get('/home/mafi', 'vistasMafi')->middleware('auth')->name('home.mafi');

    /** Vista al pulsar el botón "Planeación" */
    Route::get('/home/Planeacion', 'vistasPlaneacion')->middleware('auth')->name('home.planeacion');

    /** para cargar las vistas predefinidas en la facultad */
    Route::get('/home/facultad/', 'facultad')->middleware('auth')->name('facultad.index');
    /** cargamos la vista del perfil del usuario */
    Route::get('/home/perfil/{id}', 'perfil')->middleware('auth')->name('user.perfil');
    /** cargamos la vista para editar los datos del usuario */
    Route::get('/home/editar/{id}', 'editar')->middleware('auth')->name('user.editar');
    /** actualizar los datos del usuario */
    Route::post('/home/actualizar/{id}', 'actualizar')->middleware('auth')->name('user.actualizar');
    //** Ruta para inactivar usuario */
    Route::post('/home/inactivarusuario', 'inactivar_usuario')->middleware('auth')->name('user.inactivar');
    //** Ruta para activar usuario */
    Route::post('/home/activarusuario', 'activar_usuario')->middleware('auth')->name('user.activar');

    /** cargamos la vista de administracion de usuarios */
    Route::get('/home/usuarios', 'userView')->middleware('auth', 'admin')->name('admin.users');
    /** cargamos la vista para mostarar todos los usuarios */
    Route::get('/home/users', 'get_users')->middleware('auth', 'admin')->name('admin.getusers');
    /** cargamos la vista de administracion de facultades */
    Route::get('/home/amdministracionfacultades', 'facultad_view')->middleware('auth', 'admin')->name('admin.facultades');
    /** cargamos la vista para mostrar todas las facultades */
    Route::get('/home/facultades', 'get_facultades')->middleware('auth', 'admin')->name('admin.getfacultades');
    //** Ruta para cargar vista con los roles */
    Route::get('/home/roles', 'roles_view')->middleware('auth', 'admin')->name('admin.roles');
    //** Ruta para mostrar todos los roles */
    Route::get('/home/getroles', 'get_roles')->middleware('auth', 'admin')->name('admin.getroles');

    //** Ruta para inactivar Rol */
    Route::post('/home/inactivarRol', 'inactivar_rol')->middleware('auth')->name('rol.inactivar');
    //** Ruta para activar Rol */
    Route::post('/home/activarRol', 'activar_rol')->middleware('auth')->name('rol.activar');
    //* Ruta para actualizar rol */
    Route::post('/home/updateRol', 'update_rol')->middleware('auth')->name('rol.update');
    /** Ruta para crear Rol */
    Route::post('/home/crearRol', 'crear_rol')->middleware('auth')->name('rol.crear');

    /** Ruta para traer los programas */
    Route::post('/home/programas', 'traerprogramas')->name('traer.programas');
    /** Ruta para traer programas en la vista Usuarios */
    Route::post('/home/programasUsuarios', 'traerProgramasUsuarios')->name('traer.programas.usuarios');
     
});

Route::controller(InformeMafiController::class)->group(function () {
    /** Ruta para traer los periodos activos */
    Route::post('/home/periodos', 'periodosActivos')->name('periodos.activos');

    /** Ruta para cargar gráfica de estudiantes activos e inactivos */
    Route::get('/home/estudiantes', 'estudiantesActivosGeneral')->middleware('auth')->name('estudiantes.activos');
    /** Ruta para cargar gráfica de el sello financiero de los estudiantes */
    Route::get('/home/estudiantesActivos/{tabla}', 'selloEstudiantesActivos')->middleware('auth')->name('sello.activos');
    /** Ruta para cargar gráfica de estudiantes activos con retenciòn */
    Route::get('/home/retencionActivos/{tabla}', 'estudiantesRetencion')->middleware('auth')->name('retencion.activos');
    /** Ruta para cargar gráfica de estudiantes de primer ingreso */
    Route::get('/home/estudiantesPrimerIngreso/{tabla}', 'estudiantesPrimerIngreso')->middleware('auth')->name('sello.estudiantes');
    /** Ruta para cargar gráfica de estudiantes tipos de estudiantes */

    Route::get('/home/tipoEstudiantes/{tabla}', 'tiposEstudiantes')->middleware('auth')->name('tipo.estudiantes');
    /** Ruta para cargar gráfica de los operadores que mas estudiantes traen */
    Route::get('/home/operadores/{tabla}', 'operadores')->middleware('auth')->name('operadores.estudiantes');
    /** Ruta para cargar gráfica de los programas que mas estudiantes tienen inscritos */
    Route::get('/home/estudiantesProgramas/{tabla}' ,'estudiantesProgramas')->middleware('auth')->name('programas.estudiantes');

    /** Ruta para cargas gráfica de estudiantes activos e inactivos de cada facultad */
    Route::post('/home/estudiantesFacultad', 'estudiantesActivosFacultad')->middleware('auth')->name('estudiantes.activos.facultad');
    /** Ruta para cargar gráfica de el sello financiero de los estudiantes de cada facultad */
    Route::post('/home/estudiantesSelloFacultad/{tabla}', 'selloEstudiantesFacultad')->middleware('auth')->name('estudiantes.sello.facultad');
    /** Ruta para cargar gráfica de estudiantes activos con retención de cada facultad */
    Route::post('/home/estudiantesRetencionFacultad/{tabla}', 'retencionEstudiantesFacultad')->middleware('auth')->name('estudiantes.retencion.facultad');
    /** Ruta para cargar gráfica de estudiantes de primer ingreso de cada facultad*/
    Route::post('/home/estudiantesPrimerIngresoFacultad/{tabla}', 'primerIngresoEstudiantesFacultad')->middleware('auth')->name('estudiantes.primerIngreso.facultad');
    /** Ruta para cargar gráfica de estudiantes de primer ingreso de cada facultad*/
    Route::post('/home/tiposEstudiantes/{tabla}', 'tiposEstudiantesFacultad')->middleware('auth')->name('estudiantes.tipo.facultad');
     /** Ruta para cargar gráfica de los operadores que mas estudiantes traen por facultad */
    Route::post('/home/operadoresFacultad/{tabla}', 'operadoresFacultad')->middleware('auth')->name('estudiantes.operador.facultad');
    /** Ruta para cargar gráfica de los programas que mas estudiantes tienen inscritos por facultad*/
    Route::post('/home/estudiantesProgramasFacultad/{tabla}' ,'estudiantesProgramasFacultad')->middleware('auth')->name('programas.estudiantes.facultad');
    
    /** Ruta para cargas gráfica de estudiantes activos e inactivos de cada facultad */
    Route::post('/home/estudiantesPrograma', 'estudiantesActivosPrograma')->middleware('auth')->name('estudiantes.activos.programa');
    /** Ruta para cargar gráfica de el sello financiero de los estudiantes de cada programa */
    Route::post('/home/estudiantesSelloPrograma/{tabla}', 'selloEstudiantesPrograma')->middleware('auth')->name('estudiantes.sello.programa');
    /** Ruta para cargar gráfica de estudiantes activos con retención de cada programa */
    Route::post('/home/estudiantesRetencionPrograma/{tabla}', 'retencionEstudiantesPrograma')->middleware('auth')->name('estudiantes.retencion.programa');
    /** Ruta para cargar gráfica de estudiantes de primer ingreso de cada programa*/
    Route::post('/home/estudiantesPrimerIngresoPrograma/{tabla}', 'primerIngresoEstudiantesPrograma')->middleware('auth')->name('estudiantes.primerIngreso.programa');
    /** Ruta para cargar gráfica de estudiantes de primer ingreso de cada facultad*/
    Route::post('/home/tiposPrograma/{tabla}', 'tiposEstudiantesPrograma')->middleware('auth')->name('estudiantes.tipo.programa');
    /** Ruta para cargar gráfica de los operadores que mas estudiantes traen por programa */
    Route::post('/home/operadoresPrograma/{tabla}', 'operadoresPrograma')->middleware('auth')->name('estudiantes.operador.programa');

    /** Ruta para cargar gráfica de los operadores ordenados de forma descendente por Facultad*/
    Route::post('/home/operadoresFacultadTotal', 'operadoresFacultadTotal')->middleware('auth')->name('operadores.facultad.estudiantes');
    /** Ruta para cargar gráfica de los operadores ordenados de forma descendente */
    Route::post('/home/operadoresTotal', 'operadoresTotal')->middleware('auth')->name('operadoresTotal.estudiantes');
    /** Ruta para cargar gráfica de los operadores ordenados de forma descendente por Programa*/
    Route::post('/home/operadoresProgramaTotal', 'operadoresProgramaTotal')->middleware('auth')->name('operadores.programa.estudiantes');

    /** Ruta para cargar gráfica de los programas y la cantidad de estudiantes inscritos*/
    Route::post('/home/estudiantesProgramasTotal' ,'estudiantesProgramasTotal')->middleware('auth')->name('programasTotal.estudiantes');
    /** Ruta para cargar gráfica de los programas y la cantidad de estudiantes inscritos de cada facultad */
    Route::post('/home/estudiantesFacultadTotal' ,'estudiantesFacultadTotal')->middleware('auth')->name('FacultadTotal.estudiantes');

    /** Ruta para cargar gráfica de los operadores ordenados de forma descendente por Facultad*/
    Route::post('/home/tiposEstudiantesFacultadTotal', 'tiposEstudiantesFacultadTotal')->middleware('auth')->name('tiposEstudiantes.facultad.estudiantes');
    /** Ruta para cargar gráfica de los operadores ordenados de forma descendente */
    Route::post('/home/tiposEsudiantesTotal', 'tiposEstudiantesTotal')->middleware('auth')->name('tiposEstudiantes.total.estudiantes');
    /** Ruta para cargar gráfica de los operadores ordenados de forma descendente por Programa*/
    Route::post('/home/tiposEsudiantesProgramaTotal', 'tiposEstudiantesProgramaTotal')->middleware('auth')->name('tiposEstudiantes.programa.estudiantes'); 
});

Route::controller(MafiController::class)->group(function () {
    //carga de mafis
    Route::get('/home/admin/mafi', 'inicioMafi')->middleware('auth', 'admin')->name('admin.mafi');
    Route::get('/home/admin/datamafi', 'getDataMafi')->middleware('auth', 'admin')->name('admin.getdatamafi');
    Route::get('/home/admin/datamafireplica', 'getDataMafiReplica')->middleware('auth', 'admin')->name('admin.getdatamafireplica');
    Route::get('/home/admin/periodo', 'periodo')->middleware('auth', 'admin')->name('admin.periodo');
    Route::get('/home/admin/Generar_faltantes', 'materiasPorVer')->middleware('auth', 'admin')->name('admin.Generar_faltantes');
    Route::get('/home/admin/probarfunciones', 'probarfunciones')->middleware('auth', 'admin')->name('admin.probarfunciones');
});

/** definimos las rutas para el registro de usuarios */
Route::controller(RegistroController::class)->group(function () {
    /** esta primera es la encargada de llevarme al formulario de registro de usuarios para el aplicativo */
    Route::get('/registro', 'index')->name('registro.index');
    /** esta es para realizar el registro de  mas roles  */
    Route::get('/registro/roles', 'roles')->name('registro.roles');
    /** esta es para registrar nuevas facultades  */
    Route::post('/registro/facultades', 'facultades')->name('registro.facultades');
    /** para registrar nuevos programas */
    Route::post('/registro/programas', 'programas')->name('registro.programas');
    /** para salvar todos los registros */
    Route::post('/registro/save', 'saveRegistro')->name('registro.saveregistro');
    /** crear usuario */
    Route::post('/home/crearusuario', 'crearUsuario')->middleware('auth')->name('user.crear');
});


/*** definimos las rutas para el login */
Route::controller(LoginController::class)->group(function () {
    /** cargamosn el inicio de la app el login */
    Route::get('/login', 'index')->name('login.index');
    /** para cargar y llamar las funciones del login */
    Route::post('login/login', 'login')->name('login.login');
    /** si los datos son correctos  enviamos al home */
    Route::get('/login/home/', 'home')->middleware('auth')->name('login.home');
    /** para los cambios de contraseña */
    Route::get('/login/cambio/', 'cambio')->name('login.cambio');
    /** cargamos el formulario de cambio */
    Route::post('/login/cambiopass', 'cambioPass')->name('login.cambiopass');
    /** ruta para cerar sesion */
    Route::get('/logout', 'logout')->name('logout');
    /// para cambiar el password interno
    Route::post('/login/admin', 'cambio_Pass')->name('login_interno.cambiopass');
});

Route::controller(contrasenaController::class)->group(function () {
    Route::get('/contrasena', 'index')->name('contrasena.index');
});

Route::controller(cambioController::class)->group(function () {
    Route::get('/cambio', 'index')->name('cambio.index');
    Route::get('/nueva/{id}', 'nueva')->name('cambio.nueva');
    Route::post('/confirmar', 'consultar')->name('cambio.consultar');
    Route::post('/confirmar/nueva', 'actualizar')->name('cambio.actualizar');
    Route::get('/home/cambiopassword/{idbanner}', 'consultaCambio')->middleware('auth')->name('cambio.cambio');
    Route::post('/home/cambiopassword/', 'cambioSave')->middleware('auth')->name('cambio.cambiosave');
});

/** Controlador para el menú desplegable de facultades */
Route::controller(facultadController::class)->group(function () {
    /** Ruta para cargar la vista de programas*/
    Route::get('/home/programas', 'view_programas')->middleware('auth', 'admin')->name('facultad.programas');
    /** Ruta para cargar la vista de especializaciones*/
    Route::get('/home/especializacion', 'view_especializacion')->middleware('auth', 'admin')->name('facultad.especializacion');
    /** Ruta para cargar la vista de maestrias*/
    Route::get('/home/maestria', 'view_maestria')->middleware('auth', 'admin')->name('facultad.maestria');
    /** Ruta para cargar la vista de educacion continua*/
    Route::get('/home/educacioncontinua', 'view_continua')->middleware('auth', 'admin')->name('facultad.continua');
    /** Ruta cargar la vista de los periodos */
    Route::get('/home/periodos', 'view_periodos')->middleware('auth', 'admin')->name('facultad.periodos');
    /** Ruta para visualizar todas las reglas de negocio */
    Route::get('/home/reglasdenegocio', 'view_reglas')->middleware('auth', 'admin')->name('facultad.reglas');
    /** Ruta para obtener todos los programas (pregrados) */
    Route::get('/home/getprogramas', 'get_programas')->middleware('auth', 'admin')->name('facultad.getprogramas');
    /** Ruta para obtener todos las especializaciones*/
    Route::get('/home/getespecializacion', 'get_especializacion')->middleware('auth', 'admin')->name('facultad.getespecializacion');
    /** Ruta para obtener todos las especializaciones maestrias */
    Route::get('/home/getmaestria', 'get_maestria')->middleware('auth', 'admin')->name('facultad.getmaestria');
    /** Ruta para obtener todos los programas de educación continua */
    Route::get('/home/getcontinua', 'get_continua')->middleware('auth', 'admin')->name('facultad.getcontinua');
    /** Ruta para obtener todos los periodos */
    Route::get('/home/getperiodos', 'get_periodos')->middleware('auth', 'admin')->name('facultad.getperiodos');
    /** Ruta para obtener todas las reglas de negocio */
    Route::get('/home/getreglas', 'get_reglas')->middleware('auth', 'admin')->name('facultad.getreglas');

    /** Ruta para ver los programas por facultad */
    Route::get('/home/facultad/{id}', 'facultad')->middleware('auth')->name('facultad.facultad');
    /** Ruta para traer los programas por facultad */
    Route::get('/home/programas/{id}', 'mostrarfacultad')->middleware('auth')->name('facultad.mostrarprogramas');

    /** Ruta para visualizar la malla curricular */
    Route::get('/home/malla/{codigo}', 'malla')->middleware('auth')->name('facultad.malla');
    /** Ruta para visualizar la malla curricular */
    Route::get('/home/getmalla/{id}', 'mostrarmallacurricular')->middleware('auth')->name('facultad.getmalla');

    //** Ruta para inactivar programa */
    Route::post('/home/inactivarprograma', 'inactivar_programa')->middleware('auth')->name('programa.inactivar');
    //** Ruta para activar programa */
    Route::post('/home/activarprograma', 'activar_programa')->middleware('auth')->name('programa.activar');
    /** Ruta para crear programa */
    Route::post('/home/crearprograma', 'crear_programa')->middleware('auth')->name('programa.crear');
    /** Ruta para actualizar programa */
    Route::post('/home/updateprograma', 'update_programa')->middleware('auth')->name('programa.update');
    /** Ruta para nombres de facultades */
    Route::get('/home/nombresfacultades', 'nombresFacultades')->middleware('auth')->name('programa.nombresfac');

    /** Ruta para visualizar los programas de la facultad del usuario */
    Route::get('/home/facultades/{nombre}', 'programasUsuario')->middleware('auth')->name('programa.usuario');
    /**Ruta para visaulizar los estudiantes de cada programa */
    Route::get('/home/facultades/estudiantes/{id}', 'estudiantesFacultad')->middleware('auth')->name('programa.estudiantes');

    /** para salvar las facultades */
    Route::post('/home/savefacultades', 'savefacultad')->middleware('auth', 'admin')->name('admin.guardarfacultad');
    /** para actualizar las facultades */
    Route::post('/home/updatefacultades', 'updatefacultad')->middleware('auth', 'admin')->name('admin.updatefacultad');
    //** Ruta para inactivar facultad*/
    Route::post('/home/inactivarfacultad', 'inactivar_facultad')->middleware('auth')->name('facultad.inactivar');
    //** Ruta para activar facultad */
    Route::post('/home/activarfacultad', 'activar_facultad')->middleware('auth')->name('facultad.activar');

    /** Ruta para crear especializacion */
    Route::post('/home/crearespecializacion', 'crear_esp')->middleware('auth')->name('especializacion.crear');
    /** Ruta para crear maestría */
    Route::post('/home/crearmaestria', 'crear_maestria')->middleware('auth')->name('maestria.crear');
    /** Ruta para crear programa de educacion continua*/
    Route::post('/home/crearcontinua', 'crear_edudacioncont')->middleware('auth')->name('continua.crear');

    /** Ruta para crear periodos */
    Route::post('/home/createperiodo', 'crear_periodo')->middleware('auth')->name('periodo.crear');
    /** Ruta para editar periodos */
    Route::post('/home/updateperiodo', 'updateperiodo')->middleware('auth')->name('periodo.update');
    //** Ruta para inactivar periodo */
    Route::post('/home/inactivarperiodo', 'inactivar_periodo')->middleware('auth')->name('periodo.inactivar');
    //** Ruta para activar periodo */
    Route::post('/home/activarperiodo', 'activar_periodo')->middleware('auth')->name('periodo.activar');

    /** Ruta para crear regla */
    Route::post('/home/createregla', 'crear_regla')->middleware('auth')->name('regla.crear');
    /** Ruta para actualizar regla */
    Route::post('/home/updateregla', 'updateregla')->middleware('auth')->name('regla.update');
    /** Ruta para inactivar regla */
    Route::post('/home/inactivarregla', 'inactivarregla')->middleware('auth')->name('regla.inactivar');
    /** Ruta para activar regla */
    Route::post('/home/activarregla', 'activarregla')->middleware('auth')->name('regla.activar');

    /** Ruta para cargar la vista de planeación*/
    Route::get('/home/planeacion', 'view_planeacion')->middleware('auth', 'admin')->name('planeacion.view');
    /** Ruta para visualizar la planeación de todos los programas */
    Route::get('/home/getplaneacion', 'get_planeacion')->middleware('auth')->name('programas.planeacion');
    /** Ruta para visualizar la planeación de cada programa */
    Route::get('/home/facultades/planeacion/{id}', 'planeacionPrograma')->middleware('auth')->name('planeacion.programa');
    
});

/** Controlador para el menú desplegable de facultades */
Route::controller(HistorialEstudianteController::class)->group(function () {

    /** Ruta para cargar informacion de los estudiantes */
    Route::get('/historial', [HistorialEstudianteController::class, 'historial']);

    
});


