<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="icon" href="{{ asset('image/IT-White.webp') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
        body {
            background: url('{{ asset("image/bg4.webp") }}') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="position-relative w-100">
        @if (Route::has('login'))
            <div class="position-fixed top-0 end-0 p-3 text-end">
                @auth
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ url('/admin/dashboard') }}" class="fw-bold text-secondary text-decoration-none">Home</a>
                    @elseif(Auth::check() && Auth::user()->role === 'superadmin')
                        <a href="{{ url('/superadmin/dashboard') }}" class="fw-bold text-secondary text-decoration-none">Home</a>
                    @else
                        <a href="{{ url('/user/dashboard') }}" class="fw-bold text-secondary text-decoration-none">Home</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="fw-bold text-secondary text-decoration-none">Log in</a>
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
