<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutorizacionPermisoController extends Controller
{
    public function index(Request $requesty)
    {

        return view('permiso-autorizacion.index');

    }
}
