<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    public function index()
    {
        $empleados = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->get();
        return view('registro.index', ['empleados' => $empleados]);
    }

    public function create(Request $request)
    {

        // $cod_empleado = $request->user()->cod_empleado;
        // $data_empleado = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->where('codigo_empleado', $cod_empleado)->get();
        
        //return view('permiso.create', ['user'=>$data_empleado]);
        return view('permiso.create');
    }

}
