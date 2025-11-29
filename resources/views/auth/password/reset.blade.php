<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Kata Sandi</title>
    <style>
        /* Tambahkan gaya sesuai kebutuhan */
                body {
            background-color: #00002c;
            color: white;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-size: 20px;
        }
        .logo {
            margin-bottom: 5px;
        }
        .logo img {
            width: 300px;
        }

        h2 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        input {
            width: 95%;
            padding: 20px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: none;
            background-color: #f2f2f2;
            color: #00002c;
            font-weight: bold;
            font-size: 20px;
        }
        input::placeholder {
            color: #000049;
            opacity: 0.8;
        }

        button {
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            border: none;
            background-color: #00008B;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.2s ease;
            font-size: 20px;
        }
        button:hover {
            background-color: #00006B;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo Donasi Buku">
    </div>
    <h2>Reset Kata Sandi</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Kata Sandi" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
        <button type="submit">Reset Kata Sandi</button>
    </form>
</body>
</html>