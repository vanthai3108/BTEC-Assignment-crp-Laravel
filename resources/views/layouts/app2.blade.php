<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--weblogo--}}
    <link rel="shortcut icon" type="image" href="{{config('app.url')}}/{{config('adminlte.logo_img_icon')}}" />

    <title>{{ config('app.name', 'BLMS') }} | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    <div id="app" style="min-height: 120%">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm p-1" style="background-color: #00a4c5e0">
            <div class="container">
                <a class="navbar-brand p-0" href="{{ url('/') }}">
                    <img src="{{config('app.url')}}/{{config('adminlte.logo_img')}}" class="avatar" style="height: 35px"  alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}" style="font-size:16px; color:white;"><i class="fas fa-home" ></i> Home  </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route("my_course")}}" style="font-size:16px; color:white;"><i class="fas fa-tachometer-alt " ></i> My Course </a>
                        </li>
                        
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->avatar)
                                        <img src="{{ config('app.url')}}/{{ Auth::user()->avatar }}" class="avatar rounded-circle img-thumbnail" style="height: 40px; width:40px"  alt="User Image">
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->role_id == 1)
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            Admin page
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        Profile
                                    </a>
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