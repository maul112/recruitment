<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SD Al Huda Semarang - Sistem Rekrutmen</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

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
        .hero {
            min-height:90vh;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            background:
                linear-gradient(rgba(37,99,235,0.88), rgba(29,78,216,0.92)),
                url('https://images.unsplash.com/photo-1509062522246-3755977927d7');
            background-size:cover;
            background-position:center;
            color:white;
            padding:40px 20px;
        }

        .hero-box {
            max-width:760px;
        }

        .hero h1 {
            font-size:45px;
            margin-bottom:15px;
            line-height:1.3;
        }

        .hero p {
            font-size:18px;
            opacity:0.95;
            margin-bottom:35px;
        }

        .hero-btn {
            background:white;
            color:#2563eb;
            padding:14px 30px;
            border-radius:50px;
            text-decoration:none;
            font-weight:600;
            display:inline-block;
            margin:10px;
        }

        .hero-btn.secondary {
            background:transparent;
            border:2px solid white;
            color:white;
        }

        /* SECTION */
        section {
            padding:80px 60px;
        }

        .section-title {
            text-align:center;
            margin-bottom:60px;
        }

        .section-title h2 {
            font-size:34px;
            color:#1e293b;
        }

        .section-title p {
            color:#64748b;
            margin-top:10px;
        }

        /* PROFILE GRID */
        .profile-grid {
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:40px;
            align-items:center;
        }

        .profile-grid img {
            width:100%;
            border-radius:20px;
            box-shadow:0 20px 35px rgba(0,0,0,.15);
        }

        .profile-content h3 {
            font-size:26px;
            margin-bottom:15px;
            color:#1e293b;
        }

        .profile-content p {
            line-height:1.8;
            color:#475569;
        }

        /* VISI MISI */
        .visi-misi-grid {
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(260px,1fr));
            gap:30px;
        }

        .card {
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 8px 25px rgba(0,0,0,.06);
        }

        .card i {
            font-size:30px;
            color:#2563eb;
            margin-bottom:15px;
        }

        .card h4 {
            margin-bottom:10px;
        }

        /* FOOTER */
        footer {
            background:#1e293b;
            color:white;
            text-align:center;
            padding:30px 20px;
        }

        /* RESPONSIVE */
        @media(max-width:768px){
            .navbar {
                flex-direction:column;
                gap:10px;
                padding:15px 20px;
            }

            .profile-grid {
                grid-template-columns:1fr;
            }

            section {
                padding:60px 25px;
            }

            .hero h1 {
                font-size:32px;
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
<div class="hero">
    <div class="hero-box">
        <h1>Selamat Datang di Sistem Rekrutmen<br>SD Al Huda Semarang</h1>
        <p>
            Platform resmi untuk proses rekrutmen tenaga pendidik yang profesional,
            transparan, dan modern berbasis teknologi.
        </p>

        <a href="/rekrutmen" class="hero-btn">Info Rekrutmen</a>
        <a href="/login" class="hero-btn secondary">Login Sekarang</a>
    </div>
</div>

<!-- PROFIL SEKOLAH -->
<section>
    <div class="section-title">
        <h2>Profil SD Al Huda Semarang</h2>
        <p>Sekilas tentang sekolah kami</p>
    </div>

    <div class="profile-grid">
        <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914">

        <div class="profile-content">
            <h3>Sekolah Islam Berkualitas & Berprestasi</h3>
            <p>
                SD Al Huda Semarang adalah sekolah dasar berbasis Islam yang berkomitmen
                mencetak generasi berprestasi, berakhlak mulia, dan berlandaskan iman serta ilmu pengetahuan.
                Kami mengedepankan pendidikan karakter, akademik, dan keterampilan abad 21.
            </p>
        </div>
    </div>
</section>

<!-- VISI MISI -->
<section style="background:#f8fafc;">
    <div class="section-title">
        <h2>Visi & Misi Sekolah</h2>
        <p>Arah dan tujuan pendidikan SD Al Huda</p>
    </div>

    <div class="visi-misi-grid">

        <div class="card">
            <i class="fas fa-bullseye"></i>
            <h4>Visi</h4>
            <p>
                Terwujudnya generasi yang cerdas, mandiri, berakhlak mulia, dan berwawasan global.
            </p>
        </div>

        <div class="card">
            <i class="fas fa-list"></i>
            <h4>Misi</h4>
            <p>
                Menanamkan nilai keislaman, meningkatkan kualitas akademik, dan membentuk karakter siswa unggul.
            </p>
        </div>

        <div class="card">
            <i class="fas fa-graduation-cap"></i>
            <h4>Program Unggulan</h4>
            <p>
                Tahfidz Qur'an, Bahasa Inggris Aktif, Technology Class, dan Character Building.
            </p>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>© {{ date('Y') }} SD Al Huda Semarang | Sistem Rekrutmen Digital</p>
</footer>

</body>
</html>
