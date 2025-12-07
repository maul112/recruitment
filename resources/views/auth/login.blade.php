@extends('layouts.auth')
@section('title','Login')

@section('content')

<div class="auth-container">

    <div class="auth-left">
        <div class="circle one"></div>
        <div class="circle two"></div>
        <div class="circle three"></div>

        <h3>YOUR LOGO</h3>

        <h1>Hello, <br><span>welcome!</span></h1>
        <p>
            Silakan login untuk mengakses sistem rekrutmen sekolah. 
            Masukkan email dan password anda dengan benar.
        </p>
    </div>

    <div class="auth-right">

        <div class="form-box">

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <div class="input-group">
                    <label>Email address</label>
                    <input type="email" name="email" placeholder="name@gmail.com" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="********" required>
                </div>

                <div class="form-extra">
                    <div>
                        <input type="checkbox"> Remember me
                    </div>
                    <a href="#" style="text-decoration:none;">Forgot password?</a>
                </div>

                <button class="btn-primary">Login</button>
                <a href="/register" class="btn-outline" style="display:block; text-align:center">Sign up</a>

            </form>

            <div class="social">
                <a href="#">f</a>
                <a href="#">t</a>
                <a href="#">in</a>
            </div>

        </div>

    </div>

</div>

@endsection
