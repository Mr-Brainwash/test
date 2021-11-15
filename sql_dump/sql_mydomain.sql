-- Adminer 4.8.1 MySQL 5.7.35-log-cll-lve dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `couriers`;
CREATE TABLE `couriers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Ф.И.О курьера',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ФИО курьеров';

INSERT INTO `couriers` (`id`, `name`) VALUES
(1,	'Комаров А. А.'),
(2,	'Шеншин И. М.'),
(3,	'Соломин Я. Г.'),
(4,	'Капшуков Н. П.'),
(5,	'Султанов А. Е.'),
(6,	'Лапин Ф. П.'),
(7,	'Половцев М. Ф.'),
(8,	'Хохлов Ф. Е.'),
(9,	'Лебединский В. И.'),
(10,	'Клюкин З. Е.'),
(11,	'Антипин Я. Ф.');

DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(100) NOT NULL COMMENT 'Регион',
  `duration` int(11) NOT NULL COMMENT 'Длительность поездки (дни)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список регионов и длительность поездки (дни)';

INSERT INTO `regions` (`id`, `region`, `duration`) VALUES
(1,	'Санкт-Петербург',	1),
(2,	'Уфа',	2),
(3,	'Нижний Новгород',	1),
(4,	'Владимир',	1),
(5,	'Кострома',	1),
(6,	'Екатеринбург',	2),
(7,	'Ковров',	1),
(8,	'Воронеж',	1),
(9,	'Самара',	1),
(10,	'Астрахань',	3);

DROP TABLE IF EXISTS `travel_schedule`;
CREATE TABLE `travel_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courier_id` int(11) NOT NULL COMMENT 'Курьер',
  `region_id` int(11) NOT NULL COMMENT 'Регион',
  `departure_date` date NOT NULL COMMENT 'Дата отъезда',
  `return_date` date NOT NULL COMMENT 'Дата возвращения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Расписание поездок в регионы';

INSERT INTO `travel_schedule` (`id`, `courier_id`, `region_id`, `departure_date`, `return_date`) VALUES
(26,	1,	1,	'2021-11-15',	'2021-11-16'),
(27,	1,	2,	'2021-11-17',	'2021-11-19'),
(28,	5,	3,	'2021-11-17',	'2021-11-18'),
(29,	4,	10,	'2021-11-16',	'2021-11-19');

-- 2021-11-15 06:57:29
