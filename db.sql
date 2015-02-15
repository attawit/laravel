-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.38-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных lr
CREATE DATABASE IF NOT EXISTS `lr` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `lr`;


-- Дамп структуры для таблица lr.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lr.groups: ~2 rows (приблизительно)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
	(1, 'Usual', 'Standart user'),
	(2, 'Administrator', '{"admin": 1}');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Дамп структуры для таблица lr.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` text NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lr.users: ~3 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `salt`, `name`, `joined`, `group`) VALUES
	(24, 'optimus', '6e52cc146420076102c353c870afb22284880007d36e313c30cb17addf4aeb7b', '«#¨äçéZÁEZE	LÇ]Á¼±awAïâ ú', 'Rodimussssic', '2014-11-22 22:03:11', 2),
	(25, 'alex', '65a50d22c2b29dd34764847985a822c570bae37dc64e9d0e772685d21771b96e', 'ûð^ÔCrr>GëØÀP=Æµé\r©¨;åÕ»L', 'Alexsei Kalashnikov', '2014-11-22 22:46:15', 1),
	(26, 'test', 'b795e73c23f511a9efca809a945ae21b6e8a34974d3f09d1828c0cd817f51b41', 'ÊÑÊ:Ú)uoãGmMziý~2aBÙf·§ Ã', 'Alex Garret', '2014-11-24 00:49:50', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица lr.users_session
CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lr.users_session: ~2 rows (приблизительно)
DELETE FROM `users_session`;
/*!40000 ALTER TABLE `users_session` DISABLE KEYS */;
INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
	(3, 26, '0de41987928fa5088b711a01d07ae734dcaef766185699c39e3043acbc3ba33e'),
	(4, 24, '1c27d0d09efafbb4c2be79951b1bfaa9780ae113d21bb7439e923df944416e8c');
/*!40000 ALTER TABLE `users_session` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
