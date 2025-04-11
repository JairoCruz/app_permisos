<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permiso extends Model
{

    protected $fillable = [
        'fecha_solicitud',
        'goce_sueldo',
        'constancia',
        'fecha_inicial',
        'fecha_final',
        'hora_inicial',
        'hora_final',
        'motivo',
        'ano',
        'mes',
        'total_tiempo',
        'tp_fk',
        'emp_fk',
        'codigo_empleado_registra',
        'jefe_unidad_id',
        'codigo_empleado',
        'numero_plaza'
    ];

    use HasUuids;

    public static $validated = [
        'fechaSolicitud' => 'required',
        'tipoPermiso' => 'required',
        'goceSueldo' => 'required',
        'constancia' => 'required',
        'fechaInicio' => 'required',
        'fechaFin' => 'required',
        'horaInicio' => 'required',
        'horaFin' => 'required',
        'motivo' => 'required|max:255'
    ];

    protected $table = 'PERMISOS_EN_LINEA';
    // public $sequencia = 'SEQ_CORRELATIVO';
    // protected $primaryKey = 'correlativo';

    public $timestamps = false;

    public function tipo_permiso(): BelongsTo
    {
        return $this->belongsTo(Tipo_permiso::class, 'tp_fk');
    }

    public function estado_permiso(): BelongsTo
    {
        return $this->belongsTo(EstadoPermiso::class, 'estado');
    }

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'emp_fk', 'id');
    }

    public function scopeVerificar(
        Builder $query,
        string $cod_empleado,
        string $fecha_inicio,
        string $fecha_fin,
        string $hora_inicio,
        string $hora_fin,
        string $tipo_permiso,
        string $goce_sueldo,
        string $constancia
    ): void {
        $query->where('codigo_empleado', $cod_empleado)->where('fecha_inicial', $fecha_inicio)->where('fecha_final', $fecha_fin)->where('hora_inicial', $hora_inicio)->where('hora_final', $hora_fin)->where('tp_fk', $tipo_permiso)->where('goce_sueldo', $goce_sueldo)->where('constancia', $constancia);
    }

    protected $dispatchesEvents = [
        'updating' => \App\Events\PermisoAuditoriaEvent::class,
    ];

}
