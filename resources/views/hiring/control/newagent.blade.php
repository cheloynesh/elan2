@extends('home')
<head>
    <title>Agentes Nuevos | Elan</title>
</head>
@section('content')

{{-- modal si no --}}
<div id="yesnoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelar('#yesnoModal')"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Selecciona una opción</label>
                                    <select name="selectYesNo" id="selectYesNo" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        <option value=0>No</option>
                                        <option value=1>Si</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cancelar('#yesnoModal')" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="guardar('SaveYesNo','selectYesNo')" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin modal --}}
{{-- modal charge --}}
<div id="chargeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelar('#chargeModal')"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Selecciona una opción</label>
                                    <select name="selectCharge" id="selectCharge" class="form-select">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        <option value="victor">Victor</option>
                                        <option value="beto">Beto</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cancelar('#chargeModal')" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="guardar('SaveCharge','selectCharge')" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin modal --}}
{{-- modal charge --}}
<div id="dateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelar('#dateModal')"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Selecciona una fecha</label>
                                    <input type="date" id="datepick" name="datepick" class="form-control" placeholder="Fecha de creación">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cancelar('#dateModal')" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="guardar('SaveDate','datepick')" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin modal --}}
{{-- modal charge --}}
<div id="textModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelar('#textModal')"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Introduce la clave</label>
                                    <input type="text" name="keytext" id="keytext" class="form-control" placeholder="Clave">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cancelar('#textModal')" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="guardar('SaveText','keytext')" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin modal --}}

    <div class="text-center"><h1>Agentes Nuevos</h1></div>
    <div style="max-width: 100%; margin: auto;">
        <br><br>
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
                </tbody>
            </table>
        </div>
    </div>
    @endsection
    @push('head')
    <script src="{{URL::asset('js/hiring/newagent.js')}}"></script>
    @endpush
