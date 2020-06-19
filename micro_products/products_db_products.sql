-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: products-mysql8-service:3306
-- Generation Time: Jun 19, 2020 at 07:42 PM
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
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` int DEFAULT NULL,
  `parent` int DEFAULT '0',
  `depth` int NOT NULL DEFAULT '0',
  `position` int NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `image`, `parent`, `depth`, `position`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'category1', 65, NULL, 0, 1, 1, '1588599104', '1590911731', '4', '4'),
(2, 'test1', 44, 1, 1, 1, 1, '1588599386', '1588716036', '4', '4'),
(3, 'test2', 36, 2, 2, 1, 1, '1588600595', '1588716045', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `category_translation`
--

CREATE TABLE `category_translation` (
  `id` int NOT NULL,
  `language` varchar(10) NOT NULL,
  `category_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_translation`
--

INSERT INTO `category_translation` (`id`, `language`, `category_id`, `title`, `description`) VALUES
(1, 'ru', 1, 'Новая категория', '<p>test</p>'),
(2, 'uk', 1, 'testuk', ''),
(3, 'ru', 2, 'Новая категория', ''),
(4, 'uk', 2, '', ''),
(5, 'ru', 3, 'test2', '<p>test2</p>'),
(6, 'uk', 3, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `filemanager_mediafile`
--

CREATE TABLE `filemanager_mediafile` (
  `id` int NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `alt` text,
  `size` varchar(255) NOT NULL,
  `description` text,
  `thumbs` text,
  `created_at` int NOT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filemanager_mediafile`
--

