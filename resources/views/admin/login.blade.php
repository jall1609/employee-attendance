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
        </style>
        @include('admin.login-css')
    </head>
    <body>
        <div class="main">
            <div class="login">
                <form action="{{url('/admin/login') }}" method="POST">
                    {{ csrf_field() }}
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="password" placeholder="Password" required="">
                    <button type="submit" >Login</button>
                </form>
            </div>
        </div>
        @include('components.kumpulan-script-js')
        @yield('js')
    </body>
</html>