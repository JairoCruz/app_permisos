<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasMany;


class EstadoPermiso extends Model 
{
    protected $table = 'ESTADO_PERMISO';

    public function permisos(): HasMany 
    {
        return $this->HasMany(Permiso::class, 'estado');
    }
}