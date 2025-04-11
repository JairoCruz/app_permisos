<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Events\PermisoAuditoria;
use App\Events\PermisoAuditoriaEvent;
use App\Models\PermisosAuditoria;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendPermisoAuditoriaNotificacion
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PermisoAuditoriaEvent $event): void
    {
        //
        //error_log($event->model->id);
        $au = PermisosAuditoria::create(['id_permiso' =>  $event->model->id, 'id_empleado' => Auth::user()->cod_empleado, 'estatus' => $event->model->estado, 'fecha' => Carbon::now() ]);
        error_log($au->id);
    }
}
