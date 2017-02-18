
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 18 2017 г., 14:23
-- Версия сервера: 10.0.28-MariaDB
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u938051509_mydb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `alek_users`
--

CREATE TABLE IF NOT EXISTS `alek_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=113 ;

--
-- Дамп данных таблицы `alek_users`
--

INSERT INTO `alek_users` (`id`, `name`, `surname`, `email`, `password`) VALUES
(112, '''admin''', '''admin''', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3'),
(111, '''a''', '''a''', 'a@gmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(110, '''alex''', '''cornet''', 'alex@gmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(109, '''asd''', '''asd''', 'asd@assd.ua', 'e3e9b83c1119235269f541ac78ab3acb');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
