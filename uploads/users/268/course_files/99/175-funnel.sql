-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 30 2022 г., 19:05
-- Версия сервера: 10.6.9-MariaDB
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `b7_32202109_ccio`
--

-- --------------------------------------------------------

--
-- Структура таблицы `funnel`
--

CREATE TABLE `funnel` (
  `id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `description` text DEFAULT NULL,
  `style_settings` varchar(256) DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `funnel`
--

INSERT INTO `funnel` (`id`, `author_id`, `course_id`, `name`, `description`, `style_settings`, `price`) VALUES
(346, 200, NULL, 'Новая воронка', 'Описание', '{\"desc__font\":\"DINPro\",\"title__font\":\"Roboto\",\"button__style-color\":\"background:linear-gradient(rgb(255, 75, 110) 0%, rgb(236, 35, 74) 100%)\",\"button__style-style\":\"box-shadow:undefined\",\"number__style\":\"3\",\"number__color\":\"2\",\"head__settings\":\"\"}', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `funnel`
--
ALTER TABLE `funnel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `funnel`
--
ALTER TABLE `funnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `funnel`
--
ALTER TABLE `funnel`
  ADD CONSTRAINT `funnel_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funnel_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
