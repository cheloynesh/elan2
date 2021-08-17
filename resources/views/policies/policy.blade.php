@extends('home')
@section('content')
    <div class="text-center"><h1>Póliza</h1></div>
    <div style="max-width: 1200px; margin: auto;">
        @include('policies.searchclient')

        {{-- Inicia pantalla de inicio --}}
        <div class="row">
            <div class="col-md-6">
                <input type="text" placeholder="Número de póliza">
                <button type="button" class="btn btn-primary">Verificar</button>
            </div>
            <div class="col-md-6">
                <label for="">Clientes</label>
                <br>
                  <button type="button" class="btn btn-primary" onclick="buscarclientes()" style="float: center">Buscar cliente</button>
            </div>
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
                    <div class="col-lg-12" id = "fisica">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Apellido paterno</label>
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Apellido materno</label>
                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellido">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Fecha de nacimiento</label>
                                    <input type="date" id="birth_date" name="birth_date" class="form-control" placeholder="Fecha de nacimiento">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">RFC</label>
                                    <input type="text" id="rfc" name="rfc" class="form-control" placeholder="RFC">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">CURP</label>
                                    <input type="text" id="curp" name="curp" class="form-control" placeholder="CURP">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Genero</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option hidden selected>Selecciona una opción</option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Estado Civil</label>
                                    <select name="marital_status" id="marital_status" class="form-control">
                                        <option hidden selected>Selecciona una opción</option>
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
                                    <input type="text" id="street" name="street" class="form-control" placeholder="Calle">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Exterior</label>
                                    <input type="text" id="e_num" name="e_num" class="form-control" placeholder="Número Exterior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Interior</label>
                                    <input type="text" id="i_num" name="i_num" class="form-control" placeholder="Número Interior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Código Postal</label>
                                    <input type="text" id="pc" name="pc" class="form-control" placeholder="Código Postal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Colonia</label>
                                    <input type="text" id="suburb" name="suburb" class="form-control" placeholder="Colonia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Municipio</label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Municipio">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" id="state" name="state" class="form-control" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">País</label>
                                    <input type="text" id="country" name="country" class="form-control" placeholder="País">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input type="text" id="cellphone" name="cellphone" class="form-control" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Correo">
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-12" id = "moral" style = "display: none;">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Razón Social</label>
                                    <input type="text" id="business_name" name="business_name" class="form-control" placeholder="Razón Social">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Fecha de creación</label>
                                    <input type="date" id="date" name="date" class="form-control" placeholder="Fecha de creación">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">RFC</label>
                                    <input type="text" id="erfc" name="erfc" class="form-control" placeholder="RFC">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Calle</label>
                                    <input type="text" id="estreet" name="estreet" class="form-control" placeholder="Calle">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Exterior</label>
                                    <input type="text" id="ee_num" name="ee_num" class="form-control" placeholder="Número Exterior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Interior</label>
                                    <input type="text" id="ei_num" name="ei_num" class="form-control" placeholder="Número Interior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Código Postal</label>
                                    <input type="text" id="epc" name="epc" class="form-control" placeholder="Código Postal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Colonia</label>
                                    <input type="text" id="esuburb" name="esuburb" class="form-control" placeholder="Colonia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Municipio</label>
                                    <input type="text" id="ecity" name="ecity" class="form-control" placeholder="Municipio">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" id="estate" name="estate" class="form-control" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">País</label>
                                    <input type="text" id="ecountry" name="ecountry" class="form-control" placeholder="País">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input type="text" id="ecellphone" name="ecellphone" class="form-control" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" id="eemail" name="eemail" class="form-control" placeholder="Correo">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nombre del contacto</label>
                                    <input type="text" id="name_contact" name="name_contact" class="form-control" placeholder="Nombre Completo">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular de contacto</label>
                                    <input type="text" id="phone_contact" name="phone_contact" class="form-control" placeholder="Celular de contacto">
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
                        <div class="col-md-4">
                            <label for="">Prima neta</label>
                            <input type="text" id="prima" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for=""> Expedición</label>
                            <input type="text" name="expedition" id="expedition" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Imputar </label>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                            {{-- <label for="">Imputar</label>
                            <br>
                            <input id = "onoff" type="checkbox" checked data-toggle="toggle" data-on = "Primero" data-off="Todos" data-width="100" data-offstyle="secondary"> --}}
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">G. Finan.$</label>
                            <input type="text" name="Gfinan$" id="Gfinan$" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imputar </label>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                            {{-- <label for="">Imputar</label>
                            <br>
                            <input id = "onoff" type="checkbox" checked data-toggle="toggle" data-on = "Primero" data-off="Todos" data-width="100" data-offstyle="secondary"> --}}
                        </div>
                        <div class="col-md-3">
                            <label for="">Otros</label>
                            <input type="text" name="otros" id="otros" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imputar</label>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                            {{-- <label for="">Imputar</label>
                            <br>
                            <input id = "onoff" type="checkbox" checked data-toggle="toggle" data-on = "Primero" data-off="Todos" data-width="100" data-offstyle="secondary"> --}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">IVA</label>
                            <input type="text" name="iva" id="iva" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">IVA %</label>
                            <input type="text" name="ivapor" id="ivapor" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Prima Total</label>
                            <input type="text" name="prima_t" id="prima_t" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Divisa</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Selecciona una Divisa</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Renovable: </label>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                            {{-- <label for="">Renovable</label>
                             <br>
                            <input id = "onoff" type="checkbox" checked data-toggle="toggle" data-on = "Si" data-off="No" data-width="100" data-offstyle="secondary"> --}}
                        </div>
                        <div class="col-md-4">
                            <label for="">Vendida por: </label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Selecciona un Agente</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Terminacard de llenado de poliza --}}

            {{-- card de la tabla y sus tipos de pago --}}
            <div class="card">
                <div class="card-header" style="color: white">
                    Póliza
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Frecuencial de pago</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Selecciona un cliente</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Conducto de pago</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Selecciona un cliente</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Forma de pago</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Selecciona un cliente</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
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
                </div>
            </div>
            {{--Termina card de la tabla y sus tipos de pago --}}
            
            {{-- tabla  --}}
            <div class="table-responsive" >
                <table class="table table-striped table-hover text-center" id="tablerecords">
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
                </table>
            </div>
        </div>



        
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/policies/policy.js')}}"></script>
@endpush
