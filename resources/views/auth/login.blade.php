@extends('layouts.auth')
@section('title', 'Login')

@section('content')

    <div class="auth-container">

        <div class="auth-left">
            <div class="circle one"></div>
            <div class="circle two"></div>
            <div class="circle three"></div>

            <h3>YOUR LOGO</h3>

            <h1 class="animated-text delay-1">Hello, <br><span>welcome!</span></h1>
            <p class="animated-text delay-2">
                Silakan login untuk mengakses sistem rekrutmen sekolah. Masukkan email dan password anda dengan benar.
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

                    <div class="group input-group">
                        <label class="text-[#6b7280] transition-colors duration-200 group-focus-within:text-[#4f46e5]"
                            for="email">Email address</label>
                        <input
                            class="border border-gray-300 focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5] transition-all"
                            id="email" type="email" name="email" placeholder="name@gmail.com" required>
                    </div>

                    <div class="group input-group">
                        <label class="text-[#6b7280] transition-colors duration-200 group-focus-within:text-[#4f46e5]"
                            for="password">Password</label>
                        <input
                            class="border border-gray-300 focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5] transition-all"
                            id="password" type="password" name="password" placeholder="********" required>
                    </div>

                    <div class="form-extra">
                        <div class="flex align-center gap-1">
                            <input class="w-4 h-4" type="checkbox" id="remember" name="remember">
                            <label class="hover:text-[#4f46e5]" for="remember"> Remember me</label>
                        </div>
                        <a href="#" class="hover:text-[#4f46e5]" style="text-decoration:none;">Forgot password?</a>
                    </div>

                    <button class="btn-primary hover:scale-105 animation duration-100">Login</button>
                    <a href="/register" class="btn-outline hover:scale-105 animation duration-100"
                        style="display:block; text-align:center">Sign up</a>

                </form>

                <div class="social">
                    <a class="font-bold hover:scale-110 animation duration-100" href="#">f</a>
                    <a class="font-bold hover:scale-110 animation duration-100" href="#">t</a>
                    <a class="font-bold hover:scale-110 animation duration-100" href="#">in</a>
                </div>

            </div>

        </div>

    </div>

@endsection