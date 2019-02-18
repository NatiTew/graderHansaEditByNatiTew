SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `um` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `um` ;

-- -----------------------------------------------------
-- Table `um`.`gender`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `um`.`gender` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `um`.`title`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `um`.`title` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `gender_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_title_gender1` (`gender_id` ASC) ,
  CONSTRAINT `fk_title_gender1`
    FOREIGN KEY (`gender_id` )
    REFERENCES `um`.`gender` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `um`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `um`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NULL ,
  `password` VARCHAR(255) NULL ,
  `name` VARCHAR(100) NULL ,
  `surname` VARCHAR(100) NULL ,
  `email` VARCHAR(255) NULL ,
  `gender_id` INT NOT NULL ,
  `title_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  INDEX `fk_users_gender1` (`gender_id` ASC) ,
  INDEX `fk_users_title1` (`title_id` ASC) ,
  CONSTRAINT `fk_users_gender1`
    FOREIGN KEY (`gender_id` )
    REFERENCES `um`.`gender` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_title1`
    FOREIGN KEY (`title_id` )
    REFERENCES `um`.`title` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
