<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color:#00002c;
            --secondary-color: #f8f9fc;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --dark-color: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', 'Segoe UI', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        
        .sidebar {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        
        .sidebar-nav {
            padding: 20px;
        }
        
        .nav-item {
            padding: 10px 0;
            margin-bottom: 5px;
        }
        
        .nav-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .nav-item a:hover, .nav-item a.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .nav-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .user-menu {
            position: relative;
        }
        
        .user-dropdown {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 5px;
            z-index: 100;
            padding: 10px 0;
        }
        
        .user-menu:hover .user-dropdown {
            display: block;
        }
        
        .user-dropdown a {
            display: block;
            padding: 8px 20px;
            color: #333;
            text-decoration: none;
        }
        
        .user-dropdown a:hover {
            background-color: #f8f9fc;
        }
        
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        
        .card-header {
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 35px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 20px;
        }
        
        .card-title {
            font-weight: 600;
            margin: 0;
            color: var(--dark-color);
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 20px;
            border-left: 5px solid;
        }
        
        .stat-card.donatur {
            border-left-color: var(--primary-color);
            font-size: 20px;
        }
        
        .stat-card.penerima {
            border-left-color: var(--success-color);
            font-size: 20px;
        }
        
        .stat-card.donasi {
            border-left-color: var(--info-color);
            font-size: 20px;
        }
        
        .stat-card.pending {
            border-left-color: var(--warning-color);
            font-size: 20px;
        }
        
        .stat-title {
            font-size: 20px;
            color: var(--dark-color);
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            margin: 5px 0;
        }
        
        .stat-change {
            font-size: 12px;
        }
        
        .stat-change.up {
            color: var(--success-color);
        }
        
        .stat-change.down {
            color: var(--danger-color);
        }
        
        .btn {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }
        
        .btn-success {
            background-color: var(--success-color);
            color: white;
            border: 1px solid var(--success-color);
        }
        
        .btn-success:hover {
            background-color: #17a673;
            border-color: #169b6b;
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            color: white;
            border: 1px solid var(--danger-color);
        }
        
        .btn-danger:hover {
            background-color: #d62c1a;
            border-color: #c52717;
        }
        
        .btn-secondary {
            background-color: #858796;
            color: white;
            border: 1px solid #858796;
        }
        
        .btn-secondary:hover {
            background-color: #717384;
            border-color: #6b6d7d;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .table th {
            background-color: #f8f9fc;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .table tr:hover {
            background-color: #f8f9fc;
        }
        
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #d1f3e8;
            color: var(--success-color);
        }
        
        .badge-warning {
            background-color: #fef5e0;
            color: var(--warning-color);
        }
        
        .badge-danger {
            background-color: #fbe9e7;
            color: var(--danger-color);
        }
        
        .badge-primary {
            background-color: #e0e6ff;
            color: var(--primary-color);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            color: var(--dark-color);
            font-size: 14px;
            border-top: 1px solid #e3e6f0;
            margin-top: 30px;
        }
        
        /* Page specific styles */
        .page {
            display: none;
        }
        
        .page.active {
            display: block;
        }
        
        .search-filter {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .search-filter input, .search-filter select {
            padding: 8px 12px;
            border: 1px solid #d1d3e2;
            border-radius: 4px;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border-radius: 5px;
            width: 60%;
            max-width: 800px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .close {
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d3e2;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #e3e6f0;
            padding-top: 15px;
            margin-top: 20px;
            gap: 10px;
        }
        
        .tab-container {
            margin-bottom: 20px;
        }
        
        .tabs {
            display: flex;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
        }
        
        .tab.active {
            border-bottom-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .tab-content {
            display: none;
            padding: 15px 0;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .settings-section {
            margin-bottom: 30px;
        }
        
        .settings-section h4 {
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .notification-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>DONASI BUKU</h2>
                <p>Dashboard Admin</p>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-item">
                    <a href="#" class="nav-link active" data-page="dashboard"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-page="donatur"><i class="fas fa-fw fa-users"></i> Donatur</a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-page="penerima"><i class="fas fa-fw fa-hands-helping"></i> Penerima</a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-page="donasi"><i class="fas fa-fw fa-book"></i> Donasi Buku</a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-page="verifikasi"><i class="fas fa-fw fa-check-circle"></i> Verifikasi</a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-page="laporan"><i class="fas fa-fw fa-file-alt"></i> Laporan</a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-page="pengaturan"><i class="fas fa-fw fa-cog"></i> Pengaturan</a>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1 id="page-title">Dashboard Admin</h1>
                <div class="user-menu">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-bell" style="cursor: pointer;" id="notificationIcon"></i>
                        <div class="user-profile" style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <span>Admin</span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    <div class="user-dropdown">
                        <a href="#" id="profileLink"><i class="fas fa-fw fa-user"></i> Profil</a>
                        <a href="#" class="nav-link" data-page="pengaturan"><i class="fas fa-fw fa-cog"></i> Pengaturan</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); confirmLogout();"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Page -->
            <div id="dashboard" class="page active">
                <p>Selamat datang, Admin! Anda dapat mengelola semua data di sini.</p>
                
               <!-- Statistics Cards -->
<div class="stats-cards">
    <div class="stat-card donatur">
        <div class="stat-title">Donatur</div>
        <div class="stat-value">{{ number_format($total_donatur) }}</div> 
        
    </div>
    <div class="stat-card penerima">
        <div class="stat-title">Penerima</div>
        <div class="stat-value">{{ number_format($total_penerima) }}</div> 
        
    </div>
    <div class="stat-card donasi">
        <div class="stat-title">Donasi Buku</div>
        <div class="stat-value">{{ number_format($total_donasi) }}</div> 
       
    </div>
    <div class="stat-card pending">
        <div class="stat-title">Menunggu Verifikasi</div>
        <div class="stat-value">{{ number_format($total_menunggu_verifikasi) }}</div> 
        
    </div>
</div>
                
                <!-- Charts -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Statistik Donasi 6 Bulan Terakhir</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="donationChart"></canvas>
                    </div>
                </div>
                
                <!-- Recent Activities -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aktivitas Terkini</h3>
                        <a href="#" class="btn btn-primary">Lihat Semua</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Aktivitas</th>
                                <th>Pengguna</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                            <tr>
                                <td>{{ $activity->created_at }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->user->name }}</td>
                                <td>{{ $activity->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Donatur Page -->
<div id="donatur" class="page">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Donatur</h3>
            
        </div>
        <div class="search-filter">
            <input type="text" placeholder="Cari donatur..." class="form-control" id="searchDonatur">
            <select class="form-control" id="filterStatus">
                <option value="">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Nonaktif</option>
            </select>
            <button class="btn btn-secondary" onclick="applyFilter()">Filter</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th> <!-- ✅ Kolom Telepon DI TAMPILKAN -->
                    <th>Total Donasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="donaturTableBody">
                @foreach($donaturs as $donatur)
                    <tr data-donatur-id="{{ $donatur->id }}">
                        <td>{{ $donatur->id }}</td>
                        <td>{{ $donatur->name }}</td>
                        <td>{{ $donatur->email }}</td>
                        <td>{{ $donatur->telepon }}</td> <!-- ✅ Menampilkan nomor telepon dari database -->
                        <td>{{ $donatur->total_donations ?? 0 }} buku</td>
                        <td>
                            @if($donatur->is_active)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-warning">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                    onclick="deleteDonatur({{ $donatur->id }})">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
            
            <!-- Penerima Page -->
            <div id="penerima" class="page">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Penerima</h3>
                        
                    </div>
                    <div class="search-filter">
                        <input type="text" placeholder="Cari penerima..." class="form-control">
                        <select class="form-control">
                            <option>Semua Status</option>
                            <option>Aktif</option>
                            <option>Nonaktif</option>
                        </select>
                        <button class="btn btn-secondary">Filter</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Total Diterima</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penerimas as $penerima)
                            <tr>
                                <td>{{ $penerima->id }}</td>
                                <td>{{ $penerima->name }}</td>
                                <td>{{ $penerima->alamat }}</td>
                                <td>{{ $penerima->telepon }}</td>
                                <td>{{ $penerima->total_received }} buku</td>
                                <td>
                                    @if($penerima->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-warning">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                        <!-- Tombol Hapus dengan onclick -->
                                        <button class="btn btn-danger btn-sm"
                                            onclick="deletePenerima({{ $penerima->id }}, event)">
                                        Hapus
                                    </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Donasi Buku Page -->
            <div id="donasi" class="page">
                <!-- Bagian 2: Daftar Buku yang Didonasikan -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Buku yang Didonasikan</h3>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID Donasi</th>
                <th>Judul Buku</th>
                <th>Donatur</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donasis as $donasi)
            <tr data-donasi-id="{{ $donasi->id }}">
                <td>{{ $donasi->id }}</td>
                <td>{{ $donasi->judul_buku }}</td>
                <td>{{ $donasi->donatur?->name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y') ?? '-' }}</td>
                <td>
                    @if($donasi->status == 'menunggu')
                        <span class="badge badge-warning">Menunggu</span>
                    @elseif($donasi->status == 'diverifikasi')
                        <span class="badge badge-success">Diverifikasi</span>
                    @elseif($donasi->status == 'ditolak')
                        <span class="badge badge-danger">Ditolak</span>
                    @elseif($donasi->status == 'terkirim')
                        <span class="badge badge-primary">Terkirim</span>
                    @else
                        <span class="badge badge-secondary">{{ ucfirst($donasi->status) }}</span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons">
                        @if($donasi->status == 'menunggu')
                            <form action="{{ route('admin.donasi.verify', $donasi->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                            </form>
                            <form action="{{ route('admin.donasi.reject', $donasi->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin tolak donasi ini?')">Tolak</button>
                            </form>
                        @endif
                        <button class="btn btn-primary btn-sm" onclick="showDonationDetail({{ $donasi->id }})">Detail</button>
                        <button class="btn btn-secondary btn-sm" onclick="deleteDonation({{ $donasi->id }})">Hapus</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
            </div>
            
            <!-- Verifikasi Page -->
<div id="verifikasi" class="page">
    <!-- Bagian 1: Verifikasi Pengajuan Donasi -->
    <!-- Di dalam div id="verifikasi" -->
<!-- Bagian 2: Daftar Pengajuan Penerima -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pengajuan Menunggu Verifikasi</h3>
    </div>
    <div class="search-filter">
        <input type="text" placeholder="Cari pengajuan..." class="form-control">
        <select class="form-control">
            <option>Semua Status</option>
            <option>Menunggu</option>
            <option>Disetujui</option>
            <option>Ditolak</option>
        </select>
        <button class="btn btn-secondary">Filter</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID Pengajuan</th>
                <th>Judul Buku</th>
                <th>Penerima</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($verifications as $pengajuan)
            <tr data-pengajuan-id="{{ $pengajuan->id }}">
                <td>{{ $pengajuan->id }}</td>
                <td>{{ $pengajuan->buku?->judul ?? '-' }}</td>
                <td>{{ $pengajuan->user?->name ?? '-' }}</td>
                <td>{{ $pengajuan->tanggal }}</td>
                <td>
                    <!-- Dropdown Status -->
                    <select class="form-control status-dropdown" onchange="updatePengajuanStatus(this, {{ $pengajuan->id }})">
                        <option value="menunggu" {{ $pengajuan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ $pengajuan->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $pengajuan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-primary btn-sm" onclick="showPengajuanDetail({{ $pengajuan->id }})">Detail</button>
                        <button class="btn btn-danger btn-sm" onclick="deletePengajuan({{ $pengajuan->id }})">Hapus</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

            <!-- Bagian 2: Daftar Buku yang Didonasikan -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Buku yang Didonasikan</h3>
    </div>
    <div class="search-filter">
        <input type="text" placeholder="Cari buku..." class="form-control">
        <select class="form-control">
            <option>Semua Status</option>
            <option>Pending</option>
            <option>Diverifikasi</option>
            <option>Ditolak</option>
            <option>Terkirim</option>
        </select>
        <button class="btn btn-secondary">Filter</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID Donasi</th>
                <th>Judul Buku</th>
                <th>Donatur</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donasis as $donasi)
            <tr data-donasi-id="{{ $donasi->id }}">
                <td>{{ $donasi->id }}</td>
                <td>{{ $donasi->judul_buku }}</td>
                <td>{{ $donasi->donatur?->name ?? '-' }}</td>
                <td>{{ $donasi->tanggal }}</td>
                <td>
                    <!-- Dropdown Status -->
                    <select class="form-control status-dropdown" onchange="updateDonationStatus(this, {{ $donasi->id }})">
                        <option value="menunggu" {{ $donasi->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diverifikasi" {{ $donasi->status == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                        <option value="ditolak" {{ $donasi->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="terkirim" {{ $donasi->status == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                    </select>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-primary btn-sm" onclick="showDonationDetail({{ $donasi->id }})">Detail</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteDonation({{ $donasi->id }})">Hapus</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

            <!-- Modal Detail Donasi -->
            <div id="donationDetailModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Detail Donasi Buku</h3>
                        <span class="close">&times;</span>
                    </div>
                    <div id="donationDetailContent">
                        <!-- Konten detail akan dimuat di sini oleh JavaScript -->
                        <p>Loading...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeDonationDetailModal()">Tutup</button>
                    </div>
                </div>
            </div>
            
            <!-- Laporan Page -->
            <div id="laporan" class="page">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="reportType">Jenis Laporan</label>
                            <select id="reportType" class="form-control">
                                <option value="donatur">Laporan Donatur</option>
                                <option value="penerima">Laporan Penerima</option>
                                <option value="donasi">Laporan Donasi</option>
                                <option value="verifikasi">Laporan Verifikasi</option>
                                <option value="ulasan">Laporan Ulasan & Rating</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="startDate">Dari Tanggal</label>
                                <input type="date" id="startDate" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="endDate">Sampai Tanggal</label>
                                <input type="date" id="endDate" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reportFormat">Format Laporan</label>
                            <select id="reportFormat" class="form-control">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Generate Laporan</button>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Terakhir dihasilkan</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
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
                                <td>{{ $report->file_name }}</td>
                                <td>{{ $report->type }}</td>
                                <td>{{ $report->date }}</td>
                                <td>{{ strtoupper($report->format) }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-success btn-sm">Download</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
             <!-- Laporan Ulasan & Rating (dalam halaman laporan) -->
    <div id="ulasanReport" class="card" style="display: none;">
        <div class="card-header">
            <h3 class="card-title">Laporan Ulasan & Rating</h3>
            <div class="search-filter" style="margin: 0; padding: 0;">
                <select id="ulasanFilter" class="form-control" style="width: auto;">
                    <option value="all">Semua</option>
                    <option value="donatur">Donatur Saja</option>
                    <option value="penerima">Penerima Saja</option>
                </select>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Tipe</th>
                    <th>Nama</th>
                    <th>Ulasan</th>
                    <th>Rating</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody id="ulasanTableBody">
                @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->type }}</td>
                    <td>{{ $review->name }}</td>
                    <td>{{ $review->comment }}</td>
                    <td>{{ $review->rating }} / 5</td>
                    <td>{{ $review->date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

            <!-- Pengaturan Page -->
            <div id="pengaturan" class="page">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan Sistem</h3>
                    </div>
                    <div class="tab-container">
                        <div class="tabs">
                            <div class="tab active" data-tab="profile">Profil Admin</div>
                            <div class="tab" data-tab="system">Sistem</div>
                            <div class="tab" data-tab="notifications">Notifikasi</div>
                            <div class="tab" data-tab="security">Keamanan</div>
                        </div>
                        
                        <div class="tab-content active" id="profile-tab">
                            <form>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="adminName">Nama Admin</label>
                                        <input type="text" id="adminName" class="form-control" value="Admin BookDonation">
                                    </div>
                                    <div class="form-group">
                                        <label for="adminEmail">Email</label>
                                        <input type="email" id="adminEmail" class="form-control" value="admin@bookdonation.com">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="adminPhone">Telepon</label>
                                        <input type="text" id="adminPhone" class="form-control" value="08123456789">
                                    </div>
                                    <div class="form-group">
                                        <label for="adminRole">Role</label>
                                        <input type="text" id="adminRole" class="form-control" value="Super Admin" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="adminPhoto">Foto Profil</label>
                                    <input type="file" id="adminPhoto" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                        
                        <div class="tab-content" id="system-tab">
                            <div class="settings-section">
                                <h4>Pengaturan Umum</h4>
                                <form>
                                    <div class="form-group">
                                        <label for="siteName">Nama Situs</label>
                                        <input type="text" id="siteName" class="form-control" value="BookDonation">
                                    </div>
                                    <div class="form-group">
                                        <label for="siteDescription">Deskripsi Situs</label>
                                        <textarea id="siteDescription" class="form-control">Platform donasi buku untuk pendidikan anak Indonesia</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="timezone">Zona Waktu</label>
                                        <select id="timezone" class="form-control">
                                            <option value="WIB">WIB (UTC+7)</option>
                                            <option value="WITA">WITA (UTC+8)</option>
                                            <option value="WIT">WIT (UTC+9)</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                                </form>
                            </div>
                            
                            <div class="settings-section">
                                <h4>Pengaturan Donasi</h4>
                                <form>
                                    <div class="form-group">
                                        <label for="maxBooks">Maksimal Buku per Donasi</label>
                                        <input type="number" id="maxBooks" class="form-control" value="10">
                                    </div>
                                    <div class="form-group">
                                        <label for="verificationDays">Waktu Verifikasi (hari)</label>
                                        <input type="number" id="verificationDays" class="form-control" value="3">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" id="autoApprove" checked>
                                            Auto-approve donatur terdaftar
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="tab-content" id="notifications-tab">
                            <div class="settings-section">
                                <h4>Pengaturan Notifikasi</h4>
                                <form>
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" id="notifNewDonation" checked>
                                            Notifikasi untuk donasi baru
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" id="notifNewRecipient" checked>
                                            Notifikasi untuk penerima baru
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" id="notifVerification" checked>
                                            Notifikasi untuk verifikasi
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" id="emailNotifications" checked>
                                            Aktifkan notifikasi email
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                                </form>
                            </div>
                            
                            <div class="settings-section">
                                <h4>Notifikasi Terakhir</h4>
                                <div class="notification-item">
    <div>
        @if($donasis->isNotEmpty())
            @php
                $donasi = $donasis->first();
            @endphp
            <strong>Donasi baru</strong>
            <p>{{ $donasi->judul_buku }} oleh {{ optional($donasi->user)->name ?? '-' }}</p>
            <p>1 buku</p> {{-- karena saat ini tabel donasi belum punya field jumlah, anggap 1 --}}
        @else
            <p>Tidak ada donasi terbaru.</p>
        @endif
    </div>
    <span>
        @if($donasis->isNotEmpty())
            {{ $donasis->first()->created_at->diffForHumans() }}
        @else
            -
        @endif
    </span>
</div>
                                <div class="notification-item">
    <div>
        @if($penerimas->isNotEmpty())
            @php $penerima = $penerimas->first(); @endphp
            <strong>Penerima baru</strong>
            <p>{{ $penerima->name }} telah bergabung</p>
        @else
            <p>Tidak ada penerima baru.</p>
        @endif
    </div>
    <span>
        @if($penerimas->isNotEmpty())
            {{ $penerimas->first()->created_at->diffForHumans() }}
        @else
            -
        @endif
    </span>
</div>
                               <div class="notification-item">
    <div>
        @if($verifications->isNotEmpty())
            <strong>{{ $verifications->count() }} donasi menunggu verifikasi</strong>
        @else
            <strong>Tidak ada donasi menunggu verifikasi</strong>
        @endif
    </div>
    <span>Baru saja</span>
</div>
                            </div>
                        </div>
                        
                        <div class="tab-content" id="security-tab">
                            <div class="settings-section">
                                <h4>Keamanan Akun</h4>
                                <form>
                                    <div class="form-group">
                                        <label for="currentPassword">Password Saat Ini</label>
                                        <input type="password" id="currentPassword" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">Password Baru</label>
                                        <input type="password" id="newPassword" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Konfirmasi Password Baru</label>
                                        <input type="password" id="confirmPassword" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                                </form>
                            </div>
                            
                            <div class="settings-section">
                                <h4>Sesi Aktif</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Perangkat</th>
                                            <th>IP Address</th>
                                            <th>Terakhir Aktif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sessions as $session)
                                        <tr>
                                            <td>{{ $session->device }}</td>
                                            <td>{{ $session->ip_address }}</td>
                                            <td>{{ $session->last_active }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm">Logout</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <p>&copy; 2023 BookDonation. All rights reserved.</p>
            </div>
        </div>
    </div>
    
    <!-- Profile Modal -->
    <div id="profileModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Profil Admin</h3>
                <span class="close">&times;</span>
            </div>
            <form>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" value="Admin">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="admin@bookdonation.com">
                </div>
                <div class="form-group">
                    <label for="phone">Telepon</label>
                    <input type="text" class="form-control" id="phone" value="08123456789">
                </div>
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan password baru">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Hapus Akun</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Modal Tambah Donatur -->
<div id="addDonaturModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Donatur Baru</h3>
            <span class="close" onclick="closeModal('addDonaturModal')">&times;</span>
        </div>
        <form id="addDonaturForm">
            <div class="form-row">
                <div class="form-group">
                    <label for="newDonaturName">Nama Lengkap</label>
                    <input type="text" id="newDonaturName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="newDonaturEmail">Email</label>
                    <input type="email" id="newDonaturEmail" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="newDonaturtelepon">Telepon</label>
                    <input type="text" id="newDonaturtelepon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="newDonaturStatus">Status</label>
                    <select id="newDonaturStatus" class="form-control" required>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>
            <!-- Kolom Alamat dihapus karena tidak ada di gambar -->
            <!-- <div class="form-group">
                <label for="newDonaturAddress">Alamat</label>
                <textarea id="newDonaturAddress" class="form-control" rows="3"></textarea>
            </div> -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addDonaturModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Donatur -->
<div id="editDonaturModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Donatur</h3>
            <span class="close" onclick="closeModal('editDonaturModal')">&times;</span>
        </div>
        <form id="editDonaturForm">
            <input type="hidden" id="editDonaturId" value="">
            <div class="form-row">
                <div class="form-group">
                    <label for="editDonaturName">Nama Lengkap</label>
                    <input type="text" id="editDonaturName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editDonaturEmail">Email</label>
                    <input type="email" id="editDonaturEmail" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="editDonaturtelepon">Telepon</label>
                    <input type="text" id="editDonaturtelepon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editDonaturStatus">Status</label>
                    <select id="editDonaturStatus" class="form-control" required>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>
            <!-- Kolom Alamat -->
            <div class="form-group">
                <label for="editDonaturalamat">Alamat</label>
                <textarea id="editDonaturalamat" class="form-control" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editDonaturModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
    
    <!-- Add Penerima Modal -->
    <div id="addPenerimaModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Penerima Baru</h3>
                <span class="close">&times;</span>
            </div>
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="penerimaName">Nama Penerima</label>
                        <input type="text" id="penerimaName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="penerimaType">Jenis Penerima</label>
                        <select id="penerimaType" class="form-control">
                            <option value="school">Sekolah</option>
                            <option value="orphanage">Panti Asuhan</option>
                            <option value="library">Taman Bacaan</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="penerimaContact">Kontak Person</label>
                        <input type="text" id="penerimaContact" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="penerimatelepon">Telepon</label>
                        <input type="text" id="penerimatelepon" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="penerimaalamat">Alamat Lengkap</label>
                    <textarea id="penerimaalamat" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="penerimaNeeds">Kebutuhan Buku</label>
                    <textarea id="penerimaNeeds" class="form-control" rows="2" placeholder="Jenis buku yang dibutuhkan"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

            <!-- Add Donasi Modal -->
            <div id="addDonasiModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Tambah Donasi Buku Baru</h3>
                        <span class="close">&times;</span>
                    </div>
                    <form>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="donasiDonatur">Donatur</label>
                                <!-- ✅ Benar: $donaturs (plurals) -->
        <select id="donasiDonatur" class="form-control">
            <option value="">Pilih Donatur</option>
            @foreach ($donaturs as $donatur)
                <option value="{{ $donatur->id }}">{{ $donatur->name }}</option>
            @endforeach
        </select>

        <select id="donasiPenerima" class="form-control">
            <option value="">Pilih Penerima</option>
            @foreach ($penerimas as $penerima)
                <option value="{{ $penerima->id }}">{{ $penerima->name }}</option>
            @endforeach
        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="donasiJudul">Judul Buku</label>
                    <input type="text" id="donasiJudul" class="form-control">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="donasiKategori">Kategori</label>
                        <select id="donasiKategori" class="form-control">
                            <option value="children">Buku Anak</option>
                            <option value="education">Pendidikan</option>
                            <option value="novel">Novel</option>
                            <option value="reference">Referensi</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="donasiJumlah">Jumlah</label>
                        <input type="number" id="donasiJumlah" class="form-control" value="1" min="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="donasiKondisi">Kondisi Buku</label>
                    <select id="donasiKondisi" class="form-control">
                        <option value="new">Baru</option>
                        <option value="good">Baik</option>
                        <option value="fair">Cukup</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="donasiCatatan">Catatan</label>
                    <textarea id="donasiCatatan" class="form-control" rows="2"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Penerima -->
<div id="editPenerimaModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Penerima</h3>
            <span class="close">&times;</span>
        </div>
        <form id="editPenerimaForm">
            <!-- Hidden input to store the ID of the recipient being edited -->
            <input type="hidden" id="editPenerimaId" name="id" value="">
            <div class="form-row">
                <div class="form-group">
                    <label for="editPenerimaName">Nama Penerima</label>
                    <input type="text" id="editPenerimaName" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editPenerimaType">Jenis Penerima</label>
                    <select id="editPenerimaType" name="type" class="form-control" required>
                        <option value="school">Sekolah</option>
                        <option value="orphanage">Panti Asuhan</option>
                        <option value="library">Taman Bacaan</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="editPenerimaContact">Kontak Person</label>
                    <input type="text" id="editPenerimaContact" name="contact_person" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editPenerimatelepon">Telepon</label>
                    <input type="text" id="editPenerimatelepon" name="telepon" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="editPenerimaalamat">Alamat Lengkap</label>
                <textarea id="editPenerimaalamat" name="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="editPenerimaNeeds">Kebutuhan Buku</label>
                <textarea id="editPenerimaNeeds" name="needs" class="form-control" rows="2" placeholder="Jenis buku yang dibutuhkan"></textarea>
            </div>
            <div class="form-group">
                <label for="editPenerimaStatus">Status</label>
                <select id="editPenerimaStatus" name="is_active" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('editPenerimaModal').style.display='none';">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
    
    <script>
        // Initialize chart
        document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('donationChart').getContext('2d');
        const donationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chart_months), // Gunakan data bulan dari controller
                datasets: [
                    {
                        label: 'Donatur',
                        data: @json($chart_donatur_data), // Gunakan data donatur dari controller
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        tension: 0.3
                    },
                    {
                        label: 'Penerima',
                        data: @json($chart_penerima_data), // Gunakan data penerima dari controller
                        borderColor: '#1cc88a',
                        backgroundColor: 'rgba(28, 200, 138, 0.05)',
                        tension: 0.3
                    },
                    {
                        label: 'Donasi Buku',
                        data: @json($chart_donasi_data), // Gunakan data donasi dari controller
                        borderColor: '#36b9cc',
                        backgroundColor: 'rgba(54, 185, 204, 0.05)',
                        tension: 0.3
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
            
            // Page navigation
            const navLinks = document.querySelectorAll('.nav-link');
            const pages = document.querySelectorAll('.page');
            const pageTitle = document.getElementById('page-title');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links and pages
                    navLinks.forEach(nl => nl.classList.remove('active'));
                    pages.forEach(page => page.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Show corresponding page
                    const pageId = this.getAttribute('data-page');
                    document.getElementById(pageId).classList.add('active');
                    
                    // Update page title
                    const pageTitles = {
                        'dashboard': 'Dashboard Admin',
                        'donatur': 'Kelola Donatur',
                        'penerima': 'Kelola Penerima',
                        'donasi': 'Kelola Donasi Buku',
                        'verifikasi': 'Verifikasi Donasi',
                        'laporan': 'Laporan',
                        'pengaturan': 'Pengaturan Sistem'
                    };
                    pageTitle.textContent = pageTitles[pageId];
                });
            });
            
            // Tab navigation in settings
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(tc => tc.classList.remove('active'));
                    
                    this.classList.add('active');
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId + '-tab').classList.add('active');
                });
            });
            
            // Modal functionality
            const modals = {
                profile: document.getElementById('profileModal'),
                donatur: document.getElementById('addDonaturModal'),
                penerima: document.getElementById('addPenerimaModal'),
                donasi: document.getElementById('addDonasiModal')
            };
            
            const closeButtons = document.querySelectorAll('.close');
            const profileLink = document.getElementById('profileLink');
            const addDonaturBtn = document.getElementById('addDonaturBtn');
            const addPenerimaBtn = document.getElementById('addPenerimaBtn');
            const addDonasiBtn = document.getElementById('addDonasiBtn');
            
            // Open modals
            profileLink.addEventListener('click', function(e) {
                e.preventDefault();
                modals.profile.style.display = 'block';
            });
            
            addDonaturBtn.addEventListener('click', function() {
                modals.donatur.style.display = 'block';
            });
            
            addPenerimaBtn.addEventListener('click', function() {
                modals.penerima.style.display = 'block';
            });
            
            addDonasiBtn.addEventListener('click', function() {
                modals.donasi.style.display = 'block';
            });
            
            // Close modals
            closeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.closest('.modal').style.display = 'none';
                });
            });
            
            window.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal')) {
                    e.target.style.display = 'none';
                }
            });
            
            // Cancel buttons in modals
            document.querySelectorAll('.btn-secondary').forEach(btn => {
                if (btn.textContent === 'Batal') {
                    btn.addEventListener('click', function() {
                        this.closest('.modal').style.display = 'none';
                    });
                }
            });
            
            // Notification icon
            const notificationIcon = document.getElementById('notificationIcon');
            notificationIcon.addEventListener('click', function() {
                alert('Anda memiliki 3 notifikasi baru');
            });
        });

        const reportTypeSelect = document.getElementById('reportType');
