<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
include "koneksi.php";

if (isset($_GET['id'])) {
    $id_dosen = $_GET['id'];
    $query = "DELETE FROM dosen WHERE id_dosen='$id_dosen'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data dosen berhasil dihapus!'); window.location='lihatdsn.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data dosen!'); window.location='lihatdsn.php';</script>";
    }
} else {
    echo "<script>alert('ID dosen tidak ditemukan!'); window.location='lihatdsn.php';</script>";
}

?>
