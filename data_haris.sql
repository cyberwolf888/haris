-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 Feb 2018 pada 17.07
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
-- Database: `data_haris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'T-Shirt', 'Jual t-shirt murah', '2017-05-26 23:01:40', '2018-02-09 10:25:09'),
(2, 'Kemeja', 'Kemeja terbaik yang pernah dijual', '2017-05-26 23:03:18', '2018-02-09 10:25:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaction`
--

CREATE TABLE `detail_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(20) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_transaction`
--

INSERT INTO `detail_transaction` (`id`, `transaction_id`, `product_id`, `size`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 'TR17060001', 1, '', 1, 1600000, 1600000, '2017-06-06 18:20:28', '2017-06-06 18:20:28'),
(2, 'TR18020002', 1, '', 2, 1600000, 3200000, '2018-02-09 17:39:53', '2018-02-09 17:39:53'),
(3, 'TR18020004', 2, NULL, 2, 200000, 400000, '2018-02-17 21:06:52', '2018-02-17 21:06:52'),
(4, 'TR18020005', 3, 'M', 1, 50000, 50000, '2018-02-27 07:33:48', '2018-02-27 07:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id`, `transaction_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TR17060001', '163a5406c7a0b48d5f0c1167ec40d1c8.jpg', 1, '2017-06-10 22:41:14', '2017-06-11 20:31:58'),
(2, 'TR18020002', '09c64b1dc4534ea5f1b82b8708038b31.jpg', 1, '2018-02-09 18:36:13', '2018-02-17 20:14:23'),
(3, 'TR18020004', '01811cb2975e6e7486932f9556a8600b.jpg', 1, '2018-02-17 21:09:40', '2018-02-17 21:11:12'),
(4, 'TR18020005', '46b9c19a2a0cad7d32b7b8c37f95466c.jpg', 0, '2018-02-27 07:34:28', '2018-02-27 07:34:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `discount` float NOT NULL,
  `isSale` enum('1','0') NOT NULL,
  `available` enum('1','0') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `weight`, `discount`, `isSale`, `available`, `created_at`, `updated_at`) VALUES
