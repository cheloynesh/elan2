@extends('home')
<head>
    <title>Polizas | ELAN</title>
</head>
@section('content')
    <div class="text-center"><h1>Polizas</h1></div>
    @include('policies.modalPolicies')
    @include('processes.OT.status.status')
    @include('policies.searchclient')

        {{-- Inicia pantalla de inicio --}}
    <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
        <table class="table table-striped table-hover text-center" id="tbPoliza">
            <thead>
                <th class="text-center">RFC</th>
                <th class="text-center"># Póliza</th>
                <th class="text-center">Ramo</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Inicio Vigencia</th>
                <th class="text-center">Fin Vigencia</th>
                <th class="text-center">Estatus</th>
                <th class="text-center">Opciones</th>
            </thead>
            <tbody>
                @foreach ($policy as $policies)
                    <tr id="{{$policies->id}}">
                        <td>{{$policies->rfc}}</td>
                        <td>{{$policies->policy}}</td>
                        <td>{{$policies->branch}}</td>
                        <td>{{$policies->name}}</td>
                        <td>{{$policies->initial_date}}</td>
                        <td>{{$policies->end_date}}</td>
                        <td>
                            <button class="btn btn-info" style="background-color: #{{$policies->color}}; border-color: #{{$policies->color}}" onclick="opcionesEstatus({{$policies->id}},{{$policies->statId}})">{{$policies->statName}}</button>
                        </td>
                        <td>
                            <a href="#|" class="btn btn-primary" onclick="verRecibos({{$policies->id}})">Ver Recibos</a>
                            <a href="#|" class="btn btn-warning" onclick="editarPoliza({{$policies->id}})" ><i class="fa fa-edit"></i></a>
                            <a href="#|" class="btn btn-danger" onclick="eliminarPoliza({{$policies->id}})"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@push('head')
    <script src="{{URL::asset('js/admin/client.js')}}" ></script>
    <script src="{{URL::asset('js/policies/viewpolicy.js')}}"></script>
@endpush
