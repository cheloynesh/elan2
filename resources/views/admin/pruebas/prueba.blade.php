@extends('home')
@section('content')
@include('admin.profile.profileedit')

    <div class="text-center"><h1>Catálogo de Perfiles</h1></div>
    {{-- <div style="max-width: 1200px; margin: auto;"> --}}
        {{-- modal| --}}
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="gridModalLabek">Registro de Perfiles</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" id="name" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Perfil:</label>
                                            <select name="selectProfile" id="selectProfile" class="form-control"
                                            onchange="showimp()">
                                                <option hidden selected>Selecciona una opción</option>
                                                @foreach ($prof as $id => $prf)
                                                    <option value='{{ $id }}'>{{ $prf }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="" style="display: none" id="etiqueta">Código</label>
                                            <input type="text" id="code" name="code" class="form-control" style="display: none;">
                                            <br>
                                            <button type="button" id="agregarcol" class="btn btn-primary" onclick="agregarcodigo()" style="display: none;">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- inicio tabla --}}
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover text-center" id="tbcodes" style="display: none">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Código</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-codigo"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                        <button type="button" onclick="guardarperfil()" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- fin modal| --}}
        {{-- Inicia pantalla de inicio --}}
        <div class="bd-example bd-example-padded-bottom">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Nuevo</button>
        </div>
        <br><br>

        <ul class="nav nav-tabs" id="mytab" role="tablist">
            <li class="nav-item">
                <a class="active nav-link active" id="prueba1-tab" data-toggle="tab" href="#prueba1" role="tab" aria-controls="prueba1"
                 aria-selected="true">Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="prueba2" data-toggle="tab" href="#pruebas2" role="tab" aria-controls="pruebas2"
                 aria-selected="false">Tabla 2</a>
            </li>
        </ul>

        <div class="tab-content" id="mytabcontent">

            <div class="tab-pane active " id="prueba1" role="tabpanel" aria-labelledby="prueba1-tab">
                <div class="container-fluid">
                    <div class="table-responsive" style="margin-bottom: 10px">
                        <table class="table table-striped table-hover text-center" id="tbProf">
                            <thead>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Opciones</th>
                            </thead>

                            <tbody>
                                @foreach ($profiles as $profile)
                                    <tr id="{{$profile->id}}">
                                        <td>{{$profile->name}}</td>
                                        <td>
                                            <a href="#|" class="btn btn-warning" onclick="editarperfil({{$profile->id}})" >Editar</a>
                                            <a href="#|" class="btn btn-danger" onclick="eliminarperfil({{$profile->id}})">Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="pruebas2" role="tabpanel" aria-labelledby="prueba2">
                <div class="container-fluid">
                    <div class="table-responsive" style="margin-bottom: 10px">
                        <table class="table table-striped table-hover text-center" id="tbProf">
                            <thead>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Opciones</th>
                            </thead>

                            <tbody>
                                @foreach ($insurances as $insurance)
                                    <tr id="{{$insurance->id}}">
                                        <td>{{$insurance->name}}</td>
                                        <td>
                                            <a href="#|" class="btn btn-warning" onclick="editarAseguradora({{$insurance->id}})" >Editar</a>
                                            <a href="#|" class="btn btn-danger" onclick="eliminarAseguradora({{$insurance->id}})">Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    {{-- </div> --}}
@endsection
@push('head')
    <script src="{{URL::asset('js/admin/prueba.js')}}"></script>
@endpush






{{-- tabla --}}

{{-- <div class="table-responsive" style="margin-bottom: 10px; max-width: 1200px; margin: auto;">
    <table class="table table-striped table-hover text-center" id="tbProf">
        <thead>
            <th class="text-center">Nombre</th>
            <th class="text-center">Opciones</th>
        </thead>

        <tbody>
            @foreach ($profiles as $profile)
                <tr id="{{$profile->id}}">
                    <td>{{$profile->name}}</td>
                    <td>
                        <a href="#|" class="btn btn-warning" onclick="editarperfil({{$profile->id}})" >Editar</a>
                        <a href="#|" class="btn btn-danger" onclick="eliminarperfil({{$profile->id}})">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}

{{-- <div class="bs-example"> --}}
    {{-- <ul class="nav">
       <li class="active"><a data-toggle="tab" href="#sectionA" aria-selected="true"><h2>Buildings</h2></a></li>
       <li><a data-toggle="tab" href="#sectionB" aria-selected="false"><h2>Products/Services</h2></a></li>
    </ul> --}}

    {{-- <div class="tab-content"> --}}
        {{-- seccion a  --}}
       {{-- <div id="sectionA" class="tab-pane fade in active"> --}}


       {{-- </div> --}}
       <!--section b-->
       {{-- <div id="sectionB" class="tab-pane fade"> --}}

       {{-- </div> --}}
    {{-- </div> --}}
 {{-- </div> --}}
