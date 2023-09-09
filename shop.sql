-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-09-09 09:46:03
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shop`
--

-- --------------------------------------------------------

--
-- 資料表結構 `like_t`
--

CREATE TABLE `like_t` (
  `product_id` int(100) NOT NULL,
  `buyer_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `like_t`
--

INSERT INTO `like_t` (`product_id`, `buyer_id`) VALUES
(34, 9),
(34, 10);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `choice` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`product_id`, `seller_id`, `name`, `price`, `description`, `image_url`, `choice`) VALUES
(34, 4, '楊家蛋黃酥', '50.00', '純手工製作的蛋黃酥，使用上等蛋黃，以及低筋麵粉，在台中已經有80年的歷史。', './images/1.jpg', '食物'),
(35, 4, '電競耳機', '700.00', '藍芽電競耳機', './images/2.jpg', '電子'),
(36, 4, '水果蛋糕', '210.00', '從團購人氣王起司蛋糕，觀光客指定的千層蛋糕到最具代表性的台灣伴手禮-鳳梨酥。盡在xxx，蛋糕同時也是您生日，彌月，母親節蛋糕的最佳選擇。', './images/3.jpg', '食物');

-- --------------------------------------------------------

--
-- 資料表結構 `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `sellers`
--

INSERT INTO `sellers` (`seller_id`, `name`, `password`, `address`) VALUES
(4, 'john', '0', 's');

-- --------------------------------------------------------

--
-- 資料表結構 `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `cart_id` int(11) NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `table_name`
--

CREATE TABLE `table_name` (
  `A` varchar(100) NOT NULL,
  `B` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `table_name`
--

INSERT INTO `table_name` (`A`, `B`) VALUES
('1', 'x'),
('1', 'y'),
('2', 'x'),
('2', 'y');

-- --------------------------------------------------------

--
-- 資料表結構 `user_t`
--

CREATE TABLE `user_t` (
  `buyer_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user_t`
--

INSERT INTO `user_t` (`buyer_id`, `name`, `password`, `address`) VALUES
(9, 'jack', '0', 'aaaa'),
(10, 'josh', '0', 'aaa'),
(11, 'e', 'e', 'e');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `like_t`
--
ALTER TABLE `like_t`
  ADD PRIMARY KEY (`product_id`,`buyer_id`),
  ADD KEY `like_t_ibfk_2` (`buyer_id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_ibfk_1` (`buyer_id`),
  ADD KEY `orders_ibfk_2` (`seller_id`),
  ADD KEY `orders_ibfk_3` (`product_id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- 資料表索引 `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`);

--
-- 資料表索引 `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `shoppingcart_ibfk_1` (`buyer_id`),
  ADD KEY `shoppingcart_ibfk_2` (`product_id`);

--
-- 資料表索引 `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`buyer_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_t`
--
ALTER TABLE `user_t`
  MODIFY `buyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `like_t`
--
ALTER TABLE `like_t`
  ADD CONSTRAINT `like_t_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like_t_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `user_t` (`buyer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `user_t` (`buyer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`seller_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`seller_id`);

--
-- 資料表的限制式 `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `user_t` (`buyer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shoppingcart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
