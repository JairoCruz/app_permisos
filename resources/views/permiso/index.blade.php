<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex flex-row">
            <div class="w-1/2 content-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Permisos') }}
                </h2>
            </div>
            <div class="w-1/2 flex justify-end">
                <!-- 
                <a href="{{ route('permiso.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Crear permiso
                </a>
                 -->

            </div>
        </div>
    </x-slot>

    <div class="py-4">
        @if ($i_permisos != 0)

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <div class="bg-white overflow-hidden-shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-600 font-semibold mb-2">Opciones de busqueda</span>
                            <form action="{{ route('permiso.index') }}" method="GET">
                                <div class="flex flex-row mt-2">
                                    <div class="w-1/4 ">
                                        <div class="w-full px-3 mb-2">
                                            <label class="block font-medium text-xs text-gray-700" for="fecha_solicitud">
                                                Fecha de solicitud
                                            </label>
                                            <input
                                                class="w-full border-gray-300 mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                                id="fecha_solicitud" type="date" name="fecha_solicitud" value="{{ old('fecha_solicitud') }}">
                                        </div>
                                    </div>
                                    <div class="w-1/4 ">

                                        <div class="w-full px-3 mb-2">
                                            <label class="block font-medium text-xs text-gray-700" for="tipo_permiso">
                                                Tipo de permiso
                                            </label>
                                            <div class="relative">
                                                <select
                                                    class="w-full border-gray-300 mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                                    id="tipo_permiso" name="tipo_permiso">
                                                    <option selected value hidden>seleccione una opcion</option>
                                                    @foreach ($t_permisos as $tp => $tp1)
                                                        <option value="{{ $tp }}" {{ old('tipo_permiso') == $tp ? 'selected' : ''}}>
                                                            {{ $tp }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-1/4">
                                    <div class="w-full px-3 mb-2">
                                            <label class="block font-medium text-xs text-gray-700" for="fecha_solicitud">
                                                Estado
                                            </label>
                                            <div class="relative">
                                                <select
                                                    class="w-full border-gray-300 mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                                    id="grid-tipo-permiso" name="estado_permiso">
                                                    <option selected value hidden>seleccione una opcion</option>
                                                    @foreach ($e_permisos as $tp => $tp1)
                                                        <option value="{{ $tp1 }}" {{ old('e_permiso') == $tp1 ? 'selected' : ''}}>
                                                            {{ $tp }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-1/4 place-content-center">
                                        <div class="flex  flex-row gap-2 pt-4">
                                            <div class="w-1/2 text-end">
                                                <button
                                                    class="w-24 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-700 rounded">
                                                    Buscar
                                                </button>
                                            </div>
                                            <div class="w-1/2 text-start">
                                                <a href="{{ route('permiso.index') }}"
                                                    class="w-24 h-full inline-block content-center text-center  border text-gray-500 hover:text-gray-800 text-sm py-1 px-2 rounded">
                                                    Limpiar
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            
                        </div>

                    </div>

                </div>

            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="m-4">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-500 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Correlativo</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Fecha solicitud</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Tipo</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Fecha de inicio</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Hora de inicio</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Fecha de fin</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Hora de fin</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Tiempo solicitado</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Estado</div>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="text-sm divide-y divide-gray-100">

                                    @if (!empty($permisos->items()))

                                    @foreach ($permisos as $permiso)
                                        <tr class="hover:bg-gray-100">
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    <a href="{{ route('permiso.view', $permiso['correlativo']) }}">
                                                        {{ $permiso['correlativo'] }}
                                                    </a>
                                                </div>


                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ date('d-m-Y', strtotime($permiso['fecha_solic'])) }}

                                                </div>

                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ $permiso['cod_permiso'] }}

                                                </div>

                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ date('d-m-Y', strtotime($permiso['fecha_inicial'])) }}

                                                </div>

                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ $permiso['hora_inicial'] }}

                                                </div>

                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ date('d-m-Y', strtotime($permiso['fecha_final'])) }}

                                                </div>

                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ $permiso['hora_final'] }}

                                                </div>

                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ $permiso['total_tiempo'] }}

                                                </div>

                                            </td>

                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ $permiso['estado'] }}

                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                    @else
                                        <tr>
                                            <td class="text-center p-2 whitespace-nowrap" colspan="9">
                                                <div class="">No hay ninguna coicidencia para su busqueda</div>
                                                
                                            </td>
                                        </tr>
                                    @endif

                                    

                                </tbody>

                            </table>
                            <div class="w-full pt-6">
                                {{ $permisos->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex w-96 place-content-center mx-auto mt-10">
                <span class="text-gray-600 text-center text-base">
                    Aun no tienes permisos registrados. Para registrar haz click <a
                        class="underline  text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                        href="{{ route('permiso.create') }}">aqui</a>
                </span>

            </div>
        @endif


    </div>
</x-app-layout>