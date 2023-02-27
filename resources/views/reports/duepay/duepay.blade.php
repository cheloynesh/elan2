@extends('home')
<head>
    <title>
        Pago Pendiente | Elan
    </title>
</head>
@section('content')
    <div class="text-center"><h1>Reporte de Pagos Pendientes</h1></div>
    <div style="max-width: auto; margin: auto;">
        {{-- Inicia pantalla de inicio --}}
        <br><br>
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
                    {{-- @foreach ($applications as $application)
                        <tr id="{{$application->id}}">
                            <td>{{$application->name}}</td>
                            @if ($perm_btn['modify']==1 || $perm_btn['erase']==1)
                                <td>
                                    @if ($perm_btn['modify']==1)
                                        <button href="#|" class="btn btn-warning" onclick="editarSolicitud({{$application->id}})" ><i class="fa fa-edit"></i></button>
                                    @endif
                                    @if ($perm_btn['erase']==1)
                                        <button href="#|" class="btn btn-danger" onclick="eliminarSolicitud({{$application->id}})"><i class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/admin/application.js')}}"></script>
@endpush
