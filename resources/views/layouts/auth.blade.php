<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Rekrutmen Sekolah')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        * {
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #eef2ff;
        }

        .auth-container {
            width: 1100px;
            height: 620px;
            background: white;
            display: flex;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,.08);
            margin: 60px auto;
        }

        /* ========== LEFT PANEL ========== */
        .auth-left {
            width: 50%;
            background: linear-gradient(135deg, #4f46e5, #2563eb);
            color: white;
            padding: 60px 50px;
            position: relative;
        }

        .auth-left h1 {
            font-size: 42px;
            margin-top: 60px;
        }

        .auth-left h1 span {
            font-weight: 700;
        }

        .auth-left p {
            margin-top: 20px;
            font-size: 14px;
            line-height: 1.7;
            max-width: 350px;
            /* opacity: 0.9; */
        }

        .circle {
            position:absolute;
            border-radius: 50%;
            opacity: .2;
        }

        .circle.one {
            width: 260px;
            height: 260px;
            background: white;
            top: -60px;
            left: -60px;
        }

        .circle.two {
            width: 180px;
            height: 180px;
            border: 2px dashed #fff;
            bottom: 60px;
            left: 70px;
        }

        .circle.three {
            width: 120px;
            height: 120px;
            background: #1d4ed8;
            bottom: -30px;
            right: 80px;
        }

        /* ========== RIGHT PANEL ========== */
        .auth-right {
            width: 50%;
            padding: 60px 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-box {
            width: 100%;
            max-width: 350px;
        }

        .form-box h2 {
            margin-bottom: 30px;
            font-size: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-size: 13px;
            /* color: #6b7280; */
        }

        .input-group input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            /* border: 1px solid #c7d2fe; */
            margin-top: 5px;
            outline: none;
        }

        /* .input-group input:focus {
            border-color: #4f46e5;
        } */

        .form-extra {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin: 10px 0 25px;
            color: #6b7280;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            background: #4f46e5;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .btn-outline {
            width: 100%;
            padding: 10px;
            background: white;
            border: 1px solid #4f46e5;
            color: #4f46e5;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .social {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .social a {
            width: 2rem;
            height: 2rem;
            background: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 13px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        /* ========== ANIMATION ========== */

        .animated-text {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInSlideUp 1.5s ease-out forwards;
        }

        .animated-text.delay-1 {
            animation-delay: 0.2s;
        }
        .animated-text.delay-2 {
            animation-delay: 0.6s;
        }

        @keyframes fadeInSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>
<body>

@yield('content')

</body>
</html>
