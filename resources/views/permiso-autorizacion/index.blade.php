<x-app-layout>

    <div class="my-5">
        {{-- <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive-sm">

                            <table class="table table-bordered table-hover my-1">
                                <thead>
                                    <tr>
                                        <th>Empleado</th>
                                        <th>Unidad</th>
                                        <th>Tipo</th>
                                        <th>Del</th>
                                        <th>Hasta</th>
                                        <th>Motivo</th>
                                        <th>Tiempo solicitado</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                        <tr>
                                            <td>{{ $permiso->empleado->nombres . ' ' . $permiso->empleado->apellidos }}</td>
                                            <td>{{ $permiso->empleado->unidad->nombre }}</td>
                                            <td>{{ $permiso->tipo_permiso->descripcion }}</td>
                                            <td>{{ date('d-m-Y', strtotime($permiso->fecha_inicial)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($permiso->fecha_final)) }}</td>
                                            <td>{{ $permiso->motivo }}</td>
                                            <td>{{ totalTime($permiso->total_tiempo) }}</td>
                                            <td>{{ $permiso->estado_permiso->nombre }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary"><i
                                                        class="bi bi-check-circle"></i></button><button type="button"
                                                    class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            

                        </div>
                        
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- Segundo diseño de card (valido usar) --}}
        @foreach ($permisos as $permiso)
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <div class="card-text">

                        <div class="row">
                            <div class="col-12 text-end">
                                <span class="text-secondary me-1"><strong><small>Estado:</small></strong>
                                    @switch($permiso->estado)
                                        @case(1)
                                            <strong class="badge bg-success text-white">
                                                {{ $permiso->estado_permiso->nombre }}
                                            </strong>
                                            @break
                                        @case(3)
                                        <strong class="badge bg-danger text-white">
                                            {{ $permiso->estado_permiso->nombre }}
                                        </strong>
                                        @break
                                        @default
                                            <strong class="badge bg-secondary text-white">
                                                {{ $permiso->estado_permiso->nombre }}
                                            </strong>
                                    @endswitch
                                    {{-- <strong class="badge bg-{{ $permiso->estado == 1 ? 'success' : 'secondary' }} text-white">
                                        {{ $permiso->estado_permiso->nombre }}
                                    </strong> --}}
                                </span>
                            </div>
                            <div class="col-6">
                                <span class="text-secondary"><strong><small>Solicitante</small></strong></span>
                                <div>{{ $permiso->empleado->nombres . ' ' . $permiso->empleado->apellidos }}</div>
                            </div>
                            <div class="col-6">
                                <span class="text-secondary"><strong><small>Unidad</small></strong></span>
                                <div>{{ $permiso->empleado->unidad->nombre }}</div>
                            </div>
                            <div class="col-12 mt-1">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="text-secondary"><strong><small>Detalles del
                                                    permiso</small></strong></span>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-3 text-center">
                                            <span class="text-secondary"><strong><small>Tipo</small></strong></span>
                                            <div>{{ $permiso->tipo_permiso->descripcion }}</div>
                                        </div>
                                        <div class="col-3 text-center">
                                            <span class="text-secondary"><strong><small>Periodo</small></strong></span>
                                            <div class="row">
                                                <div class="col-6">del:
                                                    {{ date('d-m-Y', strtotime($permiso->fecha_inicial)) }}</div>
                                                <div class="col-6">al:
                                                    {{ date('d-m-Y', strtotime($permiso->fecha_final)) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-center">
                                            <span class="text-secondary"><small><strong>Tiempo
                                                        solicitado</strong></small></span>
                                            <div>{{ totalTime($permiso->total_tiempo) }}</div>
                                        </div>
                                        <div class="col-3 text-center">
                                            <span class="text-secondary"><strong><small>Motivo</small></strong></span>
                                            <div>{{ $permiso->motivo }}</div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
                <div class="card-footer bg-transparent border-primary">
                    <div class="d-flex flex-row-reverse">


                        <form class="p-1" action="{{ route('aprobar', ['permiso' => $permiso->id]) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i>
                                aprovar</button>
                        </form>

                        <form class="p-1" action="{{ route('rechazar') }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="bi bi-x-circle"></i>
                                denegar</button>
                        </form>



                    </div>
                </div>
            </div>
        @endforeach


        {{-- Este diseño es con accordion collapse --}}

        {{-- <div id="accordionExample" class="accordion accordion-flush">
            @foreach ($permisos as $permiso)

           
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-{{ $permiso->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $permiso->id }}" aria-expanded="false" aria-controls="collapse-{{ $permiso->id }}">
                        {{ $permiso->empleado->nombres . ' ' . $permiso->empleado->apellidos }}
                    </button>
                </h2>
                <div id="collapse-{{ $permiso->id }}" class="accordion-collapse collapse" aria-labelledby="headin-{{ $permiso->id }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        

                        <div class="col-12 mt-1">
                            <div class="row">
                                <div class="col-12">
                                    <span><strong><small>Detalles del permiso:</small></strong></span>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3 text-center">
                                        <span><strong><small>Tipo</small></strong></span>
                                        <div>{{ $permiso->tipo_permiso->descripcion }}</div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span><strong><small>Periodo</small></strong></span>
                                        <div class="row">
                                            <div class="col-6">del: {{ date('d-m-Y', strtotime($permiso->fecha_inicial)) }}</div>
                                            <div class="col-6">al: {{ date('d-m-Y', strtotime($permiso->fecha_final)) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span><small><strong>Tiempo solicitado</strong></small></span>
                                        <div>{{ totalTime($permiso->total_tiempo) }}</div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span><strong><small>Motivo</small></strong></span>
                                        <div>{{ $permiso->motivo }}</div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>


                    </div>
                </div>
            </div>
           

            @endforeach
        </div> --}}




        {{-- Este diseño es con list agregando un colapse  --}}

        {{--  
        <ol class="list-group list-group-numbered">
        <li data-bs-toggle="collapse" data-bs-target="#example-{{ $permiso->id }}" aria-expanded="false" aria-controls="example-{{ $permiso->id }}" class="list-group-item">{{ $permiso->empleado->nombres . ' ' . $permiso->empleado->apellidos }}</li>
            <div id="example-{{ $permiso->id }}" class="collapse">
                <div class="card card-body">
                    {{ $permiso->id }}
                </div>
            </div>
            </ol>
            --}}








        {{-- Primer diseño de card  --}}
        {{-- <div class="card border-primary">
            <div class="card-body">
                <p class="card-text">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <span><small><strong>Solicitante:</strong></small></span>
                                </div>
                                <div class="col-12">
                                    {{ $permiso->empleado->nombres .' '. $permiso->empleado->apellidos}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span><small><strong>Unidad:</strong></small></span>
                                </div>
                                <div class="col-12">
                                    {{ $permiso->empleado->unidad->nombre}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span><small><strong>Tipo de permiso:</strong></small></span>
                                </div>
                                <div class="col-12">
                                    {{ $permiso->tipo_permiso->descripcion}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span><small><strong>Periodo:</strong></small></span>
                                </div>
                                <div class="col-4">
                                    Del: {{  date('d-m-Y', strtotime($permiso->fecha_inicial))}} Al: {{ date('d-m-Y', strtotime($permiso->fecha_final)) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span><small><strong>Motivo:</strong></small></span>
                                </div>
                                <div class="col-12">
                                    {{ $permiso->motivo}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <span><small><strong>Total de tiempo solicitado:</strong></small></span>
                                </div>
                                <div class="col-12">
                                    {{ totalTime($permiso->total_tiempo) }}
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </p>

                <div class="card-footer bg-transparent">
                    <div class="row">
                        <div class="col-10">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary"><i
                                    class="bi bi-check-circle"></i>Aprovar</button>
                            </div>
                            
                        </div>
                        <div class="col-2">
                           <button type="button"
                            class="btn btn-danger"><i class="bi bi-x-circle"></i>Denegar</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div> --}}



    </div>

</x-app-layout>
