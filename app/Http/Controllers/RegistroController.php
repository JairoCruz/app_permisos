<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function index()
    {
        $empleados = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->get();
        return view('registro.index', ['empleados' => $empleados]);
    }
}
