#Rifalia sql generated on: 2009-06-06 16:06:13 : 1244298913

DROP TABLE IF EXISTS `categories`;
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
	`mail` varchar(45) DEFAULT NULL,
	`password` varchar(45) DEFAULT NULL,
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

