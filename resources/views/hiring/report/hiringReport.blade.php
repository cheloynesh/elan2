@extends('home')
{{-- @section('title','Candidatos') --}}
<head>
    <title>Reporte Candidatos | Elan</title>
</head>
@section('content')
    <div class="text-center"><h1>Reporte Candidatos</h1></div>
    <div style="max-width: 100%; margin: auto;">
        <br><br>
        <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" id="tbProf">
                <thead>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">Fecha de Solicitud</th>
                    <th class="text-center">Estatus</th>
                    <th class="text-center">Opciones</th>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/hiring/candidates.js')}}"></script>
@endpush
