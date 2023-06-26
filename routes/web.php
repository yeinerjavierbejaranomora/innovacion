<?php

/** definimos losb controladores para que funcionen las rutas  */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\contrasenaController;
use App\Http\Controllers\cambioController;
use App\Http\Controllers\UserController;

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
    /** cargamos la vista de administracion de usuarios */
    Route::get('/home/usuarios','userView')->middleware('auth','admin')->name('admin.users');
    /** cargamos ña vista para mostarar todos los usuarios */
    Route::get('/home/users','get_users')->middleware('auth','admin')->name('admin.getusers');
    /** cargamos la vista de administracion de facultades */
    Route::get('/home/facultad','facultadView')->middleware('auth','admin')->name('admin.facultades');
    /** cargamos la vista para mostrar todas las facultades */
    Route::get('/home/facultades','get_facultades')->middleware('auth','admin')->name('admin.getfacultades');
    /** para salvar las facultades */
    Route::post('/home/facultades/save','savefacultad')->middleware('auth','admin')->name('admin.guardarfacultad');
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



