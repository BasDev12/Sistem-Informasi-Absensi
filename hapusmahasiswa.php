<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include "koneksi.php";

// Cek apakah ada parameter ID
if (!isset($_GET['id'])) {
    header("Location: lihatmahasiswa.php");
    exit;
}

$npm = $_GET['id'];

// Ambil data mahasiswa untuk mendapatkan nama file foto
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE npm='$npm'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Mahasiswa tidak ditemukan!'); window.location='lihatmahasiswa.php';</script>";
    exit;
}

// Hapus foto jika ada
if (!empty($data['foto']) && file_exists("img/" . $data['foto'])) {
    unlink("img/" . $data['foto']);
}

// Hapus data mahasiswa dari database
$delete = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE npm='$npm'");

if ($delete) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='lihatmhs.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); window.location='lihatmhs.php';</script>";
}
?>
