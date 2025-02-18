<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted data
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);
    
    // Insert the new class into the database
    $query = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
    
    if (mysqli_query($koneksi, $query)) {
        header('Location: kelas.php'); // Redirect to the class management page after success
        exit();
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
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3 text-center">Tambah Kelas</h2>
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="kelas.php" class="btn btn-primary">Kembali ke Kelas</a>
                <a href="wali_murid.php" class="btn btn-primary">Kelola Wali Murid</a>
            </div>
        </div>
        <form method="POST" action="tambah_kelas.php">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
