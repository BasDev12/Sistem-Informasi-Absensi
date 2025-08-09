-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 09 Agu 2025 pada 16.09
-- Versi server: 8.0.31
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

DROP TABLE IF EXISTS `absensi`;
CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absen` int NOT NULL AUTO_INCREMENT,
  `jadwal` date NOT NULL,
  `keterangan` enum('Hadir','Sakit','Izin','Absen') NOT NULL,
  `id_kelas` varchar(11) NOT NULL,
  `npm` varchar(15) NOT NULL,
  PRIMARY KEY (`id_absen`),
  KEY `id_kelas` (`id_kelas`),
  KEY `npm` (`npm`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absen`, `jadwal`, `keterangan`, `id_kelas`, `npm`) VALUES
(285, '2025-02-12', 'Hadir', '001', ' 201.20.011'),
(286, '2025-02-12', 'Hadir', '001', ' 201.20.038'),
(287, '2025-02-12', 'Sakit', '001', '201.20.001'),
(288, '2025-02-12', 'Izin', '001', '201.20.003'),
(289, '2025-02-12', 'Hadir', '001', '201.20.005'),
(290, '2025-02-12', 'Hadir', '001', '201.20.012'),
(291, '2025-02-12', 'Hadir', '001', '201.20.013'),
(292, '2025-02-12', 'Hadir', '001', '201.20.014'),
(293, '2025-02-12', 'Hadir', '001', '201.20.015'),
(294, '2025-02-12', 'Sakit', '001', '201.20.024'),
(295, '2025-02-12', '', '001', '201.20.0302'),
(296, '2025-02-12', '', '001', '201.20.308'),
(297, '2025-02-14', '', '002', ' 201.20.011');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` int NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'user',
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama`, `jk`, `tgl_lahir`, `email`, `password`, `no_hp`, `foto`, `status`, `last_login`, `role`) VALUES
(1, 'Ir. Reski Idrus, S.Kom., M.Kom', 'Pria', '0000-00-00', 'reski@gmail.com', '$2y$10$Nx44ci/AbhmvY/HPmVXu4O0vGdfZa8vWURXeRLp5omvBl2O8G7s4e', '123123123', 'sutan.jpg', 'Dosen', '2025-05-07 16:33:25', 'user'),
(2, 'Basri, S.Kom., M.Kom', 'Pria', '1996-12-06', 'basristmik@gmail.com', '$2y$10$Nx44ci/AbhmvY/HPmVXu4O0vGdfZa8vWURXeRLp5omvBl2O8G7s4e', '085397828095', 'images.png', 'Dosen', '2025-05-07 16:33:25', 'user'),
(3, 'admin', 'Pria', '2025-02-15', 'admin@gmail.com', '$2y$10$Nx44ci/AbhmvY/HPmVXu4O0vGdfZa8vWURXeRLp5omvBl2O8G7s4e', '123456', '', 'Dosen', '2025-05-07 16:33:25', 'admin'),
(912069601, 'Sapriadi, S.Kom., M.Kom', 'Pria', '1996-12-06', 'sapriadi@gmail.com', '$2y$10$LG/QS3fXdxRV0Y.evaQWPeOo6m9VHACkH1C54bcW9kaBlNg..RCUi', '1233', 'images (1).png', 'Dosen', '2025-05-07 16:33:25', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` varchar(11) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL,
  `id_dosen` varchar(11) NOT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_dosen` (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_dosen`) VALUES
('001', 'SI-VII', '1'),
('002', 'SI-VIII', '1'),
('003', 'SI-V', '1'),
('005', 'SI-I', '2'),
('006', 'SI-IX', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `npm` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_kelas` varchar(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`npm`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `jk`, `tgl_lahir`, `alamat`, `id_kelas`, `foto`) VALUES
(' 201.20.011', 'Taufik                ', 'Pria', '0000-00-00', '', '', 'images.png'),
(' 201.20.038', 'Yunadi               ', 'Pria', '0000-00-00', '', '001', 'images.png'),
('201.20.001', 'Arpah                 ', 'Pria', '0000-00-00', '', '001', 'images (1).png'),
('201.20.003', 'Puput talib         ', 'Pria', '0000-00-00', '', '001', 'images (1).png'),
('201.20.005', 'Iwan                  ', 'Pria', '0000-00-00', '', '001', 'images.png'),
('201.20.012', 'Ahmad               ', 'Pria', '0000-00-00', '', '001', 'images.png'),
('201.20.013', 'Saiful                  ', 'Pria', '0000-00-00', '', '001', 'images.png'),
('201.20.014', 'Adriani                ', 'Pria', '0000-00-00', '', '001', 'images (1).png'),
('201.20.015', 'Muh. Juwandi ', 'Pria', '0000-00-00', '', '001', 'images.png'),
('201.20.024', 'SIPAAMI      ', 'Pria', '0000-00-00', '', '001', 'Gambar WhatsApp 2025-02-12 pukul 23.39.54_2c53c56d.jpg'),
('201.20.0302', 'Yogi hikmawan ', 'Pria', '0000-00-00', '', '001', 'images.png'),
('201.20.308', 'Sudirman           ', 'Pria', '0000-00-00', '', '001', 'images.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul`
--

DROP TABLE IF EXISTS `matkul`;
CREATE TABLE IF NOT EXISTS `matkul` (
  `id_matkul` int NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `jenis_matkul` varchar(50) NOT NULL,
  `sks` int NOT NULL,
  `id_dosen` int NOT NULL,
  PRIMARY KEY (`id_matkul`),
  KEY `id_dosen` (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nama_matkul`, `jenis_matkul`, `sks`, `id_dosen`) VALUES
(0, 'Pemrograman Sql', '', 0, 1),
(1, 'Pemrograman Web 2', 'Semi Praktikum', 3, 1),
(2, 'Pemrograman Visual', 'Praktikum', 3, 1),
(4, 'logika', '', 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT 'default.jpg',
  `role` enum('admin','user') DEFAULT 'user',
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `foto`, `role`, `status`, `last_login`, `created_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'Hndsrv17!', 'default.jpg', 'admin', 'aktif', NULL, '2025-02-13 15:51:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
