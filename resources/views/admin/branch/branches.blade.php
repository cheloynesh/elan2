@extends('home')
<head>
    <title>Ramos | Elan</title>
</head>
@section('content')
    <div class="text-center"><h1>Catálogo de Ramos</h1></div>
    <div style="max-width: 1200px; margin: auto;">
        @include('admin.branch.branchesEdit')
        {{-- Inicia pantalla de inicio --}}
        <div class="bd-example bd-example-padded-bottom">
            @if ($perm_btn['addition']==1)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalNewBranch">Nuevo</button>
            @endif
        </div>
        <br><br>
          <div class="table-responsive" style="margin-bottom: 10px; max-width: 100%; margin: auto;">
            <table class="table table-striped table-hover text-center" id="tbProfBranch">
                <thead>
                    <th class="text-center">Nombre</th>
                    @if ($perm_btn['modify']==1 || $perm_btn['erase']==1)
                        <th class="text-center">Opciones</th>
                    @endif
                </thead>

                <tbody>
                    @foreach ($branches as $branch)
                        <tr id="{{$branch->id}}">
                            <td>{{$branch->name}}</td>
                            @if ($perm_btn['modify']==1 || $perm_btn['erase']==1)
                                <td>
                                    @if ($perm_btn['modify']==1)
                                        <a href="#|" class="btn btn-warning" onclick="editarRamo({{$branch->id}})" ><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if ($perm_btn['erase']==1)
                                        <a href="#|" class="btn btn-danger" onclick="eliminarRamo({{$branch->id}})"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/admin/branch.js')}}"></script>
@endpush
