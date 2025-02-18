<?php
include 'koneksi.php';

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];

    // Delete the student from the database
    $delete_query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($koneksi, $delete_query)) {
        // Redirect to the student list page after successful deletion
        header('Location: data_siswa.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "No student ID provided!";
    exit;
}
?>
