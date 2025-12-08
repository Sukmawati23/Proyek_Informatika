<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftarkan Sebagai</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #000018, #001133);
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 25px;
        }
        .container {
            width: 100%;
            height: 100%;
            max-width: 1000px;
            max-height: 1000px;
            padding: 55px 50px;
            background: rgba(0, 0, 30, 0.65);
            backdrop-filter: blur(14px);
            border-radius: 22px;
            border: 1px solid rgba(0, 150, 255, 0.25);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.55);
            text-align: center;
            color: white;
        }
        .container img {
            width: 150px;
            height: 150px;
            margin-bottom: 25px;
            border-radius: 50%;
            border: 2px solid rgba(0, 150, 255, 0.5);
        }
        .container h2 {
            font-size: 30px;
            margin-bottom: 14px;
            font-weight: 600;
        }
        .container p {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 35px;
        }
        /* Tombol */
        .btn {
            display: block;
            width: 100%;
            max-width: 600px;
            margin: 15px auto;
            padding: 18px;
            background: linear-gradient(135deg, #007adf, #00b5ff);
            border-radius: 12px;
            color: white;
            font-size: 20px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn i {
            margin-right: 10px;
        }

        .btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0, 150, 255, 0.4);
        }

        /* Mobile */
        @media (max-width: 480px) {
            .container {
                padding: 40px 28px;
            }
            .container h2 { font-size: 25px; }
            .container p { font-size: 16px; }
            .btn { padding: 15px; font-size: 17px; }
        }

    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo">
        <h2>Daftarkan sebagai</h2>
        <p>Pilih jenis akun Anda untuk membuat akun baru</p>
        <a href="{{ route('register.donatur') }}" class="btn"><i class="fa fa-user"></i> Donatur</a>
        <a href="{{ route('register.penerima') }}" class="btn"><i class="fa fa-handshake"></i> Penerima</a>
    </div>
</body>
</html>