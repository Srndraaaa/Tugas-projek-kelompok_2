<?php
// proses_pelamar.php
include "koneksi.php";

if (isset($_POST['simpan'])) {

    // Ambil data dari form
    $nama        = mysqli_real_escape_string($conn, $_POST['nama']);
    $pendidikan  = mysqli_real_escape_string($conn, $_POST['pendidikan']);
    $posisi      = mysqli_real_escape_string($conn, $_POST['posisi']);
    $pengalaman  = mysqli_real_escape_string($conn, $_POST['pengalaman_kerja']);
    $tanggal     = $_POST['tanggal_melamar'];
    $status      = $_POST['status_akhir'];

    // ===============================
    // PROSES UPLOAD CV (boleh kosong)
    // ===============================
    $cv_baru = null; // default null jika tidak ada file

    if (isset($_FILES['cv']) && $_FILES['cv']['error'] != 4) { // error 4 = tidak ada file
        $cv_name = $_FILES['cv']['name'];
        $cv_tmp  = $_FILES['cv']['tmp_name'];
        $cv_ext  = strtolower(pathinfo($cv_name, PATHINFO_EXTENSION));

        // Validasi ekstensi PDF
        if ($cv_ext != 'pdf') {
            echo "CV harus berformat PDF";
            exit;
        }

        // Rename file agar unik
        $cv_baru = time() . "_" . $cv_name;

        // Buat folder jika belum ada
        if (!is_dir("cv")) {
            mkdir("cv");
        }

        // Upload file
        if (!move_uploaded_file($cv_tmp, "cv/" . $cv_baru)) {
            echo "Gagal mengunggah file CV";
            exit;
        }
    }

    // ===============================
    // INSERT KE DATABASE
    // ===============================
    $query = mysqli_query($conn, "
        INSERT INTO pelamar
        (nama, pendidikan, posisi, pengalaman_kerja, cv, tanggal_melamar, status_akhir)
        VALUES
        ('$nama', '$pendidikan', '$posisi', '$pengalaman', ".($cv_baru ? "'$cv_baru'" : "NULL").", '$tanggal', '$status')
    ");

    if ($query) {
        header("Location: datapelamar.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>
