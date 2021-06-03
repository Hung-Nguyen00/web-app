<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    </head>
    <body class="bg-light">
            @if (Route::has('login'))
                    @auth
                        <div class="flex-center col-10 bg-primary float-right align-items-center" style="z-index:2; height: 50px;">
                            <div class="links" style="position: absolute; right: 10px;">
                        <span class="font-weight-bold">Hello <span class="text-light ml-1">{{Auth::user()->name}}</span> </span>
                            <form action="{{route('logout')}}" method="post" class="d-inline p-3">
                                @csrf
                                <button class="border-0 btn btn-light" type="submit">Log out</button>
                            </form>
                            </div>
                        </div>
                    @else
                        <div class="flex-center col-10 float-right align-items-center" style="z-index:2; height: 50px;">
                            <div class="links" style="position: absolute; right: 10px;">
                                <a href="{{ route('login') }}">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            </div>
                        </div>
                    @endauth

            @endif
        @auth
        <div class="col-2 float-left p-0" style="position: absolute; top: 0;">
            <div class="col-2 bg-info position-fixed full-height">
                <h3 class="pt-2 text-center text-white">John's Shop</h3>
                <nav class="nav flex-column mt-3" >
                    <a class="nav-link active" aria-current="page" href="{{route('products.index')}}">Product</a>
                    <a class="nav-link active" aria-current="page" href="{{route('orders.index')}}">Order</a>
                    <a class="nav-link" href="#">Account</a>
                </nav>
            </div>
        </div>

        @endauth
            <main class="page-content ">
                @yield('content')
            </main>
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
