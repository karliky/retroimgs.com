#Rifalia sql generated on: 2009-06-06 19:06:52 : 1244308852

DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `emails`;
DROP TABLE IF EXISTS `enums`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `products_users`;
DROP TABLE IF EXISTS `raffles`;
DROP TABLE IF EXISTS `tickets`;
DROP TABLE IF EXISTS `tickets_users`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `users_description`;


CREATE TABLE `categories` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(45) DEFAULT NULL,
	`descriptiion` text DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `emails` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`from_user_id` int(11) DEFAULT NULL,
	`to_user_id` int(11) DEFAULT NULL,
	`chain_id` int(11) DEFAULT NULL,
	`ip` int(11) DEFAULT NULL,
	`send_date` date DEFAULT NULL,
	`status` varchar(30) DEFAULT 'unsent' NOT NULL,
	`type` varchar(10) DEFAULT 'normal',
	`from` varchar(255) NOT NULL,
	`to` varchar(255) NOT NULL,
	`reply_to` varchar(255) NOT NULL,
	`cc` varchar(255) DEFAULT NULL,
	`bcc` varchar(255) DEFAULT NULL,
	`send_as` varchar(4) DEFAULT 'both' NOT NULL,
	`subject` varchar(255) NOT NULL,
	`template` varchar(255) NOT NULL,
	`layout` varchar(255) NOT NULL,
	`data` text NOT NULL,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `enums` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`type` varchar(30) NOT NULL,
	`order` int(2) DEFAULT NULL,
	`display` varchar(255) DEFAULT NULL,
	`value` varchar(50) NOT NULL,
	`description` text NOT NULL,
	`default` tinyint(1) DEFAULT 0 NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`tittle` varchar(45) DEFAULT NULL,
	`short_description` varchar(45) DEFAULT NULL,
	`long_description` varchar(45) DEFAULT NULL,

	`lat` float DEFAULT NULL,
	`long` float DEFAULT NULL,
	`zoom` int(11) DEFAULT NULL,
	`price` float DEFAULT NULL,
	`order` int(11) DEFAULT NULL,
	`video` varchar(45) DEFAULT NULL,
	`video_type` varchar(45) DEFAULT NULL,
	`image` varchar(45) DEFAULT NULL,
	`acept` varchar(45) DEFAULT NULL,
	`acepted_date` date DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	`categories_id` int(11) DEFAULT NULL,
	`raffle_id` int(11) DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY fk_products_categories (`categories_id`),
	KEY fk_products_raffles (`raffle_id`));

CREATE TABLE `products_users` (
	`users_id` int(11) NOT NULL,
	`products_id` int(11) NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	KEY fk_products_users_users (`users_id`),
	KEY fk_products_users_products (`products_id`));

CREATE TABLE `raffles` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`expirated_date` date DEFAULT NULL,
	`tickets_count` int(11) DEFAULT NULL,
	`tickets_price` float DEFAULT NULL,
	`tickets_bought` int(11) DEFAULT NULL,
	`last_ticket_date` date DEFAULT NULL,
	`status` tinyint(1) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `tickets` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`number` int(11) DEFAULT NULL,
	`reserved` tinyint(1) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	`raffle_id` int(11) DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY fk_tickets_raffles (`raffle_id`));

CREATE TABLE `tickets_users` (
	`users_id` int(11) NOT NULL,
	`tickets_id` int(11) NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	KEY fk_tickets_users_users (`users_id`),
	KEY fk_tickets_users_tickets (`tickets_id`));

CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(20) NOT NULL,
	`email` varchar(255) NOT NULL,
	`group` varchar(15) DEFAULT 'normal',
	`password` varchar(41) NOT NULL,
	`email_verified` tinyint(1) DEFAULT 0 NOT NULL,
	`first_name` varchar(255) DEFAULT NULL,
	`last_name` varchar(255) DEFAULT NULL,
	`pic` varchar(255) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `users_description` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`users_id` int(11) DEFAULT NULL,
	`address` varchar(45) DEFAULT NULL,
	`telephone` varchar(45) DEFAULT NULL,
	`cash` float DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY fk_users_description_users (`users_id`));

