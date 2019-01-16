<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Bienvenue sur Laracarte')</title>
    
     <link rel="stylesheet" href="{{ asset('css/app.css') }}"  >
 </head>
<body>
        @include('layouts/partials/_nav')
        @yield('content')
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="container">
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            </div>
        @endif
        @include('layouts/partials/_footer')
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    @include('flashy::message')
</body>
</html>