<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <!-- Styles -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body class="bg-light">
<div id="app">
    @if(session('success'))
        <div class="alert-success d-none">
            {{session('success')}}
        </div>
    @endif
    <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
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
                            <a id="navbarDropdown" style="font-size: 14px;" class="nav-link dropdown-toggle font-weight-bold text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
@auth
    <div class="col-2 float-left p-0" style="position: absolute; top: 0;">
        <div class="col-2 bg-info position-fixed" style="height: 1000px;">
            <h3 class="font-weight-bold text-light text-center pt-2">
                <a class="text-light text-decoration-none" href="{{ route('posts.index') }}">Blog</a>
            </h3>
            <div class="border-bottom pt-1" style="width: 100%"></div>
            <nav class="menu-main nav flex-column mt-3">
                @if(auth()->user()->role->name === 'user')
                    <a class="nav-link active" aria-current="page" href="{{ route('vouchers.index') }}">Post</a>
                    @else
                    <a class="nav-link active" aria-current="page" href="{{ route('vouchers.index') }}">Post</a>
                    <a class="nav-link active" aria-current="page" href="{{ route('category.create') }}">Category</a>
                    <a class="nav-link" href="{{ route('users.index')}}">Account</a>
                @endif
            </nav>
        </div>
    </div>
@endauth
<main class="page-content ">
    @yield('content')
</main>
</div>
<script>
    var success = document.querySelector('.alert-success');
    window.onload = function () {
        if (success!= null)
        {
            alert(success.innerHTML);
        }
    }
</script>
</body>
</html>
