<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    //
    public function index() {
        $roles = DB::table('roles')->get();
        var_dump($roles);
        return view('registro.index');
    }

    public function roles() {
        $roles = DB::table('roles')->get();
        var_dump($roles);
    }
}
