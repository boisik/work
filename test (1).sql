-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 07 2020 г., 04:59
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `price`) VALUES
(1, 8, 456),
(2, 8, 345),
(3, 6, 467),
(4, 4, 678),
(5, 10, 666),
(6, 10, 456),
(7, 12, 55),
(8, 8, 11111);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(9) NOT NULL,
  `password` varchar(100) NOT NULL,
  `login` varchar(10) DEFAULT NULL,
  `email` varchar(55) NOT NULL,
  `hash` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `login`, `email`, `hash`) VALUES
(1, 'yashka', 'c64be1bdd5440a33281f7d147dd0e6e5', NULL, '', ''),
(7, 'qqqqqq2', '6a311704dad4edb45d3e24beefa748a1', 'qqqqqq', 'qqqqq@qq.er', 'wG36p9a'),
(8, 'viktor', '1b8e4ea305fc77c2cbd7718f92d596a2', 'viktor', 'viktor@viktor.viktor', NULL),
(9, 'fedot', '1b8e4ea305fc77c2cbd7718f92d596a2', 'fedot', 'fedotr@viktor.viktor', NULL),
(10, 'Alex', '1b8e4ea305fc77c2cbd7718f92d596a2', 'Alex123', 'Alex@viktor.viktor', NULL),
(11, 'Lina', '1b8e4ea305fc77c2cbd7718f92d596a2', 'Lina3123', 'Lina@viktor.viktor', NULL),
(12, 'Swordwe', '1b8e4ea305fc77c2cbd7718f92d596a2', 'svs234', 'Linad@viktor.viktor', NULL),
(13, 'Swordwe1', '8baea77f3a4339726cc63d334e13c31a', 'svs23433', 'viktor@viktor.viktor', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
