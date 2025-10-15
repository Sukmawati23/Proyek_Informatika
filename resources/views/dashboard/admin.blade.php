<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color:#000080;
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
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }
        
        .stat-card.penerima {
            border-left-color: var(--success-color);
        }
        
        .stat-card.donasi {
            border-left-color: var(--info-color);
        }
        
        .stat-card.pending {
            border-left-color: var(--warning-color);
        }
        
        .stat-title {
            font-size: 14px;
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
                        <a href="{{ route('logout') }}"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</a>
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
                        <div class="stat-value"></div>
                        <div class="stat-change up"><i class="fas fa-arrow-up"></i> % dari bulan lalu</div>
                    </div>
                    
                    <div class="stat-card penerima">
                        <div class="stat-title">Penerima</div>
                        <div class="stat-value"></div>
                        <div class="stat-change up"><i class="fas fa-arrow-up"></i> % dari bulan lalu</div>
                    </div>
                    
                    <div class="stat-card donasi">
                        <div class="stat-title">Donasi Buku</div>
                        <div class="stat-value"></div>
                        <div class="stat-change up"><i class="fas fa-arrow-up"></i> % dari bulan lalu</div>
                    </div>
                    
                    <div class="stat-card pending">
                        <div class="stat-title">Menunggu Verifikasi</div>
                        <div class="stat-value"></div>
                        <div class="stat-change down"><i class="fas fa-arrow-down"></i> 3% dari bulan lalu</div>
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
                            <tr>
                                <td>10 menit lalu</td>
                                <td>Donasi buku baru</td>
                                <td>John Doe</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <td>30 menit lalu</td>
                                <td>Pendaftaran penerima baru</td>
                                <td>Jane Smith</td>
                                <td><span class="badge badge-success">Disetujui</span></td>
                            </tr>
                            <tr>
                                <td>1 jam lalu</td>
                                <td>Verifikasi donasi</td>
                                <td>Admin</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>2 jam lalu</td>
                                <td>Pengiriman buku</td>
                                <td>System</td>
                                <td><span class="badge badge-success">Dikirim</span></td>
                            </tr>
                            <tr>
                                <td>5 jam lalu</td>
                                <td>Donasi ditolak</td>
                                <td>Admin</td>
                                <td><span class="badge badge-danger">Ditolak</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Donatur Page -->
            <div id="donatur" class="page">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Donatur</h3>
                        <button class="btn btn-primary" id="addDonaturBtn">Tambah Donatur</button>
                    </div>
                    <div class="search-filter">
                        <input type="text" placeholder="Cari donatur..." class="form-control">
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
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Total Donasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>D001</td>
                                <td>John Doe</td>
                                <td>john@example.com</td>
                                <td>08123456789</td>
                                <td>15 buku</td>
                                <td><span class="badge badge-success">Aktif</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>D002</td>
                                <td>Jane Smith</td>
                                <td>jane@example.com</td>
                                <td>08234567890</td>
                                <td>8 buku</td>
                                <td><span class="badge badge-success">Aktif</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>D003</td>
                                <td>Robert Johnson</td>
                                <td>robert@example.com</td>
                                <td>08345678901</td>
                                <td>3 buku</td>
                                <td><span class="badge badge-warning">Nonaktif</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Penerima Page -->
            <div id="penerima" class="page">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Penerima</h3>
                        <button class="btn btn-primary" id="addPenerimaBtn">Tambah Penerima</button>
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
                            <tr>
                                <td>P001</td>
                                <td>SD Negeri 1 Jakarta</td>
                                <td>Jl. Merdeka No.1, Jakarta</td>
                                <td>0211234567</td>
                                <td>25 buku</td>
                                <td><span class="badge badge-success">Aktif</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>P002</td>
                                <td>Panti Asuhan Kasih Bunda</td>
                                <td>Jl. Bahagia No.10, Bandung</td>
                                <td>0227654321</td>
                                <td>18 buku</td>
                                <td><span class="badge badge-success">Aktif</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>P003</td>
                                <td>Taman Bacaan Pelangi</td>
                                <td>Jl. Ceria No.5, Surabaya</td>
                                <td>0319876543</td>
                                <td>12 buku</td>
                                <td><span class="badge badge-warning">Nonaktif</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Donasi Buku Page -->
            <div id="donasi" class="page">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Donasi Buku</h3>
                        <button class="btn btn-primary" id="addDonasiBtn">Tambah Donasi</button>
                    </div>
                    <div class="search-filter">
                        <input type="text" placeholder="Cari donasi..." class="form-control">
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
                                <th>Penerima</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>DN001</td>
                                <td>Buku Cerita Anak</td>
                                <td>John Doe</td>
                                <td>SD Negeri 1 Jakarta</td>
                                <td>15 Jan 2023</td>
                                <td><span class="badge badge-success">Terkirim</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Detail</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>DN002</td>
                                <td>Ensiklopedia Sains</td>
                                <td>Jane Smith</td>
                                <td>Panti Asuhan Kasih Bunda</td>
                                <td>20 Feb 2023</td>
                                <td><span class="badge badge-success">Terkirim</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Detail</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>DN003</td>
                                <td>Novel Petualangan</td>
                                <td>Robert Johnson</td>
                                <td>Taman Bacaan Pelangi</td>
                                <td>5 Mar 2023</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Detail</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Verifikasi Page -->
            <div id="verifikasi" class="page">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Verifikasi Pengajuan Donasi</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Pengajuan</th>
                                <th>Judul Buku</th>
                                <th>Donatur</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>V001</td>
                                <td>Kamus Bahasa Inggris</td>
                                <td>Michael Brown</td>
                                <td>10 Apr 2023</td>
                                <td><span class="badge badge-warning">Menunggu</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-success btn-sm">Setujui</button>
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                        <button class="btn btn-primary btn-sm">Detail</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>V002</td>
                                <td>Buku Matematika SD</td>
                                <td>Sarah Wilson</td>
                                <td>12 Apr 2023</td>
                                <td><span class="badge badge-warning">Menunggu</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-success btn-sm">Setujui</button>
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                        <button class="btn btn-primary btn-sm">Detail</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>V003</td>
                                <td>Buku Cerita Rakyat</td>
                                <td>David Lee</td>
                                <td>15 Apr 2023</td>
                                <td><span class="badge badge-warning">Menunggu</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-success btn-sm">Setujui</button>
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                        <button class="btn btn-primary btn-sm">Detail</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                            <tr>
                                <td>Laporan_Donasi_Maret_2023.pdf</td>
                                <td>Donasi</td>
                                <td>1 Apr 2023</td>
                                <td>PDF</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Unduh</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Laporan_Penerima_Februari_2023.xlsx</td>
                                <td>Penerima</td>
                                <td>1 Mar 2023</td>
                                <td>Excel</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Unduh</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Laporan_Verifikasi_Januari_2023.pdf</td>
                                <td>Verifikasi</td>
                                <td>1 Feb 2023</td>
                                <td>PDF</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm">Unduh</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        <tr>
    <td>Laporan_Ulasan_Maret_2023.pdf</td>
    <td>Ulasan & Rating</td>
    <td>20 Mar 2023</td>
    <td>PDF</td>
    <td>
        <div class="action-buttons">
            <button class="btn btn-primary btn-sm">Unduh</button>
            <button class="btn btn-danger btn-sm">Hapus</button>
        </div>
    </td>
</tr> 
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
                <tr>
                    <td><span class="badge badge-primary">Donatur</span></td>
                    <td>John Doe</td>
                    <td>Buku dikirim tepat waktu, terima kasih!</td>
                    <td>★★★★★ (5)</td>
                    <td>10 Mar 2023</td>
                </tr>
                <tr>
                    <td><span class="badge badge-success">Penerima</span></td>
                    <td>SD Negeri 1 Jakarta</td>
                    <td>Buku dalam kondisi sangat baik, anak-anak senang.</td>
                    <td>★★★★☆ (4)</td>
                    <td>12 Mar 2023</td>
                </tr>
                <tr>
                    <td><span class="badge badge-primary">Donatur</span></td>
                    <td>Jane Smith</td>
                    <td>Proses verifikasi cepat, sistem sangat membantu.</td>
                    <td>★★★★★ (5)</td>
                    <td>15 Mar 2023</td>
                </tr>
                <tr>
                    <td><span class="badge badge-success">Penerima</span></td>
                    <td>Panti Asuhan Kasih Bunda</td>
                    <td>Butuh lebih banyak buku cerita anak.</td>
                    <td>★★★☆☆ (3)</td>
                    <td>18 Mar 2023</td>
                </tr>
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
                                        <strong>Donasi baru diterima</strong>
                                        <p>John Doe mendonasikan 3 buku</p>
                                    </div>
                                    <span>2 jam lalu</span>
                                </div>
                                <div class="notification-item">
                                    <div>
                                        <strong>Penerima baru terdaftar</strong>
                                        <p>SD Negeri 5 Bandung mendaftar</p>
                                    </div>
                                    <span>5 jam lalu</span>
                                </div>
                                <div class="notification-item">
                                    <div>
                                        <strong>Verifikasi diperlukan</strong>
                                        <p>3 donasi menunggu verifikasi</p>
                                    </div>
                                    <span>1 hari lalu</span>
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
                                        <tr>
                                            <td>Chrome, Windows 10</td>
                                            <td>192.168.1.1</td>
                                            <td>Sekarang</td>
                                            <td><button class="btn btn-danger btn-sm">Keluar</button></td>
                                        </tr>
                                        <tr>
                                            <td>Firefox, Android</td>
                                            <td>192.168.1.2</td>
                                            <td>2 jam lalu</td>
                                            <td><button class="btn btn-danger btn-sm">Keluar</button></td>
                                        </tr>
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
    
    <!-- Add Donatur Modal -->
    <div id="addDonaturModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Donatur Baru</h3>
                <span class="close">&times;</span>
            </div>
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="donaturName">Nama Lengkap</label>
                        <input type="text" id="donaturName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="donaturEmail">Email</label>
                        <input type="email" id="donaturEmail" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="donaturPhone">Telepon</label>
                        <input type="text" id="donaturPhone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="donaturStatus">Status</label>
                        <select id="donaturStatus" class="form-control">
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="donaturAddress">Alamat</label>
                    <textarea id="donaturAddress" class="form-control" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                        <label for="penerimaPhone">Telepon</label>
                        <input type="text" id="penerimaPhone" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="penerimaAddress">Alamat Lengkap</label>
                    <textarea id="penerimaAddress" class="form-control" rows="3"></textarea>
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
                        <select id="donasiDonatur" class="form-control">
                            <option value="">Pilih Donatur</option>
                            <option value="D001">John Doe</option>
                            <option value="D002">Jane Smith</option>
                            <option value="D003">Robert Johnson</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="donasiPenerima">Penerima</label>
                        <select id="donasiPenerima" class="form-control">
                            <option value="">Pilih Penerima</option>
                            <option value="P001">SD Negeri 1 Jakarta</option>
                            <option value="P002">Panti Asuhan Kasih Bunda</option>
                            <option value="P003">Taman Bacaan Pelangi</option>
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
    
    <script>
        // Initialize chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('donationChart').getContext('2d');
            const donationChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [
                        {
                            label: 'Donatur',
                            data: [120, 190, 170, 220, 210, 250],
                            borderColor: '#4e73df',
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            tension: 0.3
                        },
                        {
                            label: 'Penerima',
                            data: [80, 120, 110, 140, 150, 170],
                            borderColor: '#1cc88a',
                            backgroundColor: 'rgba(28, 200, 138, 0.05)',
                            tension: 0.3
                        },
                        {
                            label: 'Donasi Buku',
                            data: [250, 300, 400, 500, 450, 600],
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
    </script>
</body>
</html>