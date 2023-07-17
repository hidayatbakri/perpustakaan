-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Jul 2023 pada 02.53
-- Versi server: 8.0.30
-- Versi PHP: 8.2.4

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
-- Struktur dari tabel `tbl_buku`
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
-- Dumping data untuk tabel `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `gambar`) VALUES
(2, 'Siksa Kubur', 'Arman', 'Beras Bulog', '2023-06-08', 1, 'buku-default.png'),
(4, '10 Budak Hitam', 'Arman Almaliq', 'Anak sini', '2023-05-28', 9, 'buku-default.png'),
(6, 'Bahasa Indonesia Kelas 9', 'asdf', 'sdf', '2003-03-03', 2, 'ec0d9337aa5ec74c2bf18a42641737f1.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '7C'),
(2, '7B'),
(4, '8A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kunjungan`
--

CREATE TABLE `tbl_kunjungan` (
  `id_kunjungan` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `baca` varchar(150) NOT NULL,
  `tgl_kunjungan` date NOT NULL,
  `pinjam` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `hp` char(15) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_kunjungan`
--

INSERT INTO `tbl_kunjungan` (`id_kunjungan`, `nama`, `baca`, `tgl_kunjungan`, `pinjam`, `alamat`, `hp`, `keterangan`) VALUES
(1, 'Asrullah ya', 'kimia', '2023-06-22', 'tidak tau', 'Maros', '085788129123', 'Membaca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int NOT NULL,
  `id_anggota` int NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('siswa','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `id_anggota`, `email`, `password`, `level`) VALUES
(1, 111, 'arman@gmail.com', '$2y$10$PMS0X/XC3zIVwIj8PexF2O3KhSPRR74cOUjUSOjhvGitewUgXc.JC', 'staff'),
(2, 182001, 'rihla15@gmail.com', '$2y$10$HkixRysjY0KSWiWRgTLiZOsuPFO2sYndpb6OJQSIyaSzGDT9R./G2', 'siswa'),
(3, 182002, 'hidayatbakri13@gmail.com', '$2y$10$JC82hnoTLH41q51uuCX8u.t3ncMhvmc9IOnK/Ep9r5E4gTdVUiT3C', 'siswa'),
(4, 112, 'sirajuddin@gmail.com', '$2y$10$imL32IwRPQ9y0FcTFrTRWOEo2Zf5938fxhn5Ke/DYUnPkck3Y50fS', 'staff'),
(7, 182100, 'ferdi@gmail.com', '$2y$10$xFOjHnhlptnVFWVKxHPaMOoT51ZWL.xR8fAlWW3uL6.n1pZWosPa.', 'siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_peminjaman`
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
-- Dumping data untuk tabel `tbl_peminjaman`
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
(10, 182001, 6, '2023-06-18', NULL, 'tidak'),
(11, 182001, 6, '2023-05-13', NULL, 'tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_profile`
--

CREATE TABLE `tbl_profile` (
  `id_profile` int NOT NULL,
  `nama_sekolah` varchar(150) NOT NULL,
  `nama_perpus` varchar(150) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `motto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_profile`
--

INSERT INTO `tbl_profile` (`id_profile`, `nama_sekolah`, `nama_perpus`, `logo`, `email`, `alamat`, `map`, `motto`) VALUES
(8, 'SMAN 4 Makassar', 'Perpustakaan Digital Mariam Al-Ijliya', '311d19c9e3feecc2569aa400f4003dd8.png', 'siapasaja@gmail.com', 'Jl Cakalang', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.9190607554883!2d119.41632097439586!3d-5.116745851808984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd6267f0a4c3%3A0xb2b9481a8a9515f6!2sSMA%20Negeri%204%20Makassar!5e0!3m2!1sid!2sid!4v1689126464592!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Menggali Potensi Pengetahuan: Jelajahi Sistem Informasi Perpustakaan SMA Negeri 4 Makassar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
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
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nis`, `nama`, `alamat`, `telepon`, `jk`, `id_kelas`, `valid`) VALUES
(182001, 'Rihla Reskiji', 'Jl. Bontonompo', '08923342331', 'Laki-Laki', 2, 'true'),
(182002, 'Hidayat Bakri', 'Jl. Terompet Raya No. 11', '08973853224', 'Laki-Laki', 1, 'true'),
(182100, 'Ferdiansyah', 'Jl. Rumah 69', '085712381230', 'Laki-Laki', 1, 'true');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `nip` int NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_staff`
--

INSERT INTO `tbl_staff` (`nip`, `nama`, `alamat`, `jk`) VALUES
(111, 'Arman Almaliq', 'Jl. Rumah Dia No.69', 'Perempuan'),
(112, 'Sirajuddin', 'Sudiang', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_struktur`
--

CREATE TABLE `tbl_struktur` (
  `id_struktur` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(150) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`);

--
-- Indeks untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `tbl_struktur`
--
ALTER TABLE `tbl_struktur`
  ADD PRIMARY KEY (`id_struktur`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_kunjungan`
--
ALTER TABLE `tbl_kunjungan`
  MODIFY `id_kunjungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_profile`
--
ALTER TABLE `tbl_profile`
  MODIFY `id_profile` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `nis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192002;

--
-- AUTO_INCREMENT untuk tabel `tbl_struktur`
--
ALTER TABLE `tbl_struktur`
  MODIFY `id_struktur` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
