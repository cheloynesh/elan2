@extends('home')
<style>
    thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<head>
    <title>Servicios | Elan</title>
</head>
@section('content')
    <div class="text-center"><h1>Servicios</h1></div>
    {{-- modal nuevo --}}
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="gridModalLabek">Registro de Servicios</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid bd-example-row">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Agente:</label>
                                    <select name="selectAgent" id="selectAgent" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
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
                                    <label for="">Fecha de Ingreso</label>
                                    <input type="date" id="entry_date" name="entry_date" class="form-control" placeholder="Fecha de Sistema">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Póliza/Contrato</label>
                                    <input type="text" id="policy" name="policy" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tipo de Servicio</label>
                                    <input type="text" id="type" name="type" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Folio/Id</label>
                                    <input type="text" id="folio" name="folio" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Número de Guía</label>
                                    <input type="text" id="guide" name="guide" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre del Contratante</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Expediente:</label>
                                    <select name="selectRecord" id="selectRecord" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        <option value="Fisico">Fisico</option>
                                        <option value="Digital">Digital</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Compañía:</label>
                                    <select name="selectInsurance" id="selectInsurance" class="form-select" onchange="llenarRamosService()">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        @foreach ($insurances as $id => $insurance)
                                            <option value='{{ $id }}'>{{ $insurance }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Ramo:</label>
                                    <select name="selectBranch" id="selectBranch" class="form-select">
                                        <option selected value="">Selecciona una opción</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de Respuesta</label>
                                    <input type="date" id="response_date" name="response_date" class="form-control" placeholder="Fecha de Promotoria">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Descargado</label>
                                    <select name="selectDownload" id="selectDownload" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="guardarServicio()" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fin modal| --}}
    {{-- modal excel --}}
    <div id="myModalExport" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="gridModalLabek">Exportar a Excel</h4>
                    <button type="button" class="close" onclick="cerrarFiltro()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid bd-example-row">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Estatus:</label>
                                    <select name="selectStatusExc" id="selectStatusExc" class="form-select">
                                        <option hidden selected value = 0>Selecciona una opción</option>
                                        @foreach ($estatusExc as $id => $estat)
                                            <option value='{{ $id }}'>{{ $estat }}</option>
                                        @endforeach
                                        <option value = 0>Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Branch:</label>
                                    <select name="selectBranchExc" id="selectBranchExc" class="form-select">
                                        <option hidden selected value = 0>Selecciona una opción</option>
                                        @foreach ($branchesExc as $id => $brnch)
                                            <option value='{{ $id }}'>{{ $brnch }}</option>
                                        @endforeach
                                        <option value = 0>Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secundary" onclick="cerrarFiltro()">Cancelar</button>
                    <button type="button" onclick="excel_nuc()" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fin modal| --}}
    @include('processes.OT.services.serviceEdit')
    @include('processes.OT.status.status')
    @include('policies.modalPolicies')
    @include('policies.searchclient')
    {{-- Inicia pantalla de inicio --}}
    <div class="bd-example bd-example-padded-bottom">

    </div>
    <div class="col-lg-12">
        <div class="row">
            @if ($perm_btn['modify']==1)
                <div class="col-md-12">
                    <div class="form-group">
                        @if ($perm_btn['addition']==1)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" title="Nuevo Servicio"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-primary" onclick="abrirFiltro()" title="Exportar a Excel"><i class="fas fa-file-excel"></i></button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    <br><br>
    <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
        <table class="table table-striped table-hover text-center" id="tbProf">
            <thead>
                <th class="text-center">Agente</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Póliza</th>
                <th class="text-center">Folio/Id</th>
                <th class="text-center">Tipo de Servicio</th>
                <th class="text-center">Compañía</th>
                <th class="text-center">Ramo</th>
                <th class="text-center">Estatus</th>
                <th class="text-center">Opciones</th>
            </thead>

            <tbody>
                @foreach ($services as $service)
                    <tr id="{{$service->id}}">
                        <td>{{$service->agent}}</td>
                        <td>{{$service->name}}</td>
                        <td>{{$service->policy}}</td>
                        <td>{{$service->folio}}</td>
                        <td>{{$service->type}}</td>
                        <td>{{$service->insurance}}</td>
                        <td>{{$service->branch}}</td>
                        <td>
                            <button class="btn btn-info" style="background-color: #{{$service->color}}; border-color: #{{$service->color}}" onclick="opcionesEstatus({{$service->id}},{{$service->statId}})">{{$service->statName}}</button>
                        </td>
                        {{-- <td>{{$initial->client}}</td> --}}
                        <td>
                            <button href="#|" type="button" class="btn btn-warning" onclick="editarServicio({{$service->id}})" ><i class="fa fa-edit"></i></button>
                            @if ($perm_btn['erase']==1)
                                <button href="#|" type="button" class="btn btn-danger" onclick="eliminarServicio({{$service->id}})"><i class="fa fa-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{URL::asset('js/currencyformat.js')}}" ></script>
    @endsection
@push('head')
    <script src="{{URL::asset('js/admin/client.js')}}" ></script>
    <script src="{{URL::asset('js/policies/viewpolicy.js')}}"></script>
    <script src="{{URL::asset('js/processes/services.js')}}"></script>
@endpush
