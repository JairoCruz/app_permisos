
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <label for="tipo" class="form-label">tipo</label>
            <select name="tipo" id="tipo" class="form-select">
                <option value="" selected>Seleccione</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function mostra(){
        $('#tipo').html('');
        $('#tipo').html('<option value="" selected>Seleccione una opcion</option>');
        $.get("{{ route('permiso-tipos') }}", function(data) {
            $.each(data.tipos, function(key, value){
                $('#tipo').append('<option value="' + value.id + '">' + value.descripcion + '</option>');
            });
        });
    }
  </script>