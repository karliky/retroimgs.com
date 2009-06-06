#Rifalia sql generated on: 2009-06-06 21:06:37 : 1244317297

DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `emails`;
DROP TABLE IF EXISTS `enums`;
DROP TABLE IF EXISTS `media`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `payment_gateways`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `providers`;
DROP TABLE IF EXISTS `raffles`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `tickets`;
DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `categories` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) DEFAULT NULL,
	`description` text DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

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

CREATE TABLE `media` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`model` varchar(30) NOT NULL,
	`foreign_key` int(11) NOT NULL,
	`filename` varchar(255) DEFAULT NULL,
	`ext` varchar(6) DEFAULT 'gif' NOT NULL,
	`dir` varchar(255) DEFAULT NULL,
	`mimetype` varchar(30) DEFAULT NULL,
	`filesize` int(11) DEFAULT NULL,
	`height` int(4) DEFAULT NULL,
	`width` int(4) DEFAULT NULL,
	`description` varchar(100) NOT NULL,
	`checksum` varchar(32) DEFAULT NULL,
	`thumb` tinyint(1) DEFAULT 0 NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idxfk_foreign (`model`, `foreign_key`));

CREATE TABLE `orders` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`amount` float NOT NULL,
	`transaction_id` int(11) NOT NULL,
	`ticket_id` int(11) DEFAULT NULL,
	`description` varchar(255) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_orders_user_id (`user_id`),
	KEY idx_orders_transaction_id (`transaction_id`),
	KEY idx_orders_ticket_id (`ticket_id`));

CREATE TABLE `payment_gateways` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) DEFAULT NULL,
	`updated` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`provider_id` int(11) DEFAULT NULL,
	`commission` float DEFAULT NULL,
	`category_id` int(11) NOT NULL,
	`raffle_id` int(11) DEFAULT NULL,
	`name` varchar(255) DEFAULT NULL,
	`short_description` varchar(255) DEFAULT NULL,
	`description` text DEFAULT NULL,
	`price` float DEFAULT NULL,
	`video_url` varchar(255) DEFAULT NULL,
	`is_on_raffle` tinyint(1) DEFAULT 0 NOT NULL,
	`is_approved` tinyint(1) DEFAULT 0 NOT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_products_provider_id (`provider_id`),
	KEY idx_products_category_id (`category_id`),
	KEY idx_products_raffle_id (`raffle_id`),
	KEY idx_products_is_on_raffle (`is_on_raffle`),
	KEY idx_products_is_approved (`is_approved`));

CREATE TABLE `providers` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) DEFAULT NULL,
	`contact_person` varchar(255) DEFAULT NULL,
	`email` varchar(255) DEFAULT NULL,
	`phone` varchar(255) DEFAULT NULL,
	`balance` float DEFAULT NULL,
	`default_commission` int(11) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `raffles` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`available_tickets` varchar(255) DEFAULT NULL,
	`ticket_price` varchar(255) DEFAULT NULL,
	`sold_tickets` varchar(255) DEFAULT NULL,
	`closes` datetime DEFAULT NULL,
	`parent_id` int(11) DEFAULT NULL,
	`is_published` tinyint(1) DEFAULT 0 NOT NULL,
	`published` datetime DEFAULT NULL,
	`is_assigned` tinyint(1) DEFAULT 0 NOT NULL,
	`assigned` datetime DEFAULT NULL,
	`winner_id` int(11) DEFAULT NULL,
	`winner_code` varchar(255) DEFAULT NULL,
	`is_cancelled` tinyint(1) DEFAULT 0 NOT NULL,
	`cancelled` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_raffles_parent_id (`parent_id`),
	KEY idx_raffles_is_published (`is_published`),
	KEY idx_raffles_is_assigned (`is_assigned`),
	KEY idx_raffles_winner_id (`winner_id`),
	KEY idx_raffles_is_cancelled (`is_cancelled`));

CREATE TABLE `settings` (
	`id` varchar(255) NOT NULL,
	`value` varchar(255) DEFAULT NULL,
	`type` varchar(30) DEFAULT 'string' NOT NULL,
	`description` varchar(255) DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `tickets` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`code` varchar(255) DEFAULT NULL,
	`user_id` int(11) DEFAULT NULL,
	`raffle_id` int(11) DEFAULT NULL,
	`transaction_id` int(11) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_tickets_raffle_id (`raffle_id`),
	KEY idx_tickets_transaction_id (`transaction_id`));

CREATE TABLE `transactions` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`payment_gateway_id` int(11) DEFAULT NULL,
	`user_id` int(11) DEFAULT NULL,
	`transaction_type` varchar(255) DEFAULT NULL,
	`description` text DEFAULT NULL,
	`amount` int(11) NOT NULL,
	`connection_details` text DEFAULT NULL,
	`authorisation_code` varchar(255) DEFAULT NULL,
	`payment_requested` datetime DEFAULT NULL,
	`payment_response` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_transactions_payment_gateway_id (`payment_gateway_id`),
	KEY idx_transactions_user_id (`user_id`));

CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`login` varchar(40) NOT NULL,
	`email` varchar(50) NOT NULL,
	`password` varchar(40) NOT NULL,
	`address` varchar(255) DEFAULT NULL,
	`phone` varchar(255) DEFAULT NULL,
	`balance` float DEFAULT NULL,
	`is_admin` tinyint(1) DEFAULT 1,
	`is_enabled` tinyint(1) DEFAULT 1,
	`is_email_verified` tinyint(1) DEFAULT 1,
	`updated` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_users_login (`login`),
	KEY idx_users_email (`email`));

