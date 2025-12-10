@extends('layouts.app')

@section('title', 'Psikotes Selesai')

@section('content')
<div class="content-wrapper">
    <h3>Psikotes Selesai</h3>
    <p>Selamat! Anda telah menyelesaikan psikotes.</p>
</div>

<!-- Load SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        icon: 'success',
        title: 'Psikotes Selesai',
        text: "{{ session('success') ?? 'Anda akan diarahkan sebentar lagi.' }}",
        timer: 4000,
        timerProgressBar: true,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then(() => {
        window.location.href = "{{ route('pelamar.psikotes') }}";
    });

    // Fallback autoreload setelah 4 detik jika popup belum redirect
    setTimeout(() => {
        window.location.href = "{{ route('pelamar.psikotes') }}";
    }, 4000);
});
</script>
@endsection
