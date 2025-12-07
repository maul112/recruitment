@extends('layouts.auth')
@section('title','Register')

@section('content')

<div class="auth-container">

    <div class="auth-left">
        <div class="circle one"></div>
        <div class="circle two"></div>
        <div class="circle three"></div>

        <h3>JOIN US</h3>

        <h1>Create <br><span>Account</span></h1>
        <p>
            Daftarkan dirimu untuk mengikuti proses rekrutmen sekolah.
        </p>
    </div>

    <div class="auth-right">

        <div class="form-box">

            <form action="/register" method="POST">
                @csrf

                <div class="input-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" required>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="input-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <button class="btn-primary">Register</button>
                <a href="/login" class="btn-outline" style="display:block; text-align:center">
                    Back to Login
                </a>

            </form>

        </div>

    </div>

</div>

@endsection
