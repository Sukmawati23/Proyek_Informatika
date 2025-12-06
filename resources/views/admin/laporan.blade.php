@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Laporan</h2>

    @if($reports->isEmpty())
        <div class="alert alert-info">Belum ada laporan.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama File</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Format</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report['id'] }}</td>
                    <td>{{ $report['file_name'] }}</td>
                    <td>{{ $report['type'] }}</td>
                    <td>{{ $report['date'] }}</td>
                    <td>{{ strtoupper($report['format']) }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-success">Download</a>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus laporan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection