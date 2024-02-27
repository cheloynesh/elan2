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
                                        <option hidden selected value=0>Selecciona una opción</option>
                                            <option value=1>INFORME MEDICO</option>
                                            <option value=2>EXTRAPRIMA</option>
                                            <option value=3>DETALLE OCUPACION</option>
                                            <option value=4>ERROR DOCUMENTOS</option>
                                            <option value=5>OTROS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="showcom">
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label for="">Comentario: </label>
                                    <textarea name="commentary" class="form-control" id="commentary" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cerrarmodal()" class="btn btn-secundary">Cancelar</button>
                @if ($perm_btn['modify']==1)
                    <button type="button" onclick="actualizarEstatus()" class="btn btn-primary">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
