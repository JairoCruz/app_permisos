<?php

namespace App\Utils;

class TipoPermisos {

    public static function tipo_permiso($cod_permiso)
    {
        

       return $tipo_permiso_descripcion = match($cod_permiso) 
        {
           '6'=> "enfermedad personal",
            '15'=> "personal",
            '18'=> "matrimonio",
            '36'=> "familiar/duelo",
            '16'=> "personal sin goce de sueldo",
            '8'=> "alumbramiento",
            '23'=> "paternidad"
        };

       /*  switch ($cod_permiso) {
            case 6:
                $tipo = "enfermedad personal";
                break;
            case 15:
                $tipo = "personal";
                break;
            case 18:
                $tipo = "matrimonio";
                break;
            case 36:
                $tipo = "familiar/duelo";
                break;
            case 16:
                $tipo = "personal sin goce sueldo";
                break;

        }

        return $tipo; */
    }

}