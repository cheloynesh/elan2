<div id="myModaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Registro de Cálculos de Cobro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Agente:</label>
                                <select name="selectAgent" id="selectAgent1" class="form-control">
                                    <option hidden selected>Selecciona una opción</option>
                                    @foreach ($agents as $id => $agent)
                                        <option value='{{ $id }}'>{{ $agent }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Cliente</label>
                                <input type="text" id="client1" name="client" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">RFC</label>
                                <input type="text" id="rfc1" name="rfc" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fecha de promotoria</label>
                                <input type="date" id="promoter1" name="promoter" class="form-control" placeholder="Fecha de nacimiento">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Folio</label>
                                <input type="text" id="folio1" name="folio" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Aseguradora:</label>
                                <select name="selectInsurance" id="selectInsurance1" class="form-control">
                                    <option hidden selected>Selecciona una opción</option>
                                    @foreach ($insurances as $id => $insurance)
                                        <option value='{{ $id }}'>{{ $insurance }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ramo:</label>
                                <select name="selectBranch" id="selectBranch1" class="form-control">
                                    <option hidden selected>Selecciona una opción</option>
                                    @foreach ($branches as $id => $branch)
                                        <option value='{{ $id }}'>{{ $branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tipo Solicitud:</label>
                                <select name="selectAppli" id="selectAppli1" class="form-control">
                                    <option hidden selected>Selecciona una opción</option>
                                    @foreach ($applications as $id => $appli)
                                        <option value='{{ $id }}'>{{ $appli }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mes ingresado:</label>
                                <select name="selectMonth" id="selectMonth1" class="form-control">
                                    <option hidden selected>Selecciona una opción</option>
                                    <option value="Enero">Enero</option>
                                    <option value="Febrero">Febrero</option>
                                    <option value="Marzo">Marzo</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Mayo">Mayo</option>
                                    <option value="Junio">Junio</option>
                                    <option value="Julio">Julio</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Septiembre">Septiembre</option>
                                    <option value="Octubre">Octubre</option>
                                    <option value="Noviembre">Noviembre</option>
                                    <option value="Diciembre">Diciembre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">PNA</label>
                                <input type="text" id="pna1" name="pna" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Forma de Pago:</label>
                                <select name="selectPaymentform" id="selectPaymentform1" class="form-control">
                                    <option hidden selected>Selecciona una opción</option>
                                    @foreach ($paymentForms as $id => $payment_form)
                                        <option value='{{ $id }}'>{{ $payment_form }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Moneda:</label>
                                <select name="selectCurrency" id="selectCurrency1" class="form-control">
                                    <option hidden selected>Selecciona una opción</option>
                                    @foreach ($currencies as $id => $currency)
                                        <option value='{{ $id }}'>{{ $currency }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Conducto de cobro:</label>
                                <select name="selectCharge" id="selectCharge1" class="form-control">
                                    <option hidden selected>Selecciona una opción</option>
                                    @foreach ($charges as $id => $charge)
                                        <option value='{{ $id }}'>{{ $charge }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cancelarEditar()" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="actualizarInicial()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
