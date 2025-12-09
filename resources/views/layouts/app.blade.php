<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pelamar - @yield('title', 'Dashboard')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        *{
            box-sizing:border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
        }

        /* NAVBAR */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 999;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            padding: 15px 50px;
            display:flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,.05);
        }

        /* Bagian kiri: teks REKRUTMEN */
        .nav-logo {
            font-weight:800;
            background: linear-gradient(90deg,#2563eb,#1e3a8a);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            font-size: 20px;
        }

        /* Menu tengah */
        .nav-menu {
            display:flex;
            gap:25px;
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

        /* Bagian kanan: icon profile */
        .profile-dropdown {
            position: relative;
        }

        .profile-dropdown button {
            background:none;
            border:none;
            cursor:pointer;
            font-size:22px;
            color:#2563eb;
        }

        .dropdown-menu {
            display:none;
            position:absolute;
            right:0;
            top:35px;
            background:white;
            border:1px solid #e5e7eb;
            border-radius:10px;
            box-shadow:0 10px 25px rgba(0,0,0,.1);
            min-width:150px;
            z-index:1000;
            overflow:hidden;
        }

        .dropdown-menu a, .dropdown-menu form button {
            display:block;
            width:100%;
            text-align:left;
            padding:10px 15px;
            font-size:14px;
            color:#1e293b;
            text-decoration:none;
            background:none;
            border:none;
            cursor:pointer;
            transition:0.3s;
        }

        .dropdown-menu a:hover, .dropdown-menu form button:hover {
            background:#eff6ff;
            color:#2563eb;
        }

        /* MAIN DASHBOARD */
        .dashboard {
            max-width: 1200px;
            margin: 10px auto;
            padding: 10px;
        }

        /* WELCOME BOX */
        .welcome-card {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            padding: 30px 35px;
            border-radius: 20px;
            color: white;
            box-shadow: 0 20px 30px rgba(37,99,235,0.3);
            margin-bottom:40px;
        }

        .welcome-card h1 {
            margin-bottom: 10px;
            font-size: 28px;
        }

        .welcome-card p {
            opacity:0.95;
            font-size: 14px;
        }

        /* GRID MENU */
        /* .menu-grid {
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        } */

        /* CARD */
        .menu-card {
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow: 0 12px 25px rgba(0,0,0,.05);
            transition: .4s ease;
            display:flex;
            align-items:center;
            gap:18px;
            border: 1px solid #e5e7eb;
        }

        .menu-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(37,99,235,.15);
            border-color:#2563eb;
        }

        .menu-icon {
            width:55px;
            height:55px;
            background: #eff6ff;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:15px;
            color:#2563eb;
            font-size:22px;
        }

        .menu-content a {
            text-decoration:none;
            color:#111827;
            font-weight:600;
            font-size:18px;
            display:block;
        }

        .menu-content span {
            font-size:13px;
            color:#6b7280;
            margin-top:5px;
            display:block;
        }

        /* RESPONSIVE */
        @media(max-width:768px){
            .navbar{
                flex-direction:column;
                gap:10px;
                padding:15px 20px;
            }

            /* .welcome-card h1{
                font-size:22px;
            } */
        }

    </style>

    <script>
        // Toggle dropdown
        function toggleDropdown(){
            const menu = document.getElementById('dropdown-menu');
            if(menu.style.display === 'block'){
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }

        // Klik di luar dropdown tutup menu
        document.addEventListener('click', function(event){
            const dropdown = document.getElementById('profile-dropdown');
            if(dropdown && !dropdown.contains(event.target)){
                const menu = document.getElementById('dropdown-menu');
                if(menu) menu.style.display = 'none';
            }
        });
    </script>

</head>
<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="nav-logo">REKRUTMEN</div>

        <div class="nav-menu">
            <a href="{{ url('/pelamar/dashboard') }}">Home</a>
            <a href="{{ url('/pelamar/lowongan') }}">Lowongan</a>
            <a href="{{ url('/pelamar/psikotes') }}">Psikotes</a>
            <a href="{{ url('/pelamar/wawancara') }}">Wawancara</a>
            <a href="{{ url('/pelamar/pengumuman') }}">Pengumuman</a>
            <a href="{{ url('/pelamar/riwayat') }}">Riwayat Lamaran</a>
        </div>

        <div class="profile-dropdown" id="profile-dropdown">
            <button onclick="toggleDropdown()">
                <i class="fas fa-user-circle"></i>
            </button>
            <div class="dropdown-menu" id="dropdown-menu">
                <a href="{{ url('/pelamar/profile') }}">Profil</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="dashboard">
        @yield('content')
    </div>

</body>
</html>
