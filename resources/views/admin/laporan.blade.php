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
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->file_name }}</td>
                    <td>{{ $report->type }}</td>
                    <td>{{ $report->date ? \Carbon\Carbon::parse($report->date)->format('d/m/Y H:i') : '-' }}</td>
                    <td>{{ strtoupper($report->format) }}</td>
                    <td>
                        <a href="{{ route('download.report', $report->id) }}" class="btn btn-sm btn-success">Download</a>
                        <form action="{{ route('delete.report', $report->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus laporan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection