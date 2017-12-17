-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP PROCEDURE IF EXISTS `admin_cate_parent_list`;;
CREATE PROCEDURE `admin_cate_parent_list`()
BEGIN
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
END;;

DROP PROCEDURE IF EXISTS `cart_find_id`;;
CREATE PROCEDURE `cart_find_id`(IN `_id` INT(11))
BEGIN
  SELECT * FROM cart WHERE cart.id = _id;
END;;

DROP PROCEDURE IF EXISTS `cart_find_userid`;;
CREATE PROCEDURE `cart_find_userid`(IN `id` INT)
BEGIN
  SELECT * FROM cart WHERE cart.customer_id = id;
END;;

DROP PROCEDURE IF EXISTS `cart_insert`;;
CREATE PROCEDURE `cart_insert`(IN `_id` INT(11), IN `_total` INT(11))
BEGIN
  INSERT INTO cart(customer_id,total,created_at,updated_at) VALUES (_id,_total,NOW(),NOW());
END;;

DROP PROCEDURE IF EXISTS `cart_item_delete`;;
CREATE PROCEDURE `cart_item_delete`(IN `cart_id` INT, IN `product_id` INT)
BEGIN
  DELETE
    FROM cart_item
    WHERE cart_item.cart_id = cart_id
    AND cart_item.product_id = product_id;
END;;

DROP PROCEDURE IF EXISTS `cart_item_find_cartid`;;
CREATE PROCEDURE `cart_item_find_cartid`(IN `id` INT)
BEGIN
  SELECT * FROM cart_item WHERE cart_id = id;
END;;

DROP PROCEDURE IF EXISTS `cart_item_find_cartid_proid`;;
CREATE PROCEDURE `cart_item_find_cartid_proid`(IN `cartid` INT, IN `proid` INT)
BEGIN
  SELECT * FROM cart_item WHERE cart_item.cart_id = cartid AND cart_item.product_id = proid; 
END;;

DROP PROCEDURE IF EXISTS `cart_item_insert`;;
CREATE PROCEDURE `cart_item_insert`(IN `_cart_id` int(11), IN `_product_id` int(11), IN `_quantity` int(11))
BEGIN
declare item_remain int;

	start transaction;

	set item_remain = (select quantity from products where products.id = _product_id for update);
	-- test
	do sleep(10);

    if (_quantity > item_remain)
    then
		signal sqlstate '45000' set message_text = 'So luong san pham khong du';
    end if;

	insert into cart_item(cart_id, product_id, quantity, created_at, updated_at) values (_cart_id, _product_id, _quantity, now(), now());
	update products set products.quantity = products.quantity - _quantity where products.id = _product_id;

	commit;
END;;

DROP PROCEDURE IF EXISTS `cart_item_update_quantity`;;
CREATE PROCEDURE `cart_item_update_quantity`(IN `cart_id` INT, IN `product_id` INT, IN `quantity` INT)
BEGIN
  UPDATE cart_item 
    SET cart_item.quantity = quantity
    WHERE cart_item.cart_id = cart_id
    AND cart_item.product_id = product_id;
END;;

DROP PROCEDURE IF EXISTS `category_id`;;
CREATE PROCEDURE `category_id`(IN `id` INT(11))
BEGIN
  SELECT * from categories WHERE categories.id = id;
END;;

DROP PROCEDURE IF EXISTS `clear_cart_items`;;
CREATE PROCEDURE `clear_cart_items`(IN `id` INT)
BEGIN
  DELETE FROM cart_item WHERE cart_id = id;
END;;

DROP PROCEDURE IF EXISTS `list_categories`;;
CREATE PROCEDURE `list_categories`()
BEGIN
  SELECT cate.id AS cate_id, 
                            cate.name AS cate_name,
                            cate.parent_id AS parent_id, 
                            parent_cate.name AS parent_name 
                    FROM categories cate
                    LEFT OUTER JOIN categories parent_cate
                    ON cate.parent_id = parent_cate.id;
END;;

DROP PROCEDURE IF EXISTS `list_categories_ID`;;
CREATE PROCEDURE `list_categories_ID`(IN `id` INT(11))
BEGIN
  select * from categories where categories.parent_id = id AND categories.id != id;
END;;

DROP PROCEDURE IF EXISTS `new_items_list`;;
CREATE PROCEDURE `new_items_list`()
BEGIN
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
END;;

DROP PROCEDURE IF EXISTS `product`;;
CREATE PROCEDURE `product`(IN `id` INT(11))
BEGIN
  select * from products where products.id = id;
END;;

DROP PROCEDURE IF EXISTS `products_cate_id`;;
CREATE PROCEDURE `products_cate_id`(IN `cate_id` INT(11))
BEGIN
  SELECT * FROM products WHERE products.cate_id = cate_id;
END;;

DROP PROCEDURE IF EXISTS `product_all`;;
CREATE PROCEDURE `product_all`()
BEGIN
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
END;;

DROP PROCEDURE IF EXISTS `product_list`;;
CREATE PROCEDURE `product_list`(IN `type` INT(11))
BEGIN
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
END;;

DROP PROCEDURE IF EXISTS `related_List`;;
CREATE PROCEDURE `related_List`(IN `cate_id` INT(11), IN `id` INT(11))
BEGIN
  select * from products where products.cate_id = cate_id AND products.id != id LIMIT 7;
END;;

DROP PROCEDURE IF EXISTS `sale_off_list`;;
CREATE PROCEDURE `sale_off_list`()
BEGIN
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
END;;

DROP PROCEDURE IF EXISTS `user_cate_parent_list`;;
CREATE PROCEDURE `user_cate_parent_list`()
BEGIN
  SELECT *
        FROM categories
        WHERE id = parent_id
        AND ordinal > 0
        ORDER BY ordinal;
        END;;

