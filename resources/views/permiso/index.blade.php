<x-app-layout>
    <div class="toast-container position-absolute top-0 end-0 p-3">
        <div class="toast align-items-center text-white bg-success border-0" role="alert" data-bs-delay="3000"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Se ha registrado el permiso.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>


    <div class="my-5">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            onclick="agregar()">
                            Agregar
                        </button>
                    </div>
                    <div class="col-12">
                        <table id="permisos" class="table table-responsive table-hover my-1">
                            <thead>
                                <tr>
                                    <th>Referencia</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    {{-- <th>Fecha inicio</th> --}}
                                   {{--  <th>Hora inicio</th> --}}
                                   {{--  <th>Fecha fin</th> --}}
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


    <!-- Modal -->
    <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de permiso personal</h5>
                    <button type="button" id="cerrarHeaderBtn" class="btn" data-bs-dismiss="modal"
                        aria-label="Close"><i class="bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" id="errors" style="display: none">
                        <ul></ul>
                    </div>
                    <form action="javascript:void(0)" id="permisoForm" name="permisoForm">
                        <input type="hidden" name="p_id" id="p_id">
                        @csrf

                        <div class="row">
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="fechaSolicitud" class="form-label">Fecha de presentación</label>
                                    <input type="date" class="form-control" id="fechaSolicitud" name="fechaSolicitud"
                                        required>
                                    <div id="fechaSolicitud-error" class="text-danger mt-1"><small></small></div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="tipoPermiso" class="form-label">Tipo permiso</label>
                                    <select class="form-select" id="tipoPermiso" name="tipoPermiso" required>
                                        <option value="">Seleccione una opcion</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}">
                                                {{ $tipo->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div id="tipoPermiso-error" class="text-danger mt-1"><small></small></div>
                                </div>
                                <div class="col-4">
                                    <label for="goceSueldo" class="form-label">Goce sueldo</label>
                                    <select name="goceSueldo" id="goceSueldo" class="form-select"
                                        aria-label="select example" required>
                                        <option value="" selected>Selecciona una opcion</option>
                                        <option value="V">Si</option>
                                        <option value="F">No</option>
                                    </select>
                                    <div id="goceSueldo-error" class="text-danger mt-1"><small></small></div>
                                </div>
                                <div class="col-4">
                                    <label for="constancia" class="form-label">Constancia</label>
                                    <select name="constancia" id="constancia" class="form-select"
                                        aria-label="select example" required>
                                        <option value="" selected>Selecciona una opcion</option>
                                        <option value="V">Si</option>
                                        <option value="F">No</option>
                                    </select>
                                    <div id="constancia-error" class="text-danger mt-1"><small></small></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-4">
                                                <label for="fechaInicio" class="form-label">Fecha inicio</label>
                                                <input type="date" class="form-control" id="fechaInicio"
                                                    name="fechaInicio" required>
                                                <div id="fechaInicio-error" class="text-danger mt-1"><small></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-4">
                                                <label for="horaInicio" class="form-label">Hora inicio</label>
                                                <input type="time" class="form-control" id="horaInicio"
                                                    name="horaInicio" min="08:00" max="16:00" required>
                                                <div id="horaInicio-error" class="text-danger mt-1"><small></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="fechaFin" class="form-label">Fecha fin</label>
                                                <input type="date" class="form-control" id="fechaFin"
                                                    name="fechaFin" required>
                                                <div id="fechaFin-error" class="text-danger mt-1"><small></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="horaFin" class="form-label">Hora fin</label>
                                                <input type="time" class="form-control" id="horaFin"
                                                    name="horaFin" min="08:00" max="16:00" required>
                                                <div id="horaFin-error" class="text-danger mt-1"><small></small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3 h-100">
                                        <label for="motivo" class="form-label">Motivo</label>
                                        <textarea name="motivo" id="motivo" rows="5" class="form-control w-100 h-75" required></textarea>
                                        <div id="motivo-error" class="text-danger mt-1"><small></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cerrarFooterBtn"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
                // Configuracion de Datatable, para mostrar los datos
        var table = new DataTable('#permisos', {
            ajax: "{{ route('permiso.index') }}",
            columns: [
                {
                    data: 'id',
                    render: function(data, type, row, meta) {return '<a href="javascript:void(0)" class="link-offset-2 link-underline link-underline-opacity-0 viewPermiso" data-id="'+row.id+'">'+ row.id.substring(0,8).toUpperCase() +'</a>';}
                },
                {
                    data: 'fecha_solic'
                },
                {
                    data: 'cod_permiso'
                },
                // {
                //     data: 'fecha_inicial'
                // },
                // {
                //     data: 'hora_inicial'
                // },
                // {
                //     data: 'fecha_final'
                // },
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
                infoFiltered: '- filtrado de _MAX_ registros'
            }
        });

        // Reset del formulario
        function agregar() {
            $('#permisoForm').trigger("reset");
        }

        $('#cerrarFooterBtn, #cerrarHeaderBtn').on('click', function() {
            reset();
        });

        // Mostrar permiso
        $('body').on('click', '.viewPermiso', function(){
            var permiso = $(this).data('id');
            //console.log('presionado', p_id);
            $.get("{{ route('permiso.edit') }}",{id: permiso}, function(data){
                $('#exampleModal').modal('show');
                $('#p_id').val(data.permiso.id);
                $('#fechaSolicitud').val(data.permiso.fecha_solicitud);
                $('#goceSueldo').val(data.permiso.goce_sueldo).change();
                $('#constancia').val(data.permiso.constancia).change();
                $('#tipoPermiso').val(data.permiso.tp_fk).change();
                $('#fechaInicio').val(data.permiso.fecha_inicial);
                $('#horaInicio').val(data.permiso.hora_inicial);
                $('#fechaFin').val(data.permiso.fecha_final);
                $('#horaFin').val(data.permiso.hora_final);
                $('#motivo').val(data.permiso.motivo);
                console.log(data.permiso.fecha_solicitud);
            });
        });

        function reset() {
            v.resetForm();
            resetErrorMsg();
        }

        var v = $('#permisoForm').validate({
            rules: {
                fechaSolicitud: {
                    required: true,
                }

            },
            messages: {
                fechaSolicitud: {
                    required: "Este campo no puede quedar vacio",
                },
                tipoPermiso: {
                    required: "Debe elegir una opcion valida",
                },
                goceSueldo: {
                    required: "Debe elegir una opcion valida",
                },
                constancia: {
                    required: "Debe elegir una opcion valida",
                },
                fechaInicio: {
                    required: "Este campo no puede quedar vacio",
                },
                horaInicio: {
                    required: "Este campo no puede quedar vacio",
                    min: "La hora no debe ser menor a 08:00",
                    max: "La hora no debe ser mayor a 16:00",
                },
                fechaFin: {
                    required: "Este campo no puede quedar vacio",
                },
                horaFin: {
                    required: "Este campo no puede quedar vacio",
                    min: "La hora no debe ser menor a 08:00",
                    max: "La hora no debe ser mayor a 16:00",
                },
                motivo: {
                    required: "Este campo no puede quedar vacio"
                }
            },
            errorClass: 'text-danger',
            errorElement: 'small',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass)
            },
            submitHandler: function(form) {
                let formData = new FormData(form);

                $('#guardarBtn').prop('disabled', true).html('Enviando....');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('permiso.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        console.log(response);
                        if ($.isEmptyObject(response.errors)) {
                            $('#exampleModal').modal('hide');
                            $('#p_id').val('');
                            $('#permisoForm').trigger("reset");
                            //$('#guardarBtn').html('Guardar');
                            //$('#guardarBtn').prop('disabled', false);
                            $('#guardarBtn').prop('disabled', false).html('Guardar');
                            showToast();
                            resetErrorMsg();
                        } else {

                            errorMessagesFromServer(response);
                        }

                        table.ajax.reload();
                    },
                    error: function(response) {
                        $.each(response.responseJSON.errors, function(key, value) {
                            $('#permisoForm').find(".print-error-msg").find("ul").append(
                                '<li>' +
                                value + '</li>');
                        });
                    }
                });

            }
        });

        // Utilidades

        function showToast() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl)
            })
            toastList.forEach(toast => toast.show())
        }

        function errorMessagesFromServer(response) {
            $('#fechaSolicitud-error > small').text(capitalizeFirstLetter(response.errors
                .fechaSolicitud));
            $('#tipoPermiso-error > small').text(capitalizeFirstLetter(response.errors
                .tipoPermiso));
            $('#goceSueldo-error > small').text(capitalizeFirstLetter(response.errors
                .goceSueldo));
            $('#constancia-error > small').text(capitalizeFirstLetter(response.errors
                .constancia));
            $('#fechaInicio-error > small').text(capitalizeFirstLetter(response.errors
                .fechaInicio));
            $('#horaInicio-error > small').text(capitalizeFirstLetter(response.errors
                .horaInicio));
            $('#fechaFin-error > small').text(capitalizeFirstLetter(response.errors
                .fechaFin));
            $('#horaFin-error > small').text(capitalizeFirstLetter(response.errors
                .horaFin));
            $('#motivo-error > small').text(capitalizeFirstLetter(response.errors
                .motivo));
        }

        function capitalizeFirstLetter(string1) {
            return (string1) ? string1.toString().substring(0, 1).toUpperCase() + string1.toString().substring(1) : string1;
        }


        function resetErrorMsg() {
            $('#fechaSolicitud-error > small').text('');
            $('#tipoPermiso-error > small').text('');
            $('#goceSueldo-error > small').text('');
            $('#constancia-error > small').text('');
            $('#fechaInicio-error > small').text('');
            $('#horaInicio-error > small').text('');
            $('#fechaFin-error > small').text('');
            $('#horaFin-error > small').text('');
            $('#motivo-error > small').text('');
        }
    </script>

</x-app-layout>
