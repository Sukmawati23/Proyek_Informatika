<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Anda</title>
    <style>
        body {
            background-color: #00002c;
            color: #00002c;
            text-align: center;
            font-size: 20px;
            padding: 100px;
            font-family: 'Segoe UI', sans-serif;
        }

        .container img {
            display: block;
            margin: 0 auto 10px;
            width: 250px;
        }
        .container {
            background-color: white;
            padding: 98px;
            border-radius: 10px;
            display: inline-block;
        }
        .icon {
            font-size: 60px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .message {
            margin: 20px 0;
            line-height: 1.5;
        }
        .btn {
            display: inline-block;
            padding: 20px;
            font-size: 20px;
            margin: 10px;
            background-color: #00002c;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #000080;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <img src="{{ asset('email-image.png') }}" alt="Logo">
        <div class="icon">
            <i class="fa fa-envelope"></i>
        </div>
        <h2>Verifikasi Email Anda</h2>
        <div class="message">
            Kami telah mengirimkan email verifikasi ke <strong>{{ $email }}</strong>.<br>
            Silakan periksa kotak masuk Anda dan klik tautan yang diberikan untuk mengaktifkan akun Anda.
        </div>
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn">Kirim Ulang Email Verifikasi</button>
        </form>
        <a href="{{ route('login') }}" class="btn">Kembali ke Halaman Login</a>
    </div>
</body>
</html>