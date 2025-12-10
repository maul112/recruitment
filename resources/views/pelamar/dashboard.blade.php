@extends('layouts.app')

@section('title','Dashboard Pelamar')

@section('content')
<div class="dashboard">

    <div class="welcome-card">
        <h1>Halo, {{ auth()->user()->name }} 👋</h1>
        <p>Selamat datang di sistem rekrutmen sekolah. Silakan kelola akun dan lamaran Anda di bawah ini.</p>
    </div>

    <div class="grid md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="menu-content">
                <a href="{{ route('pelamar.profile') }}">Profil Saya</a>
                <span>Kelola data diri & dokumen</span>
            </div>
        </div>
        
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="menu-content">
                <a href="{{ url('/pelamar/lowongan') }}">Lowongan Tersedia</a>
                <span>Lihat dan daftar pekerjaan</span>
            </div>
        </div>

        <div class="menu-card">
            <div class="menu-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="menu-content">
                <a href="{{ url('/pelamar/riwayat') }}">Lamaran Saya</a>
                <span>Tracking status lamaran</span>
            </div>
        </div>
        
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fas fa-brain"></i>
            </div>
            <div class="menu-content">
                <a href="{{ route('pelamar.psikotes') }}">Psikotes Online</a>
                <span>Kerjakan tes seleksi online</span>
            </div>
        </div>
        
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fas fa-award"></i>
            </div>
            <div class="menu-content">
                <a href="{{ route('pelamar.pengumuman') }}">Hasil Seleksi</a>
                <span>Lihat kelulusan tahap akhir</span>
            </div>
        </div>
    </div>
</div>
@endsection
