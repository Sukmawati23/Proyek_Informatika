<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Email Terkirim</title>
    <style>
        body {
            background-color: #00002c;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 50px;
            font-size: 20px;
        }
        .container {
            width: 800px;
            margin: auto;
            background-color: #f0f0f0;
            padding: 30px;
            border-radius: 10px;
            color: #00002c;
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 30px;
        }
        .btn-submit {
            width: 100%;
            padding: 20px;
            background-color: white;
            color: #00002c;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            font-size: 20px
        }

        .btn {
            width: 90%;
            padding: 20px;
            background-color: #00002c;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #000066;
            font-size: 20px
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('email-image.png') }}" alt="Email" style="width: 40%; margin-bottom: 20px;">
        <h2>Email Terkirim!</h2>
        <p>Silahkan periksa email Anda!</p>
        <p>Kami telah mengirimkan tautan untuk mengatur ulang kata sandi ke alamat email Anda.</p>
        <p>Tautan berlaku selama 15 menit.</p>
        <a href="{{ route('login') }}" class="btn">Kembali ke halaman login</a>
    </div>
</body>
</html>