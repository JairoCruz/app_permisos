<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasMany;

class Cargo extends Model {

    protected $table = 'CARGOS';

    public function empleados(): HasMany {
        return $this->HasMany(Empleado::class, 'CARGOS_ID');
    }

}