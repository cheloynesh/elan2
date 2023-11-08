@extends('forms')
<link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <img src="{{ URL::asset('img/logo.png') }}" alt="logo" class="logo">
                </div>
            </div>
            <br>
            <div id="generaldiv">
                <div class="card">
                    <div class="card-header" style="color: white">
                        <h4>Vacante para Asesor Patrimonial</h4>
                    </div>

                    <div class="card-body">
                        <p align="justify">¡Gusto en conocerte!, y gracias por tener interés en formar parte de ELAN Protección Patrimonial.</p>
                        <p align="justify">"Formando parte de ELAN como Asesor Patrimonial de seguros, vivirás la experiencia de entrar a la última carrera profesional de tu vida; incrementando tus ingresos y ayudando a muchas familias".</p>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header text-left" style="color: white">
                        <h4>Información Personal</h4>
                    </div>

                    <div class="card-body">
                        <form class="needs-validation" id="validationPersonal" novalidate>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Nombre: *</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Apellido paterno: *</label>
                                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Apellido" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Apellido materno: *</label>
                                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellido" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Edad: *</label>
                                        <input type="text" id="age" name="age" class="form-control" placeholder="Edad" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Ciudad de procedencia: *</label>
                                        <input type="text" id="city" name="city" class="form-control" placeholder="Ciudad" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">¿Cuál es tu último grado de escolaridad terminado?: *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="scholarity" id="prepRadios" value="preparatoria" required>
                                    <label class="form-check-label" for="prepRadios">
                                        Preparatoria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="scholarity" id="univerRadios" value="universidad" required>
                                    <label class="form-check-label" for="univerRadios">
                                        Universidad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="scholarity" id="maestrRadios" value="maestria" required>
                                    <label class="form-check-label" for="maestrRadios">
                                        Maestría
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="scholarity" id="ningRadios" value="ninguna" required>
                                    <label class="form-check-label" for="ningRadios">
                                        Ninguna de las anteriores
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header text-left" style="color: white">
                        <h4>Experiencia</h4>
                    </div>

                    <div class="card-body">
                        <form class="needs-validation" id="validationExp" novalidate>
                            <div class="form-group">
                                <label for="">Siendo 1 "Nada sociable" y 5 "Muy sociable", ¿qué tanto te consideras sociable?: *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="social" id="radio1" value="1" required>
                                    <label class="form-check-label" for="radio1">
                                        1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="social" id="radio2" value="2" required>
                                    <label class="form-check-label" for="radio2">
                                        2
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <input class="form-check-input" type="radio" name="social" id="radio3" value="3" required>
                                    <label class="form-check-label" for="radio3">
                                        3
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="social" id="radio4" value="4" required>
                                    <label class="form-check-label" for="radio4">
                                        4
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <input class="form-check-input" type="radio" name="social" id="radio5" value="5" required>
                                    <label class="form-check-label" for="radio5">
                                        5
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">¿Tienes experiencia en ventas?: *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sales_exp" id="yesSalesRadio" value="1" required>
                                    <label class="form-check-label" for="yesSalesRadio">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sales_exp" id="noSalesRadio" value="2" required>
                                    <label class="form-check-label" for="noSalesRadio">
                                        No
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header text-left" style="color: white">
                        <h4>Contacto</h4>
                    </div>

                    <div class="card-body">
                        <form class="needs-validation" id="validationContact" novalidate>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Adjunta tu CV en PDF donde incluyas tu experiencia profesional y tu información personal: *</label>
                                        <input type="file" name="cv" id="cv" accept="application/pdf" class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Escribe un correo electrónico por el que podamos contactarte: *</label>
                                        <input type="text" id="mail" name="mail" class="form-control" placeholder="ejemplo@ejemplo.com" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <p align="justify">Para terminar tu postulación, acepta nuestros términos y condiciones y da clic en el botón "Enviar" que está en la parte inferior.</p>
                                </div>
                            </div>
                        </div>
                        <form class="needs-validation" id="validationEnd" novalidate>
                            <div class="row">
                                <div class="form-group">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                      <label class="form-check-label" for="invalidCheck">Acepto los términos y condiciones.</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary" onclick="validateForms()">Enviar</button>
                    </div>
                </div>
            </div>

            <div class="card" id="divThanks" style = "display: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <p align="justify">¡Gracias por tu tiempo! Estaremos revisando tu información y CV. Te estaremos contactando en los próximos días.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <img class="card-img-top" src="{{ URL::asset('img/portada.jpg') }}" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <img src="{{ URL::asset('img/logo.png') }}" alt="logo" class="logo">
                </div>
            </div>
            <br>
            <div class="card" id="divWelcome">
                <div class="card-header" style="color: white">
                    <h4>Vacante para Asesor Patrimonial</h4>
                </div>

                <div class="card-body">
                    <p align="justify">¡Gusto en conocerte!, y gracias por tener interés en formar parte de ELAN Protección Patrimonial.</p>
                    <p align="justify">"Formando parte de ELAN como Asesor Patrimonial de seguros, vivirás la experiencia de entrar a la última carrera profesional de tu vida; incrementando tus ingresos y ayudando a muchas familias".</p>
                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary" onclick="ContinueWelcome()">Continuar</button>
                </div>
            </div>

            <div class="card" id="divPersonal" style = "display: none;">
                <div class="card-header text-left" style="color: white">
                    <h4>Información Personal</h4>
                </div>

                <div class="card-body">
                    <form class="needs-validation" id="validationPersonal" novalidate>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Nombre: *</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Apellido paterno: *</label>
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Apellido" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Apellido materno: *</label>
                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellido" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Edad: *</label>
                                    <input type="text" id="age" name="age" class="form-control" placeholder="Edad" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Ciudad de procedencia: *</label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Ciudad" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">¿Cuál es tu último grado de escolaridad terminado?: *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="scholarity" id="prepRadios" value="preparatoria" required>
                                <label class="form-check-label" for="prepRadios">
                                    Preparatoria
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="scholarity" id="univerRadios" value="universidad" required>
                                <label class="form-check-label" for="univerRadios">
                                    Universidad
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="scholarity" id="maestrRadios" value="maestria" required>
                                <label class="form-check-label" for="maestrRadios">
                                    Maestría
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="scholarity" id="ningRadios" value="ninguna" required>
                                <label class="form-check-label" for="ningRadios">
                                    Ninguna de las anteriores
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-right">
                    <button type="button" onclick="BackPersonal()" class="btn btn-secundary" data-dismiss="modal">Anterior</button>
                    <button class="btn btn-primary" onclick="ContinuePersonal()">Continuar</button>
                </div>
            </div>

            <div class="card" id="divExp" style = "display: none;">
                <div class="card-header text-left" style="color: white">
                    <h4>Experiencia</h4>
                </div>

                <div class="card-body">
                    <form class="needs-validation" id="validationExp" novalidate>
                        <div class="form-group">
                            <label for="">Siendo 1 "Nada sociable" y 5 "Muy sociable", ¿qué tanto te consideras sociable?: *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="social" id="radio1" value="1" required>
                                <label class="form-check-label" for="radio1">
                                    1
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="social" id="radio2" value="2" required>
                                <label class="form-check-label" for="radio2">
                                    2
                                </label>
                            </div>
                            <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="social" id="radio3" value="3" required>
                                <label class="form-check-label" for="radio3">
                                    3
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="social" id="radio4" value="2" required>
                                <label class="form-check-label" for="radio4">
                                    4
                                </label>
                            </div>
                            <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="social" id="radio5" value="3" required>
                                <label class="form-check-label" for="radio5">
                                    5
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">¿Tienes experiencia en ventas?: *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sales_exp" id="yesSalesRadio" value="1" required>
                                <label class="form-check-label" for="yesSalesRadio">
                                    Si
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sales_exp" id="noSalesRadio" value="2" required>
                                <label class="form-check-label" for="noSalesRadio">
                                    No
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-right">
                    <button type="button" onclick="BackExp()" class="btn btn-secundary" data-dismiss="modal">Anterior</button>
                    <button class="btn btn-primary" onclick="ContinueExp()">Continuar</button>
                </div>
            </div>

            <div class="card" id="divContact" style = "display: none;">
                <div class="card-header text-left" style="color: white">
                    <h4>Contacto</h4>
                </div>

                <div class="card-body">
                    <form class="needs-validation" id="validationContact" novalidate>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Adjunta tu CV en PDF donde incluyas tu experiencia profesional y tu información personal: *</label>
                                    <input type="file" name="cv" id="cv" accept="application/pdf" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Escribe un correo electrónico por el que podamos contactarte: *</label>
                                    <input type="text" id="age" name="age" class="form-control" placeholder="ejemplo@ejemplo.com" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-right">
                    <button type="button" onclick="BackContact()" class="btn btn-secundary" data-dismiss="modal">Anterior</button>
                    <button class="btn btn-primary" onclick="ContinueContact()">Continuar</button>
                </div>
            </div>

            <div class="card" id="divEnd" style = "display: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <p align="justify">Para terminar tu postulación, acepta nuestros términos y condiciones y da clic en el botón "Enviar" que está en la parte inferior.</p>
                            </div>
                        </div>
                    </div>
                    <form class="needs-validation" id="validationEnd" novalidate>
                        <div class="row">
                            <div class="form-group">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                  <label class="form-check-label" for="invalidCheck">Acepto los términos y condiciones.</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-right">
                    <button type="button" onclick="BackEnd()" class="btn btn-secundary" data-dismiss="modal">Anterior</button>
                    <button class="btn btn-primary" onclick="ContinueEnd()">Enviar</button>
                </div>
            </div>

            <div class="card" id="divThanks" style = "display: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <p align="justify">¡Gracias por tu tiempo! Estaremos revisando tu información y CV. Te estaremos contactando en los próximos días.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <img class="card-img-top" src="{{ URL::asset('img/portada.jpg') }}" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<script src="{{URL::asset('js/hiring/form.js')}}" ></script>
@endsection
