@extends('home')
@section('content')
    <div class="text-center"><h1>Póliza</h1></div>
    <div style="max-width: 1200px; margin: auto;">
        {{-- Inicia pantalla de inicio --}}
        <div class="row">
            <div class="col-md-6">
                <input type="text" placeholder="Número de póliza">
                <button type="button" class="btn btn-primary">Verificar</button>
            </div>
            <div class="col-md-6">
                <label for="">Clientes</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Selecciona un cliente</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
            </div>
        </div>
        <div class="bd-example bd-example-padded-bottom">
            {{-- @if ($perm_btn['addition']==1) --}}
                <button type="button" class="btn btn-primary" onclick="abrirpoliza()">Nueva Póliza</button>
            {{-- @endif --}}
        </div>
        <br><br>
        {{-- card fijo en la pantalla --}}
        <div class="card" {{--style="display: none;"--}}>
            <div class="card-header">
              Cliente
            </div>
            <div id="mostrarcard">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">RFC</label>
                                <input type="text">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">RFC</label>
                                <input type="text">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">RFC</label>
                                <input type="text">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- termina el card --}}
        
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/policies/policy.js')}}"></script>
@endpush
