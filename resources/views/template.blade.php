@extends('home')
<head>
    <title>
        Home | Elan
    </title>
</head>
@section('content')
    <div class="text-center"><h1>ELAN</h1></div>
    <div style="max-width: 100%; margin: auto;">
        {{-- modal| --}}
        {{-- fin modal| --}}
        @include('admin.applications.applicationEdit')
        {{-- Inicia pantalla de inicio --}}
        <div class="container-fluid bd-example-row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-10 text-center">
                        <div class="row">
                            <h3 style="font-weight: bold">Pólizas</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 text-center">
                                <h5>Emitidas</h5>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/></svg>
                                </div>
                                <button type="button" class="btn btn-primary full-width" onclick="excl(1)">{{$data[0]->emitidas}}</button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <h5>Renovadas</h5>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M504 256c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zM227.3 387.3l184-184c6.2-6.2 6.2-16.4 0-22.6l-22.6-22.6c-6.2-6.2-16.4-6.2-22.6 0L216 308.1l-70.1-70.1c-6.2-6.2-16.4-6.2-22.6 0l-22.6 22.6c-6.2 6.2-6.2 16.4 0 22.6l104 104c6.2 6.2 16.4 6.2 22.6 0z"/></svg>
                                </div>
                                <button type="button" class="btn btn-primary full-width" onclick="excl(2)">{{$data[0]->renovadas}}</button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <h5>Por cobrar</h5>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zM64 72c0-4.4 3.6-8 8-8h80c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H72c-4.4 0-8-3.6-8-8V72zm0 80v-16c0-4.4 3.6-8 8-8h80c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H72c-4.4 0-8-3.6-8-8zm144 263.9V440c0 4.4-3.6 8-8 8h-16c-4.4 0-8-3.6-8-8v-24.3c-11.3-.6-22.3-4.5-31.4-11.4-3.9-2.9-4.1-8.8-.6-12.1l11.8-11.2c2.8-2.6 6.9-2.8 10.1-.7 3.9 2.4 8.3 3.7 12.8 3.7h28.1c6.5 0 11.8-5.9 11.8-13.2 0-6-3.6-11.2-8.8-12.7l-45-13.5c-18.6-5.6-31.6-23.4-31.6-43.4 0-24.5 19.1-44.4 42.7-45.1V232c0-4.4 3.6-8 8-8h16c4.4 0 8 3.6 8 8v24.3c11.3 .6 22.3 4.5 31.4 11.4 3.9 2.9 4.1 8.8 .6 12.1l-11.8 11.2c-2.8 2.6-6.9 2.8-10.1 .7-3.9-2.4-8.3-3.7-12.8-3.7h-28.1c-6.5 0-11.8 5.9-11.8 13.2 0 6 3.6 11.2 8.8 12.7l45 13.5c18.6 5.6 31.6 23.4 31.6 43.4 0 24.5-19.1 44.4-42.7 45.1z"/></svg>
                                </div>
                                <button type="button" class="btn btn-primary full-width" onclick="excl(3)">{{$data[0]->pcobrar}}</button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <h5>Canceladas</h5>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"/></svg>
                                </div>
                                <button type="button" class="btn btn-primary full-width" onclick="excl(4)">{{$data[0]->canceladas}}</button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <h5>Iniciales pagadas</h5>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M271.1 144.3l54.3 14.3a8.6 8.6 0 0 1 6.6 8.1c0 4.6-4.1 8.4-9.1 8.4h-35.6a30 30 0 0 1 -11.2-2.2c-5.2-2.2-11.3-1.7-15.3 2l-19 17.5a11.7 11.7 0 0 0 -2.3 2.7 11.4 11.4 0 0 0 3.9 15.7 83.8 83.8 0 0 0 34.5 11.5V240c0 8.8 7.8 16 17.4 16h17.4c9.6 0 17.4-7.2 17.4-16V222.4c32.9-3.6 57.8-31 53.5-63-3.2-23-22.5-41.3-46.6-47.7L282.7 97.4a8.6 8.6 0 0 1 -6.6-8.1c0-4.6 4.1-8.4 9.1-8.4h35.6A30 30 0 0 1 332 83.1c5.2 2.2 11.3 1.7 15.3-2l19-17.5A11.3 11.3 0 0 0 368.5 61a11.4 11.4 0 0 0 -3.8-15.8 83.8 83.8 0 0 0 -34.5-11.5V16c0-8.8-7.8-16-17.4-16H295.4C285.8 0 278 7.2 278 16V33.6c-32.9 3.6-57.9 31-53.5 63C227.6 119.6 247 137.9 271.1 144.3zM565.3 328.1c-11.8-10.7-30.2-10-42.6 0L430.3 402a63.6 63.6 0 0 1 -40 14H272a16 16 0 0 1 0-32h78.3c15.9 0 30.7-10.9 33.3-26.6a31.2 31.2 0 0 0 .5-5.5A32 32 0 0 0 352 320H192a117.7 117.7 0 0 0 -74.1 26.3L71.4 384H16A16 16 0 0 0 0 400v96a16 16 0 0 0 16 16H372.8a64 64 0 0 0 40-14L564 377a32 32 0 0 0 1.3-48.9z"/></svg>
                                </div>
                                <button type="button" class="btn btn-primary full-width" onclick="excl(6)">{{$data[0]->pagadasini}}</button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <h5>Renovaciones pagadas</h5>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M271.1 144.3l54.3 14.3a8.6 8.6 0 0 1 6.6 8.1c0 4.6-4.1 8.4-9.1 8.4h-35.6a30 30 0 0 1 -11.2-2.2c-5.2-2.2-11.3-1.7-15.3 2l-19 17.5a11.7 11.7 0 0 0 -2.3 2.7 11.4 11.4 0 0 0 3.9 15.7 83.8 83.8 0 0 0 34.5 11.5V240c0 8.8 7.8 16 17.4 16h17.4c9.6 0 17.4-7.2 17.4-16V222.4c32.9-3.6 57.8-31 53.5-63-3.2-23-22.5-41.3-46.6-47.7L282.7 97.4a8.6 8.6 0 0 1 -6.6-8.1c0-4.6 4.1-8.4 9.1-8.4h35.6A30 30 0 0 1 332 83.1c5.2 2.2 11.3 1.7 15.3-2l19-17.5A11.3 11.3 0 0 0 368.5 61a11.4 11.4 0 0 0 -3.8-15.8 83.8 83.8 0 0 0 -34.5-11.5V16c0-8.8-7.8-16-17.4-16H295.4C285.8 0 278 7.2 278 16V33.6c-32.9 3.6-57.9 31-53.5 63C227.6 119.6 247 137.9 271.1 144.3zM565.3 328.1c-11.8-10.7-30.2-10-42.6 0L430.3 402a63.6 63.6 0 0 1 -40 14H272a16 16 0 0 1 0-32h78.3c15.9 0 30.7-10.9 33.3-26.6a31.2 31.2 0 0 0 .5-5.5A32 32 0 0 0 352 320H192a117.7 117.7 0 0 0 -74.1 26.3L71.4 384H16A16 16 0 0 0 0 400v96a16 16 0 0 0 16 16H372.8a64 64 0 0 0 40-14L564 377a32 32 0 0 0 1.3-48.9z"/></svg>
                                </div>
                                <button type="button" class="btn btn-primary full-width" onclick="excl(7)">{{$data[0]->pagadasren}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <div class="row">
                            <h3 style="font-weight: bold">Trámites</h3>
                        </div>
                        <div class="row">
                            <h5>Consulta</h5>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M304 48c0 26.5-21.5 48-48 48s-48-21.5-48-48 21.5-48 48-48 48 21.5 48 48zm-48 368c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48zm208-208c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48zM96 256c0-26.5-21.5-48-48-48S0 229.5 0 256s21.5 48 48 48 48-21.5 48-48zm12.9 99.1c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48c0-26.5-21.5-48-48-48zm294.2 0c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48c0-26.5-21.5-48-48-48zM108.9 60.9c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"/></svg>
                            </div>
                            <button type="button" class="btn btn-primary full-width" onclick="excl(5)">{{$data[0]->tramites}}</button>
                        </div>
                    </div>
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
        </div>
        </div>
    </div>
@endsection
@push('head')
    <script src="{{URL::asset('js/template.js')}}"></script>
@endpush
