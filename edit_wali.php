<?php
include 'koneksi.php';

// Cek apakah ada ID wali murid yang diberikan dalam URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_wali = $_GET['id'];

    // Ambil data wali murid berdasarkan ID
    $query = "SELECT * FROM wali_murid WHERE id_wali = '$id_wali'";
    $result = mysqli_query($koneksi, $query);
    $wali = mysqli_fetch_assoc($result);

    // Jika wali murid tidak ditemukan
    if (!$wali) {
        echo "Wali murid tidak ditemukan!";
        exit;
    }
} else {
    echo "ID wali murid tidak valid!";
    exit;
}

// Menangani jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
    $alamat_wali = mysqli_real_escape_string($koneksi, $_POST['alamat_wali']);
    $telepon_wali = mysqli_real_escape_string($koneksi, $_POST['telepon_wali']);

    // Query untuk memperbarui data wali murid
    $update_query = "UPDATE wali_murid SET 
                        nama_wali = '$nama_wali',
                        alamat_wali = '$alamat_wali',
                        telepon_wali = '$telepon_wali'
                    WHERE id_wali = '$id_wali'";

    if (mysqli_query($koneksi, $update_query)) {
        // Jika berhasil, redirect ke halaman data wali murid
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
    <title>Edit Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Wali Murid</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" id="nama_wali" class="form-control" value="<?php echo htmlspecialchars($wali['nama_wali']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telepon_wali" class="form-label">Telepon Wali Murid</label>
                <input type="text" name="telepon_wali" id="telepon_wali" class="form-control" value="<?php echo htmlspecialchars($wali['telepon_wali'] ?? ''); ?>" required pattern="\d{10,15}" title="Telepon harus berupa angka dan terdiri dari 10 hingga 15 digit">

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