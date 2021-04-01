@extends('home')
@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h1 class="panel-title text-center">Permisos</h1>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-4">
                <label for="idPerfil">Perfil: </label>
                <select name="selectProfile" id="selectProfile" class="form-control">
                    <option hidden selected>Selecciona una opción</option>
                    @foreach ($profiles as $id => $profile)
                        <option value='{{ $id }}'>{{ $profile }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-8">
                <p style="color:red">Recuerde seleccionar un perfil antes de modificar los permisos</p>
            </div>
        </div>
        {{-- inicia panel de permisos  --}}
        <div class="panel-group" id="acordeon">
            {{-- foreach para secciones padres --}}

        </div>
    </div>
</div>

@endsection
@push('head')
    {{-- <script src="{{URL::asset('js/admin/profile.js')}}"></script> --}}
@endpush
