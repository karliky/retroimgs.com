
n SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2009 at 04:20 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6-2ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `rifalia`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) default NULL,
  `descriptiion` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `tittle` varchar(45) default NULL,
  `short_description` varchar(45) default NULL,
  `long_description` varchar(45) default NULL,
  `lat` float default NULL,
  `long` float default NULL,
  `zoom` int(11) default NULL,
  `price` float default NULL,
  `order` int(11) default NULL,
  `video` varchar(45) default NULL,
  `video_type` varchar(45) default NULL,
  `image` varchar(45) default NULL,
  `acept` varchar(45) default NULL,
  `acepted_date` date default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `categories_id` int(11) default NULL,
  `raffles_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_products_categories` (`categories_id`),
  KEY `fk_products_raffles` (`raffles_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--


-- --------------------------------------------------------

--
-- Table structure for table `products_users`
--

DROP TABLE IF EXISTS `products_users`;
CREATE TABLE `products_users` (
  `users_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`users_id`,`products_id`),
  KEY `fk_products_users_users` (`users_id`),
  KEY `fk_products_users_products` (`products_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `raffles`
--

DROP TABLE IF EXISTS `raffles`;
CREATE TABLE `raffles` (
  `id` int(11) NOT NULL,
  `expirated_date` date default NULL,
  `ticket_number` int(11) default NULL,
  `tickets_price` float default NULL,
  `tickets_bought` int(11) default NULL,
  `last_ticket_date` date default NULL,
  `status` tinyint(1) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `raffles`
--


-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `number` int(11) default NULL,
  `reserved` tinyint(1) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `raffles_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_tickets_raffles` (`raffles_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--


-- --------------------------------------------------------

--
-- Table structure for table `tickets_users`
--

DROP TABLE IF EXISTS `tickets_users`;
CREATE TABLE `tickets_users` (
  `users_id` int(11) NOT NULL,
  `tickets_id` int(11) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`users_id`,`tickets_id`),
  KEY `fk_tickets_users_users` (`users_id`),
  KEY `fk_tickets_users_tickets` (`tickets_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(45) default NULL,
  `password` varchar(45) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `users_description`
--

DROP TABLE IF EXISTS `users_description`;
CREATE TABLE `users_description` (
  `id` int(11) NOT NULL,
  `users_id` int(11) default NULL,
  `address` varchar(45) default NULL,
  `telephone` varchar(45) default NULL,
  `cash` float default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_users_description_users` (`users_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_description`
--

ET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
ET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;