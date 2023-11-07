-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 06 2023 г., 01:34
-- Версия сервера: 5.7.33-0ubuntu0.16.04.1
-- Версия PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `izjxszbd_m3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lot`
--

CREATE TABLE `lot` (
  `id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `start_price` int(10) UNSIGNED NOT NULL,
  `end_date` date NOT NULL,
  `rate_step` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lot`
--

INSERT INTO `lot` (`id`, `create_at`, `name`, `description`, `image`, `start_price`, `end_date`, `rate_step`, `author_id`, `winner_id`, `category`) VALUES
(1, '2023-09-14 08:09:43', '2014 Rossignol District Snowboard', 'cool', 'img/lot-1.jpg', 10999, '2023-09-30', 100, 1, NULL, 1),
(2, '2023-09-14 08:09:43', 'DC Ply Mens 2016/2017 Snowboard', 'cool', 'img/lot-2.jpg', 159999, '2023-09-30', 100, 2, NULL, 1),
(3, '2023-09-14 08:09:43', 'Крепления Union Contact Pro 2015 года размер L/XL', 'cool', 'img/lot-3.jpg', 8000, '2023-10-01', 100, 3, NULL, 2),
(4, '2023-09-14 08:09:43', 'Ботинки для сноуборда DC Mutiny Charocal', 'cool', 'img/lot-4.jpg', 10999, '2023-10-01', 100, 1, NULL, 3),
(5, '2023-09-14 08:09:43', 'Куртка для сноуборда DC Mutiny Charocal', 'cool', 'img/lot-5.jpg', 7500, '2023-10-02', 100, 2, NULL, 4),
(6, '2023-09-14 08:09:43', 'Куртка Мишута', 'cool', 'img/lot-6.jpg', 5400, '2023-10-03', 100, 3, NULL, 6),
(7, '2023-09-14 08:19:26', 'test', 'test', 'img/lot-5.jpg', 1000000, '2023-10-04', 100, 3, NULL, 3),
(9, '2023-09-29 07:18:36', 'asd', 'asd', '/srv/users/izjxszbd/mhsrdrg-m3/uploads/images.jpg', 10000, '2023-10-01', 10000, 1, NULL, 3),
(10, '2023-09-29 07:23:53', 'Привет1', 'ываыва', '/uploads/images.jpg', 12341, '2023-10-27', 12, 1, NULL, 5),
(11, '2023-09-29 07:23:53', 'Привет', 'ываыва', '/uploads/images.jpg', 12341, '2023-10-27', 12, 1, NULL, 5),
(12, '2023-09-29 07:23:53', 'Привет', 'ываыва', '/uploads/images.jpg', 12341, '2023-10-27', 12, 1, NULL, 5),
(13, '2023-09-29 07:23:53', 'Привет', 'ываыва', '/uploads/images.jpg', 12341, '2023-10-27', 12, 1, NULL, 5),
(14, '2023-09-29 07:18:36', 'asd', 'asd', '/srv/users/izjxszbd/mhsrdrg-m3/uploads/images.jpg', 10000, '2023-10-01', 10000, 1, NULL, 3),
(15, '2023-09-29 07:18:36', 'asd1', 'asd', '/srv/users/izjxszbd/mhsrdrg-m3/uploads/images.jpg', 10000, '2023-10-01', 10000, 1, NULL, 3),
(16, '2023-09-29 07:18:36', 'asd2', 'asd', '/srv/users/izjxszbd/mhsrdrg-m3/uploads/images.jpg', 10000, '2023-10-01', 10000, 1, NULL, 3),
(17, '2023-09-29 07:18:36', 'asd3', 'asd', '/srv/users/izjxszbd/mhsrdrg-m3/uploads/images.jpg', 10000, '2023-10-01', 10000, 1, NULL, 3),
(18, '2023-09-29 07:18:36', 'asd4', 'asd', '/srv/users/izjxszbd/mhsrdrg-m3/uploads/images.jpg', 10000, '2023-10-01', 10000, 1, NULL, 3),
(19, '2023-09-29 07:23:53', 'Привет', 'ываыва', '/uploads/images.jpg', 12341, '2023-10-27', 12, 1, NULL, 5),
(20, '2023-09-29 07:23:53', 'Привет', 'ываыва', '/uploads/images.jpg', 12341, '2023-10-27', 12, 1, NULL, 5),
(21, '2023-09-29 07:23:53', 'Привет', 'ываыва', '/uploads/images.jpg', 12341, '2023-10-27', 12, 1, NULL, 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `winner_id` (`winner_id`),
  ADD KEY `category` (`category`);
ALTER TABLE `lot` ADD FULLTEXT KEY `lot_ft_search` (`name`,`description`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lot`
--
ALTER TABLE `lot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `lot_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lot_ibfk_2` FOREIGN KEY (`winner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lot_ibfk_3` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
