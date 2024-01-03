-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 02:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_king`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Hollowblocks', 600, '10.00', '2023-11-14 16:40:54', '2023-12-06 02:23:36'),
(2, 'Semento', 250, '300.00', '2023-11-14 18:20:18', '2023-11-14 21:54:42'),
(3, 'Landok', 400, '150.00', '2023-11-14 18:20:35', '2023-12-06 04:14:43'),
(4, 'Flywoods', 350, '200.00', '2023-11-14 18:21:01', '2023-12-06 04:25:56'),
(5, 'Boysen Paint (Blue)', 100, '450.00', '2023-11-14 21:34:23', '2023-12-07 00:24:20'),
(6, 'Roof', 50, '450.00', '2023-11-14 21:43:11', '2023-12-06 04:15:01'),
(8, 'Alambre', 50, '120.00', '2023-11-15 00:38:08', '2023-12-06 23:40:15'),
(9, 'Masilya', 130, '230.00', '2023-11-15 00:40:31', '2023-11-15 00:40:31'),
(11, 'Square Bar 10mm', 100, '200.00', '2023-12-06 04:22:52', '2023-12-06 04:22:52'),
(12, 'Seal Gray', 100, '80.00', '2023-12-06 04:22:56', '2023-12-06 04:22:56'),
(13, 'Hardie Flex', 300, '120.00', '2023-12-06 04:22:57', '2023-12-06 04:22:57'),
(14, 'Lumber', 50, '110.00', '2023-12-07 00:27:21', '2023-12-07 00:27:21'),
(15, 'Boysen Paint (Grey)', 100, '450.00', '2024-01-03 05:08:54', '2024-01-03 05:08:54'),
(16, 'Boysen Paint (Black)', 100, '450.00', '2024-01-03 05:09:15', '2024-01-03 05:09:15');

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
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(17, '2023_11_09_075410_create_inventories_table', 1),
(18, '2023_11_14_120623_create_projects_table', 1),
(27, '2023_11_09_010951_create_requests_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `client` varchar(255) NOT NULL,
  `project_start_date` date NOT NULL,
  `project_end_date` date NOT NULL,
  `status` enum('ongoing','finished') NOT NULL DEFAULT 'ongoing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `project_description`, `client`, `project_start_date`, `project_end_date`, `status`, `created_at`, `updated_at`) VALUES
(16, 'Tiny House', 'Extremely small houses', 'Kate Cabanting', '2023-11-15', '2024-02-15', 'ongoing', '2023-11-14 20:27:17', '2023-12-07 00:23:52'),
(17, 'Bungalow', 'A single-story house, often with a front porch and a low-pitched roof', 'Pedro Reyes', '2023-12-15', '2025-01-15', 'ongoing', '2023-11-14 20:27:35', '2023-12-07 00:23:19'),
(19, 'Ranch House', 'A single-story house with a long, low profile and an open layout', 'Marta Uy', '2023-11-15', '2024-01-30', 'ongoing', '2023-11-15 00:36:11', '2023-12-07 00:23:36'),
(21, 'Full Duplex', 'Two separate living units', 'Goerge Macanting', '2023-12-06', '2024-01-24', 'ongoing', '2023-12-06 04:12:51', '2023-12-07 00:23:01'),
(22, 'Log Cabin', 'Houses made from logs or timber', 'Elias Perpose', '2023-12-11', '2024-02-29', 'ongoing', '2023-12-07 00:22:29', '2023-12-07 00:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'waiting for approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `name`, `quantity`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Hardie Flex', 300, '120.00', 'accepted', '2023-12-06 04:16:14', '2023-12-06 04:22:58'),
(8, 'Seal Gray', 100, '80.00', 'accepted', '2023-12-06 04:16:35', '2023-12-06 04:22:56'),
(9, 'Square Bar 10mm', 100, '200.00', 'accepted', '2023-12-06 04:18:02', '2023-12-06 04:22:52'),
(10, 'Skim Coat', 30, '50.00', 'waiting for approval', '2023-12-06 04:20:26', '2023-12-06 23:34:09'),
(11, 'Wall Angle', 40, '85.00', 'waiting for approval', '2023-12-06 04:21:12', '2023-12-06 04:21:12'),
(12, 'Tile Adresive', 30, '120.00', 'declined', '2023-12-06 04:22:18', '2023-12-06 04:23:01'),
(13, 'Lumber', 50, '110.00', 'accepted', '2023-12-07 00:25:48', '2023-12-07 00:27:21'),
(14, 'Plywood', 100, '135.00', 'declined', '2023-12-07 00:26:07', '2023-12-07 00:27:24'),
(15, 'Polyvinyl Chloride', 75, '90.00', 'waiting for approval', '2023-12-07 00:26:29', '2023-12-07 00:26:29'),
(16, 'Timber', 80, '75.00', 'declined', '2023-12-07 00:26:51', '2023-12-07 00:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arjay Lalas', 'staff@gmail.com', NULL, '$2y$12$rkmjc1YPK.BxeYssd6WOIe20rcHnnYZiPlLVQ.tZg8wSI9rHPkpqy', 'staff', NULL, '2023-11-14 16:11:54', '2023-11-14 16:11:54'),
(2, 'King Ganancial', 'admin@gmail.com', NULL, '$2y$12$OAQ4KCccnqR6xTXiCWI1O..PP2TbZwAcKt1BP3bdUwySeL93gp0pm', 'admin', NULL, '2023-11-14 16:13:20', '2023-11-14 16:13:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
