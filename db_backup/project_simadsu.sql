-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2023 pada 03.59
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_simadsu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `id` int(11) NOT NULL,
  `id_surat_masuk` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `tanggal_disposisi` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `dikembalikan` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `tindakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id`, `id_surat_masuk`, `tujuan`, `tanggal_disposisi`, `isi`, `dikembalikan`, `status`, `tindakan`) VALUES
(5, 1, 6, '2023-06-06', '<p>TEST</p>\r\n', 'BAGIAN UMUM DAN TATA USAHA', 1, 'Arsip Saja');

--
-- Trigger `disposisi`
--
DELIMITER $$
CREATE TRIGGER `kurang_SM` AFTER DELETE ON `disposisi` FOR EACH ROW BEGIN
UPDATE surat_masuk SET total_disposisi = total_disposisi-1
WHERE id = OLD.id_surat_masuk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_SM` AFTER INSERT ON `disposisi` FOR EACH ROW BEGIN
UPDATE surat_masuk SET total_disposisi = total_disposisi+1
WHERE id = NEW.id_surat_masuk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `site_config`
--

CREATE TABLE `site_config` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `header` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `site_config`
--

INSERT INTO `site_config` (`id`, `site_name`, `logo`, `header`, `alamat`) VALUES
(1, 'SISTEM INFORMASI MANAJEMENT ARSIP DIGITAL & SURAT FHUP', 'logo1.png', '<p style=\"margin-left:144px\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:18.0pt\"><img alt=\"\" src=\"http://localhost/surat2/assets/img/logo/logo1.png\" style=\"height:52px; width:54px\" />&nbsp; &nbsp; &nbsp;FAKULTAS HUKUM UNIVERSITAS PANCASILA&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></strong></span></span></p>\r\n\r\n<p style=\"margin-left:144px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:144px\">&nbsp;</p>\r\n', '<p>Jl. Buku Dikrama No.30, RT.5/RW.5, Srengseng Sawah, Kec. Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12640</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `id_surat_masuk` int(11) DEFAULT NULL,
  `no_surat` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `perihal` varchar(255) NOT NULL,
  `tanggal_surat` varchar(50) NOT NULL,
  `tujuan_surat` varchar(255) NOT NULL,
  `asal_surat` varchar(150) NOT NULL,
  `isi` text NOT NULL,
  `pemohon` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_agenda` float NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `pengelola` varchar(100) NOT NULL,
  `tanggal_dibuat` varchar(50) NOT NULL,
  `sifat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `perihal` varchar(255) NOT NULL,
  `sifat` varchar(255) NOT NULL,
  `tanggal_surat` varchar(50) NOT NULL,
  `tujuan_surat` varchar(100) NOT NULL,
  `asal_surat` varchar(100) NOT NULL,
  `isi_surat` text,
  `tanggal_diterima` varchar(50) NOT NULL,
  `no_agenda` float NOT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `alamat_pengirim` text,
  `total_disposisi` float NOT NULL,
  `akses_arsip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `no_surat`, `file`, `perihal`, `sifat`, `tanggal_surat`, `tujuan_surat`, `asal_surat`, `isi_surat`, `tanggal_diterima`, `no_agenda`, `nama_pengirim`, `alamat_pengirim`, `total_disposisi`, `akses_arsip`) VALUES
