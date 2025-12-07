@extends('layouts.admin')

@section('title','Buat Psikotes')

@section('content')
<div style="width:100%;">
    <h3>Buat Psikotes Baru</h3>
    
    <form action="{{ route('admin.psikotes.store') }}" method="POST">
        @csrf
        <label>Lamaran Pelamar:</label>
        <select name="lamaran_id" required>
            @foreach($lamaran as $l)
            <option value="{{ $l->id }}">{{ $l->pelamar->nama }} - {{ $l->posisi }}</option>
            @endforeach
        </select>
        <br>
        <label>Mulai Tes:</label>
        <input type="datetime-local" name="mulai_at">
        <br>
        <label>Selesai Tes:</label>
        <input type="datetime-local" name="selesai_at">
        <br>
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
