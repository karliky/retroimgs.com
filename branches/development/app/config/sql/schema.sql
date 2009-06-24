#Rifalia sql generated on: 2009-06-23 14:06:36 : 1245760056

DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `emails`;
DROP TABLE IF EXISTS `enums`;
DROP TABLE IF EXISTS `media`;
DROP TABLE IF EXISTS `media_links`;
DROP TABLE IF EXISTS `memberships`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `organizations`;
DROP TABLE IF EXISTS `prizes`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `raffles`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `signups`;
DROP TABLE IF EXISTS `tickets`;
DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `categories` (
	`id` varchar(36) NOT NULL,
	`parent_id` varchar(36) DEFAULT NULL,
	`lft` int(11) DEFAULT NULL,
	`rght` int(11) DEFAULT NULL,
	`name` varchar(255) DEFAULT NULL,
	`description` text DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `emails` (
	`id` varchar(36) NOT NULL,
	`from_user_id` varchar(36) DEFAULT NULL,
	`to_user_id` varchar(36) DEFAULT NULL,
	`chain_id` varchar(36) DEFAULT NULL,
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
	`id` varchar(36) NOT NULL,
	`type` varchar(30) NOT NULL,
	`order` int(2) DEFAULT NULL,
	`display` varchar(255) DEFAULT NULL,
	`value` varchar(50) NOT NULL,
	`description` text NOT NULL,
	`default` tinyint(1) DEFAULT 0 NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `media` (
	`id` varchar(36) NOT NULL,
	`user_id` varchar(36) NOT NULL,
	`filename` varchar(255) DEFAULT NULL,
	`ext` varchar(6) DEFAULT 'gif' NOT NULL,
	`dir` varchar(255) DEFAULT NULL,
	`mimetype` varchar(30) DEFAULT NULL,
	`filesize` int(11) DEFAULT NULL,
	`height` int(4) DEFAULT NULL,
	`width` int(4) DEFAULT NULL,
	`description` varchar(100) NOT NULL,
	`checksum` varchar(36) DEFAULT NULL,
	`thumb` tinyint(1) DEFAULT 0 NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `media_links` (
	`id` varchar(36) NOT NULL,
	`media_id` varchar(36) NOT NULL,
	`model` varchar(50) NOT NULL,
	`foreign_key` varchar(36) NOT NULL,
	`active` tinyint(1) DEFAULT 1 NOT NULL,
	`main` tinyint(1) DEFAULT 0 NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idxfk_foreign (`model`, `foreign_key`, `main`));

CREATE TABLE `memberships` (
	`id` varchar(36) NOT NULL,
	`user_id` varchar(36) NOT NULL,
	`organization_id` varchar(36) NOT NULL,
	`is_admin` tinyint(1) DEFAULT 0,
	`admin_priority` int(2) DEFAULT 1 NOT NULL,
	`is_contact` tinyint(1) DEFAULT 0 NOT NULL,
	`contact_priority` int(2) DEFAULT 1 NOT NULL,
	`updated` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `orders` (
	`id` varchar(36) NOT NULL,
	`organization_id` varchar(36) NOT NULL,
	`user_id` varchar(36) NOT NULL,
	`ticket_id` varchar(36) DEFAULT NULL,
	`amount` float NOT NULL,
	`description` varchar(255) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_orders_user_id (`user_id`),
	KEY idx_orders_ticket_id (`ticket_id`));

CREATE TABLE `organizations` (
	`id` varchar(36) NOT NULL,
	`type` varchar(20) DEFAULT 'Provider' NOT NULL,
	`name` varchar(255) DEFAULT NULL,
	`domain` varchar(255) NOT NULL,
	`is_main_site` tinyint(1) DEFAULT 0 NOT NULL,
	`default_commission` int(11) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `prizes` (
	`id` varchar(36) NOT NULL,
	`organization_id` varchar(36) NOT NULL,
	`category_id` int(11) NOT NULL,
	`provider_id` varchar(36) DEFAULT NULL,
	`product_id` varchar(36) NOT NULL,
	`raffle_id` varchar(36) NOT NULL,
	`winning_ticket_id` varchar(36) DEFAULT NULL,
	`position` int(2) DEFAULT 1 NOT NULL,
	`commission` float DEFAULT NULL,
	`name` varchar(255) DEFAULT NULL,
	`slug` varchar(150) DEFAULT NULL,
	`short_description` varchar(255) DEFAULT NULL,
	`description` text DEFAULT NULL,
	`price` float DEFAULT NULL,
	`video_url` varchar(255) DEFAULT NULL,
	`is_on_raffle` tinyint(1) DEFAULT 0 NOT NULL,
	`is_approved` tinyint(1) DEFAULT 0 NOT NULL,
	`created` datetime DEFAULT NULL,
	`created_by` varchar(36) DEFAULT NULL,
	`created_by_ip` int(1) DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	`modified_by` varchar(36) DEFAULT NULL,
	`modified_by_ip` varchar(36) DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_prizes_provider_id (`provider_id`),
	KEY idx_prizes_category_id (`category_id`),
	KEY idx_prizes_product_id (`product_id`));

CREATE TABLE `products` (
	`id` varchar(36) NOT NULL,
	`organization_id` varchar(36) NOT NULL,
	`category_id` varchar(36) NOT NULL,
	`commission` float DEFAULT NULL,
	`name` varchar(255) DEFAULT NULL,
	`slug` varchar(150) DEFAULT NULL,
	`short_description` varchar(255) DEFAULT NULL,
	`description` text DEFAULT NULL,
	`price` float DEFAULT NULL,
	`video_url` varchar(255) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_products_category_id (`category_id`));

CREATE TABLE `raffles` (
	`id` varchar(36) NOT NULL,
	`parent_id` varchar(36) DEFAULT NULL,
	`organization_id` varchar(36) NOT NULL,
	`available_tickets` varchar(255) DEFAULT NULL,
	`ticket_price` varchar(255) DEFAULT NULL,
	`sold_tickets` varchar(255) DEFAULT NULL,
	`closes` datetime DEFAULT NULL,
	`is_published` tinyint(1) DEFAULT 0 NOT NULL,
	`published` datetime DEFAULT NULL,
	`is_assigned` tinyint(1) DEFAULT 0 NOT NULL,
	`assigned` datetime DEFAULT NULL,
	`is_cancelled` tinyint(1) DEFAULT 0 NOT NULL,
	`cancelled` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_raffles_parent_id (`parent_id`),
	KEY idx_raffles_is_published (`is_published`),
	KEY idx_raffles_is_assigned (`is_assigned`),
	KEY idx_raffles_is_cancelled (`is_cancelled`));

CREATE TABLE `settings` (
	`id` varchar(255) NOT NULL,
	`organization_id` varchar(36) NOT NULL,
	`value` varchar(255) DEFAULT NULL,
	`type` varchar(30) DEFAULT 'string' NOT NULL,
	`description` varchar(255) DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `signups` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`email` varchar(50) NOT NULL,
	`updated` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_users_email (`email`));

CREATE TABLE `tickets` (
	`id` varchar(36) NOT NULL,
	`organization_id` varchar(36) NOT NULL,
	`raffle_id` varchar(36) NOT NULL,
	`user_id` varchar(36) DEFAULT NULL,
	`transaction_id` varchar(36) DEFAULT NULL,
	`number` int(11) NOT NULL,
	`status` int(2) DEFAULT 1 NOT NULL,
	`random` int(11) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_tickets_raffle_id (`raffle_id`),
	KEY idx_tickets_transaction_id (`transaction_id`),
	KEY idx_random (`random`, `raffle_id`, `user_id`));

CREATE TABLE `transactions` (
	`id` varchar(36) NOT NULL,
	`organization_id` varchar(36) NOT NULL,
	`user_id` varchar(36) NOT NULL,
	`payment_gateway` varchar(20) DEFAULT NULL,
	`transaction_type` varchar(255) DEFAULT NULL,
	`description` text DEFAULT NULL,
	`amount` int(11) NOT NULL,
	`connection_details` text DEFAULT NULL,
	`authorisation_code` varchar(255) DEFAULT NULL,
	`payment_requested` datetime DEFAULT NULL,
	`payment_response` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_transactions_user_id (`user_id`));

CREATE TABLE `users` (
	`id` varchar(36) NOT NULL,
	`username` varchar(40) NOT NULL,
	`email` varchar(50) NOT NULL,
	`password` varchar(40) NOT NULL,
	`address` varchar(255) DEFAULT NULL,
	`phone` varchar(255) DEFAULT NULL,
	`balance` float DEFAULT NULL,
	`is_virtual` tinyint(1) DEFAULT 0 NOT NULL,
	`is_enabled` tinyint(1) DEFAULT 0,
	`is_email_verified` tinyint(1) DEFAULT 0,
	`updated` datetime DEFAULT NULL,
	`created` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY idx_users_login (`username`),
	KEY idx_users_email (`email`));