(1, 'XXX', '(Sampel)_Cara_Membuat_Kop_Surat_Di_Word_(1).docx', 'XXX', 'Rahasia', '2022-02-23', '6', 'Umum', '<p>PEMINJAMAN RUANGAN</p>\r\n', '2023-06-06', 1, 'RETORIKA', 'UP', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Administrator', 'admin@admin.com', 'avatar5.png', '$2y$10$11NNpwpaUGC/.i5NDNK6fO9yI4vEZyiiIHz/6nMpVcFPZoCK5y.rS', 1, 1, 1574863801),
(2, 'Dekan', 'dekan@fhup.com', 'avatar.png', '$2y$10$sXVGm25ICe1wcewulSeD5.SrQYBu7ioqS9lT4VgQmtHwz4HvJlm56', 2, 1, 1685693351),
(3, 'Wakil Dekan 1', 'wadek1@fhup.com', 'avatar.png', '$2y$10$l.fB8xPigGo87AiDauereeKsTe6VqaOgnIXSBLsWeN.DxbD8UyfE.', 3, 1, 1685693581),
(4, 'Kepala Bagian Akademik FHUP', 'kabagakademik@fhup.com', 'avatar.png', '$2y$10$l.fB8xPigGo87AiDauereeKsTe6VqaOgnIXSBLsWeN.DxbD8UyfE.', 4, 1, 1685693731),
(5, 'Bagian Umum dan Tata Usaha', 'bagianumum@fhup.com', 'avatar.png', '$2y$10$OTImZXcM7L90u98eSrwjje72WxLPwDAU7KeT6tB6v2yomyZ/7t0kK', 5, 1, 1685694246),
(6, 'Wakil Dekan 2', 'wadek2@fhup.com', 'avatar.png', '$2y$10$voGrtdErMBX4PXUZQ.YmqukBzKst/veNjCXeJF7cqKAvC8SKFFVu.', 6, 1, 1685966708),
(7, 'Wakil Dekan 3', 'wadek3@fhup.com', 'avatar.png', '$2y$10$fE6OdYfckP.s82/ysan5POq50uRoetN10w3PgQZaHxGG/iA0pYU6a', 7, 1, 1685966745),
(8, 'Kabag Kemahasiswaan', 'kabagkemahasiswaan@fhup.com', 'avatar.png', '$2y$10$UY4.fzyHj2wCw5zrLfTbOOoVURpnVGUjQ2BjlXHwvaQ9P.kIijzRi', 8, 1, 1685966797),
(9, 'Kabag Umum', 'kabagumum@fhup.com', 'avatar.png', '$2y$10$bjAm29urH6/BGXNbKXMey.hlOxn/0Vgf.J.NMt8.qzU.uCkhnwdKC', 9, 1, 1685966826),
(10, 'Bendahara', 'bendahara@fhup.com', 'avatar.png', '$2y$10$4kbLyBalmqEaiwJLxwyI9.tE0EXOddIbfBtCeHFeZHDYfPgcfgKba', 10, 1, 1685966849),
(11, 'Sekretaris 1', 'sekretaris1@fhup.com', 'avatar.png', '$2y$10$QFAyTrMSKqq37qMhzKFsfesCd4hVE6D3WwZDsIe1lzjr6ZcXSO7Wi', 11, 1, 1685966870),
(12, 'Sekretaris 2', 'sekretaris2@fhup.com', 'avatar.png', '$2y$10$PO30hDyAmY0Nbl9.r69yQ.ORf3yk7my4QJ/9jsIVzs3qsm1TgG.7S', 12, 1, 1685966896),
(13, 'Kasubag 1 Akademik', 'kasubag1akademik@fhup.com', 'avatar.png', '$2y$10$jfVFbH06iFt.6n1hX77UDefMFe0iYgaVAv0eyGcaYNfDpkktQGkS6', 13, 1, 1685966931),
(14, 'Kasubag 2 Akademik', 'kasubag2akademik@fhup.com', 'avatar.png', '$2y$10$F0Cc2kmzMK9VsMRo.0egoeZikIUjaiEsxJeax.IGFFJuHZ.zRw7hy', 14, 1, 1685966949),
(15, 'Kasubag 1 Umum', 'kasubag1umum@fhup.com', 'avatar.png', '$2y$10$BF4K/Aof.Ayqc6i5R/qTOuaxjQSQWcR8dcbTyBcI4lu5a7.k0pOFi', 15, 1, 1685966988),
(16, 'Humas', 'humas@fhup.com', 'avatar.png', '$2y$10$pRnTTb8xthVgYPgwTOeN6uU54SWV1pnhRuamPGEDZttiC/7P7akde', 16, 1, 1685967008),
(17, 'Kasubag 1 SDM', 'kasubag1sdm@fhup.com', 'avatar.png', '$2y$10$IuvvLLgoqTmN9a7L1vBtSu7qhImxADzBn2F3z3M62Wi4AfP71L8Sq', 17, 1, 1685967029),
(18, 'Kasubag 2 SDM', 'kasubag2sdm@fhup.com', 'avatar.png', '$2y$10$cRngXrnrZvl.U7fu/5MpU.tEXND9cKIJLE/FwVIwTor.qaQ2.fAdm', 18, 1, 1685967049),
(19, 'Kepala INFOLAHTA', 'pulahta@fhup.com', 'avatar.png', '$2y$10$bWsXzVCZsUDINeUAKKPmA.ssM8TRltED2UzVz2BWVdyN4rC12nbja', 19, 1, 1685967075),
(20, 'Kasubag 1 Keuangan', 'kasubag1keuangan@fhup.com', 'avatar.png', '$2y$10$LPFHfGE48SSdUiT4K02uH.eWuoYazvNV9QHslRHlJPdbSTuuEJAri', 20, 1, 1685967096),
(21, 'Kasubag 1 Kemahasiswaan', 'kasubag1kemahasiswaan@fhup.com', 'avatar.png', '$2y$10$EAq5OXep5r61ih/r2U0izOwJZ47bMVcdTQpEaqLeQaXmUUZK8n.7i', 21, 1, 1685967120);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 1, 4),
(9, 1, 14),
(10, 4, 2),
(12, 4, 14),
(13, 3, 15),
(14, 1, 15),
(15, 4, 15),
(16, 1, 16),
(19, 2, 16),
(21, 3, 17),
(22, 4, 17),
(23, 1, 17),
(25, 1, 11),
(26, 3, 19),
(27, 1, 19),
(28, 6, 2),
(29, 1, 20),
(30, 3, 20),
(31, 3, 21),
(32, 1, 21),
(33, 7, 2),
(34, 1, 22),
(35, 7, 22),
(36, 7, 23),
(37, 1, 23),
(38, 1, 24),
(39, 1, 25),
(40, 7, 24),
(41, 7, 25),
(42, 7, 26),
(43, 1, 26),
(44, 8, 2),
(45, 8, 25),
(46, 8, 24),
(47, 1, 5),
(48, 4, 5),
(50, 5, 2),
(51, 1, 6),
(52, 4, 6),
(53, 1, 7),
(54, 1, 8),
(55, 1, 9),
(56, 4, 9),
(57, 4, 8),
(58, 1, 10),
(59, 2, 10),
(60, 2, 8),
(61, 3, 10),
(62, 3, 8),
(63, 5, 10),
(64, 5, 8),
(65, 6, 10),
(66, 6, 8),
(67, 7, 10),
(68, 7, 8),
(69, 8, 8),
(70, 8, 10),
(71, 9, 2),
(72, 9, 10),
(73, 9, 8),
(74, 4, 7),
(75, 4, 10),
(76, 2, 5),
(77, 2, 6),
(78, 2, 7),
(79, 2, 9),
(80, 3, 5),
(81, 3, 6),
(82, 3, 7),
(83, 3, 9),
(84, 3, 2),
(85, 10, 2),
(86, 10, 5),
(87, 10, 7),
(88, 10, 8),
(89, 10, 9),
(90, 10, 10),
(91, 11, 2),
(93, 11, 5),
(95, 11, 7),
(96, 11, 8),
(97, 11, 9),
(98, 11, 10),
(99, 12, 2),
(101, 12, 5),
(103, 12, 7),
(104, 12, 8),
(105, 12, 9),
(106, 12, 10),
(108, 13, 2),
(110, 13, 5),
(111, 13, 7),
(112, 13, 8),
(113, 13, 9),
(114, 13, 10),
(115, 14, 2),
(117, 14, 5),
(119, 14, 7),
(120, 14, 8),
(121, 14, 9),
(122, 14, 10),
(123, 16, 2),
(125, 16, 5),
(126, 16, 7),
(127, 16, 8),
(128, 16, 9),
(129, 16, 10),
(130, 17, 2),
(132, 17, 5),
(133, 17, 7),
(134, 17, 8),
(135, 17, 9),
(136, 17, 10),
(137, 18, 2),
(139, 18, 5),
(140, 18, 7),
(141, 18, 8),
(142, 18, 9),
(143, 18, 10),
(144, 19, 2),
(148, 19, 7),
(151, 19, 10),
(152, 20, 2),
(154, 20, 5),
(155, 20, 7),
(156, 20, 8),
(157, 20, 9),
(158, 20, 10),
(159, 21, 2),
(161, 21, 5),
(162, 21, 7),
(163, 21, 8),
(164, 21, 9),
(165, 21, 10),
(166, 22, 2),
(167, 22, 4),
(168, 22, 5),
(169, 22, 7),
(170, 22, 8),
(171, 22, 9),
(172, 22, 10),
(173, 23, 2),
(174, 23, 4),
(175, 23, 5),
(176, 23, 7),
(177, 23, 8),
(178, 23, 9),
(179, 23, 10),
(180, 24, 2),
(181, 24, 4),
(182, 24, 3),
(183, 24, 5),
(184, 24, 7),
(185, 24, 8),
(186, 24, 9),
(187, 24, 10),
(188, 25, 2),
(190, 25, 4),
(191, 25, 5),
(192, 25, 7),
(193, 25, 8),
(194, 25, 9),
(195, 25, 10),
(196, 26, 2),
(197, 26, 4),
(198, 26, 5),
(199, 26, 7),
(200, 26, 8),
(201, 26, 9),
(202, 26, 10),
(203, 15, 2),
(204, 15, 8),
(206, 15, 5),
(208, 15, 7),
(209, 15, 9),
(210, 15, 10),
(212, 5, 5),
(214, 5, 7),
(215, 5, 9),
(217, 6, 5),
(218, 6, 6),
(219, 6, 7),
(220, 6, 9),
(221, 7, 5),
(222, 7, 6),
(223, 7, 7),
(224, 7, 9),
(225, 8, 5),
(226, 8, 6),
(227, 8, 7),
(228, 8, 9),
(229, 9, 5),
(230, 9, 6),
(231, 9, 7),
(232, 9, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `font` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `font`) VALUES
(1, 'Admin', 'ti-linux'),
(2, 'User', 'ti-user'),
(3, 'Menu', 'ti-layers-alt'),
(4, 'Setting', 'ti-settings'),
(5, 'Surat Masuk', 'ti-agenda'),
(6, 'Disposisi', 'fa fa-send'),
(7, 'Surat Keluar', 'ti-agenda'),
(8, 'Arsip Digital', 'ti-microsoft-alt'),
(9, 'Buku Agenda', 'ti-agenda'),
(10, 'Inbox', 'ti-email');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Dekan'),
(3, 'Wakil Dekan 1'),
(4, 'Kabag Akademik'),
(5, 'Bagian Umum'),
(6, 'Wakil Dekan 2'),
(7, 'Wakil Dekan 3'),
(8, 'Kabag Kemahasiswaan'),
(9, 'Kabag Umum'),
(10, 'Bendahara'),
(11, 'Sekretaris 1'),
(12, 'Sekretaris 2'),
(13, 'Kasubag 1 Akademik'),
(14, 'Kasubag 2 Akademik'),
(15, 'Kasubag 1 Umum'),
(16, 'Kasubag Humas'),
(17, 'Kasubag 1 SDM'),
(18, 'Kasubag 2 SDM'),
(19, 'Ka. Unit Infolahta'),
(20, 'Kasubag 1 Keuangan'),
(21, 'Kasubag 1 Kemahasiswaan ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`, `sort`) VALUES
(1, 1, 'Control Panel', 'admin', 'fa fa-tachometer', 1, 1),
(2, 2, 'My Profile', 'user', 'fa fa-id-card', 1, 6),
(3, 2, 'Edit Profile', 'user/edit', 'ti-user', 1, 7),
(4, 3, 'Menu Management', 'menu', 'fa fa-folder', 1, 2),
(5, 3, 'Submenu Management', 'menu/submenu', 'fa fa-folder-open', 1, 3),
(6, 1, 'Role', 'admin/role', 'ti-key', 1, 4),
(7, 2, 'Change Password', 'user/changepassword', 'fa fa-key', 1, 8),
(8, 1, 'User Account', 'admin/account', 'fa fa-microchip', 1, 5),
(11, 3, 'Sort Menu', 'menu/sort', 'fa fa-window-restore', 1, 9),
(62, 3, 'Font Awesome', 'admin/fa', 'fa fa-font-awesome', 1, 11),
(63, 3, 'Themify Icons', 'admin/ti', 'ti-themify-logo', 1, 12),
(72, 2, 'Dashboard', 'user/dashboard', 'fa fa-tachometer', 1, 10),
(74, 4, 'Site Config', 'site_config', 'fa fa-cog', 1, 13),
(75, 5, 'Data Surat Masuk', 'surat_masuk', 'ti-bookmark-alt', 1, 14),
(76, 5, 'Tambah Surat Masuk', 'surat_masuk/tambah', 'ti-write', 1, 15),
(77, 8, 'Surat Masuk', 'surat_masuk/ad', 'ti-file', 1, 16),
(78, 10, 'Surat Masuk', 'inbox', 'ti-email', 1, 17),
(79, 10, 'Disposisi', 'inbox/disposisi', 'ti-email', 1, 18),
(80, 6, 'Data Disposisi', 'disposisi', 'ti-write', 1, 19),
(81, 7, 'Tambah Surat Keluar', 'surat_keluar/tambah', 'fa fa-edit', 1, 20),
(82, 7, 'Data Surat Keluar', 'surat_keluar', 'fa fa-book', 1, 21),
(83, 9, 'Agenda Surat Masuk', 'agenda_sm', 'fa fa-calendar', 1, 22),
(84, 9, 'Agenda Surat Keluar', 'agenda_sk', 'fa fa-calendar', 1, 23),
(85, 8, 'Surat Keluar', 'surat_keluar/ad', 'ti-file', 1, 24);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_surat_masuk` (`id_surat_masuk`);

--
-- Indeks untuk tabel `site_config`
--
ALTER TABLE `site_config`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `site_config`
--
ALTER TABLE `site_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`id_surat_masuk`) REFERENCES `surat_masuk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