const ulasanReportDiv = document.getElementById('ulasanReport');
reportTypeSelect.addEventListener('change', function() {
    if (this.value === 'ulasan') {
        ulasanReportDiv.style.display = 'block';
    } else {
        ulasanReportDiv.style.display = 'none';
    }
});

// === Konfirmasi Logout ===
function confirmLogout() {
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        document.getElementById('logout-form').submit();
    }
}
// === Fungsi untuk membuka modal edit donatur (DIPERBAIKI) ===
function openEditDonaturModal(id, name, email, telepon, alamat, status) {
    // Isi nilai-nilai ke dalam form modal
    document.getElementById('editDonaturId').value = id;
    document.getElementById('editDonaturName').value = name;
    document.getElementById('editDonaturEmail').value = email;
    document.getElementById('editDonaturtelepon').value = telepon; // ✅ Tambahkan ini
    document.getElementById('editDonaturalamat').value = alamat; // ✅ Tambahkan ini
    document.getElementById('editDonaturStatus').value = status;

    // Tampilkan modal
    document.getElementById('editDonaturModal').style.display = 'block';
}

function deleteDonatur(id) {
    if (!confirm('Yakin hapus donatur ini?')) return;
    fetch(`/donatur/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Hapus baris dari DOM
            const row = event.target.closest('tr'); // ✅ Ini penting!
            if (row) row.remove();
            alert('Donatur berhasil dihapus.');
        } else {
            alert(data.message || 'Gagal menghapus donatur.');
        }
    })
    .catch(() => alert('Terjadi kesalahan.'));
}

// === Fungsi untuk membuka modal edit penerima ===
function openEditPenerimaModal(id, name, type, contact, telepon, alamat, needs, status) {
    document.getElementById('editPenerimaId').value = id;
    document.getElementById('editPenerimaName').value = name;
    document.getElementById('editPenerimaType').value = type;
    document.getElementById('editPenerimaContact').value = contact;
    document.getElementById('editPenerimatelepon').value = telepon;
    document.getElementById('editPenerimaalamat').value = alamat;
    document.getElementById('editPenerimaNeeds').value = needs;
    // Ubah string 'active'/'inactive' menjadi angka 1/0 untuk select
    document.getElementById('editPenerimaStatus').value = status === 'active' ? '1' : '0';
    document.getElementById('editPenerimaModal').style.display = 'block';
}

// === Fungsi untuk menghapus penerima via AJAX ===
function deletePenerima(id, event) {
    if (!confirm('Yakin hapus penerima ini? Data tidak dapat dipulihkan.')) return;

    fetch(`/penerima/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Hapus baris dari DOM
            const row = event.target.closest('tr');
            if (row) row.remove();
            alert(data.message || 'Penerima berhasil dihapus.');
        } else {
            alert(data.message || 'Gagal menghapus penerima.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(`Terjadi kesalahan: ${error.message}`);
    });
}

