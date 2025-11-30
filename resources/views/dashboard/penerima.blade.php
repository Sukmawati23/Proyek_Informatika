<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penerima</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #00002c;
            color: white;
            font-size: 20px;
        }

        .container {
            padding: 20px;
            text-align: center;
            front-size: 20px;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 10px;
            font-weight: normal;
        }

        .card-book {
            background-color: #00008070;
            padding: 15px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            max-width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .card-book img {
            width: 150px;
            margin-bottom: 10px;
        }

        .btn-daftar {
            display: inline-block;
            margin-top: 10px;
            background-color: #00002c;
            padding: 20px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

       .status-box, .book-box, .book-detail, .notification-section {
            background-color: #00008070;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            overflow-x: auto;
        }

        .status-box table, .book-box table, .book-detail table {
            width: 100%;
            color: white;
            border-collapse: collapse;
        }

        .status-box th, .status-box td, .book-box th, .book-box td, .book-detail th, .book-detail td {
            padding: 12px;
            border-bottom: 1px solid #aaa;
            text-align: center;
        }

        .nav {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #0000b3;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .nav i {
            font-size: 24px;
            cursor: pointer;
            color: white;
            padding: 10px;
        }

        .success-message {
            display: none;
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }

       .search-box input {
            padding: 20px;
            width: 100%;
            max-width: 800px;
            border-radius: 5px;
            border: none;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .btn-kembali, .btn-ajukan {
            background-color: #ff4500;
            padding: 20px;
            border-radius: 5px;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            margin-right: 10px;
            font-size: 20px;
            width:800px;
        }

         .btn-kembali:hover, .btn-ajukan:hover {
            background-color: #dc143c;
        }

        .book-detail img {
            width: 150px;
            margin-bottom: 10px;
        }

        .no-results {
            color: #ff4500;
            margin-top: 20px;
        }
        
         /* Profil */
        #profileSection {
            display: none;
            background-color: #00002c;
            color: white;
            min-height: 100vh;
            padding: 20px;
            text-align: center;
            font-size: 20px;
        }

        #profileSection .title {
            color: #ADD8E6;
            margin-bottom: 20px;
            font-size: 30px;
            padding: 20px;
        }

        .profile-pic-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
            
        }

        #fotoProfilPreview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
        }

       .profile-pic-wrapper i {
            position: absolute;
            right: 0;
            bottom: 0;
            background: white;
            color: red;
            border-radius: 50%;
            padding: 20px;
        }

        .profile-menu {
            margin-top: 30px;
            text-align: left;
            font-size: 20px;
        }

        .profile-menu div {
            background-color: #00008070;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            color: white;
            cursor: pointer;
            font-size: 20px;
        }

        .profile-menu div i {
            margin-right: 10px;
        }

         /* Notifikasi */
        #notificationsSection {
            display: none;
            background-color: #00002c;
            color: white;
            padding: 20px;
            min-height: 100vh;
        }

        #notificationsSection h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .notif-card {
            background-color: #1a1aff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .notif-card small {
            color: #ccc;
        }

        .notification-icon {
            display: block;
            margin: 0 auto 10px;
            width: 50px;
        }
        
       .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            background: #0a0fbf;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            color: white;
            animation: fadeIn 0.3s ease-in-out;
        }

        .notif-icon {
            font-size: 24px;
        }

        .notif-content {
            flex: 1;
        }

        .notif-text {
            margin: 0;
            font-size: 16px;
            line-height: 1.4;
        }

         .notif-time {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            opacity: 0.7;
        }

        /* Pengaturan */
        #settingsSection {
            display: none;
            background-color: #00002c;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 46px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 24px;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #26e07f;
        }

        input:checked + .slider:before {
            transform: translateX(22px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-book {
                width: 90%;
            }
            
            .status-box, .book-box, .book-detail {
                width: 95%;
                font-size: 20px;
            }
            
            .status-box table, .book-box table, .book-detail table {
                font-size: 14px;
            }
            
            .status-box th, .status-box td, 
            .book-box th, .book-box td, 
            .book-detail th, .book-detail td {
                padding: 8px;
            }
        }

        /* Animasi */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
    </style>
</head>
<body>
    <!-- Dashboard Utama -->
    <div id="dashboardSection" class="container fade-in">
        <img src="LOGO-SDB.png" class="logo" alt="Logo">
        <h2 id="userName">Halo,  {{ $user->name }}!</h2>

        <div class="card-book" id="cardBook">
            <img src="icon-daftar-buku.png" alt="Icon Daftar Buku">
            <a href="#daftar-buku" class="btn-daftar" onclick="showBookList()">Daftar Buku</a>
        </div>

        <h3>Status Permintaan</h3>
<div class="status-box" id="statusSection">
    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajuans as $pengajuan)
                        <tr>
                            <td>{{ $pengajuan->buku?->judul ?? '-' }}</td>
                            <td>{{ ucfirst($pengajuan->status) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2">Belum ada permintaan.</td></tr>
                    @endforelse
        </tbody>
    </table>
</div>
    </div>

   <!-- Daftar Buku -->
    <div id="bookListSection" style="display: none;" class="container fade-in">
        <h3>Daftar Buku</h3>
        <div class="search-box">
            <input 
                type="text" 
                id="searchInput" 
                name="search_buku"
                placeholder="Cari buku..." 
                autocomplete="off"
                autocorrect="off"
                autocapitalize="none"
                spellcheck="false"
                oninput="filterBooks()">
        </div>
        <div class="book-box">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="bookTableBody">
                    <!-- Diisi oleh JavaScript -->
                </tbody>
            </table>
            <div id="noResults" class="no-results" style="display: none;">Buku tidak ditemukan.</div>
        </div>
        <button class="btn-kembali" onclick="hideBookList()">Kembali</button>
    </div>
    
     <!-- Detail Buku -->
    <div id="bookDetailSection" class="container fade-in" style="display: none;font-size:20px;">
        <div class="book-detail">
            <h3>Detail Buku</h3>
            <div class="book-detail-content">
                <table id="bookDetailContent">
                    <!-- Diisi oleh JavaScript -->
                </table>
            </div>
            <button class="btn-ajukan" onclick="confirmAjukanBuku()">Ajukan Buku</button>
            <button class="btn-kembali" onclick="hideBookDetail()">Kembali</button>
        </div>
    </div>

    <!-- Notifikasi Pengajuan -->
    <div id="notificationSection" style="display: none;" class="container fade-in">
        <div class="notification-section">
            <h2>Permintaan Diajukan</h2>
            <img src="{{ asset('verified-icon.png') }}" alt="✓" style="width: 120px; margin: 20px 0;">
            <h3>Permintaan telah diajukan</h3>
            <p>Permintaan buku Anda telah berhasil diajukan.</p>
            <button class="btn-daftar" onclick="kembaliKeBeranda()">Kembali ke Beranda</button>
        </div>
    </div>

    <!-- Profil -->
    <div id="profileSection" class="fade-in">
        <p class="title">Profil Penerima</p>
        <div class="profile-pic-wrapper" onclick="document.getElementById('uploadFotoProfil').click()">
            <img id="fotoProfilPreview" src="profile-placeholder.jpg" />
            <i class="fas fa-camera"></i>
            <input type="file" id="uploadFotoProfil" accept="image/*" style="display:none;" onchange="previewFotoProfil(event)" />
        </div>
        <p style="margin-top: 10px; font-weight: bold;" id="profileName">{{ $user->name }}</p>

        <div class="profile-menu">
            <div onclick="showSettings()"><i class="fas fa-cog"></i> Pengaturan</div>
            <div onclick="showHelp()"><i class="fas fa-question-circle"></i> Bantuan</div>
            <div onclick="showTerms()"><i class="fas fa-file-alt"></i> Syarat & Ketentuan</div>
            <div onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</div>
        </div>
    </div>

    <!-- Notifikasi -->
    <div id="notificationsSection" class="fade-in">
        <img src="bell-icon.png" alt="Notifikasi" style="width:100px; display:block; margin:auto;">
        <h2>Notifikasi</h2>
         @foreach($notifications as $notif)
           <div class="notif-box" style="background:#00008070;; padding:20px; margin-bottom:20px; border-radius:10px; color:white;">
            
                <strong>• {{ $notif->pesan }}</strong>

                <div style="margin-top:8px; font-size:14px; opacity:0.8;">
    {{ $notif->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
</div>


                <!-- TOMBOL CHAT KANAN -->
          @if(!str_contains(strtolower($notif->pesan), 'ditolak'))
    <div style="text-align:right; margin-top:-25px;">
        <a href="{{ route('chat.fromNotif', $notif->id) }}"
           style="background-color:#000080; color:white; padding:5px 10px; border-radius:5px; text-decoration:none; font-weight:bold;">
            Masuk Chat
        </a>
    </div>
@endif


            </div>
        @endforeach

        @if($notifications->isEmpty())
            <p class="text-center text-white mt-4">Belum ada notifikasi.</p>
        @endif
    </div>

     <!-- Pengaturan Akun -->
    <div id="settingsSection" class="fade-in">
        <h2 style="background-color:#00008070; color:white; padding:20px; border-radius: 5px; text-align:center;">
            <i class="fas fa-cog"></i> Pengaturan Akun
        </h2>
        <div style="margin:20px 0;">
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showEditAccount()">
                Edit Akun <span style="float:right;font-size:20px;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showChangeEmail()">
                Ubah Email <span style="float:right;font-size:20px;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showChangePassword()">
                Ganti Kata Sandi <span style="float:right;font-size:20px;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showPrivacy()">
                Privasi & Keamanan <span style="float:right;font-size:20px;">›</span>
            </div>
        </div>
        <div style="margin: 10px 0; display: flex; align-items: center; justify-content: space-between;">
            <span>Kirim notifikasi via email</span>
            <label class="switch">
                <input type="checkbox" id="emailNotifCheckbox">
                <span class="slider round"></span>
            </label>
        </div>
        <button onclick="showDeleteAccountConfirm()" style="width:100%; background-color: darkred; color:white; padding:20px; border:none; border-radius:5px; font-weight:bold; margin-top: 20px;font-size:20px">
            Hapus Akun
        </button>
        <br><br>
        <button onclick="showProfile()" style="width:100%; background-color: #00008070; color:white; padding:20px; border:none; border-radius:5px;font-size:20px">
            Kembali
        </button>
    </div>
    
    <!-- Bantuan -->
    <div id="helpSection" style="display: none;" class="fade-in">
        <h2 style="text-align:center;font-size:50px;"><i class="fas fa-question-circle"></i> Bantuan</h2>
        <div style="background:#00008070; color:white; border-radius:10px; padding:15px; margin:20px;">
            <strong>Cara mengubah foto profil?</strong>
            <p>Anda dapat mengubah foto profil pada halaman utama profil.</p>
        </div>
        <div style="background:#00008070; color:white; border-radius:10px; padding:15px; margin:20px;">
            <strong>Tidak dapat mengakses akun</strong>
            <p>Coba atur ulang kata sandi atau hubungi kami untuk bantuan.</p>
        </div>
        <div style="background:#00008070; color:white; border-radius:10px; padding:15px; margin:20px;">
            <strong>Ketentuan pengguna</strong>
            <p>Baca syarat & ketentuan untuk informasi mengenai aturan.</p>
        </div>
        <div style="background:#00008070; color:white; border-radius:10px; padding:15px; margin:20px;">
            <strong>Butuh bantuan lainnya?</strong>
            <p>Hubungi kami di: <a href="mailto:donasibuku.app@gmail.com">donationbook7@gmail.com</a></p>
        </div>
        <button onclick="showProfile()" style="margin: 20px; padding: 20px; background-color: #0000b3; color: white; border: none; border-radius: 5px;font-size:20px;width:1875px">
            Kembali
        </button>
    </div>

   <!-- Syarat & Ketentuan -->
    <div id="termsSection" style="display: none;" class="fade-in">
        <h2 style="color: #ADD8E6; text-align: center;font-size:30px">Syarat & Ketentuan Penerima</h2>
        <div style="background: #00008070; height:140px;color: white padding: 50px; border-radius: 10px; margin: 20px; text-align: left;font-size:20px;">
            <ol>
                <li>Data penerima harus benar dan dapat diverifikasi.</li>
                <li>Donasi hanya untuk keperluan yang sesuai dengan tujuan permohonan.</li>
                <li>Tidak diperbolehkan menyalahgunakan donasi untuk hal di luar kebutuhan.</li>
                <li>Penerima wajib melaporkan jika ada perubahan data atau kebutuhan.</li>
                <li>Dengan mendaftar, Anda setuju pada ketentuan ini.</li>
            </ol>
            
            <button onclick="showProfile()" style="margin-top: 20px; padding: 20px 20px; background-color: #0000b3; color: white; border: none; border-radius: 5px;font-size:20px;width:1873px;">
                Kembali
            </button>
        </div>
    </div>

    <!-- Halaman Edit Akun -->
<div id="editAccountSection" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px; text-align: center;">
    <h2 style="color: lightgray;">Edit Akun</h2>
    <div style="margin: 20px auto;">
        <div class="profile-pic-wrapper" onclick="document.getElementById('uploadFotoProfilEdit').click()">
            <img id="fotoProfilEditPreview" src="{{ $user->foto ? asset('storage/'.$user->foto) : 'profile-placeholder.jpg' }}" 
                 style="width: 150px; height: 150px; border-radius: 50%; background-color: white;" />
            <i class="fas fa-camera"></i>
            <input type="file" id="uploadFotoProfilEdit" accept="image/*" style="display:none;" onchange="previewFotoProfilEdit(event)" />
        </div>
    </div>
    <div style="max-width: 800px; margin: auto; text-align: left;">
        <label><i class="fas fa-check-circle" style="color: lime;"></i> Nama Lengkap</label>
        <input type="text" id="editNama" value="{{ $user->name }}" 
               placeholder="Nama Lengkap" style="width: 100%; margin-bottom: 10px; padding: 20px; border-radius: 5px; border: none;font-size:20px;" />

        <label><i class="fas fa-check-circle" style="color: lime;"></i> Alamat</label>
        <input type="text" id="editAlamat" value="{{ $user->alamat ?? '' }}" 
               placeholder="Alamat" style="width: 100%; margin-bottom: 10px; padding: 20px; border-radius: 5px; border: none;font-size:20px;" />

        <label><i class="fas fa-check-circle" style="color: lime;"></i> No. Telepon</label>
        <input type="text" id="editTelepon" value="{{ $user->telepon ?? '' }}" 
               placeholder="Nomor Telepon" style="width: 100%; margin-bottom: 20px; padding: 20px; border-radius: 5px; border: none;font-size:20px;" />
    </div>
    <button style="background-color: #0000cd; color: white; padding:20px; border: none; border-radius: 8px;font-size:20px;width:500px;" 
            onclick="saveAccountChanges()">
        Simpan
    </button>
    <br><br>
    <button onclick="showSettings()" style="color: white; background: none; border: none; text-decoration: underline;font-size:20px;">Kembali</button>
</div>

    <!-- Halaman Ubah Email -->
    <div id="changeEmailSection" style="display: none;" class="fade-in">
        <h2 style="text-align: center; color: white;">Ubah Email</h2>
        <div style="background-color: #00008070;  color: white; border-radius: 5px; padding: 20px; margin: 20px; text-align: center;">
            <img src="https://img.icons8.com/ios-filled/100/ffffff/new-post.png" style="width:80px; margin-bottom: 20px;" />
            <p style="font-weight: bold; font-size: 20px;">Ubah Email</p>
            <input type="email" placeholder="Email Saat ini" id="currentEmail" style="width:97%; margin-bottom:10px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
            <input type="email" placeholder="Email Baru" id="newEmail" style="width:97%; margin-bottom:20px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
            <button onclick="submitEmailChange()" style="width:100%; padding:20px; background-color:#000080; color:white; border:none; border-radius:5px;font-size:20px">
                PERBAHARUI EMAIL
            </button>
        </div>
    </div>

    <!-- Halaman Konfirmasi Email Berhasil -->
    <div id="emailSuccessSection" style="display: none;" class="fade-in">
        <h2 style="color:white; text-align: center;">Ubah Email</h2>
        <div style="background-color:white; color:black; border-radius:10px; padding:30px; margin: 20px;">
            <img src="https://img.icons8.com/ios-filled/100/26e07f/checkmark--v1.png" style="width:80px; margin-bottom:15px;" />
            <p style="font-weight:bold; font-size:18px; color:#000080;">Email berhasil diperbaharui</p>
            <p>Email Anda telah berhasil diperbaharui! Silakan verifikasi di email Anda!</p>
            <button onclick="showSettings()" style="margin-top:20px; padding:10px 20px; background-color:#000080; color:white; border:none; border-radius:5px;">
                OK
            </button>
        </div>
    </div>

   <!-- Halaman Ganti Kata Sandi -->
    <div id="changePasswordSection" style="display: none;" class="fade-in">
        <h2 style="text-align: center; color: white;font-size:30px">Ganti Kata Sandi</h2>
        <div style="background-color: #00008070;  color: white; border-radius: 10px; padding: 20px; margin: 20px; text-align: center;">
            <img src="https://img.icons8.com/ios-filled/100/ffffff/lock-2.png" style="width:200px; margin-bottom: 10px;" />
            <p style="font-weight: bold; font-size: 30px;">Ganti Kata Sandi</p>
            <input type="password" placeholder="Kata sandi saat ini" id="currentPassword" style="width:97%; margin-bottom:10px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
            <input type="password" placeholder="Kata sandi baru" id="newPassword" style="width:97%; margin-bottom:10px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
            <input type="password" placeholder="Konfirmasi kata sandi" id="confirmPassword" style="width:97%; margin-bottom:20px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
            <button onclick="submitPasswordChange()" style="width:99%;  background-color:#000080; color:white; border:none; border-radius:5px;padding:20px;font-size:20px">
                Simpan
            </button>
        </div>
    </div>

    <!-- Halaman Konfirmasi Kata Sandi Berhasil -->
    <div id="passwordSuccessSection" style="display: none;" class="fade-in">
        <h2 style="color:white; text-align: center;">Kata Sandi Berhasil Diubah</h2>
        <div style="background-color:#00008070; color:black; border-radius:10px; padding:30px; margin: 20px;">
            <img src="https://img.icons8.com/ios-filled/100/26e07f/checkmark--v1.png" style="width:80px; display:block:margin: 0 auto 15px auto;" />
            <p style="font-weight:bold; font-size:20px; text-align: center;color:white;">Kata sandi Anda telah berhasil diperbaharui.</p>
            <button onclick="showSettings()" style="margin-top:20px; padding:20px; background-color:#000080; color:white; border:none; border-radius:5px;Font-size:20px;width:500px;">
                Kembali ke Pengaturan
            </button>
        </div>
    </div>

     <!-- Halaman Privasi & Keamanan -->
    <div id="privacySection" style="display: none;" class="fade-in">
        <h3 style="color: white; margin-bottom: 30px;font-size:40;">
            <i class="fas fa-arrow-left" style="cursor:pointer; margin-right:10px;" onclick="showSettings()"></i> Privasi & Keamanan
        </h3>
        <div style="background-color: #00008070;  color: white; border-radius: 10px; padding: 20px; margin: 20px;">
            <p style="font-weight: bold; font-size: 30px;">Autentikasi Dua Faktor 
                <label class="switch" style="float:right;">
                    <input type="checkbox" id="twoFactorToggle" checked>
                    <span class="slider round"></span>
                </label>
            </p>
            <p style="margin-top: 10px; color: white;font-size:20px;">Tambahkan lapisan keamanan tambahan pada akun Anda.</p>
        </div>
        <button onclick="showSettings()" style="margin: 20px; padding: 20px; width: calc(100% - 40px); background-color: #0000cd; color: white; border: none; border-radius: 5px;font-size:20px">
            Kembali
        </button>
    </div>

     <!-- Halaman Konfirmasi Hapus Akun -->
    <div id="deleteAccountConfirm" style="display: none;" class="fade-in">
        <h2 style="text-align:center; color: #ADD8E6;">Konfirmasi Penghapusan Akun</h2>
        <div style="background-color: white; color: black; border-radius: 10px; padding: 20px; margin: 20px;">
            <p style="font-weight: bold;font-size:30px;">Apakah Anda yakin ingin menghapus akun Anda?</p>
            <p style="font-size: 20pxpx;">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan hilang secara permanen.</p>
            <div style="background-color: #ffe6e6; padding: 10px; border-radius: 5px; margin-top: 10px;">
                <strong style="color: red;">PERINGATAN:</strong>
                <ul style="padding-left: 20px;">
                    <li>Akun tidak dapat dipulihkan setelah dihapus.</li>
                    <li>Semua histori, preferensi, dan data Anda akan dihapus.</li>
                </ul>
            </div>
            <div style="margin-top: 20px; display: flex; justify-content: space-between;">
                <button onclick="showSettings()" style="padding: 20px; background-color: gray; color: white; border: none; border-radius: 5px;font-size:20px;">
                    Batalkan
                </button>
                <button onclick="confirmDeleteAccount()" style="padding: 20px; background-color: red; color: white; border: none; border-radius: 5px;font-size:20px;">
                    Ya, Hapus Akun
                </button>
            </div>
        </div>
    </div>

   <!-- Halaman Akun Berhasil Dihapus -->
    <div id="deleteSuccess" style="display: none;" class="fade-in">
        <h2 style="margin-top: 100px; text-align: center;">Akun Berhasil Dihapus</h2>
        <p style="margin: 20px 0; text-align: center;">
            Akun Anda telah dihapus secara permanen.<br>Terima kasih telah menggunakan layanan kami.
        </p>
        <div style="text-align: center;">
            <button onclick="goToHome()" style="background-color: white; color: #000080; padding: 10px 20px; border: none; border-radius: 5px;">
                Kembali ke Beranda
            </button>
        </div>
    </div>

    <!-- Navigasi Bawah -->
    <div class="nav">
        <i class="fas fa-home" title="Home" onclick="showDashboard()"></i>
        <i class="fas fa-bell" title="Notifikasi" onclick="showNotifications()"></i>
        <i class="fas fa-user" title="Profil" onclick="showProfile()"></i>
    </div>

    <script>
        let books = [];
        let currentBookId = null;

        // ✅ Ambil data buku dari API
        async function fetchBukuTersedia() {
            try {
                const res = await fetch('/api/buku-tersedia');
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const data = await res.json();
                books = data.map(b => ({
                    id: b.id,
                    title: b.judul || 'Tanpa Judul',
                    author: b.penulis || '-',
                    category: b.kategori || '-',
                    status: b.status_buku || 'tersedia',
                    publisher: b.penerbit || '-',
                    year: b.tahun_terbit || '-',
                    description: b.deskripsi || '',
                    image: b.foto ? `/storage/${b.foto}` : '{{ asset("icon-daftar-buku.png") }}'
                }));
                if (document.getElementById('bookListSection').style.display === 'block') {
                    displayBooks(books);
                }
            } catch (err) {
                console.error('[ERROR] Gagal load buku:', err);
                alert('Gagal memuat daftar buku. Coba refresh halaman.');
            }
        }

         // ✅ Ajukan buku ke API
        async function ajukanBuku() {
            const book = books.find(b => b.id === currentBookId);
            if (!book) {
                alert('Buku tidak ditemukan.');
                return;
            }
            try {
                const res = await fetch('/pengajuan', { // ✅ URL sudah benar
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // ✅ Token CSRF sudah ada
                    },
                    body: JSON.stringify({
                        buku_id: book.id,
                        jumlah: 1
                    })
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data.error || 'Gagal mengajukan buku');
                // ✅ Sukses → tampilkan notifikasi
                hideAllSections();
                document.getElementById('notificationSection').style.display = 'block';
                setTimeout(() => {
                    alert('✅ ' + (data.message || 'Permintaan buku berhasil diajukan!'));
                    location.reload(); // refresh untuk update status permintaan
                }, 1500);
            } catch (err) {
                console.error('[AJUKAN ERROR]:', err);
                alert('❌ Gagal mengajukan buku. Pastikan Anda login dan coba lagi.');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            
            // Ambil data dari server (via Auth::user()) sebagai sumber utama
    const serverName = "{{ Auth::user()->name }}";
    const serverEmail = "{{ Auth::user()->email }}";
    const serverAlamat = "{{ Auth::user()->alamat ?? '' }}";
    const serverTelepon = "{{ Auth::user()->telepon ?? '' }}";

    let userData = {
        namaLengkap: serverName,
        email: serverEmail,
        alamat: serverAlamat,
        telepon: serverTelepon,
        fotoProfil: "profile-placeholder.jpg" // Atau gunakan $user->foto jika ada
    };

    // Simpan ke localStorage (opsional, untuk performa)
    localStorage.setItem('userData', JSON.stringify(userData));

             // Update tampilan
    document.getElementById("userName").textContent = `Halo, ${userData.namaLengkap}!`;
    document.getElementById("profileName").textContent = userData.namaLengkap;
    document.getElementById("fotoProfilPreview").src = userData.fotoProfil;
    document.getElementById("fotoProfilEditPreview").src = userData.fotoProfil;
    document.getElementById("editNama").value = userData.namaLengkap;
    document.getElementById("editAlamat").value = userData.alamat;
    document.getElementById("editTelepon").value = userData.telepon;
    document.getElementById("currentEmail").value = userData.email;

            const emailNotif = localStorage.getItem('emailNotif') === 'true';
            document.getElementById('emailNotifCheckbox').checked = emailNotif;
            
            // ✅ Panggil setelah semua siap
            fetchBukuTersedia();
        });

        // === Fungsi navigasi dan tampilan ===
        function showDashboard() {
            hideAllSections();
            document.getElementById('dashboardSection').style.display = 'block';
        }

        function showBookList() {
            hideAllSections();
            document.getElementById('bookListSection').style.display = 'block';
            displayBooks(books);
        }

        function hideBookList() {
            hideAllSections();
            document.getElementById('dashboardSection').style.display = 'block';
        }

         function showBookDetail(bookId) {
            currentBookId = parseInt(bookId);
            const book = books.find(b => b.id === currentBookId);
            if (!book) {
                alert('Buku tidak ditemukan. Coba refresh halaman.');
                return;
            }
            const content = document.getElementById('bookDetailContent');
            content.innerHTML = `
                <tr><th colspan="2"><img src="${book.image}" alt="${book.title}" style="max-width:150px;"></th></tr>
                <tr><th>Judul</th><td>${book.title}</td></tr>
                <tr><th>Penulis</th><td>${book.author}</td></tr>
                <tr><th>Kategori</th><td>${book.category}</td></tr>
                <tr><th>Status</th><td>${ucfirst(book.status)}</td></tr>
                <tr><th>Penerbit</th><td>${book.publisher}</td></tr>
                <tr><th>Tahun</th><td>${book.year}</td></tr>
                <tr><th>Deskripsi</th><td>${book.description || '-'}</td></tr>
            `;
            hideAllSections();
            document.getElementById('bookDetailSection').style.display = 'block';
        }

        function hideBookDetail() {
            hideAllSections();
            document.getElementById('bookListSection').style.display = 'block';
        }

        function confirmAjukanBuku() {
            if (confirm("📌 Apakah Anda yakin ingin mengajukan buku ini?")) {
                ajukanBuku();
            }
        }

        function kembaliKeBeranda() {
            location.reload(); // biar status pengajuan terupdate
        }

         // ✅ Tampilkan daftar buku
        function displayBooks(list) {
            const tbody = document.getElementById('bookTableBody');
            const noResults = document.getElementById('noResults');
            tbody.innerHTML = '';
            if (!list || list.length === 0) {
                noResults.style.display = 'block';
                return;
            }
            noResults.style.display = 'none';
            list.forEach(b => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${b.id}</td>
                    <td>${b.title}</td>
                    <td>${b.category}</td>
                    <td>${ucfirst(b.status)}</td>
                    <td><button class="btn-daftar" style="padding:5px 10px;font-size:12px;" onclick="showBookDetail(${b.id})">Detail</button></td>
                `;
                tbody.appendChild(row);
            });
        }

        // ✅ Helper: capitalize
        function ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
        }

       
        // ✅ Helper: capitalize
        function ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
        }

        function filterBooks() {
            const input = document.getElementById('searchInput');
            const q = (input.value || '').toLowerCase().trim();

            // Kalau kosong → tampilkan semua buku lagi
            if (!q) {
                displayBooks(books);
                return;
            }

            // Kalau yang keisi itu email (ada @) → anggap tidak valid, tampilkan semua
            if (q.includes('@')) {
                displayBooks(books);
                return;
            }

            const filtered = books.filter(b =>
                b.title.toLowerCase().includes(q) ||
                b.category.toLowerCase().includes(q) ||
                b.author.toLowerCase().includes(q)
            );
            displayBooks(filtered);
        }

        function showNotifications() {
            hideAllSections();
            document.getElementById('notificationsSection').style.display = 'block';
            loadNotifications(); // 
        }

        function showProfile() {
            hideAllSections();
            document.getElementById('profileSection').style.display = 'block';
        }

        function showSettings() {
            hideAllSections();
            document.getElementById('settingsSection').style.display = 'block';
        }

        function showHelp() {
            hideAllSections();
            document.getElementById('helpSection').style.display = 'block';
        }

        function showTerms() {
            hideAllSections();
            document.getElementById('termsSection').style.display = 'block';
        }

        function previewFotoProfil(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('fotoProfilPreview');
                img.src = reader.result;
                
                // Simpan ke localStorage (simulasi)
                const userData = JSON.parse(localStorage.getItem('userData')) || {};
                userData.fotoProfil = reader.result;
                localStorage.setItem('userData', JSON.stringify(userData));
            };
            reader.readAsDataURL(input.files[0]);
        }
        function previewFotoProfil(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('fotoProfilPreview');
                img.src = reader.result;
                
                // Simpan ke localStorage (simulasi)
                const userData = JSON.parse(localStorage.getItem('userData')) || {};
                userData.fotoProfil = reader.result;
                localStorage.setItem('userData', JSON.stringify(userData));
            };
            reader.readAsDataURL(input.files[0]);
        }

        function previewFotoProfilEdit(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('fotoProfilEditPreview').src = reader.result;
                
                // Update juga di preview profil utama
                document.getElementById('fotoProfilPreview').src = reader.result;
                
                // Simpan ke localStorage (simulasi)
                const userData = JSON.parse(localStorage.getItem('userData')) || {};
                userData.fotoProfil = reader.result;
                localStorage.setItem('userData', JSON.stringify(userData));
            };
            reader.readAsDataURL(input.files[0]);
        }

        function showEditAccount() {
            hideAllSections();
            document.getElementById('editAccountSection').style.display = 'block';
        }

       function saveAccountChanges() {
    const nama = document.getElementById('editNama').value.trim();
    const alamat = document.getElementById('editAlamat').value.trim();
    const telepon = document.getElementById('editTelepon').value.trim();

    if (!nama) {
        alert("Nama lengkap wajib diisi.");
        return;
    }

    const formData = new FormData();
    formData.append('name', nama);
    formData.append('alamat', alamat);
    formData.append('telepon', telepon);

    // Jika ada file foto yang diupload
    const fileInput = document.getElementById('uploadFotoProfilEdit');
    if (fileInput.files.length > 0) {
        formData.append('foto', fileInput.files[0]);
    }

    fetch('/profile/update', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            // Jangan set Content-Type jika pakai FormData → biar browser set otomatis
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message || 'Profil berhasil diperbarui.');
            // Update tampilan nama di halaman utama
            document.getElementById("userName").textContent = `Halo, ${nama}!`;
            document.getElementById("profileName").textContent = nama;
            showSettings(); // kembali ke pengaturan
        } else {
            alert('Gagal memperbarui profil: ' + (data.message || 'Terjadi kesalahan.'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data.');
    });
}
        function showChangeEmail() {
            hideAllSections();
            document.getElementById('changeEmailSection').style.display = 'block';
        }

        function submitEmailChange() {
    const currentEmail = document.getElementById('currentEmail').value;
    const newEmail = document.getElementById('newEmail').value;
    if (!currentEmail || !newEmail) {
        alert("Harap isi semua field.");
        return;
    }

    fetch('/profile/change-email', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            current_email: currentEmail,
            new_email: newEmail
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Perbarui localStorage & tampilan
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.email = newEmail;
            localStorage.setItem('userData', JSON.stringify(userData));
            document.getElementById('currentEmail').value = newEmail;
            // Tampilkan sukses
            hideAllSections();
            document.getElementById('emailSuccessSection').style.display = 'block';
        } else {
            alert(data.message || 'Gagal mengubah email.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan. Cek koneksi dan coba lagi.');
    });
}
        function showChangePassword() {
            hideAllSections();
            document.getElementById('changePasswordSection').style.display = 'block';
        }

         function submitPasswordChange() {
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Validasi input
    if (!currentPassword || !newPassword || !confirmPassword) {
        alert("Harap isi semua kolom.");
        return;
    }

    if (newPassword !== confirmPassword) {
        alert("Kata sandi baru dan konfirmasi tidak cocok.");
        return;
    }

    if (newPassword.length < 6) {
        alert("Kata sandi baru minimal 6 karakter.");
        return;
    }

    // Kirim ke backend
    fetch('/profile/change-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            current_password: currentPassword,
            new_password: newPassword,
            new_password_confirmation: confirmPassword // opsional, tapi aman
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // ✅ Update localStorage hanya untuk tampilan (opsional)
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            // 🔐 Jangan simpan password dalam bentuk teks! Cukup bersihkan/abaikan.
            // userData.password = null; // jangan simpan
            localStorage.setItem('userData', JSON.stringify(userData));

            // Tampilkan sukses
            hideAllSections();
            document.getElementById('passwordSuccessSection').style.display = 'block';
            alert(data.message || 'Kata sandi berhasil diperbarui.');
        } else {
            alert(data.message || 'Gagal mengganti kata sandi.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        const msg = error.message || error.error || 'Terjadi kesalahan. Silakan coba lagi.';
        alert(`Gagal mengganti kata sandi: ${msg}`);
    });
}
        function showPrivacy() {
            hideAllSections();
            document.getElementById('privacySection').style.display = 'block';
        }

        function saveNotifPreference() {
    const checkbox = document.getElementById('emailNotifCheckbox');
    const isChecked = checkbox.checked;

    // Simpan ke localStorage
    localStorage.setItem('emailNotif', isChecked);

    // Kirim ke backend
    fetch('/api/update-email-notification', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
        },
        body: JSON.stringify({
            notif_email: isChecked
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Status notifikasi disimpan:", data);
        alert(isChecked ? "Notifikasi via email diaktifkan." : "Notifikasi via email dimatikan.");
    })
    .catch(error => {
        console.error("Gagal menyimpan status notifikasi:", error);
        alert("Gagal menyimpan preferensi notifikasi. Silakan coba lagi.");
    });
}

        function showDeleteAccountConfirm() {
            hideAllSections();
            document.getElementById('deleteAccountConfirm').style.display = 'block';
        }

        function confirmDeleteAccount() {
            // Simulasi penghapusan akun
            localStorage.removeItem('userData');
            
            hideAllSections();
            document.getElementById('deleteSuccess').style.display = 'block';
        }

        function goToHome() {
            // Redirect ke halaman login (simulasi)
            window.location.href = '/login';
        }

        function confirmLogout() {
            if (confirm("Apakah Anda yakin ingin logout?")) {
                // Redirect ke halaman login (simulasi)
                window.location.href = '/login';
            }
        }

                function hideAllSections() {
            const sections = [
                'dashboardSection', 'bookListSection', 'bookDetailSection', 
                'notificationSection', 'profileSection', 'notificationsSection',
                'settingsSection', 'helpSection', 'termsSection', 'editAccountSection',
                'changeEmailSection', 'emailSuccessSection', 'changePasswordSection',
                'passwordSuccessSection', 'privacySection', 'deleteAccountConfirm',
                'deleteSuccess'
            ].forEach(id => document.getElementById(id).style.display = 'none');
        }

        // parsing yang lebih aman
function parseServerDateToUTC(dateStr) {
    if (!dateStr) return new Date();

    if (/[Tt].*\d{2}:\d{2}:\d{2}/.test(dateStr) || dateStr.endsWith('Z') || /[+\-]\d{2}:\d{2}$/.test(dateStr)) {
        return new Date(dateStr);
    }

    const justDateTime = dateStr.replace(' ', 'T');
    return new Date(justDateTime + 'Z');
}

function formatTimeFromServer(dateTimeStr) {
    const d = parseServerDateToUTC(dateTimeStr);

    return d.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    }) + ' • ' +
    d.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
        timeZone: 'Asia/Jakarta'
    }) + ' WIB';
}


        
        // === LOAD NOTIFICATION DARI SERVER ===
        async function loadNotifications() {
            try {
                const res = await fetch('/api/notifikasi');
                const data = await res.json();

                const container = document.getElementById('notifContainer');
                container.innerHTML = '';

                if (!data || data.length === 0) {
                    container.innerHTML = `
                        <p style="text-align:center; color:#ccc;">Tidak ada notifikasi</p>
                    `;
                    return;
                }

                data.forEach(n => {
                    const card = document.createElement('div');
                    card.classList.add('notif-item');

                    card.innerHTML = `
                        <div class="notif-icon">🔔</div>
                        <div class="notif-content">
                            <p class="notif-text">${n.pesan}</p>
                            <span class="notif-time">${timeAgo(n.created_at)}</span>
                        </div>
                    `;

                    container.appendChild(card);
                });

            } catch (err) {
                console.error('Gagal memuat notifikasi:', err);
            }
        }

    </script>
</body>
</html>
