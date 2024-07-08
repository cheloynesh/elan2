@extends('home')
@section('content')
@include('admin.profile.profileedit')

    <div class="text-center"><h1>Pruebas</h1></div>
    <div style="max-width: 100%; margin: auto;">
        {{-- modal| --}}
        {{-- <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="gridModalLabek">Registro de Perfiles</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tipo de contratante</label>
                                            &nbsp;
                                            <input id = "onoff" type="checkbox" checked data-toggle="toggle" data-on = "fisica" data-off="moral" onchange="mostrarDiv()" data-width="80" data-offstyle="secondary">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">¿El contratante es igual al asegurado?</label>
                                            &nbsp;
                                            <input id = "onoffAsegurado" type="checkbox" checked data-toggle="toggle" data-on = "si" data-off="no" onchange="mostrarDivAsegurado()" data-width="80" data-offstyle="secondary">
                                        </div>
                                    </div>
                                </div>
                                <div class = "row" id = "fisica">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Apellido paterno</label>
                                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Apellido materno</label>
                                            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">RFC</label>
                                            <input type="text" id="rfc" name="rfc" class="form-control" placeholder="RFC">
                                        </div>
                                    </div>
                                </div>
                                <div class = "row" id = "moral" style = "display: none;">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Razón Social</label>
                                            <input type="text" id="business_name" name="business_name" class="form-control" placeholder="Razón Social">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">RFC</label>
                                            <input type="text" id="rfc" name="rfc" class="form-control" placeholder="RFC">
                                        </div>
                                    </div>
                                </div>
                                <div id = "asegurado" style = "display: none;">
                                    <div class = "row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Nombre del Asegurado</label>
                                                <input type="text" id="nameA" name="name" class="form-control" placeholder="Nombre">
                                            </div>
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
        </div> --}}
        {{-- <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="gridModalLabek">Registro de Perfiles</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
                            <table class="table table-striped table-hover text-center" style="width:100%" id="tbProf">
                                <thead>
                                    <th class="text-center">Nombre</th>
                                        <th class="text-center">Opciones</th>
                                </thead>

                                <tbody>
                                    @foreach ($profiles as $profile)
                                        <tr id="{{$profile->id}}">
                                            <td>{{$profile->name}}</td>
                                                <td>
                                                        <button href="#|" class="btn btn-warning" onclick="editarperfil({{$profile->id}})" ><i class="fa fa-edit"></i></button>
                                                        <button href="#|" class="btn btn-danger" onclick="eliminarperfil({{$profile->id}})"><i class="fa fa-trash"></i></button>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                        <button type="button" onclick="guardarperfil()" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- fin modal| --}}
        {{-- Inicia pantalla de inicio --}}
        {{-- <div class="bd-example bd-example-padded-bottom">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Nuevo</button>
        </div>
        <div class="bd-example bd-example-padded-bottom">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Prueba tabla</button>
        </div> --}}
        <br><br>

        {{-- <ul class="nav nav-tabs" id="mytab" role="tablist">
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
                        <table class="table table-striped table-hover text-center" style="width:100%" id="tbProf">
                            <thead>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Opciones</th>
                            </thead>

                            <tbody>
                                @foreach ($profiles as $profile)
                                    <tr id="{{$profile->id}}">
                                        <td>{{$profile->name}}</td>
                                        <td>
                                            <button href="#|" class="btn btn-warning" onclick="editarperfil({{$profile->id}})" ><i class="fa fa-edit"></i></button>
                                            <button href="#|" class="btn btn-danger" onclick="eliminarperfil({{$profile->id}})"><i class="fa fa-trash"></i></button>
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
                        <table class="table table-striped table-hover text-center" style="width:100%" id="tbProf">
                            <thead>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Opciones</th>
                            </thead>

                            <tbody>
                                @foreach ($insurances as $insurance)
                                    <tr id="{{$insurance->id}}">
                                        <td>{{$insurance->name}}</td>
                                        <td>
                                            <button href="#|" class="btn btn-warning" onclick="editarAseguradora({{$insurance->id}})" ><i class="fa fa-edit"></i></button>
                                            <button href="#|" class="btn btn-danger" onclick="eliminarAseguradora({{$insurance->id}})"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> --}}
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
        <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" style="width:100%" id="tbProf">
                <thead>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Etapa</th>
                    <th class="text-center">Estatus</th>

                    <th class="text-center">Año</th>
                    <th class="text-center">Mes</th>
                    <th class="text-center">Fuente</th>
                    <th class="text-center">DDN/ELAN</th>

                    <th class="text-center">Teléfono</th>
                    <th class="text-center">RFC</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Sexo</th>
                    <th class="text-center">Edad</th>
                    <th class="text-center">Ciudad</th>
                    <th class="text-center">Estudios</th>
                    <th class="text-center">CV</th>

                    <th class="text-center">1er Entrevista</th>
                    <th class="text-center">PDA</th>
                    <th class="text-center">2da Entrevista</th>
                    <th class="text-center">Encargado</th>
                    <th class="text-center">Confirmado</th>

                    <th class="text-center">Documentos</th>
                    <th class="text-center">Induccion</th>
                    <th class="text-center">Cita Ventas</th>
                    <th class="text-center">Ventas</th>
                    <th class="text-center">Inscrito CIA</th>
                    <th class="text-center">CIA</th>
                    <th class="text-center">Clave de Arranque</th>
                    <th class="text-center">Fecha C-Arranque</th>

                    <th class="text-center">C-Cedula</th>
                    <th class="text-center">Fecha Examamen</th>
                    <th class="text-center">Examen</th>
                    <th class="text-center">Cita CNSF</th>
                    <th class="text-center">Cedula</th>

                    <th class="text-center">Clave de Agente</th>
                    <th class="text-center">Alta Metlife</th>
                    <th class="text-center">Graduado Met</th>
                </thead>

                <tbody>
                    <tr>
                        <td>Paola Montserrat Arceo Gómez</td>
                        <td><button href="#|" class="btn btn-primary" style="background-color: #F36011; border-color: #F36011; font-size: 0.8rem;">Primer Proceso</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">Activo</button></td>

                        <td>2023</td>
                        <td>Agosto</td>
                        <td>ELAN</td>
                        <td>Victor</td>

                        <td>3336267901</td>
                        <td>AEGA970706CA3</td>
                        <td>dicarloarceo@gmail.com</td>
                        <td>M</td>
                        <td>26</td>
                        <td>Guadalajara</td>
                        <td>Licenciatura</td>
                        <td><a href="#|" class="btn btn-primary">Ver CV</a></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">VICTOR</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>

                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-primary" style="font-size: 0.8rem;">-</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>

                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>

                        <td><a href="#|" class="btn btn-primary" style="font-size: 0.8rem;">-</a></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                    </tr>
                    <tr>
                        <td>Armando Dicarlo Arceo Gómez</td>
                        <td><button href="#|" class="btn btn-primary" style="background-color: #a8cf8f; border-color: #a8cf8f; font-size: 0.8rem;">Proceso Final</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">Activo</button></td>

                        <td>2023</td>
                        <td>Agosto</td>
                        <td>ELAN</td>
                        <td>Victor</td>

                        <td>3336267901</td>
                        <td>AEGA970706CA3</td>
                        <td>dicarloarceo@gmail.com</td>
                        <td>M</td>
                        <td>26</td>
                        <td>Guadalajara</td>
                        <td>Licenciatura</td>
                        <td><a href="#|" class="btn btn-primary">Ver CV</a></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">VICTOR</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-primary" style="font-size: 0.8rem;">123456</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>

                        <td><a href="#|" class="btn btn-primary" style="font-size: 0.8rem;">123456</a></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                    </tr>
                    <tr>
                        <td>Liliana Donají Gómez de Dios</td>
                        <td><button href="#|" class="btn btn-primary" style="background-color: #0991b3; border-color: #0991b3; font-size: 0.8rem;">Cedula</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">Activo</button></td>

                        <td>2023</td>
                        <td>Agosto</td>
                        <td>ELAN</td>
                        <td>Victor</td>

                        <td>3336267901</td>
                        <td>AEGA970706CA3</td>
                        <td>dicarloarceo@gmail.com</td>
                        <td>M</td>
                        <td>26</td>
                        <td>Guadalajara</td>
                        <td>Licenciatura</td>
                        <td><a href="#|" class="btn btn-primary">Ver CV</a></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">VICTOR</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-primary" style="font-size: 0.8rem;">123456</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>

                        <td><a href="#|" class="btn btn-primary" style="font-size: 0.8rem;">-</a></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                    </tr>
                    <tr>
                        <td>María Guadalupe de Dios Cupido</td>
                        <td><button href="#|" class="btn btn-primary" style="background-color: #f7af07; border-color: #f7af07; font-size: 0.8rem;">Segundo Proceso</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">Activo</button></td>

                        <td>2023</td>
                        <td>Agosto</td>
                        <td>ELAN</td>
                        <td>Victor</td>

                        <td>3336267901</td>
                        <td>AEGA970706CA3</td>
                        <td>dicarloarceo@gmail.com</td>
                        <td>M</td>
                        <td>26</td>
                        <td>Guadalajara</td>
                        <td>Licenciatura</td>
                        <td><a href="#|" class="btn btn-primary">Ver CV</a></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">VICTOR</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>

                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">2023-08-20</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-success" style="font-size: 0.8rem;">SI</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-primary" style="font-size: 0.8rem;">-</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>

                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>

                        <td><a href="#|" class="btn btn-primary" style="font-size: 0.8rem;">-</a></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                        <td><button href="#|" class="btn btn-danger" style="font-size: 0.8rem;">NO</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endsection
    @push('head')
    <script src="{{URL::asset('js/admin/prueba.js')}}"></script>
    @endpush






{{-- tabla --}}

{{-- <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
    <table class="table table-striped table-hover text-center" style="width:100%" id="tbProf">
        <thead>
            <th class="text-center">Nombre</th>
            <th class="text-center">Opciones</th>
        </thead>

        <tbody>
            @foreach ($profiles as $profile)
                <tr id="{{$profile->id}}">
                    <td>{{$profile->name}}</td>
                    <td>
                        <button href="#|" class="btn btn-warning" onclick="editarperfil({{$profile->id}})" ><i class="fa fa-edit"></i></button>
                        <button href="#|" class="btn btn-danger" onclick="eliminarperfil({{$profile->id}})"><i class="fa fa-trash"></i></button>
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
