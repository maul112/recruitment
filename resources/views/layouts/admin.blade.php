<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            background: #f8fafc;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #020617, #0f172a);
            color: white;
            padding: 25px 20px;
            position: fixed;
            top: 0;
            bottom: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 35px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #38bdf8;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-size: 14px;
        }

        .sidebar a:hover {
            background: #1e293b;
            transform: translateX(5px);
        }

        .logout {
            margin-top: 50px;
            background: crimson;
            text-align: center;
            border-radius: 12px;
        }

        /* ================= CARDS DASHBOARD ================= */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            width: 100%;
        }

        .cards .card {
            background: #fff;
            color: #000;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .cards .card h3 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .cards .card p {
            font-size: 14px;
            font-weight: 500;
        }

        .cards .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        /* ================= CONTENT ================= */
        .content {
            flex: 1;
            margin-left: 260px;
            padding: 40px;
        }

        .topbar {
            background: white;
            padding: 20px 30px;
            border-radius: 18px;
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        .topbar h2 {
            font-size: 22px;
        }

        /* ✅ WRAPPER AGAR FORM DI TENGAH */
        .content-wrapper {
            width: 100%;
            min-height: 70vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        /* ================= TABLE ================= */
        /* Wrap table agar scroll horizontal */
        .table-scroll {
            overflow-x: auto;       /* scroll horizontal */
            -webkit-overflow-scrolling: touch; /* smooth scroll di mobile */
        }

        /* Table agar tetap bisa scroll, min-width agar tidak terlalu kecil */
        .table-scroll table {
            min-width: 900px;       /* sesuaikan lebar minimum table */
            border-collapse: collapse;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
        }

        td.actions {
            display:flex;
            gap:8px;
            flex-wrap: wrap; /* agar tombol wrap kalau terlalu sempit */
        }

        td.actions .btn {
            width: auto; /* biarkan mengikuti konten */
            flex: none;
            padding: 8px 16px;
        }

        th {
            padding: 18px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #020617;
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background: #f9fafb;
        }

        tr:hover {
            background: #f1f5f9;
        }

        /* ================= FORM ================= */
        .form-content {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
            width: 920px;
            animation: slideUp 0.5s ease;
        }

        .form-content label {
            margin-top: 10px;
            display: block;
            font-weight: 500;
            font-size: 14px;
        }

        .form-content input,
        .form-content textarea,
        .form-content select {
            width: 100%;
            padding: 12px 15px;
            margin: 8px 0 15px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .form-content input:focus,
        .form-content textarea:focus,
        .form-content select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* ================= BUTTON ================= */
        .btn {
            padding: 10px 16px;
            background: #2563eb;
            color: white;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            /* width: 40%; */
            transition: 0.3s;
        }

        .btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #2563eb;
        }

        .btn-danger:hover {
            background: #1d4ed8;
        }

        /* ✅ ANIMASI FORM */
        @keyframes slideUp {
            from {
                transform: translateY(40px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

</head>
<body>

<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>ADMIN PANEL</h2>
        <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
        <a href="{{ url('/admin/lowongan') }}">Lowongan</a>
        <a href="{{ url('/admin/pelamar') }}">Pelamar</a>
        <a href="{{ url('/admin/lamaran') }}">Lamaran</a>
        <a href="{{ url('/admin/psikotes') }}">Psikotes</a>
        <a href="{{ url('/admin/wawancara') }}">Wawancara</a>
        <a href="{{ url('/admin/kontrak') }}">Kontrak</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger" style="width:100%; margin-top:50px;">Logout</button>
        </form>
    </div>

    <!-- Content -->
    <div class="content">

        <div class="topbar">
            <h2>@yield('title')</h2>
            <p>Login sebagai: <b>{{ auth()->user()->name ?? 'Admin' }}</b></p>
        </div>

        <!-- ✅ WRAPPER BARU -->
        <div class="content-wrapper">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>
