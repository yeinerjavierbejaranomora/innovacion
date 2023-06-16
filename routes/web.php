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
    Route::post('/registro/roles','roles')->name('registro.roles');
});

Route::controller(contrasenaController::class)->group(function(){
    Route::get('/contrasena','index')->name('contrasena.index');
});

Route::controller(cambiocontrasenaController::class)->group(function(){
    Route::get('/cambioContrasena','index')->name('cambioContrasena.index');
});
