<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Sistema ELAN">
    <title>@yield('title','Sistema') | ELAN</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('public/pluings/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/pluings/bootstrap/css/bootstrap-multiselect.css') }}" rel="stylesheet">
    <link href="{{ asset('public/pluings/editable/css/bootstrap-editable.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/color.css') }}" rel="stylesheet"  >
    <link href="{{ asset('public/pluings/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/pluings/datatable/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('public/pluings/multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" >
    <link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/pluings/alertify/css/alertify.css') }}" rel="stylesheet" >
    <link href="{{ asset('public/pluings/alertify/css/default.css') }}" rel="stylesheet" >
    <link href="{{ asset('public/pluings/chosen/chosen.css')}}" rel="stylesheet" type="text/css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">


    <style>
        .dropdown-menu {
             background-color: #FFFFFF!important;
        }
        .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
            background-color: #FFFFFF!important;
            color:#555!important;
        }
    </style>
</head>
<body>
    @include('admin.template.nav')
    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12">
            @yield('content')
        </div>
    </div>
    <script src="{{asset('public/plugins/jquery/jquery-3.1.1.js')}}"></script>
    <script src="{{asset('public/plugins/jquery/jquery.number.js')}}"></script>
    <script src="{{asset('public/pluings/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('public/pluings/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/plugins/bootstrap/js/bootstrap-multiselect.js')}}"></script>
    <script src="{{asset('public/pluings/editable/js/bootstrap-editable.min.js')}}"></script>
    <script src="{{asset('public/pluings/editable/js/moment.js')}}"></script>
    <script src="{{asset('public/pluings/editable/js/moment-espanol.js')}}"></script>
    <script src="{{asset('public/pluings/datatable/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('public/plugins/multiselect/js/bootstrap-multiselect.js')}}"></script>
    <script src="{{asset('public/pluings/metisMenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('public/pluings/alertify/js/alertify.js')}}"></script>
    <script src="{{asset('public/js/sb-admin-2.js')}}"></script>
    <script src="{{asset('public/pluings/chosen/chosen.jquery.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{asset('public/js/app.js')}}"></script>
    {{-- @yield('js') --}}
    <script>
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
        });
    </script>
</body>
</html>