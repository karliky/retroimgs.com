-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.45-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema database_name
--

CREATE DATABASE IF NOT EXISTS database_name;
USE database_name;

--
-- Definition of table `acos`
--

DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `model` varchar(255) default '',
  `foreign_key` int(10) unsigned default NULL,
  `alias` varchar(255) default '',
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acos`
--

/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;


--
-- Definition of table `aros`
--

DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `model` varchar(255) default '',
  `foreign_key` int(10) unsigned default NULL,
  `alias` varchar(255) default '',
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aros`
--

/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;


--
-- Definition of table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL default '0',
  `_read` char(2) NOT NULL default '0',
  `_update` char(2) NOT NULL default '0',
  `_delete` char(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aros_acos`
--

/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;


--
-- Definition of table `cake_sessions`
--

DROP TABLE IF EXISTS `cake_sessions`;
CREATE TABLE `cake_sessions` (
  `id` varchar(255) NOT NULL default '',
  `data` text,
  `expires` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cake_sessions`
--

/*!40000 ALTER TABLE `cake_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `cake_sessions` ENABLE KEYS */;


--
-- Definition of table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` text,
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`,`name`,`description`,`created`,`updated`) VALUES 
 (1,'Telefonos','Telefono',NULL,NULL),
 (2,'Coches','Coches',NULL,NULL),
 (3,'Equipos Informaticos','Informatica',NULL,NULL),
 (4,'Viviendas','Viviendas',NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


--
-- Definition of table `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL auto_increment,
  `from_user_id` int(11) default NULL,
  `to_user_id` int(11) default NULL,
  `chain_id` int(11) default NULL,
  `ip` int(11) default NULL,
  `send_date` date default NULL,
  `status` varchar(30) NOT NULL default 'unsent',
  `type` varchar(10) default 'normal',
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `reply_to` varchar(255) NOT NULL,
  `cc` varchar(255) default NULL,
  `bcc` varchar(255) default NULL,
  `send_as` varchar(4) NOT NULL default 'both',
  `subject` varchar(255) NOT NULL,
  `template` varchar(255) NOT NULL,
  `layout` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` (`id`,`from_user_id`,`to_user_id`,`chain_id`,`ip`,`send_date`,`status`,`type`,`from`,`to`,`reply_to`,`cc`,`bcc`,`send_as`,`subject`,`template`,`layout`,`data`,`created`,`modified`) VALUES 
 (1,0,1,NULL,2130706433,NULL,'sendError','private','app <system@app>','hola <hola@hola.com>','noreply@app','a:0:{}','a:0:{}','text','Users Welcome','users/welcome','default','a:3:{s:4:\"User\";a:16:{s:2:\"id\";s:1:\"1\";s:5:\"login\";s:4:\"hola\";s:5:\"email\";s:13:\"hola@hola.com\";s:8:\"password\";s:40:\"2ff32d8dbc59eb72d00338dbde254eac994759ac\";s:7:\"address\";N;s:5:\"phone\";N;s:7:\"balance\";N;s:8:\"is_admin\";s:1:\"1\";s:10:\"is_enabled\";s:1:\"0\";s:17:\"is_email_verified\";s:1:\"0\";s:7:\"updated\";s:19:\"2009-06-07 19:49:03\";s:7:\"created\";s:19:\"2009-06-07 19:49:03\";s:2:\"to\";s:13:\"hola@hola.com\";s:12:\"from_user_id\";i:0;s:9:\"emailType\";s:7:\"private\";s:5:\"token\";s:10:\"ca4a7a33ca\";}s:5:\"Order\";a:0:{}s:6:\"Ticket\";a:0:{}}','2009-06-07 19:49:04','2009-06-07 19:49:05');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;


--
-- Definition of table `enums`
--

DROP TABLE IF EXISTS `enums`;
CREATE TABLE `enums` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(30) NOT NULL,
  `order` int(2) default NULL,
  `display` varchar(255) default NULL,
  `value` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `default` tinyint(1) NOT NULL default '0',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enums`
--

/*!40000 ALTER TABLE `enums` DISABLE KEYS */;
INSERT INTO `enums` (`id`,`type`,`order`,`display`,`value`,`description`,`default`,`created`,`modified`) VALUES 
 (1,'MiEmail.status',1,'Pending','pending','',0,'2009-06-07 19:49:04','2009-06-07 19:49:04'),
 (2,'MiEmail.type',1,'Private','private','',0,'2009-06-07 19:49:04','2009-06-07 19:49:04'),
 (3,'MiEmail.template',1,'Users/welcome','users/welcome','',0,'2009-06-07 19:49:04','2009-06-07 19:49:04');
/*!40000 ALTER TABLE `enums` ENABLE KEYS */;


--
-- Definition of table `i18n`
--

DROP TABLE IF EXISTS `i18n`;
CREATE TABLE `i18n` (
  `id` int(10) NOT NULL auto_increment,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` mediumtext,
  PRIMARY KEY  (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `i18n`
--

/*!40000 ALTER TABLE `i18n` DISABLE KEYS */;
/*!40000 ALTER TABLE `i18n` ENABLE KEYS */;


--
-- Definition of table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `filename` varchar(255) default NULL,
  `ext` varchar(6) NOT NULL default 'gif',
  `dir` varchar(255) default NULL,
  `mimetype` varchar(30) default NULL,
  `filesize` int(11) default NULL,
  `height` int(4) default NULL,
  `width` int(4) default NULL,
  `description` varchar(100) NOT NULL,
  `checksum` varchar(32) default NULL,
  `thumb` tinyint(1) NOT NULL default '0',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;


--
-- Definition of table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `ticket_id` int(11) default NULL,
  `description` varchar(255) default NULL,
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_orders_user_id` (`user_id`),
  KEY `idx_orders_ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


--
-- Definition of table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE `payment_gateways` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `updated` datetime default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateways`
--

/*!40000 ALTER TABLE `payment_gateways` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_gateways` ENABLE KEYS */;


--
-- Definition of table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL auto_increment,
  `provider_id` int(11) default NULL,
  `commission` float default NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) default NULL,
  `short_description` varchar(255) default NULL,
  `description` text,
  `price` float default NULL,
  `video_url` varchar(255) default NULL,
  `is_on_raffle` tinyint(1) NOT NULL default '0',
  `is_approved` tinyint(1) NOT NULL default '0',
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_products_provider_id` (`provider_id`),
  KEY `idx_products_category_id` (`category_id`),
  KEY `idx_products_is_on_raffle` (`is_on_raffle`),
  KEY `idx_products_is_approved` (`is_approved`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`,`provider_id`,`commission`,`category_id`,`name`,`short_description`,`description`,`price`,`video_url`,`is_on_raffle`,`is_approved`,`created`,`updated`) VALUES 
 (1,1,5,1,'Iphone','Iphone','Iphone',100,'',0,0,'2009-06-07 19:55:09','2009-06-07 19:55:09'),
 (2,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,1,0,'2009-06-07 19:55:47','2009-06-07 19:55:47');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


