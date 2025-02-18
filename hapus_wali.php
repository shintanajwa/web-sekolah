<?php
include 'koneksi.php';

// Cek apakah ada parameter 'id' di URL
if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];

    // Cek apakah wali murid memiliki relasi dengan siswa
    $check_query = "SELECT COUNT(*) as total FROM siswa WHERE id_wali = $id_wali";
    $check_result = mysqli_query($koneksi, $check_query);
    $check_row = mysqli_fetch_assoc($check_result);

    if ($check_row['total'] > 0) {
        // Jika wali murid masih memiliki relasi dengan siswa, tampilkan pesan error
        echo "<script>alert('Wali murid ini masih terhubung dengan siswa. Hapus terlebih dahulu data siswa yang terhubung dengan wali murid ini.'); window.location.href = 'wali_murid.php';</script>";
    } else {
        // Hapus data wali murid berdasarkan ID
        $query = "DELETE FROM wali_murid WHERE id_wali = $id_wali";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>alert('Data wali murid berhasil dihapus.'); window.location.href = 'wali_murid.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data wali murid.'); window.location.href = 'wali_murid.php';</script>";
        }
    }
} else {
    // Jika tidak ada parameter ID, redirect ke halaman wali murid
    header("Location: wali_murid.php");
    exit;
}
?>
