<?php
// Fungsi untuk menambah data wali murid
if (isset($_POST['submit'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $kelas_siswa = $_POST['kelas_siswa'];
    $nama_wali = $_POST['nama_wali'];
    $no_telepon_wali = $_POST['no_telepon_wali'];

    // Menambahkan data wali murid ke file CSV
    $file = fopen('data_wali_murid.csv', 'a');
    fputcsv($file, array($nama_siswa, $kelas_siswa, $nama_wali, $no_telepon_wali));
    fclose($file);
    echo "<p>Data wali murid berhasil ditambahkan!</p>";
}

// Fungsi untuk menampilkan data wali murid
function tampilkan_data_wali_murid() {
    if (file_exists('data_wali_murid.csv')) {
        $file = fopen('data_wali_murid.csv', 'r');
        echo "<h2>Data Wali Murid dan Siswa</h2>";
        echo "<table border='1'>
                <tr> 
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Nama Wali Murid</th>
                    <th>No Telepon Wali Murid</th>
                </tr>";
        
        while (($data = fgetcsv($file)) !== FALSE) {
            echo "<tr>
                    <td>" . $data[0] . "</td>
                    <td>" . $data[1] . "</td>
                    <td>" . $data[2] . "</td>
                    <td>" . $data[3] . "</td>
                  </tr>";
        }
        fclose($file);
        echo "</table>";
    } else {
        echo "<p>Belum ada data wali murid yang tersedia.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wali Murid</title>
</head>
<body>
    <h1>Tambah Data Wali Murid</h1>
    <form method="POST">
        <label for="nama_siswa">Nama Siswa:</label><br>
        <input type="text" id="nama_siswa" name="nama_siswa" required><br><br>

        <label for="kelas_siswa">Kelas:</label><br>
        <input type="text" id="kelas_siswa" name="kelas_siswa" required><br><br>

        <label for="nama_wali">Nama Wali Murid:</label><br>
        <input type="text" id="nama_wali" name="nama_wali" required><br><br>

        <label for="no_telepon_wali">No Telepon Wali Murid:</label><br>
        <input type="text" id="no_telepon_wali" name="no_telepon_wali" required><br><br>

        <button type="submit" name="submit">Tambah Data</button>
    </form>

    <hr>

    <?php tampilkan_data_wali_murid(); ?>
</body>
</html>