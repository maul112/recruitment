@extends('layouts.app')

@section('title','Detail Lowongan')

@section('content')
<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(Auth::user()->pelamar === null)
        <!-- Alert Profil Belum Lengkap -->
        <div class="alert-profile">
            <p>Anda belum mengisi profil pelamar. Silakan lengkapi profil terlebih dahulu untuk dapat melamar.</p>
            <a href="{{ url('/pelamar/profil') }}" class="btn-lamar-float">Isi Profil</a>
        </div>
    @else
        <div class="lowongan-card" style="max-width:800px; margin:auto;">
            <!-- Header: Posisi & Status -->
            <div class="lowongan-header">
                <h4>{{ $lowongan->posisi }}</h4>
                <span class="status {{ strtolower($lowongan->status) == 'published' ? 'status-published' : 'status-closed' }}">
                    {{ ucfirst($lowongan->status) }}
                </span>
            </div>

            <!-- Konten 2 Kolom -->
            <div class="lowongan-content">
                <!-- Kolom kiri: Deskripsi -->
                <div class="lowongan-left">
                    <p class="deskripsi">{{ $lowongan->deskripsi }}</p>
                </div>

                <!-- Kolom kanan: Detail -->
                <div class="lowongan-right">
                    <ul class="lowongan-detail">
                        <li style="--i:0"><i class="fas fa-graduation-cap"></i> <strong>Kualifikasi Pendidikan:</strong> {{ $lowongan->kualifikasi_pendidikan }}</li>
                        <li style="--i:1"><i class="fas fa-calendar-check"></i> <strong>Tanggal Buka:</strong> {{ \Carbon\Carbon::parse($lowongan->tanggal_buka)->format('d M Y') }}</li>
                        <li style="--i:2"><i class="fas fa-calendar-times"></i> <strong>Tanggal Tutup:</strong> {{ \Carbon\Carbon::parse($lowongan->tanggal_tutup)->format('d M Y') }}</li>
                        <li style="--i:3"><i class="fas fa-file-alt"></i> <strong>Dokumen Wajib:</strong> {{ $lowongan->dokumen_wajib }}</li>
                        <li style="--i:4"><i class="fas fa-users"></i> <strong>Kuota:</strong> {{ $lowongan->kuota }}</li>
                    </ul>
                </div>
            </div>

            <!-- Tombol Lamar Floating -->
            <form method="POST" action="{{ route('pelamar.lowongan.apply', $lowongan->id) }}">
                @csrf
                <button type="submit" class="btn-lamar-float">Lamar Posisi Ini</button>
            </form>
        </div>
    @endif
</div>

<style>
    .alert {
    max-width:800px;
    margin:auto;
    padding:15px 20px;
    border-radius:12px;
    margin-bottom:20px;
    font-weight:600;
    text-align:center;
}

.alert-success { background:#16a34a; color:white; }
.alert-danger { background:#dc2626; color:white; }

.alert-profile {
    max-width:500px;
    margin:auto;
    background:#ffedd5;
    padding:20px;
    border-radius:15px;
    text-align:center;
    font-size:14px;
    color:#b45309;
    box-shadow:0 10px 20px rgba(0,0,0,0.05);
}

.alert-profile .btn-lamar-float {
    margin-top:15px;
    background:linear-gradient(135deg,#f97316,#c2410c);
    text-decoration: none;
}

.lowongan-card {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    padding:25px 25px 60px 25px;
    border-radius:20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    transition:0.4s;
    display:flex;
    flex-direction:column;
    position:relative;
    overflow:hidden;
}

.lowongan-card:hover {
    transform: translateY(-5px) scale(1.03);
    box-shadow: 0 20px 40px rgba(37,99,235,0.2);
}

.lowongan-header {
    display:flex;
    justify-content: space-between;
    align-items:center;
    margin-bottom:15px;
}

.lowongan-header h4 {
    font-size:20px;
    font-weight:700;
    color:#1e293b;
}

.status {
    font-size:13px;
    font-weight:600;
    padding:4px 12px;
    border-radius:12px;
    color:white;
    text-transform:uppercase;
}

.status-published {
    background:#16a34a;
}

.status-closed {
    background:#dc2626;
}

.lowongan-content {
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:20px;
    margin-bottom:15px;
}

.lowongan-left {
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
}

.deskripsi {
    font-size:14px;
    color:#334155;
    line-height:1.6;
}

.lowongan-right {
    background: rgba(37,99,235,0.05);
    padding:12px 15px;
    border-radius:12px;
}

.lowongan-detail {
    list-style:none;
    padding-left:0;
    margin:0;
}

.lowongan-detail li {
    font-size:14px;
    color:#475569;
    margin-bottom:10px;
    display:flex;
    align-items:center;
    gap:8px;
    opacity:0;
    transform: translateX(20px);
    animation: fadeSlide 0.5s forwards;
    animation-delay: calc(var(--i) * 0.1s);
}

.lowongan-detail li i {
    color:#2563eb;
    min-width:18px;
    text-align:center;
}

@keyframes fadeSlide {
    to {
        opacity:1;
        transform: translateX(0);
    }
}

.btn-lamar-float {
    position:absolute;
    bottom:15px;
    right:20px;
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    color:white;
    padding:10px 22px;
    border-radius:12px;
    font-size:14px;
    font-weight:600;
    border:none;
    cursor:pointer;
    transition:0.3s;
}

.btn-lamar-float:hover {
    transform:translateY(-2px) scale(1.05);
    box-shadow:0 12px 25px rgba(37,99,235,0.3);
}

@media(max-width:768px){
    .lowongan-content {
        grid-template-columns:1fr;
        gap:15px;
    }

    .btn-lamar-float {
        position:static;
        margin-top:10px;
        width:100%;
        text-align:center;
    }
}
</style>
@endsection
