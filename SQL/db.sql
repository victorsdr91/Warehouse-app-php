-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.26-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.3.0.4994
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para db_warehouse
DROP DATABASE IF EXISTS `db_warehouse`;
CREATE DATABASE IF NOT EXISTS `db_warehouse` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_warehouse`;


-- Volcando estructura para tabla db_warehouse.black_box
DROP TABLE IF EXISTS `black_box`;
CREATE TABLE IF NOT EXISTS `black_box` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WIDTH` int(11) DEFAULT NULL,
  `HEIGHT` int(11) DEFAULT NULL,
  `DEPTH` int(11) DEFAULT NULL,
  `COLOR` varchar(10) DEFAULT 'Naranja',
  `CHIP` varchar(50) DEFAULT NULL,
  `REGISTER_DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla db_warehouse.black_box: ~6 rows (aproximadamente)
DELETE FROM `black_box`;
/*!40000 ALTER TABLE `black_box` DISABLE KEYS */;
INSERT INTO `black_box` (`ID`, `WIDTH`, `HEIGHT`, `DEPTH`, `COLOR`, `CHIP`, `REGISTER_DATE`) VALUES
	(7, 3, 4, 3, 'Naranja', 'asd', '2015-10-29'),
	(8, 2, 3, 4, 'Naranja', '"SELECT * FROM black_box"', '2015-10-29'),
	(9, 3, 42, 3, 'Naranja', 'asdas', '2015-10-29'),
	(10, 2, 3, 4, 'Naranja', '"SELECT * FROM black_box"', '2015-10-29'),
	(11, 3, 4, 3, 'Naranja', 'asd', '2015-11-17'),
	(12, 3, 4, 3, 'Naranja', 'asd', '2015-11-17');
/*!40000 ALTER TABLE `black_box` ENABLE KEYS */;


-- Volcando estructura para tabla db_warehouse.black_box_backup
DROP TABLE IF EXISTS `black_box_backup`;
CREATE TABLE IF NOT EXISTS `black_box_backup` (
  `ID` int(11) NOT NULL,
  `WIDTH` int(11) DEFAULT NULL,
  `HEIGHT` int(11) DEFAULT NULL,
  `DEPTH` int(11) DEFAULT NULL,
  `COLOR` varchar(10) DEFAULT 'Naranja',
  `CHIP` varchar(50) DEFAULT NULL,
  `REGISTER_DATE` date DEFAULT NULL,
  `DISCHARGE_DATE` date DEFAULT NULL,
  `SHELVES_ID` int(11) DEFAULT NULL,
  `SHELF_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla db_warehouse.black_box_backup: ~2 rows (aproximadamente)
DELETE FROM `black_box_backup`;
/*!40000 ALTER TABLE `black_box_backup` DISABLE KEYS */;
INSERT INTO `black_box_backup` (`ID`, `WIDTH`, `HEIGHT`, `DEPTH`, `COLOR`, `CHIP`, `REGISTER_DATE`, `DISCHARGE_DATE`, `SHELVES_ID`, `SHELF_ID`) VALUES
	(4, 3, 4, 3, 'Naranja', '3', '2015-11-14', '2015-11-18', 7, 4),
	(11, 3, 4, 3, 'Naranja', 'eval(SELECT * FROM black_box)', '2015-10-30', '2015-10-30', 1, 1);
/*!40000 ALTER TABLE `black_box_backup` ENABLE KEYS */;


