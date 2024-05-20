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
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
