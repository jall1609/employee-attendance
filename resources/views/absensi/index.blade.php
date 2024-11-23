@extends('absensi.main')

@section('head')
    @include('absensi.absensi-css')
@endsection

@section('content')
<div class="container">
    <form class="login-form"  action="{{url('/auth/login') }}" method="POST">
    {{ csrf_field() }}
        <h2 class="text-center ">FORM ABSENSI</h2>
        <span class="text-center">Silahkan masukkan email dan password</span>
        <div class="input-group">
            <input type="email" id="email" name="email" required placeholder="Silahkan masukan Email Anda" value="{{ old('email') }}"> 
            @error('email')
                <div class="invalid-inputan">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="input-group">
            <input type="password" id="password" name="password" required placeholder="Silahkan masukan Password Anda" value="{{ old('password') }}">
            @error('password')
                <div class="invalid-inputan">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit">Masuk</button>
    </form>
</div>
@endsection