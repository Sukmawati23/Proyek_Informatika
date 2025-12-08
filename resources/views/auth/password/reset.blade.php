<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Kata Sandi</title>
    
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #000018, #001133);
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            padding: 40px;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            padding: 55px 45px;
            background: rgba(0, 0, 30, 0.65);
            backdrop-filter: blur(14px);
            border-radius: 22px;
            border: 1px solid rgba(0,150,255,0.25);
            box-shadow: 0 15px 40px rgba(0,0,0,0.55);
            text-align: center;
            color: white;
        }

        .container img {
            width: 140px;
            height: 140px;
            margin-bottom: 20px;
            border-radius: 50%;
            border: 2px solid rgba(0,150,255,0.45);
        }

        .container h2 {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .container p {
            margin-bottom: 25px;
            font-size: 17px;
            opacity: 0.9;
        }

        .form-control {
            width: 100%;
            padding: 18px;
            background: rgba(0, 0, 55, 0.45);
            border: 1.5px solid rgba(255,255,255,0.3);
            border-radius: 12px;
            color: white;
            font-size: 18px;
            outline: none;
            transition: .3s;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #0099ff;
            box-shadow: 0 0 10px rgba(0,150,255,.4);
        }

        .btn-submit {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #007adf, #00b5ff);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0,150,255,0.4);
        }

        .back-link {
            color: #bcdcff;
            margin-top: 18px;
            display: inline-block;
            text-decoration: none;
        }

        .back-link:hover {
            color: white;
        }

        .status-box {
            background: rgba(0, 180, 255, 0.2);
            padding: 12px;
            border-left: 3px solid #00b5ff;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        @media(max-width:480px) {
            .container {
                padding: 35px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo Donasi Buku">
    
    <h2>Reset Kata Sandi</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email"  class="form-control" placeholder="Email" required>
        <input type="password" name="password" class="form-control"  placeholder="Kata Sandi" required>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
        <button type="submit"  class="btn-submit">Reset Kata Sandi</button>
    </form>
    <a href="{{ route('login') }}" class="back-link">← Kembali ke Halaman Masuk</a>
    </div>
</body>
</html>