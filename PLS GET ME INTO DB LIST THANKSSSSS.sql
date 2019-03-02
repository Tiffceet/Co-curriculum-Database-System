-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2019 at 01:42 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kokurikulum`
--
DROP DATABASE IF EXISTS `kokurikulum`;
CREATE DATABASE IF NOT EXISTS `kokurikulum` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kokurikulum`;

-- --------------------------------------------------------

--
-- Table structure for table `kelab dan persatuan`
--

DROP TABLE IF EXISTS `kelab dan persatuan`;
CREATE TABLE `kelab dan persatuan` (
  `KodKelab` int(6) NOT NULL,
  `NamaKelab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelab dan persatuan`
--

INSERT INTO `kelab dan persatuan` (`KodKelab`, `NamaKelab`) VALUES
(1, 'Kelab Shit'),
(34, 'this'),
(35, 'is'),
(36, 'really'),
(37, 'weird'),
(38, 'Kelab Shit'),
(39, 'this'),
(40, 'is'),
(41, 'really'),
(42, 'weird'),
(43, 'Kelab BC'),
(44, ' Kelab BI');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `KodKelas` int(6) NOT NULL,
  `NamaKelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`KodKelas`, `NamaKelas`) VALUES
(6, '1A1'),
(7, '1A2'),
(8, '1A3'),
(9, '1A4'),
(10, '1A5'),
(11, '1A6'),
(12, '4TA'),
(13, '4TB'),
(14, '4TC'),
(15, '3SFA'),
(16, '3SFB');

-- --------------------------------------------------------

--
-- Table structure for table `pelajar`
--

DROP TABLE IF EXISTS `pelajar`;
CREATE TABLE `pelajar` (
  `NoSek` varchar(6) NOT NULL,
  `NamaPelajar` varchar(255) NOT NULL,
  `KodKelas` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajar`
--

INSERT INTO `pelajar` (`NoSek`, `NamaPelajar`, `KodKelas`) VALUES
('10001', 'Pelajar 1', 6),
('10002', 'Pelajar 2', 7),
('10003', 'Pelajar 3', 8),
('32139', 'Pelajada', 6),
('34413', 'Pelja123', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
CREATE TABLE `pendaftaran` (
  `TarikhPendaftaran` date NOT NULL,
  `KodPendaftaran` int(6) NOT NULL,
  `KodPengguna` int(6) NOT NULL,
  `KodKelab` int(6) NOT NULL,
  `NoSek` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`TarikhPendaftaran`, `KodPendaftaran`, `KodPengguna`, `KodKelab`, `NoSek`) VALUES
('2018-04-20', 2, 1, 43, '10001'),
('2018-04-20', 3, 1, 40, '10003'),
('2018-04-20', 4, 1, 40, '10002'),
('2018-04-25', 5, 1, 43, '34413'),
('2018-04-25', 6, 1, 44, '32139');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `KodPengguna` int(6) NOT NULL,
  `NamaPengguna` varchar(255) NOT NULL,
  `KataLaluan` varchar(7000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`KodPengguna`, `NamaPengguna`, `KataLaluan`) VALUES
(1, 'root', '123'),
(2, 'root2', '123'),
(3, 'Amin', 'Amin'),
(4, 'Ali', 'Ali');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelab dan persatuan`
--
ALTER TABLE `kelab dan persatuan`
  ADD PRIMARY KEY (`KodKelab`),
  ADD KEY `KodKelab` (`KodKelab`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`KodKelas`),
  ADD KEY `KodKelas` (`KodKelas`),
  ADD KEY `KodKelas_2` (`KodKelas`);

--
-- Indexes for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`NoSek`),
  ADD KEY `KodKelas` (`KodKelas`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`KodPendaftaran`),
  ADD KEY `KodPengguna` (`KodPengguna`),
  ADD KEY `KodKelab` (`KodKelab`),
  ADD KEY `NoSek` (`NoSek`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`KodPengguna`),
  ADD KEY `KodPengguna` (`KodPengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelab dan persatuan`
--
ALTER TABLE `kelab dan persatuan`
  MODIFY `KodKelab` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `KodKelas` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `KodPendaftaran` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `KodPengguna` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD CONSTRAINT `pelajar_ibfk_1` FOREIGN KEY (`KodKelas`) REFERENCES `kelas` (`KodKelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`KodKelab`) REFERENCES `kelab dan persatuan` (`KodKelab`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`KodPengguna`) REFERENCES `pengguna` (`KodPengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_3` FOREIGN KEY (`NoSek`) REFERENCES `pelajar` (`NoSek`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
