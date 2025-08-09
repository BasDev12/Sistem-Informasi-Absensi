<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST["npm"];
    $nama = $_POST["nama"];
    $id_kelas = $_POST["id_kelas"];
    
    // Upload Foto
    $foto = $_FILES["foto"]["name"];
    $target_dir = "img/";
    $target_file = $target_dir . basename($foto);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
    
    $sql = "INSERT INTO mahasiswa (npm, nama, id_kelas, foto) VALUES ('$npm', '$nama', '$id_kelas', '$foto')";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Mahasiswa berhasil ditambahkan!'); window.location.href='lihatmhs.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan mahasiswa!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Tambah Mahasiswa</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="npm">NPM:</label>
                <input type="text" class="form-control" name="npm" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
          <div class="form-group">
    <label for="id_kelas">Kelas:</label>
    <select class="form-control" name="id_kelas" required>
        <?php

        $sql_kelas = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas");
        while ($data = mysqli_fetch_assoc($sql_kelas)) {
            echo "<option value='{$data['id_kelas']}'>{$data['nama_kelas']}</option>";
        }
        ?>
    </select>
</div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control" name="foto" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="mahasiswa.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
