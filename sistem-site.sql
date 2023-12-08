-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 09:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2023_05_18_082145_user', 1),
(10, '2023_11_17_102318_create_site_table', 1),
(11, '2023_11_17_103435_create_site_detail_table', 2),
(13, '2023_11_18_175102_create_store_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id_site` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id_site`, `site_name`, `site_address`, `created_at`, `updated_at`) VALUES
(1, 'Nama Site 1 Subang', 'Subang', '2023-11-17 17:59:42', '2023-11-17 18:00:41'),
(2, 'Nama Site Bandung', 'Bandung', '2023-11-17 18:00:04', '2023-11-17 18:00:04'),
(3, 'Nama Site Jakarta', 'Jakarta', '2023-11-17 18:00:26', '2023-11-17 18:00:26'),
(6, 'Site Jambi', 'Jambi', '2023-11-21 01:31:28', '2023-11-21 01:31:28'),
(7, 'Site Majalengka', 'Majalengka', '2023-11-21 01:32:54', '2023-11-21 01:32:54'),
(8, 'Site Sumedang', 'Sumedang', '2023-11-21 01:38:26', '2023-11-21 01:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `site_detail`
--

CREATE TABLE `site_detail` (
  `id_site_detail` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_site` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_detail`
--

INSERT INTO `site_detail` (`id_site_detail`, `id_user`, `id_site`, `created_at`, `updated_at`) VALUES
(3, 5, 2, '2023-11-17 18:42:41', '2023-11-17 18:42:41'),
(4, 2, 1, '2023-11-18 02:54:25', '2023-11-18 02:54:25'),
(5, 6, 3, '2023-11-19 13:31:48', '2023-11-19 13:31:48'),
(6, 3, 2, '2023-11-19 13:33:16', '2023-11-19 13:33:16'),
(9, 10, 2, '2023-11-21 00:07:30', '2023-11-21 00:07:30'),
(10, 10, 1, '2023-11-21 00:07:36', '2023-11-21 00:07:36'),
(11, 3, 1, '2023-11-21 01:19:20', '2023-11-21 01:19:20'),
(12, 6, 1, '2023-11-21 01:30:25', '2023-11-21 01:30:25'),
(14, 10, 7, '2023-11-21 01:32:54', '2023-11-21 01:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id_store` bigint(20) UNSIGNED NOT NULL,
  `id_site` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `store_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_mobile_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_gmaps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_pict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ktp_pict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_pict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_status` int(11) NOT NULL DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id_store`, `id_site`, `id_user`, `store_code`, `store_name`, `owner_name`, `store_mobile_phone`, `store_address`, `link_gmaps`, `store_pict`, `ktp_pict`, `form_pict`, `store_status`, `description`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 'Kode 2', 'Store 2', 'Owner 2', '089898234234', 'Subang', 'https://maps.app.goo.gl/gsWyGyNw3McsBo4R6', '11192023000502 Store 2.jpg', '11192023000502 Store 2.png', '11192023000502 Store 2.jpg', 0, 'Deskripsi 2', '2023-11-18 17:05:02', '2023-11-21 02:15:57'),
(4, 2, 3, 'Kode 3', 'Store 3', 'Owner 3', '0898972868323', 'Bandung', 'https://maps.app.goo.gl/gsWyGyNw3McsBo4R6', '11192023000625 Store 3.jpg', '11192023000625 Store 3.png', '11192023000625 Store 3.jpg', 1, 'Deskripsi 3', '2023-11-18 17:06:25', '2023-11-19 14:01:31'),
(8, 1, 2, 'aaa', 'aaa', 'aaa', '333333333333333333', 'aaa', 'aaa', '11212023091725 aaa.jpg', '11212023091725 aaa.jpg', '11212023091725 aaa.jpg', 1, 'aaa', '2023-11-21 02:17:25', '2023-11-21 02:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('Administrator','Sales','Admin Cabang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user_respon` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `username`, `email`, `password`, `user_address`, `mobile_phone`, `role`, `photo`, `id_user_respon`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'renaldinoviandi9@gmail.com', '$2y$10$R08I2ZkTXQosOWR7qc8ae.uxlvdoPadOYVPdPzvU6RWLs3z9iBGZG', 'Subang', '0895336928026', 'Administrator', '11182023102021Administrator.jpg', NULL, '2023-11-17 10:44:09', '2023-11-18 17:34:36'),
(2, 'Renaldi 1', 'renaldi1', 'renaldinoviandi0@gmail.com', '$2y$10$652n3PDRJ9DQ8Ak8tJjQ2OvbRwwJK9eWesSWyzM5Ffzk17ULMvwv.', 'Subang', '089565653725', 'Sales', '11172023152619 Renaldi 1.jpg', NULL, '2023-11-17 10:44:09', '2023-11-17 10:44:09'),
(3, 'Renaldi 2', 'renaldi2', 'renaldi2@gmail.com', '$2y$10$yheDNgG6eR1o.QCpvNgPo..mTct/BE9b.B/rSCPfDMH4ZRR9H16J.', 'Bandung', '08989786757', 'Sales', '11172023152929 Renaldi 2.jpg', NULL, '2023-11-17 10:44:09', '2023-11-17 10:44:09'),
(4, 'Renaldi 3', 'renaldi3', 'renaldi3@gmail.com', '$2y$10$BHyO/UAOZJ8/rYf9nAHkx.OQ2XVWYvddNnkIOJITH9Ng2ZBO3IJEy', 'Subang', '08989767753', 'Sales', '11172023153042 Renaldi 3.jpg', NULL, '2023-11-17 10:44:09', '2023-11-17 10:44:09'),
(5, 'Renaldi 4', 'renaldi4', 'renaldi4@gmail.com', '$2y$10$uk8T9ak1vEM8mdBVJS67/uSPObJTRNNmgcq5BpwIrXOWDSmdTlsba', 'Bandung', '0898997866', 'Sales', '11172023153139 Renaldi 4.jpg', NULL, '2023-11-17 10:44:09', '2023-11-17 10:44:09'),
(6, 'Renaldi 5', 'renaldi5', 'renaldi5@gmail.com', '$2y$10$nv6I8q7UcN0EP4YkSO77s.ytvBYs9er7wu/GM7EL8g8IFeEHU9Eau', 'Jakarta', '08989786683', 'Sales', '11172023153232 Renaldi 5.jpg', NULL, '2023-11-17 10:44:09', '2023-11-17 10:44:09'),
(10, 'Admin Cabang 1', 'admincabang1', 'admincabang1@gmail.com', '$2y$10$jkurUvVcTHQPTc5v9RmVPunqUEWNCzjoKhLYHDwXLgxXE6XoKlr8G', 'Jakarta', '08989786833', 'Admin Cabang', '11212023070636 Admin Cabang 1.jpg', NULL, '2023-11-21 00:06:36', '2023-11-21 00:06:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id_site`);

--
-- Indexes for table `site_detail`
--
ALTER TABLE `site_detail`
  ADD PRIMARY KEY (`id_site_detail`),
  ADD KEY `site_detail_id_user_foreign` (`id_user`),
  ADD KEY `site_detail_id_site_foreign` (`id_site`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id_store`),
  ADD KEY `store_id_site_foreign` (`id_site`),
  ADD KEY `store_id_user_foreign` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id_site` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_detail`
--
ALTER TABLE `site_detail`
  MODIFY `id_site_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id_store` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `site_detail`
--
ALTER TABLE `site_detail`
  ADD CONSTRAINT `site_detail_id_site_foreign` FOREIGN KEY (`id_site`) REFERENCES `site` (`id_site`),
  ADD CONSTRAINT `site_detail_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_id_site_foreign` FOREIGN KEY (`id_site`) REFERENCES `site` (`id_site`),
  ADD CONSTRAINT `store_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
