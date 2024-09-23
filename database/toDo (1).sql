-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 19 2024 г., 12:28
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `toDo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_completed` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `exist` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `is_completed`, `exist`, `created_at`, `updated_at`) VALUES
(1, 2, 'title', 'description', '0', '0', '2024-09-12 17:11:03', '2024-09-17 17:56:18'),
(2, 2, 'проснуться? YES', 'Утро. Будильник. Подъеm', '0', '0', '2024-09-17 19:01:31', '2024-09-18 13:04:51'),
(3, 2, 'Запись', 'Описание', '0', '0', '2024-09-12 17:11:03', '2024-09-17 17:57:39'),
(4, 1, 'Новая запись', 'Содержание записи', '1', '1', '2024-09-12 13:58:48', '2024-09-16 04:20:23'),
(5, 1, 'Заголовок', 'Содержимое', '0', '1', '2024-09-17 06:42:15', '2024-09-17 10:21:26'),
(8, 2, 'Забронировать номер', 'Гостиница Lion', '1', '0', '2024-09-17 15:14:09', '2024-09-18 03:13:56'),
(9, 2, 'Купить продукты', 'Йогурт, воду, сыр, помидоры \n< \n                array(4) {\n  [\"id_task\"]=>\n  string(1) \"9\"\n  [\"select\"]=>\n  string(0) \"\"\n  [\"search\"]=>\n  string(2) \"ы\"\n  [\"act\"]=>\n  string(7) \"oneTask\"\n}\n                ', '0', '0', '2024-09-17 15:52:58', '2024-09-18 14:26:54'),
(11, 2, 'Some task', 'desc', '0', '0', '2024-09-17 16:57:46', '2024-09-18 14:11:39'),
(12, 2, 'One more task', 'desc s', '1', '0', '2024-09-17 17:01:05', '2024-09-18 14:12:42'),
(13, 2, 'пилатес на природе', 'да любой. Нет именно такой \n                                <3 \n                                 \n                                 \n                                 \n                                 \n                пи                ', '0', '1', '2024-09-17 19:04:55', '2024-09-18 16:32:42'),
(14, 2, 'ggq', 'dd  ', '0', '0', '2024-09-18 03:39:41', '2024-09-18 16:45:42'),
(15, 2, 'ididw', 'hygj  33       ', '0', '0', '2024-09-18 03:40:30', '2024-09-18 16:46:38'),
(16, 2, 'Новенькая запись', 'Содержание новенькой записи      ', '0', '1', '2024-09-18 03:56:38', '2024-09-18 16:35:20'),
(17, 2, 'wake up', 'wake up to reality', '0', '0', '2024-09-18 04:02:58', '2024-09-18 14:18:38'),
(18, 2, 'today task', 'task for day', '0', '0', '2024-09-18 04:07:16', '2024-09-18 14:13:11'),
(19, 2, 'ob2sb', 'vfd \n                array(4) {\n  [\"id_task\"]=>\n  string(2) \"19\"\n  [\"select\"]=>\n  string(0) \"\"\n  [\"search\"]=>\n  string(1) \"o\"\n  [\"act\"]=>\n  string(7) \"oneTask\"\n}\n                 \n                array(4) {\n  [\"id_task\"]=>\n  string(2) \"19\"\n  [\"select\"]=>\n  string(0) \"\"\n  [\"search\"]=>\n  string(1) \"o\"\n  [\"act\"]=>\n  string(7) \"oneTask\"\n}\n                ', '1', '1', '2024-09-18 12:44:28', '2024-09-19 06:33:48'),
(20, 2, 'ы', 'ы', '0', '0', '2024-09-18 12:48:51', '2024-09-18 14:26:48'),
(21, 2, 'sss', 'sss', '0', '0', '2024-09-18 13:00:28', '2024-09-18 14:08:51'),
(22, 2, 'task abc', 'abc  ghhj\n                                 \n                tas                ', '1', '1', '2024-09-18 15:25:56', '2024-09-19 06:52:08'),
(23, 2, 'task 1', 'f', '0', '0', '2024-09-18 15:26:43', '2024-09-18 16:46:34'),
(24, 2, 'jenndder', 'password', '1', '1', '2024-09-18 15:41:48', '2024-09-19 06:52:09'),
(25, 2, 'go to collage', 'tomorrow', '1', '1', '2024-09-18 15:43:00', '2024-09-19 07:58:36'),
(26, 2, 'one more task #1', 'ccc', '0', '1', '2024-09-18 15:44:04', '2024-09-19 07:46:46'),
(27, 2, 'bbbb89', 'b', '0', '0', '2024-09-19 06:33:11', '2024-09-19 08:10:50'),
(28, 2, 'gjgj', 'jh', '0', '0', '2024-09-19 06:37:30', '2024-09-19 08:07:31'),
(29, 2, 'Какая то новая тестовая запись', 'что то', '0', '1', '2024-09-19 07:56:49', '2024-09-19 07:56:49');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
(1, 'Polina', '$2y$10$kYYDoSeZJvQILetVEOtxyeVOwM3OlKF62MPuWj4rAC3xE/mJVmdFO'),
(2, 'jenndder', '$2y$10$acMQR.ajcyfAlb0ZHETL.u4/ee6XiRRD.yQf10ttyuI94zZ2Nqf9a'),
(3, 'trapbed', '$2y$10$oD6E4b07V4LTOKFv3.keVOIpD/UZH5jTj7mplN.U3AOLA0/IryD.y'),
(4, 'sinicaptica', '$2y$10$zTUKIWcdkz17.PxRh1qBQOpRNPOGmvrYtL7zkkCxmniDvcsebt2RO'),
(5, 'emtyss', '$2y$10$62AJRn8zdx5pHC3S9WrmeOAGAhTUmZsO9Do3XaeKwuPRsvPRzJ3/.'),
(6, 'userOne', '$2y$10$jzZQKLNY68Np80MQ3JmDp.5i248XS6PtKwErgcLo8TLrpXaW2X5GC'),
(7, 'lololo', '$2y$10$eM.hQz8.Hss3ReL8TwHjL.2P1uoUO7i65jgzFO4Kma.KVTjine06i'),
(8, 'jennder', '$2y$10$ekj3gaKIFAs3OFTQBJOJjeUPWMT9LAAdL4kIpm8KRrDbocb7MjAdy');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
