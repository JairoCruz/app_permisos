<x-app-layout>
    <x-slot name="header">
        <h2 class="text-secondary-emphasis">
            {{ __('Tablero principal') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="row g-2">
            <div class="col">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Nuevo permiso</h5>
                                        <p class="card-text"><small>Registre un permiso personal</small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="align-self-center">
                                        <button type="button" class="btn btn-outline-primary"><i
                                                class="bi bi-file-earmark-plus" style="font-size: 2rem;"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Permiso (compañero)</h5>
                                        <p class="card-text"><small>Registre un permiso para un compañero</small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="align-self-center">
                                        <button type="button" class="btn btn-outline-secondary"><i
                                                class="bi bi-file-earmark-plus" style="font-size: 2rem;"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Mis permisos</h5>
                                <p class="card-text"><small>Historial de permisos solicitados</small></p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <div class="align-self-center">
                                <a href="{{ route('permiso.index') }}" class="btn btn-outline-primary"><i
                                        class="bi bi-card-list" style="font-size: 2rem;"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Disponibilidad</h5>
                                <p class="card-text"><small>Verificar disponibilidad de permisos</small></p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <div class="align-self-center">
                                <button type="button" class="btn btn-outline-primary"><i
                                        class="bi bi-calendar2-check" style="font-size: 2rem;"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="mostra()">
    Launch demo modal
  </button>

        <x-model_register />

        {{--  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

        </div> --}}
    </div>
</x-app-layout>