-- Volcando estructura para tabla db_warehouse.occupated_shelves
DROP TABLE IF EXISTS `occupated_shelves`;
CREATE TABLE IF NOT EXISTS `occupated_shelves` (
  `shelves_id` int(11) NOT NULL,
  `shelf_id` int(11) NOT NULL,
  `box_id` int(11) NOT NULL,
  `box_type` varchar(25) NOT NULL,
  PRIMARY KEY (`shelves_id`,`shelf_id`),
  CONSTRAINT `FK_occupated_shelves_shelves` FOREIGN KEY (`shelves_id`) REFERENCES `shelves` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_warehouse.occupated_shelves: ~14 rows (aproximadamente)
DELETE FROM `occupated_shelves`;
/*!40000 ALTER TABLE `occupated_shelves` DISABLE KEYS */;
INSERT INTO `occupated_shelves` (`shelves_id`, `shelf_id`, `box_id`, `box_type`) VALUES
	(1, 1, 11, 'black_box'),
	(1, 2, 12, 'black_box'),
	(1, 3, 9, 'black_box'),
	(2, 2, 7, 'black_box'),
	(2, 3, 8, 'black_box'),
	(3, 1, 5, 'surprise_box'),
	(3, 2, 3, 'surprise_box'),
	(4, 1, 4, 'security_box'),
	(5, 3, 4, 'surprise_box'),
	(5, 5, 2, 'surprise_box'),
	(6, 1, 10, 'black_box'),
	(7, 3, 6, 'security_box'),
	(9, 2, 5, 'security_box'),
	(11, 2, 3, 'security_box');
/*!40000 ALTER TABLE `occupated_shelves` ENABLE KEYS */;


-- Volcando estructura para tabla db_warehouse.security_box
DROP TABLE IF EXISTS `security_box`;
CREATE TABLE IF NOT EXISTS `security_box` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WIDTH` int(11) DEFAULT NULL,
  `HEIGHT` int(11) DEFAULT NULL,
  `DEPTH` int(11) DEFAULT NULL,
  `COLOR` varchar(10) DEFAULT NULL,
  `LOCK` varchar(50) DEFAULT NULL,
  `REGISTER_DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla db_warehouse.security_box: ~4 rows (aproximadamente)
DELETE FROM `security_box`;
/*!40000 ALTER TABLE `security_box` DISABLE KEYS */;
INSERT INTO `security_box` (`ID`, `WIDTH`, `HEIGHT`, `DEPTH`, `COLOR`, `LOCK`, `REGISTER_DATE`) VALUES
	(3, 3, 4, 5, '#8080ff', 'asd', '2015-10-20'),
	(4, 3, 4, 5, '#ffff00', 'Holita', '2015-10-21'),
	(5, 33, 4, 32, '#0000a0', 'asd', '2015-10-25'),
	(6, 3, 4, 2, '#8a313f', '#23|2#@asd23@asfas', '2015-10-29');
/*!40000 ALTER TABLE `security_box` ENABLE KEYS */;


-- Volcando estructura para tabla db_warehouse.security_box_backup
DROP TABLE IF EXISTS `security_box_backup`;
CREATE TABLE IF NOT EXISTS `security_box_backup` (
  `ID` int(11) NOT NULL,
  `WIDTH` int(11) DEFAULT NULL,
  `HEIGHT` int(11) DEFAULT NULL,
  `DEPTH` int(11) DEFAULT NULL,
  `COLOR` varchar(10) DEFAULT NULL,
  `LOCK` varchar(50) DEFAULT NULL,
  `REGISTER_DATE` date DEFAULT NULL,
  `DISCHARGE_DATE` date DEFAULT NULL,
  `SHELVES_ID` int(11) DEFAULT NULL,
  `SHELF_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla db_warehouse.security_box_backup: ~0 rows (aproximadamente)
DELETE FROM `security_box_backup`;
/*!40000 ALTER TABLE `security_box_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `security_box_backup` ENABLE KEYS */;


-- Volcando estructura para tabla db_warehouse.shelves
DROP TABLE IF EXISTS `shelves`;
CREATE TABLE IF NOT EXISTS `shelves` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SHELF_NUMBER` int(11) NOT NULL DEFAULT '0',
  `OCCUPIED` int(11) NOT NULL DEFAULT '0',
  `MATERIAL` varchar(20) DEFAULT NULL,
  `CORRIDOR` varchar(50) NOT NULL DEFAULT '0',
  `POSITION` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_warehouse.shelves: ~11 rows (aproximadamente)
DELETE FROM `shelves`;
/*!40000 ALTER TABLE `shelves` DISABLE KEYS */;
INSERT INTO `shelves` (`ID`, `SHELF_NUMBER`, `OCCUPIED`, `MATERIAL`, `CORRIDOR`, `POSITION`) VALUES
	(1, 5, 3, 'Iron', 'A', 1),
	(2, 3, 2, 'Iron', 'A', 2),
	(3, 2, 2, 'ASd', 'A', 3),
	(4, 1, 1, 'Iron', 'A', 4),
	(5, 6, 2, 'Quartz', 'A', 5),
	(6, 5, 1, 'Quartz', 'S', 3),
	(7, 4, 1, 'Iron', 'B', 1),
	(8, 6, 0, 'Plastic', 'B', 2),
	(9, 4, 1, 'Iron', 'Ñ', 2),
	(10, 15, 0, 'Iron', 'Ñ', 3),
	(11, 5, 1, 'Steel', 'B', 3);
/*!40000 ALTER TABLE `shelves` ENABLE KEYS */;


-- Volcando estructura para tabla db_warehouse.surprise_box
DROP TABLE IF EXISTS `surprise_box`;
CREATE TABLE IF NOT EXISTS `surprise_box` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WIDTH` int(11) DEFAULT NULL,
  `HEIGHT` int(11) DEFAULT NULL,
  `DEPTH` int(11) DEFAULT NULL,
  `COLOR` varchar(10) DEFAULT NULL,
  `CONTENT` varchar(50) DEFAULT NULL,
  `REGISTER_DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla db_warehouse.surprise_box: ~4 rows (aproximadamente)
DELETE FROM `surprise_box`;
/*!40000 ALTER TABLE `surprise_box` DISABLE KEYS */;
INSERT INTO `surprise_box` (`ID`, `WIDTH`, `HEIGHT`, `DEPTH`, `COLOR`, `CONTENT`, `REGISTER_DATE`) VALUES
	(2, 2, 3, 4, '#ff00ff', 'asdas', '2015-10-29'),
	(3, 3, 5, 2, '#000000', 'asdasd', '2015-10-29'),
	(4, 2, 4, 2, '#c0c0c0', 'SELECT * FROM black_box', '2015-10-29'),
	(5, 3, 4, 3, '#00ff00', 'asd', '2015-10-29');
/*!40000 ALTER TABLE `surprise_box` ENABLE KEYS */;


-- Volcando estructura para tabla db_warehouse.surprise_box_backup
DROP TABLE IF EXISTS `surprise_box_backup`;
CREATE TABLE IF NOT EXISTS `surprise_box_backup` (
  `ID` int(11) NOT NULL,
  `WIDTH` int(11) DEFAULT NULL,
  `HEIGHT` int(11) DEFAULT NULL,
  `DEPTH` int(11) DEFAULT NULL,
  `COLOR` varchar(10) DEFAULT NULL,
  `CONTENT` varchar(50) DEFAULT NULL,
  `REGISTER_DATE` date DEFAULT NULL,
  `DISCHARGE_DATE` date DEFAULT NULL,
  `SHELVES_ID` int(11) DEFAULT NULL,
  `SHELF_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla db_warehouse.surprise_box_backup: ~0 rows (aproximadamente)
DELETE FROM `surprise_box_backup`;
/*!40000 ALTER TABLE `surprise_box_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `surprise_box_backup` ENABLE KEYS */;


-- Volcando estructura para tabla db_warehouse.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NICKNAME` varchar(15) NOT NULL DEFAULT '0',
  `PASSWORD` varchar(256) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT '0',
  `AVATAR` varchar(30) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_warehouse.users: ~0 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Volcando estructura para disparador db_warehouse.black_box_before_delete
DROP TRIGGER IF EXISTS `black_box_before_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `black_box_before_delete` BEFORE DELETE ON `black_box` FOR EACH ROW BEGIN
 	UPDATE shelves set OCCUPIED=OCCUPIED-1 WHERE id=(SELECT shelves_id FROM occupated_shelves WHERE box_id=old.id AND box_type="black_box");
 	INSERT INTO black_box_backup VALUES (old.ID, old.WIDTH, old.HEIGHT, old.DEPTH, old.COLOR, old.CHIP, old.REGISTER_DATE, CURDATE(), (SELECT shelves_id FROM occupated_shelves WHERE box_id=old.ID AND box_type="black_box"), (SELECT shelf_id FROM occupated_shelves WHERE box_id=old.ID AND box_type="black_box"));
 	DELETE FROM occupated_shelves WHERE box_id=old.id AND box_type="black_box";
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Volcando estructura para disparador db_warehouse.security_box_before_delete
DROP TRIGGER IF EXISTS `security_box_before_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `security_box_before_delete` BEFORE DELETE ON `security_box` FOR EACH ROW BEGIN
 	UPDATE shelves set OCCUPIED=OCCUPIED-1 WHERE ID=(SELECT shelves_id FROM occupated_shelves WHERE box_id=old.ID AND box_type="security_box");
 	INSERT INTO security_box_backup VALUES (old.ID, old.WIDTH, old.HEIGHT, old.DEPTH, old.COLOR, old.LOCK, old.REGISTER_DATE, CURDATE(), (SELECT shelves_id FROM occupated_shelves WHERE box_id=old.ID AND box_type="security_box"), (SELECT shelf_id FROM occupated_shelves WHERE box_id=old.ID AND box_type="security_box"));
 	DELETE FROM occupated_shelves WHERE box_id=old.ID AND box_type="security_box";
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Volcando estructura para disparador db_warehouse.surprise_box_before_delete
DROP TRIGGER IF EXISTS `surprise_box_before_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `surprise_box_before_delete` BEFORE DELETE ON `surprise_box` FOR EACH ROW BEGIN
 	UPDATE shelves set OCCUPIED=OCCUPIED-1 WHERE ID=(SELECT shelves_id FROM occupated_shelves WHERE box_id=old.ID AND box_type="surprise_box");
 	INSERT INTO surprise_box_backup VALUES (old.ID, old.WIDTH, old.HEIGHT, old.DEPTH, old.COLOR, old.CONTENT, old.REGISTER_DATE, CURDATE(), (SELECT shelves_id FROM occupated_shelves WHERE box_id=old.ID AND box_type="surprise_box"), (SELECT shelf_id FROM occupated_shelves WHERE box_id=old.ID AND box_type="surprise_box"));
	DELETE FROM occupated_shelves WHERE box_id=old.ID AND box_type="surprise_box";

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
