<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tablero principal') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-1 md:gap-4">
                <div class="w-full px-4 md:px-0 md:w-1/3">
                    <div class="group bg-white overflow-hidden shadow rounded-lg sm:shadow-sm sm:rounded-lg">
                        <a href="{{ route('permiso.index') }}">
                            <div class="p-6 text-base font-bold text-gray-600 hover:bg-zinc-400">
                                <p class="group-hover:text-white">Listar permisos</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="w-full px-4 md:px-0 md:w-1/3">
                    <div class="flex flex-col gap-1 md:gap-2">

                        <div class="group bg-white overflow-hidden shadow rounded-lg sm:shadow-sm sm:rounded-lg">


                            <a href="{{ route('permiso.create') }}">
                                <div class="p-6 text-base font-bold text-gray-600 hover:bg-zinc-400">
                                    <p class="group-hover:text-white">
                                        Registrar permiso (propio)
                                    </p>
                                </div>
                            </a>


                        </div>
                        <div class="group bg-white overflow-hidden shadow rounded-lg sm:shadow-sm sm:rounded-lg">
                            <a href="{{ route('permiso.permiso_comp') }}">
                                <div class="p-6 text-base font-bold text-gray-600 hover:bg-zinc-400">
                                    <p class="group-hover:text-white">
                                        Registrar permiso (compañero)
                                    </p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="w-full px-4 md:px-0 md:w-1/3">
                    <div class="group bg-white overflow-hidden shadow rounded-lg sm:shadow-sm sm:rounded-lg">
                        <a href="{{ route('permiso.disponibilidad') }}">
                            <div class="p-6 text-base font-bold text-gray-600 hover:bg-zinc-400">
                                <p class="group-hover:text-white">
                                    Disponibilidad de permisos
                                </p>
                            </div>
                        </a>


                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>