<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Anda Telah Aktif</title>
    
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #000018, #000b33);
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            background: white;
            backdrop-filter: blur(14px);
            border-radius: 22px;
            border: 1px solid rgba(255,255,255,0.25);
            padding: 60px 50px;
            text-align: center;
            color: white;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);

            /* KONTEN AGAR TENGAH */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .success-icon {
            width: 110px;
            height: 110px;
            background: rgba(0,180,255,0.2);
            border: 2px solid rgba(0,180,255,0.5);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 55px;
            color: #00b5ff;
            margin-bottom: 25px;
            box-shadow: 0 0 20px rgba(0,150,255,0.35);
        }

        h2 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 15px;
            color: black;
        }

        p {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.6;
            color: black;
        }

        .btn {
            display: inline-block;
            padding: 18px 25px;
            width: 100%;
            max-width: 500px;
            font-size: 20px;
            font-weight: 600;
            background: linear-gradient(135deg, #007adf, #00b5ff);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,150,255,0.4);
        }

        @media(max-width: 480px) {
            .container {
                padding: 40px 25px;
            }
            .success-icon {
                width: 90px;
                height: 90px;
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">
            <i class="fa-solid fa-check"></i>
        </div>
        <h2>Akun Anda Telah Aktif!</h2>
        <p>Selamat! Akun Anda sebagai {{ ucfirst($role) }} telah berhasil diaktifkan. Silakan masuk untuk mulai menggunakan sistem.</p>
        <a href="{{ route('login') }}" class="btn">Masuk ke Akun</a>
    </div>
</body>
</html>