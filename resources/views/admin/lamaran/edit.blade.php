@extends('layouts.admin')

@section('title','Edit Lamaran')

@section('content')
<h3>Edit Lamaran</h3>

<form method="POST" action="{{ route('admin.lamaran.update', $lamaran->id) }}">
    @csrf
    <label>Status:</label>
    <select name="status" required>
        <option value="terkirim" {{ $lamaran->status=='terkirim' ? 'selected':'' }}>Terkirim</option>
        <option value="verifikasi" {{ $lamaran->status=='verifikasi' ? 'selected':'' }}>Verifikasi</option>
        <option value="ditolak_adm" {{ $lamaran->status=='ditolak_adm' ? 'selected':'' }}>Ditolak Admin</option>
        <option value="psikotes" {{ $lamaran->status=='psikotes' ? 'selected':'' }}>Psikotes</option>
        <option value="wawancara" {{ $lamaran->status=='wawancara' ? 'selected':'' }}>Wawancara</option>
        <option value="diterima" {{ $lamaran->status=='diterima' ? 'selected':'' }}>Diterima</option>
    </select>

    <label>Catatan Admin:</label>
    <textarea name="catatan_admin">{{ $lamaran->catatan_admin }}</textarea>

    <label>Nilai Administrasi:</label>
    <input type="number" name="nilai_administrasi" value="{{ $lamaran->nilai_administrasi }}">

    <label>Nilai Psikotes:</label>
    <input type="number" name="nilai_psikotes" value="{{ $lamaran->nilai_psikotes }}">

    <label>Nilai Wawancara:</label>
    <input type="number" name="nilai_wawancara" value="{{ $lamaran->nilai_wawancara }}">

    <button type="submit">Simpan</button>
</form>
@endsection
