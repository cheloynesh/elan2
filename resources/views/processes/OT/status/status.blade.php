<div id="myEstatusModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Estatus:</h4>
                <button type="button" onclick="cerrarmodal()" class="close" aria-label="Close">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Estatus:</label>
                                    <select name="selectStatus" id="selectStatus" class="form-select" onchange="Subestatus()">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        @foreach ($cmbStatus as $id => $status)
                                            <option value='{{ $id }}'>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="sub_status" hidden>
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Sub-Estatus:</label>
                                    <select name="selectSubEstatus" id="selectSubEstatus"class="form-select" onchange="mostrartext()">
                                        <option hidden selected value="0">Selecciona una opción</option>
                                            <option value="INFORME MEDICO">INFORME MEDICO</option>
                                            <option value="EXTRAPRIMA">EXTRAPRIMA</option>
                                            <option value="DETALLE OCUPACION">DETALLE OCUPACION</option>
                                            <option value="ERROR DOCUMENTOS">ERROR DOCUMENTOS</option>
                                            <option value="1">OTROS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="showcom">
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label for="">Comentario: </label>
                                    <textarea name="commentary" class="form-control" id="commentary" rows="5" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cerrarmodal()" class="btn btn-secundary">Cancelar</button>
                <button type="button" onclick="actualizarEstatus()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
