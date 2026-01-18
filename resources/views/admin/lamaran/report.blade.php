<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekap Lamaran - {{ date('d M Y') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            @page { margin: 2cm; }
            body { font-family: 'Times New Roman', serif; }
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body class="bg-white p-10">

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold uppercase">Laporan Rekapitulasi Lamaran Kerja</h1>
        <p class="text-sm">Tanggal Cetak: {{ date('d F Y H:i') }}</p>
        @if(request('periode'))
            <p class="font-semibold">Periode: {{ date('F Y', strtotime(request('periode'))) }}</p>
        @endif
        <hr class="mt-4 border-t-2 border-black">
    </div>

    <table>
        <thead>
            <tr class="bg-gray-100">
                <th class="w-10 text-center">No</th>
                <th>Nama Pelamar</th>
                <th>Posisi</th>
                <th>Nilai</th>
                <th>Tgl Melamar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $index => $l)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <div class="font-bold">{{ $l->pelamar->nama_lengkap }}</div>
                        <div class="text-xs">{{ $l->pelamar->user->email }}</div>
                    </td>
                    <td>{{ $l->lowongan->posisi }}</td>
                    <td>{{ $l->nilai_administrasi + $l->nilai_psikotest + $l->nilai_wawancara }}</td>
                    <td>{{ $l->created_at->format('d/m/Y') }}</td>
                    <td class="capitalize">{{ $l->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Tidak ada data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-12 flex justify-end text-center">
        <div class="w-64">
            <p>Dicetak oleh,</p>
            <div class="h-20"></div>
            <p class="font-bold underline">{{ auth()->user()->name }}</p>
            <p>Admin Rekrutmen</p>
        </div>
    </div>

    <div class="fixed bottom-5 right-5 no-print">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg">
            Cetak Ulang
        </button>
        <button onclick="window.location.href = '{{ route('admin.lamaran.index') }}'" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-lg ml-2">
            Tutup Halaman
        </button>
    </div>

    <script>
        window.onload = function() {
            window.print();
            
            // Opsional: Tutup tab secara otomatis setelah print selesai/cancel
            // window.onafterprint = function() {
            //     window.close();
            // };
        };
    </script>
</body>
</html>