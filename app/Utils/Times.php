<?php

namespace App\Utils;

use Carbon\Carbon;

class Times {
    public static function total_tiempo_solicitado($t_tiempo, $tipo)
    {
        $hora = floor($t_tiempo);
        $minuto = fmod($t_tiempo, 1);

        return $total = match ($tipo) {
            0=> $hora != 0 ? $hora . ' H. con ' . round(($minuto * 60), 0) . ' min.' : round(($minuto * 60), 0) . ' min.',
            1=> $hora . ":" . Carbon::createFromTime(0, intval(round($minuto * 60, 0)))->format('i'),
        };

        /* switch ($tipo) {
            case 0:
                $total = $hora != 0 ? $hora . ' H. con ' . round(($minuto * 60), 0) . ' min.' : round(($minuto * 60), 0) . ' min.';
                break;
            case 1:
                $total = $hora . ":" . Carbon::createFromTime(0, intval(round($minuto * 60, 0)))->format('i');
                break;

        } */

       // return $total;
    }




    public static function total_horas_minutos($f_inicial, $f_final, $h_inicial, $h_final)
    {
        //$t_horas_minutos;
        $h_laborales = 8;

        // 1. Verificar si fechas pertenecen al mismo dia e horas son iguales al total de horal laborales para un dia.
        return $t_horas_minutos = $f_inicial->equalTo($f_final) && ($h_inicial->floatDiffInHours($h_final) <= $h_laborales) ? $h_inicial->floatDiffInHours($h_final) : (($f_inicial->diffInDays($f_final) + 1) * $h_laborales);
        
        /* if ($f_inicial->equalTo($f_final) && ($h_inicial->floatDiffInHours($h_final) <= $h_laborales)) {

            $t_horas_minutos = $h_inicial->floatDiffInHours($h_final);
        } else {

            $t_horas_minutos = (($f_inicial->diffInDays($f_final) + 1) * $h_laborales);
        }

        return $t_horas_minutos; */
    }
}