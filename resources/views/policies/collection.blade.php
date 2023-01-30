@extends('home')
<head>
    <title>Cobranza | Elan</title>
</head>
@section('content')
    <div class="text-center"><h1>Cobranza</h1></div>
    {{-- modal auth --}}
    <div id="authModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="gridModalLabek">Autorizar Movimiento</h4>
                    <button type="button" class="close" onclick="cerrarAuth()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid bd-example-row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Fecha de autorización</label>
                                        <input type="date" id="auth" name="auth" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secundary" onclick="cerrarAuth()">Cancelar</button>
                    <button type="button" onclick="guardarAuth()" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div style="max-width: auto; margin: auto;">
        {{-- Inicia pantalla de inicio --}}
        <br><br>
          <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" id="tbProfreceipt">
                <thead>
                    <th class="text-center">RFC</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Agente</th>
                    <th class="text-center">Ramo</th>
                    <th class="text-center">Póliza</th>
                    <th class="text-center">Fecha inicial</th>
                    <th class="text-center">Fecha límite</th>
                    <th class="text-center">Prima total</th>
                    @if ($perm_btn['modify']==1 || $perm_btn['erase']==1)
                        <th class="text-center">Status</th>
                    @endif
                </thead>

                <tbody>
                    @foreach ($receipts as $receipt)
                        <tr id="{{$receipt->rid}}">
                            <td>{{$receipt->rfc}}</td>
                            <td>{{$receipt->clname}}</td>
                            <td>{{$receipt->agname}}</td>
                            <td>{{$receipt->brName}}</td>
                            <td>{{$receipt->policy}}</td>
                            <td>{{$receipt->initiald}}</td>
                            <td>{{$receipt->endd}}</td>
                            <td>${{number_format($receipt->pna_t, 2, '.', ',')}}</td>
                            @if ($perm_btn['modify']==1 || $perm_btn['erase']==1)
                                <td>
                                    @if ($receipt->rStatus == null)
                                        <button href="#|" class="btn btn-danger" onclick="payrecord({{$receipt->rid}})" ><i class="fas fa-piggy-bank"></i></button>
                                    @else
                                        <button href="#|" class="btn btn-success btn-sm" onclick="cancelAuth({{$receipt->rid}})" >{{$receipt->rStatus}}</button>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/policies/collection.js')}}"></script>
    <script src="{{URL::asset('js/policies/viewpolicy.js')}}"></script>
@endpush

