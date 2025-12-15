@extends('layouts.app')
@section('content')

<style>
    body {
        background: linear-gradient(135deg, #0f2027, #1a1947ff, #17249bff);
        color: white;
    }

    .chat-wrapper {
        max-width: 900px;
        margin: auto;
        margin-top: 30px;
    }

    .chat-box {
        background: rgba(253, 252, 252, 0.08);
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 25px;
        height: 60vh;
        overflow-y: auto;
        backdrop-filter: blur(8px);
        margin-bottom: 15px;
    }

    .msg {
        max-width: 60%;
        padding: 12px 16px;
        border-radius: 18px;
        margin-bottom: 15px;
        word-wrap: break-word;
    }

    .msg-me {
        background: #15064bff;
        margin-left: auto;
        color: white;
    }

    .msg-other {
        background: rgba(255, 255, 255, 0.85);
        color: black;
    }

    .msg small {
        display: block;
        margin-top: 6px;
        font-size: 11px;
        opacity: 0.8;
    }

    .chat-title {
        text-align: center;
        font-size: 26px;
        margin-bottom: 15px;
        font-weight: 600;
        color: white;
    }

    .input-area {
        background: rgba(250, 248, 248, 0.98);
        border-radius: 14px;
        padding: 10px;
        display: flex;
        gap: 10px;
    }

    textarea {
        border: none;
        resize: none;
        height: 50px;
    }

    .btn-send {
        background: #220379ff;
        border: none;
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: bold;
        white-space: nowrap;
    }

    .date-separator {
    text-align: center;
    margin: 20px 0;
    font-size: 13px;
    color: rgba(255, 255, 255, 0.8);
    }

    .date-separator span {
        background: rgba(0, 0, 0, 0.35);
        padding: 6px 14px;
        border-radius: 20px;
    }

    .back-btn {
    position: absolute;
    top: -10px;
    left: 20px;

    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 8px 14px;
    border-radius: 999px;

    text-decoration: none;
    font-size: 14px;
    font-weight: 500;

    backdrop-filter: blur(6px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);

    z-index: 50; 

    transition: all 0.2s ease;
}

.back-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-1px);
}




</style>

@php
    $isDonatur = Auth::id() == $room->donatur_id;

    $chatWithName = $isDonatur
        ? $room->penerima->name
        : $room->donatur->name;

    $chatWithRole = $isDonatur
        ? 'Penerima'
        : 'Donatur';
@endphp

<div class="chat-wrapper" style="position: relative;">

        <a href="{{ route('dashboard') }}" class="back-btn">
        ← Kembali
    </a>

    <h2 class="chat-title">
        Chat dengan 
        {{ Auth::id() == $room->donatur_id ? $room->penerima->name . ' (Penerima)' : $room->donatur->name . ' (Donatur)' }}
    </h2>


    {{-- BOX CHAT --}}
<div class="chat-box" id="chatBox">

    @php
        $lastDate = null;
    @endphp

    @forelse ($messages as $msg)
        @php
            $currentDate = $msg->created_at->format('Y-m-d');
        @endphp

        @if ($lastDate !== $currentDate)
            <div class="date-separator">
                <span>
                    {{
                        $msg->created_at->isToday()
                            ? 'Hari Ini'
                            : ($msg->created_at->isYesterday()
                                ? 'Kemarin'
                                : $msg->created_at->translatedFormat('d F Y'))
                    }}
                </span>
            </div>

            @php $lastDate = $currentDate; @endphp
        @endif

        <div class="msg {{ $msg->sender_id == Auth::id() ? 'msg-me' : 'msg-other' }}">
            <strong>{{ $msg->sender->name }}</strong><br>
            {{ $msg->message }}
            <small>{{ $msg->created_at->format('H:i') }}</small>
        </div>

    @empty
        <p style="color: white; opacity:0.8;">Tidak ada pesan.</p>
    @endforelse

</div>


    {{-- INPUT --}}
    <form action="{{ route('chat.send', $room) }}" method="POST">
        @csrf
        <div class="input-area">
        <textarea
            name="message"
            class="form-control"
            placeholder="Ketik pesan..."
            required
            onkeydown="handleSend(event)"
        ></textarea>
            <button type="submit" class="btn-send">Kirim</button>
        </div>
    </form>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chatBox = document.querySelector('.chat-box');
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });
</script>

<script>
    function handleSend(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            e.target.closest('form').submit();
        }
    }
</script>

@endsection
