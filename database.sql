-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2014 at 11:48 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_reservasi_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `type` enum('admin','operator') NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `type`) VALUES
(8, 'operator', '81dc9bdb52d04dc20036dbd8313ed055', 'Operator', 'operator'),
(9, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Veny', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(30) NOT NULL,
  `isi` text,
  `id_kategori` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `path_gambar` varchar(100) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `waktu_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FKartikel800515` (`id_kategori`),
  KEY `FKartikel714814` (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `isi`, `id_kategori`, `id_admin`, `path_gambar`, `is_published`, `waktu_post`) VALUES
(1, 'Cara Pemesanan', '<p>asdmla;sdas saldnlaskd sadlknalsdsa</p>', 1, NULL, 'upload/artikel/7196_10200918047986389_1441636755_n.jpg', 1, '2013-08-15 06:48:03'),
(2, 'Tentang Kita', '<p>lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;lorem ipsum dolor sit amaet&nbsp;</p>', 1, NULL, 'upload/artikel/Logo UGM.png', 1, '2013-08-19 14:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(20) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `no_rekening` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`, `atas_nama`, `no_rekening`, `gambar`) VALUES
(1, 'BNI', 'Veny', '88721321344', 'upload/gambar_bank/bni.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE IF NOT EXISTS `checkin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_pengunjung` int(11) NOT NULL,
  `status` enum('pending','approved','unapproved') NOT NULL DEFAULT 'pending',
  `booked_via` enum('online','offline') NOT NULL DEFAULT 'online',
  `jumlah_poin` int(11) DEFAULT NULL,
  `nilai_poin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `waktu` (`waktu`,`id_pengunjung`),
  KEY `id_pengunjung` (`id_pengunjung`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `waktu`, `id_pengunjung`, `status`, `booked_via`, `jumlah_poin`, `nilai_poin`) VALUES
(17, '2013-12-20 13:22:03', 2, 'approved', 'offline', NULL, 0),
(18, '2013-12-20 22:35:24', 3, 'approved', 'offline', NULL, 0),
(19, '2014-01-19 02:45:08', 5, 'approved', 'online', 1, 20000),
(20, '2014-03-18 02:59:32', 3, 'approved', 'offline', NULL, 0),
(21, '2014-03-19 00:48:05', 5, 'approved', 'online', NULL, 0),
(22, '2014-03-19 02:29:57', 5, 'approved', 'online', NULL, 0),
(23, '2014-03-19 02:34:52', 5, 'approved', 'online', NULL, 0),
(24, '2014-03-19 02:40:10', 5, 'approved', 'online', NULL, 0),
(25, '2014-03-19 02:41:37', 5, 'approved', 'online', NULL, 0),
(26, '2014-03-19 02:44:21', 5, 'approved', 'online', NULL, 0),
(29, '2014-03-25 22:55:42', 5, 'pending', 'online', 1, 20000),
(30, '2014-03-25 22:59:37', 5, 'pending', 'online', NULL, 20000),
(31, '2014-03-26 22:03:11', 5, 'approved', 'online', 1, 20000),
(32, '2014-06-22 04:55:36', 14, 'pending', 'online', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_checkin`
--

CREATE TABLE IF NOT EXISTS `detail_checkin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_kamar` int(10) DEFAULT NULL,
  `masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keluar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `biaya` int(10) DEFAULT NULL,
  `id_pengunjung` int(10) DEFAULT NULL,
  `jumlah_point_dipakai` int(10) DEFAULT NULL,
  `id_checkin` int(11) DEFAULT NULL,
  `waktu_mengambil_kunci` timestamp NULL DEFAULT NULL,
  `waktu_mengembalikan_kunci` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcheckin262281` (`id_kamar`),
  KEY `FKcheckin849036` (`id_pengunjung`),
  KEY `id_checkin` (`id_checkin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `detail_checkin`
--

INSERT INTO `detail_checkin` (`id`, `id_kamar`, `masuk`, `keluar`, `biaya`, `id_pengunjung`, `jumlah_point_dipakai`, `id_checkin`, `waktu_mengambil_kunci`, `waktu_mengembalikan_kunci`) VALUES
(29, 2, '2013-12-19 23:00:00', '2013-12-23 03:00:00', 36667, NULL, NULL, 17, '2014-03-15 01:10:25', '2014-03-15 01:10:31'),
(30, 2, '2013-12-23 03:00:00', '2013-12-26 01:00:00', 39167, NULL, NULL, 18, '2014-03-15 00:08:05', '2014-03-15 00:09:37'),
(31, 2, '2014-01-27 17:00:00', '2014-01-29 17:00:00', 5000, 5, NULL, 19, '2014-03-15 00:22:35', '2014-03-15 00:22:39'),
(32, 1, '2014-03-18 15:00:00', '2014-03-26 05:00:00', 80000, 5, NULL, 20, NULL, NULL),
(35, 2, '2014-03-18 15:00:00', '2014-03-19 15:00:00', 15000, NULL, NULL, NULL, NULL, NULL),
(37, 2, '2014-03-19 15:00:00', '2014-03-27 15:00:00', 80000, 5, NULL, 21, NULL, NULL),
(39, 1, '2014-03-28 15:00:00', '2014-03-31 15:00:00', 30000, 5, NULL, 22, NULL, NULL),
(40, 1, '2014-04-01 15:00:00', '2014-04-05 15:00:00', 40000, 5, NULL, 23, NULL, NULL),
(41, 2, '2014-03-28 15:00:00', '2014-03-31 15:00:00', 30000, 5, NULL, 24, NULL, NULL),
(42, 2, '2014-04-01 15:00:00', '2014-04-03 15:00:00', 20000, 5, NULL, 25, NULL, NULL),
(43, 2, '2014-04-09 15:00:00', '2014-05-12 15:00:00', 330000, 5, NULL, 26, NULL, NULL),
(46, 1, '2014-04-19 15:00:00', '2014-04-21 15:00:00', 20000, 5, NULL, 29, NULL, NULL),
(48, 1, '2014-04-23 15:00:00', '2014-04-25 15:00:00', 20000, 5, NULL, 30, NULL, NULL),
(49, 3, '2014-04-29 15:00:00', '2014-04-30 15:00:00', 10000, 5, NULL, 31, NULL, NULL),
(50, 4, '2014-05-01 15:00:00', '2014-05-03 15:00:00', 20000, 5, NULL, 31, NULL, NULL),
(51, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 14, NULL, 32, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE IF NOT EXISTS `fasilitas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL,
  `id_kategori` int(10) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKfasilitas910721` (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`, `keterangan`, `harga`, `id_kategori`, `gambar`) VALUES
(1, 'Paket Makan Siang 1', 'lorem ipsum dolor sit amet', 20000, 1, 'upload/gambar_fasilitas/makan.jpg'),
(2, 'Jemput di bandara', 'z,xcnl,c', 10000, 2, 'upload/gambar_fasilitas/makan2.jpg'),
(3, 'Rendang ', 'asldl', 1000, 1, 'upload/gambar_fasilitas/makan3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_pengunjung`
--

CREATE TABLE IF NOT EXISTS `fasilitas_pengunjung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fasilitas` int(10) NOT NULL,
  `id_checkin` int(10) NOT NULL,
  `biaya` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FKfasilitas_91676` (`id_fasilitas`),
  KEY `FKfasilitas_730432` (`id_checkin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE IF NOT EXISTS `kamar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKkamar1636` (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `id_kelas`, `nama`, `keterangan`) VALUES
(1, 1, 'Kamar I', 'asdmas;ldas sa.dsad'),
(2, 1, 'Kamar 02', 'as;ld;lasd sadasndklkasd'),
(3, 1, 'aslkdlad', 'asdasd'),
(4, 1, 'asljasd', 'as;dssad'),
(5, 1, 'as;dls;ad', 'asdasdd'),
(6, 1, 'sadsad', 'asdd');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_artikel`
--

CREATE TABLE IF NOT EXISTS `kategori_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori_artikel`
--

INSERT INTO `kategori_artikel` (`id`, `nama`) VALUES
(1, 'Dont Remove'),
(2, 'Hidup Sehat'),
(3, 'Wisata Pacitan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_fasilitas`
--

CREATE TABLE IF NOT EXISTS `kategori_fasilitas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kategori_fasilitas`
--

INSERT INTO `kategori_fasilitas` (`id`, `nama`) VALUES
(1, 'Paket Makan'),
(2, 'Transportasi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) DEFAULT NULL,
  `biaya_per_hari` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `star` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `biaya_per_hari`, `gambar`, `star`) VALUES
(1, 'I', 10000, 'upload/gambar_kamar/hotel.jpg', 4),
(2, 'II', 230000, 'upload/gambar_kamar/images (2).jpg', 2),
(3, 'II', 20000, 'upload/gambar_kamar/images (3).jpg', 1),
(4, 'VIP', 500000, 'upload/gambar_kamar/hotel2.jpg', 0),
(6, 'VIP I', 20000, 'upload/gambar_kamar/hotel3.jpg', 0),
(7, 'Ruang Rapat', 100000, 'upload/gambar_kamar/hotel4.jpg', 0),
(8, NULL, 0, 'upload/gambar_kamar/05102013_1380939670_', 0),
(9, NULL, 0, 'upload/gambar_kamar/05102013_1380939695_', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kritik`
--

CREATE TABLE IF NOT EXISTS `kritik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `saran` varchar(255) NOT NULL,
  `kritik` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_member` (`id_member`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kritik`
--

INSERT INTO `kritik` (`id`, `id_member`, `saran`, `kritik`) VALUES
(1, 14, ';lcs', 'klasjdas'),
(2, 14, 'kk', 'kk');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id_pengunjung` int(10) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL COMMENT '                       ',
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `FKmember763613` (`id_pengunjung`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_pengunjung`, `username`, `password`, `email`) VALUES
(1, 'tri', '81dc9bdb52d04dc20036dbd8313ed055', 'endi_tc@yahoo.co.id'),
(3, 'siti', '81dc9bdb52d04dc20036dbd8313ed055', 'fenditricahyono@gmail.com'),
(5, 'amy', '81dc9bdb52d04dc20036dbd8313ed055', 'endytc@gmail.com'),
(6, 'joehart', 'grahaprima', 'endi@addd.com'),
(8, 'sadlas;', '6ee3d9e668af020e1a9a5377cf426d0f', ';lasdksa'),
(11, 'admin', '6ee3d9e668af020e1a9a5377cf426d0f', 'asd@asd.com'),
(13, 'adminsadasd', '6ee3d9e668af020e1a9a5377cf426d0f', 'sakdljdas@asd.com'),
(14, 'amyyyyyyy', '81dc9bdb52d04dc20036dbd8313ed055', 'amy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_checkin` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_bank` (`id_bank`),
  KEY `id_checkin` (`id_checkin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_checkin`, `nominal`, `keterangan`, `gambar`, `id_bank`) VALUES
(16, 17, 35833, 'sadas', NULL, NULL),
(17, 18, 39167, 'asdsad', NULL, NULL),
(18, 21, 80000, 'sakdasd', 'upload/gambar_bukti_transfer/Selection_008.png', 1),
(19, 31, 5000, 'asldasdasd', NULL, 1),
(20, 31, 5000, 'asddsa', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE IF NOT EXISTS `pengunjung` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `tanda_pengenal` varchar(10) DEFAULT NULL,
  `no_tanda_pengenal` varchar(20) DEFAULT NULL COMMENT '                       ',
  `no_hp` varchar(15) DEFAULT NULL,
  `jumlah_poin` int(10) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `anak` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id`, `nama`, `alamat`, `tanda_pengenal`, `no_tanda_pengenal`, `no_hp`, `jumlah_poin`, `status`, `pekerjaan`, `anak`) VALUES
(1, 'Tri', 'sa.ndlsad askd;la', 'KTP', '0982372384', '1234', 0, '', '', 0),
(2, 'ROni Mahindra', NULL, '1231231', '1212312', '1233123', 0, '', '', 0),
(3, 'Siti Aminah', 'donorojo', 'KTP', '123123', '12312312', 3, 'menikah', '', 0),
(4, 'Amy', 'sa.lsdflsd', 'KTP', 'sakjlskad', '12312312', 8, 'lajang', '', 0),
(5, 'Amy', 'sa.lsdflsd', 'KTP', 'sakjlskad', '12312312', 38, '', '', 0),
(6, 'tes', 'asbdabd', 'KTP', 'kjsadk', 'kjandas', 0, '', '', 0),
(7, 'as;dl', ';lask;d', ';lkas;dl', ';lkas;d', ';lka;sda', 0, '', '', 0),
(8, 'as;dl', ';lask;d', ';lkas;dl', ';lkas;d', ';lka;sda', 0, '', '', 0),
(9, 'tes', 'asdkjad', 'kjkasdn', 'kjnsakjd', '1234', 0, '', '', 0),
(10, NULL, 'sa.lsdflsd', NULL, 'sakjlskad', '12312312', 0, '', '', 0),
(11, 'didit', 'asda;dm', 'ktp', ';lkas;d', ';lka;sda', 0, '', '', 0),
(12, 'as,ndsad', 'lkasld', 'lkasmkld', 'lkmlkasd', 'klmklasmd', 0, '', '', 0),
(13, 'tes', 'a.,sdmsad', ';lsadas', 'l;masd;', 'klmaslkdasd', 0, 'lajang', '', 0),
(14, 'siti aminah', 'asdkjaldas', 'KTP', '1234', '123445', 0, 'Lajang', 'koding', 3);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isi` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `judul` varchar(30) NOT NULL,
  `transaksi_min` int(11) DEFAULT NULL,
  `transaksi_max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `isi`, `waktu`, `judul`, `transaksi_min`, `transaksi_max`) VALUES
(1, '<p>sakljdkjasdnksad</p>', '2013-12-07 06:23:51', 'askjdnhkasjd', 0, 0),
(2, '<p>tes</p>', '2014-01-21 22:47:02', 'Tes', 0, 1000000),
(3, '<p><strong>sakljdlkasd asdlkjasd&nbsp;</strong>Iaskdladsa<em>kalsjdlakdlasdsa adlkalkdnasdsad</em></p>', '2014-01-21 22:58:42', 'tes', 0, 200000000),
(4, '<p>ksladjadsad</p>', '2014-01-21 23:01:53', 'askldasd', 0, 300000000),
(5, '<p><strong>kasdlkamdas klsa;djklasdjlaskdsa</strong></p>', '2014-01-21 23:04:04', 'tes', 0, 300000000),
(6, '<p>tos</p>', '2014-01-21 23:04:58', 'tes', 0, 3000000),
(7, '<p>l;kasjdasd</p>', '2014-01-21 23:30:02', 'skldasld', 10000, NULL),
(8, '<p>asdknalsd</p>', '2014-01-21 23:30:27', 'tes', NULL, 1000000),
(9, '<p>alksdasdas</p>', '2014-01-21 23:31:21', 'alksdjalkda', NULL, NULL),
(10, '<p>as;ldkasd</p>', '2014-06-22 05:24:55', 'asmdlsakd', 1000, 10000000),
(11, '<p>loadasd</p>', '2014-06-22 05:29:01', 'asmdlsakd', 0, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `promo_pengunjung`
--

CREATE TABLE IF NOT EXISTS `promo_pengunjung` (
  `id_pengunjung` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  PRIMARY KEY (`id_pengunjung`,`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo_pengunjung`
--

INSERT INTO `promo_pengunjung` (`id_pengunjung`, `id_promo`) VALUES
(1, 1),
(1, 2),
(1, 9),
(3, 2),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(5, 2),
(5, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `kd` varchar(10) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `isi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`kd`, `keterangan`, `isi`) VALUES
('min_dp', 'Minimal DP (%)', '50'),
('nilai_poin', 'Nilai Poin', '20000'),
('min_poin', 'Milimal Poin', '20000'),
('max_poin', 'maximal pemakaian poin', '2'),
('minpromo', 'Minimal jumlah transaksi membe', '400000');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `FKartikel714814` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FKartikel800515` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_artikel` (`id`);

--
-- Constraints for table `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `checkin_ibfk_1` FOREIGN KEY (`id_pengunjung`) REFERENCES `pengunjung` (`id`);

--
-- Constraints for table `detail_checkin`
--
ALTER TABLE `detail_checkin`
  ADD CONSTRAINT `detail_checkin_ibfk_1` FOREIGN KEY (`id_checkin`) REFERENCES `checkin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKcheckin262281` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id`),
  ADD CONSTRAINT `FKcheckin849036` FOREIGN KEY (`id_pengunjung`) REFERENCES `pengunjung` (`id`);

--
-- Constraints for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD CONSTRAINT `FKfasilitas910721` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_fasilitas` (`id`);

--
-- Constraints for table `fasilitas_pengunjung`
--
ALTER TABLE `fasilitas_pengunjung`
  ADD CONSTRAINT `fasilitas_pengunjung_ibfk_1` FOREIGN KEY (`id_checkin`) REFERENCES `checkin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKfasilitas_91676` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id`);

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `FKkamar1636` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `kritik`
--
ALTER TABLE `kritik`
  ADD CONSTRAINT `kritik_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_pengunjung`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `FKmember763613` FOREIGN KEY (`id_pengunjung`) REFERENCES `pengunjung` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_checkin`) REFERENCES `checkin` (`id`) ON DELETE CASCADE;
