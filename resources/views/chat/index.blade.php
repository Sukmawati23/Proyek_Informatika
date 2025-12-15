@extends('layouts.app')
@section('content')
<div class="container">

    <h2 style="font-weight:600;" class="mb-4">💬 Riwayat Chat</h2>

    @forelse($rooms as $room)
        @php
            $other = Auth::id() == $room->donatur_id ? $room->penerima : $room->donatur;
            $judul = $room->donasi->judul_buku ?? 'Buku tidak dikenal';
        @endphp

        <div class="card shadow-sm mb-3" style="border-radius:12px;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 style="margin:0;">{{ $other->name }}</h5>
                    <small style="color:#777;">{{ $judul }}</small>
                </div>
                <a href="{{ route('chat.show', $room) }}" class="btn btn-primary">
                    Buka Chat
                </a>
            </div>
        </div>

    @empty
        <p>Belum ada chat.</p>
    @endforelse
</div>
@endsection
