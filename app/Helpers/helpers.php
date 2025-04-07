<?php

use App\Utils\Times;

if (!function_exists('totalTime')) {
    function totalTime($time)
    {
        return Times::total_tiempo_solicitado($time, 0);
    }
}
