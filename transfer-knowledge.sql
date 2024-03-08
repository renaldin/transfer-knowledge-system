-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 05:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transfer-knowledge`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cadre_development_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `task` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `task_status` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `cadre_development_id`, `manager_id`, `task`, `start_date`, `last_date`, `task_status`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 6, 'Tugas 1 Update', '2024-03-08', '2024-03-30', 'BELUM', 'Uraian PEnugasan 1  Update', '2024-03-08 16:09:16', '2024-03-08 16:21:11', '2024-03-08 16:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `cadre_developments`
--

CREATE TABLE `cadre_developments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senior_employee_id` bigint(20) UNSIGNED NOT NULL,
  `junior_employee_id` bigint(20) UNSIGNED NOT NULL,
  `admin_corporate_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cadre_developments`
--

INSERT INTO `cadre_developments` (`id`, `senior_employee_id`, `junior_employee_id`, `admin_corporate_id`, `manager_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 6, 5, 4, 'Uraian Keilmuan  Update', '2024-03-07 21:35:50', '2024-03-07 21:44:19', '2024-03-07 21:44:19'),
(2, 5, 6, 5, 4, 'Uraina Kaderisasi', '2024-03-07 21:44:42', '2024-03-07 21:44:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `job_code` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `full_name`, `address`, `birth_date`, `nik`, `organization`, `job_code`, `job_title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'Karyawan Senior 2 update', 'Subang Update', '2024-03-07', '22222222222222221', 'Organisasi Senior 2', 'kode pekerjaan senior 2 update', 'pekerjaan senior 2 update', '2024-03-07 03:40:48', '2024-03-07 06:28:40', '2024-03-07 06:28:40'),
(2, 4, 'Admin IT 1', 'Subang', '2024-03-07', '21312142315435325', 'Organisasi Admin IT 1', 'kode pekerjaan Admin IT 1', 'Pekerjaan Admin IT 1', '2024-03-07 07:01:50', '2024-03-07 07:01:50', NULL),
(3, 5, 'Admin Corporate 1', 'Subang', '2024-03-07', '123545465576768567', 'Organisasi Admin Corporate 1', 'Kode Pekerjaan Admin Corporate 1', 'Pekerjaan Admin Corporate 1', '2024-03-07 07:03:16', '2024-03-07 07:03:16', NULL),
(4, 6, 'Manager 1', 'Subang', '2024-03-07', '213214353546464', 'Organisasi Manager 1', 'Kode Pekerjaan Manager 1', 'Pekerjaan Manager 1', '2024-03-07 07:05:55', '2024-03-07 07:05:55', NULL),
(5, 7, 'Karyawan Senior 3', 'Subang', '2024-03-07', '21321421', 'Organisasi Senior 3', 'kode pekerjaan senior 3', 'pekerjaan senior 3', '2024-03-07 07:09:50', '2024-03-07 07:09:50', NULL),
(6, 8, 'Karyawan Junior 1', 'Subang', '2024-03-07', '32423423525235', 'Organisasi Junior 1', 'kode pekerjaan junior 1', 'pekerjaan junior 1', '2024-03-07 07:11:14', '2024-03-07 07:11:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_02_12_192542_create_users_table', 1),
(3, '2024_02_25_141959_add_column_to_table', 2),
(4, '2024_02_26_151401_create_employees_table', 3),
(6, '2024_03_07_175817_create_cadre_developments_table', 4),
(7, '2024_03_08_064031_create_assignments_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin IT 1', 'adminit1', 'adminit@gmail.com', '$2y$10$SxbheYZpxk.0GpTMO.Cjk.QTIojD.GxF5M3YIoFGHtAWHEWWrrpF6', 'Admin IT', '03072024135005Admin IT 1.jpg', '2024-02-26 07:58:38', '2024-03-07 06:50:05', NULL),
(2, 'Karyawan Senior 1', 'senior1', 'senior1@gmail.com', '$2y$10$BJi7GeeDX6l1Cswf49FsA.AOT9X/ZY4AL0PAd9nro1tWV2yIoHhKa', 'Karyawan Senior', '03072024081212 Karyawan Senior 1.jpg', '2024-03-07 01:12:13', '2024-03-07 01:12:13', NULL),
(3, 'Karyawan Senior 2 update', 'senior2update', 'senior2update@gmail.com', '$2y$10$q3eMzqo/bcGzmxdOi.EnOuG5lXpGQlHB/Uyccq9rFOEuwrUHnlI6G', 'Karyawan Senior', '03072024104048 Karyawan Senior 2.jpg', '2024-03-07 03:40:48', '2024-03-07 06:28:40', '2024-03-07 06:28:40'),
(4, 'Admin IT 1', 'adminit1', 'adminit1@gmail.com', '$2y$10$aee4kNzQA9wbhkecIKlsHO3U7.JciVOObxWfUjd0aNsgX6nuVhtf6', 'Admin IT', '03072024140150 Admin IT 1.jpg', '2024-03-07 07:01:50', '2024-03-07 07:01:50', NULL),
(5, 'Admin Corporate 1', 'admincorporate1', 'admincorporate1@gmail.com', '$2y$10$rQ.tSKFm.Wi7NgNPpyOPHOvQE6JQiwQ3J0CCtiUqjPA4jzpZnu1k.', 'Admin Corporate', '03072024140316 Admin Corporate 1.jpg', '2024-03-07 07:03:16', '2024-03-07 07:03:16', NULL),
(6, 'Manager 1', 'manager1', 'manager1@gmail.com', '$2y$10$qAILJqIHO7HXUotF/9yrX.gf13MrEOnWrB9PmaD0bp5K1fonxiRRK', 'Manager', '03072024140555 Manager 1.jpg', '2024-03-07 07:05:55', '2024-03-07 07:05:55', NULL),
(7, 'Karyawan Senior 3', 'senior3', 'senior3@gmail.com', '$2y$10$EkmgAb1IQzKF9VSSOyy6AOuRVSSKT3tlvGMSqh.xjp9hxbbsPx7PS', 'Karyawan Senior', '03072024140950 Karyawan Senior 3.jpg', '2024-03-07 07:09:50', '2024-03-07 07:09:50', NULL),
(8, 'Karyawan Junior 1', 'junior1', 'junior1@gmail.com', '$2y$10$CJK1ypLFbpS4HIqJ82Z/veaXoHCln2E/SePqfGMqBHlM11SjJXuB.', 'Karyawan Junior', '03072024141114 Karyawan Junior 1.jpg', '2024-03-07 07:11:14', '2024-03-07 07:11:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments_cadre_development_id_foreign` (`cadre_development_id`),
  ADD KEY `assignments_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `cadre_developments`
--
ALTER TABLE `cadre_developments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cadre_developments_senior_employee_id_foreign` (`senior_employee_id`),
  ADD KEY `cadre_developments_junior_employee_id_foreign` (`junior_employee_id`),
  ADD KEY `cadre_developments_admin_corporate_id_foreign` (`admin_corporate_id`),
  ADD KEY `cadre_developments_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cadre_developments`
--
ALTER TABLE `cadre_developments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_cadre_development_id_foreign` FOREIGN KEY (`cadre_development_id`) REFERENCES `cadre_developments` (`id`),
  ADD CONSTRAINT `assignments_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `cadre_developments`
--
ALTER TABLE `cadre_developments`
  ADD CONSTRAINT `cadre_developments_admin_corporate_id_foreign` FOREIGN KEY (`admin_corporate_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `cadre_developments_junior_employee_id_foreign` FOREIGN KEY (`junior_employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `cadre_developments_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `cadre_developments_senior_employee_id_foreign` FOREIGN KEY (`senior_employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
