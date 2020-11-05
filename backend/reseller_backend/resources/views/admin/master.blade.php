<?php


use Illuminate\Support\Facades\Auth;

if(\is_null($title)){
    $title= "";
}

// Get info about current page to use in Sidebar
$side_option=0;

switch ($title) {
    case 'Dashboard':
        $side_option= 1;
        break;

    case 'Products':
        $side_option= 2;
        break;

    case 'Orders':
        $side_option= 3;
        break;

    case 'Profile':
        $side_option= 4;
        break;

}

?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ "Admin" }}- @yield('title') </title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bubblegum+Sans">

    <link rel="stylesheet" href="{{ asset('css/admin-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">

</head>

<body id="page-top">

    <div id="wrapper">
        <!-- SIDEBAR -->
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ url('/') }}">
                    <div class="sidebar-brand-text mx-3"><span>Redman</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link @if($side_option == 1)active @endif"
                            href="{{ url('/dashboroad') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($side_option == 2)active @endif" 
                            href="{{ url('/products') }}"><i class="fab fa-product-hunt"></i><span>Manage Products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($side_option == 3)active @endif" 
                            href="{{ url('/orders') }}"><i class="fas fa-truck-moving"></i><span>Orders History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($side_option == 4)active @endif" 
                            href="{{ url('/profile') }}"><i class="fas fa-user"></i><span>Profile</span>
                        </a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <!-- END: SIDEBAR -->
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- NAVBAR -->
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">{{ Auth::user()->name }}</span><i class="fas fa-user-circle"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                        <a class="dropdown-item" href="{{ url('/profile') }}"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- END: NAVBAR -->

                <!-- CONTENT -->
                <div class="container-fluid">
                    <!-- HEADING -->
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">@yield('title')</h3>
                    </div>
                    <!-- END: HEADING -->

                    @yield('content')


                </div>

            </div>
            <!-- FOOTER -->
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto"><span class="logo-text">Powered by&nbsp;<span style="font-family: 'Bubblegum Sans'; font-size: 1.5rem; line-height: inherit;">{C</span><span style="font-family: 'Bubblegum Sans'; font-size: 1rem; line-height: inherit;">ODE</span>
                        <span
                            style="font-family: 'Bubblegum Sans'; font-size: 1.5rem; line-height: inherit;">C</span><span style="font-family: 'Bubblegum Sans'; font-size: 1rem; line-height: inherit;">REEK</span><span style="font-family: 'Bubblegum Sans'; font-size: 1.5rem; line-height: inherit;">}</span><sup style="font-size: 1rem;"><i class="far fa-registered"></i></sup></span>
                    </div>
                </div>
            </footer>
            <!-- END: FOOTER -->
        </div>
        <!-- SCROLL TO TOP -->
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-easing.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lightbox2.min.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>


</body>