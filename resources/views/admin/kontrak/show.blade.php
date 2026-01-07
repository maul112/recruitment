@extends('layouts.admin')

@section('title', 'Detail Kontrak')

@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-4xl mx-auto">
        
        {{-- Header & Back Button --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail & Kelola Kontrak</h1>
            <a href="{{ route('admin.kontrak.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Daftar
            </a>
        </div>

        {{-- Alamat Sesi Success/Error --}}
        @foreach (['success' => 'green', 'error' => 'red'] as $key => $color)
            @if (session()->has($key))
                <div class="bg-{{ $color }}-50 border border-{{ $color }}-400 text-{{ $color }}-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                    {{ $key == 'success' ? '✅' : '❌' }} <span class="ml-2">{{ session($key) }}</span>
                </div>
            @endif
        @endforeach

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Info Ringkas (Sidebar Kiri) --}}
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-4">Informasi Pelamar</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $kontrak->lamaran->pelamar->nama_lengkap }}</p>
                            <p class="text-xs text-gray-500">{{ $kontrak->lamaran->lowongan->posisi }}</p>
                        </div>
                        <hr class="border-gray-50">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Status Kontrak</p>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $kontrak->status == 'sudah' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($kontrak->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Tampilan Signature --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-4">Tanda Tangan</h3>
                    <div class="flex items-center justify-center border-2 border-dashed border-gray-100 rounded-xl p-4 bg-gray-50">
                        @if($kontrak->signature_path)
                            <img src="{{ asset('storage/'.$kontrak->signature_path) }}" alt="Signature" class="max-h-24 object-contain">
                        @else
                            <p class="text-xs text-gray-400 italic text-center">Belum ada tanda tangan</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Form Update (Kolom Utama) --}}
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Pembaruan Dokumen</h3>
                    
                    <form action="{{ route('admin.kontrak.update', $kontrak->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Input File Kontrak --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Dokumen Kontrak (PDF/DOCX)</label>
                            <div class="flex items-center space-x-4">
                                <input type="file" name="file_kontrak" accept=".pdf,.doc,.docx"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-200 rounded-lg cursor-pointer">
                                
                                @if($kontrak->file_kontrak_path)
                                    <a href="{{ asset('storage/'.$kontrak->file_kontrak_path) }}" target="_blank" class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200" title="Lihat File Sekarang">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Input Signature --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Ganti Signature (Gambar)</label>
                            <input type="file" name="signature" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-200 rounded-lg cursor-pointer">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Tanggal --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Tanggal Ditandatangani</label>
                                <input type="datetime-local" name="signed_at" 
                                    value="{{ $kontrak->signed_at ? date('Y-m-d\TH:i', strtotime($kontrak->signed_at)) : '' }}"
                                    class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>

                            {{-- Status --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Status Kontrak</label>
                                <select name="status" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <option value="belum" {{ $kontrak->status == 'belum' ? 'selected' : '' }}>Belum</option>
                                    <option value="sudah" {{ $kontrak->status == 'sudah' ? 'selected' : '' }}>Sudah Ditandatangani</option>
                                </select>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition duration-200 shadow-lg shadow-blue-100">
                                Simpan Perubahan Kontrak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection