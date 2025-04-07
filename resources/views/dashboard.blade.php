<x-app-layout>
    <x-slot name="header">
        <h2 class="text-secondary-emphasis">
            {{ __('Tablero principal') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="row">
            <div class="col-12 px-3 pb-2">
                <div class="fs-6 text-dark">Personal</div>
            </div>
        </div>
        <div class="row g-2">
            <div class="col">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Permiso (personal)</h5>
                                        <p class="card-text"><small>Registre un permiso personal</small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="align-self-center">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Registro de permiso (Personal)"><i
                                                class="bi bi-file-earmark-plus" style="font-size: 2rem;"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        {{-- <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Permiso (compañero)</h5>
                                        <p class="card-text"><small>Registre un permiso para un compañero</small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="align-self-center">
                                        <button onclick="mostra2()" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Registro de permiso (Compañero)"><i
                                            class="bi bi-file-earmark-plus" style="font-size: 2rem;"></i></button>
                                        
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Mis permisos</h5>
                                {{-- <p class="card-text"><small>Historial de permisos solicitados</small></p> --}}
                                <p class="card-text"><small>Permisos solicitados (mes actual)</small></p>
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
                                <a href="{{ route('permiso.disponibilidad')}}" class="btn btn-outline-primary">
                                    <i class="bi bi-card-list" style="font-size: 2rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        {{-- Seccion Autorizacion --}}

        <div class="row">
            <div class="col-12 px-3 pt-3 pb-2">
                <div class="fs-6 text-dark">Autorizaciones</div>
            </div>
        </div>
        <div class="row g-2">
            <div class="col">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Autorizaciones</h5>
                                        <p class="card-text"><small>Lista de permisos para su autorizacion</small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="align-self-center">
                                        <a href="{{ route('autorizacion-permiso') }}" class="btn btn-outline-primary">
                                            <i class="bi bi-clipboard-check" style="font-size: 2rem"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        {{-- <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Permiso (compañero)</h5>
                                        <p class="card-text"><small>Registre un permiso para un compañero</small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="align-self-center">
                                        <button onclick="mostra2()" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Registro de permiso (Compañero)"><i
                                            class="bi bi-file-earmark-plus" style="font-size: 2rem;"></i></button>
                                        
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                    </div>
                </div>

            </div>
            <div class="col">
                {{-- <div class="card">
                    <div class="row g-0">
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Mis permisos</h5>
                                
                                <p class="card-text"><small>Permisos solicitados (mes actual)</small></p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <div class="align-self-center">
                                <a href="{{ route('permiso.index') }}" class="btn btn-outline-primary"><i
                                        class="bi bi-card-list" style="font-size: 2rem;"></i></a>
                            </div>
                        </div>
                    </div>

                </div> --}}
            </div>
            <div class="col">
                {{-- <div class="card">
                    <div class="row g-0">
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Disponibilidad</h5>
                                <p class="card-text"><small>Verificar disponibilidad de permisos</small></p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <div class="align-self-center">
                                <a href="{{ route('permiso.disponibilidad')}}" class="btn btn-outline-primary">
                                    <i class="bi bi-card-list" style="font-size: 2rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div> --}}
            </div>
        </div>


        {{-- Seccion Autorizacion --}}

        <div class="row">
            <div class="col-12 px-3 pt-3 pb-2">
                <div class="fs-6 text-dark">Otros</div>
            </div>
        </div>
        <div class="row g-2">
            <div class="col">
                <div class="row g-4">
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
                                        <button onclick="mostra2()" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Registro de permiso (Compañero)"><i
                                            class="bi bi-file-earmark-plus" style="font-size: 2rem;"></i></button>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                       {{--  <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Permiso (personal)</h5>
                                        <p class="card-text"><small>Registre un permiso personal</small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="align-self-center">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Registro de permiso (Personal)"><i
                                                class="bi bi-file-earmark-plus" style="font-size: 2rem;"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                    </div>
                    <div class="col-12">
                        {{-- <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Permiso (compañero)</h5>
                                        <p class="card-text"><small>Registre un permiso para un compañero</small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="align-self-center">
                                        <button onclick="mostra2()" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Registro de permiso (Compañero)"><i
                                            class="bi bi-file-earmark-plus" style="font-size: 2rem;"></i></button>
                                        
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                    </div>
                </div>

            </div>
            <div class="col">
                {{-- <div class="card">
                    <div class="row g-0">
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Mis permisos</h5>
                                
                                <p class="card-text"><small>Permisos solicitados (mes actual)</small></p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <div class="align-self-center">
                                <a href="{{ route('permiso.index') }}" class="btn btn-outline-primary"><i
                                        class="bi bi-card-list" style="font-size: 2rem;"></i></a>
                            </div>
                        </div>
                    </div>

                </div> --}}
            </div>
            <div class="col">
                {{-- <div class="card">
                    <div class="row g-0">
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Disponibilidad</h5>
                                <p class="card-text"><small>Verificar disponibilidad de permisos</small></p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <div class="align-self-center">
                                <a href="{{ route('permiso.disponibilidad')}}" class="btn btn-outline-primary">
                                    <i class="bi bi-card-list" style="font-size: 2rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div> --}}
            </div>
        </div>


       
        {{-- Mostrar modal para registrar un permiso --}}
        <x-model_register />

        
    </div>
</x-app-layout>
