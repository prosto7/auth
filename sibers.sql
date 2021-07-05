-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 20 2021 г., 19:54
-- Версия сервера: 5.6.43
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sibers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `roleid` int(11) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `namefirst` varchar(128) NOT NULL,
  `namelast` varchar(128) NOT NULL,
  `age` date DEFAULT NULL,
  `gender` varchar(128) DEFAULT NULL,
  `imagepath` varchar(255) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `roleid`, `email`, `namefirst`, `namelast`, `age`, `gender`, `imagepath`, `salt`) VALUES
(145, 'Jora423', '$5$rounds=5000$ZGH5iPADU6FLs7Vd$blNNnOJPf4U8BTK/XIVdBnqijg9E1UGMTDIku/LnD58', 2, 'Jordand199@Nilekd.ru', 'Jordand ', 'Nilekd', '2001-06-03', 'Male', '../images/users/f341a6c6da04bc62_848x477.jpg', '$5$rounds=5000$ZGH5iPADU6FLs7Vd'),
(146, 'Knight09', '$5$rounds=5000$Um5k8G26ealAC7tu$gUq0fdwG360UvBTH9NL7Ni51jDAQnIue8HNJur2Nje5', 2, 'France@mail.ru', 'Ludovic', 'France', '1750-06-01', 'Male', '../images/users/depositphotos_17974895-stock-photo-the-medieval-knight-st-petersburg.jpg', '$5$rounds=5000$Um5k8G26ealAC7tu'),
(147, 'hello1234', '$5$rounds=5000$96Bdwkf0S7mgYPuI$AIOQzL4aSlvo4o/4i/G2k43EhSy3BH/5b7yLHMLUoIB', 1, 'roman1199@mail.ru', 'Roman', 'Hrapov', '2006-01-20', 'Male', '../images/users/dota-date-announcement_thumb_16x9.jpg', '$5$rounds=5000$96Bdwkf0S7mgYPuI'),
(148, 'urt242', '$5$rounds=5000$xAfSbHMuXQzEdOIN$zUp5YnCG3xCOVHsHvwhybeYbJ/s4VGmh1QLm7hMA04/', 2, 'Dkerhgsa@mail.ru', 'Urnteu', 'Dkerhgsa', '1901-06-04', 'Male', '../images/users/ACF_Promo_ACV.webp', '$5$rounds=5000$xAfSbHMuXQzEdOIN'),
(149, 'DragonKN1', '$5$rounds=5000$PBqXSvlu1Tat24xf$..OmrblwDJU31nr1b9o7LvewDU3RXIS.L58lVBmDFBA', 2, 'Ivarads@gmail.com', 'Requsit', 'Ivarads', '1950-01-09', 'Male', '../images/users/images (1).jpg', '$5$rounds=5000$PBqXSvlu1Tat24xf'),
(150, 'Prodsa12', '$5$rounds=5000$9o7WCaljQxgO06tc$lznFKTh5d5l2HbaBnmjiFnPxrwv2C4J7aIEC8v.ri..', 2, 'Prodsanov@mail.ru', 'Ivan', 'Prodsanov', '2000-06-20', 'Male', '../images/users/975-780x410.png', '$5$rounds=5000$9o7WCaljQxgO06tc'),
(151, 'Jorjia12', '$5$rounds=5000$ZvEIqVUrQJb5DGP4$a7OceI8wydsZRaE2pkyuARC1QZAiEl7lpX3PxTm9P/4', 2, 'Jackens@gmail.com', 'Jhorhia', 'Jackens', '1945-03-13', 'Female', '../images/users/Без названия.jpg', '$5$rounds=5000$ZvEIqVUrQJb5DGP4'),
(152, 'Lisi123', '$5$rounds=5000$dsMJYxh1lNyeUjCA$BFdohMRCZFjjBgKSLCl/NVqHFfB8YD3Wf2mRe3clti0', 2, 'Daerwabs@gmail.com', 'Liesa', 'Daerwabs', '2001-02-04', 'Female', '../images/users/30709559.jpg', '$5$rounds=5000$dsMJYxh1lNyeUjCA'),
(153, 'Right23', '$5$rounds=5000$cbVDe1mGHd7BQA8l$dTwLlpyS.Vs0y.Khc45vxFhWKOYvapaaYRB8WnYObT/', 2, 'Wright@gmail.com', 'Will and Orv', 'Wright', '1867-04-16', 'Male', '../images/users/wa3616.1500x1500.jpg', '$5$rounds=5000$cbVDe1mGHd7BQA8l'),
(154, 'Sergo123', '$5$rounds=5000$kIrA4sb0G3M5VYol$IIAv3NYBfl6RDPx4uHr9OwES5U0i1QDorxHsx/p4Mz2', 2, 'Nembed@gmail.com', 'Sergo', 'Nembed', '1650-06-03', 'Male', '../images/users/shablon-novost-109.png', '$5$rounds=5000$kIrA4sb0G3M5VYol'),
(155, 'Kira12', '$5$rounds=5000$ekO8DizMrshIaK2J$RB7JH2PpNvtXvZvnaBY4TPnI.48AuHZFKZLjCT4ExW5', 2, 'Aevaqe@gmail.com', 'Kira', 'Aevaqe', '1993-11-15', 'Female', '../images/users/Mirana_Lunar_art.png', '$5$rounds=5000$ekO8DizMrshIaK2J'),
(156, 'Photograph123', '$5$rounds=5000$oP9iqL1DOh0tJEsC$sOHYzRlUYZHRL69qM5cGkzM0AOyzjmVg0JW7tjFem0D', 2, 'Lukas@gmail.com', 'Lukas', 'Rus', '2021-06-15', 'Male', '../images/users/_DHQ.jpg', '$5$rounds=5000$oP9iqL1DOh0tJEsC'),
(157, 'neoMatrix', '$5$rounds=5000$y0mIlqb3tioLw2GE$iH7kTmGV1ATwQiwkjPQXaGD0/L8jP1Q9ITFZy4I98o4', 2, 'neoMatrix@neo.com', 'Neo', 'Smith', '1990-01-01', 'Male', '../images/users/Neo2.jpg', '$5$rounds=5000$y0mIlqb3tioLw2GE'),
(159, 'hello123', '$5$rounds=5000$AOy4LDXuSRPdZes7$CBh07Ypp.MH9fFOS7n84Wq3QOx9mJm5hgcW58zijHb2', 1, 'roman1199@mail.ru', 'Roman', 'Hrapov', '2021-06-17', 'Male', '../images/users/portrait.jpg', '$5$rounds=5000$AOy4LDXuSRPdZes7'),
(160, 'Player12', '$5$rounds=5000$C0WaBqiHtTdgZLoN$kK4givBv4Hm0z9RuIYrxhT42migL3pljCxDNbIG3r25', 2, 'Player12@gyangkmail.com', 'Gandalf ', ' Grey', '1992-10-20', 'Male', '../images/users/111017.png', '$5$rounds=5000$C0WaBqiHtTdgZLoN');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
