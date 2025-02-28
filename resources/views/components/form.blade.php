<form action="javascript:void(0)" id="permisoForm" name="permisoForm">
    <input type="hidden" name="p_id" id="p_id">
    @csrf

    <div id="repetido-error" class="text-danger mt-1"><small></small></div>

    
    
    <div class="row">

        <div id="box_dui" class="row">
            
        </div>

        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="fechaSolicitud" class="form-label">Fecha de presentación</label>
                    <input type="date" class="form-control" id="fechaSolicitud" name="fechaSolicitud" required>
                    <div id="fechaSolicitud-error" class="text-danger mt-1"><small></small></div>
                </div>
    
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="autorizacionJefe" class="form-label">Responsable de autorizacion</label>
                    <select name="autorizacionJefe" id="autorizacionJefe" class="form-select" required></select>
                    <div id="autorizacionJefe-error" class="text-danger mt-1"><small></small></div>
                </div>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-4">
                <label for="tipoPermiso" class="form-label">Tipo permiso</label>

                <select class="form-select" id="tipoPermiso" name="tipoPermiso" required>
                </select>

                <div id="tipoPermiso-error" class="text-danger mt-1"><small></small></div>
            </div>
            <div class="col-4">
                <label for="goceSueldo" class="form-label">Goce sueldo</label>
                <select name="goceSueldo" id="goceSueldo" class="form-select" aria-label="select example" required>
                    <option value="" selected>Selecciona una opcion</option>
                    <option value="V">Si</option>
                    <option value="F">No</option>
                </select>
                <div id="goceSueldo-error" class="text-danger mt-1"><small></small></div>
            </div>
            <div class="col-4">
                <label for="constancia" class="form-label">Constancia</label>
                <select name="constancia" id="constancia" class="form-select" aria-label="select example" required>
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
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                            <div id="fechaInicio-error" class="text-danger mt-1"><small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-4">
                            <label for="horaInicio" class="form-label">Hora inicio</label>
                            <input type="time" class="form-control" id="horaInicio" name="horaInicio" min="08:00"
                                max="16:00" required>
                            <div id="horaInicio-error" class="text-danger mt-1"><small></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="fechaFin" class="form-label">Fecha fin</label>
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
                            <div id="fechaFin-error" class="text-danger mt-1"><small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="horaFin" class="form-label">Hora fin</label>
                            <input type="time" class="form-control" id="horaFin" name="horaFin" min="08:00"
                                max="16:00" required>
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
