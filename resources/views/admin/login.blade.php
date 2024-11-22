@extends('main')

@section('css')
    @include('admin.login-css')
@endsection

@section('css')
<style>
    
</style>
@endsection

@section('content')
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


@endsection