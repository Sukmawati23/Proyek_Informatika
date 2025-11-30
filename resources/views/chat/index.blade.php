@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Riwayat Chat</h2>
    @forelse($rooms as $room)
        @php
            $other = Auth::id() == $room->donatur_id ? $room->penerima : $room->donatur;
            $judul = $room->donasi->judul_buku ?? 'Buku tidak dikenal';
        @endphp
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $other->name }} – {{ $judul }}</h5>
                <a href="{{ route('chat.show', $room) }}" class="btn btn-primary">Buka Chat</a>
            </div>
        </div>
    @empty
        <p>Belum ada chat.</p>
    @endforelse
</div>
@endsection