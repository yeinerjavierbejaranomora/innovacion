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
Route::controller(UserController::class)->group(function(){

    /** cuando el login es correcto y existe la sesion del usuario va a la pagina de inicio  */
    Route::get('/home','home')->middleware('auth')->name('home.index');
    /** para cargar las vistas predefinidas en la facultad */
    Route::get('/home/facultad/','facultad')->middleware('auth')->name('facultad.index');
    /** cargamos la vista del perfil del usuario */
    Route::get('/home/perfil/{id}', 'perfil')->middleware('auth')->name('user.perfil');
    /** cargamos la vista para editar los datos del usuario */
    Route::get('/home/editar/{id}', 'editar')->middleware('auth')->name('user.editar');
    /** actualizar los datos del usuario */
    Route::post('/home/actualizar/{id}', 'actualizar')->middleware('auth')->name('user.actualizar');
    Route::post('home/inactivar','inactivarUser')->middleware('auth')->name('user.inactivar');
    Route::post('home/deshacerinactivar','deshacerInactivarUser')->middleware('auth')->name('user.deshacerinactivar');
    /** cargamos la vista de administracion de usuarios */
    Route::get('/home/usuarios','userView')->middleware('auth','admin')->name('admin.users');
    /** cargamos ña vista para mostarar todos los usuarios */
    Route::get('/home/users','get_users')->middleware('auth','admin')->name('admin.getusers');
    /** cargamos la vista de administracion de facultades */
    Route::get('/home/amdministracionfacultades','facultad_view')->middleware('auth','admin')->name('admin.facultades');
    /** cargamos la vista para mostrar todas las facultades */
    Route::get('/home/facultades','get_facultades')->middleware('auth','admin')->name('admin.getfacultades');
    /** para salvar las facultades */
    Route::post('/home/savefacultades','savefacultad')->middleware('auth','admin')->name('admin.guardarfacultad');
    /** para actualizar las facultades */
    Route::post('/home/updatefacultades','updatefacultad')->middleware('auth','admin')->name('admin.updatefacultad');
    //** Ruta para cargar vista con los roles */
    Route::get('/roles','roles_view')->middleware('auth','admin')->name('admin.roles');
    //** Ruta para mostrar todos los roles */
    Route::get('/getroles','get_roles')->middleware('auth','admin')->name('admin.getroles');
   
});

Route::controller(MafiController::class)->group(function(){
    //carga de mafis
    Route::get('/home/admin/mafi','inicioMafi')->middleware('auth','admin')->name('admin.mafi');
    Route::get('/home/admin/datamafi', 'getDataMafi')->middleware('auth','admin')->name('admin.getdatamafi');
    Route::get('/home/admin/datamafireplica', 'getDataMafiReplica')->middleware('auth','admin')->name('admin.getdatamafireplica');
    Route::get('/home/admin/periodo', 'periodo')->middleware('auth','admin')->name('admin.periodo');
    Route::get('/home/admin/Generar_faltantes', 'Generar_faltantes')->middleware('auth','admin')->name('admin.Generar_faltantes');

});

/** definimos las rutas para el registro de usuarios */
Route::controller(RegistroController::class)->group(function(){
    /** esta primera es la encargada de llevarme al formulario de registro de usuarios para el aplicativo */
    Route::get('/registro','index')->name('registro.index');
    /** esta es para realizar el registro de  mas roles  */
    Route::get('/registro/roles','roles')->name('registro.roles');
    /** esta es para registrar nuevas facultades  */
    Route::post('/registro/facultades','facultades')->name('registro.facultades');
    /** para registrar nuevos programas */
    Route::post('/registro/programas','programas')->name('registro.programas');
    /** para salvar todos los registros */
    Route::post('/registro/save','saveRegistro')->name('registro.saveregistro');
});


