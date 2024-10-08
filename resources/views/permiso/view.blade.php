<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar permiso') }}
        </h2>
    </x-slot>

    <div class="py-2">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($permiso['estado'] != $estado_permiso['aprobado'])
            <div class="w-full items-center flex flex-row h-8 mb-2 pl-4 content-center text-white text-xs bg-blue-600 border border-blue-800 shadow-sm sm:rounded-lg">
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>
                <span class="ml-2">Por favor antes de imprimir el permiso verifica que los datos esten correctos.</span>
            </div>
            @endif
                
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full">
                        <!-- 
                         row logo
                        <div class="flex flex-row text-center">
                            <div class="w-1/4">
                                 imagen logo 
                            </div>
                            <div class="grow w-2/4 font-semibold break-words">
                                <p class="leading-normal text-sm uppercase">
                                    <span class="block">tribunal supremo electoral</span>
                                    <span class="block">direccion de talento humano institucional</span>
                                    <span class="block">solicitud de permiso</span>
                                </p>
                            </div>
                            <div class="w-1/4">
                                 imagen logo 
                            </div>
                        </div>

                         -->

                        <!-- row data 1 -->

                        <div class="flex flex-row text-center my-2">
                            <div class="w-1/6 text-start text-xs text-gray-700 uppercase pl-6 pt-2 pb-1">lugar y fecha
                            </div>
                            <div class="w-5/6 border border-gray-300 text-start pl-6 pt-1 pb-1 rounded">
                                {{ $permiso['fecha_solic'] }}
                            </div>
                        </div>

                        <!-- row data 2 -->
                        <div class="flex flex-row text-center text-sm my-2">
                            <div class="w-1/6 text-start text-xs text-gray-700 uppercase pl-6 pt-2 pb-1">solicitante
                            </div>
                            <div class="w-5/6 border border-gray-300 text-start pl-6 pt-1 pb-1 rounded">
                                {{ $empleado->empleado }}
                            </div>
                        </div>

                        <!-- row data 3 -->
                        <div class="flex flex-row text-center text-sm my-2">
                            <div class="w-1/6 text-start text-xs text-gray-700 uppercase pl-6 pt-2 pb-1">unidad</div>
                            <div class="w-5/6 border border-gray-300 text-start pl-6 pt-1 pb-1 rounded">
                                {{ $empleado->unidad }}
                            </div>
                        </div>

                        <!-- row group 1 -->
                        <div class="flex flex-row text-center text-sm my-2">

                            <div class="flex w-1/2">
                                <div class="w-1/3 text-start text-xs text-gray-700 uppercase pl-6 pt-2 pb-1">
                                    n°. de plaza
                                </div>
                                <div class="w-2/3">
                                    <div class="w-24 border border-gray-300 text-center pt-1 pb-1 rounded">
                                        {{ $permiso->num_plaza }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex w-1/2">
                                <div class="w-1/6  text-start text-xs text-gray-700 uppercase pl-2 pt-2 pb-1">
                                    cargo
                                </div>
                                <div class="w-5/6 border border-gray-300 text-start pl-6 pt-1 pb-1 rounded">
                                    {{ $empleado->cargo }}
                                </div>
                            </div>

                        </div>

                        <!-- header tiempo solicitado -->

                        <div class="flex flex-row text-center text-sm pt-6">
                            <div class="w-1/6 text-start uppercase font-semibold text-gray-800 text-xs pl-6 pt-0 pb-1">
                                Tipo de permiso</div>
                            <div class="flex w-5/6">
                                <!-- row group inner 1 -->
                                <div class="flex mr-4">
                                    <div class="flex flex-col text-xs text-gray-700 uppercase">
                                        <div class="mb-2 text-gray-800 font-semibold">goce de sueldo</div>
                                        <div class="flex flex-row">

                                            <div class="w-12  border-black   mr-3">
                                                tipo
                                            </div>

                                            <div class="w-12  border-black   mr-3">
                                                si
                                            </div>

                                            <div class="w-12  border-black   mr-3">
                                                no
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- row group inner 2 -->
                                <div class="flex mr-4">
                                    <div class="flex flex-col text-xs text-gray-700 uppercase">
                                        <div class="mb-2 text-gray-800 font-semibold">
                                            constancia
                                        </div>
                                        <div class="flex flex-row">
                                            <div class="w-12  border-black mr-3">
                                                si
                                            </div>

                                            <div class="w-12  border-black mr-2">
                                                no
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="flex flex-col text-xs text-gray-700">



                                    <div class="flex flex-row">
                                        <div class="w-full mb-2 text-gray-800 font-semibold uppercase">
                                            periodo
                                        </div>

                                    </div>

                                    <div class="flex flex-row">
                                        <!-- row group inner 3 -->
                                        <div class="flex mr-4">
                                            <div class="w-36  border-black uppercase">
                                                del
                                            </div>


                                        </div>

                                        <!-- row group inner 4 -->
                                        <div class="flex mr-4 uppercase">
                                            <div class="w-36  border-black">
                                                al
                                            </div>


                                        </div>
                                    </div>

                                </div>



                                <!-- row group inner 5 -->
                                <div class="flex">
                                    <div class="flex flex-col text-xs text-gray-700 uppercase">
                                        <div class="mb-2 text-gray-800 font-semibold">
                                            hora
                                        </div>
                                        <div class="flex flex-row">
                                            <div class="w-14  mr-2">
                                                de
                                            </div>

                                            <div class="w-14 mr-2">
                                                a
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <!-- row group inner 6 -->
                                <div class="flex">
                                    <div class="flex flex-col text-xs text-gray-800 uppercase">
                                        <div class="mb-2 font-semibold">total</div>
                                        <div class="flex flex-row">
                                            <div class="w-36 text-gray-700 border-black mr-1">
                                                tiempo solicitado
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <!-- row group 2 -->
                        <!-- @foreach ($tipo_permiso as $tp => $tp1)
-->
                        <div class="flex flex-row text-center  uppercase text-sm">
                            <div class="w-1/6 text-start text-gray-700 text-xs pl-6 pt-1 pb-1">
                                @if ($tipo_permiso[0]->cod_permiso != 16)
                                    {{ $tipo_permiso[0]->descripcion }}
                                @else
                                    {{ substr($tipo_permiso[0]->descripcion, 0, 10) }}
                                @endif

                            </div>
                            <div class="flex w-5/6">

                                <!-- row group inner 1 -->
                                <div class="flex mr-4">
                                    <div class="w-12 border border-gray-300 rounded pt-1 pb-1 mr-3">
                                        x
                                    </div>

                                    <div class="w-12 border border-gray-300 rounded pt-1 pb-1 mr-3">
                                        @if ($permiso->goce_sueldo == 'V')
                                            x
                                        @endif
                                    </div>

                                    <div class="w-12 border border-gray-300 rounded pt-1 pb-1 mr-3">
                                        @if ($permiso->goce_sueldo == 'F')
                                            x
                                        @endif
                                    </div>
                                </div>

                                <!-- row group inner 2 -->
                                <div class="flex mr-4">
                                    <div class="w-12 border border-gray-300 rounded pt-1 pb-1 mr-3">
                                        @if ($permiso->constancia == 'V')
                                            x
                                        @endif
                                    </div>

                                    <div class="w-12 border border-gray-300 rounded pt-1 pb-1 mr-2">
                                        @if ($permiso->constancia == 'F')
                                            x
                                        @endif
                                    </div>

                                </div>

                                <!-- row group inner 3 -->
                                <div class="flex mr-4">
                                    <div class="w-12 border border-gray-300 rounded-l pt-1 pb-1">
                                        {{ date('d', strtotime($permiso->fecha_inicial)) }}
                                    </div>

                                    <div class="w-12 border border-gray-300 border-x-0 pt-1 pb-1">
                                        {{ date('m', strtotime($permiso->fecha_inicial)) }}
                                    </div>

                                    <div class="w-12 border border-gray-300 rounded-r pt-1 pb-1">
                                        {{ date('Y', strtotime($permiso->fecha_inicial)) }}
                                    </div>
                                </div>

                                <!-- row group inner 4 -->
                                <div class="flex mr-4">
                                    <div class="w-12 border border-gray-300 rounded-l pt-1 pb-1">
                                        {{ date('d', strtotime($permiso->fecha_final)) }}
                                    </div>

                                    <div class="w-12 border border-gray-300 border-x-0 pt-1 pb-1">
                                        {{ date('m', strtotime($permiso->fecha_final)) }}
                                    </div>

                                    <div class="w-12 border border-gray-300 rounded-r pt-1 pb-1">
                                        {{ date('Y', strtotime($permiso->fecha_final)) }}
                                    </div>
                                </div>

                                <!-- row group inner 5 -->
                                <div class="flex">
                                    <div class="w-14 border border-gray-300 rounded pt-1 pb-1 mr-2">
                                        {{ $permiso->hora_inicial }}
                                    </div>

                                    <div class="w-14 border border-gray-300 rounded pt-1 pb-1 mr-2">
                                        {{ $permiso->hora_final }}
                                    </div>

                                </div>

                                <!-- row group inner 6 -->
                                <div class="flex">
                                    <div class="w-36 border border-gray-300 rounded pt-1 pb-1 mr-1">
                                        {{ $permiso->total_tiempo }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--
@endforeach -->

                        <div class="flex flex-col text-center uppercase text-sm my-4">
                            <div class="w-full text-start text-xs text-gray-700 pl-6 pt-2 pb-1">motivo que justifica el
                                permiso</div>
                            <div class="w-full text-start pl-6 pt-2">
                                <div class="w-full border border-gray-300 rounded  pt-1 pb-1 pl-8">
                                    {{ $permiso['motivo'] }}
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="w-full flex flex-row mt-9">

                        <div class="w-1/2">
                            <div class="w-24 pl-6">
                                <a href="{{ route('permiso.index') }}"
                                    class="block h-10 content-center text-center border border-gray-400 bg-gray-200  text-gray-600 hover:text-gray-900 text-sm py-1 px-2 rounded">Salir</a>
                            </div>

                        </div>

                        <div class="flex justify-end w-1/2">
                            
                            @if($permiso['estado'] == $estado_permiso['aprobado'])
                            <div class="w-28 mr-6">
                                <a href="{{ route('permiso.edit', $permiso) }}"
                                    class="block h-10 content-center text-center border bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4  border border-blue-700 rounded">Modificar</a>
                            </div>
                            <div class="w-28">
                                <a href="{{ route('permiso.imprimir', $permiso->correlativo) }}"
                                    class="block h-10 content-center text-center border bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-800 rounded">Imprimir</a>
                            </div>
                            @endif

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>