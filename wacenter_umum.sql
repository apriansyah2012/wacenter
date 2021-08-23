-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 07:48 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wacenter_umum`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(255) NOT NULL,
  `name` varchar(70) NOT NULL,
  `contact_numb` varchar(255) DEFAULT NULL,
  `id_group` char(11) NOT NULL,
  `insert_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `name`, `contact_numb`, `id_group`, `insert_date`) VALUES
(1, 'agus bintarto', '6281903755750', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id_device` int(11) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `token` text NOT NULL,
  `server` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id_device`, `no_hp`, `token`, `server`) VALUES
(1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id_group` int(11) NOT NULL,
  `group_name` char(100) NOT NULL,
  `deskripsi_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id_group`, `group_name`, `deskripsi_group`) VALUES
(1, 'Utama', 'Data Utama');

-- --------------------------------------------------------

--
-- Table structure for table `group_acess`
--

CREATE TABLE `group_acess` (
  `id_acess` int(3) NOT NULL,
  `id_group` char(12) NOT NULL,
  `id_contact` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_acess`
--

INSERT INTO `group_acess` (`id_acess`, `id_group`, `id_contact`) VALUES
(2, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `group_inbox`
--

CREATE TABLE `group_inbox` (
  `id` int(11) NOT NULL,
  `unik` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pengirim` varchar(55) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `proses` text NOT NULL,
  `hp_user` varchar(25) NOT NULL,
  `sts_jawaban` int(1) NOT NULL,
  `status_topik` varchar(11) NOT NULL,
  `device_id` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topik`
--

CREATE TABLE `tbl_topik` (
  `id_topik` int(2) NOT NULL,
  `kode` char(225) NOT NULL,
  `deskripsi_topik` text NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_topik`
--

INSERT INTO `tbl_topik` (`id_topik`, `kode`, `deskripsi_topik`, `isi`) VALUES
(1, 'WA', 'Haloo .... ini adalah whatsapp center .....', 'Haloo .... ini adalah whatsapp center .....');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `namadepan` varchar(40) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `telp` varchar(18) NOT NULL,
  `sts` int(1) NOT NULL,
  `level` char(2) NOT NULL,
  `tgldaftar` datetime NOT NULL,
  `kodeact` char(12) NOT NULL,
  `pass_encryption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `namadepan`, `nama`, `pass`, `telp`, `sts`, `level`, `tgldaftar`, `kodeact`, `pass_encryption`) VALUES
(50, 'admin', 'Agus Bintarto', 'Agus Bintarto', '21232f297a57a5a743894a0e4a801fc3', '08562865852', 1, '1', '0000-00-00 00:00:00', 'PPJ7JB14', '');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_inbox`
--

CREATE TABLE `whatsapp_inbox` (
  `id` int(11) NOT NULL,
  `unik` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pengirim` varchar(55) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `proses` text NOT NULL,
  `hp_user` varchar(25) NOT NULL,
  `sts_jawaban` int(1) NOT NULL,
  `status_topik` varchar(11) NOT NULL,
  `device_id` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_outbox`
--

CREATE TABLE `whatsapp_outbox` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `tujuan` varchar(55) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `proses` tinyint(1) NOT NULL DEFAULT '0',
  `validate` varchar(255) DEFAULT NULL,
  `id_group` varchar(10) NOT NULL,
  `interval` varchar(2) NOT NULL,
  `akses` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `whatsapp_outbox`
--

INSERT INTO `whatsapp_outbox` (`id`, `tanggal`, `tujuan`, `pesan`, `ip_address`, `proses`, `validate`, `id_group`, `interval`, `akses`) VALUES
(1, '2021-03-06 22:55:46', '6281903755750', 'ccccccccccccc', '', 0, NULL, '1', '5', 'Agus Bintarto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`) USING BTREE;

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id_device`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `group_acess`
--
ALTER TABLE `group_acess`
  ADD PRIMARY KEY (`id_acess`);

--
-- Indexes for table `group_inbox`
--
ALTER TABLE `group_inbox`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_topik`
--
ALTER TABLE `tbl_topik`
  ADD PRIMARY KEY (`id_topik`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `whatsapp_inbox`
--
ALTER TABLE `whatsapp_inbox`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `whatsapp_outbox`
--
ALTER TABLE `whatsapp_outbox`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id_device` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `group_acess`
--
ALTER TABLE `group_acess`
  MODIFY `id_acess` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `group_inbox`
--
ALTER TABLE `group_inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_topik`
--
ALTER TABLE `tbl_topik`
  MODIFY `id_topik` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `whatsapp_inbox`
--
ALTER TABLE `whatsapp_inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `whatsapp_outbox`
--
ALTER TABLE `whatsapp_outbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
