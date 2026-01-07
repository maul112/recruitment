@extends('layouts.admin')

@section('title','Edit Lamaran')

@section('content')
<div class="w-full">
    <h3 class="mb-2 text-2xl">Edit Lamaran</h3>

    <form method="POST" action="{{ route('admin.lamaran.update', $lamaran->id) }}">
        @csrf
        <label class="block my-2">Status:</label>
        <select class="border rounded-md p-2" name="status" required>
            <option value="terkirim" {{ $lamaran->status=='terkirim' ? 'selected':'' }}>Terkirim</option>
            <option value="verifikasi" {{ $lamaran->status=='verifikasi' ? 'selected':'' }}>Verifikasi</option>
            <option value="ditolak_adm" {{ $lamaran->status=='ditolak_adm' ? 'selected':'' }}>Ditolak Admin</option>
            <option value="psikotes" {{ $lamaran->status=='psikotes' ? 'selected':'' }}>Psikotes</option>
            <option value="wawancara" {{ $lamaran->status=='wawancara' ? 'selected':'' }}>Wawancara</option>
            <option value="lulus" {{ $lamaran->status=='lulus' ? 'selected':'' }}>Diterima</option>
            <option value="ditolak_adm" {{ $lamaran->status=='ditolak_akhir' ? 'selected':'' }}>Ditolak Akhir</option>
        </select>

        <label class="block my-2">Catatan Admin:</label>
        <textarea class="w-full border rounded-md p-2" name="catatan_admin">{{ $lamaran->catatan_admin }}</textarea>

        <label class="block my-2">Nilai Administrasi:</label>
        <input class="border rounded-md p-2" type="number" name="nilai_administrasi" value="{{ $lamaran->nilai_administrasi }}">

        <label class="block my-2">Nilai Psikotes:</label>
        <input class="border rounded-md p-2" type="number" name="nilai_psikotes" value="{{ $lamaran->nilai_psikotes }}">

        <label class="block my-2">Nilai Wawancara:</label>
        <input class="border rounded-md p-2" type="number" name="nilai_wawancara" value="{{ $lamaran->nilai_wawancara }}">

        <button class="btn block mt-4 py-2 px-4 rounded-xl text-white hover:scale-105 transition-all duration-200 hover:shadow-2xl" type="submit">Simpan</button>
    </form>

</div>
@endsection
