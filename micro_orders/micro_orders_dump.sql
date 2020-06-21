-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: orders-mysql8-service:3306
-- Generation Time: Jun 21, 2020 at 08:58 AM
-- Server version: 8.0.20
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int NOT NULL,
  `sum` int NOT NULL,
  `class` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `sum`, `class`, `status`) VALUES
(3, 50, 'NovaPoshta', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_translation`
--

CREATE TABLE `delivery_translation` (
  `id` int NOT NULL,
  `delivery_id` int NOT NULL,
  `language` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_translation`
--

INSERT INTO `delivery_translation` (`id`, `delivery_id`, `language`, `name`, `comment`) VALUES
(5, 3, 'ru', 'Новая почта1', '<p>Доставим заказ в любой регион за 5 дней. Бесплатно при заказе от 5000 руб</p>'),
(6, 3, 'uk', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `fio` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sum` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `delivery_id` int NOT NULL,
  `paysystem_id` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `fio`, `email`, `sum`, `phone`, `comment`, `delivery_id`, `paysystem_id`, `date`) VALUES
(1, 1, 'test1', '', '75 000,00', '+38 (043) 543 54 35', '', 3, 1, '2020-05-10 15:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `paysystems`
--

CREATE TABLE `paysystems` (
  `id` int NOT NULL,
  `class` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paysystems`
--

INSERT INTO `paysystems` (`id`, `class`, `status`) VALUES
(1, 'Nal', 1),
(2, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paysystems_translation`
--

CREATE TABLE `paysystems_translation` (
  `id` int NOT NULL,
  `paysystem_id` int NOT NULL,
  `language` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paysystems_translation`
--

INSERT INTO `paysystems_translation` (`id`, `paysystem_id`, `language`, `name`, `comment`) VALUES
(1, 1, 'ru', 'Наличными1', '<p>Оплачивайте только после получения</p>'),
(2, 1, 'uk', '', ''),
(3, 2, 'ru', 'Картой', '<p>Оплачивайте дебетовой или кредитной картой</p>'),
(4, 2, 'uk', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_translation`
--
ALTER TABLE `delivery_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paysystems`
--
ALTER TABLE `paysystems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paysystems_translation`
--
ALTER TABLE `paysystems_translation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_translation`
--
ALTER TABLE `delivery_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paysystems`
--
ALTER TABLE `paysystems`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paysystems_translation`
--
ALTER TABLE `paysystems_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
