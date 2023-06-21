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

Route::controller(UserController::class)->group(function(){

    Route::get('/home','home')->middleware('auth')->name('home.index');
    Route::get('/home/facultad/{id}','facultad')->middleware('auth')->name('facultad.index');
    Route::get('/home/perfil/{id}', 'perfil')->middleware('auth')->name('user.perfil');
    Route::get('/home/usuarios','userView')->middleware('auth','admin')->name('admin.users');
});


Route::controller(RegistroController::class)->group(function(){
    Route::get('/registro','index')->name('registro.index');
    Route::get('/registro/roles','roles')->name('registro.roles');
    Route::post('/registro/facultades','facultades')->name('registro.facultades');
    Route::post('/registro/programas','programas')->name('registro.programas');
    Route::post('/registro/save','saveRegistro')->name('registro.saveregistro');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login','index')->name('login.index');
    Route::post('login/login','login')->name('login.login');
    Route::get('/login/home/','home')->middleware('auth')->name('login.home');
    Route::get('/login/cambio/','cambio')->name('login.cambio');
    Route::post('/login/cambiopass','cambioPass')->name('login.cambiopass');
    Route::get('/logout','logout')->name('logout');
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



