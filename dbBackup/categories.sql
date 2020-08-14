-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2020 at 06:15 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mj-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cate_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `number`, `name`, `parent_id`, `is_active`, `created_at`, `updated_at`, `code`, `cate_type`, `description`) VALUES
(148, 1, 'เหล็กปรับ', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'BK', 'Accessory', ''),
(149, 2, 'ที่เสียบชาร์จสายไฟ USB,เครื่องเสียง', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'CG', 'Accessory', ''),
(150, 3, 'ขาโซฟา', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'LG', 'Accessory', 'Sofa legs'),
(151, 4, 'ขาไม้', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'LGW', 'Accessory', 'Wooden legs'),
(152, 5, 'ขาหลาสติก', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'LGP', 'Accessory', 'Plastic legs'),
(153, 6, 'ซิป,คิ้วโฟม', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'SP', 'Accessory', 'zipper & Foam edge.'),
(154, 7, 'เฟอร์นิเจอร์สำเร็จรุป', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'FU', 'Accessory', 'Furniture'),
(155, 8, 'น็อต ตะปู สกรู', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'SC', 'Accessory', 'Nail , Screw'),
(156, 9, 'สปริง,ยางยืด', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'SG', 'Accessory', 'Spring,Elastic'),
(157, 10, 'หัวหมุด', NULL, 1, '2020-05-19 06:53:09', '2020-05-19 06:53:09', 'SN', 'Accessory', 'Pin'),
(158, 11, 'กระดุม', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'CD', 'Accessory', 'Studs'),
(159, 12, 'ตีนตุ๊กแก', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'TK', 'Accessory', 'Magic tape'),
(160, 13, 'โครงโซฟา', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'KL', 'Accessory', 'Sofa frame'),
(161, 14, 'หลุมแก้ว', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'CUP', 'Accessory', 'CUP'),
(162, 15, 'เครื่องมือ', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'KM', 'Accessory', 'Tool'),
(163, 16, 'กาว', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'GM', 'Accessory', 'Glue'),
(164, 17, 'ระบาย', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'TL', 'Accessory', 'Tassel'),
(165, 18, 'พลาสติก&กระสอบ', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'PL', 'Accessory', 'Plastic bag'),
(166, 19, 'Wall Paper', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'WP', 'Wall Paper', 'Wall Paper'),
(167, 20, 'ผ้าโซฟา', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'CP', 'Fabric', 'Sofa Fabric'),
(168, 21, 'ผ้าสปันบอนด์', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'CPP', 'Fabric', 'Sapunbond Fabric'),
(169, 22, 'ผ้าม่าน', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'CPPA,B,C', 'Fabric', 'Curtain'),
(170, 23, 'ผ้าสั่งทำ', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'CPZ', 'Fabric', 'Fabric Made to order'),
(171, 24, 'หนัง', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'PV', 'Leather', 'Leather'),
(172, 25, 'หนังกลับ', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'CPV', 'Leather', 'Suede'),
(173, 26, 'หนังไมโครไฟเบอร์', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'PA', 'Leather', 'Microfiber leather'),
(174, 27, 'สินค้าทั่วไป', NULL, 1, '2020-05-19 06:53:10', '2020-05-19 06:53:10', 'ZZ', 'Leather', 'General'),
(175, 28, 'ไม้สำเร็จรูป', NULL, 1, '2020-05-19 06:53:11', '2020-05-19 06:53:11', 'WD', 'Wood', 'Wooden ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
