<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Anda</title>
    <style>
        body {
            background-color: #000080;
            color: white;
            text-align: center;
            padding: 50px;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
        }
        .icon {
            font-size: 50px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .message {
            margin: 20px 0;
            line-height: 1.5;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: white;
            color: #000080;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #ddd;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
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