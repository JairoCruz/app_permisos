<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipo_Permiso extends Model {

    protected $table = 'TIPOS_PERMISOS';

    public function empleados(): HasMany {
        return $this->hasMany(Empleado::class);
    }

    public function permisos(): HasMany 
    {
        return $this->hasMany(Permiso::class, 'TP_FK');
    }
    
}