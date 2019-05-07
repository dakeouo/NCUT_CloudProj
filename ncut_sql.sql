-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 
-- 伺服器版本: 10.1.20-MariaDB
-- PHP 版本： 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- 資料表結構 `carts`
--

CREATE TABLE `carts` (
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` int(11) DEFAULT '0',
  `total` int(10) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 資料表結構 `cart_info`
--

CREATE TABLE `cart_info` (
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shops` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(10) NOT NULL,
  `pick_time` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_at` datetime NOT NULL,
  `finish_at` datetime DEFAULT NULL,
  `pick_at` datetime DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `isActive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `order_info`
--

CREATE TABLE `order_info` (
  `order_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `pid` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(4) NOT NULL,
  `discribe` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(3) NOT NULL DEFAULT '0',
  `isActive` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `product_type`
--

CREATE TABLE `product_type` (
  `type_id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 資料表結構 `shops`
--

CREATE TABLE `shops` (
  `sid` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_at` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `shops`
--

INSERT INTO `shops` (`sid`, `name`, `password`, `zone_id`, `phone_id`, `phone`, `address`, `start_at`, `end_at`, `isActive`) VALUES
('S0000', '總店', 'ac90228e14f347aa40dae0e1e1f448a9', '08', '04', '23924505', '臺中市太平區中山路二段57號', '08:00', '22:00', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `uid` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` int(2) NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_at` datetime NOT NULL,
  `edit_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isActive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`uid`, `username`, `sex`, `password`, `phone`, `email`, `add_at`, `edit_at`, `isActive`) VALUES
('A00000', '訪客', 2, 'd41d8cd98f00b204e9800998ecf8427e', '0000000000', 'default@mail.com', '2019-05-01 12:00:00', '2019-05-01 12:00:00', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `vars`
--

CREATE TABLE `vars` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `var` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- 資料表的匯出資料 `vars`
--

INSERT INTO `vars` (`id`, `name`, `var`) VALUES
(1, 'member_last_id', 1),
(2, 'shop_last_id', 1),
(3, 'product_last_id', 1),
(4, 'ptype_last_id', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `zone`
--

CREATE TABLE `zone` (
  `zone_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `zone`
--

INSERT INTO `zone` (`zone_id`, `name`) VALUES
('01', '基隆市'),
('02', '台北市'),
('03', '新北市'),
('04', '桃園縣'),
('05', '新竹市'),
('06', '新竹縣'),
('07', '苗栗縣'),
('08', '台中市'),
('09', '彰化縣'),
('10', '南投縣'),
('11', '雲林縣'),
('12', '嘉義市'),
('13', '嘉義縣'),
('14', '台南市'),
('15', '高雄市'),
('16', '屏東縣'),
('17', '台東縣'),
('18', '花蓮縣'),
('19', '宜蘭縣'),
('20', '澎湖縣'),
('21', '金門縣'),
('22', '連江縣');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`token`),
  ADD KEY `users` (`users`);

--
-- 資料表索引 `cart_info`
--
ALTER TABLE `cart_info`
  ADD KEY `token` (`token`),
  ADD KEY `pid` (`pid`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `users` (`users`),
  ADD KEY `shops` (`shops`);

--
-- 資料表索引 `order_info`
--
ALTER TABLE `order_info`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `pid` (`pid`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `type_id` (`type_id`);

--
-- 資料表索引 `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- 資料表索引 `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `zone_id` (`zone_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- 資料表索引 `vars`
--
ALTER TABLE `vars`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `vars`
--
ALTER TABLE `vars`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`users`) REFERENCES `users` (`uid`);

--
-- 資料表的 Constraints `cart_info`
--
ALTER TABLE `cart_info`
  ADD CONSTRAINT `cart_info_ibfk_1` FOREIGN KEY (`token`) REFERENCES `carts` (`token`),
  ADD CONSTRAINT `cart_info_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`);

--
-- 資料表的 Constraints `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`users`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shops`) REFERENCES `shops` (`sid`);

--
-- 資料表的 Constraints `order_info`
--
ALTER TABLE `order_info`
  ADD CONSTRAINT `order_info_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_info_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`);

--
-- 資料表的 Constraints `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`type_id`);

--
-- 資料表的 Constraints `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`zone_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
