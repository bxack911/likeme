-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 18 2020 г., 14:52
-- Версия сервера: 10.2.30-MariaDB-cll-lve
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `noroxcom_berna`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 'block1sdsdasdasd', '1576512575', '1576831055', '4', '4');

-- --------------------------------------------------------

--
-- Структура таблицы `blocks_translation`
--

CREATE TABLE `blocks_translation` (
  `id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `language` varchar(10) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `blocks_translation`
--

INSERT INTO `blocks_translation` (`id`, `block_id`, `language`, `value`) VALUES
(9, 5, 'ru', '<p>Блок1</p>\r\n'),
(10, 5, 'ua', ''),
(11, 5, 'uk', '');

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `key` varchar(128) NOT NULL,
  `value` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`id`, `key`, `value`, `comment`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'pagesLanguage', 'ru', 'Активный язык админки', '', '1576746577', '', ''),
(4, 'email', 'bxack911@gmail.com', 'Мыло админа', '1576505430', '1576505430', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `filemanager_mediafile`
--

CREATE TABLE `filemanager_mediafile` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `alt` text DEFAULT NULL,
  `size` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbs` text DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filemanager_mediafile`
--

INSERT INTO `filemanager_mediafile` (`id`, `filename`, `type`, `url`, `alt`, `size`, `description`, `thumbs`, `created_at`, `updated_at`) VALUES
(4, '2500x25001576683794ahrjrb.jpg', 'image/jpeg', '/storage/2019/12/2500x25001576683794ahrjrb.jpg', NULL, '246096', NULL, 'a:3:{s:5:\"small\";s:52:\"/storage/2019/12/2500x25001576683794ahrjrb-small.jpg\";s:6:\"medium\";s:53:\"/storage/2019/12/2500x25001576683794ahrjrb-medium.jpg\";s:5:\"large\";s:52:\"/storage/2019/12/2500x25001576683794ahrjrb-large.jpg\";}', 1576813375, NULL),
(7, '157667831815emvc.jpg', 'image/jpeg', '/storage/2019/12/157667831815emvc.jpg', 'test', '149961', '', 'a:3:{s:5:\"small\";s:43:\"/storage/2019/12/157667831815emvc-small.jpg\";s:6:\"medium\";s:44:\"/storage/2019/12/157667831815emvc-medium.jpg\";s:5:\"large\";s:43:\"/storage/2019/12/157667831815emvc-large.jpg\";}', 1576813592, 1576813635),
(8, 'bg6.jpg', 'image/jpeg', '/storage/2019/12/bg6.jpg', NULL, '125027', NULL, 'a:3:{s:5:\"small\";s:30:\"/storage/2019/12/bg6-small.jpg\";s:6:\"medium\";s:31:\"/storage/2019/12/bg6-medium.jpg\";s:5:\"large\";s:30:\"/storage/2019/12/bg6-large.jpg\";}', 1576814103, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `filemanager_mediafile_tag`
--

CREATE TABLE `filemanager_mediafile_tag` (
  `mediafile_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `filemanager_owners`
--

CREATE TABLE `filemanager_owners` (
  `mediafile_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `owner_attribute` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `filemanager_tag`
--

CREATE TABLE `filemanager_tag` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `code` varchar(8) NOT NULL,
  `locale` varchar(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id`, `code`, `locale`, `title`, `status`, `sort_order`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'ru', 'ru_RU', 'Русский', 1, 0, '', 0, '', 0),
(5, 'uk', 'uk_UA', 'Украинский', 1, 0, '', 0, '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `key` varchar(155) NOT NULL,
  `name` varchar(155) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `key`, `name`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'main-menu', 'Главное меню', 1, '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `url` varchar(155) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_item`
--

INSERT INTO `menu_item` (`id`, `order`, `parent_id`, `menu_id`, `url`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 0, 1, '', 0, '1576507142', '1576507782', '4', '4'),
(2, 2, 0, 1, '', 0, '1576507433', '1576507782', '4', '4');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_item_translation`
--

CREATE TABLE `menu_item_translation` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `language` varchar(10) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_item_translation`
--

INSERT INTO `menu_item_translation` (`id`, `item_id`, `language`, `label`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'ru', 'Главная', '', '', '', ''),
(2, 1, 'ua', 'Головна', '', '', '', ''),
(3, 2, 'ru', 'ewf', '', '', '', ''),
(4, 2, 'ua', 'ewfe', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1576271780),
('m130524_201442_init', 1576271785),
('m190124_110200_add_verification_token_column_to_user_table', 1576271785);

-- --------------------------------------------------------

--
-- Структура таблицы `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `properties` text DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `is_installed` smallint(1) NOT NULL,
  `status` smallint(6) NOT NULL,
  `version` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image` int(11) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `slug`, `section_id`, `status`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(12, 'index', NULL, 1, NULL, '1576489055', '1577699914', '4', '4'),
(20, 'o_nas', NULL, 1, NULL, '1577698964', '1577700674', '4', '4');

-- --------------------------------------------------------

--
-- Структура таблицы `pages_translation`
--

CREATE TABLE `pages_translation` (
  `id` int(11) NOT NULL,
  `pages_id` int(11) NOT NULL,
  `language` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages_translation`
--

INSERT INTO `pages_translation` (`id`, `pages_id`, `language`, `title`, `content`) VALUES
(1, 12, 'ru', 'Главная', '<p>Главная</p>\r\n<p><img style=\"height: 668px; width: 1760px;\" src=\"/storage/footer-bg2.jpg\" alt=\"\" /></p>'),
(3, 12, 'en', 'Home', '<p>Home</p>\r\n'),
(4, 12, 'ua', 'Головна', '<p>Головна</p>\r\n'),
(18, 12, 'uk', '', ''),
(19, 20, 'ru', 'О нас', '<p>О нас</p>'),
(20, 20, 'uk', '', ''),
(22, 20, 'en-US', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `routes`
--

INSERT INTO `routes` (`id`, `model`, `model_id`, `url`, `route`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(8, 'common\\models\\Pages', 12, 'index', 'pages/home', '1576489055', '1576489055', '', ''),
(10, 'common\\models\\Section', 1, 'first-section', 'section/view', '1576497806', '1576497806', '', ''),
(17, 'common\\models\\Pages', 20, 'o_nas', 'pages/view', '1577698964', '1577700652', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `section`
--

INSERT INTO `section` (`id`, `slug`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'first-section', 1, '1576497806', '1576497806', '4', '4');

-- --------------------------------------------------------

--
-- Структура таблицы `section_translation`
--

CREATE TABLE `section_translation` (
  `section_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `language` varchar(10) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `section_translation`
--

INSERT INTO `section_translation` (`section_id`, `title`, `language`, `content`) VALUES
(1, 'First section', 'ru', '<p>First section</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(4, 'admin', 'UtQDuTayFj2tMy7O6voGCVtvQxit3quz', '$2y$13$oSaB0W8K1UG45FWDoUuSWO5lMmHeR6AbIb0AQv.ZbrLunwzShukTq', NULL, 'admin@admin.com', 10, 1576273132, 1576273132, 'T5WDs_T7xXts3i-nHwmsdNRKwWVr4Mhm_1576273132');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blocks_translation`
--
ALTER TABLE `blocks_translation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filemanager_mediafile`
--
ALTER TABLE `filemanager_mediafile`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filemanager_mediafile_tag`
--
ALTER TABLE `filemanager_mediafile_tag`
  ADD PRIMARY KEY (`mediafile_id`,`tag_id`);

--
-- Индексы таблицы `filemanager_owners`
--
ALTER TABLE `filemanager_owners`
  ADD PRIMARY KEY (`mediafile_id`,`owner_id`,`owner`,`owner_attribute`);

--
-- Индексы таблицы `filemanager_tag`
--
ALTER TABLE `filemanager_tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_item_translation`
--
ALTER TABLE `menu_item_translation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `pages_translation`
--
ALTER TABLE `pages_translation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `section_translation`
--
ALTER TABLE `section_translation`
  ADD PRIMARY KEY (`section_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `blocks_translation`
--
ALTER TABLE `blocks_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `filemanager_mediafile`
--
ALTER TABLE `filemanager_mediafile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `filemanager_tag`
--
ALTER TABLE `filemanager_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `menu_item_translation`
--
ALTER TABLE `menu_item_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `pages_translation`
--
ALTER TABLE `pages_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
