-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 11:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_complaint_vokasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_admin`
--

CREATE TABLE `akun_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` enum('admin','superadmin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_admin`
--

INSERT INTO `akun_admin` (`id_admin`, `nama_admin`, `username`, `password`, `level`) VALUES
(1, 'palmar', 'naufal@gmail.com', '123654', 'superadmin'),
(2, 'naufal', 'nfl@gmail.com', '123654', 'admin'),
(5, 'fikurinomer2', 'coba123', '123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `akun_user`
--

CREATE TABLE `akun_user` (
  `id_user` int(16) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_user`
--

INSERT INTO `akun_user` (`id_user`, `nama_user`, `username`, `password`) VALUES
(124, 'fikuriolevenya', 'fikurinomer3', '123654'),
(125, 'Naufal', 'coba', '123'),
(130, 'fikurinomer2', 'coba12', '123');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `no_antrian` int(16) NOT NULL,
  `id_user` int(10) NOT NULL,
  `keluhan` text NOT NULL,
  `lampiran` varchar(100) NOT NULL,
  `tgl_keluhan` varchar(20) NOT NULL,
  `tjn_kategori` int(11) NOT NULL,
  `jns_kategori` int(11) NOT NULL,
  `status` enum('proses','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`no_antrian`, `id_user`, `keluhan`, `lampiran`, `tgl_keluhan`, `tjn_kategori`, `jns_kategori`, `status`) VALUES
(24, 124, 'tes', 'noImage.png', '2023-12-08', 1, 1, 'selesai'),
(28, 125, '123', 'noImage.png', '2023-12-08', 1, 1, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(255) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id_faq`, `pertanyaan`, `jawaban`) VALUES
(2, 'coba', 'cobaaaa'),
(3, 'tes', 'tesss'),
(5, 'tes22', 'coba'),
(6, 'giuiu', 'ygjhg');

-- --------------------------------------------------------

--
-- Table structure for table `jns_keluhan`
--

CREATE TABLE `jns_keluhan` (
  `id_jenis` int(16) NOT NULL,
  `nama_jenis` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jns_keluhan`
--

INSERT INTO `jns_keluhan` (`id_jenis`, `nama_jenis`) VALUES
(1, 'yudisium'),
(2, 'keuangan'),
(3, 'ceKK');

-- --------------------------------------------------------

--
-- Table structure for table `tindak_lanjut`
--

CREATE TABLE `tindak_lanjut` (
  `id_lanjut` int(16) NOT NULL,
  `no_antrian` int(10) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `tanggapan` varchar(100) DEFAULT NULL,
  `tgl_tanggapan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tindak_lanjut`
--

INSERT INTO `tindak_lanjut` (`id_lanjut`, `no_antrian`, `id_admin`, `tanggapan`, `tgl_tanggapan`) VALUES
(20, 24, 2, '123', '2023-12-08'),
(21, 28, 5, '123', '2023-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `tjn_keluhan`
--

CREATE TABLE `tjn_keluhan` (
  `id_tujuan` int(16) NOT NULL,
  `nama_unit` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tjn_keluhan`
--

INSERT INTO `tjn_keluhan` (`id_tujuan`, `nama_unit`) VALUES
(1, 'fakultas'),
(3, 'departemen'),
(4, 'prodi'),
(6, 'cekk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `akun_user`
--
ALTER TABLE `akun_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`no_antrian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `jns_kategori` (`jns_kategori`),
  ADD KEY `tjn_kategori` (`tjn_kategori`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indexes for table `jns_keluhan`
--
ALTER TABLE `jns_keluhan`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD PRIMARY KEY (`id_lanjut`),
  ADD KEY `no_antrian` (`no_antrian`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `tjn_keluhan`
--
ALTER TABLE `tjn_keluhan`
  ADD PRIMARY KEY (`id_tujuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_admin`
--
ALTER TABLE `akun_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `akun_user`
--
ALTER TABLE `akun_user`
  MODIFY `id_user` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `no_antrian` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jns_keluhan`
--
ALTER TABLE `jns_keluhan`
  MODIFY `id_jenis` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  MODIFY `id_lanjut` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tjn_keluhan`
--
ALTER TABLE `tjn_keluhan`
  MODIFY `id_tujuan` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `complain_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `akun_user` (`id_user`),
  ADD CONSTRAINT `complain_ibfk_2` FOREIGN KEY (`jns_kategori`) REFERENCES `jns_keluhan` (`id_jenis`),
  ADD CONSTRAINT `complain_ibfk_3` FOREIGN KEY (`tjn_kategori`) REFERENCES `tjn_keluhan` (`id_tujuan`);

--
-- Constraints for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD CONSTRAINT `tindak_lanjut_ibfk_1` FOREIGN KEY (`no_antrian`) REFERENCES `complain` (`no_antrian`),
  ADD CONSTRAINT `tindak_lanjut_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `akun_admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
