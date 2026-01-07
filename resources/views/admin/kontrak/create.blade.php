@extends('layouts.admin')

@section('title','Tambah Kontrak')

@section('content')
<div class="w-full">
    <h3 class="mb-4">Tambah Kontrak</h3>

    <form action="{{ route('admin.kontrak.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block">Lamaran Pelamar:</label>
        <select class="border border-gray-300 px-2 py-1 mb-4 rounded-md outline-none ring-[#2563eb] focus:ring-1 focus:ring-[#2563eb]" name="lamaran_id" required>
            @foreach($lamaran as $l)
            <option value="{{ $l->id }}">{{ $l->pelamar->nama_lengkap }} - {{ $l->lowongan->posisi }}</option>
            @endforeach
        </select>

        <label class="block">File Kontrak:</label>
        {{-- <input class="border border-gray-300 px-2 py-1 mb-4 rounded-md outline-none ring-[#2563eb] focus:ring-1 focus:ring-[#2563eb]" type="file" name="file_kontrak" required> --}}

        <input type="file" name="file_kontrak" required accept=".pdf,.doc,.docx,application/pdf"
            class="block w-fit text-sm text-gray-500 mb-4
            file:mr-4 file:py-2 file:px-4
            file:rounded-md file:border-0
            file:text-sm file:font-semibold
            file:bg-blue-50 file:text-blue-700
            hover:file:bg-blue-100
            border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

        <label class="block">Signature (opsional):</label>
        <input type="file" name="signature" accept="image/*"
            class="block w-fit text-sm text-gray-500 mb-4
            file:mr-4 file:py-2 file:px-4
            file:rounded-md file:border-0
            file:text-sm file:font-semibold
            file:bg-blue-50 file:text-blue-700
            hover:file:bg-blue-100
            border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

        <label class="block">Tanggal Ditandatangani (opsional):</label>
        <input class="border border-gray-300 px-2 py-1 mb-4 rounded-md outline-none ring-[#2563eb] focus:ring-1 focus:ring-[#2563eb]" type="datetime-local" name="signed_at">

        <label class="block">Status:</label>
        <select class="border border-gray-300 px-2 py-1 mb-4 rounded-md outline-none ring-[#2563eb] focus:ring-1 focus:ring-[#2563eb]" name="status">
            <option value="belum">Belum</option>
            <option value="ditandatangani">Ditandatangani</option>
        </select>

        <button class="btn block" type="submit">Simpan Kontrak</button>
    </form>
</div>
@endsection
