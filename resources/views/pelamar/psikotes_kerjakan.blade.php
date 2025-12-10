@extends('layouts.app')

@section('title', 'Kerjakan Psikotes')

@section('content')
<div class="content-wrapper">

    <h3 style="margin-bottom:25px;">Psikotes: {{ ucfirst($tipe) }}</h3>

    <!-- TIMER -->
    <div class="lowongan-card" style="margin-bottom:25px;">
        <div class="lowongan-header">
            <h4>Sisa Waktu</h4>
        </div>

        <div style="font-size:26px; font-weight:700; color:#dc2626;">
            <span id="time">--:--</span>
        </div>
    </div>

    <form id="form-psikotes" action="{{ route('pelamar.psikotes.submit', $psikotes->id) }}" method="POST">
        @csrf

        <div class="lowongan-grid">

        @foreach ($soal as $index => $item)
            <div class="lowongan-card">

                <!-- Header soal -->
                <div class="lowongan-header">
                    <h4 style="font-size:18px;">Soal {{ $index+1 }}</h4>
                </div>

                <div class="deskripsi" style="font-size:15px; margin-bottom:10px;">
                    {{ $item->pertanyaan }}
                </div>

                <!-- Pilihan Jawaban -->
                <div class="lowongan-right" style="background:white;">
                    @foreach (['A','B','C','D'] as $opt)
                        @php
                            $pilihan = "pilihan_" . strtolower($opt);
                        @endphp

                        @if ($item->$pilihan)
                            <label style="display:block; margin-bottom:8px; cursor:pointer;">
                                <input type="radio" name="jawaban[{{ $item->id }}]" value="{{ $opt }}" required>
                                {{ $opt }}. {{ $item->$pilihan }}
                            </label>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

        </div>

        <button type="submit" class="btn-lamar-float" style="position:static; margin-top:20px;">
            Selesaikan Psikotes
        </button>

    </form>

</div>

<script>
let duration = {{ $durasi * 60 }};
let timerDisplay = document.getElementById('time');

function updateTimer() {
    let minutes = Math.floor(duration / 60);
    let seconds = duration % 60;

    timerDisplay.textContent =
        String(minutes).padStart(2, '0') + ':' +
        String(seconds).padStart(2, '0');

    if (duration <= 0) {
        document.getElementById('form-psikotes').submit();
    }

    duration--;
}

setInterval(updateTimer, 1000);
updateTimer();
</script>

<style>
.lowongan-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
    gap:25px;
}

.lowongan-card {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    padding:25px;
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

.btn-lamar-float {
    text-decoration:none;
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    color:white;
    padding:12px 24px;
    border-radius:12px;
    font-size:16px;
    font-weight:600;
    transition:0.3s;
    display:inline-block;
}

.btn-lamar-float:hover {
    transform:translateY(-2px) scale(1.05);
    box-shadow:0 12px 25px rgba(37,99,235,0.3);
}
</style>

@endsection
