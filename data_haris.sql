-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09 Feb 2018 pada 19.27
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
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_transaction`
--

INSERT INTO `detail_transaction` (`id`, `transaction_id`, `product_id`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 'TR17060001', 1, 1, 1600000, 1600000, '2017-06-06 18:20:28', '2017-06-06 18:20:28');

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
(1, 'TR17060001', '163a5406c7a0b48d5f0c1167ec40d1c8.jpg', 1, '2017-06-10 22:41:14', '2017-06-11 20:31:58');

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

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `weight`, `discount`, `isSale`, `available`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sunset Coffee Table', 'Hiasilah ruangan santai Anda dengan Sunset Coffee Table. Meja yang fungsional karena memiiki masing-masing 1 buah laci bertutup dan rak terbuka yang berguna untuk menaruh barang-barang Anda. Permukaan meja yang cukup lebar dan luas dapat menjadi wadah Anda menaruh secangkir minuman Anda atau cemilan untuk para tamu. Warnanya yang natural cocok untuk menghiasi suasana ruangan apapun.', 2000000, 15, 20, '1', '1', '2017-06-05 19:55:09', '2017-06-05 19:55:09'),
(2, 2, 'Toril Wingchair', 'Furniture minimalis ini akan langsung mencuri perhatian siapapun yang melihatnya. Toril Armchair memang dirancang bagi orang-orang yang mengutamakan kenyamanan sekaligus gaya. Memiliki tampilan fisik yang terkesan gagah, Toril akan bersanding manis dengan Millard Side Table sebagai pendampingnya. Bermain game, melewatkan waktu dengan membaca novel bahkan tidak melakukan apapun, sah-sah saja. Hal yang wajar terjadi ketika Anda sudah mengenal dan merasakan langsung sensasi dari sebuah Toril Armchair. Dengan garansi 365 hari yang akan Anda dapatkan dengan pembeliannya, tidak perlu meragukan ketahanannya. Furniture ini juga adalah 100% karya anak Indonesia.', 2500000, 14, 0, '0', '1', '2017-06-05 20:13:01', '2017-06-05 20:13:01');

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
(1, 1, 'Material', 'Kayu Jati', '2017-06-05 19:55:09', '2017-06-05 19:55:09'),
(2, 1, 'Warna', 'Coklat', '2017-06-05 19:55:09', '2017-06-05 19:55:09'),
(3, 1, 'Panjang', '120 cm', '2017-06-05 19:55:09', '2017-06-05 19:55:09'),
(4, 1, 'Lebar', '70 cm', '2017-06-05 19:55:09', '2017-06-05 19:55:09'),
(5, 1, 'Tinggi', '42 cm', '2017-06-05 19:55:09', '2017-06-05 19:55:09'),
(6, 2, 'Material', 'Kayu Solid', '2017-06-05 20:13:01', '2017-06-05 20:13:01'),
(7, 2, 'Warna', 'Coklat', '2017-06-05 20:13:01', '2017-06-05 20:13:01'),
(8, 2, 'Panjang', '78cm', '2017-06-05 20:13:01', '2017-06-05 20:13:01'),
(9, 2, 'Lebar', '101cm', '2017-06-05 20:13:01', '2017-06-05 20:13:01'),
(10, 2, 'Tinggi', '112cm', '2017-06-05 20:13:01', '2017-06-05 20:13:01');

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
(11, 1, '05508444d81d56980396831e3d2d6dd2.jpg', '2017-06-05 19:55:19', '2017-06-05 19:55:19'),
(12, 1, '9231adcb8c7aa79ad3895be90c5e1b1c.jpg', '2017-06-05 19:55:27', '2017-06-05 19:55:27'),
(13, 2, '37f908f3a2fc1b48be59f284c84a7585.jpg', '2017-06-05 20:13:19', '2017-06-05 20:13:19'),
(14, 2, '3da9cad1b557dbb5cd057162b2656174.jpg', '2017-06-05 20:13:27', '2017-06-05 20:13:27');

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
(4, 'product_detail', 'Panjang', '2017-06-02 18:20:11', '2017-06-05 19:47:05'),
(5, 'product_detail', 'Lebar', '2017-06-05 19:47:20', '2017-06-05 19:47:20'),
(6, 'product_detail', 'Tinggi', '2017-06-05 19:47:29', '2017-06-05 19:47:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('TR17060001', 4, 'Member Baru', '086734747', 'Jalan Wisnu Marga Belayu No 19', 'Gianyar', 1600000, 150000, 1750000, 0, NULL, '2017-06-06 18:20:28', '2017-06-11 20:35:06');

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
(1, 'Administrator', 'admin@mail.com', '$2y$10$Sj1ZWlpM9G2EZpl2maW5s.57RRzyzUNTqy71eeDbNVNpU2SD7QBJO', '0822464828', 'Jalan Nangka', 'Gianyar', 1, 1, 'DX02gjCIf7BlmUjMx32zF2AOcxDWIjhX0HULMJS2dEviD11rKVRrKJcLAJhl', '2017-05-26 20:49:12', '2018-02-09 10:24:46'),
(2, 'Admn Baru', 'baru@mail.com', '$2y$10$iKM.KC4IV6PlDsakdfC.JO/UPUOzBj.adt16uxpFIVX.WAqHixNtq', '08483748473', 'Jalan Merdeka No. 120', 'Gianyar', 1, 1, NULL, '2017-05-29 23:30:18', '2017-05-29 23:30:18'),
(3, 'Owner', 'owner@mail.com', '$2y$10$dw1VP7w4LlzL4t2NkJFkdu7XyvMgKuEynTaoFQEXPpnF9fFlrGq.S', '0857366487', 'Jalan Penarungan', 'Gianyar', 1, 2, 'qir3OexVXySqdhWxKSJj2tfhYzOObbcl42w8sVZCWknaAhnZTIDhkB6rkyZq', '2017-05-29 23:53:42', '2017-05-29 23:54:29'),
(4, 'Member Baru', 'member@mail.com', '$2y$10$Wxj0e39m8PM/c7EA1t7WPOjFD1.HwpN8CblQVUfT4dzHjoN5vfmCu', '086734747', 'Jalan Wisnu Marga Belayu No 19', 'Denpasar', 1, 3, 'wh2Zll3Afq3Ulhwg3WXK0a98SgrwIpRGE9uGF5sLMvQIVGSS2KRJApi3ld4I', '2017-05-30 00:00:40', '2017-06-07 21:02:04');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
