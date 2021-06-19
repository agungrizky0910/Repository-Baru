-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 03:53 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_caddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_absen`
--

CREATE TABLE `t_absen` (
  `id_absen` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `stat` enum('M','S','A') NOT NULL,
  `id_fingerprint` varchar(10) NOT NULL,
  `n_poor` int(3) NOT NULL,
  `n_average` int(3) NOT NULL,
  `n_good` int(3) NOT NULL,
  `n_excellent` int(3) NOT NULL,
  `stat_nilai` enum('BN','SN','S') NOT NULL,
  `no_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_absen`
--

INSERT INTO `t_absen` (`id_absen`, `tanggal`, `jam_masuk`, `stat`, `id_fingerprint`, `n_poor`, `n_average`, `n_good`, `n_excellent`, `stat_nilai`, `no_ref`) VALUES
(117, '2020-11-11', '00:00:00', 'A', '1', 0, 0, 0, 0, 'SN', 7),
(118, '2021-01-08', '00:00:00', 'A', '1', 0, 0, 0, 0, 'SN', 7),
(119, '2021-01-09', '00:00:00', 'A', '1', 0, 0, 0, 0, 'SN', 7),
(120, '2021-02-10', '00:00:00', 'A', '1', 0, 0, 0, 0, 'SN', 7),
(121, '2020-11-12', '00:00:00', 'A', '2', 0, 0, 0, 0, 'SN', 7),
(122, '2021-01-10', '00:00:00', 'A', '2', 0, 0, 0, 0, 'SN', 7),
(123, '2021-02-08', '00:00:00', 'A', '2', 0, 0, 0, 0, 'SN', 7),
(150, '2020-09-14', '00:00:00', 'A', '1', 0, 0, 0, 0, 'SN', 10),
(151, '2020-09-11', '00:00:00', 'A', '2', 0, 0, 0, 0, 'SN', 10),
(152, '2020-09-12', '00:00:00', 'A', '2', 0, 0, 0, 0, 'SN', 10),
(153, '2020-09-11', '00:00:00', 'A', '3', 0, 0, 0, 0, 'SN', 10),
(154, '2020-09-12', '00:00:00', 'A', '3', 0, 0, 0, 0, 'SN', 10),
(155, '2020-09-14', '00:00:00', 'A', '3', 0, 0, 0, 0, 'SN', 10),
(156, '2020-09-16', '00:00:00', 'A', '3', 0, 0, 0, 0, 'SN', 10),
(157, '2020-09-17', '00:00:00', 'A', '3', 0, 0, 0, 0, 'SN', 10),
(158, '2021-01-07', '00:00:00', 'A', '3', 0, 0, 0, 0, 'SN', 10),
(159, '2020-09-11', '08:03:35', 'M', '1', 0, 1, 2, 4, 'SN', 11),
(160, '2020-09-12', '08:02:56', 'M', '1', 2, 2, 5, 3, 'SN', 11),
(161, '2020-09-14', '08:06:56', 'M', '2', 4, 4, 5, 6, 'SN', 11),
(162, '2020-09-14', '08:03:35', 'M', '2', 4, 3, 4, 4, 'SN', 11),
(163, '2020-09-16', '08:02:56', 'M', '1', 0, 1, 1, 4, 'SN', 11),
(164, '2020-09-16', '08:02:56', 'M', '2', 3, 1, 1, 2, 'SN', 11),
(165, '2020-09-17', '08:02:56', 'M', '2', 1, 2, 2, 3, 'SN', 11),
(166, '2020-09-17', '08:02:56', 'M', '1', 0, 2, 2, 3, 'SN', 11),
(170, '2020-11-11', '00:00:00', 'A', '232323', 0, 0, 0, 0, 'SN', 13),
(172, '2020-11-11', '08:03:35', 'M', 'asasas', 0, 0, 0, 0, 'BN', 15),
(173, '2020-11-11', '08:03:35', 'M', '2', 0, 0, 0, 0, 'BN', 16),
(174, '2020-11-12', '08:02:56', 'M', '1', 0, 0, 0, 0, 'BN', 16),
(175, '2020-12-28', '08:02:56', 'M', '2', 0, 0, 0, 0, 'BN', 16),
(176, '2021-01-07', '08:02:56', 'M', '2', 9, 9, 9, 9, 'SN', 16),
(177, '2021-01-07', '08:04:00', 'M', '1', 10, 9, 9, 9, 'SN', 16),
(178, '2021-01-08', '08:02:24', 'M', '2', 9, 9, 9, 9, 'SN', 16),
(179, '2021-01-09', '08:03:35', 'M', '2', 10, 9, 9, 9, 'SN', 16),
(180, '2021-01-10', '08:02:56', 'M', '1', 10, 9, 9, 9, 'SN', 16),
(181, '2021-02-08', '08:05:56', 'M', '1', 0, 0, 0, 0, 'SN', 16),
(182, '2021-02-10', '08:03:35', 'M', '2', 8, 0, 8, 8, 'SN', 16),
(183, '2021-01-10', '08:02:56', 'M', '111', 8, 7, 5, 10, 'SN', 16),
(184, '2021-01-10', '08:02:56', 'M', '232323', 9, 9, 9, 9, 'SN', 16),
(185, '2020-12-28', '00:00:00', 'A', '1', 0, 0, 0, 0, 'SN', 16),
(186, '2020-11-12', '00:00:00', 'A', '232323', 0, 0, 0, 0, 'SN', 16),
(187, '2020-12-28', '00:00:00', 'A', '232323', 0, 0, 0, 0, 'SN', 16),
(188, '2021-01-07', '00:00:00', 'A', '232323', 0, 0, 0, 0, 'SN', 16),
(189, '2021-01-08', '00:00:00', 'A', '232323', 0, 0, 0, 0, 'SN', 16),
(190, '2021-01-09', '00:00:00', 'A', '232323', 0, 0, 0, 0, 'SN', 16),
(191, '2021-02-08', '00:00:00', 'A', '232323', 0, 0, 0, 0, 'SN', 16),
(192, '2021-02-10', '00:00:00', 'A', '232323', 0, 0, 0, 0, 'SN', 16),
(193, '2020-11-11', '00:00:00', 'A', '111', 0, 0, 0, 0, 'SN', 16),
(194, '2020-11-12', '00:00:00', 'A', '111', 0, 0, 0, 0, 'SN', 16),
(195, '2020-12-28', '00:00:00', 'A', '111', 0, 0, 0, 0, 'SN', 16),
(196, '2021-01-07', '00:00:00', 'A', '111', 0, 0, 0, 0, 'SN', 16),
(197, '2021-01-08', '00:00:00', 'A', '111', 0, 0, 0, 0, 'SN', 16),
(198, '2021-01-09', '00:00:00', 'A', '111', 0, 0, 0, 0, 'SN', 16),
(199, '2021-02-08', '00:00:00', 'A', '111', 0, 0, 0, 0, 'SN', 16),
(200, '2021-02-10', '00:00:00', 'A', '111', 0, 0, 0, 0, 'SN', 16);

-- --------------------------------------------------------

--
-- Table structure for table `t_caddy`
--

CREATE TABLE `t_caddy` (
  `id_caddy` int(11) NOT NULL,
  `id_fingerprint` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` char(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `bergabung` date NOT NULL,
  `hapus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_caddy`
--

INSERT INTO `t_caddy` (`id_caddy`, `id_fingerprint`, `nama`, `nip`, `email`, `jk`, `foto`, `tlp`, `alamat`, `bergabung`, `hapus`) VALUES
(4, '1', 'Viki', '1234567890', 'adi.hidayat@raharja.info', 'L', '12345678901.jpg', '087880096343', 'Jl. Mawar Indah ', '2021-03-01', 0),
(6, '2', 'Ana Adiyani', '1511483806', 'ana@raharja.info', 'P', '15114838061.jpg', '089611508717', 'Jl. Rumah Orang', '2021-03-01', 0),
(9, '111', 'Aaa', '1877777777', 'Agungrizky@raharja.info', 'L', '1877777777.jpg', '1218291821', 'asasasasasasa', '1970-01-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_laporan`
--

CREATE TABLE `t_laporan` (
  `id_laporan` int(11) NOT NULL,
  `no_laporan` char(16) NOT NULL,
  `periode_laporan` char(7) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_caddy` int(11) NOT NULL,
  `skor_absen` int(6) NOT NULL,
  `skor_turun` int(6) NOT NULL,
  `total_skor` int(6) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `stat_laporan` enum('LM','LS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_laporan`
--

INSERT INTO `t_laporan` (`id_laporan`, `no_laporan`, `periode_laporan`, `id_user`, `id_caddy`, `skor_absen`, `skor_turun`, `total_skor`, `tgl_dibuat`, `stat_laporan`) VALUES
(25, '002/FPK-MR/12/21', '2020-12', 1, 4, 0, 0, 0, '2021-01-18', 'LS'),
(28, '002/FPK-MR/12/21', '2020-12', 1, 6, 4, 750, 754, '2021-01-18', 'LS'),
(32, '002/FPK-MR/09/21', '2020-09', 1, 6, -13, 1010, 997, '2021-01-23', 'LS'),
(33, '002/FPK-MR/09/21', '2020-09', 1, 4, 5, 800, 805, '2021-01-23', 'LS'),
(42, '004/FPK-MR/01/21', '2021-01', 1, 6, 2, 2165, 2167, '2021-06-19', 'LM'),
(43, '004/FPK-MR/01/21', '2021-01', 1, 4, -12, 1450, 1438, '2021-06-19', 'LM'),
(44, '004/FPK-MR/01/21', '2021-01', 1, 9, -26, 605, 579, '2021-06-19', 'LM'),
(45, '004/FPK-MR/01/21', '2021-01', 1, 8, -26, 720, 694, '2021-06-19', 'LM'),
(46, '001/FPK-MR/02/21', '2021-02', 1, 6, -6, 480, 474, '2021-06-19', 'LM'),
(47, '002/FPK-MR/02/21', '2021-02', 1, 4, -15, 0, -15, '2021-06-19', 'LM');

-- --------------------------------------------------------

--
-- Table structure for table `t_nilai`
--

CREATE TABLE `t_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_caddy` int(11) NOT NULL,
  `periode` char(7) NOT NULL,
  `total_absen` int(2) NOT NULL,
  `total_telat` int(2) NOT NULL,
  `total_alpa` int(2) NOT NULL,
  `total_sakit` int(2) NOT NULL,
  `total_turun` int(3) NOT NULL,
  `total_poor` int(3) NOT NULL,
  `total_average` int(3) NOT NULL,
  `total_good` int(3) NOT NULL,
  `total_excellent` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_nilai`
--

INSERT INTO `t_nilai` (`id_nilai`, `id_caddy`, `periode`, `total_absen`, `total_telat`, `total_alpa`, `total_sakit`, `total_turun`, `total_poor`, `total_average`, `total_good`, `total_excellent`) VALUES
(2, 6, '2021-01', 3, 0, 1, 0, 109, 28, 27, 27, 27),
(3, 4, '2021-01', 2, 0, 2, 0, 74, 20, 18, 18, 18),
(4, 6, '2020-12', 1, 0, 0, 0, 30, 0, 10, 10, 10),
(5, 6, '2020-11', 1, 0, 1, 0, 16, 4, 2, 6, 4),
(7, 6, '2020-09', 3, 1, 2, 0, 49, 12, 10, 12, 15),
(8, 4, '2020-09', 4, 0, 1, 0, 32, 2, 6, 10, 14),
(9, 9, '2021-01', 1, 0, 3, 0, 30, 8, 7, 5, 10),
(10, 8, '2021-01', 1, 0, 3, 0, 36, 9, 9, 9, 9),
(11, 6, '2021-02', 1, 0, 1, 0, 24, 8, 0, 8, 8),
(12, 4, '2021-02', 0, 1, 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nip` char(10) NOT NULL,
  `roll` char(1) NOT NULL,
  `reset_key` char(5) NOT NULL,
  `hapus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `email`, `nama`, `foto`, `nip`, `roll`, `reset_key`, `hapus`) VALUES
(1, 'PETUGAS KALIBRASI', '$2y$10$bP.yKdQJy/k9Npk6ewSRY.Dti08/6OECiX7Q2MaC.Wy1mHasmqhJK', 'agungrizky@raharja.info', 'Viki Andriyan', '1234567890.jpeg', '1234567890', '1', '', 0),
(2, 'SUPERVISIOR', '$2y$10$k4FUkx7evN4yd19xTTiGEuI01/IJ60NThv9gWrKHe8TwhsuOB2n0K', 'agungrizky@raharja.info', 'Supervisior', '12345678911.jpg', '1234567891', '2', '', 0),
(3, 'admin', '$2y$10$J0jlGSvfjzpCORBHJH//vudPlWYPJ3ab2/.RHq414NlqLCPcUMg0e', '', 'Administrator', 'admin.png', '', '3', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_absen`
--
ALTER TABLE `t_absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `t_caddy`
--
ALTER TABLE `t_caddy`
  ADD PRIMARY KEY (`id_caddy`),
  ADD UNIQUE KEY `id_fingerprint` (`id_fingerprint`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `t_laporan`
--
ALTER TABLE `t_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `t_nilai`
--
ALTER TABLE `t_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_absen`
--
ALTER TABLE `t_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `t_caddy`
--
ALTER TABLE `t_caddy`
  MODIFY `id_caddy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_laporan`
--
ALTER TABLE `t_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `t_nilai`
--
ALTER TABLE `t_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
