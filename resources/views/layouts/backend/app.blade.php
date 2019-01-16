<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/backend/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/backend/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/backend/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/backend/css/themes/all-themes.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
</head>
<body class="theme-indigo">
 
<div class="overlay"></div>

<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="recherche...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>

    @include('layouts.backend.partial.topbar')
<section>
    @include('layouts.backend.partial.sidebar')
</section>

<section class="content">
    @yield('content')
</section>

<script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/backend/plugins/bootstrap/js/bootstrap.js') }}"></script>

<script src="{{ asset('assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<script src="{{ asset('assets/backend/plugins/node-waves/waves.js') }}"></script>

<script src="{{ asset('assets/backend/js/admin.js') }}"></script>

<script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

@include('flashy::message')
@stack('js')
</body>
</html>