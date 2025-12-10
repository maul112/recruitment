@extends('layouts.app')

@section('title', 'Daftar Psikotes')

@section('content')
<div class="content-wrapper">
    <h3 style="margin-bottom:25px;">Daftar Psikotes</h3>

    <div class="lowongan-grid">
        @forelse ($daftar_tipe as $tipe)
            <div class="lowongan-card">

                <!-- Header -->
                <div class="lowongan-header">
                    <h4 class="text-capitalize">{{ $tipe->tipe }}</h4>

                    <span class="status status-published">
                        {{ $tipe->jumlah }} Soal
                    </span>
                </div>

                <!-- Konten Card -->
                <div class="lowongan-content">
                    <div class="lowongan-left w-50 wrap-break-word">
                        <p class="deskripsi">
                            Psikotes tipe <strong>{{ $tipe->tipe }}</strong> berisi 
                            {{ $tipe->jumlah }} soal yang harus Anda kerjakan untuk menyelesaikan penilaian.
                        </p>
                    </div>

                    <div class="lowongan-right">
                        <ul class="lowongan-detail">
                            <li style="--i:0">
                                <i class="fas fa-book-open"></i>
                                <strong>Tipe Soal:</strong> {{ ucfirst($tipe->tipe) }}
                            </li>

                            <li style="--i:1">
                                <i class="fas fa-list-ol"></i>
                                <strong>Jumlah Soal:</strong> {{ $tipe->jumlah }}
                            </li>

                            <li style="--i:2">
                                <i class="fas fa-clock"></i>
                                <strong>Durasi:</strong> {{ $tipe->durasi }} Menit
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tombol kerjakan -->
@php
$boleh = $lamaran && trim($lamaran->status) === 'psikotes';
$sudah_dikerjakan = in_array(strtolower($tipe->tipe), array_map('strtolower', $psikotes_selesai ?? []));
@endphp

<a 
    @if($sudah_dikerjakan)
        href="javascript:void(0)"
        onclick="Swal.fire({
            icon:'info',
            title:'Sudah Pernah Mengerjakan',
            text:'Anda sudah pernah mengerjakan soal psikotes tipe {{ $tipe->tipe }}',
            confirmButtonColor:'#2563eb'
        })"
    @elseif($boleh)
        href="{{ route('pelamar.psikotes.kerjakan', $tipe->tipe) }}"
    @else
        href="javascript:void(0)"
        onclick="Swal.fire({
            icon:'warning',
            title:'Tidak Bisa Mengakses',
            text:'Status anda masih diverifikasi oleh admin.',
            confirmButtonColor:'#2563eb'
        })"
    @endif
    class="btn-lamar-float"
>
    Kerjakan
</a>


            </div>

        @empty
            <p class="text-muted">Belum ada data soal psikotes.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('warning'))
    <script>
    Swal.fire({
        icon: 'warning',
        title: 'Peringatan',
        text: "{{ session('warning') }}",
        confirmButtonColor: '#2563eb'
    });
    </script>
    @endif
</div>

{{-- gunakan style yang sama persis seperti kode 2 --}}
<style>
/* Grid */
.lowongan-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
    gap:25px;
}

/* Card */
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

/* Header */
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
}

.status-published {
    background:#2563eb;
}

/* Content grid */
.lowongan-content {
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:20px;
    margin-bottom:15px;
}

.deskripsi {
    font-size:14px;
    color:#334155;
    line-height:1.6;
}

/* Right box */
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

/* Button floating */
.btn-lamar-float {
    position:absolute;
    bottom:15px;
    right:20px;
    text-decoration:none;
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    color:white;
    padding:10px 22px;
    border-radius:12px;
    font-size:14px;
    font-weight:600;
    transition:0.3s;
}

.btn-lamar-float:hover {
    transform:translateY(-2px) scale(1.05);
    box-shadow:0 12px 25px rgba(37,99,235,0.3);
}

/* Responsive */
@media(max-width:768px){
    .lowongan-content {
        grid-template-columns: 1fr;
        gap:15px;
    }

    .btn-lamar-float {
        position:static;
        margin-top:10px;
    }
}
</style>
@endsection
