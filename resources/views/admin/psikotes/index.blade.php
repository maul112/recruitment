@extends('layouts.admin')

@section('title','Psikotes')

@section('content')
<div style="width:100%;">
    <div>
        <h3>Daftar Psikotes Pelamar</h3>
        <a href="{{ route('admin.psikotes.create') }}">Buat Psikotes Baru</a>
    </div>
    <div>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Pelamar</th>
                <th>Status</th>
                <th>Skor</th>
                <th>Rekomendasi</th>
                <th>Aksi</th>
            </tr>
            @foreach($psikotes as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->lamaran->pelamar->nama }}</td>
                <td>{{ $p->status }}</td>
                <td>{{ $p->skor_kognitif ?? '-' }}</td>
                <td>{{ $p->rekomendasi ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.psikotes.show', $p->id) }}">Lihat</a>
                    @if($p->status=='belum')
                        <form action="{{ route('admin.psikotes.nilai',$p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Nilai Otomatis</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
