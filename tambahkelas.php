<?php
  session_start();
  if (!isset($_SESSION["login"])) {
      header("Location: login.php");
      exit;
  }
  include "koneksi.php";

  $dosen_id = $_SESSION['dosen_id'];
  $dosen_name = $_SESSION['dosen_user_name'];
  $dosen_foto = $_SESSION['dosen_user_foto'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id_kelas = mysqli_real_escape_string($koneksi, trim($_POST['id_kelas']));
      $nama_kelas = mysqli_real_escape_string($koneksi, trim($_POST['nama_kelas']));
      $id_dosen = mysqli_real_escape_string($koneksi, trim($_POST['id_dosen']));
      
      if (!empty($id_kelas) && !empty($nama_kelas) && !empty($id_dosen)) {
          $sql = "INSERT INTO kelas (id_kelas, nama_kelas, id_dosen) VALUES ('$id_kelas', '$nama_kelas', '$id_dosen')";
          if (mysqli_query($koneksi, $sql)) {
              echo "<script>alert('Kelas berhasil ditambahkan!'); window.location='index.php';</script>";
          } else {
              echo "<script>alert('Gagal menambahkan kelas: " . mysqli_error($koneksi) . "');</script>";
          }
      } else {
          echo "<script>alert('Semua field harus diisi!');</script>";
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">Tambah Kelas Baru</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="id_kelas">ID Kelas</label>
                        <input type="text" name="id_kelas" id="id_kelas" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_dosen">NIDN</label>
                        <select name="id_dosen" id="id_dosen" class="form-control" required>
                            <option value="">Pilih Dosen</option>
                            <?php
                            $result = mysqli_query($koneksi, "SELECT id_dosen, id_dosen FROM dosen");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id_dosen'] . "'>" . $row['id_dosen'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
