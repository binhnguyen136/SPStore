-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2017 at 04:06 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `phoneshop`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cateParentList` ()  BEGIN
  SELECT *
        FROM categories
        WHERE id = parent_id
        AND ordinal > 0
        ORDER BY ordinal;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NewItemsList` ()  BEGIN
  SELECT  product.id AS id,
                                product.name AS name,
                                product.image AS image,
                                product.image1 AS image1,
                                product.primary_cost AS primary_cost,
                                product.cost AS cost,
                                category.name AS cate_name
                        FROM products product 
                        JOIN categories category
                        ON product.cate_id = category.id
                        ORDER BY product.created_at DESC
                        LIMIT 8;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Product` (IN `id` INT(11))  BEGIN
  select * from products where products.id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_all` ()  BEGIN
SELECT  product.id AS id,
                                product.name AS name,
                                product.image AS image,
                                product.image1 AS image1,
                                product.primary_cost AS primary_cost,
                                product.cost AS cost,
                                category.id AS cate_id,
                                category.parent_id AS cate_parent_id
                        FROM products product
                        JOIN categories category 
                        ON product.cate_id = category.id; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_list` (IN `type` INT(11))  BEGIN
SELECT  product.id AS id,
                                product.name AS name,
                                product.image AS image,
                                product.image1 AS image1,
                                product.primary_cost AS primary_cost,
                                product.cost AS cost,
                                category.id AS cate_id,
                                category.parent_id AS cate_parent_id
                        FROM products product
                        JOIN categories category 
                        ON product.cate_id = category.id
                        WHERE category.id = type
                        OR category.parent_id = type; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `related_List` (IN `cate_id` INT(11), IN `id` INT(11))  BEGIN
  select * from products where products.cate_id = cate_id AND products.id != id LIMIT 7;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SaleOffList` ()  BEGIN
  SELECT  product.id AS id,
                                product.name AS name,
                                product.image AS image,
                                product.image1 AS image1,
                                product.primary_cost AS primary_cost,
                                product.cost AS cost,
                                category.name AS cate_name
                        FROM products product
                        JOIN categories category
                        ON product.cate_id = category.id
                        WHERE primary_cost > cost
                        ORDER BY product.created_at DESC
                        LIMIT 8;
END$$

