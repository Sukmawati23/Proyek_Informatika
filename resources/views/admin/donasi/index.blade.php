@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verifikasi Donasi Buku</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    @if($donasis->isEmpty())
        <div class="alert alert-info">Tidak ada donasi menunggu verifikasi.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Donatur</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>Kondisi</th>
                    <th>Status</th> <!-- ✅ tambahkan kolom status -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donasis as $donasi)
                <tr>
                    <td>{{ $donasi->id }}</td>
                    <td>{{ optional($donasi->user)->name ?? '-' }}</td>
                    <td>{{ $donasi->judul_buku }}</td>
                    <td>{{ $donasi->kategori }}</td>
                    <td>{{ $donasi->kondisi }}</td>
                    <td>
    @if($donasi->status === 'menunggu')
        <span class="badge badge-warning">Menunggu</span>
    @elseif($donasi->status === 'diverifikasi')
        <span class="badge badge-success">Diverifikasi</span>
    @elseif($donasi->status === 'ditolak')
        <span class="badge badge-danger">Ditolak</span>
    @else
        <span class="badge badge-primary">{{ ucfirst($donasi->status) }}</span>
    @endif
</td>
                    <td>
                        <!-- Verifikasi -->
                        <form action="{{ route('admin.donasi.verify', $donasi->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin verifikasi donasi ini? Buku akan tersedia untuk penerima.')">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" {{ $donasi->status !== 'menunggu' ? 'disabled' : '' }}>
                                Verifikasi
                            </button>
                        </form>

                        <!-- Tolak -->
                        <form action="{{ route('admin.donasi.reject', $donasi->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin tolak donasi ini?')">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger btn-sm" {{ $donasi->status !== 'menunggu' ? 'disabled' : '' }}>
                                Tolak
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection