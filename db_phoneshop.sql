-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 15, 2017 lúc 08:00 SA
-- Phiên bản máy phục vụ: 5.7.14
-- Phiên bản PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_phoneshop`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_cate_parent_list` ()  BEGIN
	SELECT  cate.ordinal AS cate_ordinal,
                            cate.id AS cate_id,
                            cate.name AS cate_name,
                            parent_cate.id AS parent_id,
                            parent_cate.name AS parent_name
                    FROM categories cate
                    LEFT OUTER JOIN categories parent_cate
                    ON cate.parent_id = parent_cate.id
                    WHERE cate.id = cate.parent_id
                    ORDER BY cate.ordinal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cart_find_id` (IN `_id` INT(11))  BEGIN
	SELECT * FROM cart WHERE cart.customer_id = _id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cart_insert` (IN `_id` INT(11), IN `_total` INT(11))  BEGIN
	INSERT INTO cart(customer_id,total,created_at,updated_at) VALUES (_id,_total,NOW(),NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cart_item_insert` (IN `_cart_id` INT(11), IN `_product_id` INT(11), IN `_quantity` INT(11))  BEGIN
	INSERT INTO cart_item(cart_id,product_id,quantity,created_at,updated_at) VALUES (_cart_id,_product_id,_quantity,NOW(),NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `category_id` (IN `id` INT(11))  BEGIN
	SELECT * from categories WHERE categories.id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `list_categories` ()  BEGIN
	SELECT cate.id AS cate_id, 
                            cate.name AS cate_name,
                            cate.parent_id AS parent_id, 
                            parent_cate.name AS parent_name 
                    FROM categories cate
                    LEFT OUTER JOIN categories parent_cate
                    ON cate.parent_id = parent_cate.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `list_categories_ID` (IN `id` INT(11))  BEGIN
	select * from categories where categories.parent_id = id AND categories.id != id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_items_list` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product` (IN `id` INT(11))  BEGIN
	select * from products where products.id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `products_cate_id` (IN `cate_id` INT(11))  BEGIN
	SELECT * FROM products WHERE products.cate_id = cate_id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sale_off_list` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_cate_parent_list` ()  BEGIN
	SELECT *
        FROM categories
        WHERE id = parent_id
        AND ordinal > 0
        ORDER BY ordinal;
        END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
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
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Binh Nguyen', 'quangbinh@gmail.com', '$2y$10$NFwkMvrsh/D38tkujWkxje3PGJyrVLYc58Ph4ma0SsDd1mdZNK/mO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `customer_id`, `total`, `created_at`, `updated_at`) VALUES
(17, 1, 35000000, '2017-12-14 09:35:56', '2017-12-14 09:35:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bẫy `cart_item`
--
DELIMITER $$
CREATE TRIGGER `after_cart_item_insert` AFTER INSERT ON `cart_item` FOR EACH ROW BEGIN
	DECLARE _cart_item_qtt INT;
    DECLARE _product_qtt INT;
    DECLARE _cart_item_product_id INT;
    SET _cart_item_product_id = (SELECT product_id FROM cart_item WHERE cart_item.id = NEW.id);
    SET _cart_item_qtt = (SELECT quantity FROM cart_item WHERE cart_item.id = NEW.id);
    SET _product_qtt = (SELECT quantity FROM products WHERE products.id = _cart_item_product_id);
    IF (_cart_item_qtt > _product_qtt)
    THEN
    	signal sqlstate '45000' 
         set message_text = "So luong product khong du";
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
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
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `ordinal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mobile', 1, '2017-12-13 08:54:52', '2017-12-13 01:54:52'),
(2, 2, 'Tablet', 2, '2017-12-04 07:58:53', '2017-12-04 00:58:53'),
(3, 3, 'Laptop', 3, '2017-12-04 07:58:46', '2017-12-04 00:58:46'),
(4, 4, 'Accessory', 4, '2017-12-04 08:24:26', '2017-12-04 01:24:26'),
(5, 5, 'Sim', 5, '2017-12-04 08:24:32', '2017-12-04 01:24:32'),
(6, 1, 'Samsung', 1, '2017-12-04 16:11:32', '2017-12-04 09:11:32'),
(7, 1, 'Apple', 2, '2017-12-04 19:25:09', '2017-12-04 12:25:09'),
(8, 2, 'Ipad', 0, '2017-12-04 12:32:09', '2017-12-04 12:32:09'),
(9, 2, 'Galaxy Tab', 0, '2017-12-04 12:39:04', '2017-12-04 12:39:04'),
(10, 3, 'Asus/Dell', 1, '2017-12-13 08:42:05', '2017-12-13 01:42:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_07_29_132228_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
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

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `status`, `total`, `payment`, `created_at`, `updated_at`) VALUES
(1, 1, 'qwer', 134123431, 'COD', '2017-12-14 14:18:09', '2017-12-14 14:18:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
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

--
-- Đang đổ dữ liệu cho bảng `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `cost`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 4000000, 3, '2017-12-14 14:20:02', '2017-12-14 14:20:02'),
(10, 1, 2, 4000000, 3, '2017-12-14 14:35:33', '2017-12-14 14:35:33'),
(11, 1, 4, 5000000, 4, '2017-12-14 14:44:24', '2017-12-14 14:44:24'),
(12, 1, 1, 400000, 10, '2017-12-15 07:19:38', '2017-12-15 07:19:38'),
(13, 1, 2, 400000, 20, '2017-12-15 07:20:55', '2017-12-15 07:20:55');

--
-- Bẫy `order_item`
--
DELIMITER $$
CREATE TRIGGER `after_order_item_insert` AFTER INSERT ON `order_item` FOR EACH ROW BEGIN
	DECLARE _order_item_product_id INT;
    DECLARE _order_item_quantity INT;
    DECLARE _product_quantity INT;
    DECLARE _product_qtt_after INT;
    SET _order_item_product_id = NEW.product_id;
    SET _order_item_quantity =  NEW.quantity;
    SET _product_quantity = (SELECT quantity FROM products WHERE products.id = _order_item_product_id);
    SET _product_qtt_after = _product_quantity - _order_item_quantity;
    UPDATE products SET products.quantity = _product_qtt_after WHERE products.id = _order_item_product_id;    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
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
-- Cấu trúc bảng cho bảng `products`
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
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `image1`, `image2`, `image3`, `cate_id`, `detail`, `primary_cost`, `cost`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Galaxy J7 plus', 'samsung-galaxy-j7-plus-1-400x460.png', 'samsung-galaxy-j7-plus-1-400x460.png', 'samsung-galaxy-j7-plus-1-400x460.png', 'samsung-galaxy-j7-plus-1-400x460.png', 6, 'this is samsung smart phone', 5000000, 4000000, 5, '2017-12-15 07:19:38', '2017-12-13 02:46:59'),
(2, 'Galaxy Note FE', 'samsung-galaxy-note-fe-ha-400x460.png', 'samsung-galaxy-note-fe-ha-400x460.png', 'samsung-galaxy-note-fe-ha-400x460.png', 'samsung-galaxy-note-fe-ha-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 50, '2017-12-15 07:45:00', '2017-12-15 00:45:00'),
(3, 'Galaxy S8 plus', 'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png', 'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png', 'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png', 'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 20, '2017-12-15 07:21:09', '2017-12-04 09:04:30'),
(4, 'Galaxy S8', 'samsung-galaxy-s8-4-400x460-400x460.png', 'samsung-galaxy-s8-4-400x460-400x460.png', 'samsung-galaxy-s8-4-400x460-400x460.png', 'samsung-galaxy-s8-4-400x460-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 09:07:44', '2017-12-04 09:07:44'),
(5, 'Galaxy J7 pro', 'samsung-galaxy-j7-pro-2323-400x460.png', 'samsung-galaxy-j7-pro-2323-400x460.png', 'samsung-galaxy-j7-pro-2323-400x460.png', 'samsung-galaxy-j7-pro-2323-400x460.png', 6, 'this is samsung smart phone', 5000000, 5000000, 0, '2017-12-04 09:42:58', '2017-12-04 09:42:58'),
(6, 'Galaxy Note 8', 'samsung-galaxy-note8-1-400x460.png', 'samsung-galaxy-note8-1-400x460.png', 'samsung-galaxy-note8-1-400x460.png', 'samsung-galaxy-note8-1-400x460.png', 6, 'This is Galaxy Note 8', 5000000, 4000000, 0, '2017-12-13 08:42:57', '2017-12-13 01:42:57'),
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

--
-- Bẫy `products`
--
DELIMITER $$
CREATE TRIGGER `after_products_cost_insert` AFTER INSERT ON `products` FOR EACH ROW BEGIN
	IF (NEW.primary_cost < NEW.cost)
    THEN
    	signal sqlstate '45000' 
         set message_text = "Gia goc khong duoc nho hon gia ban";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_products_cost_update` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
	IF (NEW.primary_cost < NEW.cost)
    THEN
    	signal sqlstate '45000' 
         set message_text = "Gia goc khong duoc nho hon gia ban";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_products_insert` AFTER INSERT ON `products` FOR EACH ROW BEGIN
	DECLARE _product_primary_cost INT;
    SET _product_primary_cost = NEW.primary_cost;
    IF ( _product_primary_cost < 1000 )
    THEN
    	signal sqlstate '45000' 
         set message_text = "Gia product khong duoc < 1000";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_products_update` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
	DECLARE _products_quantity INT;
    SET _products_quantity = NEW.quantity;
    IF (_products_quantity < 0)
    THEN
    	signal sqlstate '45000' 
         set message_text = "So luong product khong duoc am";
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
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
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`id`, `image`, `title`, `content`, `link`, `ordinal`, `created_at`, `updated_at`) VALUES
(12, '01_12_2017_10_25_40_Samsung-Big-Note-8-800-300-GIF-1.gif', 'xxx', 'xxzzzzz', 'google.com', 1, '2017-12-13 08:55:25', '2017-12-13 01:55:25'),
(13, '28_11_2017_11_07_28_iphoneX-800-300.png', 'xwx', 'wxw', 'google.com', 2, '2017-12-13 01:02:39', '2017-12-13 01:02:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nam', 'nam@gmail.com', '$2y$10$Yh5GWoyIWl1mSoxnP10PjekHXln0sYr4WBw8pMGaEnxSia0LrFTXS', '0917218297', 'HoChiMinh City', 'tZZsFSSgJWKVkH4iF9jQYAm8MLNVnCQBUrkjIrD7cWfDXyNbjPFPD8L4oEdv', '2017-12-12 03:49:40', '2017-12-14 02:35:25'),
(2, 'namcool', 'nam10@gmail.com', '$2y$10$n4XBZapz.jHkSxwamcYrW.MX.90c4DO2VufAre04RxYxk/zXAgsVu', NULL, NULL, 'gFD17rATNyltaupMWCerPZtmjcVU1jZKXvKKM5twiH02CUmHfiuK4Xed8DNj', '2017-12-13 02:26:04', '2017-12-13 02:28:09');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`,`status`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
