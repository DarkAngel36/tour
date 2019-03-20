/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.7.20 : Database - tour
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tour` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tour`;

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direction` int(1) DEFAULT '1',
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_list` json DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cities` */

insert  into `cities`(`id`,`name`,`direction`,`img`,`img_list`,`status`,`created_at`,`updated_at`) values 
(3,'Казань',1,NULL,NULL,1,1549445411,1549445411),
(4,'Геленджик',2,'','\"\"',1,1550817900,1550817972),
(5,'Анапа',2,'','\"\"',1,1550818019,1550818019),
(6,'Сочи',2,'','\"\"',1,1550818205,1550818205),
(7,'Абхазия',2,'','\"\"',1,1550818228,1550823371);

/*Table structure for table `cities_tours` */

DROP TABLE IF EXISTS `cities_tours`;

CREATE TABLE `cities_tours` (
  `cities_id` int(11) NOT NULL,
  `tours_id` int(11) NOT NULL,
  PRIMARY KEY (`cities_id`,`tours_id`),
  KEY `idx-cities_tours-cities_id` (`cities_id`),
  KEY `idx-cities_tours-tours_id` (`tours_id`),
  CONSTRAINT `fk-cities_tours-cities_id` FOREIGN KEY (`cities_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-cities_tours-tours_id` FOREIGN KEY (`tours_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cities_tours` */

/*Table structure for table `hotels` */

DROP TABLE IF EXISTS `hotels`;

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `description` text,
  `img` varchar(255) DEFAULT NULL,
  `img_list` json DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `hotels` */

insert  into `hotels`(`id`,`name`,`city_id`,`description`,`img`,`img_list`,`status`) values 
(1,'Отель Пеекин',1,'это описание','','\"\"',1);

/*Table structure for table `hotels_period` */

DROP TABLE IF EXISTS `hotels_period`;

CREATE TABLE `hotels_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `from` int(10) DEFAULT NULL,
  `to` int(10) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `cost` double NOT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx-hotels_period-hotel_id` (`hotel_id`),
  CONSTRAINT `fk-hotels_period-hotel_id` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hotels_period` */

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values 
('m000000_000000_base',1548945254),
('m130524_201442_init',1548945258),
('m190131_143656_create_table_cities',1548947140),
('m190131_144014_create_table_tours',1548947182),
('m190131_144708_create_table_tour_lists',1548947278),
('m190131_144729_create_junction_table_for_cities_and_tours_tables',1548947332),
('m190131_151743_add_fk_tours',1548947953),
('m190206_094435_create_hotels_table',1549447059),
('m190206_094843_create_hotels_period_table',1549447059);

/*Table structure for table `tour_lists` */

DROP TABLE IF EXISTS `tour_lists`;

CREATE TABLE `tour_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `date_from` int(11) NOT NULL,
  `date_to` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `cost` double NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `idx-tour_lists-tour_id` (`tour_id`),
  CONSTRAINT `fk-tour_lists-tour_id` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tour_lists` */

/*Table structure for table `tours` */

DROP TABLE IF EXISTS `tours`;

CREATE TABLE `tours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `city_id` int(11) NOT NULL,
  `options` text COLLATE utf8_unicode_ci,
  `programm` text COLLATE utf8_unicode_ci,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_list` json DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `idx-tours-city_id` (`city_id`),
  CONSTRAINT `fk-tours-city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tours` */

insert  into `tours`(`id`,`name`,`info`,`city_id`,`options`,`programm`,`img`,`img_list`,`status`,`created_at`,`updated_at`) values 
(1,'Test Tour','asda sdas asd ',3,'asd asd asd \r\n- asdasd ads aasd  \r\n- asd asd asd asd   \r\n- asd asd as dsd asd a  \r\n','asdfasdf','','{\"1\": \"4afbbbbb053a864310e5e26c01422011.png\", \"2\": \"7f951c42e738ae6fdd1b339fafd4b2a8.png\", \"3\": \"73936e69c375514f6a8b60a4407680c4.png\", \"4\": \"8e6df55242df30497322e317a358c831.png\", \"5\": \"794be1dd95f96f1f3b3c2c116a731575.png\", \"6\": \"14fbb544f2261eb0fe61c38bca9a87a0.png\", \"7\": \"c34d35890e38670dbb5ecc508b044265.png\"}',1,1548951951,1549547840);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values 
(1,'admin','um2SePaFJVA9vKVzuuNhIfRgO_IaeJAT','$2y$13$82yrPMqN4Anpre.lyikK5Oec4SB2jrdmhwjtpRlv6FBLLisfOQWyi',NULL,'admin@nomail.ru',1,1548947497,1548947497);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
