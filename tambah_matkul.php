<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

// Ambil daftar dosen dari database
$dosen_query = "SELECT id_dosen, nama_dosen FROM dosen";
$dosen_result = mysqli_query($koneksi, $dosen_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_matkul = $_POST['id_matkul'];
    $nama_matkul = $_POST['nama_matkul'];
    $id_dosen = $_POST['id_dosen'];
    
    $sql = "INSERT INTO matkul (id_matkul, nama_matkul, id_dosen) VALUES ('$id_matkul', '$nama_matkul', '$id_dosen')";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Mata kuliah berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan mata kuliah!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Kuliah</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Mata Kuliah</h2>
        <form method="POST">
            <div class="form-group">
                <label for="id_matkul">ID Mata Kuliah</label>
                <input type="text" name="id_matkul" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama_matkul">Nama Mata Kuliah</label>
                <input type="text" name="nama_matkul" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id_dosen">Dosen Pengampu</label>
                <select name="id_dosen" class="form-control" required>
                    <option value="">-- Pilih Dosen --</option>
                     <?php
                            $result = mysqli_query($koneksi, "SELECT id_dosen, id_dosen FROM dosen");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id_dosen'] . "'>" . $row['id_dosen'] . "</option>";
                            }
                            ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
