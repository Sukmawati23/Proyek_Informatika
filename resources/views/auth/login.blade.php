<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, #000018, #001133);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 1000px; /* DIBESARKAN */
            padding: 55px 50px; /* DIBESARKAN */
            color: #fff;
            background: rgba(0, 0, 30, 0.65);
            border-radius: 22px;
            border: 1px solid rgba(0, 150, 255, 0.25);
            backdrop-filter: blur(14px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.55);
            text-align: center;
        }

        .container img {
            width: 130px; 
            height: 130px;
            margin-bottom: 25px;
            border-radius: 50%;
            border: 2px solid rgba(0, 150, 255, 0.5);
        }

        .container h2 {
            font-size: 28px;
            margin-bottom: 14px;
            font-weight: 600;
        }

        .container p {
            font-size: 17px;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .form-control {
            width: 100%;
            padding: 18px 20px; 
            margin: 15px 0;
            border-radius: 12px;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            background: rgba(0, 0, 55, 0.45);
            color: white;
            font-size: 17px; 
            transition: 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: #0099ff;
            box-shadow: 0 0 10px rgba(0, 150, 255, 0.4);
        }

        .forgot-password {
            display: block;
            text-align: right;
            color: #5ebfff;
            font-size: 15px;
            margin-top: 5px;
            margin-bottom: 22px;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 18px; 
            background: linear-gradient(135deg, #007adf, #00b5ff);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 18px; 
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 5px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(0, 150, 255, 0.4);
        }

        .divider {
            margin: 28px 0;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 15px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.3);
            margin: 0 12px;
        }

        .error-message {
            background: rgba(255, 0, 0, 0.2);
            color: #ff8888;
            padding: 15px;
            border-left: 3px solid #ff4444;
            font-size: 15px;
            border-radius: 10px;
            text-align: left;
            margin-top: 20px;
        }

        /* Mobile-friendly */
        @media (max-width: 480px) {
            .container {
                max-width: 95%;
                padding: 40px 28px;
            }

            h2 { font-size: 24px; }
            p  { font-size: 15.5px; }
            .form-control { font-size: 15.5px; padding: 15px; }
            .btn-submit { font-size: 16px; padding: 15px; }
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

        <a href="{{ route('register.options') }}">
            <button class="btn-submit">Daftar</button>
        </a>


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