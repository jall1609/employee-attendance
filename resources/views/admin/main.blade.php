<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title_web ?? ' Employee Attendance ' }}</title>
        @include('components.kumpulan-link-css')
        <link href="/templates/template1/css/nucleo-icons.css" rel="stylesheet" />
        <link href="/templates/template1/css/nucleo-svg.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link id="pagestyle" href="/templates/template1/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
        @yield('head')
        <style>
            .row {
                width: 100%;
            }
            .invalid-inputan {
                font-size: .8em;
                color: red;
            }
        </style>
        @yield('css')
    </head>
    <body>
        <div class="g-sidenav-show  bg-gray-100">
            <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
                <div class="sidenav-header">
                <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
                <a class="navbar-brand px-4 py-3 m-0" href=" / " target="_blank">
                    <img src="/templates/template1/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
                    <span class="ms-1 text-sm text-dark">Dashboard Admin</span>
                </a>
                </div>
                <hr class="horizontal dark mt-0 mb-2">
                <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    @foreach(['dashboard', 'employee', 'admin', 'attendance'] as $item)
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('/admin/' . $item) }}">
                            <i class="material-symbols-rounded opacity-5">dashboard</i>
                            <span class="nav-link-text ms-1"> {{ ucwords($item) }} </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                </div>
                <div class="sidenav-footer position-absolute w-100 bottom-0 ">
                    <div class="mx-3">
                    <form action="{{url('/admin/logout')}}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-outline-dark mt-4 w-100">Logout</button>
                    </form>
                </div>
                </div>
            </aside>
            <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
                <!-- Navbar -->
                <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
                <div class="container-fluid py-1 px-3">
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline">
                        <label class="form-label">Type here...</label>
                        <input type="text" class="form-control">
                        </div>
                    </div>
                    <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                        <a href="#" class="nav-link text-body font-weight-bold px-0">
                            <i class="material-symbols-rounded">account_circle</i>
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                </nav>
                <!-- End Navbar -->
                <div class="container-fluid py-2">
                @yield('content')
                </div>
            </main>
        </div>
        @include('components.kumpulan-script-js')
        @yield('js')
    </body>
</html>