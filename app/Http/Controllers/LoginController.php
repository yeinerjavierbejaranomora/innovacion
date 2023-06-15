<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        /*$roles = DB::table('roles')->get();
        var_dump($roles);*/
        return view('login.index');
    }
}
