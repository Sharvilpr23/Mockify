-- MySQL Script generated by MySQL Workbench
-- Sun 22 Nov 2020 03:15:47 PM CST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Mockify
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Mockify` ;

-- -----------------------------------------------------
-- Schema Mockify
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Mockify` ;
USE `Mockify` ;

-- -----------------------------------------------------
-- Table `Mockify`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mockify`.`User` ;

CREATE TABLE IF NOT EXISTS `Mockify`.`User` (
  `userid` INT NOT NULL,
  `username` VARCHAR(16) NULL,
  PRIMARY KEY (`userid`));


-- -----------------------------------------------------
-- Table `Mockify`.`Album`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mockify`.`Album` ;

CREATE TABLE IF NOT EXISTS `Mockify`.`Album` (
  `albumid` INT NOT NULL,
  `albumname` VARCHAR(45) NULL,
  `genre` VARCHAR(45) NULL,
  `releasedate` VARCHAR(45) NULL,
  PRIMARY KEY (`albumid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = armscii8;


-- -----------------------------------------------------
-- Table `Mockify`.`Song`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mockify`.`Song` ;

CREATE TABLE IF NOT EXISTS `Mockify`.`Song` (
  `songid` INT NOT NULL,
  `songname` VARCHAR(45) NULL,
  `duration` DECIMAL(4,2) NULL,
  `listencount` INT NULL,
  `albumid` INT NOT NULL,
  PRIMARY KEY (`songid`),
  INDEX `fk_Song_Album1_idx` (`albumid` ASC) VISIBLE,
  CONSTRAINT `fk_Song_Album1`
    FOREIGN KEY (`albumid`)
    REFERENCES `Mockify`.`Album` (`albumid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mockify`.`Artist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mockify`.`Artist` ;

CREATE TABLE IF NOT EXISTS `Mockify`.`Artist` (
  `artistid` INT NOT NULL,
  `artistname` VARCHAR(45) NULL,
  PRIMARY KEY (`artistid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mockify`.`Playlist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mockify`.`Playlist` ;

CREATE TABLE IF NOT EXISTS `Mockify`.`Playlist` (
  `playlistid` INT NOT NULL,
  `playlistname` VARCHAR(45) NULL,
  `userid` INT NOT NULL,
  PRIMARY KEY (`playlistid`),
  INDEX `fk_Playlist_User1_idx` (`userid` ASC) VISIBLE,
  CONSTRAINT `fk_Playlist_User1`
    FOREIGN KEY (`userid`)
    REFERENCES `Mockify`.`User` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mockify`.`ArtistAlbum`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mockify`.`ArtistAlbum` ;

CREATE TABLE IF NOT EXISTS `Mockify`.`ArtistAlbum` (
  `artistid` INT NOT NULL,
  `albumid` INT NOT NULL,
  PRIMARY KEY (`artistid`, `albumid`),
  INDEX `fk_Artist_has_Album_Album1_idx` (`albumid` ASC) VISIBLE,
  INDEX `fk_Artist_has_Album_Artist1_idx` (`artistid` ASC) VISIBLE,
  CONSTRAINT `fk_Artist_has_Album_Artist1`
    FOREIGN KEY (`artistid`)
    REFERENCES `Mockify`.`Artist` (`artistid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Artist_has_Album_Album1`
    FOREIGN KEY (`albumid`)
    REFERENCES `Mockify`.`Album` (`albumid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mockify`.`PlaylistSong`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mockify`.`PlaylistSong` ;

CREATE TABLE IF NOT EXISTS `Mockify`.`PlaylistSong` (
  `playlistid` INT NOT NULL,
  `songid` INT NOT NULL,
  PRIMARY KEY (`playlistid`, `songid`),
  INDEX `fk_Playlist_has_Song_Song1_idx` (`songid` ASC) VISIBLE,
  INDEX `fk_Playlist_has_Song_Playlist1_idx` (`playlistid` ASC) VISIBLE,
  CONSTRAINT `fk_Playlist_has_Song_Playlist1`
    FOREIGN KEY (`playlistid`)
    REFERENCES `Mockify`.`Playlist` (`playlistid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Playlist_has_Song_Song1`
    FOREIGN KEY (`songid`)
    REFERENCES `Mockify`.`Song` (`songid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mockify`.`Follower`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mockify`.`Follower` ;

CREATE TABLE IF NOT EXISTS `Mockify`.`Follower` (
  `userid` INT NOT NULL,
  `artistid` INT NOT NULL,
  PRIMARY KEY (`userid`, `artistid`),
  INDEX `fk_User_has_Artist_Artist1_idx` (`artistid` ASC) VISIBLE,
  INDEX `fk_User_has_Artist_User1_idx` (`userid` ASC) VISIBLE,
  CONSTRAINT `fk_User_has_Artist_User1`
    FOREIGN KEY (`userid`)
    REFERENCES `Mockify`.`User` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Artist_Artist1`
    FOREIGN KEY (`artistid`)
    REFERENCES `Mockify`.`Artist` (`artistid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
