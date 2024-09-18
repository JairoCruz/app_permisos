<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir pagina</title>
    <style>
        .tg {
            border-spacing: 6px;
            width: 100%;
            table-layout: fixed;
            text-transform: uppercase;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 0.5px;
            font-family: Arial, sans-serif;
            font-size: 11px;
            overflow: hidden;
            padding: 5px 5px;
            word-break: normal;
        }

        /* .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;} */
        .tg .tg-0lax {
            text-align: left;
            vertical-align: top
        }

        .twb {
            border-width: 0px !important;
        }

        .text-main {
            text-align: center;
            font-weight: bold;
            padding-top: 20px;
            
        }

        .text-title {
            font-size: 8px !important;
            text-align: left;
            margin-right: 2px;
        }

        .text-data {
            font-size: 8px !important;
            text-align: left;
            margin-left: 15px;
            font-weight: bold;
        }

        .text-header-1 {
            font-size: 8px !important;
            text-align: center;
            font-weight: bold;
        }

        .text-block-1 {
            padding-top: 10px;
            padding-bottom: 0px !important;
        }

        .bts {
            padding-right: 0px;
            padding-left: 0px;
        }

        .cborder {
            border-top-style: none !important;
            border-right-style: none !important;
            border-bottom-style: solid !important;
            border-left-style: none !important;
        }
        .tfoot {
            margin-top: 10px;
        }

        .tfoot-firma {
            border-top-style: solid;
            border-right-style: none;
            border-bottom-style: none;
            border-left-style: none;
            border-width: 1px;
            font-size: 8px !important;
            text-align: center;
            margin-top: 20px;
            padding-top: 5px;
        }

        img {
            display: block;
            
        }
    </style>
</head>

