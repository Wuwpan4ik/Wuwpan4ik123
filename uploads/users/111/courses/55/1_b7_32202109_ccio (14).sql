-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 30 2022 г., 11:24
-- Версия сервера: 10.4.26-MariaDB
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chats`
--

INSERT INTO `chats` (`id`, `user_from`, `user_to`) VALUES
(1, 32, 24);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `give_money` int(11) NOT NULL,
  `achivment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `client_id`, `creator_id`, `comment`, `give_money`, `achivment_date`) VALUES
(2, 32, 32, 'ddwdwdwdwdwdwd', 1111, '2022-10-19');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `course`
--

INSERT INTO `course` (`id`, `author_id`, `name`, `description`, `price`, `uniqu_code`) VALUES
(26, 32, 'Новый курс', 'Описание', 0, '163568ed0cc572'),
(27, 32, 'Новый курс', 'Описание', 0, '16356c14c22068'),
(32, 34, 'Новый курс', 'Описание', 0, '1635937c305638');

-- --------------------------------------------------------

--
-- Структура таблицы `course_content`
--

CREATE TABLE `course_content` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `video` char(255) NOT NULL,
  `price` int(11) DEFAULT 0,
  `query_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `course_content`
--

INSERT INTO `course_content` (`id`, `course_id`, `name`, `description`, `video`, `price`, `query_id`) VALUES
(59, 32, 'Укажите заголовок', 'Укажите описание', './uploads/course/32_Новый курс/Top 5 Hampter.mp4', 0, 1),
(60, 32, 'Укажите заголовок', 'Укажите описание', './uploads/course/32_Новый курс/Top 5 Hampter.mp4', 0, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `funnel`
--

INSERT INTO `funnel` (`id`, `author_id`, `course_id`, `name`, `description`, `price`) VALUES
(219, 34, 32, 'Новая воронка', 'Описание', 0),
(220, 34, NULL, 'Новая воронка', 'Описание', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `funnel_content`
--

CREATE TABLE `funnel_content` (
  `id` int(11) NOT NULL,
  `funnel_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `button_text` varchar(65) DEFAULT NULL,
  `video` varchar(512) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `popup` text DEFAULT NULL,
  `query_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `funnel_content`
--

INSERT INTO `funnel_content` (`id`, `funnel_id`, `name`, `description`, `button_text`, `video`, `price`, `popup`, `query_id`) VALUES
(112, 219, 'ddwdwd', 'xaxdwdwdw', '', './uploads/funnel/219_Новая воронка/Оу май - мем 3 секунды.mp4', 0, '[]', NULL),
(113, 219, 'Укажите заголовок', 'Укажите описание', 'dwdwd', './uploads/funnel/219_Новая воронка/Оу май - мем 3 секунды.mp4', 0, '{\"first_do\":{\"pay_form\":[\"email\"]},\"second_do\":{\"form\":[\"name\"]}}', NULL),
(114, 219, 'Укажите заголовок', 'Укажите описание', NULL, './uploads/funnel/219_Новая воронка/Оу май - мем 3 секунды.mp4', 0, NULL, NULL),
(115, 219, 'Укажите заголовок', 'Укажите описание', NULL, './uploads/funnel/219_Новая воронка/Top 5 Hampter.mp4', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `integrations`
--

CREATE TABLE `integrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prodamus_key` varchar(65) NOT NULL,
  `prodamus_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `chat_id`, `text`, `time`) VALUES
(1, 1, 'dwdwdwdwdwdw', '2022-10-19 17:43:06'),
(2, 1, 'dwdwdwd', '2022-10-19 17:46:02');

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `email` int(64) NOT NULL,
  `name` int(64) NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tariffs`
--

CREATE TABLE `tariffs` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `image` text NOT NULL,
  `price` int(11) NOT NULL,
  `duration` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `second_name` varchar(65) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `gender` varchar(64) NOT NULL,
  `niche` varchar(64) NOT NULL,
  `avatar` varchar(256) NOT NULL,
  `site_url` varchar(32) DEFAULT NULL,
  `source_url` varchar(64) DEFAULT NULL,
  `is_creator` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first_name`, `second_name`, `email`, `password`, `status`, `telephone`, `gender`, `niche`, `avatar`, `site_url`, `source_url`, `is_creator`) VALUES
