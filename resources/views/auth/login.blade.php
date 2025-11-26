<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
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
            max-width: 800px; /* Batas lebar maksimal */
            padding: 50px;
            color: white;
            text-align: center;
        }

        .container img {
            width: 30%;
            margin-bottom: 10px;
        }

        .container h2 {
            margin-bottom: 20px;
            font-size: 30px;
        }

        .container p {
            margin-bottom: 20px;
            font-size: 20px;
            opacity: 1;
        }

        .form-control {
            width: 100%;
            padding: 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 20px;
        }

        .forgot-password {
            display: block;
            margin: 10px 0;
            color: white;
            text-decoration: underline;
            font-size: 20px;
            text-align: left;
        }

        .btn-submit {
            width: 100%;
            padding: 20px;
            background-color: white;
            color: #000080;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            font-size: 20px;
            text-align: center;
            text-decoration: none;
            display: block;
            box-sizing: border-box;
        }

        .btn-submit:hover {
            background-color: #f0f0f0;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid white;
        }

        .divider span {
            padding: 0 10px;
            color: white;
            font-size: 20px;
        }

        .error-message {
            background-color: #ffe6e6;
            color: #cc0000;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            font-size: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo SDB">

        <h2>Masuk atau Daftar Akun</h2>
        <p>Silakan masuk akun Anda atau buat akun baru untuk memulai donasi buku.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
            <a href="{{ route('password.request') }}" class="forgot-password">Lupa kata sandi?</a>
            <button type="submit" class="btn-submit">Masuk</button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <a href="{{ route('register.options') }}" class="btn-submit">Daftar</a>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>