<body>

    <table class="tg">
        <tbody>

            <tr>
                <td class="tg-0lax twb" colspan="2"><img src="{{ public_path('/images/escudo_elsalvador.jpg') }}" width="75" height="75" alt=""></td>
                <td class="tg-0lax twb" colspan="12">
                    <div class="text-main">TRIBUNAL SUPREMO ELECTORAL <br> DIRECCION DE TALENTO HUMANO INSTITUCIONAL <br>
                        SOLICITUD DE PERMISO</div>
                </td>
                <td class="tg-0lax twb" colspan="2"><img src="{{ public_path('/images/tse_logo_2.jpg') }}" width="75" height="75" alt=""></td>
            </tr>


            <tr>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-title">LUGAR Y FECHA</div>
                </td>
                <td class="tg-0lax" colspan="14">
                    <div class="text-data">{{ $permiso->fecha_solic }}</div>
                </td>

            </tr>
            <tr>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-title">
                        SOLICITANTE
                    </div>
                </td>
                <td class="tg-0lax" colspan="14">
                    <div class="text-data">
                        {{ $empleado->empleado }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-title">
                        UNIDAD
                    </div>
                </td>
                <td class="tg-0lax" colspan="14">
                    <div class="text-data">
                        {{ $empleado->unidad }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-title">
                        N° PLAZA
                    </div>
                </td>
                <td class="tg-0lax" colspan="2">
                    <div class="text-data">
                        {{ $empleado->num_plaza }}
                    </div>
                </td>
                <td class="tg-0lax twb" colspan="2"></td>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-title">
                        CARGO
                    </div>
                </td>
                <td class="tg-0lax" colspan="8">
                    <div class="text-data">
                        {{ $empleado->cargo }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tg-0lax twb" colspan="2"></td>
                <td class="tg-0lax twb" colspan="3">
                    <div class="text-header-1 text-block-1">goce de sueldo</div>
                </td>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-header-1 text-block-1">constancia</div>
                </td>
                <td class="tg-0lax twb" colspan="4">
                    <div class="text-header-1 text-block-1">periodo</div>
                </td>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-header-1 text-block-1">hora</div>
                </td>
                <td class="tg-0lax twb" colspan="3">
                    <div class="text-header-1 text-block-1">total</div>
                </td>
            </tr>

            <tr>
                <td class="tg-0lax twb" colspan="2"></td>
                <td class="tg-0lax twb">
                    <div class="text-header-1">tipo</div>
                </td>
                <td class="tg-0lax twb">
                    <div class="text-header-1">si</div>
                </td>
                <td class="tg-0lax twb">
                    <div class="text-header-1">no</div>
                </td>
                <td class="tg-0lax twb">
                    <div class="text-header-1">si</div>
                </td>
                <td class="tg-0lax twb">
                    <div class="text-header-1">no</div>
                </td>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-header-1">del</div>
                </td>
                <td class="tg-0lax twb" colspan="2">
                    <div class="text-header-1">al</div>
                </td>
                <td class="tg-0lax twb" colspan="1">
                    <div class="text-header-1">de</div>
                </td>
                <td class="tg-0lax twb" colspan="1">
                    <div class="text-header-1">a</div>
                </td>
                <td class="tg-0lax twb" colspan="3">
                    <div class="text-header-1">tiempo solicitado</div>
                </td>
            </tr>

            @foreach ($t_permiso as $tp => $tp1)
                <!-- Personal -->
                <tr>
                    <td class="tg-0lax twb" colspan="2">
                        <div class="text-title">{{ $tp }}</div>
                    </td>
                    <!-- tipo -->
                    <td class="tg-0lax" colspan="1">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1)
                                x
                            @endif
                        </div>
                    </td>
                    <!-- sueldo_si -->
                    <td class="tg-0lax" colspan="1">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1 && $permiso->goce_sueldo == 'V')
                                x
                            @endif
                        </div>
                    </td>
                    <!-- sueldo_no -->
                    <td class="tg-0lax" colspan="1">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1 && $permiso->goce_sueldo == 'F')
                                x
                            @endif
                        </div>
                    </td>
                    <!-- constancia_si -->
                    <td class="tg-0lax" colspan="1">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1 && $permiso->constancia == 'V')
                                x
                            @endif
                        </div>
                    </td>
                    <!-- constancia_no -->
                    <td class="tg-0lax" colspan="1">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1 && $permiso->constancia == 'F')
                                x
                            @endif
                        </div>
                    </td>
                    <!-- fecha_inicial -->
                    <td class="tg-0lax" colspan="2">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1)
                                {{ date('d-m-Y', strtotime($permiso->fecha_inicial)) }}
                            @endif
                        </div>
                    </td>
                    <!-- fecha_final -->
                    <td class="tg-0lax" colspan="2">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1)
                                {{ date('d-m-Y', strtotime($permiso->fecha_final)) }}
                            @endif
                        </div>
                    </td>
                    <!-- horas -->
                    <td class="tg-0lax" colspan="1">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1)
                                {{ $permiso->hora_inicial }}
                            @endif
                        </div>
                    </td>
                    <td class="tg-0lax" colspan="1">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1)
                                {{ $permiso->hora_final }}
                            @endif
                        </div>
                    </td>
                    <!-- total_horas -->
                    <td class="tg-0lax" colspan="3">
                        <div class="text-header-1">
                            @if ($permiso->cod_permiso == $tp1)
                                {{ $permiso->total_tiempo }}
                            @endif
                        </div>
                    </td>


                </tr>
            @endforeach






            <tr>
                <td class="tg-0lax twb" colspan="16">
                    <div class="text-title tfoot">Motivo que justifica el permiso</div>
                </td>


            </tr>
            <tr>
                <td class="tg-0lax cborder" colspan="16">
                    <div class="text-data">
                        {{ $permiso->motivo }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tg-0lax cborder" colspan="16">
                    <div class="text-data"></div>
                </td>
            </tr>

            <tr>
                <td class="tg-0lax twb" colspan="6">
                <div class="tfoot-firma">firma solicitante</div>
                </td>
                <td class="tg-0lax twb" colspan="4">
                </td>
                <td class="tg-0lax twb" colspan="6">
                <div class="tfoot-firma">firma jefe inmediato</div>
                </td>
            </tr>

        </tbody>
    </table>

</body>

</html>
