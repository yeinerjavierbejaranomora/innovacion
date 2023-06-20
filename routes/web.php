<?php

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

    return view('login');
});


Route::controller(UserController::class)->group(function(){

    Route::get('/home','index')->name('home.index');

Route::get('/vistas/admin','index')->name('admin.index');


});



/// definimos las rutas para poder  registrar las facultades, roles, programas,etc...
Route::controller(RegistroController::class)->group(function(){
    
    /* ruta para registro de usuario*/
    Route::get('/registro','index')->name('registro.index');
    
    /* ruta para registro de roles*/    
    Route::get('/registro/roles','roles')->name('registro.roles');
    
    /* ruta para registro de facultades*/
    Route::post('/registro/facultades','facultades')->name('registro.facultades');
    /* ruta para registro de programas*/    
    Route::post('/registro/programas','programas')->name('registro.programas');

    /* ruta para salvar los registros*/
    Route::post('/registro/save','saveRegistro')->name('registro.saveregistro');
});


/// definimos las rutas para el login de usuarios
Route::controller(LoginController::class)->group(function(){

    /** ruta para ver el login del sistema */
    Route::get('/login','index')->name('login.index');
    
    /**  */
    Route::post('login/login','login')->name('login.login');


    Route::get('/login/home/','home')->name('login.home');


    Route::get('/login/cambio/','cambio')->name('login.cambio');


    Route::post('/login/cambiopass','cambioPass')->name('login.cambiopass');

    Route::get('/logout','logout')->name('logout');

});

// *Ruta para contraseña*
Route::controller(contrasenaController::class)->group(function(){
    Route::get('/password','index')->name('password.index');
});


// *Rutas para cambio de contraseña*
Route::controller(cambioController::class)->group(function(){

// *Ruta para ver el formulario del cambio de contraseña para pedir los datos al usuario
    Route::get('/cambio','index')->name('cambio.index');

// *Ruta para consular los datos ingresados por el usuario    
    Route::post('/cambio/cambio','consultar')->name('cambio.consultar');
    
// Ruta para ver el formulario de cambio de contraseña    
    Route::get('/nueva','nueva')->name('nueva.index');
});


