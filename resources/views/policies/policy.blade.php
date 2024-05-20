@extends('home')
<head>
    <title>Poliza | Elan</title>
</head>
@section('content')
    <div class="text-center"><h1>Póliza</h1></div>
    <div style="max-width: 1200px; margin: auto;">
        @include('policies.searchclient')

        {{-- Inicia pantalla de inicio --}}
        <div class="row">
            <div class="col-md-3">
                <input type="text" id="poliza" name="poliza" class="form-control" placeholder="Número de póliza">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" onclick="checkPolicy()">Verificar</button>
            </div>
            <div class="col-md-6" id = "divClientes" style="display: none;">
                <div>
                    <label for="">Clientes: </label> &nbsp;&nbsp;
                    <button type="button" class="btn btn-primary" onclick="buscarclientes()" style="float: center">Buscar cliente</button>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="" id = "disponible" style="color: green; display: none;">Póliza disponible</label>
            <label for="" id = "noDisponible" style="color: red; display: none;">Póliza no disponible</label>
        </div>
        <div class="bd-example bd-example-padded-bottom">
            {{-- @if ($perm_btn['addition']==1) --}}
            {{-- @endif --}}
        </div>
        <br><br>
        {{-- card fijo en la pantalla CLIENTE--}}
        <div id="mostrarinfo" style="display: none;">
            <div class="card">
                <div class="card-header" style="color: white">
                Cliente
                </div>

                <div class="card-body">
                    <div class="col-lg-12" id = "fisica" style = "display: none;">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" id="name1" name="name1" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Apellido paterno</label>
                                    <input type="text" id="firstname1" name="firstname1" class="form-control" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Apellido materno</label>
                                    <input type="text" id="lastname1" name="lastname1" class="form-control" placeholder="Apellido">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Fecha de nacimiento</label>
                                    <input type="date" id="birth_date1" name="birth_date1" class="form-control" placeholder="Fecha de nacimiento">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">RFC</label>
                                    <input type="text" id="rfc1" name="rfc1" class="form-control" placeholder="RFC">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">CURP</label>
                                    <input type="text" id="curp1" name="curp1" class="form-control" placeholder="CURP">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Genero</label>
                                    <select name="gender1" id="gender1" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Estado Civil</label>
                                    <select name="marital_status1" id="marital_status1" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        <option value="1">Soltero(a)</option>
                                        <option value="2">Casado(a)</option>
                                        <option value="3">Divorciado(a)</option>
                                        <option value="4">Viudo(a)</option>
                                        <option value="5">Unión Libre</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Calle</label>
                                    <input type="text" id="street1" name="street1" class="form-control" placeholder="Calle">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Exterior</label>
                                    <input type="text" id="e_num1" name="e_num1" class="form-control" placeholder="Número Exterior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Interior</label>
                                    <input type="text" id="i_num1" name="i_num1" class="form-control" placeholder="Número Interior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Código Postal</label>
                                    <input type="text" id="pc1" name="pc1" class="form-control" placeholder="Código Postal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Colonia</label>
                                    <input type="text" id="suburb1" name="suburb1" class="form-control" placeholder="Colonia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Municipio</label>
                                    <input type="text" id="city1" name="city1" class="form-control" placeholder="Municipio">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" id="state1" name="state1" class="form-control" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">País</label>
                                    <input type="text" id="country1" name="country1" class="form-control" placeholder="País">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input type="text" id="cellphone1" name="cellphone1" class="form-control" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" id="email1" name="email1" class="form-control" placeholder="Correo">
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-12" id = "moral" style = "display: none;">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Razón Social</label>
                                    <input type="text" id="business_name1" name="business_name1" class="form-control" placeholder="Razón Social">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Fecha de creación</label>
                                    <input type="date" id="date1" name="date1" class="form-control" placeholder="Fecha de creación">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">RFC</label>
                                    <input type="text" id="erfc1" name="erfc1" class="form-control" placeholder="RFC">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Calle</label>
                                    <input type="text" id="estreet1" name="estreet1" class="form-control" placeholder="Calle">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Exterior</label>
                                    <input type="text" id="ee_num1" name="ee_num1" class="form-control" placeholder="Número Exterior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Interior</label>
                                    <input type="text" id="ei_num1" name="ei_num1" class="form-control" placeholder="Número Interior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Código Postal</label>
                                    <input type="text" id="epc1" name="epc1" class="form-control" placeholder="Código Postal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Colonia</label>
                                    <input type="text" id="esuburb1" name="esuburb1" class="form-control" placeholder="Colonia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Municipio</label>
                                    <input type="text" id="ecity1" name="ecity1" class="form-control" placeholder="Municipio">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" id="estate1" name="estate1" class="form-control" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">País</label>
                                    <input type="text" id="ecountry1" name="ecountry1" class="form-control" placeholder="País">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input type="text" id="ecellphone1" name="ecellphone1" class="form-control" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" id="eemail1" name="eemail1" class="form-control" placeholder="Correo">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nombre del contacto</label>
                                    <input type="text" id="name_contact1" name="name_contact1" class="form-control" placeholder="Nombre Completo">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular de contacto</label>
                                    <input type="text" id="phone_contact1" name="phone_contact1" class="form-control" placeholder="Celular de contacto">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            {{-- termina el card CLIENTE--}}

            {{-- card de llenado de poliza --}}
            <div class="card">
                <div class="card-header" style="color: white">
                    Calculo de poliza
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Referencia</label>
                            <input type="text" name="reference" id="reference" class="form-control" placeholder="Referencia">
                        </div>
                        <div class="col-md-3">
                            <label for="">Prima neta</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" id="pna" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" class="form-control" placeholder="Prima neta" onchange="calculo()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for=""> Expedición</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" name="expedition" id="expedition" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" class="form-control" placeholder="Gastos de Expedición" onchange="calculo()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Imputar </label>
                            <select class="form-select" aria-label="Default select example" id="exp_impute">
                                <option value="1">Primera</option>
                                <option value="2">Todas</option>
                            </select>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">G. Financiamiento</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" name="financ_exp" id="financ_exp" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" class="form-control" placeholder="Gastos de Financiamiento" onchange="calculo()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Imputar </label>
                            <select class="form-select" aria-label="Default select example" id="financ_impute">
                                <option value="1">Primera</option>
                                <option value="2">Todas</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Otros</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" name="other_exp" id="other_exp" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" class="form-control" placeholder="Otros Gastos" onchange="calculo()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Imputar</label>
                            <select class="form-select" aria-label="Default select example" id="other_impute">
                                <option value="1">Primera</option>
                                <option value="2">Todas</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">IVA</label>
                            <input type="text" name="iva" id="iva" class="form-control" placeholder="IVA" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">IVA %</label>
                            <input type="text" name="ivapor" id="ivapor" value=".16" class="form-control" placeholder="IVA %" onchange="calculo()">
                        </div>
                        <div class="col-md-4">
                            <label for="">Prima Total</label>
                            <input type="text" name="prima_t" id="prima_t" class="form-control" placeholder="Prima Total" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Divisa</label>
                            <select class="form-select" id="selectCurrency" aria-label="Default select example">
                                <option selected hidden value="">Selecciona una Divisa</option>
                                @foreach ($currencies as $id => $currency)
                                    <option value='{{ $id }}'>{{ $currency }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Renovable: </label>
                            <select class="form-select" aria-label="Default select example" id="renovable">
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                            {{-- <label for="">Renovable</label>
                             <br>
                            <input id = "onoff" type="checkbox" checked data-toggle="toggle" data-on = "Si" data-off="No" data-width="100" data-offstyle="secondary"> --}}
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Conducto de cobro</label>
                                <select name="selectCharge" id="selectCharge" class="form-select">
                                    <option hidden selected value="">Selecciona una opción</option>
                                    @foreach ($charges as $id => $charge)
                                        <option value='{{ $id }}'>{{ $charge }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Compañía:</label>
                                <select name="selectInsurance" id="selectInsurance" class="form-select" onchange="llenarRamos()">
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
                                <select name="selectBranch" id="selectBranch" class="form-select" onchange="llenarPlanes()">
                                    <option selected value="">Selecciona una opción</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Plan/Contrato</label>
                                <select name="selectPlan" id="selectPlan" class="form-select">
                                    <option selected value="">Selecciona una opción</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Forma de pago</label>
                                <select name="pay_frec" id="pay_frec" class="form-select">
                                    <option hidden selected value="">Selecciona una opción</option>
                                    @foreach ($paymentForms as $id => $payment_form)
                                        <option value='{{ $id }}'>{{ $payment_form }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="">Vendida por: </label>
                            <select class="form-select" id="selectAgent" aria-label="Default select example">
                                <option selected hidden value="">Selecciona un Agente</option>
                                @foreach ($agents as $id => $agent)
                                            <option value='{{ $id }}'>{{ $agent }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fecha Inicio Vigencia</label>
                                <input type="date" id="initial_date" name="initial_date" class="form-control" placeholder="Fecha de creación" onchange="fechafin()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fecha fin Vigencia</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" placeholder="Fecha de creación">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" onclick="mostrartabla()">Actualizar Recibos</button>
                                <input id = "onoffType" type="checkbox" data-toggle="toggle" data-on = "Inicial" data-off="Renovación" data-width="150" onchange="prueba()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style="color: white">
                    Recibos
                </div>
                <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-striped table-hover text-center" style="width:100%" id="tablerecords">
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
                <div class="card-footer text-center">
                    <button type="button" onclick="guardar()" id="btn_save" class="btn btn-primary float-right" disabled>Guardar</button>
                </div>
            </div>
        </div>




    </div>
    <script src="{{URL::asset('js/currencyformat.js')}}" ></script>
@endsection
@push('head')
    <script src="{{URL::asset('js/admin/client.js')}}" ></script>
    <script src="{{URL::asset('js/policies/policy.js')}}" ></script>
    {{-- <script src="{{URL::asset('js/processes/initials.js')}}" defer></script> --}}
@endpush
