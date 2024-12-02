<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empleado extends Model {

    protected $table = 'EMPLEADOS';

    public function tipos_permisos(): BelongsTo {
        return $this->belongsTo(Tipo_Permiso::class);
    }

    public function unidad(): BelongsTo 
    {
        return $this->belongsTo(Unidad::class, 'unidades_id');
    }

    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class, 'cargos_id');
    }
    
}