-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Jan 2021 pada 05.12
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `t_absen`
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
-- Dumping data untuk tabel `t_absen`
--

INSERT INTO `t_absen` (`id_absen`, `tanggal`, `jam_masuk`, `stat`, `id_fingerprint`, `n_poor`, `n_average`, `n_good`, `n_excellent`, `stat_nilai`, `no_ref`) VALUES
(107, '2020-11-11', '08:03:35', 'M', '2', 4, 2, 6, 4, 'SN', 7),
(108, '2020-11-12', '08:02:56', 'M', '1', 0, 0, 0, 0, 'BN', 7),
(109, '2020-12-28', '08:02:56', 'M', '2', 0, 10, 10, 10, 'SN', 7),
(110, '2021-01-07', '08:02:56', 'M', '2', 2, 1, 4, 3, 'SN', 7),
(112, '2021-01-08', '08:02:24', 'M', '2', 3, 6, 4, 1, 'SN', 7),
(113, '2021-01-09', '08:06:35', 'M', '2', 3, 4, 1, 2, 'SN', 7),
(114, '2021-01-10', '08:02:56', 'M', '1', 0, 0, 0, 2, 'SN', 7),
(115, '2021-02-08', '08:05:56', 'M', '1', 0, 0, 0, 0, 'BN', 7),
(116, '2021-02-10', '08:03:35', 'M', '2', 0, 0, 0, 0, 'BN', 7),
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
(167, '2021-01-07', '08:04:00', 'M', '1', 0, 0, 0, 2, 'BN', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_caddy`
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
  `hapus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_caddy`
--

INSERT INTO `t_caddy` (`id_caddy`, `id_fingerprint`, `nama`, `nip`, `email`, `jk`, `foto`, `tlp`, `alamat`, `bergabung`, `hapus`) VALUES
(4, '1', 'Viki', '1234567890', 'adi.hidayat@raharja.info', 'L', '12345678901.jpg', '087880096343', 'Jl. Mawar Indah ', '2021-03-01', 0),
(6, '2', 'Ana Adiyani', '1511483806', 'ana@raharja.info', 'P', '15114838061.jpg', '089611508717', 'Jl. Rumah Orang', '2021-03-01', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_laporan`
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
-- Dumping data untuk tabel `t_laporan`
--

INSERT INTO `t_laporan` (`id_laporan`, `no_laporan`, `periode_laporan`, `id_user`, `id_caddy`, `skor_absen`, `skor_turun`, `total_skor`, `tgl_dibuat`, `stat_laporan`) VALUES
(19, '002/FPK-MR/01/21', '2021-01', 1, 4, -12, 85, 73, '2021-01-17', 'LS'),
(20, '002/FPK-MR/01/21', '2021-01', 1, 6, -7, 665, 658, '2021-01-17', 'LS'),
(25, '002/FPK-MR/12/21', '2020-12', 1, 4, 0, 0, 0, '2021-01-18', 'LM'),
(28, '002/FPK-MR/12/21', '2020-12', 1, 6, 4, 750, 754, '2021-01-18', 'LM'),
(32, '002/FPK-MR/09/21', '2020-09', 1, 6, -13, 1010, 997, '2021-01-23', 'LM'),
(33, '002/FPK-MR/09/21', '2020-09', 1, 4, 5, 800, 805, '2021-01-23', 'LM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_nilai`
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
-- Dumping data untuk tabel `t_nilai`
--

INSERT INTO `t_nilai` (`id_nilai`, `id_caddy`, `periode`, `total_absen`, `total_telat`, `total_alpa`, `total_sakit`, `total_turun`, `total_poor`, `total_average`, `total_good`, `total_excellent`) VALUES
(2, 6, '2021-01', 2, 1, 1, 0, 34, 8, 11, 9, 6),
(3, 4, '2021-01', 2, 0, 2, 0, 3, 0, 0, 1, 2),
(4, 6, '2020-12', 1, 0, 0, 0, 30, 0, 10, 10, 10),
(5, 6, '2020-11', 1, 0, 1, 0, 16, 4, 2, 6, 4),
(7, 6, '2020-09', 3, 1, 2, 0, 49, 12, 10, 12, 15),
(8, 4, '2020-09', 4, 0, 1, 0, 32, 2, 6, 10, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
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
  `hapus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `email`, `nama`, `foto`, `nip`, `roll`, `reset_key`, `hapus`) VALUES
(1, 'caddymaster', '$2y$10$bP.yKdQJy/k9Npk6ewSRY.Dti08/6OECiX7Q2MaC.Wy1mHasmqhJK', 'adi.hidayat@raharja.info', 'Indah Purnamasari', '123456789.jpg', '1234567890', '1', '', 0),
(2, 'gomanager', '$2y$10$/HBattTu/J7o47HuQEBaE.yBNzf43lxg/Z6kckCo6H0G9t9S49Ubi', 'adi.hidayat@raharja.info', 'Dian P', '1234567891.jpg', '1234567891', '2', '', 0),
(3, 'admin', '$2y$10$J0jlGSvfjzpCORBHJH//vudPlWYPJ3ab2/.RHq414NlqLCPcUMg0e', 'adi.hidayat@raharja.info', 'Administrator', 'admin.png', '', '3', '', 0);

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
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT for table `t_caddy`
--
ALTER TABLE `t_caddy`
  MODIFY `id_caddy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `t_laporan`
--
ALTER TABLE `t_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `t_nilai`
--
ALTER TABLE `t_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
