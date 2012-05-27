SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP DATABASE IF EXISTS `mucollib`;
CREATE DATABASE IF NOT EXISTS `mucollib`;

-- -----------------------------------------------------
-- Table `mucollib`.`Artist`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Artist` (
  `idArtist` INT NOT NULL AUTO_INCREMENT ,
  `ArtistName` VARCHAR(250) NOT NULL ,
  `ArtistSort` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`idArtist`) ,
  INDEX `ArtistSort` (`ArtistSort` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The artist table, used by many others';


-- -----------------------------------------------------
-- Table `mucollib`.`Format`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Format` (
  `idFormat` INT NOT NULL AUTO_INCREMENT ,
  `FormatName` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`idFormat`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The Media on which the recording is contained';


-- -----------------------------------------------------
-- Table `mucollib`.`Genre`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Genre` (
  `idGenre` INT NOT NULL AUTO_INCREMENT ,
  `GenreName` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idGenre`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The musical style of the recorded work';


-- -----------------------------------------------------
-- Table `mucollib`.`Label`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Label` (
  `idLabel` INT NOT NULL AUTO_INCREMENT ,
  `LabelName` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idLabel`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The recording label under which an album is released';


-- -----------------------------------------------------
-- Table `mucollib`.`Album`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Album` (
  `idAlbum` INT NOT NULL AUTO_INCREMENT ,
  `AlbumName` VARCHAR(120) NOT NULL ,
  `AlbumYear` YEAR NOT NULL ,
  `AlbumCatNo` VARCHAR(20) NULL ,
  `AlbumOrigYear` YEAR NULL ,
  `AlbumOrigCatNo` VARCHAR(20) NULL ,
  `Artist_idArtist` INT NOT NULL ,
  `Format_idFormat` INT NOT NULL ,
  `Genre_idGenre` INT NOT NULL ,
  `Label_idLabel` INT NOT NULL ,
  `Label_idLabel_Orig` INT NOT NULL ,
  PRIMARY KEY (`idAlbum`) ,
  INDEX `fk_Album_Artist` (`Artist_idArtist` ASC) ,
  INDEX `fk_Album_Format1` (`Format_idFormat` ASC) ,
  INDEX `fk_Album_Genre1` (`Genre_idGenre` ASC) ,
  INDEX `fk_Album_Label1` (`Label_idLabel` ASC) ,
  INDEX `fk_Album_Label2` (`Label_idLabel_Orig` ASC) ,
  CONSTRAINT `fk_Album_Artist`
    FOREIGN KEY (`Artist_idArtist` )
    REFERENCES `mucollib`.`Artist` (`idArtist` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Album_Format1`
    FOREIGN KEY (`Format_idFormat` )
    REFERENCES `mucollib`.`Format` (`idFormat` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Album_Genre1`
    FOREIGN KEY (`Genre_idGenre` )
    REFERENCES `mucollib`.`Genre` (`idGenre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Album_Label1`
    FOREIGN KEY (`Label_idLabel` )
    REFERENCES `mucollib`.`Label` (`idLabel` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Album_Label2`
    FOREIGN KEY (`Label_idLabel_Orig` )
    REFERENCES `mucollib`.`Label` (`idLabel` )
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
  `idInstrument` INT NOT NULL AUTO_INCREMENT ,
  `InstrumentName` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`idInstrument`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'An instrument identifier';


-- -----------------------------------------------------
-- Table `mucollib`.`Musician`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`Musician` (
  `idMusician` INT NOT NULL AUTO_INCREMENT ,
  `Artist_idArtist` INT NOT NULL ,
  `Instrument_idInstrument` INT NOT NULL ,
  PRIMARY KEY (`idMusician`) ,
  INDEX `fk_Musician_Artist1` (`Artist_idArtist` ASC) ,
  INDEX `fk_Musician_Instrument1` (`Instrument_idInstrument` ASC) ,
  CONSTRAINT `fk_Musician_Artist1`
    FOREIGN KEY (`Artist_idArtist` )
    REFERENCES `mucollib`.`Artist` (`idArtist` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Musician_Instrument1`
    FOREIGN KEY (`Instrument_idInstrument` )
    REFERENCES `mucollib`.`Instrument` (`idInstrument` )
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
  `idMusicianStatus` INT NOT NULL AUTO_INCREMENT ,
  `MusicianStatusName` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`idMusicianStatus`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'The status a musician occupies on a recording';


-- -----------------------------------------------------
-- Table `mucollib`.`AlbumMusician`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mucollib`.`AlbumMusician` (
  `idAlbumMusician` INT NOT NULL AUTO_INCREMENT ,
  `Musician_idMusician` INT NOT NULL ,
  `Album_idAlbum` INT NOT NULL ,
  `MusicianStatus_idMusicianStatus` INT NOT NULL ,
  PRIMARY KEY (`idAlbumMusician`) ,
  INDEX `fk_AlbumMusician_Musician1` (`Musician_idMusician` ASC) ,
  INDEX `fk_AlbumMusician_Album1` (`Album_idAlbum` ASC) ,
  INDEX `fk_AlbumMusician_MusicianStatus1` (`MusicianStatus_idMusicianStatus` ASC) ,
  CONSTRAINT `fk_AlbumMusician_Musician1`
    FOREIGN KEY (`Musician_idMusician` )
    REFERENCES `mucollib`.`Musician` (`idMusician` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AlbumMusician_Album1`
    FOREIGN KEY (`Album_idAlbum` )
    REFERENCES `mucollib`.`Album` (`idAlbum` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AlbumMusician_MusicianStatus1`
    FOREIGN KEY (`MusicianStatus_idMusicianStatus` )
    REFERENCES `mucollib`.`MusicianStatus` (`idMusicianStatus` )
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
  `idSong` INT NOT NULL AUTO_INCREMENT ,
  `SongName` VARCHAR(120) NOT NULL ,
  `SongLength` TIME NULL ,
  `SongNumber` INT NOT NULL ,
  `Album_idAlbum` INT NOT NULL ,
  PRIMARY KEY (`idSong`) ,
  INDEX `fk_Song_Album1` (`Album_idAlbum` ASC) ,
  CONSTRAINT `fk_Song_Album1`
    FOREIGN KEY (`Album_idAlbum` )
    REFERENCES `mucollib`.`Album` (`idAlbum` )
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
  `idSongComposer` INT NOT NULL AUTO_INCREMENT ,
  `Artist_idArtist` INT NOT NULL ,
  `Song_idSong` INT NOT NULL ,
  PRIMARY KEY (`idSongComposer`) ,
  INDEX `fk_SongComposer_Artist1` (`Artist_idArtist` ASC) ,
  INDEX `fk_SongComposer_Song1` (`Song_idSong` ASC) ,
  CONSTRAINT `fk_SongComposer_Artist1`
    FOREIGN KEY (`Artist_idArtist` )
    REFERENCES `mucollib`.`Artist` (`idArtist` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SongComposer_Song1`
    FOREIGN KEY (`Song_idSong` )
    REFERENCES `mucollib`.`Song` (`idSong` )
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
  `idSongMusician` INT NOT NULL AUTO_INCREMENT ,
  `Musician_idMusician` INT NOT NULL ,
  `Song_idSong` INT NOT NULL ,
  `MusicianStatus_idMusicianStatus` INT NOT NULL ,
  PRIMARY KEY (`idSongMusician`) ,
  INDEX `fk_SongMusician_Musician1` (`Musician_idMusician` ASC) ,
  INDEX `fk_SongMusician_Song1` (`Song_idSong` ASC) ,
  INDEX `fk_SongMusician_MusicianStatus1` (`MusicianStatus_idMusicianStatus` ASC) ,
  CONSTRAINT `fk_SongMusician_Musician1`
    FOREIGN KEY (`Musician_idMusician` )
    REFERENCES `mucollib`.`Musician` (`idMusician` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SongMusician_Song1`
    FOREIGN KEY (`Song_idSong` )
    REFERENCES `mucollib`.`Song` (`idSong` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SongMusician_MusicianStatus1`
    FOREIGN KEY (`MusicianStatus_idMusicianStatus` )
    REFERENCES `mucollib`.`MusicianStatus` (`idMusicianStatus` )
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
  `idSongSection` INT NOT NULL AUTO_INCREMENT ,
  `SongSectionRef` VARCHAR(10) NOT NULL ,
  `SongSectionName` VARCHAR(120) NOT NULL ,
  `Song_idSong` INT NOT NULL ,
  PRIMARY KEY (`idSongSection`) ,
  INDEX `fk_SongSection_Song1` (`Song_idSong` ASC) ,
  CONSTRAINT `fk_SongSection_Song1`
    FOREIGN KEY (`Song_idSong` )
    REFERENCES `mucollib`.`Song` (`idSong` )
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
