{{-- <!doctype html>
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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @yield('content')

        </main>
    </div>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{url('/')}}/login_assets/images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/css/main.css">

    <style>
        .container-login100{
            background-image: url("{{url('/')}}/login_assets/images/80.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            /* background-position: center; */
        }
    </style>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">

            @yield('content')

        </div>
    </div>

    <script src="{{url('/')}}/login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{url('/')}}/login_assets/vendor/animsition/js/animsition.min.js"></script>
    <script src="{{url('/')}}/login_assets/vendor/bootstrap/js/popper.js"></script>
    <script src="{{url('/')}}/login_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/login_assets/vendor/select2/select2.min.js"></script>
    <script src="{{url('/')}}/login_assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{url('/')}}/login_assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="{{url('/')}}/login_assets/vendor/countdowntime/countdowntime.js"></script>
    <script src="{{url('/')}}/login_assets/js/main.js"></script>

</body>

</html>
