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
        //$empleados = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->get();
       // dd(Permiso::all());
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
        //error_log($this->total_tiempo_solicitado(0.13));
        //dd($this->total_tiempo_solicitado(0.13));
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
        DB::table('PLANTMP_PERMISOS_EN_LINEA')->insert([
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
        ]);

        
       /* 
        if ($fecha_inicial_p->equalTo($fecha_final_p))
        { 
            error_log('fechas son iguales y es de vereficar si es permiso de ocho horas o fraccion de 8');
            if ($hora_inicial_p->floatDiffInHours($hora_final_p) < 8)
            { 
                $horas_minutos = $hora_inicial_p->floatDiffInHours($hora_final_p);
                error_log($horas_minutos);
            }
            else
            { 
                if ($hora_inicial_p->floatDiffInHours($hora_final_p) != 8)
                {
                    error_log('lo sentimos pero el tiempo es mayor a las horas laborables');
                }
                else {
                    error_log('ok es un dia entero osea 8 horas');
                }
                
            }
        } else 
        {
            error_log('fechas no son iguales');
            if ($fecha_inicial_p->diffInDays($fecha_final_p) && ($hora_inicial_p->floatDiffInHours($hora_final_p) == 8))
            {
            $diasT = ($fecha_inicial_p->diffInDays($fecha_final_p)) + 1;
            $total_horas_solicitadas = $diasT * 8;
            error_log($diasT);
            error_log($total_horas_solicitadas);
            }
            else {
                error_log('varios dias pero horas son distintas');
                $diasT = (($fecha_inicial_p->diffInDays($fecha_final_p)) + 1) * 8;
                error_log($diasT);
                $horas_minitus = $hora_inicial_p->floatDiffInHours($hora_final_p);
                $total_dias_horas = $diasT + $horas_minitus;
                error_log($total_dias_horas);
            }
            
        }
         */

    }

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
