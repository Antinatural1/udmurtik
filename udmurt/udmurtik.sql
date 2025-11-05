-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 05 2025 г., 20:42
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `udmurtik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `excursions`
--

CREATE TABLE `excursions` (
  `id` int(11) NOT NULL,
  `id_route` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `free_seats` int(11) NOT NULL,
  `status` varchar(52) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `excursions`
--

INSERT INTO `excursions` (`id`, `id_route`, `start_time`, `free_seats`, `status`) VALUES
(1, 1, '13:00:00', 35, 'archieved'),
(2, 1, '15:00:00', 35, 'public'),
(3, 1, '13:00:00', 35, 'archieved'),
(4, 2, '09:00:00', 3, 'public'),
(5, 2, '21:00:00', 5, 'public'),
(12, 3, '12:30:00', 7, 'public'),
(13, 8, '12:33:00', 12, 'public');

-- --------------------------------------------------------

--
-- Структура таблицы `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `info`
--

INSERT INTO `info` (`id`, `title`, `description`, `img`) VALUES
(1, 'test', 'test', '7f2da838b03abafd1fa8806f008b73eea7245eaa.jpg'),
(2, 'test2', 'test2', '7f2da838b03abafd1fa8806f008b73eea7245eaa.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `id_route` int(11) NOT NULL,
  `img_point` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_point` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `points`
--

INSERT INTO `points` (`id`, `id_route`, `img_point`, `desc_point`) VALUES
(1, 1, '13. Камни.jpg', 'Ликеро-водочный завод'),
(2, 2, '7f2da838b03abafd1fa8806f008b73eea7245eaa.jpg', 'Буль-буль'),
(3, 1, '1. Черный кот с рыбкой.jpg', 'Сарапумяу'),
(20, 2, '1. Черный кот с рыбкой.jpg', 'zzzz'),
(21, 3, '13. Камни.jpg', 'ням ням'),
(23, 3, '25. Ромашки.jpg', 'нямнмнмямянм\r\n\r\n\r\nлддл\r\n\r\nвыходите бесы'),
(24, 8, '4. Кот с наушниками.jpg', '123123123'),
(25, 8, '8. Божья коровка.jpg', '123123123123123123');

-- --------------------------------------------------------

--
-- Структура таблицы `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_point` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `days` int(5) NOT NULL,
  `seats` int(5) NOT NULL,
  `age` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `route`
--

INSERT INTO `route` (`id`, `name`, `start_point`, `start_date`, `days`, `seats`, `age`, `price`) VALUES
(1, 'Экскурсия на Сарапульский ликеро-водочный завод с дегустацией', 'г. Ижевск', '2025-11-18', 48, 35, '18+', 10),
(2, 'Экскурсия на дно Ижевского пруда', 'д. Забегалово', '2025-11-27', 5, 5, '12+', 1569),
(3, 'Тур \"Вкусная Можга\"', 'д. Балдейка', '2025-10-31', 2, 7, '6+', 10000),
(4, '123', '123', '2025-10-10', 5, 5, '123', 123),
(5, 'Экскурсия \"Из варяг в удмурты\"', 'д. Квака', '2025-11-15', 15, 20, '21+', 5699),
(8, '123123123123', '123123', '1212-12-12', 12, 12, '123', 123);

-- --------------------------------------------------------

--
-- Структура таблицы `sights`
--

CREATE TABLE `sights` (
  `id` int(11) NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sights`
--

INSERT INTO `sights` (`id`, `img`, `description`, `id_user`, `date`) VALUES
(1, '7f2da838b03abafd1fa8806f008b73eea7245eaa.jpg', 'test', 1, '2025-09-01'),
(4, '2. Хаски.jpg', '123', 1, '2025-09-24'),
(5, '1. Черный кот с рыбкой.jpg', '123123', 1, '2025-09-24'),
(6, '1. Черный кот с рыбкой.jpg', '123123123123213123123123', 1, '2025-09-24'),
(7, '9. Пустыня.jpg', '123123123', 5, '2025-09-25');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `last_name`, `name`, `patronymic`, `email`, `password`, `birth_date`) VALUES
(1, 'Пирог', 'Женя', 'Евгеныч', 'PieJ@gmail.com', 'pie', '1981-10-07'),
(5, '123', '123', '123', '123@123', '123', '1233-03-12'),
(11, 'Пироженька', 'Ления', 'Алесевна', 'pie3@gmail.com', 'fepie', '1991-12-23');

-- --------------------------------------------------------

--
-- Структура таблицы `zapisi`
--

CREATE TABLE `zapisi` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_excur` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `zapisi`
--

INSERT INTO `zapisi` (`id`, `id_users`, `id_excur`, `date`) VALUES
(80, 5, 4, '2025-10-02'),
(81, 11, 4, '2025-10-02');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `excursions`
--
ALTER TABLE `excursions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_route` (`id_route`);

--
-- Индексы таблицы `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_route` (`id_route`);

--
-- Индексы таблицы `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sights`
--
ALTER TABLE `sights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zapisi`
--
ALTER TABLE `zapisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_excur` (`id_excur`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `excursions`
--
ALTER TABLE `excursions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `sights`
--
ALTER TABLE `sights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `zapisi`
--
ALTER TABLE `zapisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `excursions`
--
ALTER TABLE `excursions`
  ADD CONSTRAINT `excursions_ibfk_1` FOREIGN KEY (`id_route`) REFERENCES `route` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`id_route`) REFERENCES `route` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sights`
--
ALTER TABLE `sights`
  ADD CONSTRAINT `sights_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `zapisi`
--
ALTER TABLE `zapisi`
  ADD CONSTRAINT `zapisi_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zapisi_ibfk_3` FOREIGN KEY (`id_excur`) REFERENCES `excursions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
