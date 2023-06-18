-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2023 at 10:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `stok` int NOT NULL,
  `gambar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'buku-default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `gambar`) VALUES
(2, 'Siksa Kubur', 'Arman', 'Beras Bulog', '2023-06-08', 1, 'buku-default.png'),
(4, '10 Budak Hitam', 'Arman Almaliq', 'Anak sini', '2023-05-28', 9, 'buku-default.png'),
(6, 'Bahasa Indonesia Kelas 9', 'asdf', 'sdf', '2003-03-03', 2, 'ec0d9337aa5ec74c2bf18a42641737f1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '7C'),
(2, '7B'),
(4, '8A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int NOT NULL,
  `id_anggota` int NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('siswa','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `id_anggota`, `email`, `password`, `level`) VALUES
(1, 111, 'arman@gmail.com', '$2y$10$PMS0X/XC3zIVwIj8PexF2O3KhSPRR74cOUjUSOjhvGitewUgXc.JC', 'staff'),
(2, 182001, 'rihla15@gmail.com', '$2y$10$HkixRysjY0KSWiWRgTLiZOsuPFO2sYndpb6OJQSIyaSzGDT9R./G2', 'siswa'),
(3, 182002, 'hidayatbakri13@gmail.com', '$2y$10$JC82hnoTLH41q51uuCX8u.t3ncMhvmc9IOnK/Ep9r5E4gTdVUiT3C', 'siswa'),
(4, 112, 'sirajuddin@gmail.com', '$2y$10$imL32IwRPQ9y0FcTFrTRWOEo2Zf5938fxhn5Ke/DYUnPkck3Y50fS', 'staff'),
(7, 182100, 'ferdi@gmail.com', '$2y$10$xFOjHnhlptnVFWVKxHPaMOoT51ZWL.xR8fAlWW3uL6.n1pZWosPa.', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peminjaman`
--

CREATE TABLE `tbl_peminjaman` (
  `id_peminjaman` int NOT NULL,
  `id_anggota` int NOT NULL,
  `id_buku` int NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('ya','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_peminjaman`
--

INSERT INTO `tbl_peminjaman` (`id_peminjaman`, `id_anggota`, `id_buku`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(2, 182002, 2, '2023-06-15', NULL, 'tidak'),
(3, 182001, 2, '2023-06-16', '2023-06-16', 'ya'),
(4, 182001, 4, '2023-06-16', NULL, 'tidak'),
(5, 182002, 2, '2023-06-16', '2023-06-16', 'ya'),
(6, 182001, 2, '2023-06-16', '2023-06-16', 'ya'),
(7, 182100, 2, '2023-06-16', NULL, 'tidak'),
(8, 182002, 4, '2023-06-16', NULL, 'tidak'),
(9, 182001, 2, '2023-06-16', '2023-06-16', 'ya'),
(10, 182001, 6, '2023-06-18', NULL, 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kelas` int NOT NULL,
  `valid` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nis`, `nama`, `alamat`, `telepon`, `jk`, `id_kelas`, `valid`) VALUES
(182001, 'Rihla Reskiji', 'Jl. Bontonompo', '08923342331', 'Laki-Laki', 2, 'true'),
(182002, 'Hidayat Bakri', 'Jl. Terompet Raya No. 11', '08973853224', 'Laki-Laki', 1, 'true'),
(182100, 'Ferdiansyah', 'Jl. Rumah 69', '085712381230', 'Laki-Laki', 1, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `nip` int NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`nip`, `nama`, `alamat`, `jk`) VALUES
(111, 'Arman Almaliq', 'Jl. Rumah Dia No.69', 'Perempuan'),
(112, 'Sirajuddin', 'Sudiang', 'Laki-Laki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `nis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
