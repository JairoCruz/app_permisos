<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{

    protected $table = 'PLANTMP_PERMISOS_EN_LINEA';
    // public $sequencia = 'SEQ_CORRELATIVO';
    protected $primaryKey = 'correlativo';

    public $timestamps = false;

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
        $query->
            where('cod_empleado', $cod_empleado)->
            where('fecha_inicial', $fecha_inicio)->
            where('fecha_final', $fecha_fin)->
            where('hora_inicial', $hora_inicio)->
            where('hora_final', $hora_fin)->
            where('cod_permiso', $tipo_permiso)->
            where('goce_sueldo', $goce_sueldo)->
            where('constancia', $constancia);
    }

}