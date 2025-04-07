<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Permiso;
use App\Models\Unidad;
use App\Utils\Times;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

enum Estado: int {
    case Aprobado = 1;
    case Pendiente = 2;
    case Denegado = 3;
}

class AutorizacionPermisoController extends Controller
{
    public function index(Request $request)
    {

        
        $cod_empleado = Auth::user()->cod_empleado;

        $empleado = Empleado::where('codigo_empleado', $cod_empleado)->first();

        //$unidades = Permiso::where('jefe_unidad_id', 4)->get();
        
        $data = [];
        //Obtengo los id de las unidades del cual el empleado es jefe
        foreach($empleado->_unidad as $unidad){
            $data[] = $unidad->pivot->id;
        }

        $permisos = Permiso::whereIn('jefe_unidad_id', $data)->
        where('estado',Estado::Pendiente)->
        get();//bueno

        
        return view('permiso-autorizacion.index', ['permisos' => $permisos]);
        

    }

    public function aprobar(Request $request)
    {
        $permiso = Permiso::where('id',$request->permiso)->first();
        $permiso->estado = Estado::Aprobado;
        $permiso->save();

       
        return redirect()->route('autorizacion-permiso');
    }

    public function rechazar(Request $request)
    {
        
        $permiso = Permiso::where('id', $request->permiso)->first();
        $permiso->estado = Estado::Denegado;
        $permiso->save();
        return redirect()->route('autorizacion-permiso');
    }
}
