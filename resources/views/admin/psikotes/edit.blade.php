@extends('layouts.admin')

@section('title','Edit Soal Psikotes')

@section('content')

<form class="form-content" method="POST" action="{{ route('admin.psikotes.update', $soal->id) }}">
    @csrf
    @method('PUT')

    <h3 style="margin-bottom:15px;">Edit Soal Psikotes</h3>

    <!-- TIPE SOAL -->
    <label>Tipe Soal</label>
    <select name="tipe" required>
        <option value="kepribadian" {{ $soal->tipe == 'kepribadian' ? 'selected' : '' }}>Kepribadian</option>
        <option value="logika"      {{ $soal->tipe == 'logika' ? 'selected' : '' }}>Logika</option>
        <option value="numerik"     {{ $soal->tipe == 'numerik' ? 'selected' : '' }}>Numerik</option>
        <option value="verbal"      {{ $soal->tipe == 'verbal' ? 'selected' : '' }}>Verbal</option>
        <option value="analitis"    {{ $soal->tipe == 'analitis' ? 'selected' : '' }}>Analitis</option>
    </select>

    <label>Durasi (menit)</label>
    <input type="number" name="durasi" class="form-control" value="{{ old('pertanyaan', $soal->durasi) }}" required>

    <!-- PERTANYAAN -->
    <label>Pertanyaan</label>
    <textarea name="pertanyaan" rows="4" required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>

    <!-- OPSI JAWABAN + BOBOT -->
    <label>Opsi Jawaban (A)</label>
    <input type="text" name="pilihan_a" value="{{ old('pilihan_a', $soal->pilihan_a) }}">
    <label>Bobot A</label>
    <input type="number" name="bobot_a" value="{{ old('bobot_a', $soal->bobot_a) }}" required>

    <label>Opsi Jawaban (B)</label>
    <input type="text" name="pilihan_b" value="{{ old('pilihan_b', $soal->pilihan_b) }}">
    <label>Bobot B</label>
    <input type="number" name="bobot_b" value="{{ old('bobot_b', $soal->bobot_b) }}" required>

    <label>Opsi Jawaban (C)</label>
    <input type="text" name="pilihan_c" value="{{ old('pilihan_c', $soal->pilihan_c) }}">
    <label>Bobot C</label>
    <input type="number" name="bobot_c" value="{{ old('bobot_c', $soal->bobot_c) }}" required>

    <label>Opsi Jawaban (D)</label>
    <input type="text" name="pilihan_d" value="{{ old('pilihan_d', $soal->pilihan_d) }}">
    <label>Bobot D</label>
    <input type="number" name="bobot_d" value="{{ old('bobot_d', $soal->bobot_d) }}" required>

    <!-- KUNCI JAWABAN -->
    <label>Kunci Jawaban</label>
    <select name="kunci_jawaban">
        <option value="">-- Pilih --</option>
        <option value="A" {{ $soal->kunci_jawaban == 'A' ? 'selected' : '' }}>A</option>
        <option value="B" {{ $soal->kunci_jawaban == 'B' ? 'selected' : '' }}>B</option>
        <option value="C" {{ $soal->kunci_jawaban == 'C' ? 'selected' : '' }}>C</option>
        <option value="D" {{ $soal->kunci_jawaban == 'D' ? 'selected' : '' }}>D</option>
    </select>

    <!-- BOBOT SOAL -->
    <label>Bobot Soal (default 1)</label>
    <input type="number" name="bobot" value="{{ old('bobot', $soal->bobot) }}">

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
            Update Soal
        </button>
    </div>

</form>

@endsection
