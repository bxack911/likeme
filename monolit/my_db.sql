-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: monolit-mysql8-service:3306
-- Generation Time: Jun 21, 2020 at 04:36 PM
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
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int NOT NULL,
  `name` varchar(155) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 'header_left_label', '1576512575', '1588713751', '4', '4'),
(6, 'header_right', '1588714637', '1588714637', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `blocks_translation`
--

CREATE TABLE `blocks_translation` (
  `id` int NOT NULL,
  `block_id` int NOT NULL,
  `language` varchar(10) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blocks_translation`
--

INSERT INTO `blocks_translation` (`id`, `block_id`, `language`, `value`) VALUES
(9, 5, 'ru', '<p>Бесплатная доставка по Украине при заказе от <strong>300 грн</strong>!</p>'),
(10, 5, 'ua', ''),
(11, 5, 'uk', ''),
(12, 6, 'ru', '<p><span class=\"topbar-work-time\">Ежедневно 10:00-20:00</span> <a class=\"topbar-phone\" href=\"tel:+380635012161\">+38 (063) 501-21-61</a></p>'),
(13, 6, 'uk', '');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int NOT NULL,
  `key` varchar(128) NOT NULL,
  `value` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `key`, `value`, `comment`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'pagesLanguage', 'ru', 'Активный язык админки', '', '1576746577', '', ''),
(4, 'email', 'bxack911@gmail.com', 'Мыло админа', '1576505430', '1576505430', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int NOT NULL,
  `code` varchar(8) NOT NULL,
  `locale` varchar(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` smallint NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` int NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `code`, `locale`, `title`, `status`, `sort_order`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'ru', 'ru_RU', 'Русский', 1, 0, '', 0, '', 0),
(5, 'uk', 'uk_UA', 'Украинский', 1, 0, '', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `root` int DEFAULT NULL,
  `lft` int NOT NULL,
  `rgt` int NOT NULL,
  `lvl` smallint NOT NULL,
  `name` varchar(60) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `icon_type` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1',
  `removable` tinyint(1) NOT NULL DEFAULT '1',
  `removable_all` tinyint(1) NOT NULL DEFAULT '0',
  `child_allowed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `root`, `lft`, `rgt`, `lvl`, `name`, `url`, `icon`, `icon_type`, `active`, `selected`, `disabled`, `readonly`, `visible`, `collapsed`, `movable_u`, `movable_d`, `movable_l`, `movable_r`, `removable`, `removable_all`, `child_allowed`) VALUES
(11, 11, 1, 50, 0, 'test', 'test', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(12, 11, 2, 27, 1, 'lvl1', 'test', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1),
(13, 11, 3, 24, 2, 'lvl2', 'test2', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(14, 11, 4, 23, 3, 'lvl', 'test', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(15, 11, 5, 6, 4, 'dsf', 'test', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(16, 11, 7, 8, 4, 'st', 'test', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(17, 11, 25, 26, 2, 'dsf', 'dsf', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(18, 11, 9, 22, 4, 'rts', 'fdg', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(19, 11, 10, 21, 5, 'fdg', 'fdg', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(20, 11, 11, 20, 6, 'fdg', 'fdg', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(21, 11, 12, 19, 7, 'fdg', 'fdg', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(22, 11, 13, 18, 8, 'fdg', 'fdg', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(23, 11, 14, 17, 9, 'fdg', '', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(24, 11, 15, 16, 10, 'fdg', 'fdg', '', 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(25, 11, 28, 43, 1, 'Каталог', 'collection/all', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(26, 11, 29, 34, 2, 'Диваны', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(27, 11, 35, 36, 2, 'Кресла и пуфики', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(28, 11, 37, 38, 2, 'Шкафы', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(29, 11, 39, 40, 2, 'SALE', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(30, 11, 41, 42, 2, 'Аксессуары', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(31, 11, 30, 31, 3, 'Прямые диваны', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(32, 11, 32, 33, 3, 'Угловые диваны', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(33, 11, 44, 45, 1, 'Доставка', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(34, 11, 46, 47, 1, 'Контакты', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1),
(35, 11, 48, 49, 1, 'Блог', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_translation`
--

CREATE TABLE `menu_translation` (
  `id` int NOT NULL,
  `menu_id` int NOT NULL,
  `language` varchar(10) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_translation`
--

INSERT INTO `menu_translation` (`id`, `menu_id`, `language`, `label`) VALUES
(5, 11, 'ru', 'russian'),
(6, 11, 'uk', 'ukraine'),
(7, 12, 'ru', 'tt'),
(8, 12, 'uk', 'tt'),
(9, 13, 'ru', 'ss'),
(10, 13, 'uk', 'ss'),
(11, 14, 'ru', 'dd'),
(12, 14, 'uk', 'ss'),
(13, 15, 'ru', 'test'),
(14, 15, 'uk', ''),
(15, 16, 'ru', 'trest'),
(16, 16, 'uk', ''),
(17, 17, 'ru', 'dsf'),
(18, 17, 'uk', ''),
(19, 18, 'ru', 'fdg'),
(20, 18, 'uk', ''),
(21, 19, 'ru', 'fdg'),
(22, 19, 'uk', ''),
(23, 20, 'ru', 'fdg'),
(24, 20, 'uk', ''),
(25, 21, 'ru', 'fdg'),
(26, 21, 'uk', ''),
(27, 22, 'ru', 'fdg'),
(28, 22, 'uk', ''),
(29, 23, 'ru', 'fdg'),
(30, 23, 'uk', ''),
(31, 24, 'ru', 'fdg'),
(32, 24, 'uk', ''),
(33, 25, 'ru', ''),
(34, 25, 'uk', ''),
(35, 26, 'ru', ''),
(36, 26, 'uk', ''),
(37, 27, 'ru', ''),
(38, 27, 'uk', ''),
(39, 28, 'ru', ''),
(40, 28, 'uk', ''),
(41, 29, 'ru', ''),
(42, 29, 'uk', ''),
(43, 30, 'ru', ''),
(44, 30, 'uk', ''),
(45, 31, 'ru', ''),
(46, 31, 'uk', ''),
(47, 32, 'ru', ''),
(48, 32, 'uk', ''),
(49, 33, 'ru', ''),
(50, 33, 'uk', ''),
(51, 34, 'ru', ''),
(52, 34, 'uk', ''),
(53, 35, 'ru', ''),
(54, 35, 'uk', '');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1576271780),
('m130524_201442_init', 1576271785),
('m190124_110200_add_verification_token_column_to_user_table', 1576271785);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int NOT NULL,
  `class` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `properties` text,
  `icon` varchar(64) DEFAULT NULL,
  `sort_order` int DEFAULT NULL,
  `is_installed` smallint NOT NULL,
  `status` smallint NOT NULL,
  `version` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `slug` varchar(255) NOT NULL,
  `section_id` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `image` int DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `section_id`, `status`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(12, 'index', NULL, 1, NULL, '1576489055', '1588528360', '4', '4'),
(20, 'o_nas', NULL, 1, NULL, '1577698964', '1577700674', '4', '4'),
(21, 'cart', NULL, 1, NULL, '1588709627', '1589034199', '4', '4'),
(22, 'search', NULL, 1, NULL, '1588803151', '1588803151', '4', '4'),
(23, 'order', NULL, 1, NULL, '1588882215', '1588882821', '4', '4'),
(24, 'order/thanks', NULL, 1, NULL, '1588971336', '1588971336', '4', '4'),
(25, 'favourite', NULL, 1, NULL, '1589118683', '1589118683', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `pages_translation`
--

CREATE TABLE `pages_translation` (
  `id` int NOT NULL,
  `pages_id` int NOT NULL,
  `language` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages_translation`
--

INSERT INTO `pages_translation` (`id`, `pages_id`, `language`, `title`, `content`) VALUES
(1, 12, 'ru', 'Необычные и уникальные решения', '<p>Главная</p>\r\n<p><img style=\"height: 668px; width: 1760px;\" src=\"/storage/footer-bg2.jpg\" alt=\"\" /></p>'),
(3, 12, 'en', 'Home', '<p>Home</p>\r\n'),
(4, 12, 'ua', 'Головна', '<p>Головна</p>\r\n'),
(18, 12, 'uk', '', ''),
(19, 20, 'ru', 'О нас', '<p>О нас</p>'),
(20, 20, 'uk', '', ''),
(22, 20, 'en-US', '', ''),
(23, 21, 'ru', 'Корзина', ''),
(24, 21, 'uk', '', ''),
(25, 22, 'ru', 'Поиск', ''),
(26, 22, 'uk', '', ''),
(27, 23, 'ru', 'Оформление заказа', ''),
(28, 23, 'uk', '', ''),
(29, 24, 'ru', 'Спасибо за заказ', ''),
(30, 24, 'uk', '', ''),
(31, 25, 'ru', 'Избранное', ''),
(32, 25, 'uk', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int NOT NULL,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `model`, `model_id`, `url`, `route`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(8, 'common\\models\\Pages', 12, 'index', 'pages/home', '1576489055', '1576489055', '', ''),
(10, 'common\\models\\Section', 1, 'first-section', 'section/view', '1576497806', '1576497806', '', ''),
(17, 'common\\models\\Pages', 20, 'o_nas', 'pages/view', '1577698964', '1577700652', '', ''),
(22, 'common\\modules\\shop\\common\\models\\Category', 1, 'category1', 'shop/category/category', '1588609209', '1588611798', NULL, NULL),
(23, 'common\\modules\\shop\\common\\models\\Products', 1, 'category1/testprod', 'shop/products/view', '1588620290', '1589032346', NULL, NULL),
(24, 'common\\models\\Pages', 21, 'cart', 'shop/cart/cart-page', '1588709627', '1589034199', NULL, NULL),
(25, 'common\\modules\\shop\\common\\models\\Products', 2, 'category1/demo-tovar-1-2033', 'shop/products/view', '1588712757', '1588802867', NULL, NULL),
(26, 'common\\modules\\shop\\common\\models\\Category', 2, 'category1/test1', 'shop/category/category', '1588716036', '1588716036', NULL, NULL),
(27, 'common\\modules\\shop\\common\\models\\Category', 3, 'category1/test1/test2', 'shop/category/category', '1588716045', '1588716045', NULL, NULL),
(28, 'common\\models\\Pages', 22, 'search', 'shop/search/search', '1588803151', '1588803151', NULL, NULL),
(29, 'common\\models\\Pages', 23, 'order', 'shop/order/view', '1588882216', '1588882216', NULL, NULL),
(30, 'common\\models\\Pages', 24, 'order/thanks', 'shop/order/result', '1588971336', '1588971336', NULL, NULL),
(31, 'common\\models\\Pages', 25, 'favourite', 'shop/favourite/favourite-page', '1589118683', '1589118683', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `slug`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'first-section', 1, '1576497806', '1576497806', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `section_translation`
--

CREATE TABLE `section_translation` (
  `section_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `language` varchar(10) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section_translation`
--

INSERT INTO `section_translation` (`section_id`, `title`, `language`, `content`) VALUES
(1, 'First section', 'ru', '<p>First section</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `type` int NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `status`, `image`, `link`, `type`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, '30', '/collection/aksessuary', 1, '1588505379', '1588505772', '4', '4'),
(2, 1, '31', '/collection/aksessuary', 1, '1588512789', '1588512878', '4', '4'),
(3, 1, '32', '/collection/aksessuary', 1, '1588512947', '1588512947', '4', '4'),
(4, 1, '33', 'collection/chasy', 2, '1588528286', '1588528286', '4', '4'),
(5, 1, '34', '/collection/kancelaria', 2, '1588529017', '1588529023', '4', '4'),
(6, 1, '35', '/collection/lampy', 2, '1588529656', '1588529656', '4', '4'),
(7, 1, '36', '/collection/stulia', 2, '1588529776', '1588529786', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `units_translation`
--

CREATE TABLE `units_translation` (
  `id` int NOT NULL,
  `unit_id` int NOT NULL,
  `language` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content2` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `html2` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units_translation`
--

INSERT INTO `units_translation` (`id`, `unit_id`, `language`, `content`, `content2`, `html`, `html2`, `title`) VALUES
(1, 2, 'ru', '', '', '', '', 'test'),
(2, 2, 'uk', '', '', '', '', ''),
(3, 1, 'ru', '', '', 'Минималистичные аксессуары для вашей кухни', '', 'Аксессуары'),
(4, 1, 'uk', '', '', '', '', ''),
(5, 2, 'ru', '', '', 'Bottle Grinder, Small, 2-Piecehe', '', 'Аксессуары'),
(6, 2, 'uk', '', '', '', '', ''),
(7, 3, 'ru', '', '', 'Bottle Grinder, Small, 2-Piecehe', '', 'Аксессуары'),
(8, 3, 'uk', '', '', '', '', ''),
(9, 4, 'ru', '', '', '', '', 'Часы'),
(10, 4, 'uk', '', '', '', '', ''),
(11, 5, 'ru', '', '', '', '', 'Канцелярия'),
(12, 5, 'uk', '', '', '', '', ''),
(13, 6, 'ru', '', '', '', '', 'Лампы'),
(14, 6, 'uk', '', '', '', '', ''),
(15, 7, 'ru', '', '', '', '', 'Стулья'),
(16, 7, 'uk', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `unit_types`
--

CREATE TABLE `unit_types` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_types`
--

INSERT INTO `unit_types` (`id`, `name`) VALUES
(1, 'homepage_slider'),
(2, 'homepage_big_blocks');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(4, 'admin', 'UtQDuTayFj2tMy7O6voGCVtvQxit3quz', '$2y$13$tf7fCRUZ9JiHdO4l6UmtLOPiSIBOTkkAjWjMBOR.bD7eDI0x8oPyS', NULL, 'bxack911@gmail.com', 10, 1576273132, 1576273132, 'T5WDs_T7xXts3i-nHwmsdNRKwWVr4Mhm_1576273132');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocks_translation`
--
ALTER TABLE `blocks_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_product_NK1` (`root`),
  ADD KEY `tbl_product_NK2` (`lft`),
  ADD KEY `tbl_product_NK3` (`rgt`),
  ADD KEY `tbl_product_NK4` (`lvl`),
  ADD KEY `tbl_product_NK5` (`active`);

--
-- Indexes for table `menu_translation`
--
ALTER TABLE `menu_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `pages_translation`
--
ALTER TABLE `pages_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_translation`
--
ALTER TABLE `section_translation`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units_translation`
--
ALTER TABLE `units_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blocks_translation`
--
ALTER TABLE `blocks_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `menu_translation`
--
ALTER TABLE `menu_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pages_translation`
--
ALTER TABLE `pages_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units_translation`
--
ALTER TABLE `units_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
