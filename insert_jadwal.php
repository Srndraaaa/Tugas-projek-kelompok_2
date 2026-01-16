<?php
include 'koneksi.php';

$nama = $_POST['nama_pelamar'];
$posisi = $_POST['posisi'];
$tanggal = $_POST['tanggal'];
$waktu = $_POST['waktu'];
$status = $_POST['status'];
$link = $_POST['link'];

$query = mysqli_query($conn, "
    INSERT INTO jadwal_interview 
    (nama_pelamar, posisi, tanggal, waktu, status, link)
    VALUES 
    ('$nama','$posisi','$tanggal','$waktu','$status','$link')
");

if ($query) {
    header("Location: index.php");
} else {
    echo "Gagal menyimpan data";
}
