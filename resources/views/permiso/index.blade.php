<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex flex-row">
            <div class="w-1/2 content-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Permisos') }}
                </h2>
            </div>
            <div class="w-1/2 flex justify-end">

                <a href="{{ route('permiso.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Crear permiso
                </a>


            </div>
        </div>
    </x-slot>

    <div class="py-4">
                    @if (count($permisos) != 0)
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
        
                    <div class="m-4">
                        <table
                            class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Correlativo</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Fecha solicitud</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Tipo</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Fecha de inicio</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Hora de inicio</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Fecha de fin</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Hora de fin</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Tiempo solicitado</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Estado</div></th>
                                </tr>
                            </thead>

                            <tbody class="text-sm divide-y divide-gray-100">

                                @foreach ($permisos as $permiso)
                                    <tr>
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
                                Aun no tienes permisos registrados, para registrar haz click <a class="underline  text-gray-600 hover:text-gray-900 rounded-md focus:outline-none" href="{{ route('permiso.create') }}">aqui</a>
                            </span>
                            
                        </div>
                    @endif
                    
        
    </div>
</x-app-layout>
