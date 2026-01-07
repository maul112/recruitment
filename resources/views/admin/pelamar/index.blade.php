@extends('layouts.admin')

@section('title','Data Pelamar')

@section('content')

<div style="width:100%;">

    <!-- HEADER -->
    <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom:18px; gap:12px;">
        <div>
            <h3 style="font-size:20px; margin-bottom:5px;">Daftar Pelamar</h3>
            <p style="color:#6b7280; font-size:14px;">
                Kelola semua data pelamar yang mendaftar
            </p>
        </div>

        <div style="display:flex; gap:12px; align-items:center;">
            <input id="searchInput" type="search" placeholder="Cari nama, NIK, atau pendidikan..." 
                   value="{{ $q ?? '' }}"
                   class="px-3.5 py-2.5 border border-gray-200 rounded-lg w-[360px] text-sm">

            <select id="statusFilter" class="px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm">
                <option value="">Semua status</option>
                <option value="pending" {{ (isset($status) && $status=='pending') ? 'selected' : '' }}>Pending</option>
                <option value="valid" {{ (isset($status) && $status=='valid') ? 'selected' : '' }}>Valid</option>
                <option value="tidak_valid" {{ (isset($status) && $status=='tidak_valid') ? 'selected' : '' }}>Tidak Valid</option>
            </select>
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
                    <th style="padding:12px;">Nama</th>
                    <th style="padding:12px;">NIK</th>
                    <th style="padding:12px;">Pendidikan</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($pelamars as $p)
                <tr class="row-anim">
                    <td style="padding:12px;"><strong>{{ $pelamars->firstItem() + $loop->index }}</strong></td>
                    <td style="padding:12px;">{{ $p->nama_lengkap }}</td>
                    <td style="padding:12px;">{{ $p->nik }}</td>
                    <td style="padding:12px;">{{ $p->pendidikan_terakhir ?? '-' }}</td>
                    <td style="padding:12px;">
                        @if($p->status_verifikasi=='pending')
                            <span style="display:inline-block; background:#fef3c7; color:#92400e; padding:6px 12px; border-radius:999px; font-weight:700; font-size:13px;">
                                Pending
                            </span>
                        @elseif($p->status_verifikasi=='valid')
                            <span style="display:inline-block; background:#dcfce7; color:#166534; padding:6px 12px; border-radius:999px; font-weight:700; font-size:13px;">
                                Valid
                            </span>
                        @else
                            <span style="display:inline-block; background:#fee2e2; color:#7f1d1d; padding:6px 12px; border-radius:999px; font-weight:700; font-size:13px;">
                                Tidak Valid
                            </span>
                        @endif
                    </td>
                    <td class="actions" style="padding:12px; display:flex; gap:8px; flex-wrap:wrap;">
                        <a class="btn text-sm" href="{{ route("admin.pelamar.show", $p->id) }}">Detail</a>
                        <form action="{{ url('admin/pelamars/'.$p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pelamar ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:45px;">
                        <div class="flex">
                            <div class="flex items-center gap-8 mx-auto">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80">
                                <p style="margin-top:15px; color:#6b7280;">Belum ada pelamar</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:18px;">
        <div style="color:#6b7280;">
            Menampilkan {{ $pelamars->firstItem() ?? 0 }} - {{ $pelamars->lastItem() ?? 0 }} dari {{ $pelamars->total() }} data
        </div>
        <div>
            {{ $pelamars->appends(request()->query())->links() }}
        </div>
    </div>

</div>

<!-- ====== Styles tambahan ====== -->
<style>
    table tbody tr.row-anim {
        transition: transform 220ms ease;
        box-shadow: 220ms ease;
        background: 160ms ease;
    }
    table tbody tr.row-anim:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(2,6,23,0.06);
        background: #ffffff;
    }
    @media (max-width:900px) {
        th, td { padding: 12px; font-size:13px; }
        #searchInput { width:200px; }
    }
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

<!-- ====== JS search + filter ====== -->
<script>
(function(){
    const search = document.getElementById('searchInput');
    const filter = document.getElementById('statusFilter');

    function debounce(fn, delay){
        let t;
        return function(...args){
            clearTimeout(t);
            t = setTimeout(()=> fn.apply(this,args), delay);
        };
    }

    function updateAndReload(){
        const params = new URLSearchParams(window.location.search);
        const qVal = search.value.trim();
        const statusVal = filter.value;

        if(qVal) params.set('q', qVal);
        else params.delete('q');

        if(statusVal) params.set('status', statusVal);
        else params.delete('status');

        params.delete('page');

        const newUrl = window.location.pathname + '?' + params.toString();
        window.history.replaceState({}, '', newUrl);
        window.location.href = newUrl;
    }

    const debouncedUpdate = debounce(updateAndReload, 650);

    search.addEventListener('input', debouncedUpdate);
    filter.addEventListener('change', updateAndReload);

    search.addEventListener('keydown', function(e){
        if(e.key === 'Enter') {
            e.preventDefault();
            updateAndReload();
        }
    });

})();
</script>

@endsection
