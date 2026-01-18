@extends('layouts.admin')

@section('title','Daftar Lamaran')

@section('content')
<div class="w-full">
    <div class="flex justify-between mb-4">
        <div>
            <h3 style="font-size:20px; margin-bottom:5px;" class="font-bold">Daftar Lamaran Pelamar</h3>
            <p style="color:#6b7280; font-size:14px;">
                Kelola semua data lamaran pelamar yang tersedia
            </p>
        </div>
        <div class="flex items-center gap-4">
            <input id="searchInput" type="month" placeholder="Cari berdasarkan bulan" 
                value="{{ old('periode', $q ?? '') }}"
                class="block px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm">
            <select id="statusFilter" class=" block px-3.5 py-2.5 border border-gray-200 rounded-lg text-sm">
                <option value="">Semua status</option>
                <option value="terkirim" {{ (isset($status) && $status=='terkirim') ? 'selected' : '' }}>Terkirim</option>
                <option value="verifikasi" {{ (isset($status) && $status=='verifikasi') ? 'selected' : '' }}>Verifikasi</option>
                <option value="ditolak_adm" {{ (isset($status) && $status=='ditolak_adm') ? 'selected' : '' }}>DItolak Admin</option>
                <option value="psikotes" {{ (isset($status) && $status=='psikotes') ? 'selected' : '' }}>Psikotes</option>
                <option value="wawancara" {{ (isset($status) && $status=='wawancara') ? 'selected' : '' }}>Wawancara</option>
                <option value="lulus" {{ (isset($status) && $status=='lulus') ? 'selected' : '' }}>Lulus</option>
                <option value="ditolak_akhir" {{ (isset($status) && $status=='ditolak_akhir') ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
            <a href="{{ route('admin.lamaran.report') }}" class="btn flex items-center justify-center rounded-xl hover:bg-gray-900 transition shadow-lg shadow-gray-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
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
                    <th style="padding:12px;">ID</th>
                    <th style="padding:12px;">Pelamar</th>
                    <th style="padding:12px;">Lowongan</th>
                    <th style="padding:12px;">Tanggal Daftar</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Total Nilai</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($lamarans as $l)
                <tr class="row-anim">
                    <td style="padding:12px;"><strong>{{ $l->id }}</strong></td>

                    <td style="padding:12px;">{{ $l->pelamar->nama_lengkap }}</td>

                    <td style="padding:12px;">{{ $l->lowongan->posisi }}</td>

                    <td style="padding:12px;">{{ $l->tanggal_daftar }}</td>

                    <td style="padding:12px;">{{ $l->status }}</td>

                    <td style="padding:12px;">{{ $l->total_nilai }}</td>

                    <td class="actions" style="padding:12px; display:flex; gap:8px; flex-wrap:wrap;">
                        <a class="btn text-sm" href="{{ route('admin.lamaran.edit', $l->id) }}">Edit</a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:45px;">
                        <div class="flex">
                            <div class="flex items-center gap-8 mx-auto">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80">
                                <p style="margin-top:15px; color:#6b7280;">Belum ada lowongan yang ditambahkan</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

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
