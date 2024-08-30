<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permisos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                

                <a href="{{ route('permiso.create') }}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-3 px-6 rounded">
                    Crear permiso
                </a>
                <div class="my-10">
                <table class="w-full text-center text-sm table-auto border-collapse border-spacing-y-2 border border-slate-500">
                    <thead>
                        <tr>
                            <th class="px-6 py-2 border border-slate-600">Correlativo</th>
                            <th class="px-6 py-2 border border-slate-600">Fecha solicitud</th>
                            <th class="px-6 py-2 border border-slate-600">Fecha de inicio</th>
                            <th class="px-6 py-2 border border-slate-600">Hora de inicio</th>
                            <th class="px-6 py-2 border border-slate-600">Fecha de fin</th>
                            <th class="px-6 py-2 border border-slate-600">Hora de fin</th>
                            <th class="px-6 py-2 border border-slate-600">Tiempo solicitado</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                            @foreach($permisos as $permiso)
                                <tr>
                                <td class="px-6 py-2 border border-slate-700">{{ $permiso['correlativo'] }}</td>
                                <td class="px-6 py-2 border border-slate-700">{{ date('Y-m-d', strtotime($permiso['fecha_solic'])) }}</td>
                                <td class="px-6 py-2 border border-slate-700">{{ date('Y-m-d', strtotime($permiso['fecha_inicial'])) }}</td>
                                <td class="px-6 py-2 border border-slate-700">{{ $permiso['hora_inicial'] }}</td>
                                <td class="px-6 py-2 border border-slate-700">{{ date('Y-m-d', strtotime($permiso['fecha_final'])) }}</td>
                                <td class="px-6 py-2 border border-slate-700">{{ $permiso['hora_final'] }}</td>
                                <td class="px-6 py-2 border border-slate-700">{{ $permiso['total_tiempo'] }}</td>
                                </tr>
                                
                            @endforeach
                        
                    </tbody>

                </table>

                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>