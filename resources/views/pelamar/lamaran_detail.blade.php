@extends('layouts.app')

@section('title','Detail Lamaran')

@section('content')
<div class="content-wrapper">
    <h2>Detail Lamaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="lamaran-detail-card">
        <!-- Header -->
        <div class="header">
            <h3>{{ $lamaran->lowongan->posisi }}</h3>
            <span class="status {{ $lamaran->status }}">{{ ucfirst($lamaran->status) }}</span>
        </div>

        <!-- Info Perusahaan & Tanggal -->
        <div class="info">
            <p><strong>Perusahaan:</strong> {{ $lamaran->lowongan->perusahaan ?? '-' }}</p>
            <p><strong>Tanggal Lamar:</strong> {{ $lamaran->created_at->format('d M Y') }}</p>
        </div>

        <!-- Profil Pelamar -->
        <div class="section mt-4">
            <h4>Profil Pelamar</h4>
            <p><strong>Nama Lengkap:</strong> {{ $lamaran->pelamar->nama_lengkap }}</p>
            <p><strong>NIK:</strong> {{ $lamaran->pelamar->nik }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($lamaran->pelamar->tanggal_lahir)->format('d M Y') }}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $lamaran->pelamar->jenis_kelamin }}</p>
            <p><strong>Alamat:</strong> {{ $lamaran->pelamar->alamat }}</p>
        </div>

        <!-- Pendidikan & Nilai -->
        <div class="section">
            <h4>Pendidikan & Nilai</h4>
            <p><strong>Pendidikan Terakhir:</strong> {{ $lamaran->pelamar->pendidikan_terakhir ?? '-' }}</p>
            <p><strong>Prodi:</strong> {{ $lamaran->pelamar->prodi ?? '-' }}</p>
            <p><strong>Universitas:</strong> {{ $lamaran->pelamar->universitas ?? '-' }}</p>

            <p><strong>Nilai Administrasi:</strong> {{ $lamaran->nilai_administrasi ?? '-' }}</p>
            <p><strong>Nilai Psikotes:</strong> {{ $lamaran->nilai_psikotes ?? '-' }}</p>
            <p><strong>Nilai Wawancara:</strong> {{ $lamaran->nilai_wawancara ?? '-' }}</p>
            <p><strong>Total Nilai:</strong> {{ $lamaran->total_nilai ?? '-' }}</p>
        </div>

        <!-- Dokumen -->
        <div class="section">
            <h4>Dokumen</h4>
            <ul class="dokumen-list">
                @if($lamaran->pelamar->cv_path)
                    <li><a href="{{ Storage::url($lamaran->pelamar->cv_path) }}" target="_blank">CV</a></li>
                @endif
                @if($lamaran->pelamar->ijazah_path)
                    <li><a href="{{ Storage::url($lamaran->pelamar->ijazah_path) }}" target="_blank">Ijazah</a></li>
                @endif
                @if($lamaran->pelamar->transkrip_path)
                    <li><a href="{{ Storage::url($lamaran->pelamar->transkrip_path) }}" target="_blank">Transkrip Nilai</a></li>
                @endif
                @if($lamaran->pelamar->pas_foto_path)
                    <li><a href="{{ Storage::url($lamaran->pelamar->pas_foto_path) }}" target="_blank">Pas Foto</a></li>
                @endif
                @if($lamaran->pelamar->sertifikat_path)
                    <li><a href="{{ Storage::url($lamaran->pelamar->sertifikat_path) }}" target="_blank">Sertifikat</a></li>
                @endif
            </ul>
        </div>

        <!-- Catatan Admin -->
        @if($lamaran->catatan_admin)
        <div class="section">
            <h4>Catatan Admin</h4>
            <p>{{ $lamaran->catatan_admin }}</p>
        </div>
        @endif

        <a class="block w-full text-center border border-black rounded-2xl py-2 transition-all duration-300 hover:shadow-2xl" href="{{ route('pelamar.riwayat') }}">Kembali</a>
    </div>
</div>

<style>
.content-wrapper {
    max-width:900px;
    margin:auto;
    padding:30px;
    font-family:'Poppins',sans-serif;
}
h2 {
    text-align:center;
    font-weight:700;
    color:#1e293b;
    margin-bottom:30px;
}
.alert {
    padding:12px 18px;
    border-radius:12px;
    margin-bottom:20px;
    font-weight:600;
}
.alert-success { background:#16a34a; color:white; }
.alert-danger { background:#dc2626; color:white; }

.lamaran-detail-card {
    background:#ffffff;
    padding:25px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,0.08);
    transition:0.3s;
}
.lamaran-detail-card:hover {
    transform:translateY(-5px) scale(1.02);
    box-shadow:0 20px 40px rgba(37,99,235,0.15);
}

.header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}
.header h3 {
    font-size:20px;
    font-weight:700;
    color:#1e293b;
}
.status {
    font-size:12px;
    font-weight:600;
    padding:5px 12px;
    border-radius:12px;
    color:white;
    text-transform:uppercase;
}
.status.terkirim { background:#f59e0b; }
.status.diterima { background:#16a34a; }
.status.ditolak { background:#dc2626; }

.section {
    margin-bottom:20px;
}
.section h4 {
    font-weight:600;
    font-size:16px;
    margin-bottom:10px;
    color:#334155;
    border-bottom:2px solid #e2e8f0;
    padding-bottom:5px;
}

.dokumen-list {
    list-style:none;
    padding-left:0;
}
.dokumen-list li {
    margin-bottom:8px;
}
.dokumen-list li a {
    text-decoration:none;
    color:#2563eb;
    font-weight:600;
    transition:0.3s;
}
.dokumen-list li a:hover {
    text-decoration:underline;
}
</style>
@endsection
