@extends('home')
{{-- @section('title','Candidatos') --}}
<head>
    <title>Reporte reclutamiento | Elan</title>
</head>
@section('content')
    <div class="text-center"><h1>Reporte reclutamiento</h1></div>
    <div style="max-width: 100%; margin: auto;">
        <br><br>
        <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" style="width:100%" id="tbProf">
                <thead>
                    <th class="text-center">Origen</th>
                    <th class="text-center">1er Entrevista</th>
                    <th class="text-center">2da Entrevista</th>
                    <th class="text-center">Inducción</th>
                    <th class="text-center">Inscrito a CIA</th>
                    <th class="text-center">CIA</th>
                    <th class="text-center">Examen</th>
                    <th class="text-center">Cédula</th>
                    <th class="text-center">Alta Metlife</th>
                    <th class="text-center">Graduado Met</th>
                </thead>

                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{$report->origin}}</td>
                            <td>{{$report->fst}}</td>
                            <td>{{$report->scnd}}</td>
                            <td>{{$report->induc}}</td>
                            <td>{{$report->icia}}</td>
                            <td>{{$report->cia}}</td>
                            <td>{{$report->exam}}</td>
                            <td>{{$report->ced}}</td>
                            <td>{{$report->altm}}</td>
                            <td>{{$report->met}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <canvas id="insuranceChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/hiring/hiringReport.js')}}"></script>
@endpush
