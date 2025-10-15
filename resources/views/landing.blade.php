<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Donasi Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #000080;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        img {
            width: 200px;
            margin-bottom: 2rem;
        }
        h3 {
            font-size: 1rem;
            font-family: Timeless, sans-serif;
            margin: 2rem 0;
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            background: white;
            color: #000080;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn:hover {
            background-color: #f0f0f0;
            color: #000060;
        }
    </style>
</head>
<body>
    <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo Donasi Buku">
    <h3>"Satu Buku, Sejuta Manfaat"</h3>
    <a href="{{ route('login') }}" class="btn">Mulai</a>
    
</body>
</html>
