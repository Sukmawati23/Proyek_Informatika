@extends('layouts.app')
@section('content')
<div class="container">
   <h2>Chat dengan {{ $room->penerima->name }} (Penerima)</h2>
    <div style="height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
        @forelse($messages as $msg)
            <div style="margin-bottom: 10px; padding: 5px; background:{{ $msg->sender_id == Auth::id() ? '#e6f7ff' : '#f0f0f0' }}; border-radius:5px;">
                <strong>{{ $msg->sender->name }}:</strong> {{ $msg->message }}
                <small style="color: gray; float:right;">{{ $msg->created_at->format('d M Y H:i') }}</small>
            </div>
        @empty
            <p>Tidak ada pesan.</p>
        @endforelse
    </div>
    <form action="{{ route('chat.send', $room) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="message" class="form-control" rows="3" required placeholder="Ketik pesan..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection