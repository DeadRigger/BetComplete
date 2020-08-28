-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 02 2018 г., 20:37
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `heliloop_bet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `team`
--

INSERT INTO `team` (`id`, `id_category`, `name`, `country`, `icon`, `description`) VALUES
(4, 2, 'Sprout', NULL, NULL, NULL),
(5, 2, 'LPSP', NULL, NULL, NULL),
(6, 2, 'MANS NOT HOT', NULL, NULL, NULL),
(7, 2, 'Windigo', NULL, 'icon\\CSGO\\Windigo.png', ''),
(8, 2, 'Fragsters', NULL, 'icon\\CSGO\\Fragsters.png', NULL),
(9, 2, 'Nexus', NULL, 'icon\\CSGO\\Nexus.png', NULL),
(10, 2, 'Refuse', NULL, NULL, NULL),
(11, 2, 'TinderklubeN', NULL, NULL, NULL),
(12, 2, 'Bravado', NULL, 'icon\\CSGO\\Bravado.png', NULL),
(13, 2, 'Iceberg', NULL, NULL, NULL),
(14, 2, 'TeamOne', NULL, 'icon\\CSGO\\TeamOne.png', NULL),
(15, 2, '2K', NULL, NULL, NULL),
(16, 2, 'Mythic', NULL, 'icon\\CSGO\\Mythic.png', NULL),
(17, 2, 'LFAO', NULL, NULL, NULL),
(18, 2, 'BlackOut', NULL, NULL, NULL),
(19, 2, 'F1-racecar-PEEK', NULL, NULL, NULL),
(20, 2, 'Etherian', NULL, NULL, NULL),
(21, 2, 'Wise', NULL, NULL, NULL),
(22, 2, 'FaZe', NULL, 'icon\\CSGO\\Faze.png', ''),
(23, 2, 'Natus Vincere', NULL, 'icon\\CSGO\\Natus Vincere.png', ''),
(24, 2, 'Space Soldiers', NULL, 'icon\\CSGO\\Space Soldiers.png', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
