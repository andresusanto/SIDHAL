-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2015 at 04:59 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sidhal`
--

-- --------------------------------------------------------

--
-- Table structure for table `instansis`
--

CREATE TABLE IF NOT EXISTS `instansis` (
  `id` int(10) unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `instansis`
--

INSERT INTO `instansis` (`id`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Polhukam', 'Jalan Merdeka Barat 15', '2015-07-04 07:34:30', '2015-07-04 07:34:30'),
(2, 'Kominfo', 'Jalan Medan Merdeka Barat 10', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kehadirans`
--

CREATE TABLE IF NOT EXISTS `kehadirans` (
  `rapat_id` int(10) unsigned NOT NULL,
  `pejabat_id` int(10) unsigned NOT NULL,
  `hadir` tinyint(1) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kehadirans`
--

INSERT INTO `kehadirans` (`rapat_id`, `pejabat_id`, `hadir`, `keterangan`) VALUES
(0, 1, 0, ' '),
(0, 2, 1, 'asdsadsa'),
(1, 23, 1, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_06_09_062544_create_rapats_table', 1),
('2015_06_09_074144_create_pejabats_table', 1),
('2015_06_13_082708_create_kehadirans_table', 1),
('2015_06_17_045357_create_undangans_table', 1),
('2015_07_03_063744_create_instansis_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pejabats`
--

CREATE TABLE IF NOT EXISTS `pejabats` (
  `id` int(10) unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instansi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pejabats`
--

INSERT INTO `pejabats` (`id`, `nama`, `jabatan`, `instansi`, `alamat`, `telepon`, `email`) VALUES
(21, 'Aryya', 'Aryya', 'Kominfo', 'sdads,dasdsa,dsadas', '321', 'Aryya@polkam.go.id'),
(24, 'Sudib', 'Sudib', 'Kominfo', 'dasdsa', '3213', 'dasdsadsa@dasdsa.com'),
(25, 'Andre', 'Omah', 'Polhukam', 'dsadas', '0', 'andre@dsa.com');

-- --------------------------------------------------------

--
-- Table structure for table `pejabat_rapat`
--

CREATE TABLE IF NOT EXISTS `pejabat_rapat` (
  `pejabat_id` int(10) unsigned NOT NULL,
  `rapat_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rapats`
--

CREATE TABLE IF NOT EXISTS `rapats` (
  `id` int(10) unsigned NOT NULL,
  `jenis_rapat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `waktu` datetime NOT NULL,
  `tempat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pembahasan` text COLLATE utf8_unicode_ci NOT NULL,
  `pimpinan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rapats`
--

INSERT INTO `rapats` (`id`, `jenis_rapat`, `waktu`, `tempat`, `pembahasan`, `pimpinan`, `created_at`, `updated_at`) VALUES
(1, '123', '2015-06-09 00:30:00', 'Merdeka Selatan', 'Pembahasan definisi 123', 'Andre Susdulu', '2015-06-17 21:00:39', '2015-06-17 21:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `undangans`
--

CREATE TABLE IF NOT EXISTS `undangans` (
  `rapat_id` int(10) unsigned NOT NULL,
  `tipe` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Andre Susanto', 'andre@polkam.go.id', '$2y$10$zR1rIbpsqDgkR8NRfpuSpO.e7OeK217J10JKxT6IUjWk.dF97tkl6', 'k94tpJLHgG0EBjYJt3fXr8RdkKn2I7lZCSHxP3uTo0asag0uyEeGcxLAZ13H', '2015-06-17 20:26:13', '2015-06-17 23:56:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instansis`
--
ALTER TABLE `instansis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pejabats`
--
ALTER TABLE `pejabats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rapats`
--
ALTER TABLE `rapats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instansis`
--
ALTER TABLE `instansis`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pejabats`
--
ALTER TABLE `pejabats`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `rapats`
--
ALTER TABLE `rapats`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
