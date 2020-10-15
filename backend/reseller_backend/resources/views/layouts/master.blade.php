<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title>{{ env("APP_NAME") }}- @yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Neucha|Cabin+Sketch&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bubblegum+Sans">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/simple-line-icons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Navigation-Clean.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body>

    <nav id="main-div" class="navbar navbar-light navbar-expand-md text-uppercase navigation-clean p-1">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h1>{{ env("APP_NAME") }}</h1>
            </a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-md-end" id="navcol-2">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#shop">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>


</body>


</html>