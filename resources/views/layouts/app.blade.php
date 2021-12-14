<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WET') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

   

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        use Illuminate\ Support\ Facades\ DB;
        use Alert;
    </script>

    <style>
        .pink-bg {
            background-color: #AB1343;
        }

        .navbar {
            background-color: #AB1343;
        }

        .navbar-brand {
            color: honeydew;
        }


        .btn {
            background-color: #AB1343;
            border: 0;
            width: 100%
        }

        .btn:hover {
            background-color: #AB1343;
        }

        .btn:active {
            background-color: #AB1343;
        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-md  shadow-sm">

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/logo.png" height="40" alt="weterynarz">
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
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/') }}">{{ __('Strona Główna') }}</a>
                </li>
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                </li>
                @endif
                @else

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('home') }}">
                            {{ __('Moje konto') }}
                        </a>

                        @if (Auth::user()->Id_type == 3)
                        <a class="dropdown-item" href="{{ url('/zwierzetaklienta') }}">
                            {{ __('Moje zwierzęta') }}
                        </a>
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Wyloguj') }}
                        </a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>

    </nav>

    <main class="py-4">
    @if(session()->has('message'))
<div class=" text-center alert alert-danger mt-1 mb-2">
  {{ session()->get('message') }}
</div>
 @endif
        @yield('content')
    </main>

    <div class="text-gray-500 text-center">
        <br />
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</body>

</html>