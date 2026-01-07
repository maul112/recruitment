@extends('layouts.auth')
@section('title','Register')

@section('content')

<div class="auth-container">

    <div class="auth-left">
        <div class="circle one"></div>
        <div class="circle two"></div>
        <div class="circle three"></div>

        <h3>JOIN US</h3>

        <h1 class="animated-text delay-1">Create <br><span>Account</span></h1>
        <p class="animated-text delay-2">
            Daftarkan dirimu untuk mengikuti proses rekrutmen sekolah.
        </p>
    </div>

    <div class="auth-right">

        <div class="form-box">

            <form action="/register" method="POST">
                @csrf

                <div class="group input-group">
                    <label for="name" class="text-[#6b7280] transition-colors duration-200 group-focus-within:text-[#4f46e5]">Nama Lengkap</label>
                    <input class="border border-gray-300 focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5] transition-all" type="text" id="name" name="name" required>
                </div>

                <div class="group input-group">
                    <label for="email" class="text-[#6b7280] transition-colors duration-200 group-focus-within:text-[#4f46e5]">Email</label>
                    <input class="border border-gray-300 focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5] transition-all" id="email" type="email" name="email" required>
                </div>

                <div class="group input-group">
                    <label for="password" class="text-[#6b7280] transition-colors duration-200 group-focus-within:text-[#4f46e5]">Password</label>
                    <input class="border border-gray-300 focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5] transition-all" id="password" type="password" name="password" required>
                </div>

                <div class="group input-group">
                    <label for="password" class="text-[#6b7280] transition-colors duration-200 group-focus-within:text-[#4f46e5]">Konfirmasi Password</label>
                    <input class="border border-gray-300 focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5] transition-all" id="password" type="password" name="password_confirmation" required>
                </div>

                <button class="btn-primary hover:scale-105 animation duration-100">Register</button>
                <a href="/login" class="btn-outline hover:scale-105 animation duration-100" style="display:block; text-align:center">
                    Back to Login
                </a>

            </form>

        </div>

    </div>

</div>

@endsection
