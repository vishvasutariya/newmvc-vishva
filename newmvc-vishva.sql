-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 09:49 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newmvc-vishva`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(11) NOT NULL,
  `password` varchar(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `status`, `create_at`, `update_at`) VALUES
(1, 'a@gmail.com', 'abc123', 1, '2023-03-30 08:48:15', NULL),
(2, '', '', 1, '2023-04-11 10:58:30', NULL),
(3, 'vishva@gmai', '', 1, '2023-04-11 11:18:11', NULL),
(4, '', '', 1, '2023-04-11 11:23:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `text_percent` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `shipping_id`, `text_percent`, `create_at`) VALUES
(1, 8, 7, '2023-03-14 12:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Female','Male') NOT NULL,
  `mobile` bigint(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `fname`, `lname`, `email`, `gender`, `mobile`, `status`, `create_at`, `update_at`) VALUES
(264, 'hghg', 'fgdc', '', 'Female', 0, 0, '2023-04-02 18:56:36', NULL),
(265, 'hgyhgfgf', 'fxdfx', 'sdcas@gmail.com', 'Female', 0, 0, '2023-04-02 18:58:22', NULL),
(267, '', '', '', 'Female', 0, 0, '2023-04-02 19:24:15', NULL),
(268, '', '', '', 'Female', 0, 0, '2023-04-02 19:24:54', NULL),
(269, '', '', '', 'Female', 0, 0, '2023-04-02 19:25:18', NULL),
(270, 'njhnjnj', '', '', 'Female', 0, 0, '2023-04-02 19:26:05', NULL),
(271, '', 'dnhjschjd', '', 'Female', 0, 0, '2023-04-02 19:26:34', NULL),
(272, '', 'dnhjschjd', '', 'Female', 0, 2, '2023-04-02 19:28:01', '2023-04-03 07:19:40'),
(273, 'aaaaaaaaaaaa', 'aaaaaaaaaaa', '', 'Female', 0, 1, '2023-04-02 19:28:09', '2023-04-03 07:21:02'),
(274, '', '', '', 'Female', 0, 1, '2023-04-11 17:59:06', '2023-04-11 02:29:06'),
(275, '', '', '', 'Female', 0, 1, '2023-04-11 18:03:47', '2023-04-11 02:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip_code` int(100) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`, `customer_id`) VALUES
(40, 'ghuy', 'uhug', 2, 'ug', 878, 185),
(41, '', '', 0, '', 0, 190),
(42, '', '', 0, '', 0, 191),
(43, '', '', 0, '', 0, 194),
(44, '', '', 0, '', 0, 195),
(45, '', '', 0, '', 0, 196),
(46, '', '', 0, '', 0, 197),
(47, '', '', 0, '', 0, 198),
(48, '', '', 0, '', 0, 199),
(49, '', '', 0, '', 0, 200),
(50, '', '', 0, '', 0, 188),
(51, '', '', 0, '', 0, 201),
(52, '', '', 0, '', 0, 202),
(53, '', '', 0, '', 0, 203),
(54, '', '', 0, '', 0, 204),
(55, '', '', 0, '', 0, 205),
(56, '', '', 0, '', 0, 242),
(57, '', '', 0, '', 0, 243),
(58, 'hjhj', 'cfcgf', 0, 'gcfgc', 65656, 244),
(59, 'jjdsj', 'fdfgdcfg', 0, 'mbn v', 565654, 0),
(65, 'ugdhui', 'hdsu', 0, 'ygfy', 67565, 249),
(71, '', 'gedsu', 0, 'GDSG', 767657, 261),
(72, 'fgfg', 'ghjhj', 0, 'fdtyf', 676767, 262),
(74, '', 'ftfdt', 0, 'dfdf', 65656, 264),
(76, 'fccfgggggggggggggggg', 'ddrfd', 0, 'fdfd', 56565, 266),
(77, 'aaaaaaaaaaaaaa', 'xfxrd', 0, 'xc', 76767666, 265),
(84, '', 'cgcg', 0, 'c', 0, 272),
(85, '', 'aaaaaaaaaaaaaa', 0, '', 0, 273),
(86, '', '', 0, '', 0, 274),
(87, '', '', 0, '', 0, 275);

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute`
--

