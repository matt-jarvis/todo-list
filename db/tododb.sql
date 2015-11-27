-- MySQL Script generated by MySQL Workbench
-- Tue Nov 17 15:13:53 2015
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tododb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `tododb` ;

-- -----------------------------------------------------
-- Schema tododb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tododb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `tododb` ;

-- -----------------------------------------------------
-- Table `tododb`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tododb`.`user` ;

CREATE TABLE IF NOT EXISTS `tododb`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL UNIQUE,
  `password` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `dob` DATE NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tododb`.`todo_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tododb`.`item` ;

CREATE TABLE IF NOT EXISTS `tododb`.`item` (
  `item_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `description` VARCHAR(100) NULL,
  `datetime_created` DATETIME NOT NULL,
  `datetime_last_updated` DATETIME NULL,
  `datetime_completed` DATETIME NULL,
  PRIMARY KEY (`item_id`, `user_id`),
  INDEX `fk_todo_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_item_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `tododb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- Triggers for item datetime created/update fields
-- -----------------------------------------------------
CREATE TRIGGER `item_datetime_created` BEFORE INSERT ON  `item` 
FOR EACH ROW SET NEW.datetime_created = NOW();

CREATE TRIGGER `item_datetime_last_updated` BEFORE UPDATE ON  `item` 
FOR EACH ROW SET NEW.datetime_last_updated = NOW();


-- -----------------------------------------------------
-- Insert and Update statements for testing
-- -----------------------------------------------------

INSERT INTO `tododb`.`user` 
VALUES (NULL, 'demo', 'demo', 'Demon', 'Stration', NOW());

-- This value is saved so we can insert items with it next
SET @user = LAST_INSERT_ID();

INSERT INTO `tododb`.`item` (`user_id`, `title`, `description`)
VALUES (@user, 'This is a title', 'This is a description'), 
(@user, 'This is another title', 'This is another description');

INSERT INTO `tododb`.`user` 
VALUES (NULL, 'matt', 'pass', 'Matthew', 'Jarvis', '1991-07-13');

-- This value is saved so we can update it later
SET @user = LAST_INSERT_ID();

INSERT INTO `tododb`.`item` (`user_id`, `title`, `description`)
VALUES (@user, 'Shopping', 'Milk, bread');

-- This value is also saved so we can update it later
SET @item = LAST_INSERT_ID();

INSERT INTO `tododb`.`item` (`user_id`, `title`, `description`)
VALUES (@user, 'PHP to-do list', 'To showcase MySQL (PHP, HTML, CSS etc.)'),
(@user, 'Interview prep', 'Geoban/Santader on 19th Nov');

-- Sleep for 3 seconds before update
DO SLEEP(3);

UPDATE `tododb`.`item` 
SET `description`= 'Milk, bread and cheese'
WHERE `item_id` = @item AND `user_id` = @user;
