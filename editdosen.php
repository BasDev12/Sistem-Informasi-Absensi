<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM dosen WHERE id_dosen='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $jk = $_POST["jk"];
    $tgl_lahir = $_POST["tgl_lahir"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $no_hp = $_POST["no_hp"];
    $status = $_POST["status"];

    $query_update = "UPDATE dosen SET nama='$nama', jk='$jk', tgl_lahir='$tgl_lahir', email='$email', password='$password', no_hp='$no_hp', status='$status' WHERE id_dosen='$id'";
    
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='lihatdsn.php';</script>";
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
    <title>Edit Dosen</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Dosen</h2>
        <form method="post">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $data['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jk">
                    <option value="Pria" <?= ($data['jk'] == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                    <option value="Wanita" <?= ($data['jk'] == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" value="<?= $data['tgl_lahir']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?= $data['email']; ?>" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" name="password" value="<?= $data['password']; ?>" required>
            </div>
            <div class="form-group">
                <label>No. HP</label>
                <input type="text" class="form-control" name="no_hp" value="<?= $data['no_hp']; ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="Dosen" <?= ($data['status'] == 'Dosen') ? 'selected' : ''; ?>>Dosen</option>
                    <option value="Non-Dosen" <?= ($data['status'] == 'Non-Dosen') ? 'selected' : ''; ?>>Non-Dosen</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="lihatdsn.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
