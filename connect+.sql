-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for school_rewards
CREATE DATABASE IF NOT EXISTS `school_rewards` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `school_rewards`;

-- Dumping structure for table school_rewards.assignments
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT 'TITLE',
  `btn-bool` bit(1) NOT NULL DEFAULT b'0',
  `text` varchar(50) NOT NULL DEFAULT 'DEFAULT TEXT',
  `img` varchar(500) NOT NULL DEFAULT 'https://via.placeholder.com/300x200',
  `link` varchar(500) DEFAULT '#',
  `btn-text` varchar(50) DEFAULT 'BUTTON',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table school_rewards.assignments: ~2 rows (approximately)
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` (`id`, `subject`, `title`, `btn-bool`, `text`, `img`, `link`, `btn-text`) VALUES
	(32, 'minecraft', 'I found a mesa!', b'0', 'DM me if you want the coords, i also brought back ', 'https://www.minecraft.net/content/dam/games/minecraft/screenshots/badlands-carousel3.jpg', '', ''),
	(33, 'school help', 'Does anyone know what an ATP is?', b'1', 'I was sick last week so I missed out on a lot of t', 'https://o.quizlet.com/mzNRATq7L1Rw4VZcPgNK7Q_b.png', 'https://youtube.com', 'YouTube'),
	(34, 'minecraft', 'NEW title', b'1', 'HELLO WORLD!', 'https://o.quizlet.com/mzNRATq7L1Rw4VZcPgNK7Q_b.png', 'https://www.minecraft.net', 'Minecraft Website');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;

-- Dumping structure for table school_rewards.user_info
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `notifs` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table school_rewards.user_info: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` (`id`, `username`, `email`, `password`, `notifs`) VALUES
	(6, 'USER_1', 'user_1@gmail.com', 'pass for user 1', NULL),
	(8, 'USER_2', 'user_2@gmail.com', 'pass for user 2', NULL),
	(9, 'username', 'example@example.com', 'password', NULL);
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
