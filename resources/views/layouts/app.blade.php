<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>@yield('title','Bienvenue sur Sourcing Hub')</title>  
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>

    <style type="text/css">
        .flashy {
            font-family: "Source Sans Pro", Arial, sans-serif;
            padding: 11px 30px;
            border-radius: 4px;
            font-weight: 400;
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 16px;
            color: #fff;
        }
    </style> 
    <script id="flashy-template" type="text/template">
        <div class="flashy flashy--{{ Session::get('flashy_notification.type') }}">
            <i class="material-icons">speaker_notes</i>
            <a href="#" class="flashy__body" target="_blank"></a>
        </div>
    </script> 
    <link href="{{ asset('css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/trumbowyg.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/multiple-emails.css') }}" rel="stylesheet" > 
    <link href="{{ asset('css/star-rating.min.css') }}" rel="stylesheet"  />
    

</head>
<body>
    <div id="app"> 
        @include('layouts/partials/_nav')   
        <main class="main-container">
            @yield('content')
        </main>  
        @include('layouts/partials/_footer') 
        <script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script> 
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datetimepicker.fr.js') }}"></script>
        <script src="{{ asset('js/multiple-emails.js') }}"></script>
        <script src="{{ asset('js/trumbowyg.min.js') }}"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/star-rating.min.js') }}"></script>
        <script>
            toastr.options = {
                "closeButton"      : true,
                "debug"            : false,
                "newestOnTop"      : false,
                "progressBar"      : true,
                "positionClass"    : "toast-top-full-width",
                "preventDuplicates": false,
                "onclick"          : null,
                "showDuration"     : "500",
                "hideDuration"     : "1000",
                "timeOut"          : "5000",
                "extendedTimeOut"  : "1000",
                "showEasing"       : "swing",
                "hideEasing"       : "linear",
                "showMethod"       : "fadeIn",
                "hideMethod"       : "fadeOut"
            }
        </script>
        @include('layouts/flash')
        @yield('script')
    </div>  
 </body>
</html>
