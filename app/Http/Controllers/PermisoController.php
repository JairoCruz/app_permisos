<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Utils\Paginate;
use App\Utils\Times;
use App\Models\Permiso;
use App\Models\Unidad;
use App\Utils\TipoPermisos;
use App\Models\Empleado;
use App\Models\Tipo_Permiso;
use App\Models\JefesxEmpleado;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;



class PermisoController extends Controller
{
    public function tipo_permisos(Request $request){
        if ($request->ajax()){
            $tipos = Tipo_Permiso::select('id', 'cod_permiso', 'descripcion')->whereIn('cod_permiso', [15, 6, 36, 18, 8, 23])->get();
            return response()->json(['tipos' => $tipos]);
        }
    }

    public function index(Request $request)
    {

        // Obtener codigo del empleado
        $cod_empleado = $request->user()->cod_empleado;


        //$request->session()->put('codigo',$cod_empleado);

        $permisos = Permiso::where('codigo_empleado', $cod_empleado)
            ->orderByDesc('fecha_solicitud')
            ->get()
            ->transform(function ($permiso, int $key) {
                return [
                    'id' => $permiso->id,
                    'tp_fk' => $permiso->tp_fk,
                    'correlativo' => $permiso->correlativo,
                    'cod_permiso' => $permiso->tipo_permiso->descripcion,
                    'fecha_solic' => Carbon::parse($permiso->fecha_solicitud)->format('d-m-Y'),
                    'fecha_inicial' => Carbon::parse($permiso->fecha_inicial)->format('d-m-Y'),
                    'hora_inicial' => $permiso->hora_inicial,
                    'fecha_final' => Carbon::parse($permiso->fecha_final)->format('d-m-Y'),
                    'hora_final' => $permiso->hora_final,
                    'total_tiempo' => Times::total_tiempo_solicitado($permiso->total_tiempo, 0),
                    'estado' => $permiso->estado_permiso->nombre
                ];
            });

        $tipos = Tipo_Permiso::select('id', 'cod_permiso', 'descripcion')->whereIn('cod_permiso', [15, 6, 36, 18, 8, 23])->get();
        if ($request->ajax()) {
            $data = $permisos;
            return response()->json(['data' => $data]);
        }


        // Devolver los valores para el form de busqueda
        $request->flash();

        return view('permiso.index', ['permisos' => $permisos, 'tipos' => $tipos]);
    }



    public function create(Request $request, Permiso $permiso)
    {

        $empleado = null;

        if ($request->has('dui')) {
            $empleado = Empleado::where('dui', $request->dui)->first();
            if (is_null($empleado)) {
                notify()->error('No hay registros que coincidan con el dui que digitastes. Intentalo de nuevo');
                return redirect()->back()->withInput();
            }
        }



        $cod_empleado = (is_null($empleado)) ? $request->user()->cod_empleado : $empleado->codigo_empleado;

        // Get data from one "EMPLEADO"
        $data_empleado = Empleado::where('codigo_empleado', $cod_empleado)->first();


        // Get data from "TIPO PERMISOS"
        $data_tipo_permiso = Tipo_Permiso::select('id', 'cod_permiso', 'descripcion')->whereIn('cod_permiso', [15, 6, 36, 18, 8, 23])->get();
        //dd($data_tipo_permiso);

        // Data for opcions
        $opciones = ['V' => 'si', 'F' => 'no'];

        $jefes_x_empleado = JefesxEmpleado::where('e_id', 400)->get();

        // dd($jefes_x_empleado);


        return view('permiso.create', ['permiso' => $permiso, 'empleado' => $data_empleado, 'tipo_permisos' => $data_tipo_permiso, 'opciones' => $opciones, 'jf' => $jefes_x_empleado]);
    }




