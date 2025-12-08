<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Email Terkirim</title>
     <style>
        body {
            background-color: #00002c;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center; 
            color: white;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            background: white;
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 0 25px rgba(0, 123, 255, 0.25);
            backdrop-filter: blur(6px);
        }

        .container img {
            width: 45%;
            margin-bottom: 20px;
        }

        .container h2 {
            font-size: 28px;
            margin-bottom: 10px;
            color: black;
        }

        .container p {
            color: black;
            margin: 5px 0 12px;
            font-size: 16px;
        }

        .btn {
            margin-top: 25px;
            display: inline-block;
            width: 100%;
            padding: 14px;
            background: #00002c;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            font-size: 18px;
            transition: .2s;
        }

        .btn:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('email-image.png') }}" alt="Email" >
        <h2>Email Terkirim!</h2>
        <p>Silahkan periksa email Anda!</p>
        <p>Kami telah mengirimkan tautan untuk mengatur ulang kata sandi ke alamat email Anda.</p>
        <p>Tautan berlaku selama 15 menit.</p>
        <a href="{{ route('login') }}" class="btn">Kembali ke halaman login</a>
    </div>
</body>
</html>