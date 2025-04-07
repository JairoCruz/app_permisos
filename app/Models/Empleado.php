<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function _unidad(): BelongsToMany{
        return $this->belongsToMany(Unidad::class, 'jefes_unidad')->withPivot('id','autoriza_permiso');
    }

    public function permisos(): HasMany
    {
        return $this->hasMany(Permiso::class, 'emp_fk');
    }
    
}