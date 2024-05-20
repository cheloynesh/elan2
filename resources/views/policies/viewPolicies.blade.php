@extends('home')
<head>
    <title>Polizas | ELAN</title>
</head>
@section('content')
    <div class="text-center"><h1>Pólizas</h1></div>
    @include('policies.modalPolicies')
    @include('processes.OT.status.status')
    @include('policies.searchclient')
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
    {{-- modal espera --}}
    <div id="waitModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="gridModalLabek">Importando Excel</h4>
                    {{-- <button type="button" onclick="cerrarNuc()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
                </div>

                <div class="modal-body">
                    <div class="container-fluid bd-example-row">
                        <div class="col-md-12">
                            <div class="row" id="waitrow">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <img src="{{ URL::asset('img/SpinnerLittle.gif') }}">
                                        <label> Se están procesando los datos, por favor espere.</label>
                                    </div>
                                </div>
                            </div>
                            <div id="resultrow" style="display: none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Recibos Actualizados</label>
                                            <input disabled type="text" id="importados" name="importados" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Pólizas no Encontrados</label>
                                            <input disabled type="text" id="notFnd" name="notFnd" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <table class="table table-striped table-hover text-center" style="width:100%" id="tbnotFnd">
                                                <thead>
                                                    <th class="text-center">Pólizas</th>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" hidden onclick="cerrarWait()" class="btn btn-secundary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- termina modal --}}

    {{-- @if (intval($user)==2)
        <br><br>

        <div class="bd-example bd-example-padded-bottom">
                <button type="button" class="btn btn-primary" onclick="actualizarStatusPoliza()">Actualizar</button>
            </div>

        <br><br>
    @endif --}}
    <br>
    <div class="bd-example bd-example-padded-bottom">
        @if ($perm_btn['addition']==1)
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class = "form-group">
                            <input type="file" name="excl" id="excl" accept=".xlsx, .xls, .csv" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class = "form-group">
                            <button class="btn btn-primary" title="Importar de Excel" onclick="importexc()"><i class="fas fa-upload"></i> <i class="fas fa-file-excel"></i></button>
                            <button type="button" class="btn btn-primary" onclick="abrirFiltro()" title="Exportar a Excel"><i class="fas fa-download"></i> <i class="fas fa-file-excel"></i></button>
                            {{-- <button class="btn btn-primary" title="Importar de Excel" onclick="act()">actualizar</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class = "form-group">
                        <input class="form-check-input" type="checkbox" onclick="chkActive()" id="chkActive"> Mostrar Cancelados
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- Inicia pantalla de inicio --}}
    <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
        <table class="table table-striped table-hover text-center" style="width:100%" id="tbPoliza">
            <thead>
                <th class="text-center">Agente</th>
                <th class="text-center">RFC</th>
                <th class="text-center"># Póliza</th>
                <th class="text-center">Referencia</th>
                <th class="text-center">Ramo</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Prima Total</th>
                <th class="text-center">Inicio Vigencia</th>
                <th class="text-center">Fin Vigencia</th>
                <th class="text-center">Estatus</th>
                <th class="text-center">Opciones</th>
            </thead>
            <tbody>
                @foreach ($policy as $policies)
                    <tr id="{{$policies->id}}">
                        <td>{{$policies->agname}}</td>
                        <td>{{$policies->rfc}}</td>
                        <td>{{$policies->policy}}</td>
                        <td>{{$policies->reference}}</td>
                        <td>{{$policies->branch}}</td>
                        <td>{{$policies->cname}}</td>
                        <td>@if ($policies->type==1)Inicial @else Renovación @endif</td>
                        <td>{{$policies->pnaa}}</td>
                        <td>{{$policies->initial_date}}</td>
                        <td>{{$policies->end_date}}</td>
                        <td>
                            <button class="btn btn-info" style="background-color: #{{$policies->color}}; border-color: #{{$policies->color}}" onclick="opcionesEstatus({{$policies->id}},{{$policies->statId}})">{{$policies->statName}}</button>
                        </td>
                        <td>
                            <a href="#|" class="btn btn-primary" onclick="verRecibos({{$policies->id}})"><i class="fas fa-eye"></i><i class="fas fa-dollar-sign"></i></a>
                            <button href="#|" class="btn btn-warning" onclick="editarPoliza({{$policies->id}})" ><i class="fa fa-edit"></i></button>
                            @if ($perm_btn['erase']==1)
                                <button href="#|" class="btn btn-danger" onclick="eliminarPoliza({{$policies->id}})"><i class="fa fa-trash"></i></button>
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
@endpush
