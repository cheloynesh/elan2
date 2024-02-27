<div id="modalSrcClient" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Buscar Clientes</h4>
                <button type="button" class="close" onclick="ocultar('#modalSrcClient')"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" id="srcClient">
                            <thead>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">RFC</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Accion</th>

                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr id="{{$client->id}}">
                                        <td>
                                            {{$client->name}} {{$client->firstname}} {{$client->lastname}}
                                        </td>
                                        <td>{{$client->rfc}}</td>
                                        @if ($client->status == 0)
                                            <td>Física</td>
                                        @else
                                            <td>Moral</td>
                                        @endif
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="obtenerid({{$client->id}})">Seleccionar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="noRegistrado()">No Registrado</button>
            </div>
        </div>
    </div>
</div>

<div id="modalClientType" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-s" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Tipo de Cliente</h4>
                <button type="button" class="close" onclick="ocultar('#modalSrcClient')"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Tipo de Cliente</label>
                        <select name="type" id="type" class="form-select">
                            <option selected value="0">Fisica</option>
                            <option value="1">Moral</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="RegistrarCliente()">Aceptar</button>
            </div>
        </div>
    </div>
</div>
