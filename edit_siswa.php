<?php
include 'koneksi.php';

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];

    // Fetch student data based on the provided 'id'
    $query = "SELECT siswa.*, kelas.nama_kelas, wali_murid.nama_wali FROM siswa
              LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
              LEFT JOIN wali_murid ON siswa.id_kelas = wali_murid.id_wali
              WHERE siswa.id_siswa = '$id_siswa'";

    $result = mysqli_query($koneksi, $query);
    $student = mysqli_fetch_assoc($result);

    // Check if student data was found
    if (!$student) {
        echo "Student not found!";
        exit;
    }
} else {
    echo "No student ID provided!";
    exit;
}

// Handle form submission to update student data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated data from form
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $id_wali = mysqli_real_escape_string($koneksi, $_POST['id_wali']);

    // Update student data in the database
    $update_query = "UPDATE siswa SET
                        nis = '$nis',
                        nama_siswa = '$nama_siswa',
                        jenis_kelamin = '$jenis_kelamin',
                        tempat_lahir = '$tempat_lahir',
                        tanggal_lahir = '$tanggal_lahir',
                        id_kelas = '$id_kelas',
                        id_wali = '$id_wali'
                    WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($koneksi, $update_query)) {
        // Redirect to the student list page after successful update
        header('Location: data_siswa.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Fetch the list of classes and guardians for the dropdowns
$kelas_query = "SELECT * FROM kelas";
$kelas_result = mysqli_query($koneksi, $kelas_query);

$wali_query = "SELECT * FROM wali_murid";
$wali_result = mysqli_query($koneksi, $wali_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3 text-center">Edit Data Siswa</h2>
        <form method="POST" action="edit_siswa.php?id=<?php echo $student['id_siswa']; ?>">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $student['nis']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $student['nama_siswa']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L" <?php if ($student['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                    <option value="P" <?php if ($student['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $student['tempat_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $student['tanggal_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select class="form-select" id="id_kelas" name="id_kelas" required>
                    <?php while ($kelas = mysqli_fetch_assoc($kelas_result)): ?>
                        <option value="<?php echo $kelas['id_kelas']; ?>" <?php if ($student['id_kelas'] == $kelas['id_kelas']) echo 'selected'; ?>>
                            <?php echo $kelas['nama_kelas']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_wali" class="form-label">Wali Murid</label>
                <select class="form-select" id="id_wali" name="id_wali" required>
                    <?php while ($wali = mysqli_fetch_assoc($wali_result)): ?>
                        <option value="<?php echo $wali['id_wali']; ?>" <?php if ($student['id_wali'] == $wali['id_wali']) echo 'selected'; ?>>
                            <?php echo $wali['nama_wali']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
