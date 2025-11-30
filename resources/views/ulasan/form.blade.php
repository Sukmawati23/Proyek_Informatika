@extends('auth.layouts.app')
@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h3>Berikan Ulasan</h3>
    <p>Untuk: <strong>{{ $pengajuan->buku->judul }}</strong></p>
    <p>Dengan: 
        @if(auth()->user()->role === 'penerima')
            Donatur: {{ $pengajuan->buku->user->name }}
        @else
            Penerima: {{ $pengajuan->user->name }}
        @endif
    </p>

    @if($sudahUlasan)
        <div class="alert alert-info">Anda sudah memberikan ulasan untuk transaksi ini.</div>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    @else
        <form method="POST" action="{{ route('ulasan.store') }}">
            @csrf
            <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">

            <div class="mb-3">
                <label class="form-label">Rating</label><br>
                <div class="rating" id="ratingStars">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star" data-value="{{ $i }}" style="font-size:2rem; cursor:pointer; color: gold;">☆</span>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="5" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ulasan (Opsional)</label>
                <textarea name="comment" class="form-control" rows="4" placeholder="Ceritakan pengalaman Anda..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
        </form>
    @endif
</div>

<script>
    const stars = document.querySelectorAll('.star');
    const input = document.getElementById('ratingInput');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            input.value = value;
            stars.forEach(s => s.textContent = '☆');
            for (let i = 0; i < value; i++) {
                stars[i].textContent = '★';
            }
        });
    });
</script>
@endsection
