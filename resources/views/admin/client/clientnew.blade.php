<div id="modalNewClient" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabek">Registro de Persona Física</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tipo de cliente</label>
                                &nbsp;
                                <input id = "onoff" type="checkbox" checked data-toggle="toggle" data-on = "fisica" data-off="moral" onchange="mostrarDiv()" data-width="80" data-offstyle="secondary">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" id = "fisica">

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
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Fecha de nacimiento</label>
                                    <input type="date" id="birth_date" name="birth_date" class="form-control" placeholder="Fecha de nacimiento">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">RFC</label>
                                    <input type="text" id="rfc" name="rfc" class="form-control" placeholder="RFC">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">CURP</label>
                                    <input type="text" id="curp" name="curp" class="form-control" placeholder="CURP">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Genero</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option hidden selected>Selecciona una opción</option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Estado Civil</label>
                                    <select name="marital_status" id="marital_status" class="form-control">
                                        <option hidden selected>Selecciona una opción</option>
                                        <option value="1">Soltero(a)</option>
                                        <option value="2">Casado(a)</option>
                                        <option value="3">Divorciado(a)</option>
                                        <option value="4">Viudo(a)</option>
                                        <option value="5">Unión Libre</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Calle</label>
                                    <input type="text" id="street" name="street" class="form-control" placeholder="Calle">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Exterior</label>
                                    <input type="text" id="e_num" name="e_num" class="form-control" placeholder="Número Exterior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Interior</label>
                                    <input type="text" id="i_num" name="i_num" class="form-control" placeholder="Número Interior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Código Postal</label>
                                    <input type="text" id="pc" name="pc" class="form-control" placeholder="Código Postal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Colonia</label>
                                    <input type="text" id="suburb" name="suburb" class="form-control" placeholder="Colonia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Municipio</label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Municipio">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" id="state" name="state" class="form-control" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">País</label>
                                    <input type="text" id="country" name="country" class="form-control" placeholder="País">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input type="text" id="cellphone" name="cellphone" class="form-control" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Correo">
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-12" id = "moral" style = "display: none;">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Razón Social</label>
                                    <input type="text" id="business_name" name="business_name" class="form-control" placeholder="Razón Social">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Fecha de creación</label>
                                    <input type="date" id="date" name="date" class="form-control" placeholder="Fecha de creación">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">RFC</label>
                                    <input type="text" id="erfc" name="erfc" class="form-control" placeholder="RFC">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Calle</label>
                                    <input type="text" id="estreet" name="estreet" class="form-control" placeholder="Calle">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Exterior</label>
                                    <input type="text" id="ee_num" name="ee_num" class="form-control" placeholder="Número Exterior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Número Interior</label>
                                    <input type="text" id="ei_num" name="ei_num" class="form-control" placeholder="Número Interior">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Código Postal</label>
                                    <input type="text" id="epc" name="epc" class="form-control" placeholder="Código Postal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Colonia</label>
                                    <input type="text" id="esuburb" name="esuburb" class="form-control" placeholder="Colonia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Municipio</label>
                                    <input type="text" id="ecity" name="ecity" class="form-control" placeholder="Municipio">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" id="estate" name="estate" class="form-control" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">País</label>
                                    <input type="text" id="ecountry" name="ecountry" class="form-control" placeholder="País">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input type="text" id="ecellphone" name="ecellphone" class="form-control" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" id="eemail" name="eemail" class="form-control" placeholder="Correo">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nombre del contacto</label>
                                    <input type="text" id="name_contact" name="name_contact" class="form-control" placeholder="Nombre Completo">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Celular de contacto</label>
                                    <input type="text" id="phone_contact" name="phone_contact" class="form-control" placeholder="Celular de contacto">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="guardar()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
