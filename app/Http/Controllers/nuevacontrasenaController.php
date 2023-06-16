<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class nuevacontrasenaController extends Controller
{
    public function index() {
        return view('nuevaContrasena.index');
    }
}