(1, 1, 'Plain Shirt', '100% Superior Cotton T-Shirt with enzyme treatment, Breathable fabric which allows air circulation and keeps you cool', 150000, 0, 1, 20, '1', '1', '2017-06-05 19:55:09', '2018-02-10 00:21:39'),
(2, 2, 'Colourfull Shirt', 'A soft solid textured full sleeve with thumb hole in the sleeves which makes desi swag.\r\nDue to the different monitor and light effect, the actual color maybe a slight  different from the picture color.', 200000, 0, 1, 0, '0', '1', '2017-06-05 20:13:01', '2018-02-10 00:25:06'),
(3, 1, 'Baju kaos [L]', 'baju kaos polos', 50000, 30, 1, 0, '1', '1', '2018-02-17 20:29:11', '2018-02-17 20:36:02'),
(4, 1, 'Baju kaos', 'baju kaos polos', 50000, 15, 1, 0, '1', '1', '2018-02-17 20:32:28', '2018-02-17 20:32:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `label`, `value`, `created_at`, `updated_at`) VALUES
(15, 1, 'Material', 'Coton', '2018-02-10 00:21:39', '2018-02-10 00:21:39'),
(16, 1, 'Warna', 'White', '2018-02-10 00:21:39', '2018-02-10 00:21:39'),
(17, 2, 'Material', 'Cotton', '2018-02-10 00:25:06', '2018-02-10 00:25:06'),
(18, 2, 'Warna', 'Red, Blue', '2018-02-10 00:25:06', '2018-02-10 00:25:06'),
(22, 4, 'Material', 'Coton 30s', '2018-02-17 20:32:28', '2018-02-17 20:32:28'),
(23, 4, 'Warna', 'Hitam', '2018-02-17 20:32:28', '2018-02-17 20:32:28'),
(24, 4, 'Size', 'L', '2018-02-17 20:32:28', '2018-02-17 20:32:28'),
(25, 3, 'Material', 'Cotton 30s', '2018-02-17 20:36:02', '2018-02-17 20:36:02'),
(26, 3, 'Warna', 'Hitam', '2018-02-17 20:36:02', '2018-02-17 20:36:02'),
(27, 3, 'Size', 'S,M', '2018-02-17 20:36:02', '2018-02-17 20:36:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(16, 1, '5bcddf4e2916063ceaf4c3a618232421.jpg', '2018-02-10 00:23:58', '2018-02-10 00:23:58'),
(17, 2, '661dbc3cc2df059f4fbef9e0914d00aa.jpg', '2018-02-10 00:25:21', '2018-02-10 00:25:21'),
(18, 3, 'ef915500641f3fd265d90b00969fb71c.jpg', '2018-02-17 20:29:29', '2018-02-17 20:29:29'),
(19, 3, '277c712a517aab646e4bbaa3eff7fb97.jpg', '2018-02-17 20:29:37', '2018-02-17 20:29:37'),
(20, 4, '2c91583d2f6cc009f9aef35ad6691d37.jpg', '2018-02-17 20:32:36', '2018-02-17 20:32:36'),
(21, 4, '4b374e5d69a53a6b2f1e970f3d1d0913.jpg', '2018-02-17 20:33:03', '2018-02-17 20:33:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'ongkir', '10000', '2017-06-02 18:18:52', '2017-06-05 20:28:16'),
(2, 'product_detail', 'Material', '2017-06-02 18:19:13', '2017-06-02 18:23:42'),
(3, 'product_detail', 'Warna', '2017-06-02 18:19:27', '2017-06-05 19:46:56'),
(4, 'product_detail', 'Size', '2017-06-02 18:20:11', '2018-02-17 20:19:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subscribe`
--

INSERT INTO `subscribe` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'wijaya.imd@gmail.com', '2018-02-27 08:06:22', '2018-02-27 08:06:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` varchar(50) NOT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `fullname` varchar(255) NOT NULL DEFAULT '0',
  `phone` varchar(12) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '0',
  `city` varchar(100) NOT NULL DEFAULT '0',
  `subtotal` int(11) NOT NULL DEFAULT '0',
  `shipping` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `member_id`, `fullname`, `phone`, `address`, `city`, `subtotal`, `shipping`, `total`, `status`, `note`, `created_at`, `updated_at`) VALUES
('TR17060001', 4, 'Member Baru', '086734747', 'Jalan Wisnu Marga Belayu No 19', 'Gianyar', 1600000, 150000, 1750000, 0, NULL, '2017-06-06 18:20:28', '2017-06-11 20:35:06'),
('TR18020002', 4, 'Member Baru', '086734747', 'Jalan Wisnu Marga Belayu No 19', 'Denpasar', 3872000, 0, 3872000, 3, NULL, '2018-02-09 17:39:53', '2018-02-17 20:14:23'),
('TR18020003', 4, 'Member Baru', '086734747', 'Jalan Wisnu Marga Belayu No 19', 'Denpasar', 484000, 0, 484000, 1, NULL, '2018-02-17 21:06:30', '2018-02-17 21:06:30'),
('TR18020004', 4, 'Member Baru', '086734747', 'Jalan Wisnu Marga Belayu No 19', 'Denpasar', 484000, 0, 484000, 5, NULL, '2018-02-17 21:06:52', '2018-02-17 21:11:38'),
('TR18020005', 4, 'Member Baru', '086734747', 'Jalan Wisnu Marga Belayu No 19', 'Denpasar', 60500, 0, 60500, 2, NULL, '2018-02-27 07:33:48', '2018-02-27 07:34:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `type` int(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `city`, `isActive`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@mail.com', '$2y$10$Sj1ZWlpM9G2EZpl2maW5s.57RRzyzUNTqy71eeDbNVNpU2SD7QBJO', '0822464828', 'Jalan Nangka', 'Gianyar', 1, 1, 'fmzIlCTxKMKlnPzLGbpET2yWAa0y6WtPSm13sJN0Xu2mgsB0QM2CkXgQsuZx', '2017-05-26 20:49:12', '2018-02-09 10:24:46'),
(2, 'Admn Baru', 'baru@mail.com', '$2y$10$iKM.KC4IV6PlDsakdfC.JO/UPUOzBj.adt16uxpFIVX.WAqHixNtq', '08483748473', 'Jalan Merdeka No. 120', 'Gianyar', 1, 1, NULL, '2017-05-29 23:30:18', '2017-05-29 23:30:18'),
(3, 'Owner', 'owner@mail.com', '$2y$10$dw1VP7w4LlzL4t2NkJFkdu7XyvMgKuEynTaoFQEXPpnF9fFlrGq.S', '0857366487', 'Jalan Penarungan', 'Gianyar', 1, 2, 'qir3OexVXySqdhWxKSJj2tfhYzOObbcl42w8sVZCWknaAhnZTIDhkB6rkyZq', '2017-05-29 23:53:42', '2017-05-29 23:54:29'),
(4, 'Member Baru', 'member@mail.com', '$2y$10$Wxj0e39m8PM/c7EA1t7WPOjFD1.HwpN8CblQVUfT4dzHjoN5vfmCu', '086734747', 'Jalan Wisnu Marga Belayu No 19', 'Denpasar', 1, 3, 'na2L4iyR7hS1NC8DYzXUm5UWhYOEdh9BPZJZNOKD6WQmp9fbxM2U52vn2HCd', '2017-05-30 00:00:40', '2017-06-07 21:02:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