--
-- Definition of table `providers`
--

DROP TABLE IF EXISTS `providers`;
CREATE TABLE `providers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `contact_person` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `balance` float default NULL,
  `default_commission` int(11) default NULL,
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `providers`
--

/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` (`id`,`name`,`contact_person`,`email`,`phone`,`balance`,`default_commission`,`created`,`updated`) VALUES 
 (1,'Juan','juan','juan',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;


--
-- Definition of table `raffles`
--

DROP TABLE IF EXISTS `raffles`;
CREATE TABLE `raffles` (
  `id` int(11) NOT NULL auto_increment,
  `available_tickets` varchar(255) default NULL,
  `ticket_price` varchar(255) default NULL,
  `sold_tickets` varchar(255) default NULL,
  `closes` datetime default NULL,
  `parent_id` int(11) default NULL,
  `is_published` tinyint(1) NOT NULL default '0',
  `published` datetime default NULL,
  `is_assigned` tinyint(1) NOT NULL default '0',
  `assigned` datetime default NULL,
  `winner_id` int(11) default NULL,
  `winner_code` varchar(255) default NULL,
  `is_cancelled` tinyint(1) NOT NULL default '0',
  `cancelled` datetime default NULL,
  `created` datetime default NULL,
  `updated` datetime default NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_raffles_parent_id` (`parent_id`),
  KEY `idx_raffles_is_published` (`is_published`),
  KEY `idx_raffles_is_assigned` (`is_assigned`),
  KEY `idx_raffles_winner_id` (`winner_id`),
  KEY `idx_raffles_is_cancelled` (`is_cancelled`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raffles`
--

/*!40000 ALTER TABLE `raffles` DISABLE KEYS */;
INSERT INTO `raffles` (`id`,`available_tickets`,`ticket_price`,`sold_tickets`,`closes`,`parent_id`,`is_published`,`published`,`is_assigned`,`assigned`,`winner_id`,`winner_code`,`is_cancelled`,`cancelled`,`created`,`updated`,`product_id`) VALUES 
 (1,'100','1','0','0000-00-00 00:00:00',NULL,1,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00',NULL,'',0,'0000-00-00 00:00:00','2009-06-07 19:55:46','2009-06-07 19:55:46',0),
 (2,'100','1','0','0000-00-00 00:00:00',NULL,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',NULL,'',0,'0000-00-00 00:00:00','2009-06-07 19:57:34','2009-06-07 19:57:34',0);
/*!40000 ALTER TABLE `raffles` ENABLE KEYS */;


--
-- Definition of table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` varchar(255) NOT NULL,
  `value` varchar(255) default NULL,
  `type` varchar(30) NOT NULL default 'string',
  `description` varchar(255) default NULL,
  `modified` datetime default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


--
-- Definition of table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `mail` varchar(255) default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;


--
-- Definition of table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(255) default NULL,
  `user_id` int(11) default NULL,
  `raffle_id` int(11) default NULL,
  `transaction_id` int(11) default NULL,
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_tickets_raffle_id` (`raffle_id`),
  KEY `idx_tickets_transaction_id` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` (`id`,`code`,`user_id`,`raffle_id`,`transaction_id`,`created`,`updated`) VALUES 
 (1,'0',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (2,'1',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (3,'2',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (4,'3',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (5,'4',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (6,'5',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (7,'6',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (8,'7',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (9,'8',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (10,'9',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (11,'10',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (12,'11',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (13,'12',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (14,'13',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (15,'14',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (16,'15',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (17,'16',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (18,'17',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (19,'18',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (20,'19',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (21,'20',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (22,'21',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (23,'22',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (24,'23',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (25,'24',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (26,'25',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (27,'26',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (28,'27',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (29,'28',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (30,'29',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (31,'30',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (32,'31',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (33,'32',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (34,'33',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (35,'34',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (36,'35',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (37,'36',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (38,'37',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (39,'38',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (40,'39',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (41,'40',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (42,'41',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (43,'42',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (44,'43',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (45,'44',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (46,'45',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (47,'46',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (48,'47',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (49,'48',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (50,'49',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (51,'50',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (52,'51',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (53,'52',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (54,'53',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (55,'54',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (56,'55',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (57,'56',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (58,'57',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (59,'58',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (60,'59',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (61,'60',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (62,'61',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (63,'62',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (64,'63',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (65,'64',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (66,'65',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (67,'66',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (68,'67',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (69,'68',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (70,'69',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (71,'70',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (72,'71',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (73,'72',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (74,'73',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (75,'74',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (76,'75',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (77,'76',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (78,'77',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (79,'78',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (80,'79',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (81,'80',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (82,'81',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (83,'82',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (84,'83',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (85,'84',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (86,'85',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (87,'86',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (88,'87',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (89,'88',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (90,'89',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (91,'90',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (92,'91',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (93,'92',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (94,'93',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (95,'94',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (96,'95',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (97,'96',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (98,'97',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (99,'98',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (100,'99',NULL,1,NULL,'2009-06-07 19:55:46','2009-06-07 19:55:46'),
 (101,'0',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (102,'1',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (103,'2',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (104,'3',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (105,'4',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (106,'5',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (107,'6',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (108,'7',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (109,'8',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (110,'9',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (111,'10',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (112,'11',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (113,'12',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (114,'13',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (115,'14',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (116,'15',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (117,'16',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (118,'17',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (119,'18',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (120,'19',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (121,'20',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (122,'21',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (123,'22',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (124,'23',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (125,'24',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (126,'25',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (127,'26',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (128,'27',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (129,'28',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (130,'29',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (131,'30',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (132,'31',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (133,'32',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (134,'33',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (135,'34',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (136,'35',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (137,'36',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (138,'37',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (139,'38',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (140,'39',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (141,'40',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (142,'41',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (143,'42',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (144,'43',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (145,'44',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (146,'45',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (147,'46',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (148,'47',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (149,'48',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (150,'49',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (151,'50',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (152,'51',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (153,'52',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (154,'53',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (155,'54',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (156,'55',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (157,'56',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (158,'57',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (159,'58',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (160,'59',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (161,'60',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (162,'61',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (163,'62',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (164,'63',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (165,'64',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (166,'65',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (167,'66',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (168,'67',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (169,'68',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (170,'69',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (171,'70',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (172,'71',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (173,'72',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (174,'73',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (175,'74',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (176,'75',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (177,'76',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (178,'77',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (179,'78',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (180,'79',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (181,'80',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (182,'81',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (183,'82',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (184,'83',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (185,'84',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (186,'85',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (187,'86',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (188,'87',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (189,'88',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (190,'89',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (191,'90',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (192,'91',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (193,'92',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (194,'93',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (195,'94',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (196,'95',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (197,'96',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (198,'97',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (199,'98',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34'),
 (200,'99',NULL,2,NULL,'2009-06-07 19:57:34','2009-06-07 19:57:34');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;


--
-- Definition of table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL auto_increment,
  `payment_gateway_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `transaction_type` varchar(255) default NULL,
  `description` text,
  `amount` int(11) NOT NULL,
  `connection_details` text,
  `authorisation_code` varchar(255) default NULL,
  `payment_requested` datetime default NULL,
  `payment_response` datetime default NULL,
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_transactions_payment_gateway_id` (`payment_gateway_id`),
  KEY `idx_transactions_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `address` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `balance` float default NULL,
  `is_admin` tinyint(1) default '0',
  `is_enabled` tinyint(1) default '0',
  `is_email_verified` tinyint(1) default '0',
  `updated` datetime default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_users_login` (`login`),
  KEY `idx_users_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`login`,`email`,`password`,`address`,`phone`,`balance`,`is_admin`,`is_enabled`,`is_email_verified`,`updated`,`created`) VALUES 
 (1,'hola','hola@hola.com','2ff32d8dbc59eb72d00338dbde254eac994759ac',NULL,NULL,NULL,1,0,0,'2009-06-07 19:49:03','2009-06-07 19:49:03');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
