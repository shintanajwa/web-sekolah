<?php
include 'koneksi.php';

// Menangani jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    // Query untuk memasukkan data wali murid baru
    $query = "INSERT INTO wali_murid (nama_wali, telepon) VALUES ('$nama_wali', '$telepon')";

    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, redirect ke halaman kelola wali murid
        header('Location: wali_murid.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Wali Murid</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" id="nama_wali" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">Nomor Telepon</label>
                <input type="text" name="telepon" id="telepon" class="form-control" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="wali_murid.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>