DELIMITER ;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Binh Nguyen',	'quangbinh@gmail.com',	'$2y$10$NFwkMvrsh/D38tkujWkxje3PGJyrVLYc58Ph4ma0SsDd1mdZNK/mO',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cart` (`id`, `customer_id`, `total`, `created_at`, `updated_at`) VALUES
(46,	3,	5000000,	'2017-12-16 14:04:15',	'2017-12-16 14:04:15');

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cart_id` (`cart_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cart_item` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(178,	46,	3,	1,	'2017-12-16 14:45:52',	'2017-12-16 14:45:52'),
(181,	46,	1,	9,	'2017-12-16 17:10:51',	'2017-12-16 17:10:51');

DELIMITER ;;

CREATE TRIGGER `after_cart_item_insert` AFTER INSERT ON `cart_item` FOR EACH ROW
BEGIN
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
END;;

DELIMITER ;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordinal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `parent_id`, `name`, `ordinal`, `created_at`, `updated_at`) VALUES
(1,	1,	'Mobile',	1,	'2017-12-13 08:54:52',	'2017-12-13 01:54:52'),
(2,	2,	'Tablet',	2,	'2017-12-04 07:58:53',	'2017-12-04 00:58:53'),
(3,	3,	'Laptop',	3,	'2017-12-04 07:58:46',	'2017-12-04 00:58:46'),
(4,	4,	'Accessory',	4,	'2017-12-04 08:24:26',	'2017-12-04 01:24:26'),
(5,	5,	'Sim',	5,	'2017-12-04 08:24:32',	'2017-12-04 01:24:32'),
(6,	1,	'Samsung',	1,	'2017-12-04 16:11:32',	'2017-12-04 09:11:32'),
(7,	1,	'Apple',	2,	'2017-12-04 19:25:09',	'2017-12-04 12:25:09'),
(8,	2,	'Ipad',	0,	'2017-12-04 12:32:09',	'2017-12-04 12:32:09'),
(9,	2,	'Galaxy Tab',	0,	'2017-12-04 12:39:04',	'2017-12-04 12:39:04'),
(10,	3,	'Asus/Dell',	1,	'2017-12-13 08:42:05',	'2017-12-13 01:42:05');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table',	1),
('2014_10_12_100000_create_password_resets_table',	1),
('2017_07_29_132228_create_admins_table',	1);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `payment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`,`status`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `orders` (`id`, `customer_id`, `status`, `total`, `payment`, `created_at`, `updated_at`) VALUES
(1,	1,	'qwer',	134123431,	'COD',	'2017-12-14 14:18:09',	'2017-12-14 14:18:09');

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `cost`, `quantity`, `created_at`, `updated_at`) VALUES
(2,	1,	1,	4000000,	3,	'2017-12-14 14:20:02',	'2017-12-14 14:20:02'),
(10,	1,	2,	4000000,	3,	'2017-12-14 14:35:33',	'2017-12-14 14:35:33'),
(11,	1,	4,	5000000,	4,	'2017-12-14 14:44:24',	'2017-12-14 14:44:24'),
(12,	1,	1,	400000,	10,	'2017-12-15 07:19:38',	'2017-12-15 07:19:38'),
(13,	1,	2,	400000,	20,	'2017-12-15 07:20:55',	'2017-12-15 07:20:55');

DELIMITER ;;

CREATE TRIGGER `after_order_item_insert` AFTER INSERT ON `order_item` FOR EACH ROW
BEGIN
  DECLARE _order_item_product_id INT;
    DECLARE _order_item_quantity INT;
    DECLARE _product_quantity INT;
    DECLARE _product_qtt_after INT;
    SET _order_item_product_id = NEW.product_id;
    SET _order_item_quantity =  NEW.quantity;
    SET _product_quantity = (SELECT quantity FROM products WHERE products.id = _order_item_product_id);
    SET _product_qtt_after = _product_quantity - _order_item_quantity;
    UPDATE products SET products.quantity = _product_qtt_after WHERE products.id = _order_item_product_id;    
END;;

DELIMITER ;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`cate_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `products` (`id`, `name`, `image`, `image1`, `image2`, `image3`, `cate_id`, `detail`, `primary_cost`, `cost`, `quantity`, `created_at`, `updated_at`) VALUES
(1,	'Galaxy J7 plus',	'samsung-galaxy-j7-plus-1-400x460.png',	'samsung-galaxy-j7-plus-1-400x460.png',	'samsung-galaxy-j7-plus-1-400x460.png',	'samsung-galaxy-j7-plus-1-400x460.png',	6,	'this is samsung smart phone',	5000000,	4000000,	11,	'2017-12-16 17:10:42',	'2017-12-15 02:13:43'),
(2,	'Galaxy Note FE',	'samsung-galaxy-note-fe-ha-400x460.png',	'samsung-galaxy-note-fe-ha-400x460.png',	'samsung-galaxy-note-fe-ha-400x460.png',	'samsung-galaxy-note-fe-ha-400x460.png',	6,	'this is samsung smart phone',	5000000,	5000000,	50,	'2017-12-15 07:45:00',	'2017-12-15 00:45:00'),
(3,	'Galaxy S8 plus',	'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png',	'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png',	'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png',	'samsung-galaxy-s8-plus-tim-khoi-400-400x460.png',	6,	'this is samsung smart phone',	5000000,	5000000,	20,	'2017-12-15 07:21:09',	'2017-12-04 09:04:30'),
(4,	'Galaxy S8',	'samsung-galaxy-s8-4-400x460-400x460.png',	'samsung-galaxy-s8-4-400x460-400x460.png',	'samsung-galaxy-s8-4-400x460-400x460.png',	'samsung-galaxy-s8-4-400x460-400x460.png',	6,	'this is samsung smart phone',	5000000,	5000000,	0,	'2017-12-04 09:07:44',	'2017-12-04 09:07:44'),
(5,	'Galaxy J7 pro',	'samsung-galaxy-j7-pro-2323-400x460.png',	'samsung-galaxy-j7-pro-2323-400x460.png',	'samsung-galaxy-j7-pro-2323-400x460.png',	'samsung-galaxy-j7-pro-2323-400x460.png',	6,	'this is samsung smart phone',	5000000,	5000000,	0,	'2017-12-04 09:42:58',	'2017-12-04 09:42:58'),
(6,	'Galaxy Note 8',	'samsung-galaxy-note8-1-400x460.png',	'samsung-galaxy-note8-1-400x460.png',	'samsung-galaxy-note8-1-400x460.png',	'samsung-galaxy-note8-1-400x460.png',	6,	'This is Galaxy Note 8',	5000000,	4000000,	0,	'2017-12-13 08:42:57',	'2017-12-13 01:42:57'),
(7,	'Galaxy A7',	'samsung-galaxy-a7-2017-4-400x460.png',	'samsung-galaxy-a7-2017-4-400x460.png',	'samsung-galaxy-a7-2017-4-400x460.png',	'samsung-galaxy-a7-2017-4-400x460.png',	6,	'this is samsung smart phone',	5000000,	5000000,	0,	'2017-12-04 09:51:07',	'2017-12-04 09:51:07'),
(8,	'Galaxy A5',	'samsung-galaxy-a5-2017-400x460.png',	'samsung-galaxy-a5-2017-400x460.png',	'samsung-galaxy-a5-2017-400x460.png',	'samsung-galaxy-a5-2017-400x460.png',	6,	'this is samsung smart phone',	5000000,	5000000,	0,	'2017-12-04 12:18:10',	'2017-12-04 12:18:10'),
(9,	'Galaxy C9 pro',	'samsung-galaxy-c9-pro-1-400x460.png',	'samsung-galaxy-c9-pro-1-400x460.png',	'samsung-galaxy-c9-pro-1-400x460.png',	'samsung-galaxy-c9-pro-1-400x460.png',	6,	'this is samsung smart phone',	5000000,	5000000,	0,	'2017-12-04 12:19:18',	'2017-12-04 12:19:18'),
(10,	'Galaxy J7 Prime',	'samsung-galaxy-j7-prime-h12-400x460.png',	'samsung-galaxy-j7-prime-h12-400x460.png',	'samsung-galaxy-j7-prime-h12-400x460.png',	'samsung-galaxy-j7-prime-h12-400x460.png',	6,	'this is samsung smart phone',	5000000,	5000000,	0,	'2017-12-04 12:22:53',	'2017-12-04 12:22:53'),
(11,	'Iphone 8 plus',	'iphone-8-plus-256gb2-400x460.png',	'iphone-8-plus-256gb2-400x460.png',	'iphone-8-plus-256gb2-400x460.png',	'iphone-8-plus-256gb2-400x460.png',	7,	'This is apple smart phone',	5000000,	5000000,	0,	'2017-12-04 12:26:23',	'2017-12-04 12:26:23'),
(12,	'Iphone 8',	'iphone-8-256gb2-400x460.png',	'iphone-8-256gb2-400x460.png',	'iphone-8-256gb2-400x460.png',	'iphone-8-256gb2-400x460.png',	7,	'This is apple smart phone',	5000000,	5000000,	0,	'2017-12-04 12:28:03',	'2017-12-04 12:28:03'),
(13,	'Iphone 7 plus',	'iphone-7-plus-256gb-jet-black-3-400x460.png',	'iphone-7-plus-256gb-jet-black-3-400x460.png',	'iphone-7-plus-256gb-jet-black-3-400x460.png',	'iphone-7-plus-256gb-jet-black-3-400x460.png',	7,	'This is apple smart phone',	5000000,	5000000,	0,	'2017-12-04 12:29:37',	'2017-12-04 12:29:37'),
(14,	'Iphone 7',	'iphone-7-256gb-5-400x460.png',	'iphone-7-256gb-5-400x460.png',	'iphone-7-256gb-5-400x460.png',	'iphone-7-256gb-5-400x460.png',	7,	'This is apple smart phone',	5000000,	5000000,	0,	'2017-12-04 12:30:13',	'2017-12-04 12:30:13'),
(15,	'Ipad Pro',	'ipad-pro-105-inch-wifi-cellular-64gb-2017-400-400x460.png',	'ipad-pro-105-inch-wifi-cellular-64gb-2017-400-400x460.png',	'ipad-pro-105-inch-wifi-cellular-64gb-2017-400-400x460.png',	'ipad-pro-105-inch-wifi-cellular-64gb-2017-400-400x460.png',	8,	'this is ipad',	5000000,	5000000,	0,	'2017-12-04 12:33:16',	'2017-12-04 12:33:16'),
(16,	'Ipad wifi',	'ipad-wifi-cellular-128gb-2017-400-400x460.png',	'ipad-wifi-cellular-128gb-2017-400-400x460.png',	'ipad-wifi-cellular-128gb-2017-400-400x460.png',	'ipad-wifi-cellular-128gb-2017-400-400x460.png',	8,	'this is ipad',	5000000,	5000000,	0,	'2017-12-04 12:34:30',	'2017-12-04 12:34:30'),
(17,	'Ipad mini 4',	'ipad-mini-4-wifi-128gb-400-400x460.png',	'ipad-mini-4-wifi-128gb-400-400x460.png',	'ipad-mini-4-wifi-128gb-400-400x460.png',	'ipad-mini-4-wifi-128gb-400-400x460.png',	8,	'this is ipad',	5000000,	5000000,	0,	'2017-12-04 12:36:59',	'2017-12-04 12:36:59'),
(18,	'Galaxy Tab A6',	'samsung-galaxy-tab-a-70-1-400x460.png',	'samsung-galaxy-tab-a-70-1-400x460.png',	'samsung-galaxy-tab-a-70-1-400x460.png',	'samsung-galaxy-tab-a-70-1-400x460.png',	9,	'this is galaxy tab',	5000000,	5000000,	0,	'2017-12-04 12:40:15',	'2017-12-04 12:40:15'),
(19,	'Asus x441na',	'asus-x441na-n3350-ga017t-dai-dien-10000-450x300.jpg',	'asus-x441na-n3350-ga017t-dai-dien-10000-450x300.jpg',	'asus-x441na-n3350-ga017t-dai-dien-10000-450x300.jpg',	'asus-x441na-n3350-ga017t-dai-dien-10000-450x300.jpg',	10,	'this is laptop',	5000000,	5000000,	0,	'2017-12-04 12:42:22',	'2017-12-04 12:42:22');