function showDonationDetail(donasiId) {
    const modal = document.getElementById('donationDetailModal');
    const content = document.getElementById('donationDetailContent');

    // Tampilkan modal
    modal.style.display = 'block';

    // Cari baris tabel yang sesuai dengan ID donasi
    const row = document.querySelector(`tr[data-donasi-id="${donasiId}"]`);

    if (!row) {
        content.innerHTML = `<p style="color: red;">Data donasi tidak ditemukan.</p>`;
        return;
    }

    // Ambil data dari kolom-kolom dalam baris tersebut
    const cells = row.querySelectorAll('td');
    const judulBuku = cells[1].textContent.trim();
    const donatur = cells[2].textContent.trim();
    const tanggal = cells[3].textContent.trim(); // Perhatikan indeks kolom

    // --- PERBAIKAN UTAMA ---
    // Ambil nilai status dari dropdown, bukan dari badge
    const statusDropdown = cells[4].querySelector('.status-dropdown'); // Ambil elemen select di kolom Status
    let statusValue = '';

    // Di dalam fungsi showDonationDetail
    if (statusDropdown) {
        statusValue = statusDropdown.value;
        // Konversi ke teks yang sama dengan yang ditampilkan di badge
        switch(statusValue) {
            case 'menunggu':
                statusValue = 'Menunggu';
                break;
            case 'diverifikasi':
                statusValue = 'Diverifikasi';
                break;
            case 'ditolak':
                statusValue = 'Ditolak';
                break;
            case 'terkirim':
                statusValue = 'Terkirim';
                break;
            default:
                statusValue = 'Status Tidak Dikenal';
        }
    } else {
        // Jika tidak ada dropdown (fallback), ambil dari badge atau teks
        const badge = cells[4].querySelector('.badge');
        if (badge) {
            statusValue = badge.textContent.trim();
        } else {
            statusValue = cells[4].textContent.trim();
        }
    }

    // Render konten detail
    content.innerHTML = `
        <div class="form-group">
            <label><strong>ID Donasi:</strong></label>
            <p>${donasiId}</p>
        </div>
        <div class="form-group">
            <label><strong>Judul Buku:</strong></label>
            <p>${judulBuku}</p>
        </div>
        <div class="form-group">
            <label><strong>Donatur:</strong></label>
            <p>${donatur}</p>
        </div>
        <div class="form-group">
            <label><strong>Tanggal:</strong></label>
            <p>${tanggal}</p>
        </div>
        <div class="form-group">
            <label><strong>Status:</strong></label>
            <p>${statusValue}</p>
        </div>
        <!-- Jika Anda ingin menambahkan catatan atau deskripsi, tambahkan di sini -->
        <div class="form-group">
            <label><strong>Catatan:</strong></label>
            <p>Tidak ada catatan tambahan.</p>
        </div>
    `;
}
// === Fungsi untuk memperbarui status donasi via AJAX ===
function updateDonationStatus(selectElement, donasiId) {
    const newStatus = selectElement.value;

    if (!confirm(`Yakin ingin mengubah status menjadi "${newStatus}"?`)) {
        selectElement.value = selectElement.getAttribute('data-original-status') || 'menunggu';
        return;
    }

    fetch(`/admin/donasi/${donasiId}/update-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: newStatus }) // << kirim status baru
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Update badge UI
            const row = selectElement.closest('tr');
            const statusCell = row.querySelector('td:nth-child(5)');

            const badges = {
                menunggu: ['badge-warning', 'Menunggu'],
                diverifikasi: ['badge-success', 'Diverifikasi'],
                ditolak: ['badge-danger', 'Ditolak'],
                terkirim: ['badge-primary', 'Terkirim']
            };

            const [cls, text] = badges[newStatus] ?? ['badge-secondary', newStatus];
            statusCell.innerHTML = `<span class="badge ${cls}">${text}</span>`;

            alert('Status donasi berhasil diperbarui.');
        } else {
            alert(data.message || 'Gagal memperbarui status.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    });
}
    // Fungsi untuk menutup modal detail
    function closeDonationDetailModal() {
        document.getElementById('donationDetailModal').style.display = 'none';
    }

    // Tutup modal jika klik di luar
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('donationDetailModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Tutup modal jika klik tombol X
    document.querySelector('.modal-content .close').addEventListener('click', function() {
        document.getElementById('donationDetailModal').style.display = 'none';
    });
    // --- Fungsi Donatur ---
function showAddDonaturForm() {
    document.getElementById('addDonaturModal').style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

/*function openEditDonaturModal(id, name, email, phone, address, status) {
    document.getElementById('editDonaturId').value = id;
    document.getElementById('editDonaturName').value = name;
    document.getElementById('editDonaturEmail').value = email;
    document.getElementById('editDonaturPhone').value = phone;
    document.getElementById('editDonaturAddress').value = address; // ✅ Isi alamat
    document.getElementById('editDonaturStatus').value = status;
    document.getElementById('editDonaturModal').style.display = 'block';
}
    */

function deleteDonatur(id) {
    if (!confirm('Yakin hapus donatur ini?')) return;
    fetch(`/donatur/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const row = event.target.closest('tr');
            if (row) row.remove();
            alert('Donatur berhasil dihapus.');
        } else {
            alert(data.message || 'Gagal menghapus donatur.');
        }
    })
    .catch(() => alert('Terjadi kesalahan.'));
}