INSERT INTO `filemanager_mediafile` (`id`, `filename`, `type`, `url`, `alt`, `size`, `description`, `thumbs`, `created_at`, `updated_at`) VALUES
(30, 'slider1.jpg', 'image/jpeg', '/storage/2020/05/slider1.jpg', NULL, '26679', NULL, NULL, 1588505290, NULL),
(31, 'slider2.jpg', 'image/jpeg', '/storage/2020/05/slider2.jpg', NULL, '21319', NULL, NULL, 1588512861, NULL),
(32, 'slider3.jpg', 'image/jpeg', '/storage/2020/05/slider3.jpg', NULL, '13293', NULL, NULL, 1588512937, NULL),
(33, 'maincat1img.jpg', 'image/jpeg', '/storage/2020/05/maincat1img.jpg', NULL, '15151', NULL, NULL, 1588528267, NULL),
(34, 'maincat2img.jpg', 'image/jpeg', '/storage/2020/05/maincat2img.jpg', NULL, '61817', NULL, NULL, 1588528921, NULL),
(35, 'maincat3img.jpg', 'image/jpeg', '/storage/2020/05/maincat3img.jpg', NULL, '50616', NULL, NULL, 1588529649, NULL),
(36, 'maincat4img.jpg', 'image/jpeg', '/storage/2020/05/maincat4img.jpg', NULL, '18191', NULL, NULL, 1588529713, NULL),
(37, 'divan-11.jpg', 'image/jpeg', '/storage/2020/05/divan-11.jpg', NULL, '141769', NULL, NULL, 1588624896, NULL),
(43, 'divan-13.jpg', 'image/jpeg', 'filemanager/2020/05/divan-13.jpg', NULL, '115908', NULL, NULL, 1588626015, NULL),
(44, 'divv.jpg', 'image/jpeg', '/storage/2020/05/divv.jpg', NULL, '28335', NULL, NULL, 1588712700, NULL),
(64, 'ak-n-cakiner-nkufxi0jsx8-unsplash.jpg', 'image/jpeg', 'storage/filemanager/2020/05/ak-n-cakiner-nkufxi0jsx8-unsplash.jpg', NULL, '541116', NULL, NULL, 1589217631, NULL),
(65, 'incoming-callicon-iconscom57408.png', 'image/png', '/storage/2020/05/incoming-callicon-iconscom57408.png', NULL, '24702', NULL, 'a:3:{s:5:\"small\";s:58:\"/storage/2020/05/incoming-callicon-iconscom57408-small.png\";s:6:\"medium\";s:59:\"/storage/2020/05/incoming-callicon-iconscom57408-medium.png\";s:5:\"large\";s:58:\"/storage/2020/05/incoming-callicon-iconscom57408-large.png\";}', 1590911708, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `filemanager_mediafile_tag`
--

CREATE TABLE `filemanager_mediafile_tag` (
  `mediafile_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filemanager_owners`
--

CREATE TABLE `filemanager_owners` (
  `mediafile_id` int NOT NULL,
  `owner_id` int NOT NULL,
  `owner` varchar(255) NOT NULL,
  `owner_attribute` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filemanager_tag`
--

CREATE TABLE `filemanager_tag` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_image`
--

CREATE TABLE `gallery_image` (
  `id` int NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `ownerId` varchar(255) DEFAULT NULL,
  `rank` int NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_image`
--

INSERT INTO `gallery_image` (`id`, `type`, `ownerId`, `rank`, `name`, `description`) VALUES
(29, 'products', '1', 29, '', ''),
(30, 'products', '1', 30, NULL, NULL),
(31, 'products', '1', 31, '', ''),
(32, 'products', '1', 32, '', ''),
(34, 'products', '2', 34, '', ''),
(35, 'products', '2', 35, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `image` int DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category` int NOT NULL,
  `price` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `discount` int DEFAULT NULL,
  `discount_type` int DEFAULT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `articul` varchar(25) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `updated_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `quantity`, `image`, `slug`, `category`, `price`, `discount`, `discount_type`, `is_new`, `status`, `articul`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 100, 37, 'testprod', 1, '15000', 0, 1, 1, 1, '1009', NULL, NULL, '1589032346', '4'),
(2, 5, 44, 'demo-tovar-1-2033', 1, '6589', 5, 1, 0, 1, '1009', '1588712757', '4', '1588802867', '4');

-- --------------------------------------------------------

--
-- Table structure for table `products_translation`
--

CREATE TABLE `products_translation` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `language` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `short_description` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_translation`
--

INSERT INTO `products_translation` (`id`, `product_id`, `language`, `title`, `description`, `short_description`) VALUES
(1, 1, 'ru', 'Green Couch', '<p style=\"margin: 0px 0px 20px; color: #333333; font-family: Montserrat, sans-serif; font-size: 15px; letter-spacing: 0.5px; background-color: #ffffff;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<p style=\"margin: 0px 0px 20px; color: #333333; font-family: Montserrat, sans-serif; font-size: 15px; letter-spacing: 0.5px; background-color: #ffffff;\">Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>', '<p><span style=\"color: #333333; font-family: Montserrat, sans-serif; font-size: 15px; letter-spacing: 0.5px; text-align: justify; background-color: #ffffff;\">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</span></p>'),
(2, 1, 'uk', 'ttt', '', ''),
(3, 2, 'ru', 'Green Couch', '<p style=\"margin: 0px 0px 20px; color: #333333; font-family: Montserrat, sans-serif; font-size: 15px; letter-spacing: 0.5px; background-color: #ffffff;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<p style=\"margin: 0px 0px 20px; color: #333333; font-family: Montserrat, sans-serif; font-size: 15px; letter-spacing: 0.5px; background-color: #ffffff;\">Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>', '<p><span style=\"color: #333333; font-family: Montserrat, sans-serif; font-size: 15px; letter-spacing: 0.5px; text-align: justify; background-color: #ffffff;\">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</span></p>'),
(4, 2, 'uk', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `status` int NOT NULL,
  `parent` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `product_id`, `status`, `parent`) VALUES
(2, 1, 1, NULL),
(3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `properties_translation`
--

CREATE TABLE `properties_translation` (
  `id` int NOT NULL,
  `language` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `property_id` int NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_translation`
--

INSERT INTO `properties_translation` (`id`, `language`, `property_id`, `name`, `value`) VALUES
(3, 'ru', 2, 'Категория фильтра', 'parent'),
(4, 'uk', 2, '', ''),
(5, 'ru', 3, 'Фильтр 1', 'test3'),
(6, 'uk', 3, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translation`
--
ALTER TABLE `category_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filemanager_mediafile`
--
ALTER TABLE `filemanager_mediafile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filemanager_mediafile_tag`
--
ALTER TABLE `filemanager_mediafile_tag`
  ADD PRIMARY KEY (`mediafile_id`,`tag_id`);

--
-- Indexes for table `filemanager_owners`
--
ALTER TABLE `filemanager_owners`
  ADD PRIMARY KEY (`mediafile_id`,`owner_id`,`owner`,`owner_attribute`);

--
-- Indexes for table `filemanager_tag`
--
ALTER TABLE `filemanager_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_image`
--
ALTER TABLE `gallery_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_translation`
--
ALTER TABLE `products_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties_translation`
--
ALTER TABLE `properties_translation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_translation`
--
ALTER TABLE `category_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `filemanager_mediafile`
--
ALTER TABLE `filemanager_mediafile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `filemanager_tag`
--
ALTER TABLE `filemanager_tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_image`
--
ALTER TABLE `gallery_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products_translation`
--
ALTER TABLE `products_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `properties_translation`
--
ALTER TABLE `properties_translation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
