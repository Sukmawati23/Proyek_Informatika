<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Kata Sandi</title>
    <style>
        body {
            background-color: #000080;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 50px;
        }
        .container {
            width: 90%;
            max-width: 400px; /* Batas lebar maksimal */
            padding: 30px;
            color: white;
            text-align: center;
            margin: auto;
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
        .btn-submit:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo" style="width: 50%; margin-bottom: 20px;">
        <h2>Lupa Kata Sandi</h2>
        <p>Masukkan email Anda untuk mengatur ulang kata sandi</p>
        
        @if (session('status'))
            <div class="error-message">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <button type="submit" class="btn-submit">Kirim Tautan Reset</button>
        </form>
        
        <a href="{{ route('login') }}" style="color: white; display: block; margin: 10px 0;">Kembali ke Masuk</a>
    </div>
</body>
</html>
