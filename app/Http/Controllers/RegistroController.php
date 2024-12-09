<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Unidad;
use App\Models\Permiso;

class RegistroController extends Controller
{
    /* public function index()
    {
        $empleados = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->get();
        return view('registro.index', ['empleados' => $empleados]);
    }
 */
    public function index(Request $request)
    {
        
        if($request->ajax()){
            $data = Permiso::get();
        return response()->json(['unidad' => $data]);
        }
        
    }
}
