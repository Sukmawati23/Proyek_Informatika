<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Anda</title>
    <style>
        body {
            background-color: #000080; /* Warna latar belakang */
            color: white;
            text-align: center;
            padding: 50px;
        }
        .container {
            background-color: #1a1a1a; /* Warna latar belakang kontainer */
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
        }
        .icon {
            font-size: 50px;
            color: #4CAF50; /* Warna hijau untuk ikon centang */
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: white;
            color: #000080;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="icon">
            <i class="fa fa-check-circle"></i> <!-- Ikon centang -->
        </div>
        <h2>Verifikasi Email Anda</h2>
        <p>Kami telah mengirimkan email verifikasi ke <strong>{{ $email }}</strong>. Silakan periksa kotak masuk Anda dan klik tautan yang diberikan untuk mengaktifkan akun Anda.</p>
        <a href="{{ route('verification.resend') }}" class="btn">Kirim Ulang Email Verifikasi</a>
      
    </div>
</body>
</html>
//