-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jan 2020 pada 08.50
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `created_at`, `updated_at`) VALUES
(2, 'Ayam Goreng', 15000, '2019-12-29 01:47:06', '2019-12-30 14:34:21'),
(6, 'Bakso', 12000, '2019-12-29 02:41:29', '2019-12-29 03:27:46'),
(7, 'Mie Ayam', 20000, '2019-12-29 02:41:42', '2019-12-29 02:41:42'),
(8, 'Kebab', 20000, '2019-12-29 02:41:58', '2019-12-29 02:41:58'),
(9, 'Es Krim', 5000, '2019-12-29 02:42:13', '2019-12-29 02:42:13'),
(10, 'Jus Melon', 11000, '2019-12-29 02:42:45', '2019-12-29 02:42:45'),
(11, 'Hamburger', 13000, '2019-12-29 13:23:33', '2019-12-29 13:23:33'),
(12, 'Pizza', 55000, '2019-12-30 10:42:59', '2019-12-30 10:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(6) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jenis_kelamin`, `no_hp`, `alamat`) VALUES
('PLG001', 'Muhammad Zikri', 'laki-laki', '085263307063', 'Payakumbuh, Sungai Durian'),
('PLG002', 'Muhammad Ibra', 'laki-laki', '084356723456', 'Payakumbuh'),
('PLG003', 'Muhammad Zikri', 'laki-laki', '987654321', 'rtgjhfds'),
('PLG004', 'Muhammad Zikri', 'laki-laki', '1324567', 'dfgn'),
('PLG005', 'Muhammad Ibra', 'laki-laki', '4567', 'dvb'),
('PLG006', 'Muhammad Ibra', 'laki-laki', '25676', 'fd'),
('PLG007', 'Muhammad Ibra', 'laki-laki', '545', 'sdfs'),
('PLG008', 'Muhammad Zikri', 'laki-laki', '042342', 'dsds'),
('PLG009', 'Muhammad Zikri', 'laki-laki', '2345', 'dsds\r\n'),
('PLG010', 'Muhammad Ibra', 'laki-laki', '322', 'dsds'),
('PLG011', 'Muhammad Zikri', 'laki-laki', '323', 'ae'),
('PLG012', 'Muhammad Zikri', 'laki-laki', '33', 'DS'),
('PLG013', 'Muhammad Ibra', 'laki-laki', '222', 'edsd'),
('PLG014', 'Muhammad Zikri', 'laki-laki', '33', 'sds'),
('PLG015', 'Muhammad Zikri', 'laki-laki', '111', 'SD'),
('PLG016', 'Muhammad Zikri', 'laki-laki', '22', 'ddd'),
('PLG017', 'Muhammad Zikri', 'laki-laki', '0835434', 'dsda'),
('PLG018', 'Muhammad Zikri', 'laki-laki', '11', 'sa'),
('PLG019', 'Muhammad Zikri', 'laki-laki', '11', 'dd'),
('PLG020', 'Muhammad Zikri', 'laki-laki', '1', 's'),
('PLG021', 'Muhammad Zikri', 'laki-laki', '1', 'ss'),
('PLG022', 'Muhammad Zikri', 'laki-laki', '085335', 'dsd'),
('PLG023', 'Muhammad Zikri', 'laki-laki', '321', 'dad'),
('PLG024', 'Muhammad Zikri', 'laki-laki', '211', 'fsfd'),
('PLG025', 'Muhammad Zikri', 'laki-laki', '22', 'ss'),
('PLG026', 'Muhammad Zikri', 'laki-laki', '11', '2aa'),
('PLG027', 'Muhammad Ibra', 'laki-laki', '11', 'h'),
('PLG028', 'qq', 'laki-laki', '11', 'a'),
('PLG029', 'sss', 'laki-laki', '22', '33'),
('PLG030', 'aaa', 'laki-laki', '64', 'dsds'),
('PLG031', 'Muhammad Zikri', 'laki-laki', '22', 'ss'),
('PLG032', 'zz', 'laki-laki', '444', 'aa'),
('PLG033', 'sds', 'laki-laki', '333', 'ddd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `tanggal_pesanan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_menu`, `id_pelanggan`, `jumlah`, `id_user`, `status`, `tanggal_pesanan`) VALUES
(29, 7, 'PLG001', 2, 1, '2', '2019-12-30 12:07:47'),
(30, 11, 'PLG002', 1, 1, '2', '2019-12-30 12:08:43'),
(31, 12, 'PLG003', 13, 1, '2', '2019-12-30 12:09:10'),
(32, 10, 'PLG004', 1, 1, '2', '2019-12-30 12:09:43'),
(33, 8, 'PLG005', 2, 1, '2', '2019-12-30 12:09:58'),
(34, 2, 'PLG006', 3, 1, '2', '2019-12-30 12:12:10'),
(35, 9, 'PLG007', 1, 1, '2', '2019-12-30 12:16:16'),
(36, 8, 'PLG008', 2, 1, '2', '2019-12-30 12:16:46'),
(37, 6, 'PLG009', 1, 1, '2', '2019-12-30 12:24:04'),
(38, 11, 'PLG010', 1, 1, '2', '2019-12-30 12:25:33'),
(39, 6, 'PLG011', 2, 1, '2', '2019-12-30 12:31:49'),
(40, 2, 'PLG012', 1, 1, '2', '2019-12-30 12:32:03'),
(41, 6, 'PLG013', 1, 1, '2', '2019-12-30 12:32:16'),
(42, 6, 'PLG014', 1, 1, '2', '2019-12-30 12:32:31'),
(43, 2, 'PLG015', 1, 1, '2', '2019-12-30 12:33:02'),
(44, 7, 'PLG016', 1, 1, '2', '2019-12-30 12:42:20'),
(45, 10, 'PLG017', 1, 1, '2', '2019-12-30 12:52:42'),
(46, 6, 'PLG018', 1, 1, '2', '2019-12-30 12:54:57'),
(47, 7, 'PLG019', 22, 1, '2', '2019-12-30 12:55:10'),
(48, 6, 'PLG020', 2, 1, '2', '2019-12-30 12:55:22'),
(49, 9, 'PLG021', 3, 1, '2', '2019-12-30 12:56:17'),
(50, 8, 'PLG022', 1, 1, '2', '2019-12-30 13:46:33'),
(51, 10, 'PLG023', 1, 1, '2', '2019-12-30 14:09:21'),
(52, 7, 'PLG024', 34, 1, '2', '2019-12-30 14:59:47'),
(53, 2, 'PLG025', 1, 1, '2', '2020-01-01 02:54:49'),
(54, 6, 'PLG026', 55, 1, '2', '2020-01-01 03:00:47'),
(55, 6, 'PLG027', 1, 1, '2', '2020-01-01 03:02:02'),
(56, 8, 'PLG028', 2, 1, '2', '2020-01-01 03:02:17'),
(57, 10, 'PLG029', 2, 1, '2', '2020-01-01 03:02:37'),
(58, 11, 'PLG030', 1, 1, '2', '2020-01-01 03:02:55'),
(59, 12, 'PLG031', 1, 1, '2', '2020-01-01 03:03:09'),
(60, 6, 'PLG032', 3, 1, '2', '2020-01-01 03:03:33'),
(61, 2, 'PLG033', 44, 1, '2', '2020-01-09 02:24:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(6) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pesanan`, `total`, `bayar`, `kembalian`, `created_at`) VALUES
('TNS001', 29, 40000, 50000, 10000, '2019-12-30 12:08:03'),
('TNS002', 30, 13000, 15000, 2000, '2019-12-30 12:10:28'),
('TNS003', 31, 715000, 1000000, 285000, '2019-12-30 12:10:36'),
('TNS004', 32, 11000, 20000, 9000, '2019-12-30 12:10:45'),
('TNS005', 33, 40000, 100000, 60000, '2019-12-30 12:10:54'),
('TNS006', 34, 45000, 50000, 5000, '2019-12-30 12:12:28'),
('TNS007', 35, 5000, 10000, 5000, '2019-12-30 12:17:18'),
('TNS008', 36, 40000, 50000, 10000, '2019-12-30 12:17:29'),
('TNS009', 37, 12000, 15000, 3000, '2019-12-30 12:24:46'),
('TNS010', 38, 13000, 20000, 7000, '2019-12-30 12:34:39'),
('TNS011', 39, 24000, 25000, 1000, '2019-12-30 12:34:48'),
('TNS012', 40, 15000, 20000, 5000, '2019-12-30 12:34:56'),
('TNS013', 41, 12000, 15000, 3000, '2019-12-30 12:35:28'),
('TNS014', 42, 12000, 15000, 3000, '2019-12-30 12:35:39'),
('TNS015', 43, 15000, 15000, 0, '2019-12-30 12:35:46'),
('TNS016', 44, 20000, 25000, 5000, '2019-12-30 13:40:22'),
('TNS017', 45, 11000, 12000, 1000, '2019-12-30 13:40:28'),
('TNS018', 46, 12000, 13000, 1000, '2019-12-30 13:40:40'),
('TNS019', 47, 440000, 500000, 60000, '2019-12-30 13:40:52'),
('TNS020', 48, 24000, 25000, 1000, '2019-12-30 13:41:01'),
('TNS021', 49, 15000, 20000, 5000, '2019-12-30 13:41:08'),
('TNS022', 50, 20000, 20000, 0, '2019-12-30 13:48:12'),
('TNS023', 51, 11000, 100000, 89000, '2019-12-30 15:00:23'),
('TNS024', 52, 680000, 1000000, 320000, '2019-12-30 15:00:44'),
('TNS025', 53, 15000, 20000, 5000, '2020-01-01 02:58:29'),
('TNS026', 54, 660000, 1000000, 340000, '2020-01-01 03:05:03'),
('TNS027', 55, 12000, 50000, 38000, '2020-01-01 03:05:12'),
('TNS028', 56, 40000, 50000, 10000, '2020-01-01 03:05:19'),
('TNS029', 57, 22000, 23000, 1000, '2020-01-01 03:05:26'),
('TNS030', 58, 13000, 15000, 2000, '2020-01-01 03:05:34'),
('TNS031', 59, 55000, 100000, 45000, '2020-01-01 03:05:43'),
('TNS032', 60, 36000, 40000, 4000, '2020-01-01 03:05:53'),
('TNS033', 61, 660000, 1000000, 340000, '2020-01-09 02:24:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `level` enum('admin','kasir','waiter','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Muhammad Zikri', 'admin'),
(4, 'owner', '72122ce96bfec66e2396d2e25225d70a', 'Muhammad Zikri', 'owner'),
(8, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Muhammad Ibra', 'kasir'),
(9, 'waiter', 'f64cff138020a2060a9817272f563b3c', 'Budi', 'waiter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
