@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verifikasi Donasi Buku</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Donatur</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donasis as $donasi)
            <tr>
                <td>{{ $donasi->id }}</td>
                <td>{{ $donasi->user->name }}</td>
                <td>{{ $donasi->judul_buku }}</td>
                <td>{{ $donasi->kategori }}</td>
                <td>{{ $donasi->kondisi }}</td>
                <td>
                    <form action="{{ route('admin.donasi.verify', $donasi->id) }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection