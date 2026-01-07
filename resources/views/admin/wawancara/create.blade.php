@extends('layouts.admin')

@section('title','Buat Wawancara')

@section('content')
<div class="w-full">

    <h3 class="text-2xl mb-2">Buat Wawancara Baru</h3>

    <form action="{{ route('admin.wawancara.store') }}" method="POST">
        @csrf
        <label class="block mb-2" for="lamaran_id">Lamaran Pelamar:</label>
        <select class="border border-gray-300 px-2 py-1 mb-4 rounded-md outline-none ring-[#2563eb] focus:ring-1 focus:ring-[#2563eb]" id="lamaran_id" name="lamaran_id" required>
            @foreach($lamaran as $l)
            <option value="{{ $l->id }}">{{ $l->pelamar->nama_lengkap }} - {{ $l->lowongan->posisi }}</option>
            @endforeach
        </select>
        <br>

        <label class="block mb-2" for="tipe">Tipe Wawancara:</label>
        <select class="border border-gray-300 px-2 py-1 mb-4 rounded-md outline-none ring-[#2563eb] focus:ring-1 focus:ring-[#2563eb]" name="tipe" id="tipe" required>
            <option value="HRD">HRD</option>
            <option value="Kepala Sekolah">Kepala Sekolah</option>
            <option value="Microteaching">Microteaching</option>
        </select>
        <br>

        <label class="block mb-2">Jadwal:</label>
        <input class="border border-gray-300 px-2 py-1 mb-4 rounded-md outline-none ring-[#2563eb] focus:ring-1 focus:ring-[#2563eb]" type="datetime-local" name="jadwal">
        <br>

        <label class="block mb-2">Lokasi:</label>
        <input class="w-1/2 border border-gray-300 px-2 py-1 mb-4 rounded-md outline-none ring-[#2563eb] focus:ring-1 focus:ring-[#2563eb]" type="text" name="lokasi">
        <br>

        <button class="bg-blue-600 text-white py-2 px-4 rounded-xl" type="submit">Simpan</button>
    </form>

</div>
@endsection
