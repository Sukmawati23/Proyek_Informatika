<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Donatur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 25px;
        }
        
        .container {
            font-size: 25px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 20px;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 200px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        button {
            padding: 20px;
            background-color: #000080;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        .donation-history {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            font-size: 25px;
        }
        .status-title {
            font-weight: bold;
            margin-top: 20px;
            font-size: 30px;
        }
        .nav {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            background-color: #000080;
            padding: 20px;
            border-radius: 0px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .nav i {
            font-size: 24px;
            cursor: pointer;
            color: white;
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
            font-size: 20px;
        }
        .success-message img {
            max-width: 50px;
            display: block;
            margin: 0 auto 10px;
        }

        /* Profil */
        #profileSection {
            display: none;
            background-color: #00002c;
            color: white;
            min-height: 100vh;
            padding: 30px 20px;
            text-align: center;
        }
        #profileSection .title {
            color: #ADD8E6;
            margin-bottom: 20px;
            font-size: 30px;
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
            background-color: #00008070; 
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            color: white;
            cursor: pointer;
        }
        .profile-menu div i {
            margin-right: 10px;
        }
        .logout-link {
            text-decoration: none;
        }

        /* Notifikasi */
        #notificationSection {
            display: none;
            background-color: #00002c;
            color: white;
            padding: 30px 15px;
            height: 100vh;
        }
        #notificationSection h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 40px;
        }
        .notif-card {
            background-color: #00008070;
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 5000px;
            font-family: Arial, sans-serif;
            font-size: 25px;
        }
        .notif-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notif-footer small {
            font-size: 12px;
            color: #ddd;
        }
        .notif-card small {
            color: #ccc;
        }
        .notification-icon {
            display: block;
            margin: 0 auto 10px;
            width: 100px;
        }

       .chat-link {
            color: #ffffff;            
            font-weight: bold;
            background: none;          
            padding: 0;               
            border-radius: 0;         
            font-size: 13px;
            cursor: pointer;
        }

        .chat-link:hover {
            text-decoration: underline; 
            opacity: 0.8;              
        }

        /* Pengaturan */
        #settingsSection {
            display: none;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
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

        .slider.round {
        border-radius: 24px;
        }

    </style>
