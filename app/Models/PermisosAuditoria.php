<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PermisosAuditoria extends Model {

    use HasUuids;

    protected $table = 'permisos_auditoria';

    protected $fillable = [
        'id_permiso',
        'id_empleado',
        'estatus',
        'fecha'
    ];

    public $timestamps = false;

    

}