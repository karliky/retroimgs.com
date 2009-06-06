SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



-- -----------------------------------------------------

-- Table `users`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `users` ;



SHOW WARNINGS;

CREATE  TABLE IF NOT EXISTS `users` (

  `id` INT NOT NULL ,

  `mail` VARCHAR(45) NULL ,

  `pass` VARCHAR(45) NULL ,

  `created` DATETIME NULL ,

  `modified` DATETIME NULL ,

  PRIMARY KEY (`id`) )

ENGINE = MyISAM

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



SHOW WARNINGS;



-- -----------------------------------------------------

-- Table `categories`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `categories` ;



SHOW WARNINGS;

CREATE  TABLE IF NOT EXISTS `categories` (

  `id` INT NOT NULL ,

  `name` VARCHAR(45) NULL ,

  `descriptiion` VARCHAR(45) NULL ,

  `created` DATETIME NULL ,

  `modified` DATETIME NULL ,

  PRIMARY KEY (`id`) )

ENGINE = MyISAM

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



SHOW WARNINGS;



-- -----------------------------------------------------

-- Table `raffles`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `raffles` ;



SHOW WARNINGS;

CREATE  TABLE IF NOT EXISTS `raffles` (

  `id` INT NOT NULL ,

  `expirated_date` DATE NULL ,

  `tickets_number` INT NULL ,

  `tickets_price` FLOAT NULL ,

  `tickets_bought` INT NULL ,

  `last_ticket_date` DATE NULL ,

  `status` BOOLEAN NULL ,

  `created` DATETIME NULL ,

  `modified` DATETIME NULL ,

  PRIMARY KEY (`id`) )

ENGINE = MyISAM

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



SHOW WARNINGS;



-- -----------------------------------------------------

-- Table `products`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `products` ;



SHOW WARNINGS;

CREATE  TABLE IF NOT EXISTS `products` (

  `id` INT NOT NULL ,

  `tittle` VARCHAR(45) NULL ,

  `short_description` VARCHAR(45) NULL ,

  `long_description` VARCHAR(45) NULL ,

  `lat` FLOAT NULL ,

  `long` FLOAT NULL ,

  `zoom` INT NULL ,

  `price` FLOAT NULL ,

  `order` INT NULL ,

  `video` VARCHAR(45) NULL ,

  `video_type` VARCHAR(45) NULL ,

  `image` VARCHAR(45) NULL ,

  `acept` VARCHAR(45) NULL ,

  `acepted_date` DATE NULL ,

  `created` DATETIME NULL ,

  `modified` DATETIME NULL ,

  `categories_id` INT NULL ,

  `raffles_id` INT NULL ,

  PRIMARY KEY (`id`) ,

  CONSTRAINT `fk_products_categories`

    FOREIGN KEY (`categories_id` )

    REFERENCES `categories` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_products_raffles`

    FOREIGN KEY (`raffles_id` )

    REFERENCES `raffles` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = MyISAM

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



SHOW WARNINGS;

CREATE INDEX `fk_products_categories` ON `products` (`categories_id` ASC) ;



SHOW WARNINGS;

CREATE INDEX `fk_products_raffles` ON `products` (`raffles_id` ASC) ;



SHOW WARNINGS;



-- -----------------------------------------------------

-- Table `tickets`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `tickets` ;



SHOW WARNINGS;

CREATE  TABLE IF NOT EXISTS `tickets` (

  `id` INT NOT NULL ,

  `ticket_number` INT NULL ,

  `reserved` BOOLEAN NULL ,

  `created` DATETIME NULL ,

  `modified` DATETIME NULL ,

  `raffles_id` INT NULL ,

  PRIMARY KEY (`id`) ,

  CONSTRAINT `fk_tickets_raffles`

    FOREIGN KEY (`raffles_id` )

    REFERENCES `raffles` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = MyISAM

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



SHOW WARNINGS;

CREATE INDEX `fk_tickets_raffles` ON `tickets` (`raffles_id` ASC) ;



SHOW WARNINGS;



-- -----------------------------------------------------

-- Table `users_has_tickets`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `users_has_tickets` ;



SHOW WARNINGS;

CREATE  TABLE IF NOT EXISTS `users_has_tickets` (

  `users_id` INT NOT NULL ,

  `tickets_id` INT NOT NULL ,

  `created` DATETIME NULL ,

  `modified` DATETIME NULL ,

  PRIMARY KEY (`users_id`, `tickets_id`) ,

  CONSTRAINT `fk_users_has_tickets_users`

    FOREIGN KEY (`users_id` )

    REFERENCES `users` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_users_has_tickets_tickets`

    FOREIGN KEY (`tickets_id` )

    REFERENCES `tickets` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = MyISAM

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



SHOW WARNINGS;

CREATE INDEX `fk_users_has_tickets_users` ON `users_has_tickets` (`users_id` ASC) ;



SHOW WARNINGS;

CREATE INDEX `fk_users_has_tickets_tickets` ON `users_has_tickets` (`tickets_id` ASC) ;



SHOW WARNINGS;



-- -----------------------------------------------------

-- Table `users_has_products`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `users_has_products` ;



SHOW WARNINGS;

CREATE  TABLE IF NOT EXISTS `users_has_products` (

  `users_id` INT NOT NULL ,

  `products_id` INT NOT NULL ,

  `created` DATETIME NULL ,

  `modified` DATETIME NULL ,

  PRIMARY KEY (`users_id`, `products_id`) ,

  CONSTRAINT `fk_users_has_products_users`

    FOREIGN KEY (`users_id` )

    REFERENCES `users` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_users_has_products_products`

    FOREIGN KEY (`products_id` )

    REFERENCES `products` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = MyISAM

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



SHOW WARNINGS;

CREATE INDEX `fk_users_has_products_users` ON `users_has_products` (`users_id` ASC) ;



SHOW WARNINGS;

CREATE INDEX `fk_users_has_products_products` ON `users_has_products` (`products_id` ASC) ;



SHOW WARNINGS;



-- -----------------------------------------------------

-- Table `users_description`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `users_description` ;



SHOW WARNINGS;

CREATE  TABLE IF NOT EXISTS `users_description` (

  `id` INT NOT NULL ,

  `users_id` INT NULL ,

  `address` VARCHAR(45) NULL ,

  `telephone` VARCHAR(45) NULL ,

  `cash` FLOAT NULL ,

  `created` DATETIME NULL ,

  `modified` DATETIME NULL ,

  PRIMARY KEY (`id`) ,

  CONSTRAINT `fk_users_description_users`

    FOREIGN KEY (`users_id` )

    REFERENCES `users` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = MyISAM

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



SHOW WARNINGS;

CREATE INDEX `fk_users_description_users` ON `users_description` (`users_id` ASC) ;



SHOW WARNINGS;





SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;