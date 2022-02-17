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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">
    <script type="text/javascript">
        window.route = {
            root: "{{ config('app.url') }}"
        };
    </script>

    <script src="{{ asset('assets/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/front.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/izitoast/css/iziToast.min.css ') }}">
    <link href="{{ asset('assets/css/public.css') }}" rel="stylesheet">

    <meta name="description" content="{{ config('app.name', 'Astar') }}" />
    <meta itemprop="description" content="{{ config('app.name', 'Astar') }}" />
    <meta name="twitter:description" content="{{ config('app.name', 'Astar') }}" />

    <meta name="twitter:title" content="{{ config('app.name', 'Astar') }}" />
    <meta name="author" content="{{ config('app.name', 'Astar') }}" />

    <link rel="canonical" href="{{ url()->current() }}" />

    <meta name="twitter:site" content="@astar" />
    <meta name="twitter:creator" content="@astar" />

    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="A*STAR@30: 30 Innovations and Inventions"/>
    <meta property="og:description" content="2021 marks 30 years of A*STAR advancing scientific excellence, developing innovative technology and nurturing scientific talent for Singapore." />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="A*STAR" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:image:width" content="580" />
    <meta property="og:image:height" content="580" />

    <meta name="keywords" content= "A*STAR@30: 30 Innovations and Inventions" />

    <meta itemprop="name" content="#astar" />

    @if (View::hasSection('image'))
        <meta name="twitter:image" content="@yield('image')" />
        <meta property="og:image" content="@yield('image')" />
        <meta itemprop="image" content="@yield('image')" />
    @else
        <meta name="twitter:image" content="{{ asset('assets/images/site_brand.png') }}" />
        <meta property="og:image" content="{{ asset('assets/images/site_brand.png') }}" />
        <meta itemprop="image" content="{{ asset('assets/images/site_brand.png') }}" />
    @endif
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
                    @auth
                        <ul>
                            <li class="dropdown nav-item">
                                <button class="nav-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <form action="{{ route('logout') }}" class="d-inline-block" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn" title="Logout">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <section class="banner-block">
            <span class="banner-block-image d-md-none">
                <img src="{{ asset('assets/images/banner.png') }}" />
            </span>
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
    <!-- Scripts -->
    @stack('script')
    @include('layouts.front.includes.alerts')
</body>
</html>
