 {{-- Toas alert --}}
 <x-alert_toast id="toast_up" type="bg-success" delay="3000">
     Se ha actualizado el registro.
 </x-alert_toast>
 {{-- End toas alert --}}

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
                 {{-- Form --}}
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

         // La llamada a este metodo esta disponible en dashboard.blade.php

         function mostra() {
             $('#tipoPermiso').html('');
             $('#tipoPermiso').html('<option value="" selected>Seleccione una opcion</option>');
             $.get("{{ route('permiso-tipos') }}", function(data) {
                 $.each(data.tipos, function(key, value) {
                     $('#tipoPermiso').append('<option value="' + value.id + '">' + value.descripcion +
                         '</option>');
                 });
             });
         }
     </script>
