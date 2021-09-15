<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Script --}}
    <script src="{{ asset('js/back.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/backoffice.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
            <div class="container">
                <div class="logo-container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('/images/logos/logo-dark.png') }}" alt="deliverboo-logo">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

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
                            <li class="nav-item mr-3 my-self">
                                <a href="{{route('owner.home')}}">Portale ristoratore</a>
                            </li>
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

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <div class="row">
                    <a href="/">
                        <img
                            class="logo"
                            src="/images/logos/logo-footer.png"
                            alt="deliverboo logo"
                        />
                    </a>
                    <div class="col">
                        <ul>
                            <li>
                                <h6>Scopri DeliverBoo</h6>
                            </li>
                            <li>
                                <a href="#">Chi siamo</a>
                            </li>
                            <li>
                                <a href="/restaurants">Ristoranti</a>
                            </li>
                            <li>
                                <a href="#">Diventa nostro partner</a>
                            </li>
                            <li>
                                <a href="#">Lavora con noi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul>
                            <li>
                                <h6>Note legali</h6>
                            </li>
                            <li>
                                <a href="#">Termini &amp; Condizioni</a>
                            </li>
                            <li>
                                <a href="#">Informativa sulla privacy</a>
                            </li>
                            <li>
                                <a href="#">Cookies</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul>
                            <li>
                                <h6>Aiuto</h6>
                            </li>
                            <li>
                                <a href="#">Contatti</a>
                            </li>
                            <li>
                                <a href="#">FAQ</a>
                            </li>
                            <li>
                                <a href="#">Tipi di cucina</a>
                            </li>
                            <li>
                                <a href="#">Mappa del sito</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul>
                            <li>
                                <h6>Porta DeliverBoo con te</h6>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-6 col-md-12">
                                        <a href="#">
                                            <img
                                                src="https://www.palestrauniverso.it/wp-content/uploads/2018/05/google-play-11.png"
                                                alt="download-from-googleplay"
                                            />
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-12">
                                        <a href="#">
                                            <img
                                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Download_on_the_App_Store_Badge_IT_RGB_blk.svg/1280px-Download_on_the_App_Store_Badge_IT_RGB_blk.svg.png"
                                                alt="download-from-appstore"
                                            />
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="logo-container container">
                <div class="icons">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-twitter-square"></i>
                    <i class="fab fa-instagram"></i>
                </div>
                <div>
                    <span>&copy; 2021 DeliverBoo</span>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
