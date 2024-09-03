-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 08:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simper`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvel`
--

CREATE TABLE `approvel` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_driver`
--

CREATE TABLE `data_driver` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pt` varchar(50) NOT NULL,
  `umur` int(11) NOT NULL,
  `awak` varchar(50) NOT NULL,
  `keperluan` varchar(50) NOT NULL,
  `masa_ktp` date NOT NULL,
  `masa_narkoba` date NOT NULL,
  `masa_kesehatan` date NOT NULL,
  `surat_permohonan_pt` mediumblob NOT NULL,
  `ktp` mediumblob NOT NULL,
  `sim` mediumblob NOT NULL,
  `skck` mediumblob NOT NULL,
  `bebas_narkoba` mediumblob NOT NULL,
  `foto` mediumblob NOT NULL,
  `surat_kesehatan` mediumblob NOT NULL,
  `mcu` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE `reviewer` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_driver`
--
ALTER TABLE `data_driver`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_driver`
--
ALTER TABLE `data_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
