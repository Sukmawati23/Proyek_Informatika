<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftarkan Sebagai</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            width: 280px;
            background-color: #000080;
            color: white;
            padding: 30px 20px;
            border-radius: 10px;
            margin: 50px auto;
            text-align: center;
        }
        .container img {
            width: 50px;
            margin-bottom: 15px;
        }
        .container h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .container p {
            font-size: 12px;
            margin-bottom: 20px;
        }
        .btn {
            display: block;
            width: 92%;
            padding: 10px;
            margin: 10px 0;
            background-color: white;
            color: #000080;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #ddd;
        }
        .btn i {
            margin-right: 8px;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo">
        <h2>Daftarkan sebagai</h2>
        <p>Pilih jenis akun Anda untuk membuat akun baru</p>
        <a href="{{ route('register.donatur') }}" class="btn"><i class="fa fa-user"></i> Donatur</a>
        <a href="{{ route('register.penerima') }}" class="btn"><i class="fa fa-handshake-o"></i> Penerima</a>
    </div>
</body>
</html>
