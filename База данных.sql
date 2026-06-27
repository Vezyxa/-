-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 27 2026 г., 17:43
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lingua_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_users_info`
--

CREATE TABLE `admin_users_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `word` varchar(100) NOT NULL,
  `translation` varchar(100) NOT NULL,
  `is_learned` tinyint(1) DEFAULT 0,
  `lang_word` varchar(10) DEFAULT 'en',
  `lang_trans` varchar(10) DEFAULT 'ru',
  `category` varchar(50) DEFAULT 'общие'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `word`, `translation`, `is_learned`, `lang_word`, `lang_trans`, `category`) VALUES
(4, NULL, 'Achievement', 'Достижение', 0, 'en', 'ru', 'общие'),
(5, NULL, 'Architecture', 'Архитектура', 0, 'en', 'ru', 'общие'),
(6, NULL, 'Algorithm', 'Алгоритм', 0, 'en', 'ru', 'общие'),
(8, NULL, 'Capability', 'Возможность', 0, 'en', 'ru', 'общие'),
(9, NULL, 'Deployment', 'Развертывание', 0, 'en', 'ru', 'общие'),
(10, NULL, 'Environment', 'Окружение', 0, 'en', 'ru', 'общие'),
(12, NULL, 'Generation', 'Поколение', 0, 'en', 'ru', 'общие'),
(13, NULL, 'Hardware', 'Оборудование', 0, 'en', 'ru', 'общие'),
(14, NULL, 'Implementation', 'Реализация', 0, 'en', 'ru', 'общие'),
(15, NULL, 'Justification', 'Обоснование', 0, 'en', 'ru', 'общие'),
(16, NULL, 'Knowledge', 'Знание', 0, 'en', 'ru', 'общие'),
(17, NULL, 'Language', 'Язык', 0, 'en', 'ru', 'общие'),
(18, NULL, 'Management', 'Управление', 0, 'en', 'ru', 'общие'),
(19, NULL, 'Navigation', 'Навигация', 0, 'en', 'ru', 'общие'),
(20, NULL, 'Optimization', 'Оптимизация', 0, 'en', 'ru', 'общие'),
(21, NULL, 'Performance', 'Производительность', 0, 'en', 'ru', 'общие'),
(22, NULL, 'Quality', 'Качество', 0, 'en', 'ru', 'общие'),
(23, NULL, 'Requirement', 'Требование', 0, 'en', 'ru', 'общие'),
(24, NULL, 'Sustainable', 'Устойчивый', 0, 'en', 'ru', 'общие'),
(25, NULL, 'Transmission', 'Передача', 0, 'en', 'ru', 'общие'),
(27, NULL, 'Workspace', 'Рабочее пространство', 0, 'en', 'ru', 'общие'),
(28, NULL, 'Achievement', 'Достижение', 0, 'en', 'ru', 'общие'),
(29, NULL, 'Algorithm', 'Алгоритм', 0, 'en', 'ru', 'общие'),
(30, NULL, 'Hardware', 'Оборудование', 0, 'en', 'ru', 'общие'),
(31, NULL, 'Environment', 'Окружение', 0, 'en', 'ru', 'общие'),
(32, NULL, 'Framework', 'Фреймворк', 0, 'en', 'ru', 'общие'),
(33, NULL, 'Management', 'Управление', 0, 'en', 'ru', 'общие'),
(34, NULL, 'Navigation', 'Навигация', 0, 'en', 'ru', 'общие'),
(35, NULL, 'Optimization', 'Оптимизация', 0, 'en', 'ru', 'общие'),
(36, NULL, 'Performance', 'Производительность', 0, 'en', 'ru', 'общие'),
(37, NULL, 'Quality', 'Качество', 0, 'en', 'ru', 'общие'),
(38, NULL, 'Requirement', 'Требование', 0, 'en', 'ru', 'общие'),
(39, NULL, 'Sustainable', 'Устойчивый', 0, 'en', 'ru', 'общие'),
(40, NULL, 'Transmission', 'Передача', 0, 'en', 'ru', 'общие'),
(41, NULL, 'Validation', 'Валидация', 0, 'en', 'ru', 'общие'),
(42, NULL, 'Workspace', 'Рабочее пространство', 0, 'en', 'ru', 'общие'),
(43, NULL, 'Word', 'Слово', 0, 'en', 'ru', 'общие'),
(44, NULL, 'Any', 'Любой', 0, 'en', 'ru', 'общие'),
(45, NULL, 'New', 'Новый', 0, 'en', 'ru', 'общие'),
(46, NULL, 'Work', 'Работа', 0, 'en', 'ru', 'общие'),
(47, NULL, 'Part', 'Часть', 0, 'en', 'ru', 'общие'),
(48, NULL, 'Take', 'Взять', 0, 'en', 'ru', 'общие'),
(72, NULL, 'Apple', 'Яблоко', 0, 'en', 'ru', 'Еда'),
(73, NULL, 'Boy', 'Мальчик', 0, 'en', 'ru', 'общие'),
(75, NULL, 'Girl', 'Девочка', 0, 'en', 'ru', 'общие'),
(76, NULL, 'Mother', 'Мама', 0, 'en', 'ru', 'общие'),
(77, NULL, 'Father', 'Папа', 0, 'en', 'ru', 'общие'),
(78, NULL, 'Sister', 'Сестра', 0, 'en', 'ru', 'общие'),
(79, NULL, 'Brother', 'Брат', 0, 'en', 'ru', 'общие'),
(80, NULL, 'Friend', 'Друг', 0, 'en', 'ru', 'общие'),
(81, NULL, 'Bread', 'Хлеб', 0, 'en', 'ru', 'Еда'),
(82, NULL, 'Water', 'Вода', 0, 'en', 'ru', 'Еда'),
(83, NULL, 'Milk', 'Молоко', 0, 'en', 'ru', 'Еда'),
(84, NULL, 'Apple', 'Яблоко', 0, 'en', 'ru', 'Еда'),
(85, NULL, 'Coffee', 'Кофе', 0, 'en', 'ru', 'Еда'),
(86, NULL, 'Table', 'Стол', 0, 'en', 'ru', 'Дом'),
(87, NULL, 'Chair', 'Стул', 0, 'en', 'ru', 'Дом'),
(88, NULL, 'Bed', 'Кровать', 0, 'en', 'ru', 'Дом'),
(89, NULL, 'Door', 'Дверь', 0, 'en', 'ru', 'Дом'),
(90, NULL, 'Window', 'Окно', 0, 'en', 'ru', 'Дом'),
(91, NULL, 'School', 'Школа', 0, 'en', 'ru', 'общие'),
(92, NULL, 'Teacher', 'Учитель', 0, 'en', 'ru', 'общие'),
(93, NULL, 'Book', 'Книга', 0, 'en', 'ru', 'общие'),
(94, NULL, 'Pen', 'Ручка', 0, 'en', 'ru', 'общие'),
(95, NULL, 'Job', 'Работа', 0, 'en', 'ru', 'общие'),
(96, NULL, 'Music', 'Музыка', 0, 'en', 'ru', 'общие'),
(97, NULL, 'Game', 'Игра', 0, 'en', 'ru', 'общие'),
(98, NULL, 'Sport', 'Спорт', 0, 'en', 'ru', 'общие'),
(99, NULL, 'Movie', 'Фильм', 0, 'en', 'ru', 'общие'),
(100, NULL, 'Dance', 'Танец', 0, 'en', 'ru', 'общие'),
(101, NULL, 'Family', 'Семья', 0, 'en', 'ru', 'общие'),
(102, NULL, 'Food', 'Еда', 0, 'en', 'ru', 'общие'),
(103, NULL, 'Furniture', 'Мебель', 0, 'en', 'ru', 'общие'),
(104, NULL, 'School', 'Школа', 0, 'en', 'ru', 'общие'),
(105, NULL, 'Work', 'Работа', 0, 'en', 'ru', 'общие'),
(106, NULL, 'Music', 'Музыка', 0, 'en', 'ru', 'общие'),
(107, NULL, 'Sport', 'Спорт', 0, 'en', 'ru', 'общие'),
(108, NULL, 'City', 'Город', 0, 'en', 'ru', 'общие'),
(109, NULL, 'River', 'Река', 0, 'en', 'ru', 'общие'),
(110, NULL, 'Mountain', 'Гора', 0, 'en', 'ru', 'общие'),
(111, NULL, 'Apple', 'Яблоко', 0, 'en', 'ru', 'Еда'),
(112, NULL, 'Car', 'Машина', 0, 'en', 'ru', 'общие'),
(113, NULL, 'House', 'Дом', 0, 'en', 'ru', 'общие'),
(114, NULL, 'Dog', 'Собака', 0, 'en', 'ru', 'Животные'),
(115, NULL, 'Cat', 'Кот', 0, 'en', 'ru', 'Животные'),
(116, NULL, 'Computer', 'Компьютер', 0, 'en', 'ru', 'общие'),
(117, NULL, 'Phone', 'Телефон', 0, 'en', 'ru', 'общие'),
(118, NULL, 'Table', 'Стол', 0, 'en', 'ru', 'Дом'),
(119, NULL, 'Chair', 'Стул', 0, 'en', 'ru', 'Дом'),
(120, NULL, 'Door', 'Дверь', 0, 'en', 'ru', 'Дом');

