<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model {

    protected $table = 'PLANTMP_PERMISOS_EN_LINEA';
    public $sequencia = 'SEQ_CORRELATIVO';
    protected $primaryKey = 'correlativo';

    public $timestamps = false;

}