<!DOCTYPE html>
<html>
<head>
    <title>Semua Aktivitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
        @yield('content')
    </div>
</body>
</html>