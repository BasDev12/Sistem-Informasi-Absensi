<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include "koneksi.php";

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: lihatmahasiswa.php");
    exit;
}

$npm = $_GET['id'];

// Ambil data mahasiswa berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE npm='$npm'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Mahasiswa tidak ditemukan!";
    exit;
}

// Proses update data
if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];

    // Jika ada foto yang diupload
    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];
        $path = "img/" . $foto;

        // Upload foto baru
        move_uploaded_file($tmp, $path);

        // Update data dengan foto
        $update = "UPDATE mahasiswa SET nama='$nama', id_kelas='$kelas', foto='$foto' WHERE npm='$npm'";
    } else {
        // Update data tanpa mengubah foto
        $update = "UPDATE mahasiswa SET nama='$nama', id_kelas='$kelas' WHERE npm='$npm'";
    }

    if (mysqli_query($koneksi, $update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='lihatmhs.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Edit Mahasiswa</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" class="form-control" value="<?= $data['npm']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
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
                <label>Upload Foto Baru</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            <a href="lihatmhs.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
