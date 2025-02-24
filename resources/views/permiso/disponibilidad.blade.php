<x-app-layout>
    <div class="py-5">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div>
                        Periodo: {{ $periodo->ano ?? now()->format('Y') }}
                    </div>
                    <div class="col-12">
                        <table class="table table-responsive my-1">
                            <thead>
                                <tr>
                                    <th scope="col">Permiso</th>
                                    <th scope="col">Total/horas</th>
                                    <th scope="col">Utilizados</th>
                                    <th scope="col">Disponibles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datos as $permiso)
                                    <tr>
                                        <td>
                                            @if (isset($permiso->descripcion))
                                                {{ $permiso->descripcion }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($permiso->valor))
                                                {{ $permiso->valor }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($permiso->total))
                                                {{ $permiso->total }}
                                            @else
                                                0:00
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($permiso->disponibles))
                                                {{ $permiso->disponibles }}
                                            @else
                                                {{ $permiso->valor }}
                                            @endif
                                        </td>
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
