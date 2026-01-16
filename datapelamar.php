<?php
session_start();
include "koneksi.php";
$query = mysqli_query($conn, "SELECT * FROM pelamar");

if(!$query){
    die(mysqli_error($conn));
}

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Showroom Mobil</title>
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

        /* Sidebar Styles */
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
             cursor: pointer;
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

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 25px;
            background: #f8f9fa;
        }

        .header h1{font-size:28px}
        .header p{color:#555;margin-top:4px}
        .hr{height:1px;background:#e5e5e5;margin:20px 0}

        .page-header {
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0; /* GARIS HEADER */
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

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stats-card {
            background: #4A90E2;
            color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .stats-card h3 {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 8px;
        }

        .stats-card p {
            font-size: 24px;
            font-weight: 700;
        }

        /* Table Styles */
        
        td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }

        /* Row gradients */
        .row-1 {
            background: linear-gradient(90deg, #50E3C2 0%, #4A90E2 100%);
            color: white;
        }

        .row-2 {
            background: linear-gradient(90deg, #F5A623 0%, #4A90E2 100%);
            color: white;
        }

        .row-3 {
            background: linear-gradient(90deg, #4A90E2 0%, #3B5998 100%);
            color: white;
        }

        .row-4 {
            background: linear-gradient(90deg, #007AFF 0%, #0056b3 100%);
            color: white;
        }

        /* Notification Bar */
        .notification-bar {
            display: flex;
            align-items: center;
            background: #e6f7ff;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 30px;
            border: 1px solid #4A90E2;
        }

        .notification-icon {
            background: #4A90E2;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
        }

        .notification-content {
            flex-grow: 1;
        }

        .notification-content p {
            font-weight: 500;
        }

        .notification-btn {
            background: #000;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .notification-btn:hover {
            background: #333;
        }

        .top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:10px;
        }
        .search-box{position:relative}
        .search-box i{
            position:absolute;
            left:14px;
            top:50%;
            transform:translateY(-50%);
            color:#666;
        }
        .search{
            width:260px;
            padding:12px 18px 12px 40px;
            border-radius:30px;
            border:1px solid #ccc;
        }
        /* Action Buttons */
        .actions button{
            border:none;
            cursor:pointer;
            margin-left:6px;
            display:inline-flex;
            align-items:center;
            gap:8px;
        }
        .add{
            background:#1e88ff;
            color:#fff;
            padding:12px 20px;
            border-radius:30px;
        }
        .icon{
            background:#eaf2ff;
            padding:10px 14px;
            border-radius:10px;
        }

        /* DATA TITLE */
        .data-title{font-size:24px;margin-top:10px}
        .sort{font-size:13px;color:#555;margin-bottom:10px}
        .sort span{color:#1e88ff}

        /* TABLE */
        .table-box{
            border:1px solid #999;
            border-radius:10px;
            overflow:hidden;
        }
        table{
            width:100%;
            border-collapse:collapse;
        }
        thead{
            background:#3db3ff;
            color:#fff;
        }
        th,td{
            padding:14px 12px;
            border-bottom:1px solid #333;
            font-size:14px;
            vertical-align:top;
        }
        
        .show{
            text-align:center;
            padding:12px;
        }
        .backup{
            color:#1e88ff;
            margin-top:10px;
            display:inline-block;
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
                <a href="datapelamar.php" class="nav-item active">
                    <span class="nav-icon"><i class="fas fa-database"></i></span>
                    <span>Data Pelamar</span>
                </a>
            </nav>
            
            <div class="sidebar-footer-nav">
                <a href="settings.php" class="nav-item">
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

<div class="hr"></div>

<div class="top">
<div class="search-box">
<i class="fa-solid fa-magnifying-glass"></i>
<input class="search" id="searchInput" placeholder="Search here...">
</div>

<div class="actions">
<a href="tambah_pelamar.php"><button class="add"><i class="fa-solid fa-plus"></i>Add New Card</button></a>
<button class="icon"><i class="fa-solid fa-print"></i></button>
<button class="icon"><i class="fa-solid fa-share"></i></button>
</div>
</div>

<div class="data-title">Data</div>
<div class="sort">Sort by <span>Recently <i class="fa-solid fa-chevron-down"></i></span></div>

<div class="table-box">
<table border="1" width="100%">
<tr>
    <th>Nama</th>
    <th>Pendidikan</th>
    <th>Posisi</th>
    <th>Pengalaman Kerja</th>
    <th>CV</th>
    <th>Tanggal Melamar</th>
    <th>Status Akhir</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['pendidikan'] ?></td>
    <td><?= $row['posisi'] ?></td>
    <td><?= $row['pengalaman_kerja'] ?></td>
    <td>
        <?php if($row['cv']) { ?>
            <a href="cv/<?= $row['cv'] ?>" target="_blank">Lihat CV</a>
        <?php } else { echo "-"; } ?>
    </td>
    <td><?= $row['tanggal_melamar'] ?></td>
    <td><?= $row['status_akhir'] ?></td>
</tr>
<?php } ?>
</table>


<div class="show">Show All Data <i class="fa-solid fa-chevron-down"></i></div>
</div>

<a class="backup">Backup data pelamar</a>

</main>
</div>
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(keyword) ? '' : 'none';
    });
});
</script>

</body>
</html>