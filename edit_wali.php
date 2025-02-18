<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];

    // Ambil data wali murid berdasarkan ID
    $query = "SELECT * FROM wali_murid WHERE id_wali = '$id_wali'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
        $kontak = mysqli_real_escape_string($koneksi, $_POST['kontak']);

        // Update data wali murid
        $update_query = "UPDATE wali_murid SET nama_wali = '$nama_wali', kontak = '$kontak' WHERE id_wali = '$id_wali'";
        if (mysqli_query($koneksi, $update_query)) {
            header("Location: wali_murid.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
} else {
    header("Location: wali_murid.php");
    exit();
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
                <label for="nama_wali" class="form-label">Nama Wali</label>
                <input type="text" name="nama_wali" class="form-control" value="<?php echo $row['nama_wali']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">No. Telepon</label>
                <input type="text" name="kontak" class="form-control" value="<?php echo $row['kontak']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="wali_murid.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>   