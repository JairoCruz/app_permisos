<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidad extends Model {

    protected $table = 'UNIDADES';

    public function empleados(): HasMany {
        return $this->HasMany(Empleado::class, 'UNIDADES_ID');
    }
    
}