function applyFilter() {
    const searchTerm = document.getElementById('searchDonatur').value.toLowerCase();
    const statusFilter = document.getElementById('filterStatus').value;
    const rows = document.querySelectorAll('#donaturTableBody tr');
    rows.forEach(row => {
        // Ambil teks dari kolom Nama (index 1), Email (index 2), dan Telepon (index 3)
        const name = row.cells[1]?.textContent.toLowerCase() || '';
        const email = row.cells[2]?.textContent.toLowerCase() || '';
        const telepon = row.cells[3]?.textContent.toLowerCase() || ''; // ✅ Sekarang kita gunakan lagi

        // Status sekarang ada di cells[5]
        const status = row.cells[5]?.querySelector('.badge')?.classList.contains('badge-success') ? 'active' : 'inactive';

        // Filter berdasarkan nama, email, DAN telepon
        const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm) || telepon.includes(searchTerm);
        const matchesStatus = statusFilter === '' || status === statusFilter;

        // Tampilkan atau sembunyikan baris
        row.style.display = (matchesSearch && matchesStatus) ? 'table-row' : 'none';
    });
}

// Submit form tambah donatur
document.getElementById('addDonaturForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Donatur baru berhasil ditambahkan!');
    closeModal('addDonaturModal');
});

// Submit form edit donatur (DIPERBAIKI)
document.getElementById('editDonaturForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('editDonaturId').value;
    const name = document.getElementById('editDonaturName').value;
    const email = document.getElementById('editDonaturEmail').value;
    const telepon = document.getElementById('editDonaturtelepon').value;
    const alamat = document.getElementById('editDonaturalamat').value; // tetap dikirim ke backend
    const status = document.getElementById('editDonaturStatus').value;

    // Simulasi update
    alert(`Data donatur dengan ID ${id} berhasil diperbarui!`);

    // Update hanya kolom yang ADA di tabel: Nama, Email, Telepon, Status
    const row = document.querySelector(`tr[data-donatur-id="${id}"]`);
    if (row) {
        row.cells[1].textContent = name;      // Nama
        row.cells[2].textContent = email;     // Email
        row.cells[3].textContent = telepon;     // Telepon
        row.cells[5].textContent = alamat;
        // TIDAK ADA cells[4] = address → skip!
        const statusCell = row.cells[5];      // Status
        if (status === 'active') {
            statusCell.innerHTML = '<span class="badge badge-success">Aktif</span>';
        } else {
            statusCell.innerHTML = '<span class="badge badge-warning">Nonaktif</span>';
        }
    }
    closeModal('editDonaturModal');
});

