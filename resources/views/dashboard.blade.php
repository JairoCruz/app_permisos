<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row gap-4">
                <div class="w-1/3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="">
                                <a href="{{ route('permiso.index') }}">Listar permisos</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-1/3">
                    <div class="flex flex-col gap-2">

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="">
                                <a href="{{ route('permiso.create') }}">Registrar permiso (propio)</a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="">
                                <a href="">Registrar permiso (compañero)</a>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
                <div class="w-1/3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                        <div class="">
                                <a href="{{ route('permiso.disponibilidad') }}">Disponibilidad de permisos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>