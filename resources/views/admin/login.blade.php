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
        @include('admin.login-css')
    </head>
    <body>
        <div class="main">
            <div class="login">
                <form action="{{url('/auth/login') }}" method="POST">
                    {{ csrf_field() }}
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email" placeholder="Email" required="" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-inputan">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="password" name="password" placeholder="Password" required="" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-inputan">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" >Login</button>
                </form>
            </div>
        </div>
        @include('components.kumpulan-script-js')
        @yield('js')
    </body>
</html>