</head>
<body>
    <div class="container">
        <img src="LOGO-SDB.png" alt="Logo" class="logo">
        <h1 style="font-size: 30px">Dashboard Donatur</h1>
        <p id="welcomeText">Selamat datang!</p>
        
        {{-- Pesan sukses --}}
        @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 10px; transition: 0.5s;">
            {{ session('success') }}
        </div>
        @endif


        {{-- Pesan error validasi --}}
        @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Donasi -->
        <form id="donationForm" action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <label for="judul_buku">Judul Buku</label>
            <input style="padding: 15px;font-size:15px;"type="text" id="judul_buku" name="judul_buku" placeholder="Masukkan judul buku" required>

            <label for="kategori">Kategori</label>
            <select style="padding: 15px;font-size:15px;"id="kategori" name="kategori" required>
            <option  value="">Pilih Kategori</option>
            <option value="fiksi">Fiksi</option>
            <option value="non-fiksi">Non-Fiksi</option>
            <option value="anak-anak">Anak-anak</option>
            <option value="misteri">Misteri</option>
            <option value="fantasi">Fantasi</option>
            <option value="biografi">Biografi</option>
            <option value="sejarah">Sejarah</option>
            <option value="sains">Sains</option>
            <option value="pengembangan-diri">Pengembangan Diri</option>
            <option value="buku-masak">Buku Masak</option>
            <option value="perjalanan">Perjalanan</option>
            <option value="puisi">Puisi</option>
            <option value="novel-grafis">Novel Grafis</option>
        </select>

        <label for="kondisi">Kondisi Buku</label>
        <input style="padding: 15px;font-size:15px;"type="text" id="kondisi" name="kondisi" placeholder="Masukkan kondisi buku" required>

        <!-- Tambahkan ini setelah field "Kondisi Buku" -->
        <label for="penulis">Penulis</label>
        <input style="padding: 15px;font-size:15px;"type="text" id="penulis" name="penulis" placeholder="Masukkan nama penulis" required>

        <label for="penerbit">Penerbit</label>
        <input style="padding: 15px;font-size:15px;"type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" required>

        <label for="foto">Pilih Foto</label>
        <input style="padding: 15px;font-size:15px;"type="file" id="foto" name="foto" accept="image/*">

        <label for="deskripsi">Deskripsi (Opsional)</label>
        <textarea style="padding: 15px;font-size:15px;"id="deskripsi" name="deskripsi" placeholder="Tambahkan deskripsi jika ada..."></textarea>
        
        <label for="jumlah">Jumlah Buku</label>
        <input style="padding: 15px;font-size:15px;"type="number" id="jumlah" name="jumlah" value="1" min="1" required>

        <button type="submit">Donasikan Buku</button>
    </form>


        <div class="success-message" id="successMessage">
            <img src="checkmark.png" alt="Checkmark">
            <h2>Donasi Berhasil</h2>
            <p>Terima kasih telah mendonasikan buku!</p>
            <button onclick="addAnotherDonation()">Tambah Donasi Lagi</button>
        </div>

        <div class="donation-history">
            <h2>Riwayat Donasi</h2>
            <div class="status-title">Riwayat Donasi Anda:</div>
            <ul>
                @forelse($donasis as $donasi)
    <li>
        <strong>{{ $donasi->judul_buku }}</strong> — 
        <em>{{ ucfirst($donasi->status) }}</em>
        <small>({{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y') }})</small>
        <br><span style="font-size:0.85em; color:#666;">Penulis: {{ $donasi->penulis ?? '-' }}</span>
        <br><span style="font-size:0.85em; color:#666;">Penerbit: {{ $donasi->penerbit ?? '-' }}</span>

        {{-- Cek apakah ada pengajuan yang disetujui --}}
        @php
            $pengajuan = $pengajuanMap[$donasi->id] ?? null;
        @endphp

        @if($pengajuan)
            <br><span style="font-size:0.85em; color:green;">✅ Buku telah diajukan oleh: {{ $pengajuan->user->name ?? 'Penerima' }}</span>
            
            @php
                $ulasan = $ulasanMap[$donasi->id] ?? null;
            @endphp

            @if($ulasan)
                <br><span style="font-size:0.85em; color:#FFD700;">⭐ {{ $ulasan->rating }}/5 — "{{ $ulasan->comment ?? 'Tanpa komentar' }}"</span>
            @else
                <br>
                <a href="{{ route('ulasan.form', $pengajuan->id) }}" class="btn btn-warning btn-sm" style="font-size:0.8em; padding:2px 6px; margin-top:4px;">
                    Beri Ulasan ke Penerima
                </a>
            @endif
        @else
            <br><span style="font-size:0.85em; color:#aaa;">belum diajukan penerima</span>
        @endif
    </li>
@empty
    <li>Belum ada donasi.</li>
@endforelse
            </ul>
            <div class="status-title">Status Pengiriman:</div>
            @php
                $waitingCount = $donasis->where('status', 'menunggu')->count();
                $receivedCount = $donasis->where('status', 'diterima')->count();
            @endphp
            <p>Menunggu: {{ $waitingCount }} buku</p>
            <p>Diterima: {{ $receivedCount }} buku</p>
        </div>

        <!-- Profil -->
        <div id="profileSection">
            <p class="title">Profil Donatur</p>
            <div class="profile-pic-wrapper" onclick="document.getElementById('uploadFotoProfil').click()">
                <img id="fotoProfilPreview" src="profile-placeholder.jpg" />
                <i class="fas fa-camera"></i>
                <input type="file" id="uploadFotoProfil" accept="image/*" style="display:none;" onchange="previewFotoProfil(event)" />
            </div>
            <p style="margin-top: 10px; font-weight: bold;">Nama Lengkap</p>

            <div class="profile-menu">
                <div onclick="showSettings()"><i class="fas fa-cog"></i> Pengaturan</div>
            <div onclick="showHelp()"><i class="fas fa-question-circle"></i> Bantuan</div>

                <div onclick="showTerms()"><i class="fas fa-file-alt"></i> Syarat & Ketentuan</div>
                <!-- Ubah bagian Logout di HTML -->
                <div onclick="confirmLogout()" 
    style="display: flex; align-items: center; gap: 10px; padding: 20px; cursor: pointer; color: white; font-size: 25px; text-decoration: none;">
    <i class="fas fa-sign-out-alt"></i> Logout
</div>
            </div>
        </div>

        <!-- Notifikasi -->
<div id="notificationSection" style="display:none;">
    <img src="bell-icon.png" alt="Notifikasi" class="notification-icon" />
    <h2>Notifikasi</h2>
    <div id="notifContainer">
        @forelse($notifications as $notif)
<div class="notif-box">
    <strong>• {{ $notif->pesan }}</strong>
    <div>{{ $notif->created_at->format('d M Y, H:i') }}</div>
    @if($notif->chatRoom)
        <div style="text-align:right; margin-top:-25px;">
            <a href="{{ route('chat.show', $notif->chatRoom) }}" class="chat-link">Masuk Chat</a>
        </div>
    @endif
</div>
        @empty
            <p style="text-align: center; margin-top: 20px;">Tidak ada notifikasi baru.</p>
        @endforelse
    </div>
</div>


        <!-- Pengaturan Akun -->
        <div id="settingsSection">
            <h2 style="background-color:#000080; color:white; padding:10px; border-radius: 5px; text-align:center;">
                <i class="fas fa-cog"></i> Pengaturan Akun
            </h2>
            <div style="margin:20px 0;">
                <div style="padding:10px; border-bottom:1px solid #ddd; cursor:pointer;" onclick="showEditAccount()">Edit Akun <span style="float:right;">›</span></div>
                <div style="padding:10px; border-bottom:1px solid #ddd; cursor:pointer;" onclick="showChangeEmail()">Ubah Email <span style="float:right;">›</span></div>

                <div style="padding:10px; border-bottom:1px solid #ddd; cursor:pointer;" onclick="showChangePassword()">Ganti Kata Sandi <span style="float:right;">›</span></div>

                <div style="padding:10px; border-bottom:1px solid #ddd; cursor:pointer;" onclick="showPrivacy()">Privasi & Keamanan <span style="float:right;">›</span></div>

            </div>
            <div style="margin: 10px 0; display: flex; align-items: center; justify-content: space-between;">
                <span>Kirim notifikasi via email</span>
                <input type="checkbox" id="emailNotifCheckbox" onchange="saveNotifPreference()" />

            </div>
            <button onclick="showDeleteAccountConfirm()" style="width:100%; background-color: darkred; color:white; padding:20px; border:none; border-radius:5px; font-weight:bold;font-size:20px;">
    Hapus Akun
</button>

            <br><br>
            <button onclick="showProfile()" style="width:100%; background-color: #000080; color:white; padding:20px; border:none; border-radius:5px;font-size:20px;">
                Kembali
            </button>
        </div>

        <!-- Bantuan -->
        <div id="helpSection" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px;">
            <h2 style="text-align:center;font-size:40px;"><i class="fas fa-question-circle"></i> Bantuan</h2>
            <div style="background:#00008070; color:white; border-radius:10px; padding:15px; margin-top:20px;">
                <strong>Cara mengubah foto profil?</strong>
                <p>Anda dapat mengubah foto profil pada halaman utama profil.</p>
            </div>
            <div style="background:#00008070; color:white; border-radius:10px; padding:20px; margin-top:15px;">
                <strong>Tidak dapat mengakses akun</strong>
                <p>Coba atur ulang kata sandi atau hubungi kami untuk bantuan.</p>
            </div>
            <div style="background:#00008070; color:white; border-radius:10px; padding:25px; margin-top:15px;">
                <strong>Ketentuan pengguna</strong>
                <p>Baca syarat & ketentuan untuk informasi mengenai aturan.</p>
            </div>
            <div style="background:#00008070; color:white; border-radius:10px; padding:25px; margin-top:15px;">
                <strong>Butuh bantuan lainnya?</strong>
                <p>Hubungi kami di: <a href="mailto:donasibuku.app@gmail.com">donationbook7@gmail.com</a></p>
            </div>
        </div>
        
        <!-- Syarat & Ketentuan -->
        <div id="termsSection" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px; text-align: center;">
            <h2 style="color: #ADD8E6;">Syarat & Ketentuan Donatur</h2>
            <div style="background: #00008070; color: white; padding: 20px; border-radius: 10px; text-align: left;">
                <ol>
                    <li>Data yang Anda isi harus benar dan lengkap.</li>
                    <li>Data Anda aman dan tidak akan dibagikan tanpa izin.</li>
                    <li>Donasi yang diberikan tidak bisa diminta kembali.</li>
                    <li>Donasi akan digunakan sesuai tujuan program.</li>
                    <li>Dengan mendaftar, Anda setuju pada ketentuan ini.</li>
                </ol>
                <button onclick="showProfile()" style="margin-top: 20px; padding: 20px; background-color: #000080; color: white; border: none; border-radius: 5px;font-size:20px;width:1600px;">Kembali</button>
            </div>
        </div>

        <!-- Halaman Edit Akun -->
<div id="editAccountSection" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px; text-align: center;">
    <h2 style="color: lightgray;">Edit Akun</h2>
    <div style="margin: 20px auto;">
        <div class="profile-pic-wrapper" onclick="document.getElementById('uploadFotoProfilEdit').click()">
            <img id="fotoProfilEditPreview" src="profile-placeholder.jpg" style="width: 150px; height: 150px; border-radius: 50%; background-color: white;" />
            <i class="fas fa-camera"></i>
            <input type="file" id="uploadFotoProfilEdit" accept="image/*" style="display:none;" onchange="previewFotoProfilEdit(event)" />
        </div>
    </div>
    <div style="max-width: 800px; margin: auto; text-align: left;">
        <label><i class="fas fa-check-circle" style="color: lime;"></i> Nama Lengkap</label>
        <!-- Tambahkan id="editNama" -->
        <input type="text" id="editNama" placeholder="Nama Lengkap" style="width: 100%; margin-bottom: 10px; padding: 20px; border-radius: 5px; border: none;font-size:20px;" />
        <label><i class="fas fa-check-circle" style="color: lime;"></i> Alamat</label>
        <!-- Tambahkan id="editAlamat" -->
        <input type="text" id="editAlamat" placeholder="Alamat" style="width: 100%; margin-bottom: 10px; padding: 20px; border-radius: 5px; border: none;font-size:20px;" />
        <label><i class="fas fa-check-circle" style="color: lime;"></i> No. Telepon</label>
        <!-- Tambahkan id="editTelepon" -->
        <input type="text" id="editTelepon" placeholder="Nomor Telepon" style="width: 100%; margin-bottom: 20px; padding: 20px; border-radius: 5px; border: none;font-size:20px;" />
    </div>
    <button style="background-color: #0000cd; color: white; padding:20px; border: none; border-radius: 8px;font-size:20px;width:500px;" onclick="saveAccountChanges()">Simpan</button>
    <br><br>
    <button onclick="showSettings()" style="color: white; background: none; border: none; text-decoration: underline;font-size:20px;">Kembali</button>
</div>

<!-- Halaman Ubah Email -->
<div id="changeEmailSection" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px;">
    <h2 style="text-align: center; color: white;">Ubah Email</h2>
    <div style="background-color: #00008070; color: white; border-radius: 10px; padding: 20px; text-align: center;">
        <img src="https://img.icons8.com/ios-filled/100/ffffff/new-post.png" style="width:100px; margin-bottom: 20px;" />
        
        <input type="email" placeholder="Email Saat ini" id="currentEmail" style="width:97%; margin-bottom:20px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
        <input type="email" placeholder="Email Baru" id="newEmail" style="width:97%; margin-bottom:20px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
        <button onclick="submitEmailChange()" style="width:100%; padding:20px; background-color:#000080; color:white; border:none; border-radius:5px;font-size:20px;">PERBAHARUI EMAIL</button>
    </div>
</div>

<!-- Halaman Konfirmasi Email Berhasil -->
<div id="emailSuccessSection" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px; text-align: center;">
        <div style="background-color:white; color:black; border-radius:10px; padding:30px;">
        <img src="https://img.icons8.com/ios-filled/100/26e07f/checkmark--v1.png" style="width:80px; margin-bottom:15px;" />
        <p style="font-weight:bold; font-size:30px; color:#000080;">Email berhasil diperbaharui</p>
        <p>Email Anda telah berhasil diperbaharui, Silakan Verifikasi di Email Anda!</p>
        <button onclick="showSettings()" style="margin-top:20px; padding:20px; background-color:#000080; color:white; border:none; border-radius:5px;width:500px;">OK</button>
    </div>
</div>

<!-- Halaman Ganti Kata Sandi -->
<div id="changePasswordSection" style="display: none; background-color: #00002C; color: white; min-height: 100vh; padding: 30px 20px;">
    <h2 style="text-align: center; color: white;">Ganti Kata Sandi</h2>
    <div style="background-color: #00008070; color: WHITE; border-radius: 10px; padding: 20px; text-align: center;">
        <img src="https://img.icons8.com/ios-filled/100/ffffff/lock-2.png" style="width:100px; margin-bottom: 20px;" />
        
        <input type="password" placeholder="Kata sandi saat ini" id="currentPassword" style="width:97%; margin-bottom:10px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
        <input type="password" placeholder="Kata sandi baru" id="newPassword" style="width:97%; margin-bottom:10px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
        <input type="password" placeholder="Konfirmasi kata sandi" id="confirmPassword" style="width:97%; margin-bottom:20px; padding:20px; border-radius:5px; border:1px solid #ccc;font-size:20px;" required>
        <button onclick="submitPasswordChange()" style="width:100%; padding:20px; background-color:#000080; color:white; border:none; border-radius:5px;font-size:20px;">Simpan</button>
    </div>
</div>

<!-- Halaman Konfirmasi Kata Sandi Berhasil -->
<div id="passwordSuccessSection" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px; text-align: center;">
   
    <div style="background-color:#00008070; color:white; border-radius:10px; padding:30px;">
        <img src="https://img.icons8.com/ios-filled/100/26e07f/checkmark--v1.png" style="width:100px; margin-bottom:15px;" />
        <p style="font-weight:bold; font-size:28px; color:white;">Kata sandi Anda telah berhasil diperbaharui.</p>
        <button onclick="showSettings()" style="margin-top:20px; padding:20px; background-color:#000080; color:white; border:none; border-radius:5px;font-size:20px;width:500px;">Kembali ke Pengaturan</button>
    </div>
</div>

<!-- Halaman Privasi & Keamanan -->
<div id="privacySection" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px;">
    <h3 style="color: white; margin-bottom: 30px;">
        <i class="fas fa-arrow-left" style="cursor:pointer; margin-right:10px;font-size:30px;" onclick="showSettings()"></i> Privasi & Keamanan
    </h3>
    <div style="background-color: white; color: #000080; border-radius: 10px; padding: 20px;">
        <p style="font-weight: bold; font-size: 25px;">Autentikasi Dua Faktor 
            <label class="switch" style="float:right;">
                <input type="checkbox" id="twoFactorToggle" checked>
                <span class="slider round"></span>
            </label>
        </p>
        <p style="margin-top: 10px; color: #000080;">Tambahkan lapisan keamanan tambahan pada akun Anda.</p>
    </div>
    <button onclick="showSettings()" style="margin-top: 30px; padding: 20px; width: 100%; background-color: #000080; color: white; border: none; border-radius: 5px;font-size:20px;">
        Kembali
    </button>
</div>

<!-- Halaman Konfirmasi Hapus Akun -->
<div id="deleteAccountConfirm" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px;">
   
    <div style="background-color: white; color: black; border-radius: 10px; padding: 20px; margin-top: 20px;">
        <p style="font-weight: bold;">Apakah Anda yakin ingin menghapus akun Anda?</p>
        <p style="font-size: 20px;">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan hilang secara permanen.</p>
        <div style="background-color: #ffe6e6; padding: 10px; border-radius: 5px; margin-top: 10px;">
            <strong style="color: red;">PERINGATAN:</strong>
            <ul style="padding-left: 20px;font-size:18px;">
                <li>Akun tidak dapat dipulihkan setelah dihapus.</li>
                <li>Semua histori, preferensi, dan data Anda akan dihapus.</li>
            </ul>
        </div>
        <div style="margin-top: 20px; display: flex; justify-content: space-between;">
            <button onclick="showSettings()" style="padding: 20px; background-color: gray; color: white; border: none; border-radius: 5px;font-size:20px;">Batalkan</button>
            <button onclick="confirmDeleteAccount()" style="padding: 20px; background-color: red; color: white; border: none; border-radius: 5px;font-size:20px;">Ya, Hapus Akun</button>
        </div>
    </div>
</div>

<!-- Halaman Akun Berhasil Dihapus -->
<div id="deleteSuccess" style="display: none; background-color: #00002c; color: white; min-height: 100vh; padding: 30px 20px; text-align: center;">
    <h2 style="margin-top: 100px;font-size:30px;">Akun Berhasil Dihapus!</h2>
    <p style="margin: 20px 0;font-size:20px;">Akun Anda telah dihapus secara permanen.<br>Terima kasih telah menggunakan layanan kami.</p>
    <button onclick="goToHome()" style="background-color: white; color: #000080; padding: 20px; border: none; border-radius: 5px;width:500px;font-size:20px;">Kembali ke Beranda</button>
</div>




<!-- Navigasi Bawah -->
        <div class="nav">
            <i class="fas fa-home" title="Home" onclick="showDashboard()"></i>
            <i class="fas fa-bell" title="Notifikasi" onclick="showNotifications()"></i>
            <i class="fas fa-user" title="Profil" onclick="showProfile()"></i>
        </div>


    </div>

    <script>
        let donations = [];

        // Ambil nama dari localStorage
const namaDonatur = localStorage.getItem("namaLengkap");

// Jika ada nama, tampilkan di dashboard
if (namaDonatur) {
    document.getElementById("welcomeText").textContent = `Selamat datang, ${namaDonatur}!`;
}

        /*document.getElementById('donationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const bookTitle = document.getElementById('bookTitle').value;
            const timestamp = new Date().toLocaleString();
            donations.push({ title: bookTitle, time: timestamp, status: 'Diterima' });
            document.getElementById('successMessage').style.display = 'block';
            this.reset();
            addNotification(bookTitle, timestamp);
            updateDonationHistory();
        });*/

    function addNotification(title, time, chatLink) {
    const notifContainer = document.getElementById('notifContainer');
    const notifCard = document.createElement('div');
    notifCard.className = 'notif-card';
    notifCard.innerHTML = `
        <p>• Buku ‘${title}’ sudah diterima.</p>
        <div class="notif-footer">
            <small>${time}</small>
            <a href="/chat/{{ $notif->chat_room_id ?? '#' }}" class="chat-link">Masuk Chat</a>
        </div>
    `;
    notifContainer.appendChild(notifCard);
}

        function updateDonationHistory() {
            const receivedBooks = document.getElementById('receivedBooks');
            const processingBooks = document.getElementById('processingBooks');
            const shippedBooks = document.getElementById('shippedBooks');
            const waitingCount = document.getElementById('waitingCount');
            const receivedCount = document.getElementById('receivedCount');

            receivedBooks.innerHTML = donations.filter(d => d.status === 'Diterima').map(d => d.title).join(', ');
            processingBooks.innerHTML = donations.filter(d => d.status === 'Dalam Proses').map(d => d.title).join(', ');
            shippedBooks.innerHTML = donations.filter(d => d.status === 'Dikirim').map(d => d.title).join(', ');

            waitingCount.innerText = donations.filter(d => d.status === 'Dalam Proses').length;
            receivedCount.innerText = donations.filter(d => d.status === 'Diterima').length;
        }

        function addAnotherDonation() {
            document.getElementById('successMessage').style.display = 'none';
        }

        function showDashboard() {
            document.getElementById('donationForm').style.display = 'flex';
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('notificationSection').style.display = 'none';
            document.getElementById('profileSection').style.display = 'none';
            document.getElementById('settingsSection').style.display = 'none';
            document.querySelector('.donation-history').style.display = 'block';
        }

        function showNotifications() {
            document.getElementById('donationForm').style.display = 'none';
            document.getElementById('notificationSection').style.display = 'block';
            document.getElementById('profileSection').style.display = 'none';
            document.getElementById('settingsSection').style.display = 'none';
            document.querySelector('.donation-history').style.display = 'none';
        }

        function showProfile() {
            document.getElementById('donationForm').style.display = 'none';
            document.getElementById('notificationSection').style.display = 'none';
            document.getElementById('profileSection').style.display = 'block';
            document.getElementById('settingsSection').style.display = 'none';
            document.querySelector('.donation-history').style.display = 'none';
        }

        function showSettings() {
             hideAllSections();
            document.getElementById('settingsSection').style.display = 'block';
            // Pastikan tidak ada elemen lain yang tertinggal
            document.getElementById('editAccountSection').style.display = 'none';
            document.getElementById('changeEmailSection').style.display = 'none';
            document.getElementById('emailSuccessSection').style.display = 'none';
            document.getElementById('changePasswordSection').style.display = 'none';
            document.getElementById('passwordSuccessSection').style.display = 'none';
            document.getElementById('privacySection').style.display = 'none';
            document.getElementById('deleteAccountConfirm').style.display = 'none';
            document.getElementById('deleteSuccess').style.display = 'none';
        }

        function previewFotoProfil(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('fotoProfilPreview').src = reader.result;
            };
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        function showHelp() {
            document.getElementById('donationForm').style.display = 'none';
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('notificationSection').style.display = 'none';
            document.getElementById('profileSection').style.display = 'none';
            document.getElementById('settingsSection').style.display = 'none';
            document.getElementById('helpSection').style.display = 'block';
            document.querySelector('.donation-history').style.display = 'none';
        }
        
        function showTerms() {
            document.getElementById('donationForm').style.display = 'none';
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('notificationSection').style.display = 'none';
            document.getElementById('profileSection').style.display = 'none';
            document.getElementById('settingsSection').style.display = 'none';
            document.getElementById('helpSection').style.display = 'none';
            document.getElementById('termsSection').style.display = 'block';
            document.querySelector('.donation-history').style.display = 'none';
        }
        // Tambahkan fungsi konfirmasi logout di JavaScript
        function confirmLogout() {
            const confirmation = confirm("Apakah Anda yakin ingin logout?");
            if (confirmation) {// Logika untuk logout, misalnya menghapus session atau redirect
            alert("Anda telah logout.");
            // Contoh: window.location.href = 'login.html'; // Ganti dengan URL login Anda
            window.location.href = '/login'; // Ganti dengan URL login Anda
            }
        }

        function previewFotoProfilEdit(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('fotoProfilEditPreview').src = reader.result;
    };
    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}


// === Fungsi untuk menampilkan halaman Edit Akun ===
function showEditAccount() {
    hideAllSections(); // Pastikan semua section disembunyikan
    document.getElementById('editAccountSection').style.display = 'block';

    // Ambil data pengguna dari server
    fetch('/profile/get', { // Menambahkan route baru
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const user = data.user;
            // Isi form dengan data pengguna
            document.getElementById('editNama').value = user.name || '';
            document.getElementById('editAlamat').value = user.alamat || '';
            document.getElementById('editTelepon').value = user.telepon || '';
            // Update preview foto profil jika ada
            if (user.foto_profil) {
                document.getElementById('fotoProfilEditPreview').src = user.foto_profil;
                document.getElementById('fotoProfilPreview').src = user.foto_profil; // Juga update di profil utama
            }
        } else {
            alert('Gagal memuat data profil. Silakan coba lagi.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memuat data profil.');
    });
}


function saveAccountChanges() {
    // Ambil nilai dari input field
    const nama = document.getElementById('editNama').value;
    const alamat = document.getElementById('editAlamat').value;
    const telepon = document.getElementById('editTelepon').value;

    // Validasi input sederhana
    if (!nama.trim()) {
        alert("Nama lengkap wajib diisi.");
        return;
    }

    // Kirim data ke server
    fetch('/profile/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            name: nama,
            alamat: alamat,
            telepon: telepon
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Perbarui tampilan
            document.getElementById("userName").textContent = `Halo, ${nama}!`;
            document.getElementById("profileName").textContent = nama;
            // Perbarui localStorage jika digunakan untuk tampilan
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.namaLengkap = nama;
            userData.alamat = alamat;
            userData.telepon = telepon;
            localStorage.setItem('userData', JSON.stringify(userData));
            // Tampilkan pesan sukses dan kembali ke pengaturan
            alert(data.message || 'Profil berhasil diperbarui!');
            showSettings(); // Kembali ke halaman pengaturan
        } else {
            alert(data.message || 'Gagal memperbarui profil.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Berhasil memperbarui profil.');
    });
}
function showChangeEmail() {
    hideAllSections();
    document.getElementById('changeEmailSection').style.display = 'block';

    // Ambil data user dari localStorage atau dari server (jika ada)
    const userData = JSON.parse(localStorage.getItem('userData')) || {};
    const currentEmail = userData.email || "{{ Auth::user()->email }}";

    // Isi field "Email Saat ini" dengan email yang sedang digunakan
    document.getElementById('currentEmail').value = currentEmail;

    // Kosongkan field "Email Baru" agar pengguna bisa mengisinya
    document.getElementById('newEmail').value = '';
}

function submitEmailChange() {
    const currentEmail = document.getElementById('currentEmail').value;
    const newEmail = document.getElementById('newEmail').value;
    if (!currentEmail || !newEmail) {
        alert("Harap isi semua field.");
        return;
    }
    fetch('/profile/change-email', { // Pastikan URL ini benar
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
            // ✅ PERBAIKAN UTAMA: Perbarui localStorage dengan email baru
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.email = newEmail; // Simpan email baru ke localStorage
            localStorage.setItem('userData', JSON.stringify(userData));

            // ✅ Perbarui juga tampilan input "Email Saat ini" agar sesuai
            document.getElementById('currentEmail').value = newEmail;

            // Tampilkan pesan sukses
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

    // Simulasi validasi berhasil
    document.getElementById('changePasswordSection').style.display = 'none';
    document.getElementById('passwordSuccessSection').style.display = 'block';
}

function showPrivacy() {
    hideAllSections();
    document.getElementById('privacySection').style.display = 'block';
}

// Simpan status checkbox ke localStorage
function saveNotifPreference() {
    const checkbox = document.getElementById('emailNotifCheckbox');
    localStorage.setItem('notifEmail', checkbox.checked);

    if (checkbox.checked) {
        alert("Notifikasi via email diaktifkan.");
    } else {
        alert("Notifikasi via email dimatikan.");
    }

     // Kirim ke backend (AJAX)
    fetch('/api/update-email-notification', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // Tambahkan token jika pakai Laravel Sanctum atau CSRF
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


// Muat status saat halaman dimuat
window.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.getElementById('emailNotifCheckbox');
    const saved = localStorage.getItem('notifEmail');
    if (saved !== null) {
        checkbox.checked = saved === 'true';
    }
});

function showDeleteAccountConfirm() {
    hideAllSections();
    document.getElementById('deleteAccountConfirm').style.display = 'block';
}

function confirmDeleteAccount() {
    // Simulasikan penghapusan akun
    console.log("Akun telah dihapus");
    hideAllSections();
    document.getElementById('deleteSuccess').style.display = 'block';
    localStorage.clear(); // Jika pakai localStorage untuk menyimpan user
}

function goToHome() {
    window.location.href = '/'; // Ganti sesuai rute halaman utama
}

function hideAllSections() {
    const sections = ['donationForm', 'successMessage', 'notificationSection', 'profileSection', 'settingsSection', 'editAccountSection', 'helpSection', 'termsSection', 'deleteAccountConfirm', 'deleteSuccess'];
    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    });
} 
        </script>  
    </body>
</html>