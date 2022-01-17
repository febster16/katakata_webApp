<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Katakata</title>

    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link href="{{asset('css/blog-home.css')}}" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <img src="storage/katakataLogo.png" alt="">
        <a class="navbar-brand" href="{{route('home')}}">Katakata</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ (Route::currentRouteName() == 'home') ? ' active' : ''}}">
                    <a class="nav-link" href="{{route('home')}}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>


                @if(Auth::check())

                <li class="nav-item {{ (Route::currentRouteName() == 'user.create_post') ? ' active' : ''}}">
                    <a class="nav-link" href="{{route('user.create_post')}}">Create Post</a>
                </li>

                <li class="nav-item {{ (Route::currentRouteName() == 'user.my_post') ? ' active' : ''}}">
                    <a class="nav-link" href="{{route('user.my_post')}}">My Post</a>
                </li>

                <li class="nav-item {{ (Route::currentRouteName() == 'user.profile') ? ' active' : ''}}" >
                    <a class="nav-link" href="{{route('user.profile')}}">{{ ucfirst(Auth::user()->name) }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                </li>

                @else

                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>

                @endif


            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <div class="row">

        @yield('content-full')


        <div class="col-md-8">

            @yield('content')

        </div>

        <div class="col-md-4">
            @yield('sidebar')
        </div>

    </div>

</div>

<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Katakata 2022</p>
    </div>
</footer>

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
