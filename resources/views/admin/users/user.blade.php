@extends('home')
<head>
    <title>Usuarios | Elan</title>
</head>
<style>
        thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Celular</label>
                                            <input type="text" id="cellphone" name="cellphone" class="form-control" placeholder="Celular">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de nacimiento</label>
                                            <input type="date" id="b_day" name="b_day" class="form-control" placeholder="Fecha de nacimiento">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Perfil:</label>
                                            <select name="selectProfile" id="selectProfile" class="form-select" onchange="showimp()">
                                                <option hidden selected value="">Selecciona una opción</option>
                                                @foreach ($profiles as $id => $profile)
                                                    <option value='{{ $id }}'>{{ $profile }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="claveAgente" style="display: none">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" id="etiqueta">Clave de Agente</label>
                                                <input type="text" id="code" name="code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" id="etiqueta3">Compañía</label>
                                                <select name="insurance" id="insurance" class="form-select">
                                                    <option hidden selected value="">Selecciona una opción</option>
                                                    @foreach ($insurances as $id => $insurance)
                                                        <option value='{{ $id }}'>{{ $insurance }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" id="etiqueta2">SubPerfil</label>
                                                <select name="selectSubProfile" id="selectSubProfile" class="form-select" class="form-control">
                                                    <option hidden selected value="">Selecciona una opción</option>
                                                    <option value="1">Nuevo</option>
                                                    <option value="2">En crecimiento</option>
                                                    <option value="3">Consolidado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 align-self-end">
                                            <div class="form-group">
                                                <button type="button" id="agregarcol" class="btn btn-primary" onclick="agregarcodigo()">Agregar</button>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- inicio tabla --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
                                                <table class="table table-striped table-hover text-center" style="width:100%" id="tbcodes">
                                                    <thead>
                                                        <th class="text-center">Clave de agente</th>
                                                        <th class="text-center">Compañía</th>
                                                        <th class="text-center">Opciones</th>
                                                    </thead>
                                                    <tbody id="tbody-codigo"></tbody>
                                                </table>
                                            </div>
                                        </div>
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
            @if($perm_btn['addition']==1)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Nuevo</button>
            @endif
        </div>
        <br><br>
          <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" style="width:100%" id="tbUsers">
                <thead>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Clave Met</th>
                    @if ($perm_btn['erase']==1 || $perm_btn['modify']==1)
                        <th class="text-center">Opciones</th>
                    @endif
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr id="{{$user->id}}">
                            <td>{{$user->name}}</td>
                            <td>{{$user->firstname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->code}}</td>
                            @if ($perm_btn['erase']==1 || $perm_btn['modify']==1)
                                <td>
                                    @if ($perm_btn['modify']==1)
                                        <button href="#|" class="btn btn-warning" onclick="editarUsuario({{$user->id}})" ><i class="fa fa-edit"></i></button>
                                    @endif
                                    @if ($perm_btn['erase']==1)
                                        <button href="#|" class="btn btn-danger" onclick="eliminarUsuario({{$user->id}})"><i class="fa fa-trash"></i></button>
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
    <script src="{{URL::asset('js/admin/users.js')}}"></script>
@endpush



