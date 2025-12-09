@extends('layouts.admin')

@section('title','Data Lowongan')

@section('content')

<div style="width:100%;">

    <!-- HEADER -->
    <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom:18px; gap:12px;">
        <div>
            <h3 style="font-size:20px; margin-bottom:5px;">Daftar Lowongan Kerja</h3>
            <p style="color:#6b7280; font-size:14px;">
                Kelola semua data lowongan yang tersedia
            </p>
        </div>

        <div style="display:flex; gap:12px; align-items:center;">
            <input id="searchInput" type="search" placeholder="Cari posisi, kualifikasi atau deskripsi..." 
                   value="{{ $q ?? '' }}"
                   style="padding:10px 14px; border-radius:10px; border:1px solid #e5e7eb; width:360px;">
            
            <select id="statusFilter" style="padding:10px 14px; border-radius:10px; border:1px solid #e5e7eb;">
                <option value="">Semua status</option>
                <option value="draft" {{ (isset($status) && $status=='draft') ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ (isset($status) && $status=='published') ? 'selected' : '' }}>Dibuka</option>
                <option value="closed" {{ (isset($status) && $status=='closed') ? 'selected' : '' }}>Ditutup</option>
            </select>

            <a href="{{ url('/admin/lowongan/create') }}" class="btn">
                + Tambah Lowongan
            </a>
        </div>
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

    <!-- TABLE -->
    <div class="table-scroll" style="overflow-x:auto; width:100%;">
        <table>
            <thead style="background:#f3f4f6; text-align:left;">
                <tr>
                    <th style="padding:12px;">#</th>
                    <th style="padding:12px;">Posisi</th>
                    <th style="padding:12px;">Deskripsi</th>
                    <th style="padding:12px;">Pendidikan</th>
                    <th style="padding:12px;">Tanggal</th>
                    <th style="padding:12px;">Dokumen Wajib</th>
                    <th style="padding:12px;">Kuota</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>

            <tbody id="tableBody">
                @forelse($lowongans as $l)
                <tr class="row-anim">
                    <td style="padding:12px;"><strong>{{ $lowongans->firstItem() + $loop->index }}</strong></td>

                    <td style="padding:12px;">{{ $l->posisi }}</td>

                    <td style="padding:12px;">
                        <small style="color:#6b7280;">{{ $l->deskripsi ?? '-' }}</small>
                    </td>

                    <td style="padding:12px;">{{ $l->kualifikasi_pendidikan ?? '-' }}</td>

                    <td style="padding:12px;">
                        {{ $l->tanggal_buka ? \Carbon\Carbon::parse($l->tanggal_buka)->format('d M Y') : '-' }}
                        <br>
                        <small style="color:#6b7280;">s/d</small>
                        {{ $l->tanggal_tutup ? \Carbon\Carbon::parse($l->tanggal_tutup)->format('d M Y') : '-' }}
                    </td>

                    <td style="padding:12px;">{{ $l->dokumen_wajib ?? '-' }}</td>

                    <td style="padding:12px;">
                        <span style="
                            display:inline-block;
                            background:#e0f2fe;
                            color:#0369a1;
                            padding:6px 12px;
                            border-radius:999px;
                            font-size:13px;
                            font-weight:700;">
                            {{ $l->kuota ?? 1 }}
                        </span>
                    </td>

                    <td style="padding:12px;">
                        @if($l->status == 'draft')
                            <span style="display:inline-block; background:#fef3c7; color:#92400e; padding:6px 12px; border-radius:999px; font-weight:700; font-size:13px;">
                                Draft/Disimpan
                            </span>
                        @elseif($l->status == 'published')
                            <span style="display:inline-block; background:#dcfce7; color:#166534; padding:6px 12px; border-radius:999px; font-weight:700; font-size:13px;">
                                Published/Dibuka
                            </span>
                        @else
                            <span style="display:inline-block; background:#fee2e2; color:#7f1d1d; padding:6px 12px; border-radius:999px; font-weight:700; font-size:13px;">
                                Closed/Ditutup
                            </span>
                        @endif
                    </td>

                    <td class="actions" style="padding:12px; display:flex; gap:8px; flex-wrap:wrap;">
                        <a class="btn" href="{{ url('/admin/lowongan/edit/'.$l->id) }}">Edit</a>

                        <form method="POST" action="{{ url('/admin/lowongan/delete/'.$l->id) }}" onsubmit="return confirm('Hapus lowongan ini?')">
                            @csrf
                            <button type="submit" class="btn">Hapus</button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:45px;">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80">
                        <p style="margin-top:15px; color:#6b7280;">Belum ada lowongan yang ditambahkan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:18px;">
        <div style="color:#6b7280;">
            Menampilkan {{ $lowongans->firstItem() ?? 0 }} - {{ $lowongans->lastItem() ?? 0 }} dari {{ $lowongans->total() }} data
        </div>

        <div>
            {{ $lowongans->appends(request()->query())->links() }}
        </div>
    </div>

</div>

<!-- ====== Styles tambahan untuk animasi row dan responsive tweak ====== -->
<style>
    /* hover lebih halus & elevasi */
    table tbody tr.row-anim {
        transition: transform 220ms ease, box-shadow 220ms ease, background 160ms ease;
    }
    table tbody tr.row-anim:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(2,6,23,0.06);
        background: #ffffff;
    }

    /* responsive: kecilkan padding sel pada mobile */
    @media (max-width:900px) {
        th, td { padding: 12px; font-size:13px; }
        #searchInput { width:200px; }
    }

    /* pagination default styling tweak */
    .pagination { display:flex; gap:6px; list-style:none; padding:0; margin:0; }
    .pagination li a, .pagination li span {
        padding:8px 12px;
        border-radius:8px;
        border:1px solid #e6e9ee;
        color:#0f172a;
        text-decoration:none;
        background:white;
    }
    .pagination li.active span, .pagination li a[aria-current="page"] {
        background:#2563eb; color:white; border-color:#2563eb;
    }
</style>

<!-- ====== JS untuk search realtime + filter (debounced) ====== -->
<script>
    (function(){
        const search = document.getElementById('searchInput');
        const filter = document.getElementById('statusFilter');

        // small debounce helper
        function debounce(fn, delay){
            let t;
            return function(...args){
                clearTimeout(t);
                t = setTimeout(()=> fn.apply(this,args), delay);
            };
        }

        // update URL query params and reload page
        function updateAndReload(){
            const params = new URLSearchParams(window.location.search);
            const qVal = search.value.trim();
            const statusVal = filter.value;

            if(qVal) params.set('q', qVal);
            else params.delete('q');

            if(statusVal) params.set('status', statusVal);
            else params.delete('status');

            // reset to page 1 when searching/filtering
            params.delete('page');

            const newUrl = window.location.pathname + '?' + params.toString();
            window.history.replaceState({}, '', newUrl);
            // reload content (full page) — server-side pagination needed
            window.location.href = newUrl;
        }

        const debouncedUpdate = debounce(updateAndReload, 650);

        search.addEventListener('input', debouncedUpdate);
        filter.addEventListener('change', function(){ updateAndReload(); });

        // allow Enter in search to immediately submit
        search.addEventListener('keydown', function(e){
            if(e.key === 'Enter') {
                e.preventDefault();
                updateAndReload();
            }
        });

    })();
</script>

@endsection
