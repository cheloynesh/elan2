<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

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
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

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
