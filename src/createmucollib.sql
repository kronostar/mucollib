SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP DATABASE IF EXISTS `mucollib`;
CREATE DATABASE IF NOT EXISTS `mucollib`;

-- -----------------------------------------------------
-- Table `mucollib`.`Artist`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Artist` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(250) NOT NULL ,
  `Sort` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `Sort` (`Sort` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The artist table, used by many others';


-- -----------------------------------------------------
-- Table `mucollib`.`Format`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Format` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The Media on which the recording is contained';


-- -----------------------------------------------------
-- Table `mucollib`.`Genre`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Genre` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The musical style of the recorded work';


-- -----------------------------------------------------
-- Table `mucollib`.`Label`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Label` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The recording label under which an album is released';


-- -----------------------------------------------------
-- Table `mucollib`.`Album`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Album` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(120) NOT NULL ,
  `Year` YEAR NOT NULL ,
  `CatNo` VARCHAR(20) NULL ,
  `OrigYear` YEAR NULL ,
  `OrigCatNo` VARCHAR(20) NULL ,
  `Artist_id` INT NOT NULL ,
  `Format_id` INT NOT NULL ,
  `Genre_id` INT NOT NULL ,
  `Label_id` INT NOT NULL ,
  `Label_id_Orig` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Album_Artist` (`Artist_id` ASC) ,
  INDEX `fk_Album_Format` (`Format_id` ASC) ,
  INDEX `fk_Album_Genre` (`Genre_id` ASC) ,
  INDEX `fk_Album_Label1` (`Label_id` ASC) ,
  INDEX `fk_Album_Label2` (`Label_id_Orig` ASC) ,
  CONSTRAINT `fk_Album_Artist`
    FOREIGN KEY (`Artist_id` )
    REFERENCES `mucollib`.`Artist` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Album_Format`
    FOREIGN KEY (`Format_id` )
    REFERENCES `mucollib`.`Format` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Album_Genre`
    FOREIGN KEY (`Genre_id` )
    REFERENCES `mucollib`.`Genre` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Album_Label1`
    FOREIGN KEY (`Label_id` )
    REFERENCES `mucollib`.`Label` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Album_Label2`
    FOREIGN KEY (`Label_id_Orig` )
    REFERENCES `mucollib`.`Label` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'A collection of recorded works by an artist';


-- -----------------------------------------------------
-- Table `mucollib`.`Instrument`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Instrument` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'An instrument identifier';


-- -----------------------------------------------------
-- Table `mucollib`.`Musician`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Musician` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Artist_id` INT NOT NULL ,
  `Instrument_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Musician_Artist` (`Artist_id` ASC) ,
  INDEX `fk_Musician_Instrument` (`Instrument_id` ASC) ,
  CONSTRAINT `fk_Musician_Artist`
    FOREIGN KEY (`Artist_id` )
    REFERENCES `mucollib`.`Artist` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Musician_Instrument`
    FOREIGN KEY (`Instrument_id` )
    REFERENCES `mucollib`.`Instrument` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'Links an artist to an instrument';


-- -----------------------------------------------------
-- Table `mucollib`.`MusicianStatus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`MusicianStatus` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The status a musician occupies on a recording';


-- -----------------------------------------------------
-- Table `mucollib`.`AlbumMusician`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`AlbumMusician` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Musician_id` INT NOT NULL ,
  `Album_id` INT NOT NULL ,
  `MusicianStatus_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_AlbumMusician_Musician` (`Musician_id` ASC) ,
  INDEX `fk_AlbumMusician_Album` (`Album_id` ASC) ,
  INDEX `fk_AlbumMusician_MusicianStatus` (`MusicianStatus_id` ASC) ,
  CONSTRAINT `fk_AlbumMusician_Musician`
    FOREIGN KEY (`Musician_id` )
    REFERENCES `mucollib`.`Musician` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AlbumMusician_Album`
    FOREIGN KEY (`Album_id` )
    REFERENCES `mucollib`.`Album` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AlbumMusician_MusicianStatus`
    FOREIGN KEY (`MusicianStatus_id` )
    REFERENCES `mucollib`.`MusicianStatus` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'Links a musician to an album';


-- -----------------------------------------------------
-- Table `mucollib`.`Song`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Song` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(120) NOT NULL ,
  `Length` TIME NULL ,
  `Number` INT NOT NULL ,
  `Album_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Song_Album` (`Album_id` ASC) ,
  CONSTRAINT `fk_Song_Album`
    FOREIGN KEY (`Album_id` )
    REFERENCES `mucollib`.`Album` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'Identifies a song, linking it to a particular album.';


-- -----------------------------------------------------
-- Table `mucollib`.`SongComposer`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`SongComposer` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Artist_id` INT NOT NULL ,
  `Song_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_SongComposer_Artist` (`Artist_id` ASC) ,
  INDEX `fk_SongComposer_Song` (`Song_id` ASC) ,
  CONSTRAINT `fk_SongComposer_Artist`
    FOREIGN KEY (`Artist_id` )
    REFERENCES `mucollib`.`Artist` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SongComposer_Song`
    FOREIGN KEY (`Song_id` )
    REFERENCES `mucollib`.`Song` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'Links an artist to a song as the composer';


-- -----------------------------------------------------
-- Table `mucollib`.`SongMusician`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`SongMusician` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Musician_id` INT NOT NULL ,
  `Song_id` INT NOT NULL ,
  `MusicianStatus_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_SongMusician_Musician` (`Musician_id` ASC) ,
  INDEX `fk_SongMusician_Song` (`Song_id` ASC) ,
  INDEX `fk_SongMusician_MusicianStatus` (`MusicianStatus_id` ASC) ,
  CONSTRAINT `fk_SongMusician_Musician`
    FOREIGN KEY (`Musician_id` )
    REFERENCES `mucollib`.`Musician` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SongMusician_Song`
    FOREIGN KEY (`Song_id` )
    REFERENCES `mucollib`.`Song` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SongMusician_MusicianStatus`
    FOREIGN KEY (`MusicianStatus_id` )
    REFERENCES `mucollib`.`MusicianStatus` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'Links a musician to a song recording ';


-- -----------------------------------------------------
-- Table `mucollib`.`SongSection`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`SongSection` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Ref` VARCHAR(10) NOT NULL ,
  `Name` VARCHAR(120) NOT NULL ,
  `Song_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_SongSection_Song` (`Song_id` ASC) ,
  CONSTRAINT `fk_SongSection_Song`
    FOREIGN KEY (`Song_id` )
    REFERENCES `mucollib`.`Song` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'Allows the extension of a song by sections or movements';

CREATE USER `mucollib`@localhost IDENTIFIED BY 'mucollib';
GRANT ALL PRIVILEGES ON mucollib.* TO 'mucollib'@localhost IDENTIFIED BY 'mucollib';
FLUSH PRIVILEGES;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
