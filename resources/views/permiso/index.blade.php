<x-app-layout>
    <div class="container my-5">

        <div class="row">
            <div class="col">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                </button>
            </div>
            <div class="col-12">
                <table id="permisos" class="table table-responsive table-hover my-1">
                    <thead>
                        <tr>
                            <th>Fecha presentacion</th>
                            <th>Tipo</th>
                            <th>Fecha inicio</th>
                            <th>Hora inicio</th>
                            <th>Fecha fin</th>
                            <th>Hora fin</th>
                            <th>Total tiempo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de permiso personal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="fechaSolicitud" class="form-label">Ingrese la fecha de solicitud</label>
                                <input type="date" class="form-control" id="fechaSolicitud">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="tipoPermiso" class="form-label">Tipo permiso</label>
                                <select name="" id="tipoPermiso" class="form-select" aria-label="select example">
                                    <option selected>Selecciona una opcion</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select name="" id="" class="form-select" aria-label="select example">
                                    <option selected>Open this select</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select name="" id="" class="form-select" aria-label="select example">
                                    <option selected>Open this select</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="fechaSolicitud" class="form-label">Fecha inicio</label>
                                            <input type="date" class="form-control" id="fechaSolicitud">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="fechaSolicitud" class="form-label">Hora inicio</label>
                                            <input type="time" class="form-control" id="fechaSolicitud">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="fechaSolicitud" class="form-label">Fecha fin</label>
                                            <input type="date" class="form-control" id="fechaSolicitud">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="fechaSolicitud" class="form-label">Hora fin</label>
                                            <input type="time" class="form-control" id="fechaSolicitud">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="textMotivo" class="form-label">Motivo</label>
                                    <textarea name="" id="" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        new DataTable('#permisos', {
            ajax: "{{ route('permiso.index') }}",
            columns: [{
                    data: 'fecha_solic'
                },
                {
                    data: 'cod_permiso'
                },
                {
                    data: 'fecha_inicial'
                },
                {
                    data: 'hora_inicial'
                },
                {
                    data: 'fecha_final'
                },
                {
                    data: 'hora_final'
                },
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
                infoFiltered: '- filtrado de _MAX_ registros'
            }
        });
    </script>

</x-app-layout>
