@extends('home')
<head>
    <title>Usuarios | Elan</title>
</head>
<style>
        thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@section('content')
    <div class="text-center"><h1>Cambio de contraseña</h1></div>
    <div style="max-width: 1200px; margin: auto;">
        {{-- @include('admin.users.usersedit') --}}
        {{-- Inicia pantalla de inicio --}}
        <br><br>
        <div class="container-fluid">
            <div class="col-md-6 offset-3 pt-4">
                @if($errors->any())
                {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                @endif
                @if(Session::get('error') && Session::get('error') != null)
                <div style="color:red">{{ Session::get('error') }}</div>
                @php
                Session::put('error', null)
                @endphp
                @endif
                @if(Session::get('success') && Session::get('success') != null)
                <div style="color:green">{{ Session::get('success') }}</div>
                @php
                Session::put('success', null)
                @endphp
                @endif
                <form class="form" action="{{ route('postChangePassword') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Contraseña Nueva</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirmar Contraseña Nueva</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary text-center">Enviar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('head')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@endpush



