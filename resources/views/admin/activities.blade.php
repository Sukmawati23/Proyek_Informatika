@extends('layouts.simple-admin')
@section('content')
<div class="container">
    <h3>Semua Aktivitas</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Aktivitas</th>
                <th>Pengguna</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->created_at }}</td>
                <td>{{ $activity->pesan }}</td>
                <td>{{ $activity->user->name ?? 'Sistem' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $activities->links() }}
</div>
@endsection