// === Fungsi untuk memperbarui status pengajuan via AJAX ===
// === Fungsi untuk memperbarui status pengajuan via AJAX ===
function updatePengajuanStatus(selectElement, pengajuanId) {
    const newStatus = selectElement.value;
    if (!confirm(`Yakin ingin mengubah status menjadi "${newStatus}"?`)) {
        selectElement.value = selectElement.getAttribute('data-original-status') || 'menunggu';
        return;
    }

    // ✅ PERBAIKAN: Kirim data sebagai JSON
    fetch(`/admin/pengajuan/${pengajuanId}/status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json', // ✅ Penting: Tandai bahwa kita mengirim JSON
        },
        body: JSON.stringify({
            status: newStatus // ✅ Data dikirim dalam format JSON
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI
            const row = selectElement.closest('tr');
            const statusCell = row.querySelector('td:nth-child(5)');
            let badgeClass = '';
            let badgeText = '';
            switch(newStatus) {
                case 'menunggu':
                    badgeClass = 'badge-warning';
                    badgeText = 'Menunggu';
                    break;
                case 'disetujui':
                    badgeClass = 'badge-success';
                    badgeText = 'Disetujui';
                    break;
                case 'ditolak':
                    badgeClass = 'badge-danger';
                    badgeText = 'Ditolak';
                    break;
                default:
                    badgeClass = 'badge-secondary';
                    badgeText = newStatus;
            }
            statusCell.innerHTML = `<span class="badge ${badgeClass}">${badgeText}</span>`;
            alert('Status pengajuan berhasil diperbarui.');
        } else {
            alert(data.message || 'Gagal memperbarui status.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    });
}

</script>
</body>
</html>