/*** definimos las rutas para el login */
Route::controller(LoginController::class)->group(function(){
    /** cargamosn el inicio de la app el login */
    Route::get('/login','index')->name('login.index');
    /** para cargar y llamar las funciones del login */
    Route::post('login/login','login')->name('login.login');
    /** si los datos son correctos  enviamos al home */
    Route::get('/login/home/','home')->middleware('auth')->name('login.home');
    /** para los cambios de contraseña */
    Route::get('/login/cambio/','cambio')->name('login.cambio');
    /** cargamos el formulario de cambio */
    Route::post('/login/cambiopass','cambioPass')->name('login.cambiopass');
    /** ruta para cerar sesion */
    Route::get('/logout','logout')->name('logout');
    /// para cambiar el password interno
    Route::post('/login/admin','cambio_Pass')->name('login_interno.cambiopass');
});

Route::controller(contrasenaController::class)->group(function(){
    Route::get('/contrasena','index')->name('contrasena.index');
});

Route::controller(cambioController::class)->group(function(){
    Route::get('/cambio','index')->name('cambio.index');
    Route::get('/nueva/{id}','nueva')->name('cambio.nueva');
    Route::post('/confirmar','consultar')->name('cambio.consultar');
    Route::post('/confirmar/nueva','actualizar')->name('cambio.actualizar');
    Route::get('/home/cambiopassword/{idbanner}','consultaCambio')->middleware('auth')->name('cambio.cambio');
    Route::post('/home/cambiopassword/','cambioSave')->middleware('auth')->name('cambio.cambiosave');
});

/** Controlador para el menú desplegable de facultades */
Route::controller(facultadController::class)->group(function(){
    /** Ruta para cargar la vista de programas*/
    Route::get('/home/programas','view_programas')->middleware('auth','admin')->name('facultad.programas');
    /** Ruta para cargar la vista de especializaciones*/
    Route::get('/home/especializacion','view_especializacion')->middleware('auth','admin')->name('facultad.especializacion');
    /** Ruta para cargar la vista de maestrias*/
    Route::get('/home/maestria','view_maestria')->middleware('auth','admin')->name('facultad.maestria');
    /** Ruta para cargar la vista de educacion continua*/
    Route::get('/home/educacioncontinua','view_continua')->middleware('auth','admin')->name('facultad.continua');
    /** Ruta cargar la vista de los periodos */
    Route::get('/home/periodos','view_periodos')->middleware('auth','admin')->name('facultad.periodos');
    /** Ruta para obtener todas las reglas de negocio */
    Route::get('/home/reglasdenegocio','view_reglas')->middleware('auth','admin')->name('facultad.reglas');
    /** Ruta para obtener todos los programas (pregrados) */
    Route::get('/home/getprogramas','get_programas')->middleware('auth','admin')->name('facultad.getprogramas');
    /** Ruta para obtener todos las especializaciones*/
    Route::get('/home/getespecializacion','get_especializacion')->middleware('auth','admin')->name('facultad.getespecializacion');
    /** Ruta para obtener todos las especializaciones maestrias */
    Route::get('/home/getmaestria','get_maestria')->middleware('auth','admin')->name('facultad.getmaestria');
    /** Ruta para obtener todos los programas de educación continua */
    Route::get('/home/getcontinua','get_continua')->middleware('auth','admin')->name('facultad.getcontinua');
    /** Ruta para obtener todos los periodos */
    Route::get('/home/getperiodos','get_periodos')->middleware('auth','admin')->name('facultad.getperiodos');
    /** Ruta para obtener todas las reglas de negocio */
    Route::get('/home/getreglas','get_reglas')->middleware('auth','admin')->name('facultad.getreglas');

    /** Ruta para ver los programas por facultad */
    Route::get('/home/facultad/{id}', 'facultad')->middleware('auth')->name('facultad.facultad');
    /** Ruta para traer los programas por facultad */
    Route::get('/home/programas/{id}', 'mostrarfacultad')->middleware('auth')->name('facultad.mostrarprogramas');

    /** Ruta para visualizar la malla curricular */
    Route::get('/home/malla/{codigo}', 'malla')->middleware('auth')->name('facultad.malla');
    /** Ruta para visualizar la malla curricular */
    Route::get('/home/getmalla/{codigo}', 'mostrarmallacurricular')->middleware('auth')->name('facultad.getmalla');

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
    Route::get('/home/facultades/{id}', 'estudiantesFacultad')->middleware('auth')->name('programa.estudiantes');

});





