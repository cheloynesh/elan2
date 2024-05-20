@extends('home')
<head>
    <title>
        KPI | Elan
    </title>
</head>
@section('content')
    <div class="text-center"><h1>KPI</h1></div>
    <br><br>
    <div style="max-width: auto; margin: auto;">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Trimestre</label>
                    <select class="form-select" id="selectQuarter" aria-label="Default select example" onchange="QuarterChange()">
                        <option selected hidden value="%">Selecciona una opción</option>
                        <option value="1">Primer Trimestre</option>
                        <option value="2">Segundo Trimestre</option>
                        <option value="3">Tercer Trimestre</option>
                        <option value="4">Cuarto Trimestre</option>
                        <option value="%">Todos</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Mes Comercial</label>
                    <select class="form-select" id="month" aria-label="Default select example" onchange="MonthChange()">
                        <option selected hidden value="%">Selecciona una opción</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                        <option value="%">Todos</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Ramo</label>
                    <select class="form-select" id="selectBranch" aria-label="Default select example" onchange="GetFilters()">
                        <option selected hidden value="%">Selecciona una opción</option>
                        @foreach ($branches as $id => $branch)
                            <option value='{{ $id }}'>{{ $branch }}</option>
                        @endforeach
                        <option value="%">Todos</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Aseguradora</label>
                    <select class="form-select" id="selectInsurance" aria-label="Default select example" onchange="GetFilters()">
                        <option selected hidden value="%">Selecciona una opción</option>
                        @foreach ($insurances as $id => $insurance)
                            <option value='{{ $id }}'>{{ $insurance }}</option>
                        @endforeach
                        <option value="%">Todos</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- Inicia pantalla de inicio --}}
          <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" style="width:100%" id="tbProf">
                <thead>
                    <th class="text-center">Seccion</th>
                    <th class="text-center">Ingresados</th>
                    <th class="text-center">Atendidos</th>
                    <th class="text-center">Porcentage</th>
                </thead>

                <tbody>
                    <tr id=0>
                        <td>Siniestros</td>
                        <td>{{$sinister[0]->CountIngr}}</td>
                        <td>{{$sinister[0]->CountEmit}}</td>
                        <td>{{$sinister[0]->Porc}}</td>
                    </tr>

                    <tr id=1>
                        <td>Iniciales</td>
                        <td>{{$initials[0]->CountIngr}}</td>
                        <td>{{$initials[0]->CountEmit}}</td>
                        <td>{{$initials[0]->Porc}}</td>
                    </tr>

                    <tr id=2>
                        <td>Servicios</td>
                        <td>{{$services[0]->CountIngr}}</td>
                        <td>{{$services[0]->CountEmit}}</td>
                        <td>{{$services[0]->Porc}}</td>
                    </tr>

                    <tr id=3>
                        <td>Cobro Venta Inicial</td>
                        <td>{{$pay[0]->CountIngr}}</td>
                        <td>{{$pay[0]->CountEmit}}</td>
                        <td>{{$pay[0]->Porc}}</td>
                    </tr>
            </table>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <canvas id="initialChart" width="400" height="400"></canvas>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <canvas id="servicesChart" width="400" height="400"></canvas>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <canvas id="sinisterChart" width="400" height="400"></canvas>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <canvas id="payChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('head')
    <script src="{{URL::asset('js/reports/kpi.js')}}"></script>
@endpush
