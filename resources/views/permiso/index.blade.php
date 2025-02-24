<x-app-layout>
    <div class="my-5">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table id="permisos" class="table table-bordered table-responsive table-hover my-1">
                            <thead>
                                <tr>
                                    <th>Referencia</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Fecha inicio</th>
                                    {{--  <th>Hora inicio</th> --}}
                                    <th>Fecha fin</th>
                                    {{--  <th>Hora fin</th> --}}
                                    <th>Tiempo solicitado</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        // Configuracion de Datatable, para mostrar los datos
        var table = new DataTable('#permisos', {
            ajax: "{{ route('permiso.index') }}",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return '<a href="javascript:void(0)" onclick="mostra()" class="link-offset-2 link-underline link-underline-opacity-0 viewPermiso" data-id="' +
                            row.id + '">' + row.id.substring(0, 8).toUpperCase() + '</a>';
                    }
                },
                {
                    data: 'fecha_solic'
                },
                {
                    data: 'cod_permiso'
                },
                {
                    data: 'fecha_inicial'
                },
                // {
                //     data: 'hora_inicial'
                // },
                {
                    data: 'fecha_final'
                },
                // {
                //     data: 'hora_final'
                // },
                {
                    data: 'total_tiempo'
                },
                {
                    data: 'estado'
                },
            ],
            language: {
                search: 'Buscar:',
                lengthMenu: 'Mostrando _MENU_ por pagina',
                entries: {
                    _: 'Permisos',
                },
                info: 'Mostrando pagina _PAGE_ de _PAGES_',
                infoEmpty: 'No hay registros para mostrar',
                infoFiltered: '- filtrado de _MAX_ registros',
                loadingRecords: 'Cargando datos....'
            }
        });
    </script>

    {{-- Model update --}}

    <x-model_update />

    {{-- End model update --}}


</x-app-layout>
