<?php
include 'koneksi.php';

// Cek apakah ada ID kelas yang diberikan dalam URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Ambil data kelas berdasarkan ID
    $query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
    $result = mysqli_query($koneksi, $query);
    $kelas = mysqli_fetch_assoc($result);

    // Jika kelas tidak ditemukan
    if (!$kelas) {
        echo "Kelas tidak ditemukan!";
        exit;
    }
} else {
    echo "ID kelas tidak valid!";
    exit;
}

// Menangani jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    // Query untuk memperbarui data kelas
    $update_query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = '$id_kelas'";

    if (mysqli_query($koneksi, $update_query)) {
        // Jika berhasil, redirect ke halaman kelola kelas
        header('Location: kelas.php');
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
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Kelas</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="<?php echo htmlspecialchars($kelas['nama_kelas']); ?>" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="kelas.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>