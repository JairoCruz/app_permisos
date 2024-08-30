<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Permiso;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PermisoController extends Controller
{
    public function index()
    {
        
        $permisos = Permiso::all()->transform(function ($permiso, int $key){
            return [
                'correlativo' => $permiso->correlativo,
                'fecha_solic' => $permiso->fecha_solic,
                'fecha_inicial' => $permiso->fecha_inicial,
                'hora_inicial' => $permiso->hora_inicial,
                'fecha_final' => $permiso->fecha_final,
                'hora_final' => $permiso->hora_final,
                'total_tiempo' => $this->total_tiempo_solicitado($permiso->total_tiempo) 
            ];
        });
        
        return view('permiso.index', ['permisos' => $permisos]);
    }

    public function create(Request $request)
    {

        $cod_empleado = $request->user()->cod_empleado;

        // Get data from one "EMPLEADO"
        $data_empleado = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->where('codigo_empleado', $cod_empleado)->first();

        // Get data from "TIPO PERMISOS"
        $data_tipo_permiso = DB::TABLE('PLANTMP_C_TIPOSPERMISOS')->select('cod_permiso','descripcion')->whereIn('cod_permiso', [15,6,18,36])->get();
        
        return view('permiso.create', ['d_empleado'=> $data_empleado, 'tipo_permisos' => $data_tipo_permiso]);
        //return view('permiso.create');
    }

    public function store(Request $request)
    {

        // Validations
        $request->validate([
            'fecha_presentacion' => ['required'],
            'tipo_permiso' => ['required'],
            'goce_sueldo' => ['required'],
            'constancia' => ['required'],
            'fecha_inicial' => ['required'],
            'fecha_final' => ['required'],
            'hora_inicial' => ['required'],
            'hora_final' => ['required'],
            'motivo' => ['required']
        ]);

        // Get data from Session
        $cod_empleado = $request->user()->cod_empleado;

        // Get data from one "EMPLEADO"
        $data_empleado = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->where('codigo_empleado', $cod_empleado)->first();

        // Parses date and time
        $fecha_inicial_p = Carbon::parse($request->fecha_inicial);
        $fecha_final_p = Carbon::parse($request->fecha_final);
        $ano_p = Carbon::parse($request->fecha_registro);
        $hora_inicial_p = Carbon::parse($request->hora_inicial);
        $hora_final_p = Carbon::parse($request->hora_final);
       


        // Save data
        $cod_empleado = $request->user()->cod_empleado;
        $fecha_inicial = $fecha_inicial_p->format('Y-m-d');
        $fecha_final = $fecha_final_p->format('Y-m-d');
        $hora_inicial = $hora_inicial_p->format('H:i');  
        $hora_final = $hora_final_p->format('H:i');
        $cod_permiso = $request->tipo_permiso;      
        $ano = $ano_p->year;
        //$usuario_crea = $request->digitador;
        $motivo = $request->motivo;
        $goce_sueldo = $request->goce_sueldo;
        $constancia = $request->constancia;
        $fecha_solicitud = $request->fecha_presentacion;
        $num_plaza = $data_empleado->num_plaza;
        $mes = $ano_p->month;
        //$tipo_empleado_ = $data_empleado->tipo_empleado;

        $dato = $this->total_horas_minutos($fecha_inicial_p, $fecha_final_p, $hora_inicial_p, $hora_final_p);
        error_log($dato);
        // Funciona

        // Obtengo una referencia a la secuencia, luego la llamo por medio del nombre definido en la db
        $secuencia = DB::getSequence();

        $p = new Permiso;
        $p->cod_empleado = $cod_empleado;
        $p->fecha_inicial = $fecha_inicial;
        $p->fecha_final = $fecha_final;
        $p->hora_inicial = $hora_inicial;
        $p->hora_final = $hora_final;
        $p->cod_permiso = $cod_permiso;
        $p->ano = $ano;
        $p->motivo = $motivo;
        $p->goce_sueldo = $goce_sueldo;
        $p->constancia = $constancia;
        $p->fecha_solic = $fecha_solicitud;
        $p->num_plaza = $num_plaza;
        $p->mes = $mes;
        $p->total_tiempo = $dato;
        $p->correlativo = $secuencia->nextValue('SEQ_CORRELATIVO');

        $p->save();

        return redirect()->route('permiso.view', $p);

       /*  DB::table('PLANTMP_PERMISOS_EN_LINEA')->insert([
            'cod_empleado' => $cod_empleado,
            'fecha_inicial' => $fecha_inicial,
            'fecha_final' => $fecha_final,
            'hora_inicial' => $hora_inicial,
            'hora_final' => $hora_final,
            'cod_permiso' => $cod_permiso,
            'ano' => $ano,
            'motivo' => $motivo,
            'goce_sueldo' => $goce_sueldo,
            'constancia' => $constancia,
            'fecha_solic' => $fecha_solicitud,
            'num_plaza' => $num_plaza,
            'mes' => $mes,
            'total_tiempo' => $dato,
            'correlativo' => $secuencia->nextValue('SEQ_CORRELATIVO')
        ]); */

    }

    public function view(Permiso $permiso)
    {
        return view('permiso.view', ['permiso' => $permiso]);
    }

    // Metodos

    public function total_tiempo_solicitado($t_tiempo)
    {
        $ent = floor($t_tiempo);
        $dec = fmod($t_tiempo, 1);

        return $ent .' Hrs. con '. round(($dec * 60), 0) . ' min.';
        /* if ($ent != 0)
        {
            error_log($ent.'Hrs.'.'con'. ($dec * 60).' min.');
        }
        error_log($ent);
        error_log($dec); */
    }

    
    public function total_horas_minutos($f_inicial, $f_final, $h_inicial, $h_final)
    {
        $t_horas_minutos;
        $h_laborales = 8;
        // 1. Verificar si fechas pertenecen al mismo dia e horas son iguales al total de horal laborales para un dia.
        if ($f_inicial->equalTo($f_final) && ($h_inicial->floatDiffInHours($h_final) <= $h_laborales) )
        {
            
            $t_horas_minutos = $h_inicial->floatDiffInHours($h_final);
        }
        else
        {
            
            $t_horas_minutos = (($f_inicial->diffInDays($f_final) + 1) * $h_laborales);
        }

        
        
        return $t_horas_minutos;
    }

}
