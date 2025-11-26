<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftarkan Sebagai</title>
    <style>
        body {
            background-color: #00002c;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 800px;
            color: white;
            padding: 50px;
            border-radius: 10px;
            text-align: center;
        }
        .container img {
            width: 200px;
            margin-bottom: 5px;
        }
        .container h2 {
            font-size: 30px;
            margin-bottom: 5px;
        }
        .container p {
            font-size: 20px;
            margin-bottom: 15px;
        }
        .btn {
            display: block;
            width: 92%;
            padding: 12px;
            margin: 12px auto;
            background-color: white;
            color: #00002c;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 20px;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #f0f0f0;
        }
        .btn i {
            margin-right: 8px;
        }
    </style>
    <!-- Font Awesome (versi terbaru dan aman) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
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