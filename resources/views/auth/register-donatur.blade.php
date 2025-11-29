<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Sebagai Donatur</title>
    <style>
        body {
            background-color: #00002c;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            width: 800px;
            margin: 50px auto;
            padding: 50px;
            border-radius: 10px;
            color: white;
        }

        .container img {
            display: block;
            margin: 0 auto 10px;
            width: 150px;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 25px;
            font-size: 25px;
        }

        .form-group {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .form-group i {
            margin-right: 8px;
        }

        .form-control {
            width: 93%;
            padding: 20px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            font-size: 20px;
        }

        .form-control:focus {
            outline: none;
        }

        .form-check {
            margin: 10px 0;
        }

        .form-check-label {
            font-size: 20px;
        }

        .btn-submit {
            width: 98%;
            padding: 20px;
            background-color: white;
            color: #00002c;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            font-size: 20px;
        }

        .btn-submit:hover {
            background-color: #ddd;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
