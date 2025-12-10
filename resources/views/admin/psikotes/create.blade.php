@extends('layouts.admin')

@section('title','Tambah Soal Psikotes')

@section('content')

<form class="form-content" method="POST" action="{{ route('admin.soal_psikotes.store') }}">
    @csrf

    <h3 style="margin-bottom:15px;">Tambah Soal Psikotes</h3>

    <!-- TIPE SOAL -->
    <label>Tipe Soal</label>
    <select name="tipe" required>
        <option value="">-- Pilih Tipe --</option>
        <option value="kepribadian">Kepribadian</option>
        <option value="logika">Logika</option>
        <option value="numerik">Numerik</option>
        <option value="verbal">Verbal</option>
        <option value="analitis">Analitis</option>
    </select>

    <label>Durasi (menit)</label>
    <input type="number" name="durasi" class="form-control" required>

    <!-- PERTANYAAN -->
    <label>Pertanyaan</label>
    <textarea name="pertanyaan" rows="4" required>{{ old('pertanyaan') }}</textarea>

    <!-- OPSI JAWABAN + BOBOT -->
    <label>Opsi Jawaban (A)</label>
    <input type="text" name="pilihan_a" value="{{ old('pilihan_a') }}">
    <label>Bobot A</label>
    <input type="number" name="bobot_a" value="{{ old('bobot_a', 1) }}" required>

    <label>Opsi Jawaban (B)</label>
    <input type="text" name="pilihan_b" value="{{ old('pilihan_b') }}">
    <label>Bobot B</label>
    <input type="number" name="bobot_b" value="{{ old('bobot_b', 1) }}" required>

    <label>Opsi Jawaban (C)</label>
    <input type="text" name="pilihan_c" value="{{ old('pilihan_c') }}">
    <label>Bobot C</label>
    <input type="number" name="bobot_c" value="{{ old('bobot_c', 1) }}" required>

    <label>Opsi Jawaban (D)</label>
    <input type="text" name="pilihan_d" value="{{ old('pilihan_d') }}">
    <label>Bobot D</label>
    <input type="number" name="bobot_d" value="{{ old('bobot_d', 1) }}" required>

    <!-- KUNCI JAWABAN -->
    <label>Kunci Jawaban</label>
    <select name="kunci_jawaban">
        <option value="">-- Pilih --</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select>

    <!-- BOBOT SOAL KESELURUHAN -->
    <label>Bobot Soal (default 1)</label>
    <input type="number" name="bobot" value="{{ old('bobot', 1) }}">

    <!-- TOMBOL -->
    <div style="display:flex; width:100%; margin-top:18px; gap:10px;">
        <a href="{{ route('admin.psikotes.index') }}"
            class="btn"
            style="flex:1; background:#f3f4f6; color:#111; padding:10px 0; border-radius:8px; text-align:center;">
            Kembali
        </a>

        <button type="submit"
                class="btn"
                style="flex:1; background:#2563eb; color:white; padding:10px 0; border-radius:8px; text-align:center;">
            Simpan Soal
        </button>
    </div>

</form>

@endsection
