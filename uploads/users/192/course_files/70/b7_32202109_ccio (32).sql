-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 26 2022 г., 21:01
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
-- Структура таблицы `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `email` varchar(32) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `give_money` int(11) NOT NULL,
  `achivment_date` date DEFAULT NULL,
  `buy_progress` int(11) NOT NULL,
  `first_buy` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `email`, `tel`, `creator_id`, `course_id`, `comment`, `give_money`, `achivment_date`, `buy_progress`, `first_buy`) VALUES
(174, 'dwdwd', 'dimalim11132310@gmail.com', '+79373321681', 121, 66, NULL, 150000, '2022-12-16', 0, 1),
(177, 'Дмитрий', 'Wuwpan4ik1@gmail.com', '+79373321681', 121, 66, NULL, 1000, '2022-12-17', 0, 1),
(182, 'Дмитрий', 'dimalim110@gmail.com', '+79373321680', 121, 66, NULL, 3123132, '2022-12-23', 2, 1),
(183, '', 'dimalim110@gmail.com', '', 121, 67, NULL, 111, '2022-12-23', 2, 1),
(184, '', 'dimalim110@gmail.com', '', 121, 69, NULL, 0, '2022-12-23', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `uniqu_code` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `course`
--

INSERT INTO `course` (`id`, `author_id`, `name`, `description`, `price`, `uniqu_code`) VALUES
(66, 121, 'dwdwd', 'Описание', 3123132, '1638c434bd0d9c'),
(67, 121, 'Новый курс', 'Описание', 111, '1638e558c13f81'),
(69, 121, 'Новый курс', 'Описание', 0, '163a36c674cbc6');

-- --------------------------------------------------------

--
-- Структура таблицы `course_content`
--

CREATE TABLE `course_content` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video` char(255) NOT NULL,
  `price` int(11) DEFAULT 0,
  `thubnails` text DEFAULT NULL,
  `file_url` char(255) DEFAULT NULL,
  `query_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `course_content`
--

INSERT INTO `course_content` (`id`, `course_id`, `name`, `description`, `video`, `price`, `thubnails`, `file_url`, `query_id`) VALUES
(120, 66, 'Укажите заголовокdfddwdw', 'вцвцвц', './uploads/users/121/courses/66/1_Оу май - мем 3 секунды.mp4', 122222, './uploads/users/121/thumbnails/66/1_Оу май - мем 3 секунды.mp4.jpg', './uploads/users/121/course_files/66/', 1),
(121, 66, 'Укажите заголовок', 'Укажите описание322d2d', './uploads/users/121/courses/66/2_Оу май - мем 3 секунды.mp4', 10088, './uploads/users/121/thumbnails/66/2_Оу май - мем 3 секунды.mp4.jpg', './uploads/users/121/course_files/66/', 2),
(122, 67, 'Укажите заголовок', 'Укажите описание', './uploads/users/121/courses/67/1_Оу май - мем 3 секунды.mp4', 100, './uploads/users/121/thumbnails/67/1_Оу май - мем 3 секунды.mp4.jpg', NULL, 1),
(123, 67, 'Укажите заголовок', 'Укажите описание', './uploads/users/121/courses/67/2_Оу май - мем 3 секунды.mp4', 0, './uploads/users/121/thumbnails/67/2_Оу май - мем 3 секунды.mp4.jpg', NULL, 2),
(126, 69, 'Укажите заголовок', 'Укажите описание', './uploads/users/121/courses/69/1_Оу май - мем 3 секунды.mp4', 0, './uploads/users/121/thumbnails/69/1_Оу май - мем 3 секунды.mp4.jpg', NULL, 1);

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
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `funnel`
--

INSERT INTO `funnel` (`id`, `author_id`, `course_id`, `name`, `description`, `price`) VALUES
(316, 118, NULL, 'Новая воронка', 'Описание', 0),
(318, 125, NULL, 'Новая воронка', 'Описание', 0),
(333, 121, 66, 'dwdwdw', 'Описание', 0),
(334, 121, NULL, 'Новая воронка', 'Описание', 0),
(335, 162, NULL, 'Новая воронка', 'Описание', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `funnel_content`
--

CREATE TABLE `funnel_content` (
  `id` int(11) NOT NULL,
  `funnel_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `button_text` varchar(65) DEFAULT NULL,
  `video` varchar(512) NOT NULL,
  `popup` text DEFAULT NULL,
  `query_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `funnel_content`
--

INSERT INTO `funnel_content` (`id`, `funnel_id`, `name`, `description`, `button_text`, `video`, `popup`, `query_id`) VALUES
(216, 318, 'Укажите заголовоквцвц', 'Укажите описаниеdwdwd', 'Жмяк', './uploads/users/125//funnels/318/1_Оу май - мем 3 секунды.mp4', NULL, 1),
(222, 333, 'dwdwdd', '', NULL, './uploads/users/121//funnels/333/1_Оу май - мем 3 секунды.mp4', '{\"first_do\":{\"next_lesson\":true},\"button_text\":\"Отправить\",\"form__title\":\"Заголовок\",\"form__desc\":\"Описание\"}', 1),
(223, 333, '', 'Укажите описание', 'dwdwdwd', './uploads/users/121//funnels/333/2_Оу май - мем 3 секунды.mp4', '{\"first_do\":{\"list\":true,\"course_id\":\"66\"},\"button_text\":\"Отправить\",\"form__title\":\"Заголовок\",\"form__desc\":\"Описание\"}', 2),
(224, 333, 'Укажите заголовок', 'Укажите описание', NULL, './uploads/users/121//funnels/333/3_Hamster.mp4', NULL, 3),
(225, 334, 'Укажите заголовок', 'Укажите описание', NULL, './uploads/users/121//funnels/334/1_Оу май - мем 3 секунды.mp4', NULL, 1),
(226, 335, 'Укажите заголовок', 'Укажите описание', NULL, './uploads/users/162//funnels/335/1_Оу май - мем 3 секунды.mp4', NULL, 1),
(227, 333, 'Укажите заголовок', 'Укажите описание', 'вцвцв', './uploads/users/121//funnels/333/4_Оу май - мем 3 секунды.mp4', NULL, 4),
(228, 333, NULL, NULL, NULL, './uploads/users/121//funnels/333/5_Оу май - мем 3 секунды.mp4', NULL, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `integrations`
--

CREATE TABLE `integrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prodamus_key` varchar(65) NOT NULL,
  `prodamus_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class` varchar(64) DEFAULT NULL,
  `body` varchar(64) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `is_checked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `class`, `body`, `image`, `date`, `time`, `is_checked`) VALUES
