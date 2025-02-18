<?php
include 'koneksi.php';

// Cek apakah ada ID kelas yang diberikan dalam URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Query untuk menghapus kelas berdasarkan ID
    $delete_query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";

    if (mysqli_query($koneksi, $delete_query)) {
        // Jika berhasil, redirect ke halaman kelola kelas
        header('Location: kelas.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID kelas tidak valid!";
    exit;
}
?>