<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelamar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }
        .container {
            width: 500px;
            margin: 50px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        textarea {
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #3498db;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Tambah Pelamar</h2>

    <form action="proses_pelamar.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="text" name="pendidikan" placeholder="Pendidikan" required>
    <input type="text" name="posisi" placeholder="Posisi" required>
    <textarea name="pengalaman_kerja" placeholder="Pengalaman Kerja"></textarea>
    <input type="date" name="tanggal_melamar" required>
    <select name="status_akhir" required>
        <option value="pending">Pending</option>
        <option value="diterima">Diterima</option>
        <option value="ditolak">Ditolak</option>
    </select>
    <input type="file" name="cv" accept="application/pdf">
    <button type="submit" name="simpan">Simpan</button>
</form>

</div>

</body>
</html>
