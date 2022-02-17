<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (View::hasSection('title')) @yield('title') - @endif{{ config('app.name', 'Astar') }}
    </title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/front.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/public.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript:void(0);"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('photobooth') }}">Photobooth</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('social-wall') }}">Social Wall</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('quiz') }}">quiz</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('special-thanks') }}">Special Thanks</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="javascript:void(0);">John Tan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="banner-block" style="background-image: url('{{asset('assets/images/banner.png')}}')">
            <div class="title-block">
                <h1>@yield('title')</h1>
            </div>
            <div class="container">
                <div class="common-block">
                    @yield('content')
                </div>
            </div>
        </section>
    </div>
</body>
</html>
