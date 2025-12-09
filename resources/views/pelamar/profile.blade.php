@extends('layouts.app')

@section('title','Profil Pelamar')

@section('content')
<div class="content-wrapper">
    <h2>Profil Pelamar</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('pelamar.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- DATA DASAR -->
        <div class="section-card">
            <h3>Data Dasar</h3>
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama_lengkap" 
                    value="{{ old('nama_lengkap', $pelamar->nama_lengkap ?? Auth::user()->name ?? '') }}" 
                    required>
            </div>
            <div class="form-group">
                <label>NIK *</label>
                <input type="text" name="nik" value="{{ old('nik', $pelamar->nik ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir *</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pelamar->tanggal_lahir ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin *</label>
                <select name="jenis_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki" {{ (old('jenis_kelamin',$pelamar->jenis_kelamin ?? '')=='Laki-laki')?'selected':'' }}>Laki-laki</option>
                    <option value="Perempuan" {{ (old('jenis_kelamin',$pelamar->jenis_kelamin ?? '')=='Perempuan')?'selected':'' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat *</label>
                <textarea name="alamat" required>{{ old('alamat',$pelamar->alamat ?? '') }}</textarea>
            </div>
        </div>

        <!-- DATA PENDIDIKAN & DOKUMEN -->
        <div class="section-card">
            <h3>Data Pendidikan & Dokumen</h3>
            <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir',$pelamar->pendidikan_terakhir ?? '') }}">
            </div>
            <div class="form-group">
                <label>Prodi</label>
                <input type="text" name="prodi" value="{{ old('prodi',$pelamar->prodi ?? '') }}">
            </div>
            <div class="form-group">
                <label>Universitas</label>
                <input type="text" name="universitas" value="{{ old('universitas',$pelamar->universitas ?? '') }}">
            </div>
            <div class="form-group">
                <label>CV (PDF)</label>
                <input type="file" name="cv_path" accept="application/pdf">
            </div>
            <div class="form-group">
                <label>Ijazah (PDF)</label>
                <input type="file" name="ijazah_path" accept="application/pdf">
            </div>
            <div class="form-group">
                <label>Transkrip Nilai (PDF)</label>
                <input type="file" name="transkrip_path" accept="application/pdf">
            </div>
            <div class="form-group">
                <label>Pas Foto (JPG/PNG)</label>
                <input type="file" name="pas_foto_path" accept="image/*">
            </div>
            <div class="form-group">
                <label>Sertifikat (PDF)</label>
                <input type="file" name="sertifikat_path" accept="application/pdf">
            </div>
        </div>
        <div class="flex gap-4">
            <a class="block w-full text-center border border-black rounded-2xl py-2 hover:scale-105 transition-all duration-300 hover:shadow-2xl" href="{{ route('pelamar.dashboard') }}">Kembali</a>
            <button type="submit" class="btn-submit w-full py-2">Simpan Profil</button>
        </div>
    </form>

</div>

<style>
/* Wrapper */
.content-wrapper {
    max-width:720px;
    margin:auto;
    background: #ffffff;
    padding:30px 35px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,0.07);
    margin-top:40px;
    margin-bottom:40px;
    font-family: 'Poppins', sans-serif;
}

/* Headings */
h2 { font-weight:700; color:#1e293b; margin-bottom:25px; text-align:center;}
h3 { font-weight:600; color:#334155; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:5px; }

/* Section Cards */
.section-card {
    background:#f8fafc;
    padding:20px 25px;
    border-radius:15px;
    margin-bottom:25px;
    transition:0.3s;
}
.section-card:hover {
    background:#eef2ff;
}

/* Form Groups */
.form-group { margin-bottom:15px; }
label { display:block; font-weight:600; margin-bottom:5px; color:#475569; }
input, select, textarea {
    width:100%;
    padding:10px 15px;
    border-radius:10px;
    border:1px solid #cbd5e1;
    outline:none;
    transition:0.3s;
}
input:focus, select:focus, textarea:focus {
    border-color:#2563eb;
    box-shadow:0 2px 8px rgba(37,99,235,0.2);
}

/* Button */
.btn-submit {
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    border:none;
    border-radius:15px;
    color:white;
    font-weight:700;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}
.btn-submit:hover {
    transform:translateY(-2px) scale(1.02);
    box-shadow:0 8px 20px rgba(37,99,235,0.3);
}

/* Alerts */
.alert {
    padding:12px 18px;
    border-radius:12px;
    margin-top:10px;
    font-weight:600;
}
.alert-success { background:#16a34a; color:white; }
.alert-danger { background:#dc2626; color:white; }
</style>
@endsection
