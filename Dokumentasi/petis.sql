-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2017 at 03:09 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.26-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petis`
--

-- --------------------------------------------------------

--
-- Table structure for table `aduan`
--

CREATE TABLE `aduan` (
  `no_aduan` int(11) NOT NULL,
  `no_rek_listrik` varchar(20) NOT NULL,
  `teks_aduan` text NOT NULL,
  `status_aduan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------------------- 

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id_golongan` varchar(6) NOT NULL,
  `nama_golongan` varchar(50) NOT NULL,
  `harga_perkwh` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meteran`
--

CREATE TABLE `meteran` (
  `no_meter` varchar(20) NOT NULL,
  `id_golongan` varchar(6) NOT NULL,
  `sisa_kwh` double NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OTP`
--

CREATE TABLE `OTP` (
  `id_otp` int(11) NOT NULL,
  `no_rek_listrik` varchar(20) NOT NULL,
  `password` varchar(6) NOT NULL,
  `valid_until` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `no_rek_listrik` varchar(20) NOT NULL,
  `no_meter` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `struk_token`
--

CREATE TABLE `struk_token` (
  `no_struk` int(11) NOT NULL,
  `no_rek_listrik` varchar(20) NOT NULL,
  `tgl_bayar` varchar(15) NOT NULL,
  `no_token` varchar(20) NOT NULL,
  `nominal` double NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aduan`
--
ALTER TABLE `aduan`
  ADD PRIMARY KEY (`no_aduan`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `meteran`
--
ALTER TABLE `meteran`
  ADD PRIMARY KEY (`no_meter`);

--
-- Indexes for table `OTP`
--
ALTER TABLE `OTP`
  ADD PRIMARY KEY (`id_otp`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`no_rek_listrik`),
  ADD UNIQUE KEY `no_meter` (`no_meter`);

--
-- Indexes for table `struk_token`
--
ALTER TABLE `struk_token`
  ADD PRIMARY KEY (`no_struk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aduan`
--
ALTER TABLE `aduan`
  MODIFY `no_aduan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `OTP`
--
ALTER TABLE `OTP`
  MODIFY `id_otp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `struk_token`
--
ALTER TABLE `struk_token`
  MODIFY `no_struk` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
