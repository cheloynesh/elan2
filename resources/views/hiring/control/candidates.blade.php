@extends('home')
{{-- @section('title','Candidatos') --}}
<head>
    <title>Candidatos | Elan</title>
</head>
@section('content')
    <div class="text-center"><h1>Catálogo de Candidatos</h1></div>
    <div style="max-width: 100%; margin: auto;">
        {{-- modal| --}}
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="gridModalLabek">Registro de Candidatos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" id="name" name="name" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellido Paterno</label>
                                            <input type="text" id="firstname" name="firstname" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellido Materno</label>
                                            <input type="text" id="lastname" name="lastname" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <input type="text" id="mail" name="mail" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Ciudad de Procedendia</label>
                                            <input type="text" id="city" name="city" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Edad</label>
                                            <input type="text" id="age" name="age" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Último grado de escolaridad</label>
                                            <input type="text" id="scholariy" name="scholariy" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Sociable</label>
                                            <input type="text" id="social" name="social" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Experiencia en ventas</label>
                                            <input type="text" id="sales_exp" name="sales_exp" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Origen</label>
                                            <input type="text" id="origin" name="origin" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">CV</label><br>
                                            <a href="" id="viewPDF" target="_blank">Ver CV</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>
        {{-- fin modal| --}}
        {{-- @include('admin.candidate.candidateedit') --}}
        {{-- Inicia pantalla de inicio --}}
        @include('processes.OT.status.status')
        <br><br>
        <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" id="tbProf">
                <thead>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">Fecha de Solicitud</th>
                    <th class="text-center">Estatus</th>
                    <th class="text-center">Opciones</th>
                </thead>

                <tbody>
                    @foreach ($candidates as $candidate)
                        <tr id="{{$candidate->candId}}">
                            <td>{{$candidate->candName}}</td>
                            <td>{{$candidate->application_date}}</td>
                            <td>
                                <button class="btn btn-info" style="background-color: #{{$candidate->color}}; border-color: #{{$candidate->color}}" onclick="opcionesEstatus({{$candidate->candId}},{{$candidate->id}})">{{$candidate->name}}</button>
                            </td>
                            @if ($perm_btn['erase']==1 || $perm_btn['modify']==1)
                                <td>
                                    @if ($perm_btn['modify']==1)
                                        <button href="#|" class="btn btn-success" onclick="editarCandidato({{$candidate->candId}})"><i class="fas fa-eye"></i></button>
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
    <script src="{{URL::asset('js/hiring/candidates.js')}}"></script>
@endpush