(17, 'Беспонтовый Жмых', NULL, 'jmih@gmail.com', '123', '0', NULL, 'agender', 'Политика', 'uploads/ava/1522859095_29594518_2007650556165834_4687735189393380628_n.png', NULL, NULL, 0),
(18, 'Алеша', NULL, 'saqiter@inbox.ru', 'haha2134', '1', NULL, 'male', 'Спорт', 'uploads/ava/1.jpg', NULL, NULL, 0),
(19, 'Кто-то Изниоткуда', NULL, 'Lexa@mail.ru', '123', '0', NULL, 'male', 'Животные', 'uploads/ava/photo_2022-03-22_22-48-02.jpg', NULL, NULL, 0),
(20, 'Crackpot Dude', NULL, 'highlightgames.007@gmail.com', '123', '1', NULL, 'male', 'Игры', 'uploads/ava/1.jpg', NULL, NULL, 0),
(21, 'Алексей', NULL, 'lolo@mail.ru', 'lolo', '1', NULL, 'male', 'Политика', 'uploads/ava/1.jpg', NULL, NULL, 0),
(22, 'Aleksander Seredich', NULL, 'seredic4@gmail.com', 'йфяцыч', '2', NULL, 'male', 'Животные', 'uploads/ava/1.jpg', NULL, NULL, 0),
(23, 'Злюка 228', NULL, 'lolik2134@mail.ru', '2134', NULL, NULL, 'male', 'Дизайн', 'uploads/ava/1.jpg', NULL, NULL, 0),
(24, 'BATZKAANAL', NULL, 'lean1500@mail.ru', 'qweleyz8939', NULL, NULL, 'agender', 'Дизайн', 'uploads/ava/8788.png', NULL, NULL, 0),
(25, 'Боря)', NULL, 'Borya@mail.ru', '123', NULL, NULL, 'on', 'Животные', 'uploads/ava/_photo_2022-06-28_13-25-05.jpg', NULL, NULL, 0),
(27, 'Fktrctq', NULL, 'saq@mail.ru', '2134', NULL, NULL, 'on', 'Спорт', 'uploads/ava/1.jpg', NULL, NULL, 0),
(28, 'Алкес', NULL, 'saq@inbox.ru', 'saq@inbox.ru', NULL, NULL, 'on', 'Игры', 'uploads/ava/1.jpg', NULL, NULL, 0),
(30, 'sadacl', NULL, 'sadavn123@mail.ru', 'c8pQx7SBm3aCqmX', NULL, NULL, 'on', 'Обучение', 'uploads/ava/1.jpg', NULL, NULL, 0),
(32, 'Дмитрий', 'second_name', 'Wuwpan4ik111@gmail.com', 'Wuwpan4ik@gmail.com', NULL, NULL, 'W', 'Игры', 'uploads/ava/Wuwpan4ik@gmail.com_Mask Group.png', 'dwwewe', NULL, 0),
(33, 'dwdwdwd', NULL, 'Wuwpan4ik11221@gmail.com', 'Wuwpan4ik@gmail.com', NULL, NULL, '', 'Изотерика', 'uploads/ava/Wuwpan4ik11221@gmail.com_Mask Group.png', NULL, NULL, 0),
(34, 'Wuwpan4ik', NULL, 'Wuwpan4ik@gmail.com', 'Wuwpan4ik@gmail.com', NULL, NULL, '', 'Изотерика', 'uploads/ava/1.jpg', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users_tariff`
--

CREATE TABLE `users_tariff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tariff_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD KEY `client_id` (`client_id`),
  ADD KEY `creator_id` (`creator_id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `course_content`
--
ALTER TABLE `course_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `funnel`
--
ALTER TABLE `funnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT для таблицы `funnel_content`
--
ALTER TABLE `funnel_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users_tariff`
--
ALTER TABLE `users_tariff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Ограничения внешнего ключа таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_tariff`
--
ALTER TABLE `users_tariff`
  ADD CONSTRAINT `users_tariff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
