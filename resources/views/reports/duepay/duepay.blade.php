@extends('home')
<head>
    <title>
        Pago Pendiente | Elan
    </title>
</head>
@section('content')
    <div class="text-center"><h1>Reporte de Pagos Pendientes</h1></div>
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
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">S-Ingresadas</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">P-Emitidas</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">P-Pagadas</label>
                </div>
            </div>
        </div>
        <div class="row" style="text-align: right">
            <div class="col-md-3">
                <div class="form-group">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" class="btn btn-link" onclick="exclInitials()"><label id="conting" style="font-weight: bold; font-size : 20px"></label></button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" class="btn btn-link" onclick="exclEmitNoPay()"><label id="contenit" style="font-weight: bold; font-size : 20px"></label></button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" class="btn btn-link" onclick="exclEmitPay()"><label id="contpay" style="font-weight: bold; font-size : 20px"></label></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Prima 1er Recibo por Emitir</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Prima 1er Recibo por Pagar</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Prima 1er Recibo Pagado</label>
                </div>
            </div>
        </div>
        <div class="row" style="text-align: right">
            <div class="col-md-3">
                <div class="form-group">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label id="suming" style="font-weight: bold; font-size : 20px"></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label id="sumemit" style="font-weight: bold; font-size : 20px"></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label id="sumpay" style="font-weight: bold; font-size : 20px"></label>
                </div>
            </div>
        </div>
        {{-- Inicia pantalla de inicio --}}
          <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" id="tbProf">
                <thead>
                    <th class="text-center">Agente</th>
                    <th class="text-center">S-Ingresadas</th>
                    <th class="text-center">Prima x Emitir</th>
                    <th class="text-center">P-Emitidas</th>
                    <th class="text-center">Prima x Pagar</th>
                    <th class="text-center">P-Pagadas</th>
                    <th class="text-center">Prima Pagada</th>
                </thead>

                <tbody>
                    @foreach ($arrayAgents as $agent)
                        <tr id="{{$agent->AgentId}}">
                            <td>{{$agent->AgentName}}</td>
                            {{-- <td onclick="exclInitials({{$agent->AgentId}})">{{$agent->CountAll}}</td> --}}
                            <td>{{$agent->CountAll}}</td>
                            <td>{{$agent->SumAll}}</td>
                            <td>{{$agent->CountEmit}}</td>
                            <td>{{$agent->SumEmit}}</td>
                            <td>{{$agent->CountPoliz}}</td>
                            <td>{{$agent->SumPoliz}}</td>
                            {{-- @if ($perm_btn['modify']==1 || $perm_btn['erase']==1)
                                <td>
                                    @if ($perm_btn['modify']==1)
                                        <button href="#|" class="btn btn-warning" onclick="editarSolicitud({{$application->id}})" ><i class="fa fa-edit"></i></button>
                                    @endif
                                    @if ($perm_btn['erase']==1)
                                        <button href="#|" class="btn btn-danger" onclick="eliminarSolicitud({{$application->id}})"><i class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                            @endif --}}
                        </tr>
                    @endforeach
                {{-- </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th style="text-align: right"></th>
                        <th></th>
                        <th style="text-align: right"></th>
                        <th></th>
                        <th style="text-align: right"></th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
        <div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <canvas id="insuranceChart" width="400" height="400"></canvas>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <canvas id="branchesChart" width="400" height="400"></canvas>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <canvas id="statusChart" width="400" height="400"></canvas>
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
    <script src="{{URL::asset('js/reports/duepay.js')}}"></script>
@endpush
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script> --}}
{{-- <script>
    var ctx = document.getElementById('myChart'); // node
    // var ctx = document.getElementById('myChart').getContext('2d'); // 2d context
    // var ctx = $('#myChart'); // jQuery instance
    // var ctx = 'myChart'; // element id

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
</script> --}}
