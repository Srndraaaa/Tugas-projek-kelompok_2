<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jadwal Interview</title>
</head>
<body>

<h2>Tambah Jadwal Interview</h2>

<form action="insert_jadwal.php" method="POST">
    <label>Nama Pelamar</label><br>
    <input type="text" name="nama_pelamar" required><br><br>

    <label>Posisi</label><br>
    <input type="text" name="posisi" required><br><br>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" required><br><br>

    <label>Waktu</label><br>
    <input type="time" name="waktu" required><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="BELUM HADIR">BELUM HADIR</option>
        <option value="DIJADWALKAN">DIJADWALKAN</option>
        <option value="SELESAI">SELESAI</option>
        <option value="DIBATALKAN">DIBATALKAN</option>
    </select><br><br>

    <label>Link Interview</label><br>
    <input type="text" name="link"><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