DELIMITER ;

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
(1, 'Binh Nguyen', 'quangbinh@gmail.com', '$2y$10$NFwkMvrsh/D38tkujWkxje3PGJyrVLYc58Ph4ma0SsDd1mdZNK/mO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 1, 'Mobile', 1, '2017-12-04 07:58:11', '2017-12-04 00:58:11'),
(2, 2, 'Tablet', 2, '2017-12-04 07:58:53', '2017-12-04 00:58:53'),
(3, 3, 'Laptop', 3, '2017-12-04 07:58:46', '2017-12-04 00:58:46'),
(4, 4, 'Accessory', 4, '2017-12-04 08:24:26', '2017-12-04 01:24:26'),
(5, 5, 'Sim', 5, '2017-12-04 08:24:32', '2017-12-04 01:24:32'),
(6, 1, 'Samsung', 1, '2017-12-04 16:11:32', '2017-12-04 09:11:32'),
(7, 1, 'Apple', 2, '2017-12-04 19:25:09', '2017-12-04 12:25:09'),
(8, 2, 'Ipad', 0, '2017-12-04 12:32:09', '2017-12-04 12:32:09'),
(9, 2, 'Galaxy Tab', 0, '2017-12-04 12:39:04', '2017-12-04 12:39:04'),
(10, 3, 'Asus', 0, '2017-12-04 12:41:28', '2017-12-04 12:41:28');

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `payment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `image1` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `image2` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `image3` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `cate_id` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `primary_cost` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `image1`, `image2`, `image3`, `cate_id`, `detail`, `primary_cost`, `cost`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Galaxy J7 plus', 'samsung-galaxy-j7-plus-1-400x460.png', 'samsung-galaxy-j7-plus-1-400x460.png', 'samsung-galaxy-j7-plus-1-400x460.png', 'samsung-galaxy-j7-plus-1-400x460.png', 6, 'this is samsung smart phone', 5000000, 4000000, 0, '2017-12-12 07:57:52', '2017-12-04 07:27:11'),
(2, 'Galaxy Note FE', 'samsung-galaxy-note-fe-ha-400x460.png', 'samsung-galaxy-note-fe-ha-400x460.png', 'samsung-galaxy-note-fe-ha-400x460.png', 'samsung-galaxy-note-fe-ha-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 07:33:12', '2017-12-04 07:33:12'),
(3, 'Galaxy S8 plus', 'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png', 'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png', 'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png', 'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 09:04:30', '2017-12-04 09:04:30'),
(4, 'Galaxy S8', 'samsung-galaxy-s8-4-400x460-400x460.png', 'samsung-galaxy-s8-4-400x460-400x460.png', 'samsung-galaxy-s8-4-400x460-400x460.png', 'samsung-galaxy-s8-4-400x460-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 09:07:44', '2017-12-04 09:07:44'),
(5, 'Galaxy J7 pro', 'samsung-galaxy-j7-pro-2323-400x460.png', 'samsung-galaxy-j7-pro-2323-400x460.png', 'samsung-galaxy-j7-pro-2323-400x460.png', 'samsung-galaxy-j7-pro-2323-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 09:42:58', '2017-12-04 09:42:58'),
(6, 'Galaxy Note 8', 'samsung-galaxy-note8-1-400x460.png', 'samsung-galaxy-note8-1-400x460.png', 'samsung-galaxy-note8-1-400x460.png', 'samsung-galaxy-note8-1-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 09:48:40', '2017-12-04 09:48:40'),
(7, 'Galaxy A7', 'samsung-galaxy-a7-2017-4-400x460.png', 'samsung-galaxy-a7-2017-4-400x460.png', 'samsung-galaxy-a7-2017-4-400x460.png', 'samsung-galaxy-a7-2017-4-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 09:51:07', '2017-12-04 09:51:07'),
(8, 'Galaxy A5', 'samsung-galaxy-a5-2017-400x460.png', 'samsung-galaxy-a5-2017-400x460.png', 'samsung-galaxy-a5-2017-400x460.png', 'samsung-galaxy-a5-2017-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 12:18:10', '2017-12-04 12:18:10'),
(9, 'Galaxy C9 pro', 'samsung-galaxy-c9-pro-1-400x460.png', 'samsung-galaxy-c9-pro-1-400x460.png', 'samsung-galaxy-c9-pro-1-400x460.png', 'samsung-galaxy-c9-pro-1-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 12:19:18', '2017-12-04 12:19:18'),
(10, 'Galaxy J7 Prime', 'samsung-galaxy-j7-prime-h12-400x460.png', 'samsung-galaxy-j7-prime-h12-400x460.png', 'samsung-galaxy-j7-prime-h12-400x460.png', 'samsung-galaxy-j7-prime-h12-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 12:22:53', '2017-12-04 12:22:53'),
(11, 'Iphone 8 plus', 'iphone-8-plus-256gb2-400x460.png', 'iphone-8-plus-256gb2-400x460.png', 'iphone-8-plus-256gb2-400x460.png', 'iphone-8-plus-256gb2-400x460.png', 7, 'This is apple smart phone', 5000000, 5000000, 0, '2017-12-04 12:26:23', '2017-12-04 12:26:23'),
(12, 'Iphone 8', 'iphone-8-256gb2-400x460.png', 'iphone-8-256gb2-400x460.png', 'iphone-8-256gb2-400x460.png', 'iphone-8-256gb2-400x460.png', 7, 'This is apple smart phone', 5000000, 5000000, 0, '2017-12-04 12:28:03', '2017-12-04 12:28:03'),
(13, 'Iphone 7 plus', 'iphone-7-plus-256gb-jet-black-3-400x460.png', 'iphone-7-plus-256gb-jet-black-3-400x460.png', 'iphone-7-plus-256gb-jet-black-3-400x460.png', 'iphone-7-plus-256gb-jet-black-3-400x460.png', 7, 'This is apple smart phone', 5000000, 5000000, 0, '2017-12-04 12:29:37', '2017-12-04 12:29:37'),
(14, 'Iphone 7', 'iphone-7-256gb-5-400x460.png', 'iphone-7-256gb-5-400x460.png', 'iphone-7-256gb-5-400x460.png', 'iphone-7-256gb-5-400x460.png', 7, 'This is apple smart phone', 5000000, 5000000, 0, '2017-12-04 12:30:13', '2017-12-04 12:30:13'),
(15, 'Ipad Pro', 'ipad-pro-105-inch-wifi-cellular-64gb-2017-400-400x460.png', 'ipad-pro-105-inch-wifi-cellular-64gb-2017-400-400x460.png', 'ipad-pro-105-inch-wifi-cellular-64gb-2017-400-400x460.png', 'ipad-pro-105-inch-wifi-cellular-64gb-2017-400-400x460.png', 8, 'this is ipad', 5000000, 5000000, 0, '2017-12-04 12:33:16', '2017-12-04 12:33:16'),
(16, 'Ipad wifi', 'ipad-wifi-cellular-128gb-2017-400-400x460.png', 'ipad-wifi-cellular-128gb-2017-400-400x460.png', 'ipad-wifi-cellular-128gb-2017-400-400x460.png', 'ipad-wifi-cellular-128gb-2017-400-400x460.png', 8, 'this is ipad', 5000000, 5000000, 0, '2017-12-04 12:34:30', '2017-12-04 12:34:30'),
(17, 'Ipad mini 4', 'ipad-mini-4-wifi-128gb-400-400x460.png', 'ipad-mini-4-wifi-128gb-400-400x460.png', 'ipad-mini-4-wifi-128gb-400-400x460.png', 'ipad-mini-4-wifi-128gb-400-400x460.png', 8, 'this is ipad', 5000000, 5000000, 0, '2017-12-04 12:36:59', '2017-12-04 12:36:59'),
(18, 'Galaxy Tab A6', 'samsung-galaxy-tab-a-70-1-400x460.png', 'samsung-galaxy-tab-a-70-1-400x460.png', 'samsung-galaxy-tab-a-70-1-400x460.png', 'samsung-galaxy-tab-a-70-1-400x460.png', 9, 'this is galaxy tab', 5000000, 5000000, 0, '2017-12-04 12:40:15', '2017-12-04 12:40:15'),
(19, 'Asus x441na', 'asus-x441na-n3350-ga017t-dai-dien-10000-450x300.jpg', 'asus-x441na-n3350-ga017t-dai-dien-10000-450x300.jpg', 'asus-x441na-n3350-ga017t-dai-dien-10000-450x300.jpg', 'asus-x441na-n3350-ga017t-dai-dien-10000-450x300.jpg', 10, 'this is laptop', 5000000, 5000000, 0, '2017-12-04 12:42:22', '2017-12-04 12:42:22');

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
(1, '01_12_2017_10_25_40_Samsung-Big-Note-8-800-300-GIF-1.gif', '.', '.', '...', 1, '2017-12-04 07:22:04', '2017-12-04 00:22:04'),
(2, '28_11_2017_11_07_28_iphoneX-800-300.png', '.', '.', '...', 2, '2017-12-04 00:22:20', '2017-12-04 00:22:20'),
(5, '100000_nokia8-760x325-1.jpg', '.', '.', '...', 3, '2017-12-04 00:49:20', '2017-12-04 00:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'binhnguyen', 'quangbinh136@gmail.com', '$2y$10$XyWgK6NS50o3P10YD6MYPureN3JnNM37aCJZP41H.GObGlhvxRyZW', NULL, NULL, 'COUnqhEiZYHWgTAuTEGyQhzRUhXqz9sa17k0vlsAN6T5YwdgzK2qKpJpjiMQ', '2017-12-12 10:00:05', '2017-12-12 19:23:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`,`status`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`id`);
