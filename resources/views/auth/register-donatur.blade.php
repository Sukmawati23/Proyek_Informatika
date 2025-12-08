<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Sebagai Donatur</title>
    
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }
        body {
            background: linear-gradient(135deg, #000018, #001133);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            padding: 55px 50px;
            background: rgba(0, 0, 30, 0.65);
            border-radius: 22px;
            border: 1px solid rgba(0, 150, 255, 0.25);
            backdrop-filter: blur(14px);
            color: white;
            box-shadow: 0 15px 40px rgba(0,0,0,0.55);
        }

        .container img {
            display: block;
            width: 140px;
            height: 140px;
            margin: 0 auto 25px;
            border-radius: 50%;
            border: 2px solid rgba(0,150,255,0.45);
        }

        .container h2 {
            text-align: center;
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        .form-group i {
            margin-right: 10px;
            color: #66c8ff;
        }

        .form-control {
            width: 100%;
            padding: 18px;
            border-radius: 12px;
            background: rgba(0, 0, 55, 0.45);
            border: 1.5px solid rgba(255,255,255,0.3);
            color: white;
            font-size: 17px;
            outline: none;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #0099ff;
            box-shadow: 0 0 10px rgba(0,150,255,0.4);
        }

        .form-check {
            margin: 20px 0;
            font-size: 16px;
        }

        .form-check-label {
            margin-left: 6px;
        }

        .btn-submit {
            width: 100%;
            padding: 20px;
            background: linear-gradient(135deg, #007adf, #00b5ff);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0,150,255,0.4);
        }

        .alert-danger {
            background: rgba(255,0,0,0.25);
            padding: 15px;
            border-left: 3px solid #ff4444;
            border-radius: 10px;
            margin-top: 25px;
        }

        .alert-danger ul {
            margin: 0;
            padding: 0 0 0 20px;
        }

        @media(max-width:480px) {
            .container {
                padding: 35px 25px;
            }
            .btn-submit {
                font-size: 18px;
                padding: 16px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo">
    <h2>Daftar Sebagai Donatur</h2>
    <form method="POST" action="{{ route('register.donatur.submit') }}">
        @csrf
        <div class="form-group">
            <label><i class="fa fa-id-card"></i>ID (otomatis)</label>
            <input type="text" name="kode_user" class="form-control" value="DXXX" readonly>
        </div>
        <div class="form-group">
            <label><i class="fa fa-envelope"></i>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label><i class="fa fa-user"></i>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label><i class="fa fa-lock"></i>Kata Sandi</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label><i class="fa fa-lock"></i>Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label><i class="fa fa-map-marker"></i>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="form-group">
            <label><i class="fa fa-phone"></i>No. Telepon</label>
            <input type="text" name="telepon" class="form-control" required>
        </div>
        <div class="form-check">
            <input type="checkbox" name="agree" required>
            <label class="form-check-label">Saya setuju dengan syarat & ketentuan</label>
        </div>
        <button type="submit" class="btn-submit">Daftar Sekarang</button>
    </form>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>