(100, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:24:59', 1),
(102, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:30:34', 1),
(104, 121, 'item-like', 'Ваш урок Укажите заголовок купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:33:48', 1),
(106, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:36:13', 1),
(108, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:37:52', 1),
(110, 121, 'item-like', 'Ваш урок Укажите заголовок купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:40:54', 1),
(112, 121, 'item-like', 'Ваш урок Укажите заголовок купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:42:32', 1),
(114, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:43:30', 1),
(116, 121, 'item-like', 'Ваш урок Укажите заголовокd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:51:37', 1),
(118, 121, 'item-like', 'Ваш урок Укажите заголовок купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:52:48', 1),
(120, 121, 'item-like', 'Ваш урок Укажите заголовокd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:55:41', 1),
(122, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:58:28', 1),
(124, 121, 'item-like', 'Ваш урок Укажите заголовок купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:59:32', 1),
(126, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '20:59:44', 1),
(128, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-08', '21:01:10', 1),
(130, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-20', '20:12:25', 1),
(132, 121, 'item-like', 'Ваш урок Укажите заголовок купил пользователь', '/img/Notification/message.png', '2022-12-20', '20:14:37', 1),
(133, 154, 'item-like', 'Вы купили курс dwdwd', '/img/Notification/message.png', '2022-12-21', '10:06:35', 0),
(134, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-21', '10:06:35', 1),
(135, 121, 'item-like', 'Вы купили курс dwdwd', '/img/Notification/message.png', '2022-12-21', '10:42:45', 1),
(136, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-21', '10:42:45', 1),
(137, 155, 'item-like', 'Вы купили курс dwdwd', '/img/Notification/message.png', '2022-12-21', '10:43:18', 0),
(138, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-21', '10:43:18', 1),
(140, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-21', '10:44:02', 1),
(141, 163, 'item-like', 'Вы купили курс dwdwd', '/img/Notification/message.png', '2022-12-23', '19:27:28', 0),
(142, 121, 'item-like', 'Ваш курс dwdwd купил пользовательДмитрий', '/img/Notification/message.png', '2022-12-23', '19:27:28', 1),
(143, 163, 'item-like', 'Вы купили курс Новый курс', '/img/Notification/message.png', '2022-12-23', '19:27:51', 0),
(144, 121, 'item-like', 'Ваш курс Новый курс купил пользователь', '/img/Notification/message.png', '2022-12-23', '19:27:51', 1),
(145, 163, 'item-like', 'Вы купили курс Новый курс', '/img/Notification/message.png', '2022-12-23', '19:28:32', 0),
(146, 121, 'item-like', 'Ваш курс Новый курс купил пользователь', '/img/Notification/message.png', '2022-12-23', '19:28:32', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `course_content_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `money` int(11) NOT NULL,
  `achivment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `course_id`, `course_content_id`, `creator_id`, `money`, `achivment_date`) VALUES
(25, 163, 66, NULL, 121, 3123132, '2022-12-23'),
(26, 163, 67, NULL, 121, 111, '2022-12-23'),
(27, 163, 69, NULL, 121, 0, '2022-12-23');

-- --------------------------------------------------------

--
-- Структура таблицы `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `purchase`
--

INSERT INTO `purchase` (`id`, `user_id`, `purchase`) VALUES
(88, 154, '{\"course_id\":[\"66\"], \"video_id\":[]}'),
(89, 121, '{\"course_id\":[\"66\"], \"video_id\":[]}'),
(90, 155, '{\"course_id\":[\"66\"], \"video_id\":[]}'),
(92, 163, '{\"course_id\":[\"66\",\"67\",\"69\"],\"video_id\":[]}');

-- --------------------------------------------------------

--
-- Структура таблицы `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `income_week` int(11) NOT NULL,
  `income_month` int(11) NOT NULL,
  `income_all_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `tariffs`
--

CREATE TABLE `tariffs` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `funnel_count` int(11) NOT NULL,
  `course_count` int(11) NOT NULL,
  `file_size` double NOT NULL,
  `children_count` int(11) NOT NULL,
  `image` text NOT NULL,
  `price` int(11) NOT NULL,
  `duration` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `tariffs`
--

INSERT INTO `tariffs` (`id`, `name`, `description`, `funnel_count`, `course_count`, `file_size`, `children_count`, `image`, `price`, `duration`) VALUES
(1, 'Starter', 'Идеально подходит для тех кто начинает свой первый курс', 1, 1, 1, 1000, '/img/Tarifs/starter-tariff.jpg', 2990, 'MONTH'),
(2, 'Beginner', 'Для тех кто уже знает что нужно для запуска курса', 3, 2, 2.5, 2000, '/img/Tarifs/beginner-tariff.jpg', 5600, 'MONTH'),
(3, 'Proffesional', 'Подойдет для онлайн-школ с возможностью на роста', 10, 5, 10, 10000, '/img/Tarifs/prof-tariff.jpg', 12000, 'MONTH');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `second_name` varchar(65) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `gender` varchar(64) DEFAULT NULL,
  `niche` varchar(64) DEFAULT NULL,
  `avatar` varchar(256) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `site_url` varchar(32) DEFAULT NULL,
  `school_name` varchar(20) DEFAULT NULL,
  `school_desc` varchar(32) DEFAULT NULL,
  `currency` varchar(1) DEFAULT NULL,
  `source_url` varchar(64) DEFAULT NULL,
  `is_creator` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `second_name`, `birthday`, `email`, `password`, `telephone`, `gender`, `niche`, `avatar`, `city`, `country`, `site_url`, `school_name`, `school_desc`, `currency`, `source_url`, `is_creator`) VALUES
(118, NULL, 'Дмитрий', 'Лиманский', NULL, 'dimalim1110@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(120, NULL, 'Дмитрий', 'Лиманский', NULL, 'dimalim112111323110@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(121, 'Wuwpan4ik', 'Дмитрий', 'Лиманский', '2022-12-08', 'dimalim11110@gmail.com', 'admin', '+79373321681', NULL, 'Дизайн', './uploads/ava/dimalim11110@gmail.com.png', 'Екатеринбург г', 'Россия', NULL, 'dqwdqdwq', 'dqwdqd', '₽', NULL, 1),
(125, NULL, 'Дмитрий', 'Лиманский', NULL, 'dimalim@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/dimalim@gmail.com_add.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(126, '', 'Дмитрий', 'Лиманский', NULL, 'dima@inbox.php', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(127, 'Wuwpan4ik1', 'Дмитрий', 'Лиманский', NULL, 'dimali@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(153, 'Wuwpan4ik111', 'Дмитрий', 'Лиманский', NULL, 'dimalim112310@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(154, NULL, NULL, NULL, NULL, 'Wuwpan4ik12@gmail.com', '8E32VNwbbEjS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(155, NULL, NULL, NULL, NULL, 'dimalim1113232310@gmail.co', 'g7IinADqVaSC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(157, 'Wuwpan4ik1111', 'Дмитрий', 'Лиманский', NULL, 'ddwdw@dd.ru', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(158, 'Wuwpan4ik1111dwdw', 'Дмитрий', 'Лиманский', NULL, 'ddwddawdaw@dd.ru', 'admindwadwd', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(159, 'Wuwpan4ik', 'Дмитрий', 'Лиманский', NULL, 'dwdwdwdw@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(160, 'Wuwpan4ik3121d1', 'Дмитрий', 'Лиманский', NULL, 'dwadwd@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(161, 'Wuwpan4ik', 'Дмитрий', 'Лиманский', NULL, 'dwdwdwdwd@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(162, 'Wuwpan4ik313213231', 'Дмитрий', 'Лиманский', NULL, 'dimalim110dwdwad@gmail.com', 'admin', NULL, NULL, 'Эзотерика', 'uploads/ava/userAvatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(163, NULL, NULL, NULL, NULL, 'dimalim110@gmail.com', 'MR9gxJ3SNJtn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users_tariff`
--

CREATE TABLE `users_tariff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tariff_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vk` varchar(64) DEFAULT NULL,
  `instagram` varchar(64) DEFAULT NULL,
  `whatsapp` varchar(64) DEFAULT NULL,
  `telegram` varchar(64) DEFAULT NULL,
  `facebook` varchar(64) DEFAULT NULL,
  `youtube` varchar(64) DEFAULT NULL,
  `twitter` varchar(64) DEFAULT NULL,
  `site` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user_contacts`
--

INSERT INTO `user_contacts` (`id`, `user_id`, `vk`, `instagram`, `whatsapp`, `telegram`, `facebook`, `youtube`, `twitter`, `site`) VALUES
(3, 121, 'dwdwdwdwdwdwd', 'dwdwd', 'dwdwdwd', NULL, NULL, NULL, 'qqqqqqqqqqqqqqqqqqqqqqq', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_from` (`user_from`),
  ADD KEY `user_to` (`user_to`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`author_id`);

--
-- Индексы таблицы `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Индексы таблицы `funnel`
--
ALTER TABLE `funnel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Индексы таблицы `funnel_content`
--
ALTER TABLE `funnel_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funnel_id` (`funnel_id`);

--
-- Индексы таблицы `integrations`
--
ALTER TABLE `integrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class` (`class`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `orders_ibfk_2` (`creator_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orders_ibfk_4` (`course_content_id`);

--
-- Индексы таблицы `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user.id` (`user_id`);

--
-- Индексы таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_tariff`
--
ALTER TABLE `users_tariff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tariff_id` (`tariff_id`);

--
-- Индексы таблицы `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `course_content`
--
ALTER TABLE `course_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT для таблицы `funnel`
--
ALTER TABLE `funnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT для таблицы `funnel_content`
--
ALTER TABLE `funnel_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT для таблицы `integrations`
--
ALTER TABLE `integrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT для таблицы `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT для таблицы `users_tariff`
--
ALTER TABLE `users_tariff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`user_from`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_ibfk_3` FOREIGN KEY (`user_to`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `course_content`
--
ALTER TABLE `course_content`
  ADD CONSTRAINT `course_content_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `funnel`
--
ALTER TABLE `funnel`
  ADD CONSTRAINT `funnel_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funnel_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `funnel_content`
--
ALTER TABLE `funnel_content`
  ADD CONSTRAINT `funnel_content_ibfk_1` FOREIGN KEY (`funnel_id`) REFERENCES `funnel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `integrations`
--
ALTER TABLE `integrations`
  ADD CONSTRAINT `integrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`course_content_id`) REFERENCES `course_content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_tariff`
--
ALTER TABLE `users_tariff`
  ADD CONSTRAINT `users_tariff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD CONSTRAINT `user_contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
