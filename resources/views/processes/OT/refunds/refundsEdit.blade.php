<div id="myModaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Actualziar Siniestro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" onclick="cancelarEditar()">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Agente:</label>
                                <select name="selectAgent1" id="selectAgent1" class="form-select">
                                    <option hidden selected value="">Selecciona una opción</option>
                                    @foreach ($agents as $id => $agent)
                                        <option value='{{ $id }}'>{{ $agent }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Folio</label>
                                <input type="text" id="folio1" name="folio1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contratante</label>
                                <input type="text" id="contractor1" name="contractor1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Número de Guía</label>
                                <input type="text" id="guide1" name="guide1" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Compañía:</label>
                                <select name="selectInsurance1" id="selectInsurance1" class="form-select" onchange="llenarRamos1()">
                                    <option hidden selected value="">Selecciona una opción</option>
                                    @foreach ($insurances as $id => $insurance)
                                        <option value='{{ $id }}'>{{ $insurance }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ramo:</label>
                                <select name="selectBranch" id="selectBranch1" class="form-select">
                                    <option selected value="">Selecciona una opción</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Fecha de Ingreso</label>
                                <input type="date" id="entry_date1" name="entry_date1" class="form-control" placeholder="Fecha de Sistema">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Póliza</label>
                                <input type="text" id="policy1" name="policy1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Asegurado Afectado</label>
                                <input type="text" id="insured1" name="insured1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Número de Siniestro</label>
                                    <input type="text" id="sinister1" name="sinister1" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Tipo de Trámite</label>
                                    <select name="selectType1" id="selectType1" class="form-select" onchange="changeType('1')">
                                        <option hidden selected value="0">Selecciona una opción</option>
                                        <option value="1">Reembolsos</option>
                                        <option value="2">Prog. Cirugia</option>
                                        <option value="3">Reconsideración</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="refundDiv1">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Monto a Reembolsar</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" id="amount1" name="amount1" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="payDiv1">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Forma de Pago</label>
                                    <select name="selectPayment1" id="selectPayment1" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label for="">Comentario: </label>
                                <textarea name="refund_comm" class="form-control" id="refund_comm" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cancelarEditar()"class="btn btn-secundary">Cancelar</button>
                @if ($perm_btn['modify']==1)
                    <button type="button" onclick="actualizarSiniestro()" class="btn btn-primary">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
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
                                    <select name="selectStatus" id="selectStatus" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        @foreach ($cmbStatus as $id => $status)
                                            <option value='{{ $id }}'>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Fecha</label>
                                    <input type="date" id="stat_date" name="stat_date" class="form-control" placeholder="Fecha">
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
