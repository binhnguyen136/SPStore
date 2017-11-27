-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2017 at 05:30 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gbshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Binh Nguyen', 'admin@gmail.com', '$2y$10$NFwkMvrsh/D38tkujWkxje3PGJyrVLYc58Ph4ma0SsDd1mdZNK/mO', 'f5wy7qgo811gLDx2BF2EII8ImvfqgU4yAAT6teiITSypfFp0VzLHyizCXdHA', NULL, '2017-09-28 22:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordinal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `ordinal`, `created_at`, `updated_at`) VALUES
(1, 1, 'clothing', 1, '2017-08-21 18:39:30', '2017-08-21 11:39:30'),
(2, 2, 'shoes', 2, '2017-08-21 18:39:38', '2017-08-21 11:39:38'),
(3, 1, 'shirt', 1, '2017-08-21 18:37:41', '2017-08-21 11:37:41'),
(4, 1, 'hoodies', 2, '2017-08-21 18:37:56', '2017-08-21 11:37:56'),
(5, 2, 'nike', 1, '2017-08-20 07:05:38', '2017-08-20 00:05:38'),
(6, 6, 'accessories', 3, '2017-08-22 18:36:58', '2017-08-22 11:36:58'),
(7, 2, 'adidas', 2, '2017-08-22 05:30:05', '2017-08-21 22:30:05'),
(8, 2, 'vans', 3, '2017-08-22 05:30:42', '2017-08-21 22:30:42'),
(9, 2, 'puma', 4, '2017-08-22 18:10:16', '2017-08-22 11:10:16'),
(10, 2, 'ethnie', 5, '2017-08-22 18:30:15', '2017-08-22 11:30:15'),
(11, 2, 'converse', 6, '2017-08-22 18:30:55', '2017-08-22 11:30:55'),
(12, 2, 'jordan', 7, '2017-08-22 18:36:07', '2017-08-22 11:36:07'),
(13, 6, 'hats', 1, '2017-08-22 18:40:43', '2017-08-22 11:40:43'),
(14, 6, 'wallets', 2, '2017-08-22 18:50:38', '2017-08-22 11:50:38'),
(15, 6, 'backpack', 3, '2017-09-26 10:09:04', '2017-09-26 03:09:04'),
(16, 1, 'jean', 3, '2017-09-28 09:11:26', '2017-09-28 02:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_07_29_132228_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `image`, `content`, `created_at`, `updated_at`) VALUES
(5, '1.jpg', 'gb', '2017-09-18 23:22:05', '2017-09-18 23:22:05'),
(6, '2.jpg', 'gb', '2017-09-18 23:22:18', '2017-09-18 23:22:18'),
(7, '3.jpg', 'gb', '2017-09-18 23:22:32', '2017-09-18 23:22:32'),
(8, '4.jpg', 'gb', '2017-09-18 23:22:45', '2017-09-18 23:22:45'),
(9, '5.jpg', 'gb', '2017-09-18 23:23:00', '2017-09-18 23:23:00'),
(10, '6.jpg', 'gb', '2017-09-18 23:23:17', '2017-09-18 23:23:17'),
(11, '8.jpg', 'gb', '2017-09-19 10:09:10', '2017-09-19 10:09:10'),
(12, '9.jpg', 'gb', '2017-09-19 10:09:22', '2017-09-19 10:09:22'),
(14, '10.jpg', 'gb', '2017-09-19 10:09:42', '2017-09-19 10:09:42'),
(15, '11.jpg', 'gb', '2017-09-19 10:09:57', '2017-09-19 10:09:57'),
(16, '12.jpg', 'gb', '2017-09-19 10:10:06', '2017-09-19 10:10:06'),
(17, '8.jpg', 'bixu', '2017-10-03 01:52:37', '2017-10-02 18:52:37'),
(18, '11.jpg', 'bixu', '2017-10-02 18:52:09', '2017-10-02 18:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cate_id` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `primary_cost` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `image1`, `image2`, `image3`, `cate_id`, `detail`, `primary_cost`, `cost`, `created_at`, `updated_at`) VALUES
(7, 'shirt 1', 'shirt_1.jpg', 'shirt_2.jpg', 'shirt_1.jpg', 'shirt_2.jpg', 3, 'gb shop', 20, 19, '2017-09-19 15:16:34', '2017-09-19 08:16:34'),
(8, 'shirt 2', 'shirt_2.jpg', 'shirt_1.jpg', 'shirt_2.jpg', 'shirt_1.jpg', 3, 'gb shop', 20, 20, '2017-09-19 06:37:43', '2017-09-19 06:37:43'),
(9, 'shirt 3', 'shirts_3.jpg', 'shirt_4.jpg', 'shirts_3.jpg', 'shirt_4.jpg', 3, 'gb shop', 20, 20, '2017-09-19 06:38:32', '2017-09-19 06:38:32'),
(10, 'shirt 4', 'shirt_4.jpg', 'shirts_3.jpg', 'shirt_4.jpg', 'shirts_3.jpg', 3, 'gb shop', 20, 20, '2017-09-19 06:39:12', '2017-09-19 06:39:12'),
(11, 'shirt 5', 'shirt_5.jpg', 'shirt_6.jpg', 'shirt_5.jpg', 'shirt_6.jpg', 3, 'gb shop', 20, 20, '2017-09-19 06:39:45', '2017-09-19 06:39:45'),
(12, 'shirt 6', 'shirt_6.jpg', 'shirt_7.jpg', 'shirt_6.jpg', 'shirt_7.jpg', 3, 'gb shop', 22, 20, '2017-09-20 02:32:25', '2017-09-19 19:32:25'),
(13, 'shirt 7', 'shirt_7.jpg', 'shirt_6.jpg', 'shirt_7.jpg', 'shirt_6.jpg', 3, 'gb shop', 20, 15, '2017-09-20 02:33:00', '2017-09-19 19:33:00'),
(14, 'shoes 1', 'shoes_1.jpg', 'shoes_2.jpg', 'shoes_1.jpg', 'shoes_2.jpg', 5, 'gb shop', 20, 20, '2017-09-20 02:29:32', '2017-09-19 19:29:32'),
(15, 'backpack 1', 'accessory_4.jpg', 'accessory_3.jpg', 'accessory_4.jpg', 'accessory_3.jpg', 15, 'gb shop', 20, 20, '2017-09-20 02:31:45', '2017-09-19 19:31:45'),
(16, 'hat 1', 'accessory_2.jpg', 'accessory_1.jpg', 'accessory_2.jpg', 'accessory_1.jpg', 13, 'gb shop', 30, 25, '2017-09-19 20:00:38', '2017-09-19 20:00:38'),
(17, 'hat 2', 'accessory_1.jpg', 'accessory_2.jpg', 'accessory_4.jpg', 'accessory_3.jpg', 13, 'gb shop', 30, 25, '2017-09-19 20:19:11', '2017-09-19 20:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordinal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `image`, `title`, `content`, `link`, `ordinal`, `created_at`, `updated_at`) VALUES
(9, '1.jpg', 'The shoes for summer', 'Shoes Vans <br> $160.00', '...', 1, '2017-08-16 06:31:14', '2017-08-15 23:31:14'),
(10, '2.jpg', 'new fashion for winter', 'new jacket <br> only $60', '...', 2, '2017-08-16 06:31:21', '2017-08-15 23:31:21'),
(11, '3.jpg', 'new T-shirt', 'vintage raglan', '...', 3, '2017-08-16 06:31:27', '2017-08-15 23:31:27'),
(13, '4.jpg', 'what\'s trending', 'look book <br> fashion 2015', '...', 4, '2017-08-18 08:31:55', '2017-08-18 01:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Quang Binh', 'quangbinh136@gmail.com', '$2y$10$2QbzIpnMXwnf3Uao5mD71uyloOaDPK/SCqVFlJ9VpcSskFhVHkGLu', NULL, '2017-07-29 07:40:46', '2017-07-29 07:40:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;