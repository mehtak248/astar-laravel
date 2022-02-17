<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Astar') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('images/tabicon.png') }}"/>

        <script type="text/javascript">
            window.route = {
                root: "{{ config('app.url') }}"
            };
        </script>

        <!-- Styles -->
        <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        @stack('css')
    </head>
    @guest
    <body class="hold-transition login-page">

        @yield('content')

        <!-- Scripts -->
        <script src="{{ asset('assets/js/admin.js') }}" type="text/javascript"></script>

        @stack('script')
    </body>
    @else
    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="loader" style="position: fixed;display: none;width: 100%; height: 100%;top: 0;left: 0;right: 0;bottom: 0; cursor: pointer;z-index: 9999;background-image: url('{{ asset('images/loading.gif') }}');background-repeat: no-repeat; background-size: 20%;  background-position: center;"></div>

        <div id="app" class="wrapper">
            @auth
                <!-- Includes Header -->
                @include('layouts.admin.partials.header')

                <!-- Includes Sidebar -->
                @include('layouts.admin.partials.sidebar')
            @endauth

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper pt-2">
                <section class="content">
                    @yield('content')
                </section>
            </div>
            @auth
                @include('layouts.admin.partials.footer')
            @endauth
        </div>
        <!-- Scripts -->
        <script src="{{ asset('assets/js/admin.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
            $(document)
                .ajaxStart(function () {
                    $('.loader').show();
                })
                .ajaxStop(function () {
                    $('.loader').hide();
                });
        </script>
        @stack('script')
    </body>
    @endguest
</html>
