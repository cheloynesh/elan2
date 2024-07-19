<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <img src="{{ $message->embed(public_path().'/img/mail.png')}}" alt="logo" class="logo" style="width: 500px">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h2>Cumpleaños</h2>
                        @if($bdays != null)
                            <div class="table-responsive" style="margin-bottom: 10px; max-width: 500px; margin: auto;">
                                <table class="table table-striped table-hover" style="width:100%" id="tbUsers">
                                    <thead>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Apellido</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($bdays as $bday)
                                            <tr>
                                                <td>{{$bday->name}}</td>
                                                <td>{{$bday->firstname}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4>No hay cumpleaños hoy</h4>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h2>Recibos Cobrados</h2>
                        @if($receiptMail != null)
                            <div class="table-responsive" style="margin-bottom: 10px; max-width: 500px; margin: auto;">
                                <table class="table table-striped table-hover" style="width:100%" id="tbUsers">
                                    <thead>
                                        <th class="text-center">Número de Póliza</th>
                                        <th class="text-center">Cliente</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($receiptMail as $receipt)
                                            <tr>
                                                <td>{{$receipt->policy}}</td>
                                                <td>{{$receipt->cname}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4>No hay recibos cobrados hoy</h4>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h2>Renovaciones del mes</h2>
                        @if($renovMail != null)
                            <div class="table-responsive" style="margin-bottom: 10px; max-width: 500px; margin: auto;">
                                <table class="table table-striped table-hover" style="width:100%" id="tbUsers">
                                    <thead>
                                        <th class="text-center">Número de Póliza</th>
                                        <th class="text-center">Cliente</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($renovMail as $renov)
                                            <tr>
                                                <td>{{$renov->policy}}</td>
                                                <td>{{$renov->clname}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4>No hay renovaciones hoy</h4>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h2>Pendientes de pago</h2>
                        @if($pendMail != null)
                            <div class="table-responsive" style="margin-bottom: 10px; max-width: 500px; margin: auto;">
                                <table class="table table-striped table-hover" style="width:100%" id="tbUsers">
                                    <thead>
                                        <th class="text-center">Número de Póliza</th>
                                        <th class="text-center">Cliente</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($pendMail as $pend)
                                            <tr>
                                                <td>{{$pend->policy}}</td>
                                                <td>{{$pend->cname}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4>No hay pólizas pendientes de pago hasta hoy</h4>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h2>Pólizas vencidas</h2>
                        @if($vencMail != null)
                            <div class="table-responsive" style="margin-bottom: 10px; max-width: 500px; margin: auto;">
                                <table class="table table-striped table-hover" style="width:100%" id="tbUsers">
                                    <thead>
                                        <th class="text-center">Número de Póliza</th>
                                        <th class="text-center">Cliente</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($vencMail as $venc)
                                            <tr>
                                                <td>{{$venc->policy}}</td>
                                                <td>{{$venc->cname}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4>No hay pólizas vencidas hasta hoy</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
