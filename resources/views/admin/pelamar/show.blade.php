@extends('layouts.admin')

@section('title','Detail Pelamar')

@section('content')
<h3>Detail Pelamar: {{ $pelamar->nama_lengkap }}</h3>

<ul>
    <li>NIK: {{ $pelamar->nik }}</li>
    <li>Tanggal Lahir: {{ $pelamar->tanggal_lahir }}</li>
    <li>Jenis Kelamin: {{ $pelamar->jenis_kelamin }}</li>
    <li>Alamat: {{ $pelamar->alamat }}</li>
    <li>Pendidikan: {{ $pelamar->pendidikan_terakhir }} - {{ $pelamar->prodi }}</li>
    <li>Universitas: {{ $pelamar->universitas }}</li>
</ul>

<h4>Dokumen</h4>
<ul>
    <li><a href="{{ asset('upload/cv/'.$pelamar->cv_path) }}" target="_blank">CV</a></li>
    <li><a href="{{ asset('upload/ijazah/'.$pelamar->ijazah_path) }}" target="_blank">Ijazah</a></li>
    <li><a href="{{ asset('upload/transkrip/'.$pelamar->transkrip_path) }}" target="_blank">Transkrip</a></li>
    <li><a href="{{ asset('upload/foto/'.$pelamar->pas_foto_path) }}" target="_blank">Pas Foto</a></li>
    <li><a href="{{ asset('upload/sertifikat/'.$pelamar->sertifikat_path) }}" target="_blank">Sertifikat</a></li>
</ul>

<form action="{{ url('admin/pelamars/'.$pelamar->id.'/status') }}" method="POST">
    @csrf
    <label>Status Verifikasi:</label>
    <select name="status">
        <option value="pending" {{ $pelamar->status_verifikasi=='pending'?'selected':'' }}>Pending</option>
        <option value="valid" {{ $pelamar->status_verifikasi=='valid'?'selected':'' }}>Valid</option>
        <option value="tidak_valid" {{ $pelamar->status_verifikasi=='tidak_valid'?'selected':'' }}>Tidak Valid</option>
    </select>
    <button type="submit">Update Status</button>
</form>

@endsection
