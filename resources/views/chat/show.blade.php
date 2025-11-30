<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Chat dengan {{ $partner->name }}</title>
    <style>
        body {
            background-color: #00002c;
            font-family: 'Segoe UI', sans-serif;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 800px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            background-color: #1a1a4d;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 25px;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 15px;
            background-color: #000080;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .back-button:hover {
            background-color: #0000cc;
        }

        .chat-box {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #000033;
            border-radius: 10px;
        }

        .message {
            margin-bottom: 10px;
            padding: 12px 18px;
            border-radius: 20px;
            max-width: 70%;
            display: inline-block;
            clear: both;
        }

        .message.user {
            background-color: #4a90e2;
            color: #fff;
            float: right;
            text-align: right;
        }

        .message.partner {
            background-color: #e0e0e0;
            color: #000;
            float: left;
            text-align: left;
        }

        .timestamp {
            display: block;
            font-size: 12px;
            color: #000000ff; /* diubah menjadi putih */
            margin-top: 2px;
        }

        form {
            display: flex;
        }

        input[type="text"] {
            flex: 1;
            padding: 15px;
            border-radius: 20px 0 0 20px;
            border: none;
            font-size: 18px;
        }

        button {
            padding: 15px 25px;
            border: none;
            background-color: #4a90e2;
            color: white;
            border-radius: 0 20px 20px 0;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #357ab8;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Tombol back -->
    <a href="{{ route('dashboard') }}" class="back-button">← Kembali</a>

    <h2>Chat dengan {{ $partner->name }}</h2>
    <div class="chat-box" id="chat-box">
        @foreach($messages as $msg)
            <div class="message {{ $msg->sender_id == auth()->id() ? 'user' : 'partner' }}">
                {{ $msg->message }}
                <span class="timestamp">
    {{ $msg->created_at->timezone('Asia/Jakarta')->format('H:i') }}
</span>

            </div>
        @endforeach
    </div>

    <!-- Form kirim pesan -->
    <form method="POST" action="{{ route('chat.send', $partnerId) }}">
        @csrf
        <input type="text" name="message" placeholder="Ketik pesan..." required>
        <button type="submit">Kirim</button>
    </form>
</div>
</body>
</html>
