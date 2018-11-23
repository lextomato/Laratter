<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body id="general">
    <div id="app" class="container">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel nav-color navbar-fixed-top">
            <div class="container" >
                <a class="navbar-brand" href="{{ url('/') }}">
                    <strong>Laratter</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav navbar-nav">
                            <form action="/messages">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control input2" placeholder="Buscar..." required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-outline-success input2"><strong>Buscar</strong></button>
                                    </span>
                                </div>
                            </form>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown mr-2">
                                <a href="#" data-toggle="dropdown">
                                    <span class="input-group-btn">
                                        <button class="btn btn-outline-primary dropdown-toggle input2"><strong>Notificaciones</strong></button>
                                    </span>
                                </a>
    
                                <notifications-component :user="{{ Auth::user()->id }}"></notifications-component>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <strong>{{ Auth::user()->name }}</strong> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right barra-user" aria-labelledby="navbarDropdown">
                                    <strong>
                                        <a class="dropdown-item text-grey" href="/{{ Auth::user()->username }}">
                                            Mi Perfil
                                        </a>
                                        <a class="dropdown-item text-grey" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>
                                    </strong>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
