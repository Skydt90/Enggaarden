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
    <script src="{{ asset('js/general.js') }}" defer></script>

    @yield('additional-scripts')
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <img class="navbar-brand mt-n2" src="{{ asset('img/logo.png') }}" alt="" {{-- style="height: 60px width: 90px" --}}>
                {{-- Toggle button on small screens --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="{{ route('member.index') }}" class="nav-link"><i class="fas fa-users"></i> Medlemmer</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('send.mail.show') }}" class="nav-link"><i class="far fa-envelope"></i> Email</a>
                            </li>
                            <li class="nav-item" style="hover: ">
                                <a href="{{ route('contribution.index') }}" class="nav-link"><i class="fas fa-money-bill-wave"></i></i> Støttebidrag</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('statistics') }}" class="nav-link"><i class="fas fa-chart-pie"></i> Statistik</a>
                            </li>
                            @can('administrate')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-shield-alt"></i> Brugere</a>
                                </li>
                            @endcan
                        </ul>
                    @endauth
  
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Log ind') }}</a>
                                </li>
                            @else
                            @if(Auth::user()->unreadNotifications()->get()->count() > 0)
                                <i data-toggle="tooltip" data-placement="left" title="Ulæste notifikationer" class="fas fa-exclamation-triangle nav-link mt-1" style="color:orange"></i>
                                @endif
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->username }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" style="color: #d61c59" href="{{ route('notifications.index') }}">Notifikationer</a>
                                        <a class="dropdown-item" style="color: #d61c59" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Log ud') }}
                                        </a>
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
</body>
</html>
