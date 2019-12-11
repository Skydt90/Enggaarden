<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - {{ $ex_user->member->first_name ?? 'Profil' }}</title>

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
                
                @if (Auth::user())
                   
                    <p class="navbar-brand mb-n1">
                        {{ config('app.name') }} - {{ $ex_user->member->first_name ?? 'Fornavn' }} {{ $ex_user->member->last_name ?? '' }}
                    </p>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <a class="p-2 text-dark" href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Log ud ({{ $ex_user->member->first_name ?? 'navn' }})</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                @else
                <img class="navbar-brand mt-n2" src="{{ asset('img/logo.png') }}" alt="" {{-- style="height: 60px width: 90px" --}}>
                <p class="float-right mt-2">Eksternt medlemssystem</p>
                @endif
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
