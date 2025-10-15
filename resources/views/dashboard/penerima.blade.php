<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penerima</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #000080;
            color: white;
        }

        .container {
            padding: 20px;
            text-align: center;
        }

        .logo {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 10px;
            font-weight: normal;
        }

        .card-book {
            background-color: #191970;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            max-width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .card-book img {
            width: 100px;
            margin-bottom: 10px;
        }

        .btn-daftar {
            display: inline-block;
            margin-top: 10px;
            background-color: #0000cd;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .status-box, .book-box, .book-detail, .notification-section {
            background-color: #191970;
            padding: 15px;
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
            padding: 10px;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
            border: none;
        }

        .btn-kembali, .btn-ajukan {
            background-color: #ff4500;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            margin-right: 10px;
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
            background-color: #000080;
            color: white;
            min-height: 100vh;
            padding: 30px 20px;
            text-align: center;
        }

        #profileSection .title {
            color: #ADD8E6;
            margin-bottom: 20px;
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
            padding: 5px;
        }

        .profile-menu {
            margin-top: 30px;
            text-align: left;
        }

        .profile-menu div {
            background-color: #0000b3;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            color: white;
            cursor: pointer;
        }

        .profile-menu div i {
            margin-right: 10px;
        }

        /* Notifikasi */
        #notificationsSection {
            display: none;
            background-color: #000080;
            color: white;
            padding: 30px 15px;
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

        /* Pengaturan */
        #settingsSection {
            display: none;
            background-color: #000080;
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
        <h2 id="userName">Halo, Pengguna</h2>

        <div class="card-book" id="cardBook">
            <img src="icon-daftar-buku.png" alt="Icon Daftar Buku">
            <div><strong>Daftar Buku</strong></div>
            <a href="#daftar-buku" class="btn-daftar" onclick="showBookList()">Daftar Buku</a>
        </div>

        <h3>Status Permintaan</h3>
        <div class="status-box" id="statusSection">
            <table>
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggapan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="requestStatus">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daftar Buku -->
    <div id="bookListSection" style="display: none;" class="container fade-in">
        <h3>Daftar Buku</h3>
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari ..." oninput="filterBooks()">
        </div>
        <div class="book-box">
            <table>
                <thead>
                    <tr>
                        <th>ID Buku</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Status Buku</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="bookTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
            <div id="noResults" class="no-results" style="display: none;">Buku tidak ditemukan.</div>
        </div>
        <button class="btn-kembali" onclick="hideBookList()">Kembali</button>
    </div>

    <!-- Detail Buku -->
    <div id="bookDetailSection" class="container fade-in" style="display: none;">
        <div class="book-detail">
            <h3>Detail Buku</h3>
            <div class="book-detail-content">
                <table>
                    <tbody id="bookDetailContent">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            <button class="btn-ajukan" onclick="confirmAjukanBuku()">Ajukan Buku</button>
            <button class="btn-kembali" onclick="hideBookDetail()">Kembali</button>
        </div>
    </div>

    <!-- Notifikasi Pengajuan -->
    <div id="notificationSection" style="display: none;" class="container fade-in">
        <div class="notification-section">
            <h2>Ajukan Permintaan Buku</h2>
            <div>
                <img src="img-notifikasi.png" alt="Permintaan Diajukan" style="width: 120px; margin: 20px 0;">
            </div>
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
        <p style="margin-top: 10px; font-weight: bold;" id="profileName">Nama Lengkap</p>

        <div class="profile-menu">
            <div onclick="showSettings()"><i class="fas fa-cog"></i> Pengaturan</div>
            <div onclick="showHelp()"><i class="fas fa-question-circle"></i> Bantuan</div>
            <div onclick="showTerms()"><i class="fas fa-file-alt"></i> Syarat & Ketentuan</div>
            <div onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</div>
        </div>
    </div>

    <!-- Notifikasi -->
    <div id="notificationsSection" class="fade-in">
        <img src="bell-icon.png" alt="Notifikasi" class="notification-icon" />
        <h2>Notifikasi</h2>
        <div id="notifContainer">
            <!-- Data akan diisi oleh JavaScript -->
        </div>
    </div>

    <!-- Pengaturan Akun -->
    <div id="settingsSection" class="fade-in">
        <h2 style="background-color:#0000b3; color:white; padding:10px; border-radius: 5px; text-align:center;">
            <i class="fas fa-cog"></i> Pengaturan Akun
        </h2>
        <div style="margin:20px 0;">
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showEditAccount()">
                Edit Akun <span style="float:right;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showChangeEmail()">
                Ubah Email <span style="float:right;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showChangePassword()">
                Ganti Kata Sandi <span style="float:right;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showPrivacy()">
                Privasi & Keamanan <span style="float:right;">›</span>
            </div>
        </div>
        <div style="margin: 10px 0; display: flex; align-items: center; justify-content: space-between;">
            <span>Kirim notifikasi via email</span>
            <label class="switch">
                <input type="checkbox" id="emailNotifCheckbox">
                <span class="slider round"></span>
            </label>
        </div>
        <button onclick="showDeleteAccountConfirm()" style="width:100%; background-color: darkred; color:white; padding:10px; border:none; border-radius:5px; font-weight:bold; margin-top: 20px;">
            Hapus Akun
        </button>
        <br><br>
        <button onclick="showProfile()" style="width:100%; background-color: #0000b3; color:white; padding:10px; border:none; border-radius:5px;">
            Kembali
        </button>
    </div>

    <!-- Bantuan -->
    <div id="helpSection" style="display: none;" class="fade-in">
        <h2 style="text-align:center;"><i class="fas fa-question-circle"></i> Bantuan</h2>
        <div style="background:white; color:#000; border-radius:10px; padding:15px; margin:20px;">
            <strong>Cara mengubah foto profil?</strong>
            <p>Anda dapat mengubah foto profil pada halaman utama profil.</p>
        </div>
        <div style="background:white; color:#000; border-radius:10px; padding:15px; margin:20px;">
            <strong>Tidak dapat mengakses akun</strong>
            <p>Coba atur ulang kata sandi atau hubungi kami untuk bantuan.</p>
        </div>
        <div style="background:white; color:#000; border-radius:10px; padding:15px; margin:20px;">
            <strong>Ketentuan pengguna</strong>
            <p>Baca syarat & ketentuan untuk informasi mengenai aturan.</p>
        </div>
        <div style="background:white; color:#000; border-radius:10px; padding:15px; margin:20px;">
            <strong>Butuh bantuan lainnya?</strong>
            <p>Hubungi kami di: <a href="mailto:donasibuku.app@gmail.com">donationbook7@gmail.com</a></p>
        </div>
        <button onclick="showProfile()" style="margin: 20px; padding: 10px 20px; background-color: #0000b3; color: white; border: none; border-radius: 5px;">
            Kembali
        </button>
    </div>

    <!-- Syarat & Ketentuan -->
    <div id="termsSection" style="display: none;" class="fade-in">
        <h2 style="color: #ADD8E6; text-align: center;">Syarat & Ketentuan Penerima</h2>
        <div style="background: white; color: #000080; padding: 20px; border-radius: 10px; margin: 20px; text-align: left;">
            <ol>
                <li>Data penerima harus benar dan dapat diverifikasi.</li>
                <li>Donasi hanya untuk keperluan yang sesuai dengan tujuan permohonan.</li>
                <li>Tidak diperbolehkan menyalahgunakan donasi untuk hal di luar kebutuhan.</li>
                <li>Penerima wajib melaporkan jika ada perubahan data atau kebutuhan.</li>
                <li>Dengan mendaftar, Anda setuju pada ketentuan ini.</li>
            </ol>
            <button onclick="showProfile()" style="margin-top: 20px; padding: 10px 20px; background-color: #0000b3; color: white; border: none; border-radius: 5px;">
                Kembali
            </button>
        </div>
    </div>

    <!-- Halaman Edit Akun -->
    <div id="editAccountSection" style="display: none;" class="fade-in">
        <h2 style="color: lightgray; text-align: center;">Edit Akun</h2>
        <div style="margin: 20px auto; text-align: center;">
            <div class="profile-pic-wrapper" onclick="document.getElementById('uploadFotoProfilEdit').click()">
                <img id="fotoProfilEditPreview" src="profile-placeholder.jpg" style="width: 100px; height: 100px; border-radius: 50%; background-color: white;" />
                <i class="fas fa-camera"></i>
                <input type="file" id="uploadFotoProfilEdit" accept="image/*" style="display:none;" onchange="previewFotoProfilEdit(event)" />
            </div>
        </div>
        <div style="max-width: 300px; margin: auto; text-align: left; padding: 20px;">
            <label><i class="fas fa-check-circle" style="color: lime;"></i> Nama Lengkap</label>
            <input type="text" id="editNama" placeholder="Nama Lengkap" style="width: 100%; margin-bottom: 10px; padding: 8px; border-radius: 5px; border: none;" />

            <label><i class="fas fa-check-circle" style="color: lime;"></i> Alamat</label>
            <input type="text" id="editAlamat" placeholder="Alamat" style="width: 100%; margin-bottom: 10px; padding: 8px; border-radius: 5px; border: none;" />

            <label><i class="fas fa-check-circle" style="color: lime;"></i> No. Telepon</label>
            <input type="text" id="editTelepon" placeholder="Nomor Telepon" style="width: 100%; margin-bottom: 20px; padding: 8px; border-radius: 5px; border: none;" />
        </div>
        <div style="text-align: center;">
            <button style="background-color: #0000cd; color: white; padding: 10px 20px; border: none; border-radius: 8px;" onclick="saveAccountChanges()">
                Simpan
            </button>
            <br><br>
            <button onclick="showSettings()" style="color: white; background: none; border: none; text-decoration: underline;">
                Kembali
            </button>
        </div>
    </div>

    <!-- Halaman Ubah Email -->
    <div id="changeEmailSection" style="display: none;" class="fade-in">
        <h2 style="text-align: center; color: white;">Ubah Email</h2>
        <div style="background-color: white; color: black; border-radius: 10px; padding: 20px; margin: 20px; text-align: center;">
            <img src="https://img.icons8.com/ios-filled/100/000000/new-post.png" style="width:80px; margin-bottom: 20px;" />
            <p style="font-weight: bold; font-size: 18px;">Ubah Email</p>
            <input type="email" placeholder="Email Saat ini" id="currentEmail" style="width:100%; margin-bottom:10px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <input type="email" placeholder="Email Baru" id="newEmail" style="width:100%; margin-bottom:20px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <button onclick="submitEmailChange()" style="width:100%; padding:10px; background-color:#000080; color:white; border:none; border-radius:5px;">
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
            <p>Email Anda telah berhasil diperbaharui</p>
            <button onclick="showSettings()" style="margin-top:20px; padding:10px 20px; background-color:#000080; color:white; border:none; border-radius:5px;">
                OK
            </button>
        </div>
    </div>

    <!-- Halaman Ganti Kata Sandi -->
    <div id="changePasswordSection" style="display: none;" class="fade-in">
        <h2 style="text-align: center; color: white;">Ganti Kata Sandi</h2>
        <div style="background-color: white; color: black; border-radius: 10px; padding: 20px; margin: 20px; text-align: center;">
            <img src="https://img.icons8.com/ios-filled/100/000000/lock-2.png" style="width:80px; margin-bottom: 20px;" />
            <p style="font-weight: bold; font-size: 18px;">Ganti Kata Sandi</p>
            <input type="password" placeholder="Kata sandi saat ini" id="currentPassword" style="width:100%; margin-bottom:10px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <input type="password" placeholder="Kata sandi baru" id="newPassword" style="width:100%; margin-bottom:10px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <input type="password" placeholder="Konfirmasi kata sandi" id="confirmPassword" style="width:100%; margin-bottom:20px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <button onclick="submitPasswordChange()" style="width:100%; padding:10px; background-color:#000080; color:white; border:none; border-radius:5px;">
                Simpan
            </button>
        </div>
    </div>

    <!-- Halaman Konfirmasi Kata Sandi Berhasil -->
    <div id="passwordSuccessSection" style="display: none;" class="fade-in">
        <h2 style="color:white; text-align: center;">Kata Sandi Berhasil Diubah</h2>
        <div style="background-color:white; color:black; border-radius:10px; padding:30px; margin: 20px;">
            <img src="https://img.icons8.com/ios-filled/100/26e07f/checkmark--v1.png" style="width:80px; margin-bottom:15px;" />
            <p style="font-weight:bold; font-size:18px; color:#000080;">Kata sandi Anda telah berhasil diperbaharui.</p>
            <button onclick="showSettings()" style="margin-top:20px; padding:10px 20px; background-color:#000080; color:white; border:none; border-radius:5px;">
                Kembali ke Pengaturan
            </button>
        </div>
    </div>

    <!-- Halaman Privasi & Keamanan -->
    <div id="privacySection" style="display: none;" class="fade-in">
        <h3 style="color: white; margin-bottom: 30px;">
            <i class="fas fa-arrow-left" style="cursor:pointer; margin-right:10px;" onclick="showSettings()"></i> Privasi & Keamanan
        </h3>
        <div style="background-color: white; color: #000080; border-radius: 10px; padding: 20px; margin: 20px;">
            <p style="font-weight: bold; font-size: 18px;">Autentikasi Dua Faktor 
                <label class="switch" style="float:right;">
                    <input type="checkbox" id="twoFactorToggle" checked>
                    <span class="slider round"></span>
                </label>
            </p>
            <p style="margin-top: 10px; color: black;">Tambahkan lapisan keamanan tambahan pada akun Anda.</p>
        </div>
        <button onclick="showSettings()" style="margin: 20px; padding: 10px; width: calc(100% - 40px); background-color: #0000cd; color: white; border: none; border-radius: 5px;">
            Kembali
        </button>
    </div>

    <!-- Halaman Konfirmasi Hapus Akun -->
    <div id="deleteAccountConfirm" style="display: none;" class="fade-in">
        <h2 style="text-align:center; color: #ADD8E6;">Konfirmasi Penghapusan Akun</h2>
        <div style="background-color: white; color: black; border-radius: 10px; padding: 20px; margin: 20px;">
            <p style="font-weight: bold;">Apakah Anda yakin ingin menghapus akun Anda?</p>
            <p style="font-size: 14px;">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan hilang secara permanen.</p>
            <div style="background-color: #ffe6e6; padding: 10px; border-radius: 5px; margin-top: 10px;">
                <strong style="color: red;">PERINGATAN:</strong>
                <ul style="padding-left: 20px;">
                    <li>Akun tidak dapat dipulihkan setelah dihapus.</li>
                    <li>Semua histori, preferensi, dan data Anda akan dihapus.</li>
                </ul>
            </div>
            <div style="margin-top: 20px; display: flex; justify-content: space-between;">
                <button onclick="showSettings()" style="padding: 10px 20px; background-color: gray; color: white; border: none; border-radius: 5px;">
                    Batalkan
                </button>
                <button onclick="confirmDeleteAccount()" style="padding: 10px 20px; background-color: red; color: white; border: none; border-radius: 5px;">
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
        // Data dummy untuk simulasi
        const books = [
            { 
                id: "B001", 
                title: "Pemrograman JavaScript Modern", 
                author: "Erik Wright", 
                category: "Teknologi", 
                status: "Tersedia", 
                publisher: "Penerbit Informatika", 
                year: 2022, 
                image: "https://via.placeholder.com/150",
                description: "Buku ini membahas konsep-konsep modern JavaScript dan penggunaannya dalam pengembangan web."
            },
            { 
                id: "B002", 
                title: "Belajar HTML & CSS", 
                author: "Sarah Johnson", 
                category: "Teknologi", 
                status: "Tersedia", 
                publisher: "Penerbit Digital", 
                year: 2021, 
                image: "https://via.placeholder.com/150",
                description: "Panduan lengkap untuk pemula dalam mempelajari HTML dan CSS dasar hingga menengah."
            },
            { 
                id: "B003", 
                title: "Pengantar Data Science", 
                author: "Michael Chen", 
                category: "Sains", 
                status: "Dipinjam", 
                publisher: "Penerbit Sains", 
                year: 2020, 
                image: "https://via.placeholder.com/150",
                description: "Pengenalan konsep data science untuk pemula dengan contoh-contoh praktis."
            }
        ];

        const requestStatus = [
            { title: "Pemrograman JavaScript Modern", response: "Silakan ambil buku di perpustakaan", status: "Disetujui" },
            { title: "Belajar HTML & CSS", response: "Menunggu konfirmasi", status: "Proses" },
            { title: "Pengantar Data Science", response: "Buku sedang dipinjam", status: "Ditolak" }
        ];

        const notifications = [
            { title: "Permintaan buku disetujui", message: "Permintaan Anda untuk buku 'Pemrograman JavaScript Modern' telah disetujui", time: "2 jam yang lalu" },
            { title: "Buku baru tersedia", message: "Buku 'Machine Learning untuk Pemula' sekarang tersedia", time: "1 hari yang lalu" },
            { title: "Pengingat", message: "Jangan lupa untuk mengambil buku yang sudah disetujui", time: "3 hari yang lalu" }
        ];

        // Inisialisasi halaman
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data user dari localStorage
            const userData = JSON.parse(localStorage.getItem('userData')) || {
                namaLengkap: "Pengguna",
                email: "user@example.com",
                alamat: "",
                telepon: "",
                fotoProfil: "profile-placeholder.jpg"
            };

            // Tampilkan data user
            document.getElementById("userName").textContent = `Halo, ${userData.namaLengkap}!`;
            document.getElementById("profileName").textContent = userData.namaLengkap;
            document.getElementById("fotoProfilPreview").src = userData.fotoProfil;
            document.getElementById("fotoProfilEditPreview").src = userData.fotoProfil;
            document.getElementById("editNama").value = userData.namaLengkap;
            document.getElementById("editAlamat").value = userData.alamat;
            document.getElementById("editTelepon").value = userData.telepon;
            document.getElementById("currentEmail").value = userData.email;

            // Isi status permintaan
            const requestStatusTable = document.getElementById("requestStatus");
            requestStatus.forEach(request => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${request.title}</td>
                    <td>${request.response}</td>
                    <td>${request.status}</td>
                `;
                requestStatusTable.appendChild(row);
            });

            // Isi notifikasi
            const notifContainer = document.getElementById("notifContainer");
            notifications.forEach(notif => {
                const notifCard = document.createElement("div");
                notifCard.className = "notif-card";
                notifCard.innerHTML = `
                    <strong>${notif.title}</strong>
                    <p>${notif.message}</p>
                    <small>${notif.date} (${notif.time})</small>
                `;
                notifContainer.appendChild(notifCard);
            });

            // Load preferensi notifikasi email
            const emailNotif = localStorage.getItem('emailNotif') === 'true';
            document.getElementById('emailNotifCheckbox').checked = emailNotif;
        });

        // Fungsi untuk navigasi
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
            hideAllSections();
            const book = books.find(b => b.id === bookId);
            
            if (book) {
                const detailContent = document.getElementById("bookDetailContent");
                detailContent.innerHTML = `
                    <tr>
                        <th colspan="2"><img src="${book.image}" alt="${book.title}" style="max-width:150px;"></th>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td>${book.title}</td>
                    </tr>
                    <tr>
                        <th>Penulis</th>
                        <td>${book.author}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>${book.category}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>${book.status}</td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>${book.publisher}</td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>${book.year}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>${book.description}</td>
                    </tr>
                `;
                document.getElementById('bookDetailSection').style.display = 'block';
            }
        }

        function hideBookDetail() {
            hideAllSections();
            document.getElementById('bookListSection').style.display = 'block';
        }

        function confirmAjukanBuku() {
            if (confirm("Apakah Anda yakin ingin mengajukan buku ini?")) {
                ajukanBuku();
            }
        }

        function ajukanBuku() {
            hideAllSections();
            document.getElementById('notificationSection').style.display = 'block';
            
            // Simpan status permintaan (dummy)
            setTimeout(() => {
                alert("Permintaan buku berhasil diajukan!");
                showDashboard();
            }, 2000);
        }

        function kembaliKeBeranda() {
            hideAllSections();
            document.getElementById('dashboardSection').style.display = 'block';
        }

        function displayBooks(booksToDisplay) {
            const tbody = document.getElementById("bookTableBody");
            tbody.innerHTML = "";
            const noResults = document.getElementById("noResults");
            
            if (booksToDisplay.length === 0) {
                noResults.style.display = "block";
            } else {
                noResults.style.display = "none";
                booksToDisplay.forEach(book => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${book.id}</td>
                        <td>${book.title}</td>
                        <td>${book.author}</td>
                        <td>${book.category}</td>
                        <td>${book.status}</td>
                        <td>${book.publisher}</td>
                        <td>${book.year}</td>
                        <td><button onclick="showBookDetail('${book.id}')" style="padding: 5px 10px; background-color: #0000cd; color: white; border: none; border-radius: 3px;">Detail</button></td>
                    `;
                    tbody.appendChild(row);
                });
            }
        }

        function filterBooks() {
            const searchInput = document.getElementById("searchInput").value.toLowerCase();
            const filteredBooks = books.filter(book => 
                book.title.toLowerCase().includes(searchInput) || 
                book.author.toLowerCase().includes(searchInput) ||
                book.category.toLowerCase().includes(searchInput)
            );
            displayBooks(filteredBooks);
        }

        function showNotifications() {
            hideAllSections();
            document.getElementById('notificationsSection').style.display = 'block';
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
            const nama = document.getElementById('editNama').value;
            const alamat = document.getElementById('editAlamat').value;
            const telepon = document.getElementById('editTelepon').value;
            
            // Simpan ke localStorage (simulasi)
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.namaLengkap = nama;
            userData.alamat = alamat;
            userData.telepon = telepon;
            localStorage.setItem('userData', JSON.stringify(userData));
            
            // Update tampilan
            document.getElementById("userName").textContent = `Halo, ${nama}!`;
            document.getElementById("profileName").textContent = nama;
            
            alert("Perubahan berhasil disimpan!");
            showSettings();
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

            // Simpan ke localStorage (simulasi)
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.email = newEmail;
            localStorage.setItem('userData', JSON.stringify(userData));
            
            hideAllSections();
            document.getElementById('emailSuccessSection').style.display = 'block';
        }

        function showChangePassword() {
            hideAllSections();
            document.getElementById('changePasswordSection').style.display = 'block';
        }

        function submitPasswordChange() {
            const current = document.getElementById('currentPassword').value;
            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;

            if (!current || !newPass || !confirmPass) {
                alert("Harap isi semua kolom.");
                return;
            }

            if (newPass !== confirmPass) {
                alert("Kata sandi baru dan konfirmasi tidak cocok.");
                return;
            }

            // Simpan ke localStorage (simulasi)
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.password = newPass; // Note: Dalam aplikasi nyata, password harus di-hash
            localStorage.setItem('userData', JSON.stringify(userData));
            
            hideAllSections();
            document.getElementById('passwordSuccessSection').style.display = 'block';
        }

        function showPrivacy() {
            hideAllSections();
            document.getElementById('privacySection').style.display = 'block';
        }

        function saveNotifPreference() {
            const isChecked = document.getElementById('emailNotifCheckbox').checked;
            localStorage.setItem('emailNotif', isChecked);
            
            // Kirim ke backend (AJAX)
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
            })
            .catch(error => {
                console.error("Gagal menyimpan status notifikasi:", error);
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
            ];
            
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
        }
    </script>
</body>
</html>