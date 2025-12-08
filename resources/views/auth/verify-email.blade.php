<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Anda</title>
    
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #000018, #001133);
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            padding: 60px 45px;
            background:white;
            backdrop-filter: blur(14px);
            border-radius: 22px;
            border: 1px solid rgba(0,150,255,0.25);
            box-shadow: 0 18px 45px rgba(0,0,0,0.55);
            text-align: center;
            color: black;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container img {
            width: 140px;
            height: 140px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .message {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.6;
            color:black;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 18px;
            font-size: 20px;
            margin: 12px 0;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: .3s;
            text-decoration: none;
            color: white;
        }

        .btn-primary {
            background: #00002c;
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,150,255,0.4);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.25);
        }

        @media(max-width: 480px) {
            .container {
                padding: 40px 25px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('email-image.png') }}" alt="Logo">
        <h2>Verifikasi Email Anda</h2>
        <div class="message">
            Kami telah mengirimkan email verifikasi ke <strong>{{ $email }}</strong>.<br>
            Silakan periksa kotak masuk Anda dan klik tautan yang diberikan untuk mengaktifkan akun Anda.
        </div>
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
        </form>
        <a href="{{ route('login') }}"  class="btn btn-secondary">Kembali ke Halaman Login</a>
    </div>
</body>
</html>