<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Anda Telah Aktif</title>
    <style>
        body {
            background-color: #00002c;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            background-color: white;
            color: #00002c;
            padding: 100px;
            border-radius: 10px;
            text-align: center;
            max-width: 700px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .check-icon {
            font-size: 100px;
            color: #00002c;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 30px;
            margin-bottom: 15px;
        }
        p {
            font-size: 20px;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        .btn {
            display: inline-block;
            padding: 25px;
            font-size: 20px;
            background-color: #00002c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #000060;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="check-icon">✓</div>
        <h2>Akun Anda Telah Aktif!</h2>
        <p>Selamat! Akun Anda sebagai {{ ucfirst($role) }} telah berhasil diaktifkan. Silakan masuk untuk mulai menggunakan sistem.</p>
        <a href="{{ route('login') }}" class="btn">Masuk ke Akun</a>
    </div>
</body>
</html>