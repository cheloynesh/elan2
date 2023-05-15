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

    @if (intval($user)==2)
        <br><br>

        <div class="bd-example bd-example-padded-bottom">
                <button type="button" class="btn btn-primary" onclick="actualizarStatusPoliza()">Actualizar</button>
            </div>

        <br><br>
    @endif
    <br><br>
    <div class="col-lg-12">
        <div class="row">
            @if ($perm_btn['modify']==1)
                <div class="col-md-12">
                    <div class="form-group">
                        @if ($perm_btn['addition']==1)
                            <button type="button" class="btn btn-primary" onclick="abrirFiltro()" title="Exportar a Excel"><i class="fas fa-file-excel"></i></button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    <br><br>
        {{-- Inicia pantalla de inicio --}}
    <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
        <table class="table table-striped table-hover text-center" id="tbPoliza">
            <thead>
                <th class="text-center">Agente</th>
                <th class="text-center">RFC</th>
                <th class="text-center"># Póliza</th>
                <th class="text-center">Ramo</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">PNA</th>
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
                            <a href="#|" class="btn btn-primary" onclick="verRecibos({{$policies->id}})">Ver Recibos</a>
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
