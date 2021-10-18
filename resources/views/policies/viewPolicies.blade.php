@extends('home')
<head>
    <title>Polizas | ELAN</title>
</head>
@section('content')
    <div class="text-center"><h1>Polizas</h1></div>

    {{-- modal de recibos --}}
    <div id="myModalReceipts" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="gridModalLabek">Recibos de la poliza</h4>
                    <button type="button" class="close" onclick="closereceipts()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive" style="margin-bottom: 10px; max-width: 1200px; margin: auto;">
                        <table class="table table-striped table-hover text-center" id="tablerecords">
                            <thead>
                                <th class="text-center">Prima Neta</th>
                                <th class="text-center">Gastos EXP</th>
                                <th class="text-center">G.Finan</th>
                                <th class="text-center">Otros</th>
                                <th class="text-center">IVA</th>
                                <th class="text-center">Prima Total</th>
                                <th class="text-center">Fecha Pago </th>
                                <th class="text-center">Fecha Limite</th>
                                <th class="text-center">Accion</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- termina modal de recibos --}}

    {{-- modal modificar poliza --}}
    <div id="myModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="gridModalLabel">Editar Poliza</h4>
                    <button type="button" class="close" onclick="cancelareditar()" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Prima neta</label>
                            <input type="text" id="pna_edit" class="form-control" placeholder="Prima neta" onchange="calculo()">
                        </div>
                        <div class="col-md-4">
                            <label for=""> Expedición</label>
                            <input type="text" name="expedition" id="expedition_edit" class="form-control" placeholder="Gastos de Expedición" onchange="calculo()">
                        </div>
                        <div class="col-md-4">
                            <label for="">Imputar </label>
                            <select class="form-select" aria-label="Default select example" id="exp_impute_edit">
                                <option value="1">Primera</option>
                                <option value="2">Todas</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">G. Financiamiento</label>
                            <input type="text" name="financ_exp" id="financ_exp_edit" class="form-control" placeholder="Gastos de Financiamiento" onchange="calculo()">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imputar </label>
                            <select class="form-select" aria-label="Default select example" id="financ_impute_edit">
                                <option value="1">Primera</option>
                                <option value="2">Todas</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Otros</label>
                            <input type="text" name="other_exp" id="other_exp_edit" class="form-control" placeholder="Otros Gastos" onchange="calculo()">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imputar</label>
                            <select class="form-select" aria-label="Default select example" id="other_impute_edit">
                                <option value="1">Primera</option>
                                <option value="2">Todas</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">IVA</label>
                            <input type="text" name="iva" id="iva_edit" class="form-control" placeholder="IVA" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">IVA %</label>
                            <input type="text" name="ivapor" id="ivapor_edit" value=".16" class="form-control" placeholder="IVA %" onchange="calculo()">
                        </div>
                        <div class="col-md-4">
                            <label for="">Prima Total</label>
                            <input type="text" name="prima_t" id="prima_t_edit" class="form-control" placeholder="Prima Total" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Divisa</label>
                            <select class="form-select" id="selectCurrency_edit" aria-label="Default select example">
                                <option selected hidden value="">Selecciona una Divisa</option>
                                @foreach ($currencies as $id => $currency)
                                    <option value='{{ $id }}'>{{ $currency }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Renovable: </label>
                            <select class="form-select" aria-label="Default select example" id="renovable_edit">
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Aseguradora:</label>
                                <select name="selectInsurance" id="selectInsurance_edit" class="form-select">
                                    <option hidden selected value="">Selecciona una opción</option>
                                    @foreach ($insurances as $id => $insurance)
                                        <option value='{{ $id }}'>{{ $insurance }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class = "row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ramo:</label>
                                <select name="selectBranch" id="selectBranch_edit" class="form-select">
                                    <option hidden selected value="">Selecciona una opción</option>
                                    @foreach ($branches as $id => $branch)
                                        <option value='{{ $id }}'>{{ $branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="">Vendida por: </label>
                            <select class="form-select" id="selectAgent_edit" aria-label="Default select example">
                                <option selected hidden value="">Selecciona un Agente</option>
                                @foreach ($agents as $id => $agent)
                                            <option value='{{ $id }}'>{{ $agent }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Frecuencia de pago</label>
                                <select class="form-select" aria-label="Default select example" id="pay_frec_edit">
                                    <option selected hidden value="">Selecciona una opción</option>
                                    <option value="12">Mensual</option>
                                    <option value="4">Trimestral</option>
                                    <option value="2">Semestral</option>
                                    <option value="1">Anual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Conducto de cobro</label>
                                <select name="selectCharge" id="selectCharge_edit" class="form-select">
                                    <option hidden selected value="">Selecciona una opción</option>
                                    @foreach ($charges as $id => $charge)
                                        <option value='{{ $id }}'>{{ $charge }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Forma de pago</label>
                                <select name="selectPaymentform" id="selectPaymentform_edit" class="form-select">
                                    <option hidden selected value="">Selecciona una opción</option>
                                    @foreach ($paymentForms as $id => $payment_form)
                                        <option value='{{ $id }}'>{{ $payment_form }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fecha Inicio Vigencia</label>
                                <input type="date" id="initial_date_edit" name="initial_date_edit" class="form-control" placeholder="Fecha de creación" onchange="fechafin()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fecha fin Vigencia</label>
                                <input type="date" id="end_date_edit" name="end_date_edit" class="form-control" placeholder="Fecha de creación">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" onclick="mostrartabla()">
                                Actualizar Recibos
                            </button>
                        </div>
                    </div>

                    <div class="row">
                            <div class="table-responsive" >
                                <table class="table table-striped table-hover text-center" id="tablerecords_edit">
                                    <thead>
                                        <th class="text-center">Prima Neta</th>
                                        <th class="text-center">Gastos EXP</th>
                                        <th class="text-center">G.Finan</th>
                                        <th class="text-center">Otros</th>
                                        <th class="text-center">IVA</th>
                                        <th class="text-center">Prima Total</th>
                                        <th class="text-center">F. Pago</th>
                                        <th class="text-center">F.Limite</th>
                                    </thead>
                                    <tbody id="tbodyRecords"></tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="cancelareditar()" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizarpoliza()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- termina modal modificar poliza --}}

    <div style="max-width: 1200px; margin: auto;">
        {{-- Inicia pantalla de inicio --}}
        <div class="table-responsive" style="margin-bottom: 10px; max-width: 1200px; margin: auto;">
            <table class="table table-striped table-hover text-center" id="tbPoliza">
                <thead>
                    <th class="text-center"># Póliza</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Opciones</th>
                </thead>
                <tbody>
                    @foreach ($policy as $policies)
                        <tr id="{{$policies->id}}">
                            <td>{{$policies->policy}}</td>
                            <td>{{$policies->name}}</td>
                            <td>
                                <a href="#|" class="btn btn-primary" onclick="verRecibos({{$policies->policy}})">Ver Recibos</a>
                                <a href="#|" class="btn btn-warning" onclick="editarPoliza({{$policies->id}})" >Editar</a>
                                <a href="#|" class="btn btn-danger" onclick="eliminarPoliza({{$policies->id}})">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@push('head')
    <script src="{{URL::asset('js/policies/viewpolicy.js')}}"></script>
@endpush
