<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title_web ?? ' Employee Attendance ' }}</title>
        @include('components.kumpulan-link-css')
        @yield('head')
        <style>
            .row {
                width: 100%;
            }
            .invalid-inputan {
                font-size: .6em;
                color: red;
                width: 60%;
                margin: 10px auto;
                justify-content: center;
                display: block;
            }
        </style>
    </head>
    <body>
        @yield('content')
        @include('components.kumpulan-script-js')
        @yield('js')
    </body>
</html>