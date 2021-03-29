@extends('home')
@section('content')
    <div class="text-center"><h1>Catálogo de Usuarios</h1></div>
    <div style="max-width: 1200px; margin: auto;">
        {{-- modal| --}}
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="gridModalLabek">Registro de Usuarios</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="col-lg-12">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="text" id="password" name="password" class="form-control" placeholder="Contraseña">
                                        </div>
                                    </div>
                                </div>

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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Celular</label>
                                            <input type="text" id="cellphone" name="cellphone" class="form-control" placeholder="Celular">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Perfil:</label>
                                            <select name="selectProfile" id="selectProfile" class="form-control" onchange="showimp()">
                                                <option hidden selected>Selecciona una opción</option>
                                                @foreach ($profiles as $id => $profile)
                                                    <option value='{{ $id }}'>{{ $profile }}</option>
                                                @endforeach
                                            </select>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                        <button type="button" onclick="guardarUsuario()" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- fin modal| --}}
        @include('admin.users.usersedit')
        {{-- Inicia pantalla de inicio --}}
        <div class="bd-example bd-example-padded-bottom">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Nuevo</button>
        </div>
        <br><br>
          <div class="table-responsive" style="margin-bottom: 10px; max-width: 1200px; margin: auto;">
            <table class="table table-striped table-hover text-center" id="tbProf">
                <thead>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Opciones</th>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr id="{{$user->id}}">
                            <td>{{$user->name}}</td>
                            <td>
                                <a href="#|" class="btn btn-warning" onclick="editarUsuario({{$user->id}})" >Editar</a>
                                <a href="#|" class="btn btn-danger" onclick="eliminarUsuario({{$user->id}})">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/admin/users.js')}}"></script>
@endpush

