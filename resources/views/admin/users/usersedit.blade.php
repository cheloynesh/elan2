<div id="myModaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Registro de Usuarios</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarUsuario()"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" id="email1" name="email1" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Contraseña</label>
                                    <input type="text" id="password1" name="password1" class="form-control" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" id="name1" name="name1" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Apellido paterno</label>
                                    <input type="text" id="firstname1" name="firstname1" class="form-control" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Apellido materno</label>
                                    <input type="text" id="lastname1" name="lastname1" class="form-control" placeholder="Apellido">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input type="text" id="cellphone1" name="cellphone1" class="form-control" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Fecha de nacimiento</label>
                                    <input type="date" id="b_day1" name="b_day1" class="form-control" placeholder="Fecha de nacimiento">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Perfil:</label>
                                    <select name="selectProfile1" id="selectProfile1" class="form-select" onchange="showimpEdit()">
                                        <option hidden selected value="">Selecciona una opción</option>
                                        @foreach ($profiles as $id => $profile)
                                            <option value='{{ $id }}'>{{ $profile }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="claveAgente1" style="display: none">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" id="etiqueta">Clave de Agente</label>
                                            <input type="text" id="code1" name="code1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" id="etiqueta3">Compañía</label>
                                            <select name="insurance1" id="insurance1" class="form-select">
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
                                            <select name="selectSubProfile" id="selectSubProfileedit" class="form-select" class="form-control">
                                                <option hidden selected value="">Selecciona una opción</option>
                                                <option value="1">Nuevo</option>
                                                <option value="2">En crecimiento</option>
                                                <option value="3">Consolidado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <div class="form-group">
                                            <button type="button" id="agregarcol1" class="btn btn-primary" onclick="agregarcodigo1()">Agregar</button>
                                        </div>
                                    </div>

                                </div>
                                {{-- inicio tabla --}}
                                <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
                                    <table class="table table-striped table-hover text-center" style="width:100%" id="tbcodes1">
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
            <div class="modal-footer">
                <button type="button" onclick="cancelarUsuario()" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="actualizarUsuario()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
