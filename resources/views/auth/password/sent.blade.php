<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Email Terkirim</title>
    <style>
        body {
            background-color: #000080;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 50px;
        }
        .container {
            width: 300px;
            margin: auto;
            background-color: #f0f0f0;
            padding: 30px;
            border-radius: 10px;
            color: black;
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 20px;
        }
        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: white;
            color: #000080;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn {
            width: 90%;
            padding: 12px;
            background-color: #000080;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #000066;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('email-image.png') }}" alt="Email" style="width: 50%; margin-bottom: 20px;">
        <h2>Email Terkirim!</h2>
        <p>Silahkan periksa email Anda!</p>
        <p>Kami telah mengirimkan tautan untuk mengatur ulang kata sandi ke alamat email Anda.</p>
        <p>Tautan berlaku selama 15 menit.</p>
        <a href="{{ route('login') }}" class="btn">Kembali ke halaman login</a>
    </div>
</body>
</html>
