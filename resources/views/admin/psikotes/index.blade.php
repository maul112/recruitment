@extends('layouts.admin')

@section('title','Psikotes')

@section('content')

<div class="w-full">

    <!-- HEADER -->
    <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom:18px; gap:12px;">
        <div>
            <h3 style="font-size:20px; margin-bottom:5px;">Daftar Psikotes Pelamar</h3>
            <p style="color:#6b7280; font-size:14px;">
                Kelola seluruh hasil psikotes pelamar
            </p>
        </div>

        <a href="{{ route('admin.psikotes.create') }}" class="btn text-sm">
            + Buat Psikotes Baru
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div style="
            background:#ecfdf5;
            border:1px solid #34d399;
            color:#065f46;
            padding:14px 18px;
            border-radius:12px;
            margin-bottom:18px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- TABLE HASIL PSIKOTES -->
    <div class="table-scroll" style="overflow-x:auto; width:100%; margin-bottom:40px;">
        <table>
            <thead style="background:#f3f4f6; text-align:left;">
                <tr>
                    <th style="padding:12px;">ID</th>
                    <th style="padding:12px;">Pelamar</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Skor</th>
                    <th style="padding:12px;">Rekomendasi</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>

            <tbody id="tableBody">
                @forelse($psikotes as $p)
                <tr class="row-anim">
                    <td style="padding:12px;"><strong>{{ $p->id }}</strong></td>
                    <td style="padding:12px;">{{ $p->lamaran->pelamar->nama_lengkap }}</td>

                    <td style="padding:12px;">
                        @if($p->status == 'belum')
                            <span style="display:inline-block; background:#fef3c7; color:#92400e; padding:6px 12px; border-radius:999px; font-size:13px; font-weight:700;">
                                Belum Dinilai
                            </span>
                        @elseif($p->status == 'selesai')
                            <span style="display:inline-block; background:#dcfce7; color:#166534; padding:6px 12px; border-radius:999px; font-size:13px; font-weight:700;">
                                Selesai
                            </span>
                        @else
                            <span style="display:inline-block; background:#e5e7eb; color:#374151; padding:6px 12px; border-radius:999px; font-size:13px; font-weight:700;">
                                {{ ucfirst($p->status) }}
                            </span>
                        @endif
                    </td>

                    <td style="padding:12px;">{{ $p->skor_kognitif ?? '-' }}</td>

                    <td style="padding:12px;">
                        <small style="color:#6b7280;">{{ $p->rekomendasi ?? '-' }}</small>
                    </td>

                    <td style="padding:12px; display:flex; gap:8px; flex-wrap:wrap;">
                        <a class="btn text-sm" href="{{ route('admin.psikotes.show',$p->id) }}">
                            Lihat
                        </a>

                        @if($p->status == 'belum')
                            <form action="{{ route('admin.psikotes.nilai',$p->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Nilai otomatis psikotes ini?')">
                                @csrf
                                <button type="submit" class="btn text-sm">
                                    Nilai Otomatis
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:45px;">
                        <div class="flex">
                            <div class="flex items-center gap-8 mx-auto">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80">
                                <p style="margin-top:15px; color:#6b7280;">Belum ada data psikotes</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:15px;">
        {{ $psikotes->links() }}
    </div>


    <!-- ============================= -->
    <!-- DAFTAR SOAL PSIKOTES          -->
    <!-- ============================= -->
    <h3 style="font-size:18px; margin-bottom:10px; margin-top:25px;">Daftar Soal Psikotes</h3>
    <p style="color:#6b7280; font-size:14px; margin-bottom:12px;">Semua soal yang telah ditambahkan</p>

    <div class="table-scroll" style="overflow-x:auto; width:100%;">
        <table>
            <thead style="background:#f3f4f6;">
                <tr>
                    <th style="padding:12px;">ID</th>
                    <th style="padding:12px;">Tipe</th>
                    <th style="padding:12px;">Pertanyaan</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($soal as $s)
                <tr class="row-anim">
                    <td style="padding:12px;"><strong>{{ $s->id }}</strong></td>
                    <td style="padding:12px;">{{ ucfirst($s->tipe) }}</td>
                    <td style="padding:12px; max-width:450px;">{{ Str::limit($s->pertanyaan, 110) }}</td>

                    <td style="padding:12px; display:flex; gap:8px;">
                        <a href="{{ route('admin.psikotes.edit', $s->id) }}" class="btn text-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.psikotes.destroy', $s->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus soal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn text-sm" style="background:#dc2626;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:40px;">
                        <p style="color:#6b7280;">Belum ada soal yang ditambahkan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:15px;">
        {{ $soal->links() }}
    </div>
</div>

<style>
    table tbody tr.row-anim {
        transition: transform 220ms ease, box-shadow 220ms ease, background 160ms ease;
    }
    table tbody tr.row-anim:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(2,6,23,0.06);
        background: #ffffff;
    }
</style>

@endsection
