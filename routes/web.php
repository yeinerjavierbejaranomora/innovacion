<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\contrasenaController;
use App\Http\Controllers\cambioController;

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

    return view('login_prueba/login');
});


Route::get('admin/', function () {
    //return view('welcome');

    return view('vistas/admin');
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
    Route::get('/login/home/','home')->name('login.home');
    Route::get('/login/cambio/','cambio')->name('login.cambio');
    Route::post('/login/cambiopass','cambioPass')->name('login.cambiopass');
    Route::get('/logout','logout')->name('logout');
});

Route::controller(contrasenaController::class)->group(function(){
    Route::get('/contrasena','index')->name('contrasena.index');
});

Route::controller(cambioController::class)->group(function(){
    Route::get('/cambio','index')->name('cambio.index');
    Route::post('/cambio/cambio','consultar')->name('consultar.index');
    Route::get('/nueva','nueva')->name('nueva.index');
});

