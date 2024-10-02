<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Utils\Paginate;
use App\Utils\Times;
use App\Models\Permiso;
use App\Utils\TipoPermisos;
use App\Models\Empleado;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;



class PermisoController extends Controller
{
    public function index(Request $request)
    {
        $tipo_permisos = ["personal" => 15, "enfermedad personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18, 'personal sin goce de sueldo' => 16, 'alumbramiento' => 8, 'paternidad' => 23];
        $estado_permisos = ["aprobado" => 'A', "pendiente" => 'P', "denegado" => 'D'];

        // Obtener codigo del empleado
        $cod_empleado = $request->user()->cod_empleado;


        $permisos = Permiso::where('cod_empleado', $cod_empleado)
            ->orderByDesc('fecha_solic')
            ->get()
            ->transform(function ($permiso, int $key) {
                return [
                    'correlativo' => $permiso->correlativo,
                    'cod_permiso' => TipoPermisos::tipo_permiso($permiso->cod_permiso),
                    'fecha_solic' => $permiso->fecha_solic,
                    'fecha_inicial' => $permiso->fecha_inicial,
                    'hora_inicial' => $permiso->hora_inicial,
                    'fecha_final' => $permiso->fecha_final,
                    'hora_final' => $permiso->hora_final,
                    'total_tiempo' => Times::total_tiempo_solicitado($permiso->total_tiempo, 0),
                    'estado' => $permiso->estado
                ];
            });


        // Verificar si el empleado ya ha registrado algun permiso
        $i_permisos = $permisos->count();

        // Opciones de busqueda 

        if (!empty($request->input('fecha_solicitud'))) {
            $permisos = $permisos->where('fecha_solic', $request->date('fecha_solicitud'));
        }

        if (!empty($request->query('tipo_permiso'))) {
            $permisos = $permisos->where('cod_permiso', $request->input('tipo_permiso'));
        }

        if (!empty($request->query('estado_permiso'))) {
            $permisos = $permisos->where('estado', $request->input('estado_permiso'));
        }

        // Paginacion
        $permisos = Paginate::paginate($permisos);
        $permisos->withPath(url('/permisos'));

        // Devolver los valores para el form de busqueda
        $request->flash();

        return view('permiso.index', ['i_permisos' => $i_permisos, 'permisos' => $permisos, 't_permisos' => $tipo_permisos, 'e_permisos' => $estado_permisos]);
    }



    public function create(Request $request, Permiso $permiso)
    {

        $empleado = null;
    
        if ($request->has('dui')){
            $empleado = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->where('dui', $request->dui)->first();
            if (is_null($empleado)) {
                notify()->error('No hay registros que coincidan con el dui que digitastes. Intentalo de nuevo');
                return redirect()->back()->withInput(); 
            } 
                         
        }

       // dd($empleado);

        $cod_empleado = (is_null($empleado)) ? $request->user()->cod_empleado : $empleado->codigo_empleado;

        // Get data from one "EMPLEADO"
        $data_empleado = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->where('codigo_empleado', $cod_empleado)->first();

        // Get data from "TIPO PERMISOS"
        $data_tipo_permiso = DB::TABLE('PLANTMP_C_TIPOSPERMISOS')->select('cod_permiso', 'descripcion')->whereIn('cod_permiso', [15, 6, 18, 36, 8, 23])->get();

        // Data for opcions
        $opciones = ['V' => 'si', 'F' => 'no'];

        return view('permiso.create', ['permiso' => $permiso, 'empleado' => $data_empleado, 'tipo_permisos' => $data_tipo_permiso, 'opciones' => $opciones]);
    
    }

    public function store(Request $request)
    {
        //dd($request);

        // Get data from Session
        $cod_empleado = $request->cod_empleado;

        // Get data from one "EMPLEADO"
        $data_empleado = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->where('codigo_empleado', $cod_empleado)->first();

        // Validations
        $request->validate([
            'fecha_solic' => ['required'],
            'tipo_permiso' => ['required'],
            'goce_sueldo' => ['required'],
            'constancia' => ['required'],
            'fecha_inicial' => ['required'],
            'fecha_final' => ['required'],
            'hora_inicial' => ['required'],
            'hora_final' => ['required'],
            'motivo' => ['required']
        ]);

         
        $verificar_duplicado = Permiso::verificar(
            $cod_empleado,
            Carbon::parse($request->fecha_inicial)->format('Y-m-d'),
            Carbon::parse($request->fecha_final)->format('Y-m-d'),
            Carbon::parse($request->hora_inicial)->format('H:i'),
            Carbon::parse($request->hora_final)->format('H:i'),
            ($request->tipo_permiso == 15 && $request->goce_sueldo == 'F') ? 16 : $request->tipo_permiso,
            $request->goce_sueldo,
            $request->constancia)
            ->count();
        // Verificar si ya existe un registro con los mismos datos ingresados.
        if ($verificar_duplicado != 0) {
            notify()->error('Ya existe un permiso con los mismos datos que intenta ingresar.');
            return redirect()->
            back()->
            withInput(); 
        }

        // Obtengo una referencia a la secuencia, luego la llamo por medio del nombre definido en la db
        $secuencia = DB::getSequence();
        $p = new Permiso;
        $p->cod_empleado = $cod_empleado;
        $p->fecha_inicial = Carbon::parse($request->fecha_inicial)->format('Y-m-d');
        $p->fecha_final = Carbon::parse($request->fecha_final)->format('Y-m-d');
        $p->hora_inicial = Carbon::parse($request->hora_inicial)->format('H:i');
        $p->hora_final = Carbon::parse($request->hora_final)->format('H:i');
        $p->cod_permiso = ($request->tipo_permiso == 15 && $request->goce_sueldo == 'F') ? 16 : $request->tipo_permiso;
        $p->ano = Carbon::parse($request->fecha_registro)->year;
        $p->motivo = $request->motivo;
        $p->goce_sueldo = $request->goce_sueldo;
        $p->constancia = $request->constancia;
        $p->fecha_solic = Carbon::parse($request->fecha_presentacion)->format('Y-m-d');
        $p->num_plaza = $data_empleado->num_plaza;
        $p->mes = Carbon::parse($request->fecha_registro)->month;
        $p->total_tiempo = Times::total_horas_minutos(
            Carbon::parse($request->fecha_inicial),
            Carbon::parse($request->fecha_final),
            Carbon::parse($request->hora_inicial),
            Carbon::parse($request->hora_final)
        );
        $p->correlativo = $secuencia->nextValue('SEQ_CORRELATIVO');

        // Guardar datos
        $p->save();
        // Notificar sobre registro guardado
        notify()->success('Se ha registrado el permiso con éxito.');
        // Redirigir a la vista de permiso
        return redirect()->route('permiso.view', $p->correlativo);

    }

    public function view($permiso)
    {
        //$tipo_permiso = array("personal"=>15,"enf. personal"=>6,"familiar/duelo"=>18,"matrimonio"=>36);
        //dd($tipo_permiso);
        $estado_permiso = ['aprobado' => 'A'];

        $permiso1 = Permiso::where('correlativo', $permiso)->first();

        $empleado = Empleado::where('codigo_empleado', $permiso1->cod_empleado)->first();

        $permiso1->fecha_solic = date('d-m-Y', strtotime($permiso1->fecha_solic));
        $permiso1->total_tiempo = Times::total_tiempo_solicitado($permiso1->total_tiempo, 0);

        // Get data from "TIPO PERMISOS"
        $data_tipo_permiso = DB::TABLE('PLANTMP_C_TIPOSPERMISOS')->select('descripcion', 'cod_permiso')->where('cod_permiso', $permiso1->cod_permiso)->get();

        return view('permiso.view', ['permiso' => $permiso1, 'empleado' => $empleado, 'tipo_permiso' => $data_tipo_permiso, 'estado_permiso' => $estado_permiso]);
    }

    public function edit(Permiso $permiso)
    {
        
        // Get data from one "EMPLEADO"
        $empleado = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->where('codigo_empleado', $permiso->cod_empleado)->first();
        // Get data from "TIPO PERMISOS"
        $data_tipo_permiso = DB::TABLE('PLANTMP_C_TIPOSPERMISOS')->select('cod_permiso', 'descripcion')->whereIn('cod_permiso', [15, 6, 18, 36, 8, 23])->get();
        
        $opciones = ['V' => 'si', 'F' => 'no'];

       
       $permiso->fecha_solic = Carbon::parse($permiso->fecha_solic)->format('Y-m-d');
       $permiso->fecha_inicial = Carbon::parse($permiso->fecha_inicial)->format('Y-m-d');
       $permiso->fecha_final = Carbon::parse($permiso->fecha_final)->format('Y-m-d');
       
        return view('permiso.edit', ['permiso' => $permiso, 'empleado' => $empleado, 'tipo_permisos' => $data_tipo_permiso, 'opciones' => $opciones]);
    }

    public function update(Request $request, Permiso $permiso)
    {
    
        $permiso->update([
            'fecha_solic' => Carbon::parse($request->fecha_solic)->format('Y-m-d'),
            'cod_permiso' => ($request->tipo_permiso == 15 && $request->goce_sueldo == 'F') ? 16 : $request->tipo_permiso,
            'goce_sueldo' => $request->goce_sueldo,
            'constancia' => $request->constancia,
            'fecha_inicial' => Carbon::parse($request->fecha_inicial)->format('Y-m-d'),
            'fecha_final' => Carbon::parse($request->fecha_final)->format('Y-m-d'),
            'hora_inicial' => Carbon::parse($request->hora_inicial)->format('H:i'),
            'hora_final' => Carbon::parse($request->hora_final)->format('H:i'),
            'motivo' => $request->motivo,
            'ano' => Carbon::parse($request->fecha_registro)->year,
            'mes' => Carbon::parse($request->fecha_registro)->month,
            'total_tiempo' => Times::total_horas_minutos(
                Carbon::parse($request->fecha_inicial),
                Carbon::parse($request->fecha_final),
                Carbon::parse($request->hora_inicial),
                Carbon::parse($request->hora_final)
            )

        ]);

        notify()->success('Se ha modificado el registro con éxito');

        return redirect()->route('permiso.view', $permiso);
    }

    public function imprimir($permiso)
    {

        $permiso1 = Permiso::where('correlativo', $permiso)->first();

        $tipo_permiso = match ($permiso1->cod_permiso) {
            '15' => ["personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '36' => ["personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '18' => ["personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '6' => ["personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '16' => ["s/personal" => 16, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '8' => ["alumbramiento" => 8, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '23' => ["paternidad" => 23, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18]
        };


        $empleado = Empleado::where('codigo_empleado', $permiso1->cod_empleado)->first();
        $permiso1->fecha_solic = date('d-m-Y', strtotime($permiso1->fecha_solic));
        $permiso1->total_tiempo = Times::total_tiempo_solicitado($permiso1->total_tiempo, 0);

        //$pdf = Pdf::loadView('permiso.imprimir');
        // return $pdf->download('test.pdf');



        $pdf = Pdf::loadView('permiso.imprimir', ['permiso' => $permiso1, 'empleado' => $empleado, "t_permiso" => $tipo_permiso]);
        $pdf->render();
        return $pdf->download('permiso'.'_'.$permiso1->fecha_solic.'.pdf');
        //return view('permiso.imprimir' , ['permiso' => $permiso1, 'empleado' => $empleado, "t_permiso" => $tipo_permiso]);
    }



    public function disponibilidad(Request $request)
    {
        $cod_empleado = $request->user()->cod_empleado;
        $cod_permisos = DB::TABLE('PLANTMP_C_TIPOSPERMISOS')->select(['cod_permiso', 'descripcion', 'valor'])
            ->whereIn('cod_permiso', [15, 16, 6, 18, 8, 23, 36])
            ->get();

        $datos = DB::table('t_vista_disponibilidad_h')
            ->where('cod_empleado', $cod_empleado)
            ->get()
            ->transform(function ($disponibilidad, int $key) {
                return [
                    'cod_empleado' => $disponibilidad->cod_empleado,
                    'cod_permiso' => $disponibilidad->cod_permiso,
                    'descripcion' => $disponibilidad->descripcion,
                    'goce_sueldo' => $disponibilidad->goce_sueldo,
                    'mes' => $disponibilidad->mes,
                    'ano' => $disponibilidad->ano,
                    'valor' => $disponibilidad->valor,
                    'total' => Times::total_tiempo_solicitado(($disponibilidad->total), 1),
                    'disponibles' => Times::total_tiempo_solicitado(($disponibilidad->disponibles), 1)
                ];
            });

        $c1 = $datos->keyBy('cod_permiso');
        $c2 = $cod_permisos->keyBy('cod_permiso');
        $c3 = $c1->union($c2);
        $c4 = json_decode($c3);

        return view('permiso.disponibilidad', ['datos' => Collection::make($c4)]);
    }


    public function permiso_comp()
    {
        return view('permiso.permiso_com');
    }

}
