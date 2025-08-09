<?php
require('fpdf/fpdf.php');
include 'koneksi.php';

// Ambil ID kelas dari URL
$id_kelas = $_GET['kelas'];

// Query untuk mendapatkan data kelas dan mahasiswa
$sql_kelas = "SELECT * FROM kelas WHERE id_kelas='$id_kelas'";
$query_kelas = mysqli_query($koneksi, $sql_kelas);
$data_kelas = mysqli_fetch_assoc($query_kelas);

$sql_mahasiswa = "SELECT * FROM mahasiswa WHERE id_kelas='$id_kelas'";
$query_mahasiswa = mysqli_query($koneksi, $sql_mahasiswa);

// Buat objek PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Header
$pdf->Cell(190, 10, 'Rekap Absensi - ' . $data_kelas['nama_kelas'], 0, 1, 'C');
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(30, 10, 'NPM', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nama', 1, 0, 'C');

// Ambil daftar tanggal absensi
$sql_tanggal = "SELECT DISTINCT(jadwal) FROM absensi WHERE id_kelas='$id_kelas'";
$query_tanggal = mysqli_query($koneksi, $sql_tanggal);
$tanggal_list = [];
while ($data_tanggal = mysqli_fetch_array($query_tanggal)) {
    $tanggal_list[] = $data_tanggal['jadwal'];
    $pdf->Cell(25, 10, $data_tanggal['jadwal'], 1, 0, 'C');
}
$pdf->Ln();

// Data Mahasiswa
$pdf->SetFont('Arial', '', 10);
$no = 1;
while ($data_mhs = mysqli_fetch_array($query_mahasiswa)) {
    $pdf->Cell(10, 10, $no++, 1, 0, 'C');
    $pdf->Cell(30, 10, $data_mhs['npm'], 1, 0, 'C');
    $pdf->Cell(60, 10, $data_mhs['nama'], 1, 0, 'L');

    // Ambil data absensi per mahasiswa
    foreach ($tanggal_list as $tgl) {
        $sql_absensi = "SELECT keterangan FROM absensi WHERE npm='{$data_mhs['npm']}' AND jadwal='$tgl'";
        $query_absensi = mysqli_query($koneksi, $sql_absensi);
        $absensi = mysqli_fetch_assoc($query_absensi);
        $keterangan = $absensi ? $absensi['keterangan'] : '-';
        $pdf->Cell(25, 10, $keterangan, 1, 0, 'C');
    }
    $pdf->Ln();
}

// Output PDF
$pdf->Output('D', 'Rekap_Absensi_' . $data_kelas['nama_kelas'] . '.pdf');
?>