    public function store(Request $request)
    {


        if ($request->ajax()) {

            $data_empleado = Empleado::where('codigo_empleado', $request->user()->cod_empleado)->first();


            $validator = Validator::make($request->all(), [
                'fechaSolicitud' => 'required',
                'tipoPermiso' => 'required',
                'goceSueldo' => 'required',
                'constancia' => 'required',
                'fechaInicio' => 'required',
                'fechaFin' => 'required',
                'horaInicio' => 'required',
                'horaFin' => 'required',
                'motivo' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(["errors" => $validator->errors()]);
            }

            error_log($request->p_id);
            error_log($request->fechaInicio);
            Permiso::updateOrCreate(
                ['id' => $request->p_id],
                [
                    'emp_fk' => $data_empleado->id,
                    'codigo_empleado_registra' =>  $data_empleado->codigo_empleado,
                    'jefe_unidad_id' => 45, 
                    'codigo_empleado' => $data_empleado->codigo_empleado,
                    'fecha_inicial' => Carbon::parse($request->fechaInicio)->format('Y-m-d'),
                    'fecha_final' => Carbon::parse($request->fechaFin)->format('Y-m-d'),
                    'hora_inicial' => Carbon::parse($request->horaInicio)->format('H:i'),
                    'hora_final' => Carbon::parse($request->horaFin)->format('H:i'),
                    'tp_fk' => ($request->tipoPermiso == 9 && $request->goceSueldo == 'F') ? 10 : $request->tipoPermiso,
                    'ano' => Carbon::parse($request->fechaSolicitud)->year,
                    'motivo' => $request->motivo,
                    'goce_sueldo' => $request->goceSueldo,
                    'constancia' => $request->constancia,
                    'fecha_solicitud' => Carbon::parse($request->fechaSolicitud)->format('Y-m-d'),
                    'numero_plaza' => $data_empleado->numero_plaza,
                    'mes' => Carbon::parse($request->fechaSolicitud)->month,
                    'total_tiempo' => Times::total_horas_minutos(
                        Carbon::parse($request->fechaInicio),
                        Carbon::parse($request->fechaFin),
                        Carbon::parse($request->horaInicio),
                        Carbon::parse($request->horaFin)),
                ]
            );

            return Response()->json(['success' => 'Se ha registrado el permiso', 'data' => $request->all()]);
        }
        //dd($request);

        // Get data from Session
        $cod_empleado = $request->cod_empleado;

        // Get data from one "EMPLEADO"
        $data_empleado = Empleado::where('codigo_empleado', $cod_empleado)->first();
        //dd($data_empleado);

        // Validations
        $request->validate([
            'fecha_crea' => ['required'],
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
            $request->constancia
        )
            ->count();
        // Verificar si ya existe un registro con los mismos datos ingresados.
        if ($verificar_duplicado != 0) {
            notify()->error('Ya existe un permiso con los mismos datos que intenta ingresar.');
            return redirect()->back()->withInput();
        }

        // Obtengo una referencia a la secuencia, luego la llamo por medio del nombre definido en la db
        // $secuencia = DB::getSequence();

        $p = new Permiso;
        $p->emp_fk = $data_empleado->id;
        $p->codigo_empleado_registra = $cod_empleado;
        $p->jefe_unidad_id = 45; // ignac
        $p->codigo_empleado = $cod_empleado;
        $p->fecha_inicial = Carbon::parse($request->fecha_inicial)->format('Y-m-d');
        $p->fecha_final = Carbon::parse($request->fecha_final)->format('Y-m-d');
        $p->hora_inicial = Carbon::parse($request->hora_inicial)->format('H:i');
        $p->hora_final = Carbon::parse($request->hora_final)->format('H:i');
        $p->tp_fk = ($request->tipo_permiso == 9 && $request->goce_sueldo == 'F') ? 10 : $request->tipo_permiso;
        $p->ano = Carbon::parse($request->fecha_crea)->year;
        $p->motivo = $request->motivo;
        $p->goce_sueldo = $request->goce_sueldo;
        $p->constancia = $request->constancia;
        $p->fecha_solicitud = Carbon::parse($request->fecha_solic)->format('Y-m-d');
        $p->numero_plaza = $data_empleado->numero_plaza;
        $p->mes = Carbon::parse($request->fecha_crea)->month;
        $p->total_tiempo = Times::total_horas_minutos(
            Carbon::parse($request->fecha_inicial),
            Carbon::parse($request->fecha_final),
            Carbon::parse($request->hora_inicial),
            Carbon::parse($request->hora_final)
        );
        // $p->correlativo = $secuencia->nextValue('SEQ_CORRELATIVO');

        // Guardar datos
        $p->save();
        // Notificar sobre registro guardado
        notify()->success('Se ha registrado el permiso con éxito.');
        // Redirigir a la vista de permiso
        return redirect()->route('permiso.view', $p->id);
    }

    public function view($permiso)
    {

        //$tipo_permiso = array("personal"=>15,"enf. personal"=>6,"familiar/duelo"=>18,"matrimonio"=>36);
        //dd($tipo_permiso);
        $estado_permiso = ['aprobado' => 'A'];

        $permiso1 = Permiso::where('id', $permiso)->first();



        $empleado = Empleado::where('codigo_empleado', $permiso1->codigo_empleado)->first();
        ($empleado);

        $permiso1->fecha_solic = date('d-m-Y', strtotime($permiso1->fecha_solic));
        $permiso1->total_tiempo = Times::total_tiempo_solicitado($permiso1->total_tiempo, 0);

        // Get data from "TIPO PERMISOS"
        $data_tipo_permiso = Tipo_Permiso::select('descripcion', 'cod_permiso')->where('id', $permiso1->tp_fk)->get();
        //dd($data_tipo_permiso);

        return view('permiso.view', ['permiso' => $permiso1, 'empleado' => $empleado, 'tipo_permiso' => $data_tipo_permiso, 'estado_permiso' => $estado_permiso]);
    }

    public function edit(Request $request)
    {

        if ($request->ajax()){
            $permiso = Permiso::find($request->id);
            
            $permiso->fecha_solicitud = Carbon::parse($permiso->fecha_solicitud)->format('Y-m-d');
            $permiso->fecha_inicial = Carbon::parse($permiso->fecha_inicial)->format('Y-m-d');
            $permiso->fecha_final = Carbon::parse($permiso->fecha_final)->format('Y-m-d');

            return response()->json(['permiso' => $permiso]);
        }

        

        // Get data from one "EMPLEADO"
       // $empleado = Empleado::where('codigo_empleado', $permiso->codigo_empleado)->first();
        // Get data from "TIPO PERMISOS"
       /// $data_tipo_permiso = Tipo_Permiso::select('id', 'cod_permiso', 'descripcion')->whereIn('cod_permiso', [6, 15, 18, 36, 8, 16, 23])->get();



        // $opciones = ['V' => 'si', 'F' => 'no'];

        // $permiso->fecha_crea = Carbon::parse($permiso->fecha_crea)->format('Y-m-d');
        // $permiso->fecha_solic = Carbon::parse($permiso->fecha_solic)->format('Y-m-d');
        // $permiso->fecha_inicial = Carbon::parse($permiso->fecha_inicial)->format('Y-m-d');
        // $permiso->fecha_final = Carbon::parse($permiso->fecha_final)->format('Y-m-d');



        // return view('permiso.edit', ['permiso' => $permiso, 'empleado' => $empleado, 'tipo_permisos' => $data_tipo_permiso, 'opciones' => $opciones]);
    }

    public function update(Request $request, Permiso $permiso)
    {

        //dd($request->tipo_permiso, $permiso);
        $permiso->update([
            'fecha_solicitud' => Carbon::parse($request->fecha_solic)->format('Y-m-d'),
            'tp_fk' => ($request->tipo_permiso == 9 && $request->goce_sueldo == 'F') ? 10 : $request->tipo_permiso,
            'goce_sueldo' => $request->goce_sueldo,
            'constancia' => $request->constancia,
            'fecha_inicial' => Carbon::parse($request->fecha_inicial)->format('Y-m-d'),
            'fecha_final' => Carbon::parse($request->fecha_final)->format('Y-m-d'),
            'hora_inicial' => Carbon::parse($request->hora_inicial)->format('H:i'),
            'hora_final' => Carbon::parse($request->hora_final)->format('H:i'),
            'motivo' => $request->motivo,
            'ano' => Carbon::parse($request->fecha_crea)->year,
            'mes' => Carbon::parse($request->fecha_crea)->month,
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
        // dd($permiso);

        $permiso1 = Permiso::where('id', $permiso)->first();


        $tipo_permiso = match ($permiso1->tipo_permiso->cod_permiso) {
            '15' => ["personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '36' => ["personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '18' => ["personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '6' => ["personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '16' => ["S/G personal" => 16, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '8' => ["alumbramiento" => 8, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18],
            '23' => ["paternidad" => 23, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18]
        };



        $empleado = Empleado::where('codigo_empleado', $permiso1->codigo_empleado)->first();
        $permiso1->fecha_solic = date('d-m-Y', strtotime($permiso1->fecha_solicitud));
        $permiso1->total_tiempo = Times::total_tiempo_solicitado($permiso1->total_tiempo, 0);

        //$pdf = Pdf::loadView('permiso.imprimir');
        // return $pdf->download('test.pdf');



        $pdf = Pdf::loadView('permiso.imprimir', ['permiso' => $permiso1, 'empleado' => $empleado, "t_permiso" => $tipo_permiso]);
        $pdf->render();
        return $pdf->download('permiso' . '_' . $permiso1->fecha_solic . '.pdf');
        //return view('permiso.imprimir' , ['permiso' => $permiso1, 'empleado' => $empleado, "t_permiso" => $tipo_permiso]);
    }



    public function disponibilidad(Request $request)
    {
        //dd(now()->format('Y'));
        $cod_empleado = $request->user()->cod_empleado;
        $cod_permisos = Tipo_permiso::select(['id', 'cod_permiso', 'descripcion', 'valor'])
            ->whereIn('cod_permiso', [15, 16, 6, 18, 8, 23, 36])
            ->get();
        // dd($cod_permisos);

        $periodo = DB::table('t_vista_disponibilidad_anual')
            ->select('ano')
            ->where('cod_empleado', $cod_empleado)
            ->where('ano', now()->format('Y'))
            ->first();
        //$periodo = (is_null($periodo)) ? ['ano'=>now()->format('Y')] : $periodo;
        //dd($periodo);

        $datos = DB::table('t_vista_disponibilidad_anual')
            ->where('cod_empleado', $cod_empleado)
            ->get()
            ->transform(function ($disponibilidad, int $key) {
                return [
                    'cod_empleado' => $disponibilidad->cod_empleado,
                    'cod_permiso' => $disponibilidad->cod_permiso,
                    'descripcion' => $disponibilidad->descripcion,
                    'goce_sueldo' => $disponibilidad->goce_sueldo,
                    'ano' => $disponibilidad->ano,
                    'valor' => $disponibilidad->valor,
                    'total' => Times::total_tiempo_solicitado(($disponibilidad->total), 1),
                    'disponibles' => Times::total_tiempo_solicitado(($disponibilidad->disponibles), 1)
                ];
            });
        //dd($datos);

        $c1 = $datos->keyBy('cod_permiso');
        $c2 = $cod_permisos->keyBy('cod_permiso');
        $c3 = $c1->union($c2);
        $c4 = json_decode($c3);

        return view('permiso.disponibilidad', ['datos' => Collection::make($c4), 'periodo' => $periodo]);
    }


    public function permiso_comp()
    {
        return view('permiso.permiso_com');
    }
}
