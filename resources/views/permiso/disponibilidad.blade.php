<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex flex-row">
            <div class="w-full content-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Disponibilidad de permisos en horas') }}
                </h2>
            </div>

        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="flex flex-col mx-2 text-center md:mx-0  md:flex-row md:justify-end pb-4">
                <div class="bg-blue-900 text-gray-100 font-semibold text-sm px-2 py-2 rounded-lg">
                    Periodo: {{ $periodo->ano ?? now()->format('Y') }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-xs font-medium text-gray-700">
                    <div class="w-full">

                        <div class="flex  font-semibold uppercase flex-row">
                            <div class="w-1/4">
                                <div class="w-full flex place-content-center  py-2 px-1">
                                    <div class="w-24 text-right">
                                        permiso
                                    </div>

                                </div>

                            </div>
                            <div class="w-1/4">
                                <div class="w-full flex place-content-center py-2 px-1">
                                    <div class="w-24 text-right">
                                        total/horas
                                    </div>

                                </div>
                            </div>
                            <div class="w-1/4">
                                <div class="w-full flex place-content-center py-2 px-1">
                                    <div class="w-24 text-right">
                                        utilizados
                                    </div>

                                </div>

                            </div>
                            <div class="w-1/4">
                                <div class="w-full flex place-content-center py-2 px-1">
                                    <div class="w-24 text-right">
                                        disponibles
                                    </div>

                                </div>
                            </div>
                        </div>
                        @foreach($datos as $permiso)

                            <div class="flex flex-row">
                                <div class="w-1/4 border-b">
                                    <div class="py-2 px-1">
                                        @if(isset($permiso->descripcion))
                                            {{ $permiso->descripcion }}
                                        @endif

                                    </div>
                                </div>
                                <div class="w-1/4 border-b">
                                    <div class="w-full flex place-content-center py-2 px-1">
                                        <div class="w-24 text-right">
                                            @if(isset($permiso->valor))
                                                {{ $permiso->valor }}
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="w-1/4 border-b">
                                    <div class="w-full flex place-content-center py-2 px-1">
                                        <div class="w-24 text-right">
                                            @if(isset($permiso->total))
                                                {{ $permiso->total }}
                                            @else
                                                0:00
                                            @endif
                                        </div>

                                    </div>

                                </div>
                                <div class="w-1/4 border-b">
                                    <div class="w-full flex place-content-center py-2 px-1">
                                        <div class="w-24 text-right">
                                            @if(isset($permiso->disponibles))
                                                {{ $permiso->disponibles }}
                                            @else
                                                {{ $permiso->valor }}
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>