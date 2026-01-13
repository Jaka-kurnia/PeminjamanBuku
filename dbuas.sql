-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2026 at 08:43 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbuas`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int NOT NULL,
  `kode_anggota` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `kode_anggota`, `nama`, `jenis_kelamin`, `alamat`, `no_hp`, `created_at`) VALUES
(1, 'KA-0001', 'Jaka Kurnia', 'L', 'Jl. Panumangan', '081220398123', '2026-01-10 14:07:17'),
(2, 'KA-0002', 'M. Parhan Adbdilah', 'L', 'Jl.Ciawi', '081220398123', '2026-01-10 14:07:52'),
(3, 'KA-0003', 'M. Ikhsan Hidayat', 'L', 'Jl.Cikijing Karawang', '081220398123', '2026-01-10 14:08:12'),
(4, 'KA-0004', 'Nurwan Sofwan', 'L', 'Jl. Panumangan', '081220398123', '2026-01-10 14:08:30'),
(5, 'KA-0005', 'Sinta', 'P', 'Jl. Ponorogo Banten', '081220398123', '2026-01-12 16:47:20'),
(6, 'KA-0006', 'Icih Bandros', 'P', 'Jl.Cikijing Karawang', '081220398123', '2026-01-12 16:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `buku_id` int NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(80) NOT NULL,
  `penerbit` varchar(80) NOT NULL,
  `tahun_terbit` year NOT NULL,
  `kategori_id` int NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`buku_id`, `kode_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori_id`, `stok`) VALUES
(1, 'L-0001', 'Sankuriang', 'Parhan', 'Gramedia', 1999, 4, 7),
(2, 'MS-0001', 'Gunderwo', 'Padlan', 'Gramedia', 1998, 1, 9),
(3, 'L-0002', 'Naga Bodas', 'Fikri', 'Gramedia', 1998, 4, 10),
(4, 'SJ-0001', 'Indonesia Merdeka', 'M Bahlil', 'Sukamedia', 1998, 2, 8),
(6, 'SJ-0002', 'Indonesia Tanah Air', 'Parza', 'Gramedia', 1998, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int NOT NULL,
  `peminjaman_id` int NOT NULL,
  `buku_id` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `peminjaman_id`, `buku_id`, `jumlah`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 6, 1),
(6, 2, 2, 1),
(7, 3, 1, 1),
(8, 4, 6, 10),
(9, 5, 4, 1),
(10, 5, 1, 1),
(11, 5, 2, 1),
(12, 5, 3, 1),
(13, 5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Mistis'),
(2, 'Sejarah'),
(3, 'Horor'),
(4, 'Legenda');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int NOT NULL,
  `anggota_id` int NOT NULL,
  `user_id` int NOT NULL,
  `no_pinjam` varchar(40) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('tersedia','dipinjam','kembali') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `anggota_id`, `user_id`, `no_pinjam`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(1, 3, 1, 'PJM/20260112/01', '2026-01-12', '2026-01-19', 'tersedia'),
(2, 6, 1, 'PJM/20260113/01', '2026-01-13', '2026-01-20', 'tersedia'),
(3, 4, 1, 'PJM/20260113/02', '2026-01-13', '2026-01-20', 'tersedia'),
(4, 2, 1, 'PJM/20260113/03', '2026-01-13', '2026-01-20', 'dipinjam'),
(5, 3, 1, 'PJM/20260113/04', '2026-01-13', '2026-01-20', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'password', '2026-01-10 07:06:36'),
(2, 'Jaka Kurnia', 'kurniajakaa@gmail.com', 'password', '2026-01-13 04:13:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`buku_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_id` (`peminjaman_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_pinjam` (`no_pinjam`),
  ADD KEY `anggota_id` (`anggota_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `buku_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
