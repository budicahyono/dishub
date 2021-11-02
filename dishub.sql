-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 02:56 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dishub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` varchar(10) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_login` int(1) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `operating_system` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `level`, `last_login`, `is_login`, `ip_address`, `browser`, `operating_system`) VALUES
(0, 'Programmer', 'admindev', '53ad9e79ab86dc28e883601871f68a8d', 'dev', '0000-00-00 00:00:00', 0, '', '', ''),
(1, 'admin', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin', '2021-11-02 10:48:00', 1, '127.0.0.1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0'),
(2, 'Bidang Pelayaran', 'user', 'c4ca4238a0b923820dcc509a6f75849b', 'operator', '2021-11-02 10:31:14', 1, '127.0.0.1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0'),
(3, 'Bidang Pengembangan dan Perkeretaapian', 'user2', 'c4ca4238a0b923820dcc509a6f75849b', 'operator', '2021-10-31 18:31:58', 0, '127.0.0.1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0'),
(4, 'Bidang LLAJ', 'user3', 'c4ca4238a0b923820dcc509a6f75849b', 'operator', '2021-10-31 19:38:51', 0, '127.0.0.1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id_inbox` int(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `id_admin` int(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id_inbox`, `judul`, `tgl`, `waktu`, `jenis`, `id_admin`, `status`) VALUES
(1, 'ini di usul oleh user di edit lg', '2021-10-30', '14:49:18', 'usul', 2, 'draft'),
(2, 'Ini laporan dari user di edit', '2021-10-30', '14:50:07', 'laporan', 2, 'draft'),
(3, 'Coba', '2021-10-30', '14:51:14', 'usul', 2, 'terkirim'),
(4, 'laporan1', '2021-10-30', '14:54:51', 'laporan', 2, 'terkirim'),
(7, 'COba aka lagi', '2021-10-30', '16:40:58', 'usul', 3, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `inboxfile`
--

CREATE TABLE `inboxfile` (
  `id_inboxfile` int(10) NOT NULL,
  `id_inbox` int(11) NOT NULL,
  `nm_file` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inboxfile`
--

INSERT INTO `inboxfile` (`id_inboxfile`, `id_inbox`, `nm_file`, `file`, `ukuran`, `jenis`, `tgl`, `user`) VALUES
(5, 6, 'Tes laporan', 'Tes_laporan_6_20211030163033.pdf', 1239, 'application/pdf', '2021-10-30 16:30:33', 'user2'),
(6, 5, 'tes usul', 'tes_usul_5_20211030163119.pdf', 725, 'application/pdf', '2021-10-30 16:31:20', 'user2'),
(9, 7, 'jadi', 'jadi_7_20211030164309.pdf', 677, 'application/pdf', '2021-10-30 16:43:09', 'user2'),
(10, 7, 'yeee', 'yeee_7_20211030164319.pdf', 725, 'application/pdf', '2021-10-30 16:43:19', 'user2'),
(12, 6, 'yeeaaa', 'yeeaaa_6_20211030164650.pdf', 677, 'application/pdf', '2021-10-30 16:46:50', 'user2'),
(13, 3, 'coba', 'coba_3_20211030171101.pdf', 92, 'application/pdf', '2021-10-30 17:11:01', 'admin'),
(14, 4, 'DOKUMEN', 'DOKUMEN_4_20211031175527.pdf', 2349, 'application/pdf', '2021-10-31 17:55:28', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(10) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `mata_anggaran` varchar(100) NOT NULL,
  `pelaksana_kegiatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `tgl_kegiatan`, `tgl_akhir`, `lokasi`, `mata_anggaran`, `pelaksana_kegiatan`) VALUES
(5, 'tes', '2021-11-02', '2021-11-03', 'r', 't', 't'),
(6, 'tes2', '2021-11-03', '2021-11-05', 'df', 'f', 'f');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id_upload` int(10) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `nm_file` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id_upload`, `id_kegiatan`, `nm_file`, `file`, `ukuran`, `jenis`, `tgl`, `user`) VALUES
(4, 2, 'Foto', 'Foto_2_20211017073154.jpg', 342, 'image/jpeg', '2021-10-17 07:31:55', 'admin'),
(5, 2, 'Foto foto', 'Foto_foto_2_20211017073255.png', 869, 'image/png', '2021-10-17 07:32:55', 'admin'),
(7, 2, 'Dokumen Baru', 'Dokumen_Baru_2_20211017073725.pdf', 1528, 'application/pdf', '2021-10-17 07:37:25', 'admin'),
(8, 2, 'Foto', 'Foto_2_20211017074438.png', 1048, 'image/png', '2021-10-17 07:44:38', 'admin'),
(9, 2, 'Coba upload', 'Coba_upload_2_20211022082158.pdf', 77, 'application/pdf', '2021-10-22 08:21:59', 'admin'),
(13, 3, 'hayolah', 'hayolah_3_20211030170048.pdf', 677, 'application/pdf', '2021-10-30 17:00:48', 'admin'),
(14, 3, 'ddd', 'ddd_3_20211030170058.pdf', 725, 'application/pdf', '2021-10-30 17:00:58', 'admin'),
(15, 3, 'tes', 'tes_3_20211102094716.pdf', 2770, 'application/pdf', '2021-11-02 09:47:27', 'admin'),
(16, 6, 'tt', 'tt_6_20211102095039.pdf', 1528, 'application/pdf', '2021-11-02 09:50:39', 'admin'),
(17, 6, 'fff', 'fff_6_20211102095455.pdf', 1528, 'application/pdf', '2021-11-02 09:54:55', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id_inbox`);

--
-- Indexes for table `inboxfile`
--
ALTER TABLE `inboxfile`
  ADD PRIMARY KEY (`id_inboxfile`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id_upload`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id_inbox` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `inboxfile`
--
ALTER TABLE `inboxfile`
  MODIFY `id_inboxfile` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id_upload` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