DELIMITER ;;

CREATE TRIGGER `after_products_insert` AFTER INSERT ON `products` FOR EACH ROW
BEGIN
  DECLARE _products_quantity INT;
    SET _products_quantity = NEW.quantity;
    IF (_products_quantity < 0)
    THEN
      signal sqlstate '45000' 
         set message_text = "So luong product khong duoc am";
    END IF;
    IF (NEW.cost < 1000)
    THEN
      signal sqlstate '45000' 
         set message_text = "Gia ban khong duoc nho hon 1000";
    END IF;
    IF (NEW.primary_cost < NEW.cost)
    THEN
      signal sqlstate '45000' 
         set message_text = "Gia goc khong duoc nho hon gia ban";
    END IF;
END;;

CREATE TRIGGER `after_products_update` AFTER UPDATE ON `products` FOR EACH ROW
BEGIN
  DECLARE _products_quantity INT;
    SET _products_quantity = NEW.quantity;
    IF (_products_quantity < 0)
    THEN
      signal sqlstate '45000' 
         set message_text = "So luong product khong duoc am";
    END IF;
    IF (NEW.cost < 1000)
    THEN
      signal sqlstate '45000' 
         set message_text = "Gia ban khong duoc nho hon 1000";
    END IF;
    IF (NEW.primary_cost < NEW.cost)
    THEN
      signal sqlstate '45000' 
         set message_text = "Gia goc khong duoc nho hon gia ban";
    END IF;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `slides`;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordinal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `slides` (`id`, `image`, `title`, `content`, `link`, `ordinal`, `created_at`, `updated_at`) VALUES