-- --------------------------------------------------------

--
-- Структура таблицы `pending_words`
--

CREATE TABLE `pending_words` (
  `id` int(11) NOT NULL,
  `word` varchar(255) DEFAULT NULL,
  `translation` varchar(255) DEFAULT NULL,
  `lang_word` varchar(10) DEFAULT NULL,
  `lang_trans` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `admin_reply` text DEFAULT NULL,
  `status` enum('open','closed') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `message`, `admin_reply`, `status`, `created_at`, `subject`) VALUES
(1, 4, 'Как скоро обнова?', 'скоро\r\nзачилься', 'closed', '2026-06-23 19:40:13', NULL),
(2, 4, 'жду сотку', 'v', 'closed', '2026-06-23 20:15:51', NULL),
(3, 4, 'Не работает то то', '/', 'closed', '2026-06-26 20:15:28', NULL),
(4, 4, 'Не работает то то', '/', 'closed', '2026-06-26 20:19:54', NULL),
(5, 4, 'ffgf', 'ава', 'closed', '2026-06-27 07:24:10', 'Произошел баг'),
(6, 4, 'fff', 'ппп', 'closed', '2026-06-27 07:26:51', 'Произошел баг'),
(7, 4, 'ff', '2134а', 'closed', '2026-06-27 07:37:20', 'Произошел баг'),
(8, 4, 'sds', 'фыыфыв', 'closed', '2026-06-27 07:42:40', 'Произошел баг'),
(9, 4, 'faf', 'цфывфчч', 'closed', '2026-06-27 07:43:02', 'Произошел баг'),
(10, 4, 'афафа', 'афафа', 'closed', '2026-06-27 10:06:33', 'Произошел баг');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bio` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'default_avatar.png',
  `role` enum('user','admin') DEFAULT 'user',
  `is_banned` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `points`, `created_at`, `bio`, `avatar`, `role`, `is_banned`) VALUES
(4, 'Eduuard', 'Eduuard0@yandex.ru', '$2y$10$YARNB9QoCLv3Fg8fylqnreZIgBIHvuYlhPeV2L..PAIqht2Kjj1HK', 760, '2026-06-15 10:15:04', 'zxzx', 'avatars/user_4.jpg', 'user', 0),
(8, 'Admin', 'Admin@mail.ru', '$2y$10$Ln9qvOhOJF5Np2iyw.NajeleeljKafpxP17xyR8a20I7Xxb.3Apme', 0, '2026-06-23 19:35:51', NULL, 'default_avatar.png', 'admin', 0),
(9, 'Maxim', 'Maxim@mail.ru', '$2y$10$adu4gLUhVhtd7e09ANBJtOT8EzMJ/zLa733CPTICgPa4JAOpa54uC', 120, '2026-06-24 05:32:09', 'xxxx', 'avatars/user_9.jpg', 'user', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_progress`
--

CREATE TABLE `user_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `points_earned` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_users_info`
--
ALTER TABLE `admin_users_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `pending_words`
--
ALTER TABLE `pending_words`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin_users_info`
--
ALTER TABLE `admin_users_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT для таблицы `pending_words`
--
ALTER TABLE `pending_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `user_progress`
--
ALTER TABLE `user_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `admin_users_info`
--
ALTER TABLE `admin_users_info`
  ADD CONSTRAINT `admin_users_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_progress`
--
ALTER TABLE `user_progress`
  ADD CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
