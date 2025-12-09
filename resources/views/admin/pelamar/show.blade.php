@extends('layouts.admin')

@section('title','Detail Pelamar')

@section('content')
<div style="width:100%;">
    <h3 class="text-2xl">Detail Pelamar: <span class="font-bold">{{ $pelamar->nama_lengkap }}</span></h3>

    <div class="my-2">
        <label class="block">Nama Lengkap:</label>
        <input class="block border border-slate-300 w-full rounded-md p-2" type="text" name="nama_lengkap"
            value="{{ $pelamar->nama_lengkap }}" }}" 
            required disabled>
    </div>
    <div class="my-2">
        <label class="block">NIK:</label>
        <input class="block border border-slate-300 w-full rounded-md p-2" type="text" name="nama_lengkap"
            value="{{ $pelamar->nik }}" }}" 
            required disabled>
    </div>
    <div class="my-2">
        <label class="block">Tanggal Lahir:</label>
        <input class="block border border-slate-300 w-full rounded-md p-2" type="text" name="nama_lengkap"
            value="{{ $pelamar->tanggal_lahir }}" }}" 
            required disabled>
    </div>
    <div class="my-2">
        <label class="block">Jenis Kelamin:</label>
        <input class="block border border-slate-300 w-full rounded-md p-2" type="text" name="nama_lengkap"
            value="{{ $pelamar->jenis_kelamin }}" }}" 
            required disabled>
    </div>
    <div class="my-2">
        <label class="block">Alamat:</label>
        <input class="block border border-slate-300 w-full rounded-md p-2" type="text" name="nama_lengkap"
            value="{{ $pelamar->alamat }}" }}" 
            required disabled>
    </div>
    <div class="my-2">
        <label class="block">Pendidikan:</label>
        <input class="block border border-slate-300 w-full rounded-md p-2" type="text" name="nama_lengkap"
            value="{{ $pelamar->pendidikan_terakhir }} - {{ $pelamar->prodi }}" }}" 
            required disabled>
    </div>
    <div class="my-2">
        <label class="block">Universitas:</label>
        <input class="block border border-slate-300 w-full rounded-md p-2" type="text" name="nama_lengkap"
            value="{{ $pelamar->universitas }}" }}" 
            required disabled>
    </div>
    {{-- <ul>
        <li>NIK: {{ $pelamar->nik }}</li>
        <li>Tanggal Lahir: {{ $pelamar->tanggal_lahir }}</li>
        <li>Jenis Kelamin: {{ $pelamar->jenis_kelamin }}</li>
        <li>Alamat: {{ $pelamar->alamat }}</li>
        <li>Pendidikan: {{ $pelamar->pendidikan_terakhir }} - {{ $pelamar->prodi }}</li>
        <li>Universitas: {{ $pelamar->universitas }}</li>
    </ul> --}}

    <h3 class="text-2xl mb-2">Dokumen</h3>
    <ul>
        <li><a class="underline mb-1" href="{{ asset('upload/cv/'.$pelamar->cv_path) }}" target="_blank">CV</a></li>
        <li><a class="underline mb-1" href="{{ asset('upload/ijazah/'.$pelamar->ijazah_path) }}" target="_blank">Ijazah</a></li>
        <li><a class="underline mb-1" href="{{ asset('upload/transkrip/'.$pelamar->transkrip_path) }}" target="_blank">Transkrip</a></li>
        <li><a class="underline mb-1" href="{{ asset('upload/foto/'.$pelamar->pas_foto_path) }}" target="_blank">Pas Foto</a></li>
        <li><a class="underline mb-1" href="{{ asset('upload/sertifikat/'.$pelamar->sertifikat_path) }}" target="_blank">Sertifikat</a></li>
    </ul>

    <form class="my-2" action="{{ url('admin/pelamar/'.$pelamar->id.'/status') }}" method="POST">
        @csrf
        <label class="text-2xl block">Status Verifikasi:</label>
        <select name="status" class="border rounded my-4">
            <option value="pending" {{ $pelamar->status_verifikasi=='pending'?'selected':'' }}>Pending</option>
            <option value="valid" {{ $pelamar->status_verifikasi=='valid'?'selected':'' }}>Valid</option>
            <option value="tidak_valid" {{ $pelamar->status_verifikasi=='tidak_valid'?'selected':'' }}>Tidak Valid</option>
        </select>
        <button type="submit" class="block px-4 py-2 bg-blue-500 rounded-xl text-white hover:scale-105 transition-all duration-200 hover:shadow-2xl">Update Status</button>
    </form>
</div>
@endsection
