<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Rekrutmen - SD Al Huda Semarang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            background: linear-gradient(135deg,#f1f5ff,#eef2ff,#f8fafc);
            color:#1e293b;
        }

        /* NAVBAR */
        .navbar {
            position:sticky;
            top:0;
            z-index:999;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
            padding:18px 70px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 10px 25px rgba(0,0,0,.04);
        }

        .navbar h2 {
            font-weight:800;
            background: linear-gradient(90deg,#2563eb,#1e3a8a);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            letter-spacing:1px;
        }

        .nav-menu a {
            margin-left:28px;
            text-decoration:none;
            color:#334155;
            font-weight:500;
            position:relative;
        }

        .nav-menu a::after {
            content:"";
            position:absolute;
            left:0;
            bottom:-5px;
            width:0%;
            height:2px;
            background:#2563eb;
            transition:.3s;
        }

        .nav-menu a:hover::after{
            width:100%;
        }

        .nav-menu .login {
            padding:10px 26px;
            border-radius:999px;
            background: linear-gradient(135deg,#2563eb,#1e3a8a);
            color:white;
            transition:.4s;
        }

        .nav-menu .login:hover {
            transform:translateY(-2px) scale(1.03);
            box-shadow:0 10px 25px rgba(37,99,235,.4);
        }

        /* HERO */
        .header {
            padding:130px 40px;
            background:
                linear-gradient(rgba(30,58,138,0.92), rgba(37,99,235,0.92)),
                url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f');
            background-size:cover;
            background-position:center;
            text-align:center;
            color:white;
        }

        .header h1 {
            font-size:48px;
            font-weight:800;
            margin-bottom:14px;
            animation: fadeUp 1s ease forwards;
        }

        .header p {
            max-width:800px;
            margin:auto;
            font-size:17px;
            opacity:0.95;
            line-height:1.8;
            animation: fadeUp 1.3s ease forwards;
        }

        @keyframes fadeUp {
            0% {opacity:0; transform: translateY(30px);}
            100% {opacity:1; transform: translateY(0);}
        }

        /* CONTAINER */
        .container {
            max-width:1150px;
            margin:auto;
            padding:90px 40px;
        }

        /* SECTION */
        .section {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(10px);
            border:1px solid rgba(255,255,255,0.4);
            padding:45px;
            margin-bottom:35px;
            border-radius:28px;
            box-shadow:0 18px 40px rgba(0,0,0,.05);
            transition:.4s;
        }

        .section:hover {
            transform:translateY(-6px);
            box-shadow:0 25px 55px rgba(0,0,0,.08);
        }

        .section h2 {
            margin-bottom:15px;
            background: linear-gradient(90deg,#2563eb,#1e3a8a);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .section ul {
            padding-left:22px;
            line-height:1.9;
            color:#475569;
        }

        /* GRID FEATURES */
        .features {
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(240px,1fr));
            gap:25px;
        }

        .feature-card {
            background: rgba(248,250,252,0.9);
            border:1px solid #e2e8f0;
            padding:28px;
            border-radius:20px;
            transition:.4s;
        }

        .feature-card:hover {
            transform:translateY(-6px) scale(1.02);
            box-shadow:0 20px 45px rgba(0,0,0,.1);
        }

        .feature-card h4 {
            margin-bottom:10px;
            color:#2563eb;
        }

        /* BUTTON */
        .btn-login {
            display:inline-block;
            margin-top:40px;
            padding:18px 50px;
            border-radius:999px;
            background: linear-gradient(135deg,#2563eb,#1e3a8a);
            color:white;
            font-weight:600;
            text-decoration:none;
            letter-spacing:.5px;
            transition:.4s;
        }

        .btn-login:hover {
            transform:translateY(-3px) scale(1.03);
            box-shadow:0 15px 30px rgba(37,99,235,.5);
        }

        footer {
            background: linear-gradient(135deg,#1e293b,#020617);
            text-align:center;
            color:white;
            padding:35px 20px;
            margin-top:60px;
        }

        /* RESPONSIVE */
        @media(max-width:768px){
            .navbar {
                flex-direction:column;
                gap:12px;
                padding:16px 20px;
            }

            .header {
                padding:80px 25px;
            }

            .header h1 {
                font-size:32px;
            }

            .container{
                padding:60px 20px;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>SD AL HUDA</h2>
    <div class="nav-menu">
        <a href="/">Home</a>
        <a href="/rekrutmen">Rekrutmen</a>
        <a href="/login" class="login">Login</a>
    </div>
</div>

<!-- HERO -->
<div class="header">
    <h1>Sistem Rekrutmen SD Al Huda Semarang</h1>
    <p>Platform seleksi tenaga pendidik dan staf berbasis teknologi, profesional, transparan, dan terintegrasi.</p>
</div>

<!-- CONTENT -->
<div class="container">

    <div class="section">
        <h2>📢 Pengumuman Lowongan</h2>
        <ul>
            <li>Guru Kelas, TU, Keamanan, Perpustakaan</li>
            <li>Kualifikasi pendidikan dan pengalaman kerja</li>
            <li>Jadwal pembukaan dan penutupan</li>
        </ul>
    </div>

    <div class="section">
        <h2>🧾 Pendaftaran Online</h2>
        <ul>
            <li>Pembuatan akun pelamar</li>
            <li>Upload CV, Ijazah, Sertifikat</li>
            <li>Input data pribadi lengkap</li>
        </ul>
    </div>

    <div class="section">
        <h2>🧠 Psikotes Online</h2>
        <ul>
            <li>Tes Kepribadian</li>
            <li>Tes Logika dan Numerik</li>
            <li>Penilaian otomatis berbasis sistem</li>
        </ul>
    </div>

    <div class="section">
        <h2>🧑‍🏫 Wawancara & Microteaching</h2>
        <ul>
            <li>Uji kemampuan komunikasi</li>
            <li>Simulasi mengajar langsung</li>
            <li>Metode dan attitude mengajar</li>
        </ul>
    </div>

    <div class="section">
        <h2>📊 Penilaian Akhir</h2>
        <ul>
            <li>Administrasi</li>
            <li>Psikotes</li>
            <li>Wawancara & Microteaching</li>
        </ul>
    </div>

    <div class="section">
        <h2>💻 Fitur Sistem</h2>

        <div class="features">
            <div class="feature-card">
                <h4>📊 Dashboard Admin</h4>
                <p>Memantau seluruh data pelamar dan hasil seleksi.</p>
            </div>

            <div class="feature-card">
                <h4>👤 Dashboard Pelamar</h4>
                <p>Melihat status pendaftaran dan hasil real-time.</p>
            </div>

            <div class="feature-card">
                <h4>🔔 Notifikasi</h4>
                <p>Email & WhatsApp otomatis.</p>
            </div>

            <div class="feature-card">
                <h4>📁 Export Data</h4>
                <p>Download laporan dalam format PDF & Excel.</p>
            </div>
        </div>

        <a href="/login" class="btn-login">Login Untuk Melamar</a>
    </div>

</div>

<footer>
    <p>© {{ date('Y') }} SD Al Huda Semarang | Sistem Rekrutmen Digital</p>
</footer>

</body>
</html>
