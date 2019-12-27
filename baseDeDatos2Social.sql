-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para practica
CREATE DATABASE IF NOT EXISTS `practica` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `practica`;

-- Volcando estructura para tabla practica.amigos
CREATE TABLE IF NOT EXISTS `amigos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_amigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__users` (`id_user`),
  KEY `FK__users_2` (`id_amigo`),
  CONSTRAINT `FK__users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__users_2` FOREIGN KEY (`id_amigo`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla practica.amigos: ~15 rows (aproximadamente)
DELETE FROM `amigos`;
/*!40000 ALTER TABLE `amigos` DISABLE KEYS */;
INSERT INTO `amigos` (`id`, `id_user`, `id_amigo`) VALUES
	(25, 2, 5),
	(26, 5, 1),
	(27, 5, 3),
	(28, 5, 4),
	(33, 1, 4),
	(34, 1, 5),
	(36, 1, 3),
	(37, 1, 2),
	(39, 2, 1),
	(40, 2, 3),
	(41, 2, 4),
	(42, 3, 1),
	(43, 3, 2),
	(44, 3, 4),
	(45, 3, 5);
/*!40000 ALTER TABLE `amigos` ENABLE KEYS */;

-- Volcando estructura para tabla practica.canales
CREATE TABLE IF NOT EXISTS `canales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `url` varchar(50) NOT NULL DEFAULT '',
  `nombreCanal` varchar(50) NOT NULL DEFAULT '',
  `fecha` date NOT NULL,
  `descripcion` text NOT NULL,
  `longitud` double NOT NULL DEFAULT '0',
  `latitud` double NOT NULL DEFAULT '0',
  `nombreSensor` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_canales_users` (`id_user`),
  CONSTRAINT `FK_canales_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla practica.canales: ~3 rows (aproximadamente)
DELETE FROM `canales`;
/*!40000 ALTER TABLE `canales` DISABLE KEYS */;
INSERT INTO `canales` (`id`, `id_user`, `url`, `nombreCanal`, `fecha`, `descripcion`, `longitud`, `latitud`, `nombreSensor`) VALUES
	(4, 1, '64', 'Teleco', '2019-11-06', 'David Sensor', 7351, 5739, 'raro'),
	(5, 1, '79', 'Canal miguel', '2019-11-06', 'miguelin', 85464, 54654, 'Temperatura'),
	(6, 1, '87', 'Manolo', '2019-11-06', 'Manolin', 324245, 234234, 'raro'),
	(7, 2, '37', 'Canal de Manolo', '2019-12-09', 'una canal random', 152, 144, 'random');
/*!40000 ALTER TABLE `canales` ENABLE KEYS */;

-- Volcando estructura para tabla practica.datossensores
CREATE TABLE IF NOT EXISTS `datossensores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_canal` int(11) DEFAULT NULL,
  `dato` float DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_datossensores_canales` (`id_canal`),
  CONSTRAINT `FK_datossensores_canales` FOREIGN KEY (`id_canal`) REFERENCES `canales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla practica.datossensores: ~33 rows (aproximadamente)
DELETE FROM `datossensores`;
/*!40000 ALTER TABLE `datossensores` DISABLE KEYS */;
INSERT INTO `datossensores` (`id`, `id_canal`, `dato`, `fecha`) VALUES
	(1, 4, 12, '2019-10-30 13:29:27'),
	(2, 4, -61, '2019-10-30 13:33:10'),
	(3, 4, -62, '2019-10-30 13:33:15'),
	(4, 4, -60, '2019-10-30 13:33:21'),
	(5, 4, -57, '2019-10-30 13:33:26'),
	(6, 4, -59, '2019-10-30 13:33:31'),
	(7, 4, -55, '2019-10-30 13:33:36'),
	(8, 4, -55, '2019-10-30 13:33:41'),
	(9, 4, -60, '2019-10-30 13:33:47'),
	(10, 4, -63, '2019-10-30 13:33:52'),
	(11, 4, -63, '2019-10-30 13:33:57'),
	(12, 4, -67, '2019-10-30 13:34:02'),
	(13, 4, -64, '2019-10-30 13:34:07'),
	(14, 4, -60, '2019-10-30 13:34:12'),
	(15, 4, -64, '2019-10-30 13:34:18'),
	(16, 4, -62, '2019-10-30 13:34:23'),
	(17, 4, -61, '2019-10-30 13:34:28'),
	(18, 4, -61, '2019-10-30 13:34:33'),
	(19, 4, -61, '2019-10-30 13:34:39'),
	(20, 4, -65, '2019-10-30 13:34:44'),
	(21, 4, -62, '2019-10-30 13:34:49'),
	(22, 4, -56, '2019-10-30 13:34:54'),
	(23, 4, -53, '2019-10-30 13:35:00'),
	(24, 5, 12, '2019-11-06 11:44:59'),
	(25, 5, 9, '2019-11-06 11:45:20'),
	(26, 5, 11, '2019-11-06 11:45:43'),
	(27, 5, 45, '2019-11-06 11:45:52'),
	(28, 5, 416, '2019-11-06 11:46:01'),
	(29, 6, 12, '2019-11-06 18:22:40'),
	(30, 6, 44, '2019-11-06 18:22:48'),
	(31, 6, 39, '2019-11-06 18:22:52'),
	(32, 6, 2, '2019-11-06 18:22:57'),
	(33, 6, 25, '2019-11-06 18:23:04');
/*!40000 ALTER TABLE `datossensores` ENABLE KEYS */;

-- Volcando estructura para tabla practica.mensajes
CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_receptor` int(11) NOT NULL,
  `privado` char(1) NOT NULL COMMENT '0= publico, 1= privado',
  `fecha` datetime NOT NULL,
  `mensaje` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mensajes_users` (`id_user`),
  KEY `FK_mensajes_users_2` (`id_receptor`),
  CONSTRAINT `FK_mensajes_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_mensajes_users_2` FOREIGN KEY (`id_receptor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla practica.mensajes: ~0 rows (aproximadamente)
DELETE FROM `mensajes`;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` (`id`, `id_user`, `id_receptor`, `privado`, `fecha`, `mensaje`) VALUES
	(1, 1, 4, '0', '2019-12-10 17:14:49', 'Hola mesilla'),
	(2, 1, 4, '1', '2019-12-10 17:15:19', 'Mesilla no'),
	(3, 1, 2, '0', '2019-12-10 17:15:56', 'Que fue!'),
	(4, 1, 3, '0', '2019-12-10 17:16:09', 'Deja la calistenia, que te lesionas'),
	(5, 1, 5, '0', '2019-12-10 17:16:19', 'Hooombre'),
	(6, 1, 4, '0', '2019-12-10 17:16:30', 'Mesilla loquete'),
	(7, 1, 2, '0', '2019-12-10 17:17:00', 'Aun no tienes hecha la base de datos del comercio bien');
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;

-- Volcando estructura para tabla practica.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_perfiles_users` (`id_user`),
  CONSTRAINT `FK_perfiles_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla practica.perfiles: ~0 rows (aproximadamente)
DELETE FROM `perfiles`;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;

-- Volcando estructura para tabla practica.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `passwd` varchar(50) NOT NULL DEFAULT '',
  `fechaNacimiento` date NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla practica.users: ~6 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nombre`, `email`, `passwd`, `fechaNacimiento`, `fecha`) VALUES
	(1, 'Dayron', 'dayron@gmail.com', 'aaaaa', '2019-10-05', '2019-10-24 14:46:00'),
	(2, 'Manolo', 'manolo@gmail.com', 'aaaa', '2019-10-05', '2019-11-06 19:03:09'),
	(3, 'Miguel', 'miguel@gmail.com', 'aaaa', '2019-10-05', '2019-11-06 19:35:04'),
	(4, 'Mesa', 'mesa@gmail.com', 'AAAA', '2019-10-05', '2019-11-06 19:36:11'),
	(5, 'Eric', 'eric@gmail.com', 'aaaa', '2019-10-05', '2019-11-06 19:37:21'),
	(6, 'admin', 'admin@admin.admin', 'admin', '2019-10-05', '2019-11-14 17:33:52');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