(12,	'01_12_2017_10_25_40_Samsung-Big-Note-8-800-300-GIF-1.gif',	'xxx',	'xxzzzzz',	'google.com',	1,	'2017-12-13 08:55:25',	'2017-12-13 01:55:25'),
(13,	'28_11_2017_11_07_28_iphoneX-800-300.png',	'xwx',	'wxw',	'google.com',	2,	'2017-12-13 01:02:39',	'2017-12-13 01:02:39');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'nam',	'nam@gmail.com',	'$2y$10$Yh5GWoyIWl1mSoxnP10PjekHXln0sYr4WBw8pMGaEnxSia0LrFTXS',	'0917218297',	'HoChiMinh City',	'tZZsFSSgJWKVkH4iF9jQYAm8MLNVnCQBUrkjIrD7cWfDXyNbjPFPD8L4oEdv',	'2017-12-12 03:49:40',	'2017-12-14 02:35:25'),
(2,	'namcool',	'nam10@gmail.com',	'$2y$10$n4XBZapz.jHkSxwamcYrW.MX.90c4DO2VufAre04RxYxk/zXAgsVu',	NULL,	NULL,	'gFD17rATNyltaupMWCerPZtmjcVU1jZKXvKKM5twiH02CUmHfiuK4Xed8DNj',	'2017-12-13 02:26:04',	'2017-12-13 02:28:09'),
(3,	'Binh Nguyen',	'quangbinh136@gmail.com',	'$2y$10$ZmdQAcVDsquA6EWOtyM8nu0iqAUdFtw7Z.KI8GofZqrUQ3Iq.BbWC',	NULL,	NULL,	'DMBjAamsvWM1jmSEMliFhfnSaTmV3KbbTR1JYCXAZHDkOgFehl4vKq6EEljN',	'2017-12-15 08:24:27',	'2017-12-16 07:45:41');

-- 2017-12-17 03:04:54
