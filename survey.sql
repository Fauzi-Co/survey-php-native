-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 09:41 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_kuis`
--

CREATE TABLE `jawaban_kuis` (
  `id_jawaban` int(11) NOT NULL,
  `id_responden` int(11) DEFAULT NULL,
  `id_kuis` int(11) DEFAULT NULL,
  `jawaban` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kuisioners`
--

CREATE TABLE `kuisioners` (
  `id_kuis` int(11) NOT NULL,
  `kuis` longtext DEFAULT NULL,
  `pilihan_1` varchar(100) DEFAULT NULL,
  `pilihan_2` varchar(100) DEFAULT NULL,
  `pilihan_3` varchar(100) DEFAULT NULL,
  `pilihan_4` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `respondens`
--

CREATE TABLE `respondens` (
  `id_responden` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `usia` int(11) NOT NULL DEFAULT 0,
  `jenis_kelamin` char(13) NOT NULL DEFAULT '0',
  `pendidikan_terakhir` char(50) DEFAULT NULL,
  `pekerjaan` char(50) DEFAULT NULL,
  `jenis_pelayanan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `rule` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `foto`, `rule`) VALUES
(1, 'Andika Rosi Wirayuda', '12345', 'profil.jpg', NULL),
(2, 'admin', 'admin', '1651742830.jpg', 'Staff Pelayanan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban_kuis`
--
ALTER TABLE `jawaban_kuis`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kuisioners`
--
ALTER TABLE `kuisioners`
  ADD PRIMARY KEY (`id_kuis`);

--
-- Indexes for table `respondens`
--
ALTER TABLE `respondens`
  ADD PRIMARY KEY (`id_responden`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawaban_kuis`
--
ALTER TABLE `jawaban_kuis`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kuisioners`
--
ALTER TABLE `kuisioners`
  MODIFY `id_kuis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `respondens`
--
ALTER TABLE `respondens`
  MODIFY `id_responden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
