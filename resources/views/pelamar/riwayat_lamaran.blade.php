@extends('layouts.app')

@section('title','Riwayat Lamaran')

@section('content')
<div class="content-wrapper">
    <h2>Riwayat Lamaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Filter Status -->
    <div class="filter-container">
        <form method="GET" action="{{ route('pelamar.riwayat') }}">
            <select name="status" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="terkirim" {{ request('status')=='terkirim'?'selected':'' }}>Terkirim</option>
                <option value="verifikasi" {{ request('status')=='verifikasi'?'selected':'' }}>Verifikasi</option>
                <option value="ditolak_adm" {{ request('status')=='ditolak_adm'?'selected':'' }}>Ditolak Admin</option>
                <option value="psikotes" {{ request('status')=='psikotes'?'selected':'' }}>Psikotes</option>
                <option value="wawancara" {{ request('status')=='wawancara'?'selected':'' }}>Wawancara</option>
                <option value="lulus" {{ request('status')=='lulus'?'selected':'' }}>Lulus</option>
                <option value="ditolak_akhir" {{ request('status')=='ditolak_akhir'?'selected':'' }}>Ditolak Akhir</option>
            </select>
        </form>
    </div>

    @if($lamarans->isEmpty())
        <p class="empty-msg">Belum ada riwayat lamaran.</p>
    @else
        <div class="lamaran-grid">
            @foreach($lamarans as $lamaran)
            <div class="lamaran-card">
                <div class="lamaran-header">
                    <h3>{{ $lamaran->lowongan->posisi }}</h3>
                    <span class="status {{ $lamaran->status }}">{{ ucfirst(str_replace('_',' ',$lamaran->status)) }}</span>
                </div>
                <div class="lamaran-info">
                    <div>
                        {{-- <i class="fas fa-building"></i>
                        <span>{{ $lamaran->lowongan->perusahaan ?? '-' }}</span> --}}
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>
                            {{ $lamaran->wawancara?->jadwal?->format('d M Y') ?? '-' }}, {{ $lamaran->wawancara?->lokasi?? '-' }}
                        </span>
                    </div>
                </div>
                <div class="lamaran-footer">
                    <a href="{{ route('pelamar.lamaran.detail', $lamaran->id) }}" class="btn-detail">Detail</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.content-wrapper {
    max-width:980px;
    margin:auto;
    padding:30px 20px;
    font-family:'Poppins',sans-serif;
}
h2 {
    text-align:center;
    font-weight:700;
    color:#1e293b;
    margin-bottom:30px;
}

/* Filter stylish */
.filter-container {
    text-align:right;
    margin-bottom:25px;
}
.filter-container select {
    padding:10px 18px;
    border-radius:20px;
    border:1px solid #cbd5e1;
    outline:none;
    cursor:pointer;
    font-weight:500;
    background:linear-gradient(90deg,#f1f5f9,#e2e8f0);
    transition:0.3s;
}
.filter-container select:focus {
    border-color:#2563eb;
    box-shadow:0 4px 14px rgba(37,99,235,0.25);
}

/* Grid */
.lamaran-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
    gap:25px;
}

/* Card modern */
.lamaran-card {
    background: linear-gradient(135deg,#ffffff,#f0f4f8);
    padding:22px 25px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,0.08);
    transition:0.5s;
    display:flex;
    flex-direction:column;
}
.lamaran-card:hover {
    transform:translateY(-7px) scale(1.03);
    box-shadow:0 20px 40px rgba(37,99,235,0.15);
}

/* Header & status badge */
.lamaran-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}
.lamaran-header h3 {
    font-size:19px;
    font-weight:600;
    color:#1e293b;
}
.status {
    font-size:12px;
    font-weight:600;
    padding:5px 14px;
    border-radius:50px;
    color:white;
    text-transform:uppercase;
    opacity:0.95;
}
.status.terkirim { background:#f59e0b; }
.status.verifikasi { background:#0ea5e9; }
.status.ditolak_adm { background:#ef4444; }
.status.psikotes { background:#8b5cf6; }
.status.wawancara { background:#f97316; }
.status.lulus { background:#16a34a; }
.status.ditolak_akhir { background:#dc2626; }

/* Info items */
.lamaran-info {
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    margin-bottom:18px;
}
.info-item {
    display:flex;
    align-items:center;
    gap:8px;
    font-size:14px;
    color:#475569;
    background:rgba(37,99,235,0.05);
    padding:6px 12px;
    border-radius:12px;
    margin-bottom:8px;
}
.info-item i {
    color:#2563eb;
}

/* Footer button */
.lamaran-footer {
    margin-top:auto;
    text-align:right;
}
.btn-detail {
    text-decoration:none;
    background:#2563eb;
    color:white;
    padding:10px 18px;
    border-radius:14px;
    font-weight:600;
    transition:0.3s;
}
.btn-detail:hover {
    transform:translateY(-2px) scale(1.03);
    box-shadow:0 10px 25px rgba(37,99,235,0.3);
}

/* Empty msg */
.empty-msg {
    text-align:center;
    font-size:15px;
    color:#64748b;
    margin-top:30px;
}

/* Alerts */
.alert {
    padding:12px 18px;
    border-radius:12px;
    margin-bottom:25px;
    font-weight:600;
}
.alert-success { background:#16a34a; color:white; }
.alert-danger { background:#dc2626; color:white; }

/* Responsive */
@media(max-width:768px){
    .lamaran-grid { grid-template-columns:1fr; gap:18px; }
    .filter-container { text-align:left; margin-bottom:20px; }
}
</style>
@endsection
