<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
include "koneksi.php";

$dosen_id = $_SESSION['dosen_id'];
$dosen_name = $_SESSION["dosen_user_name"];
$dosen_foto = $_SESSION["dosen_user_foto"];

$tgl = date("d-m-Y");
$jumlah_dosen = mysqli_num_rows(mysqli_query($koneksi, "select * from dosen where status='Dosen'"));
$jumlah_kelas = mysqli_num_rows(mysqli_query($koneksi, "select * from kelas"));
$jumlah_mahasiswa = mysqli_num_rows(mysqli_query($koneksi, "select * from mahasiswa"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Data Dosen | STMIK Hasan Sulur</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">STMIK Hasan Sulur</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="absensi.php">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Absensi</span></a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $dosen_name; ?></span>
                <img class="img-profile rounded-circle" src="img/<?= $dosen_foto; ?>">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Pengaturan
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <div class="container-fluid">
          <h1 class="h3 mb-4 text-gray-800">Data Dosen</h1>
          <a href="tambahdosen.php" class="btn btn-primary mb-3">Tambah Data</a>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Dosen </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>No</th>
                      <th>Foto</th>
                      <th>NIDN</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Tgl Lahir</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>No.HP</th>
                      <th>Status</th>

                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody align="center">
                    <?php
                    $sql = "SELECT * FROM dosen";
                    $query = mysqli_query($koneksi, $sql);
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                      $id_dosen = $data["id_dosen"];
                      $nama = $data["nama"];
                      $jk = $data["jk"];
                      $tgl_lahir = $data["tgl_lahir"];
                      $email = $data["email"];
                      $password = $data["password"];
                      $no_hp = $data["no_hp"];
                      $status = $data["status"];
                      $foto = $data["foto"];
                    ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><img class="img-profile rounded-circle" style="width:50px;height:50px;" src="img/<?= $foto ?>"></td>
                        <td><?= $id_dosen; ?></td>
                        <td><?= $nama; ?></td>
                        <td><?= $jk; ?></td>
                        <td><?= $tgl_lahir; ?></td>
                        <td><?= $email; ?></td>
                        <td><?= $password; ?></td>
                        <td><?= $no_hp; ?></td>
                        <td><?= $status; ?></td>                    
                        <td>
                          <a href="editdosen.php?id=<?= $id_dosen; ?>" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                             <i class="fas fa-edit"></i>
                              </span>
                                  <span class="text">Edit</span>
                              </a>
                              <a href="hapusdosen.php?id=<?= $id_dosen; ?>" class="btn btn-danger btn-icon-split" onclick="return confirm('Apakah Anda yakin ingin menghapus Dosen ini?');">
                                  <span class="icon text-white-50">
                                      <i class="fas fa-trash"></i>
                                  </span>
                                  <span class="text">Hapus</span>
                              </a>
                          </td>

                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
