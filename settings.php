<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Showroom Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #007AFF;
            --secondary: #4A90E2;
            --success: #00FF00;
            --warning: #FFD700;
            --danger: #FF6B6B;
            --light: #F8F9FA;
            --dark: #212529;
            --sidebar-width: 250px;
        }

        body {
            background-color: #f5f5f5;
            color: var(--dark);
            overflow-x: hidden;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles (reused from dashboard) */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #e0e0e0;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
        }

        .logo {
            font-size: 28px;
            color: var(--primary);
            margin-right: 10px;
        }

        .sidebar-nav {
            padding: 20px 0;
            flex-grow: 1;
        }

        .nav-item {
            position: relative;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: 
                background-color 0.25s ease,
                color 0.25s ease,
                padding-left 0.25s ease;
        }

        .nav-item:hover {
            background: #f0f0f0;
            padding-left: 26px;
        }

        /* garis kiri animasi */
        .nav-item::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: var(--primary);
            transition: width 0.25s ease;
        }

        .nav-item:hover::before,
        .nav-item.active::before {
            width: 4px;
        }

        .sidebar .nav-item {
            color: #000;
        }

        .sidebar .nav-item {
            text-decoration: none;
        }

        .nav-item:hover {
            background: #f0f0f0;
            border-left: 3px solid var(--primary);
        }

        .nav-item.active {
            background: #e6f0ff;
            border-left: 3px solid var(--primary);
            color: var(--primary);
            font-weight: 600;
        }

        .nav-icon {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 25px;
            background: #f8f9fa;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .welcome {
            max-width: 600px;
        }

        .welcome h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome p {
            font-size: 16px;
            color: #555;
        }

        /* Settings Grid Layout */
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        @media (max-width: 992px) {
            .settings-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Settings Card */
        .settings-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 25px;
            margin-bottom: 20px;
        }

        .settings-card h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
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
            background: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background: #9B51E0;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        /* Custom Checkboxes */
        .custom-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .custom-checkbox input {
            display: none;
        }

        .checkmark {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: #e9f0ff;
            border: 2px solid #4A90E2;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
            position: relative;
        }

        .custom-checkbox input:checked + .checkmark {
            background: #4A90E2;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked + .checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 7px;
            top: 3px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Save Button */
        .save-btn {
            background: #000;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
            margin-top: 15px;
        }

        .save-btn:hover {
            background: #333;
        }

        /* Car Sketch */
        .car-sketch {
            position: relative;
            height: 200px;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .car-sketch svg {
            max-width: 100%;
            max-height: 100%;
            fill: none;
            stroke: #333;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar-header, .nav-item span, .sidebar-footer {
                display: none;
            }
            
            .nav-icon {
                margin-right: 0;
                font-size: 18px;
            }
            
            .main-content {
                margin-left: 70px;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="asset/home.png" alt="Logo" width="60" height="60">
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="nav-item">
                    <span class="nav-icon"><i class="fas fa-bookmark"></i></span>
                    <span>Dashboard</span>
                </a>
                <a href="posisi.php" class="nav-item">
                    <span class="nav-icon"><i class="fas fa-file"></i></span>
                    <span>Posisi</span>
                </a>
                <a href="index.php" class="nav-item">
                    <span class="nav-icon"><i class="fas fa-clock"></i></span>
                    <span>Jadwal Interview</span>
                </a>
                <a href="datapelamar.php" class="nav-item">
                    <span class="nav-icon"><i class="fas fa-database"></i></span>
                    <span>Data Pelamar</span>
                </a>
            </nav>
            
            <div class="sidebar-footer-nav">
                <a href="settings.php" class="nav-item active">
                    <span class="nav-icon"><i class="fas fa-cog"></i></span>
                    <span>Settings</span>
                </a>
                <a href="logout.php" class="nav-item">
                    <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span>Sign Out</span>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <div class="header">
                <div class="welcome">
                    <h1>Welcome, Jos Jis</h1>
                    <p>Showroom Mobil masa kini !!</p>
                </div>
            </div>

            <div class="settings-grid">
                <div class="settings-card">
                    <h2>Ubah Kata Sandi</h2>
                    <div class="form-group">
                        <label for="current-password">Password Saat ini</label>
                        <input type="password" id="current-password" class="form-control" placeholder="Masukkan password saat ini">
                    </div>
                    <div class="form-group">
                        <label for="new-password">Password Baru</label>
                        <input type="password" id="new-password" class="form-control" placeholder="Masukkan password baru">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Tulis Ulang Password Baru</label>
                        <input type="password" id="confirm-password" class="form-control" placeholder="Ulangi password baru">
                    </div>
                    <div class="form-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Logout dari perangkat lain. Pilih ini jika orang lain menggunakan akun Anda
                        </label>
                    </div>
                    <button class="save-btn">Simpan Perubahan</button>
                </div>

                <div class="settings-card">
                    <h2>Tampilan Dashboard</h2>
                    <div class="form-group">
                        <label for="theme-toggle">Tema</label>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Tampilan grafik diberanda
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Save otomatis
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Artikan grafik
                        </label>
                    </div>
                </div>

                <div class="settings-card">
                    <h2>Notifikasi</h2>
                    <div class="form-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Notifikasi pelamar baru
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Notifikasi interview
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            Notifikasi sistem
                        </label>
                    </div>
                </div>

                <div class="settings-card">
                    <h2>Pengaturan Halaman</h2>
                    <div class="form-group">
                        <label for="page-select">Pilih Halaman</label>
                        <select id="page-select" class="form-control">
                            <option value="dashboard">Dashboard</option>
                            <option value="interview">Jadwal Interview</option>
                            <option value="data">Data Pelamar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="element-select">Elemen diubah</label>
                        <select id="element-select" class="form-control">
                            <option value="line">Grafik Line</option>
                            <option value="bar">Grafik Bar</option>
                            <option value="pie">Grafik Pie</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <ul style="padding-left: 20px; margin-bottom: 10px;">
                            <li style="margin-bottom: 8px;">Teks
                                <input type="text" class="form-control" value="Januari-Juni" style="margin-top: 5px;">
                            </li>
                            <li style="margin-bottom: 8px;">Warna
                                <select class="form-control" style="margin-top: 5px;">
                                    <option value="blue" selected>Biru</option>
                                    <option value="red">Merah</option>
                                    <option value="green">Hijau</option>
                                </select>
                            </li>
                            <li style="margin-bottom: 8px;">Data Sumber
                                <select class="form-control" style="margin-top: 5px;">
                                    <option value="total" selected>Total Pelamar</option>
                                    <option value="interview">Interview</option>
                                    <option value="position">Posisi</option>
                                </select>
                            </li>
                            <li>Keterangan
                                <input type="text" class="form-control" style="margin-top: 5px;">
                            </li>
                        </ul>
                    </div>
                    <button class="save-btn">Simpan Perubahan</button>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.save-btn').forEach(button => {
            button.addEventListener('click', function() {
                alert('Perubahan disimpan!');
            });
        });

        document.querySelector('.save-btn').addEventListener('click', function() {
            const currentPass = document.getElementById('current-password').value;
            const newPass = document.getElementById('new-password').value;
            const confirmPass = document.getElementById('confirm-password').value;
            
            if (!currentPass || !newPass || !confirmPass) {
                alert('Harap lengkapi semua field password');
                return;
            }
            
            if (newPass !== confirmPass) {
                alert('Password baru tidak cocok');
                return;
            }
            
            if (newPass.length < 8) {
                alert('Password harus minimal 8 karakter');
                return;
            }
            
            alert('Password berhasil diubah!');
        });

        document.querySelectorAll('.toggle-switch input').forEach(toggle => {
            toggle.addEventListener('change', function() {
                if (this.checked) {
                    alert('Tema terang sedang masa pengembangan');
                } else {
                    alert('Tema gelap sedang masa pengembangan');
                }
            });
        });

    </script>
</body>
</html>