CREATE TABLE `eav_attribute` (
  `attribute_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `backend_type` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `backend_model` varchar(255) NOT NULL,
  `input_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eav_attribute`
--

INSERT INTO `eav_attribute` (`attribute_id`, `entity_type_id`, `code`, `backend_type`, `name`, `status`, `backend_model`, `input_type`) VALUES
(1, 1, 'color', 'int', 'Color', 1, '', 'select'),
(2, 1, 'style', 'int', 'Style', 1, '', 'select'),
(3, 1, 'short_desc', 'textarea', 'Short Description', 1, '', 'textarea'),
(4, 1, '', 'text', '', 2, '', 'textbox'),
(5, 1, '', 'text', '', 2, '', 'textbox'),
(6, 1, '', 'text', '', 2, '', 'textbox'),
(7, 1, '', 'text', '', 2, '', 'textbox'),
(8, 1, '', 'text', '', 2, '', 'textbox'),
(9, 1, '', 'text', '', 2, '', 'textbox'),
(10, 1, '', 'text', '', 2, '', 'textbox'),
(11, 1, '', 'text', '', 2, '', 'textbox'),
(12, 1, '', 'text', '', 2, '', 'textbox');

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute_option`
--

CREATE TABLE `eav_attribute_option` (
  `option_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `position` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eav_attribute_option`
--

INSERT INTO `eav_attribute_option` (`option_id`, `name`, `attribute_id`, `position`) VALUES
(1, 'Red', 1, 1),
(2, 'White', 1, 2),
(3, 'Black', 1, 3),
(4, 'Brown', 1, 4),
(5, 'Silver', 1, 5),
(6, 'Traditional', 2, 1),
(7, 'Modern', 2, 2),
(8, 'Minimalist', 2, 1),
(9, 'Bohemien', 2, 1),
(10, 'Electric', 2, 1),
(11, 'Contemporary', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `entity_type`
--

CREATE TABLE `entity_type` (
  `entity_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `entity_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entity_type`
--

INSERT INTO `entity_type` (`entity_type_id`, `name`, `entity_model`) VALUES
(1, 'product', ''),
(2, 'category', ''),
(3, 'customer', ''),
(4, 'vendor', ''),
(5, 'salesman', '');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `thumb` tinyint(4) DEFAULT NULL,
  `base` tinyint(4) DEFAULT NULL,
  `small` tinyint(4) DEFAULT NULL,
  `gallery` tinyint(4) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `product_id`, `image`, `filename`, `thumb`, `base`, `small`, `gallery`, `create_at`) VALUES
(219, 0, '219.png', '', 0, 0, 0, 0, '2023-03-28 22:59:47'),
(220, 0, '220.png', 'hey krishna..!!!', 0, 0, 0, 0, '2023-03-28 23:00:11'),
(221, 0, 'image2.png', 'jay shree krishna', NULL, NULL, NULL, NULL, '2023-03-28 23:04:46'),
(222, 0, 'image2.png', 'jay shree krishna', NULL, NULL, NULL, NULL, '2023-03-28 23:05:23'),
(223, 0, 'image2.png', 'jay shree krishna', NULL, NULL, NULL, NULL, '2023-03-28 23:07:08'),
(224, 0, 'image2.png', 'jay shree krishna', NULL, NULL, NULL, NULL, '2023-03-28 23:07:11'),
(225, 0, 'image2.png', 'jay shree krishna', NULL, NULL, NULL, NULL, '2023-03-28 23:09:57'),
(226, 0, '226.png', 'jay shree krishna', 0, 0, 0, 0, '2023-03-28 23:10:37'),
(227, 0, '', '', 0, NULL, NULL, NULL, '2023-03-28 23:30:14'),
(228, 0, '', '', 0, NULL, NULL, NULL, '2023-03-29 00:03:22'),
(229, 0, '', '', 0, NULL, NULL, NULL, '2023-03-29 00:04:19'),
(230, 0, '', '', 0, NULL, NULL, NULL, '2023-03-29 00:04:20'),
(231, 0, '', '', 0, NULL, NULL, NULL, '2023-03-29 00:04:20'),
(232, 0, '', '', 0, NULL, NULL, NULL, '2023-03-29 00:04:21'),
(233, 0, '', '', 0, 127, 127, 0, '2023-03-29 00:04:39'),
(234, 0, '', '', 0, 127, 127, 0, '2023-03-29 00:06:55'),
(235, 0, '', '', 0, 127, 127, 0, '2023-03-29 00:06:56'),
(236, 0, '236.png', 'ji', 0, 0, 0, 0, '2023-03-29 09:25:23'),
(237, 0, '237.png', 'ji', 0, 0, 0, 0, '2023-03-29 09:26:42'),
(238, 0, 'image2.png', 'hello', NULL, NULL, NULL, NULL, '2023-03-29 09:34:47'),
(239, 0, 'image2.png', 'hello', NULL, NULL, NULL, NULL, '2023-03-29 09:36:27'),
(240, 0, 'image2.png', 'hello', NULL, NULL, NULL, NULL, '2023-03-29 09:36:27'),
(241, 0, 'image2.png', 'hello', NULL, NULL, NULL, NULL, '2023-03-29 09:36:28'),
(242, 0, 'image2.png', 'hello', NULL, NULL, NULL, NULL, '2023-03-29 09:36:29'),
(243, 0, 'image2.png', 'hello', NULL, NULL, NULL, NULL, '2023-03-29 09:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `name`, `status`, `create_at`, `update_at`) VALUES
(1, '', 1, '0000-00-00 00:00:00', '2023-04-11 10:45:39'),
(4, '', 1, '0000-00-00 00:00:00', '2023-04-11 10:45:46'),
(5, '', 1, '0000-00-00 00:00:00', '2023-04-11 10:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `cost` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` varchar(20) NOT NULL,
  `material` varchar(50) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `create_at`, `update_at`) VALUES
(220, 'abc', 'www', 0, 0, 0, '', 0, '', '', '2023-03-30 06:55:41', '2023-04-03 07:10:47'),
(222, '', 'hwuh', 0, 0, 0, '', 1, '', '', '2023-03-30 07:12:25', '2023-04-03 07:14:08'),
(223, 'aaa', 'ujuhj', 0, 0, 0, '', 1, '', '', '2023-03-30 07:23:48', '2023-04-03 07:12:23'),
(227, 'abc', '', 0, 0, 0, '', 2, '', '', '2023-04-03 07:03:15', '2023-04-03 07:12:16'),
(228, '', '', 0, 0, 0, '', 0, '', '', '2023-04-11 08:03:34', NULL),
(230, 'hhhhhhhhhh', 'hhhhhhhq', 7, 7, 7, '', 0, '77', '', '2023-04-11 10:30:11', '2023-04-11 11:28:39'),
(231, '', '', 0, 0, 0, '', 0, '', '', '2023-04-11 10:31:24', NULL),
(232, '', '', 0, 0, 0, '', 0, '', '', '2023-04-11 10:32:11', '2023-04-11 10:36:24'),
(233, '', '', 0, 0, 0, '', 0, '', '', '2023-04-11 10:32:37', NULL),
(235, '', '', 0, 0, 0, '', 0, '', '', '2023-04-11 11:27:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_int`
--

CREATE TABLE `product_int` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Female','Male') NOT NULL,
  `mobile` bigint(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `fname`, `lname`, `email`, `gender`, `mobile`, `status`, `company`, `create_at`, `update_at`) VALUES
(10, 'anjali', 'patel', 'ab12c@gmail.com', 'Female', 2147483647, 1, '', '0000-00-00 00:00:00', '2023-03-03 10:24:51'),
(11, 'anjali1122', 'vaghasiyasd', 'ab12c@gmail.com', 'Male', 2147483647, 1, '', '0000-00-00 00:00:00', '2023-02-17 11:13:24'),
(21, 'anjali', 'patel', '', 'Male', 876543245, 1, '', '2023-03-03 10:43:16', '2023-03-03 11:16:40'),
(28, 'gfyf', 'frcxrfcx', '', 'Female', 0, 0, '', '2023-04-03 10:25:45', NULL),
(29, 'gfyf', 'aaaaaaaaaaaaaa', '', 'Female', 0, 0, '', '2023-04-03 10:26:44', '2023-04-03 06:58:31'),
(30, '', 'aaaaaaaaaaaaaaaaa', '', 'Female', 0, 0, '', '2023-04-03 10:30:01', '2023-04-03 07:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zipcode` int(100) NOT NULL,
  `salesman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `address`, `city`, `state`, `country`, `zipcode`, `salesman_id`) VALUES
(7, 'abc', 'ftf', 0, 'cfcfc', 7878, 10),
(8, 'abc', 'ftf', 0, 'cfcfc', 7878, 11),
(9, 'fctrfc', 'rrfcrf', 0, 'dct', 878, 26),
(10, 'drfd', '', 0, '', 0, 21),
(11, 'fcxfxfx', 'xfhxfrtrrd', 0, 'cxfxdxt', 7567586, 29),
(12, 'aaaaaaaaaaaaaaaaaaaaaaa', 'ssssssssssssssssssssssssssss', 0, '', 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

CREATE TABLE `salesman_price` (
  `entity_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `salesman_price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` int(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `name`, `amount`, `status`, `create_at`, `update_at`) VALUES
(8, 'silver', 787, 0, '2023-02-17 11:14:03', NULL),
(9, 'golden', 2147483647, 0, '2023-02-17 11:14:09', '2023-04-02 11:12:02'),
(20, 'mfklemf', 0, 0, '2023-04-02 11:15:04', '2023-04-02 11:15:11'),
(21, 'kkkkkkk', 0, 0, '2023-04-02 11:15:18', '2023-04-02 11:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` enum('Female','Male') NOT NULL,
  `mobile` bigint(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `fname`, `lname`, `email`, `gender`, `mobile`, `status`, `company`, `create_at`, `update_at`) VALUES
(2, 'abc', 'vaghasiyasd', 'ab12c@gmail.com', 'Male', 9638766993, 1, 'max', '2023-02-12 12:47:42', '2023-03-01 14:34:24'),
(3, 'anjali', 'vaghasiya22', 'abc22@gmail.com', 'Female', 9638766993, 0, '', '2023-04-01 08:08:45', '2023-04-01 08:18:27'),
(57, 'ede', 'ede', '', 'Female', 0, 0, '', '2023-04-02 23:35:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zipcode` int(100) NOT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `address`, `city`, `state`, `country`, `zipcode`, `vendor_id`) VALUES
(1, 'abclkds', 'gondal', 0, 'india', 360311, 1),
(2, 'fhgf', 'gondal', 0, 'gfmg', 6767, 2),
(6, 'abcdfe', 'gondal', 0, 'india', 360311, 16),
(7, '', '', 0, '', 0, 17),
(8, 'abcdfe', 'gondal', 0, 'india', 360311, 18),
(9, '', '', 0, '', 0, 19),
(10, '', '', 0, '', 0, 20),
(11, 'oijkoi', 'gondal', 0, '', 0, 23),
(12, '', 'rajkot', 0, 'india', 0, 24),
(13, '', '', 0, '', 0, 29),
(14, '', '', 0, '', 0, 30),
(15, '', '', 0, '', 0, 31),
(16, '', '', 0, '', 0, 32),
(17, '', '', 0, '', 0, 33),
(18, '', '', 0, '', 0, 34),
(19, '', '', 0, '', 0, 44),
(20, '', '', 0, '', 0, 45),
(21, '', '', 0, '', 0, 46),
(22, '', '', 0, '', 0, 47),
(23, '', '', 0, '', 0, 48),
(24, '', '', 0, '', 0, 49),
(25, '', '', 0, '', 0, 54),
(26, '', '', 0, '', 2121, 55),
(27, '', '', 0, '', 0, 56),
(28, 'edwe', 'edwe', 0, '', 0, 57),
(29, '', '', 0, '', 0, 58);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `shipping_id` (`shipping_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_item_ibfk_1` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`);

--
-- Indexes for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `entity_type_id` (`entity_type_id`);

--
-- Indexes for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `entity_type`
--
ALTER TABLE `entity_type`
  ADD PRIMARY KEY (`entity_type_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_int`
--
ALTER TABLE `product_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `entity_type`
--
ALTER TABLE `entity_type`
  MODIFY `entity_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `product_int`
--
ALTER TABLE `product_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`shipping_id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD CONSTRAINT `eav_attribute_option_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_int`
--
ALTER TABLE `product_int`
  ADD CONSTRAINT `product_int_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_int_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
