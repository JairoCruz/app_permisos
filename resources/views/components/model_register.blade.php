{{-- Toas alert --}}
<x-alert_toast id="toast-1" type="bg-success" delay="2000">
    Se ha registrado el permiso
</x-alert_toast>
{{-- End toas alert --}}

{{-- Toas alert --}}
<x-alert_toast id="toast-2" type="bg-info" delay="3000">
    Su permiso se descargara en unos momento.
</x-alert_toast>
{{-- End toas alert --}}


{{-- Toas alert --}}
<x-alert_toast id="toast-3" type="bg-danger" delay="5000">
    Ya existe un permiso con los mismos datos.
</x-alert_toast>
{{-- End toas alert --}}



<!-- Modal Registrar -->
<div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de permiso personal</h5>
                <button type="button" id="cerrarHeaderBtn" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" id="errors" style="display: none">
                    <ul></ul>
                </div>
                {{-- form --}}
                <x-form />
            </div>
        </div>
    </div>



    <script>
        // Reset del formulario
        function agregar() {
            $('#permisoForm').trigger("reset");
        }

        $('#cerrarFooterBtn, #cerrarHeaderBtn').on('click', function() {
            $('#box_dui').html('');
            reset();
        });

        // Mostrar permiso
        $('body').on('click', '.viewPermiso', function() {
            var permiso = $(this).data('id');
            //console.log('presionado', p_id);
            $.get("{{ route('permiso.edit') }}", {
                id: permiso
            }, function(data) {
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

        // Validacion
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
                        console.log('si esa respuesta', response);
                        if ($.isEmptyObject(response.errors)) {
                            $('#exampleModal').modal('hide');
                            $('#p_id').val('');
                            $('#permisoForm').trigger("reset");
                            //$('#guardarBtn').html('Guardar');
                            //$('#guardarBtn').prop('disabled', false);
                            $('#guardarBtn').prop('disabled', false).html('Guardar');
                            showToast();
                            resetErrorMsg();
                            // $('#modalViewPrint').modal('show');
                            window.setTimeout(() => {
                                showToasInfo();
                            }, 3000);

                            window.setTimeout(() => {
                                // Generar y descargar permiso PDF
                                window.location.href = '/imprimir-permiso/' + response.data
                                    .id;
                            }, 3000);

                        } else {
                            showToasError();
                            errorMessagesFromServer(response);
                            $('#guardarBtn').prop('disabled', false).html('Guardar');
                        }

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
            var toastElList = [].slice.call(document.querySelectorAll('#toast-1'))
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl)
            })
            toastList.forEach(toast => toast.show())

        }

        function showToasInfo() {
            var toastElList = [].slice.call(document.querySelectorAll('#toast-2'))
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl)
            })
            toastList.forEach(toast => toast.show())
        }

        function showToasError() {
            var toastElList = [].slice.call(document.querySelectorAll('#toast-3'))
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


        // La llamada a este metodo esta disponible en dashboard.blade.php

        function mostra() {
            // $('#tipoPermiso').html('');
            // $('#tipoPermiso').html('<option value="" selected>Seleccione una opcion</option>');
            // $.get("{{ route('permiso-tipos') }}", function(data) {
            //     $.each(data.tipos, function(key, value) {
            //         $('#tipoPermiso').append('<option value="' + value.id + '">' + value.descripcion +
            //             '</option>');
            //     });
            // });
        }


        function mostra2() {

            $('#box_dui').html('<div class="col-4"><div class="mb-3"><label for="numDuiCom" class="form-label">DUI</label><input placeholder="Ingrese el numero de DUI" class="form-control" id="numDuiCom" name="numDuiCom"><div id="numDuiCom-error" class="text-danger mt-1"><small></small></div></div></div>');
        }

        function cargarTipos(){
            $('#tipoPermiso').html('');
            $('#tipoPermiso').html('<option value="" selected>Seleccione una opcion</option>');
            $.get("{{ route('permiso-tipos') }}", function(data) {
                $.each(data.tipos, function(key, value) {
                    $('#tipoPermiso').append('<option value="' + value.id + '">' + value.descripcion +
                        '</option>');
                });
            });
        }

        // 
        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            cargarTipos();
            var button = event.relatedTarget;
            var title = button.getAttribute('data-bs-whatever');
            var modalTitle = exampleModal.querySelector('.modal-title');
            modalTitle.textContent = title;

        })


    </script>
