-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 05:38 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_wash`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `category_name`, `category_image`, `category_description`, `category_status`, `created_at`, `updated_at`) VALUES
(3, 6, 'sddfsdfds', 'Category/vnwkUvitsmaHzbL58hbPQic82eysyKqO72zhPOv4.png', 'sddfsdf', 1, '2021-07-30 17:41:23', '2021-07-30 17:41:23'),
(4, 6, 'assddfsdfds', 'Category/nVgaVacTlV2sJOhufnyfBWF1AM4Y6Tu9cVkLZlUR.png', 'sddfsdf', 1, '2021-07-30 17:51:58', '2021-07-30 17:51:58'),
(5, 6, 'assddfsdfdssjhduiadf', 'Category/ob923YYEVVfGrNAo8YefwbBNGmIKQtmKCm7mDhWB.png', 'sddfsdf', 1, '2021-07-30 23:56:54', '2021-07-30 23:56:54'),
(6, 0, 'demo', 'Category/ae83iuUFdGvR5THav7wGNMaliAg494FE3FoxpEaN.jpg', 'kljufidsfsdfsdfjksdfsdfdshfhsdfjmsdisdf sfsd\r\nfsdfsdf\r\nsdfsdfsd\r\nf', 0, '2021-07-31 00:52:57', '2021-07-31 00:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `profile` text COLLATE utf8mb4_unicode_ci,
  `customer_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `gender`, `address`, `profile`, `customer_status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '9636200102', NULL, NULL, NULL, 0, '2021-08-03 13:48:24', '2021-08-03 13:48:24'),
(2, NULL, NULL, '963620010', NULL, NULL, NULL, 0, '2021-08-03 13:51:59', '2021-08-03 13:51:59'),
(3, NULL, NULL, '9636200106', NULL, NULL, NULL, 0, '2021-08-03 21:37:33', '2021-08-03 21:37:33'),
(4, NULL, NULL, '9636200109', NULL, NULL, NULL, 0, '2021-08-03 21:41:02', '2021-08-03 21:41:02'),
(5, NULL, NULL, '9636200185', NULL, NULL, NULL, 0, '2021-08-03 22:17:47', '2021-08-03 22:17:47'),
(6, NULL, NULL, '9636200152', NULL, NULL, NULL, 0, '2021-08-05 01:46:07', '2021-08-05 01:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2021_07_28_130159_create_categories_table', 2),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(13, '2021_08_03_165429_customer', 4),
(14, '2021_08_03_191037_create_customers_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'myapptoken', '95faf91b7a5f6262e42cafb03d28e77294cffb21579c2fbb2201328ea4d1e2ce', '[\"*\"]', '2021-08-04 22:50:31', '2021-07-28 08:27:58', '2021-08-04 22:50:31'),
(2, 'App\\Models\\User', 1, 'myapptoken', 'cf2f8143222865c9d6a49d5c1533d06bd037c84bb32c7439a76629efaaf20dcf', '[\"*\"]', NULL, '2021-07-31 00:17:54', '2021-07-31 00:17:54'),
(3, 'App\\Models\\User', 1, 'myapptoken', '5274b8fb27a7f0073e3c9a7d0b8bcbaaaca55bb349c5ad9fe4c9b34c5766fb8a', '[\"*\"]', NULL, '2021-07-31 00:18:47', '2021-07-31 00:18:47'),
(4, 'App\\Models\\User', 1, 'myapptoken', '647a3c43f0d712893d4b12fb0c3b757a5b816bde4e1edd2a2ec27e73bcb6b543', '[\"*\"]', NULL, '2021-07-31 00:19:29', '2021-07-31 00:19:29'),
(5, 'App\\Models\\User', 1, 'myapptoken', 'cc27aa81168e9f12a94e7a9e03dd311b166ba49e24cd553352e30552633c8ff2', '[\"*\"]', '2021-07-31 00:52:57', '2021-07-31 00:23:08', '2021-07-31 00:52:57'),
(6, 'App\\Models\\User', 1, 'myapptoken', '2c80b7415594da37b7ff850ea274c0d185696fc7a35c529967b5678fc2e76b69', '[\"*\"]', NULL, '2021-07-31 04:39:59', '2021-07-31 04:39:59'),
(7, 'App\\Models\\Customer', 1, 'phone', '56776bfd0702e4470e54a495ae6d134dab8d6314adfe674e1361ece2911ba500', '[\"*\"]', NULL, '2021-08-03 21:19:49', '2021-08-03 21:19:49'),
(8, 'App\\Models\\Customer', 1, 'phone', '5a0788d26b562b65941544b2926bbaeeecdd8ea25b4a09814219ea919757700e', '[\"*\"]', NULL, '2021-08-03 21:32:20', '2021-08-03 21:32:20'),
(9, 'App\\Models\\Customer', 1, 'phone', 'a58ef706e38a40356f5221b6fa2282ad3927210b70b482cd8864b1722c4e200f', '[\"*\"]', NULL, '2021-08-03 21:33:40', '2021-08-03 21:33:40'),
(10, 'App\\Models\\Customer', 1, 'myapptoken', '33ab2725f2012547fd9a5f16ef8b35020d055c0195dec95512b9a4bb3a012f39', '[\"*\"]', NULL, '2021-08-03 21:36:06', '2021-08-03 21:36:06'),
(11, 'App\\Models\\Customer', 3, 'myapptoken', '5ae83161232c452239872d07b9825555de0432a6cde7537102ab2803b5180c81', '[\"*\"]', NULL, '2021-08-03 21:37:33', '2021-08-03 21:37:33'),
(12, 'App\\Models\\Customer', 4, 'myapptoken', 'c726860758e5d71f561aabb567904cf303c04ac73bdd4359b65d4fc77b2b91f4', '[\"*\"]', NULL, '2021-08-03 21:41:02', '2021-08-03 21:41:02'),
(13, 'App\\Models\\Customer', 5, 'myapptoken', '6d3bf5581e3af0877505cb1b2f7ea3d4b989ffb7eb5f37d3c3b9a721d9b9129e', '[\"*\"]', NULL, '2021-08-03 22:17:47', '2021-08-03 22:17:47'),
(14, 'App\\Models\\Customer', 1, 'myapptoken', '812d7ce09eff5895fd7a63cf921dae49aefce0c5d16d0e1fea1f8efe0994e6a4', '[\"*\"]', NULL, '2021-08-03 22:18:11', '2021-08-03 22:18:11'),
(15, 'App\\Models\\Customer', 1, 'myapptoken', 'e5aeb9cd56ce8e9c0df3134f840d23aaa8a83132a3391fb535f9893bc29d7ded', '[\"*\"]', NULL, '2021-08-03 22:18:13', '2021-08-03 22:18:13'),
(16, 'App\\Models\\Customer', 1, 'myapptoken', 'ec7bf5d5318d5157cb8de51f6e86faf23d529998d2a2c133e274df32e55cbdfb', '[\"*\"]', NULL, '2021-08-03 22:18:14', '2021-08-03 22:18:14'),
(17, 'App\\Models\\Customer', 1, 'myapptoken', 'a703122b2bc53bb3dd691b264d385b5101de10c9eeab83df81981c6feae73a4a', '[\"*\"]', NULL, '2021-08-03 22:18:15', '2021-08-03 22:18:15'),
(18, 'App\\Models\\Customer', 1, 'myapptoken', 'f8a798affb80a0f63f9892c4226719219d52ae6559992470b5828f61aecb86ef', '[\"*\"]', NULL, '2021-08-03 22:18:16', '2021-08-03 22:18:16'),
(19, 'App\\Models\\Customer', 5, 'myapptoken', '8c3a95c06b28d7d19db5ec122c01c9333e0f59bb5ede3d3b982ea323a0507f65', '[\"*\"]', NULL, '2021-08-03 22:19:48', '2021-08-03 22:19:48'),
(20, 'App\\Models\\Customer', 5, 'myapptoken', 'f03c3ac022a9765865495b9ab23f6378691f9793068a5e4b16c5a95eb781573a', '[\"*\"]', NULL, '2021-08-03 22:19:54', '2021-08-03 22:19:54'),
(21, 'App\\Models\\Customer', 5, 'myapptoken', '08ec24361859eafea6b623f67d2eca29f8692ed975052291e17900e17e3d2d76', '[\"*\"]', NULL, '2021-08-03 22:19:55', '2021-08-03 22:19:55'),
(22, 'App\\Models\\User', 1, 'myapptoken', '1618c669f0d2f42540b1960f09eda7000b3b57a735d38883fa66491c6b973738', '[\"*\"]', NULL, '2021-08-03 23:44:18', '2021-08-03 23:44:18'),
(26, 'App\\Models\\Customer', 6, 'myapptoken', '0ddbbb3b8a4af662485dc476eaf0b648d36c27d92500721179cce0a38a064e13', '[\"*\"]', NULL, '2021-08-05 01:46:07', '2021-08-05 01:46:07'),
(27, 'App\\Models\\Customer', 5, 'myapptoken', 'cf832df609c2151498f67a0c98af9f61cb4ac119034de943d9e81d8fa8f5a431', '[\"*\"]', NULL, '2021-08-05 12:06:02', '2021-08-05 12:06:02'),
(28, 'App\\Models\\Customer', 5, 'myapptoken', 'f5f7ca490b2eaf6ea873aae771e5de8497501a7b5d5398c99ded3e8d1a9ce743', '[\"*\"]', NULL, '2021-08-05 12:06:12', '2021-08-05 12:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sumer Singh Harawat', 'sumersingh1997.ssh@gmail.com', NULL, '$2y$10$HoA5n0QXhIuoJUZ5mQwGoujv2g9IP2aH5cE.VY6A6gIOQp61TmMLm', NULL, '2021-07-27 12:10:54', '2021-07-27 12:10:54'),
(2, 'Sumer Singh Harawat', 'sumer@microlent.com', NULL, '$2y$10$CYI1oD3E/MrOror7u3Dc3O2DmnB.z0qsRrP65WCrDUPC7TqCrp49m', NULL, '2021-07-28 13:36:01', '2021-07-28 13:36:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
