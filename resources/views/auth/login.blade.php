<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 50px;
        }
        .container {
            width: 300px;
            margin: auto;
            background-color: #000080;
            padding: 30px;
            border-radius: 10px;
            color: white;
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 20px;
        }
        .form-control {
            width: 94%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
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
        .divider {
            margin: 20px 0;
        }
        .divider span {
            display: inline-block;
            width: 100px;
            line-height: 0.1em;
            margin: 10px 0;
            color: white;
        }
        .divider span:before {
            content: ' ';
        }
        .divider span:after {
            content: ' ';
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="LOGO-SDB.png" alt="Logo SDB" style="width: 50%; margin-bottom: 20px;">
        <h2>Masuk atau Daftar Akun</h2>
        <p>Silakan masuk akun Anda atau buat akun baru untuk memulai donasi buku.</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
            <a href="{{ route('password.request') }}" style="color: white; display: block; margin: 10px 0;">Lupa kata sandi?</a>
            <button type="submit" class="btn-submit">Masuk</button>
        </form>
        <div class="divider">
            <span>atau</span>
        </div>
        <a href="{{ route('register.options') }}" class="btn-submit">Daftar</a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
