<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Permiso;
use App\Models\Empleado;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\lengthAwarePaginator;


class PermisoController extends Controller
{
    public function index(Request $request)
    {
        $cod_empleado = $request->user()->cod_empleado;

        $permisos = Permiso::where('cod_empleado', $cod_empleado)->get()->transform(function ($permiso, int $key) {
            return [
                'correlativo' => $permiso->correlativo,
                'cod_permiso' => $this->tipo_permiso($permiso->cod_permiso),
                'fecha_solic' => $permiso->fecha_solic,
                'fecha_inicial' => $permiso->fecha_inicial,
                'hora_inicial' => $permiso->hora_inicial,
                'fecha_final' => $permiso->fecha_final,
                'hora_final' => $permiso->hora_final,
                'total_tiempo' => $this->total_tiempo_solicitado($permiso->total_tiempo),
                'estado' => $permiso->estado
            ];
        });

        //dd($this->paginate($permisos));
        $permisos = $this->paginate($permisos);
        $permisos->withPath(url('/permisos'));
        //dd($permisos);
        return view('permiso.index', ['permisos' => $permisos]);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        //dd($page);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function pagination(Collection $data)
    {
        $items = $data->forPage($currentPage = 0, $perPage = 0);
        $totalResults = $data->count();
        $perPage = 15;
        $currentPage = request('page') ?: (Paginator::resolveCurrentPage() ?: 1);

        return new LengthAwarePaginator(
            $items,
            $totalResults,
            $perPage,
            $currentPage,
            // Esta parte la copie de lo que hace por defecto el paginador de Laravel haciendo un dd()
            [
                'path' => url()->current(),
                'pageName' => 'page',
            ]
        );
    }

    public function create(Request $request)
    {

        $cod_empleado = $request->user()->cod_empleado;

        // Get data from one "EMPLEADO"
        $data_empleado = DB::TABLE('PLANTMP_VISTA_EMPLEADOS')->where('codigo_empleado', $cod_empleado)->first();

        // Get data from "TIPO PERMISOS"
        $data_tipo_permiso = DB::TABLE('PLANTMP_C_TIPOSPERMISOS')->select('cod_permiso', 'descripcion')->whereIn('cod_permiso', [15, 6, 18, 36])->get();

        return view('permiso.create', ['d_empleado' => $data_empleado, 'tipo_permisos' => $data_tipo_permiso]);
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

        return redirect()->route('permiso.view', $p->correlativo);

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

    public function view($permiso)
    {
        //$tipo_permiso = array("personal"=>15,"enf. personal"=>6,"familiar/duelo"=>18,"matrimonio"=>36);
        //dd($tipo_permiso);



        $permiso1 = Permiso::where('correlativo', $permiso)->first();

        $empleado = Empleado::where('codigo_empleado', $permiso1->cod_empleado)->first();

        $permiso1->fecha_solic = date('d-m-Y', strtotime($permiso1->fecha_solic));
        $permiso1->total_tiempo = $this->total_tiempo_solicitado($permiso1->total_tiempo);

        // Get data from "TIPO PERMISOS"
        $data_tipo_permiso = DB::TABLE('PLANTMP_C_TIPOSPERMISOS')->select('descripcion')->where('cod_permiso', $permiso1->cod_permiso)->get();

        return view('permiso.view', ['permiso' => $permiso1, 'empleado' => $empleado, 'tipo_permiso' => $data_tipo_permiso]);
    }

    public function imprimir($permiso)
    {

        $tipo_permiso = array("personal" => 15, "enf. personal" => 6, "familiar/duelo" => 36, "matrimonio" => 18);

        $permiso1 = Permiso::where('correlativo', $permiso)->first();
        $empleado = Empleado::where('codigo_empleado', $permiso1->cod_empleado)->first();
        $permiso1->fecha_solic = date('d-m-Y', strtotime($permiso1->fecha_solic));
        $permiso1->total_tiempo = $this->total_tiempo_solicitado($permiso1->total_tiempo);

        //$pdf = Pdf::loadView('permiso.imprimir');
        // return $pdf->download('test.pdf');



        $pdf = Pdf::loadView('permiso.imprimir', ['permiso' => $permiso1, 'empleado' => $empleado, "t_permiso" => $tipo_permiso]);
        $pdf->render();
        return $pdf->stream();
        //return view('permiso.imprimir' , ['permiso' => $permiso1, 'empleado' => $empleado, "t_permiso" => $tipo_permiso]);
    }

    // Metodos

    public function tipo_permiso($cod_permiso)
    {
        

        switch ($cod_permiso) {
            case 6:
                $tipo = "enf. personal";
                break;
            case 15:
                $tipo = "personal";
                break;
            case 18:
                $tipo = "matrimonio";
                break;
            case 36:
                $tipo = "familiar/duelo";
                break;

        }

        return $tipo;
    }

    public function total_tiempo_solicitado($t_tiempo)
    {
        $ent = floor($t_tiempo);
        $dec = fmod($t_tiempo, 1);

        $total = $ent != 0 ? $ent . ' H. con ' . round(($dec * 60), 0) . ' min.' : round(($dec * 60), 0) . ' min.';

        return $total;


    }


    public function total_horas_minutos($f_inicial, $f_final, $h_inicial, $h_final)
    {
        //$t_horas_minutos;
        $h_laborales = 8;
        // 1. Verificar si fechas pertenecen al mismo dia e horas son iguales al total de horal laborales para un dia.
        if ($f_inicial->equalTo($f_final) && ($h_inicial->floatDiffInHours($h_final) <= $h_laborales)) {

            $t_horas_minutos = $h_inicial->floatDiffInHours($h_final);
        } else {

            $t_horas_minutos = (($f_inicial->diffInDays($f_final) + 1) * $h_laborales);
        }



        return $t_horas_minutos;
    }

}
