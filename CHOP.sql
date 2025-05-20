-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 20 2025 г., 11:35
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `CHOP`
--

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id_servis` int NOT NULL,
  `img` longblob NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id_servis`, `img`, `name`, `description`, `price`) VALUES
(1, 0x6173736574732f52656374616e676c652033382e706e67, 'Частные следователи', 'Мы поможем найти законные и эффективные решения с помощью наших следователей', 2000),
(2, 0x6173736574732f52656374616e676c65203338202831292e706e67, 'Персональное следствие', 'Личные дела, пропавшие члены семьи и брачные расследования. Доступны и легальны', 3000),
(3, 0x6173736574732f52656374616e676c65203338202832292e706e67, 'Вооружённая охрана', 'Мы оцениваем потребности каждого клиента в безопсаности и подбираем квалифицированных сотрудников', 5000),
(4, 0x6173736574732f52656374616e676c65203338202833292e706e67, 'Безопасность мероприятий', 'Мы предоставляли услуги на мероприятиях и площадках от небольших до крупных масштабов', 2000),
(5, 0x6173736574732f52656374616e676c65203338202834292e706e67, 'Безопасность помещений', 'Наши агенты безопасности обеспечивают продуманную систему надзора для охраны коммерческих помещений', 3000),
(6, 0x6173736574732f52656374616e676c65203338202836292e706e67, 'Безопасность недвижимости', 'Мы понимаем, что ваш дом является вашим самым большим активом. Здесь вы должны ощущать полный комфорт и безопасность', 6999),
(7, 0x6173736574732f52656374616e676c65203338202837292e706e67, 'Тревожная кнопка', 'Быстрая и эффективная помощь при чрезвычайных ситуациях.', 1999),
(8, 0x6173736574732f52656374616e676c65203338202838292e706e67, 'Сигнализация', 'Установка системы сигнализации и выездом на объект группы немедленного реагирования.', 3000),
(9, 0x6173736574732f52656374616e676c65203338202839292e706e67, 'Пультовая охрана', ' Установка систем охранной, пожарной и тревожной сигнализации с последующим подключением к собственному пульту централизованного наблюдения', 4000),
(10, 0x6173736574732f52656374616e676c6520333820283130292e706e67, 'Охрана периметра', 'Комплекс мер по обеспечению безопасности территории любого объекта', 2000),
(11, 0x6173736574732f52656374616e676c6520333820283131292e706e67, 'Кибербезопасность', 'Комплекс мероприятий, направленных на защиту цифровых активов компании от киберугроз.', 7000),
(12, 0x6173736574732f52656374616e676c6520333820283132292e706e67, 'Охрана VIP-персон', 'Охрана высокопоставленных лиц на высшем уровне и защита репутации', 10000);

-- --------------------------------------------------------

--
-- Структура таблицы `subscribe_user`
--

CREATE TABLE `subscribe_user` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `subscribe_user`
--

INSERT INTO `subscribe_user` (`id`, `email`) VALUES
(1, 'fd@fhs.asd'),
(2, 'qwe@qwe.qwe'),
(3, 'asfds@sdfs.asdfasdg'),
(4, 'dsg@jklg.adj');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `create_at`, `admin`) VALUES
(10, 'qwe', '$2y$10$VYCvNQBpD3fp80rmUu8squ.nQ.H.mj9dkp28rY5fb0qMkv4iYCoqW', 'qwe@qwe.qwe', '2025-05-14 11:52:44', '1'),
(11, 'qwer', '$2y$10$0pAt7g07vPmjLzPGQWbeqeXve6JySuDJV0tRBXDZchtIaI4HJeJfS', 'qwer@qwe.qwe', '2025-05-19 09:15:56', '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_servis`);

--
-- Индексы таблицы `subscribe_user`
--
ALTER TABLE `subscribe_user`
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
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id_servis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `subscribe_user`
--
ALTER TABLE `subscribe_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
