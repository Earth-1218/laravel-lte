-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2024 at 10:35 AM
-- Server version: 8.0.30
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravellte`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_histories`
--

CREATE TABLE `loan_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `loan_no` varchar(255) NOT NULL,
  `status` enum('NOT YET REGISTERED','IN PROGRESS DOCUMENTS UPLOADED','LOAN APPROVED','LOAN SANCTIONED','AMOUNT CREDITED') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loan_histories`
--

INSERT INTO `loan_histories` (`id`, `user_id`, `loan_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 12, 'LN001', 'NOT YET REGISTERED', '2024-06-20 17:20:23', '2024-06-20 17:20:23'),
(2, 12, 'LN002', 'IN PROGRESS DOCUMENTS UPLOADED', '2024-06-20 17:20:23', '2024-06-20 17:20:23'),
(3, 12, 'LN003', 'LOAN APPROVED', '2024-06-20 17:20:23', '2024-06-20 17:20:23'),
(4, 12, 'LN004', 'LOAN SANCTIONED', '2024-06-20 17:20:23', '2024-06-20 17:20:23'),
(5, 12, 'LN005', 'AMOUNT CREDITED', '2024-06-20 17:20:23', '2024-06-20 17:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_03_11_165941_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2020_02_03_125830_create_sessions_table', 1),
(5, '2020_02_03_132010_create_jobs_table', 1),
(6, '2020_03_26_110221_create_permissions_table', 1),
(7, '2023_03_26_110250_create_permission_role_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users.index', 'View Users', '2024-01-24 12:12:31', '2024-01-24 12:12:31'),
(2, 'users', 'users.create', 'Create New User', '2024-01-24 12:12:31', '2024-01-24 12:12:31'),
(3, 'users', 'users.edit', 'Edit Existing User', '2024-01-24 12:12:31', '2024-01-24 12:12:31'),
(4, 'users', 'users.delete', 'Delete Existing User', '2024-01-24 12:12:31', '2024-01-24 12:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `owner_restricted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `owner_restricted`) VALUES
(1, 1, 3, 0),
(2, 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` enum('prepaid','postpaid','broadbandRecharge','fastagRecharge','water','gas','electricity') NOT NULL,
  `view_bill` enum('REQUIRED','NOT REQUIRED') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `name`, `category`, `view_bill`, `created_at`, `updated_at`) VALUES
(1, 'Adani Gas', 'gas', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(2, 'Maharashtra Municipal Water', 'water', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(3, 'Airtel Prepaid', 'prepaid', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(4, 'BSNL Postpaid', 'postpaid', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(5, 'ACT Broadband', 'broadbandRecharge', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(6, 'Paytm Fastag', 'fastagRecharge', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(7, 'Tata Power', 'electricity', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(8, 'Vodafone Prepaid', 'prepaid', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(9, 'Jio Postpaid', 'postpaid', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(10, 'Hathway Broadband', 'broadbandRecharge', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(11, 'ICICI Fastag', 'fastagRecharge', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(12, 'Delhi Jal Board', 'water', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(13, 'Mahanagar Gas', 'gas', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(14, 'BSES Electricity', 'electricity', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(15, 'Idea Prepaid', 'prepaid', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(16, 'Airtel Postpaid', 'postpaid', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(17, 'Reliance Broadband', 'broadbandRecharge', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(18, 'SBI Fastag', 'fastagRecharge', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(19, 'Bangalore Water Supply', 'water', 'REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04'),
(20, 'Indraprastha Gas', 'gas', 'NOT REQUIRED', '2024-06-30 04:06:04', '2024-06-30 04:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin', '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(2, 'manager', 'manager', '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(3, 'HR', 'HR', '2024-01-24 12:17:59', '2024-01-24 12:17:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `uid` varchar(255) NOT NULL,
  `user_platform_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','failed') NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `uid`, `user_platform_id`, `amount`, `status`, `date`, `created_at`, `updated_at`) VALUES
(1, 'dd3dc885-3698-11ef-9978-00ffae53a24e', 1, '102.93', 'failed', '2024-06-28', '2023-09-22 03:50:45', '2024-06-30 07:16:45'),
(2, 'dd3e3fac-3698-11ef-9978-00ffae53a24e', 2, '459.16', 'pending', '2024-06-28', '2021-06-02 18:25:48', '2024-06-30 07:16:48'),
(3, 'dd3e4291-3698-11ef-9978-00ffae53a24e', 3, '154.62', 'pending', '2024-06-28', '2024-06-11 05:04:06', '2024-06-30 07:16:52'),
(4, 'dd3e4402-3698-11ef-9978-00ffae53a24e', 4, '844.32', 'failed', '2024-06-28', '2022-09-07 03:56:09', '2024-06-30 07:16:56'),
(5, 'dd3e4490-3698-11ef-9978-00ffae53a24e', 5, '76.53', 'failed', '2024-05-28', '2021-12-23 06:40:26', '2024-06-30 07:15:15'),
(6, 'dd3e451b-3698-11ef-9978-00ffae53a24e', 6, '859.30', 'pending', '2024-06-28', '2024-05-28 20:53:32', '2024-06-30 07:17:03'),
(7, 'dd3e45a7-3698-11ef-9978-00ffae53a24e', 7, '541.33', 'pending', '2024-06-28', '2024-12-20 02:23:37', '2024-06-30 07:17:09'),
(8, 'dd3e4629-3698-11ef-9978-00ffae53a24e', 8, '71.85', 'pending', '2024-06-28', '2021-10-08 02:57:22', '2024-06-30 07:17:13'),
(9, 'dd3e46ba-3698-11ef-9978-00ffae53a24e', 9, '797.34', 'failed', '2024-06-28', '2023-11-09 12:07:51', '2024-06-30 07:17:17'),
(10, 'dd3e473e-3698-11ef-9978-00ffae53a24e', 10, '669.19', 'failed', '2024-06-28', '2024-05-13 13:23:16', '2024-06-30 07:17:21'),
(11, 'dd3e47dd-3698-11ef-9978-00ffae53a24e', 11, '946.91', 'pending', '2024-06-28', '2023-04-03 02:41:54', '2024-06-30 07:17:24'),
(12, 'dd3e485d-3698-11ef-9978-00ffae53a24e', 12, '586.91', 'failed', '2024-06-28', '2021-07-05 04:17:15', '2024-06-30 07:17:28'),
(13, 'dd3e48de-3698-11ef-9978-00ffae53a24e', 13, '610.50', 'failed', '2024-06-28', '2022-05-17 10:41:11', '2024-06-30 07:17:33'),
(14, 'dd3e4967-3698-11ef-9978-00ffae53a24e', 14, '860.99', 'pending', '2024-06-28', '2022-07-17 21:57:51', '2024-06-30 07:17:35'),
(15, 'dd3e49ed-3698-11ef-9978-00ffae53a24e', 15, '868.64', 'pending', '2024-06-28', '2021-12-11 10:39:06', '2024-06-30 07:17:38'),
(16, 'dd3e4a6c-3698-11ef-9978-00ffae53a24e', 16, '201.97', 'failed', '2024-06-28', '2021-01-21 06:12:40', '2024-06-30 07:17:41'),
(17, 'dd3e4aed-3698-11ef-9978-00ffae53a24e', 17, '916.95', 'failed', '2024-06-28', '2021-07-26 23:39:17', '2024-06-30 07:17:45'),
(18, 'dd3e4b80-3698-11ef-9978-00ffae53a24e', 18, '152.75', 'pending', '2024-06-28', '2023-04-13 11:02:45', '2024-06-30 07:17:48'),
(19, 'dd3e4c01-3698-11ef-9978-00ffae53a24e', 19, '121.01', 'failed', '2024-06-28', '2023-03-27 22:29:20', '2024-06-30 07:17:51'),
(20, 'dd3e4c7f-3698-11ef-9978-00ffae53a24e', 20, '131.97', 'failed', '2024-06-28', '2022-12-14 17:23:12', '2024-06-30 07:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_commissions`
--

CREATE TABLE `transaction_commissions` (
  `id` int NOT NULL,
  `transaction_id` int NOT NULL,
  `commission_amount` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_commissions`
--

INSERT INTO `transaction_commissions` (`id`, `transaction_id`, `commission_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '2024-06-27 18:30:00', '2024-06-30 07:52:59'),
(2, 2, 10, '2024-06-27 18:30:00', '2024-06-30 07:53:04'),
(3, 3, 66, '2024-06-27 18:30:00', '2024-06-30 07:53:17'),
(4, 4, 43, '2021-03-27 18:30:00', '2024-06-30 07:53:22'),
(5, 5, 23, '2024-06-27 18:30:00', '2024-06-30 07:53:27'),
(9, 5, 47, '2024-06-28 04:49:35', '2024-06-30 07:53:33'),
(10, 6, 35, '2024-06-27 18:30:00', '2024-06-30 07:53:36'),
(11, 7, 45, '2024-06-27 18:30:00', '2024-06-30 07:53:39'),
(12, 8, 45, '2022-03-27 18:30:00', '2024-06-30 07:53:43'),
(13, 5, 12, '2024-06-27 18:30:00', '2024-06-30 07:53:48'),
(16, 2, 50, '2022-12-31 18:30:00', '2022-12-31 18:30:00'),
(17, 1, 75, '2023-01-01 18:30:00', '2023-01-01 18:30:00'),
(18, 2, 50, '2022-12-31 18:30:00', '2022-12-31 18:30:00'),
(21, 2, 50, '2022-12-31 18:30:00', '2022-12-31 18:30:00'),
(22, 1, 75, '2023-01-01 18:30:00', '2023-01-01 18:30:00'),
(23, 3, 100, '2023-01-02 18:30:00', '2023-01-02 18:30:00'),
(24, 4, 125, '2023-01-03 18:30:00', '2023-01-03 18:30:00'),
(25, 9, 150, '2023-01-04 18:30:00', '2023-01-04 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `owner_id`, `role_id`, `email`, `email_verified_at`, `password`, `remember_token`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'admin@lte.com', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'OdPlTem13i', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(2, 1, 2, 'manager@lte.com', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xEPlUl00HC', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(3, 1, 2, 'murray.schmitt@example.com', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xzrj8EMU7x', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(4, 1, 2, 'christelle.bruen@example.com', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wpaZO2zi9X', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(5, 1, 2, 'hbednar@example.com', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BfxQ3yD4fm', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(6, 1, 2, 'tfranecki@example.org', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9xYalRRxzV', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(7, 1, 2, 'hettinger.ted@example.org', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wvWJZ3Nwdm', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(8, 1, 2, 'mittie.becker@example.com', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hFqqQAnoAv', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(9, 1, 2, 'erika.beier@example.net', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'eBvYOicbWD', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(10, 1, 2, 'samantha74@example.com', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gwC5Nr1A0U', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(11, 1, 2, 'concepcion.konopelski@example.net', '2024-01-24 12:12:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QTUDkF2lUU', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(12, 1, 1, 'ravimajithiya786@gmail.com', '2024-01-24 12:12:31', '$2y$10$Qhuvz51Fr.6LJQtbwi1g/u6aJW.LeDgJxVz2lAmj9Q4A3RkeyZRHm', '9AMe1sWd6NyMtB6C6E2j4H9IZ8Tvf6ehl7Ry5PQZrPtww1p18jGKqcP2Jw4s', NULL, '2024-01-24 12:12:31', '2024-01-24 12:12:31', NULL),
(13, 12, 3, 'ravimajithiya3287263@gmail.com', NULL, '$2y$10$Iq6m3PXKqPDC.bzQYcThCeFhOc.Cpir5aZlzS1j8EvGHVCdvSOqkG', NULL, NULL, '2024-01-24 12:20:39', '2024-01-27 05:28:03', '2024-01-27 05:28:03'),
(14, 13, 3, 'brainbitesindia@gmail.com', NULL, NULL, NULL, NULL, '2024-01-24 12:28:28', '2024-01-24 12:28:28', NULL),
(15, 12, 3, 'ravimajithiya3287263@gmail.com', NULL, '$2y$10$Qhuvz51Fr.6LJQtbwi1g/u6aJW.LeDgJxVz2lAmj9Q4A3RkeyZRHm', NULL, NULL, '2024-01-27 05:36:10', '2024-01-27 05:36:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_platforms`
--

CREATE TABLE `user_platforms` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `platform_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_platforms`
--

INSERT INTO `user_platforms` (`id`, `user_id`, `platform_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2023-08-10 15:59:06', '2024-09-04 08:50:41'),
(2, 1, 5, '2023-07-27 01:46:10', '2022-10-21 11:48:50'),
(3, 1, 1, '2022-04-27 11:15:45', '2022-03-09 02:22:18'),
(4, 1, 5, '2024-03-14 23:41:01', '2022-11-08 00:52:23'),
(5, 1, 1, '2024-08-26 10:48:57', '2021-09-17 08:57:38'),
(6, 1, 6, '2021-08-05 17:51:24', '2021-11-02 19:54:07'),
(7, 1, 3, '2024-03-30 08:57:53', '2024-05-21 09:00:55'),
(8, 1, 3, '2021-03-11 02:21:23', '2021-05-27 10:56:06'),
(9, 1, 5, '2022-06-10 05:06:23', '2022-12-28 22:13:43'),
(10, 1, 1, '2022-08-23 05:19:26', '2023-03-27 13:26:06'),
(11, 1, 6, '2023-04-01 08:42:14', '2021-07-15 08:42:55'),
(12, 1, 3, '2022-04-16 22:37:23', '2023-01-28 08:10:39'),
(13, 1, 5, '2023-07-04 02:31:08', '2023-04-19 17:33:46'),
(14, 1, 1, '2024-12-22 13:45:31', '2021-12-28 21:36:19'),
(15, 1, 6, '2022-01-11 00:15:07', '2023-03-01 13:56:41'),
(16, 1, 3, '2021-03-16 16:31:35', '2022-06-20 05:09:57'),
(17, 1, 5, '2023-09-20 05:45:00', '2022-03-12 18:45:16'),
(18, 1, 1, '2022-10-25 10:01:22', '2022-06-29 23:21:07'),
(19, 1, 6, '2023-01-08 20:11:30', '2022-08-18 12:24:12'),
(20, 1, 6, '2022-12-18 07:34:17', '2023-04-06 12:14:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `loan_histories`
--
ALTER TABLE `loan_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loan_no` (`loan_no`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_commissions`
--
ALTER TABLE `transaction_commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_owner_id_foreign` (`owner_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_platforms`
--
ALTER TABLE `user_platforms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_histories`
--
ALTER TABLE `loan_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction_commissions`
--
ALTER TABLE `transaction_commissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_platforms`
--
ALTER TABLE `user_platforms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
