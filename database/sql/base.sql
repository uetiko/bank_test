-- MySQL Script generated by MySQL Workbench
-- lun 29 abr 2019 19:24:01 CDT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema banco
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `banco` ;

-- -----------------------------------------------------
-- Schema banco
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `banco` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `banco` ;

-- -----------------------------------------------------
-- Table `banco`.`operacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`operacion` ;

CREATE TABLE IF NOT EXISTS `banco`.`operacion` (
  `id` INT NOT NULL,
  `operacion` VARCHAR(25) NOT NULL,
  `descripcion` VARCHAR(140) NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `banco`.`movimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`movimiento` ;

CREATE TABLE IF NOT EXISTS `banco`.`movimiento` (
  `id` INT NOT NULL,
  `monto` FLOAT NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  `operacion_id` INT NOT NULL,
  `detalle` VARCHAR(140) NULL,
  PRIMARY KEY (`id`, `operacion_id`),
  CONSTRAINT `fk_movimiento_operacion`
    FOREIGN KEY (`operacion_id`)
    REFERENCES `banco`.`operacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `fk_movimiento_operacion_idx` ON `banco`.`movimiento` (`operacion_id` ASC);


-- -----------------------------------------------------
-- Table `banco`.`credito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`credito` ;

CREATE TABLE IF NOT EXISTS `banco`.`credito` (
  `idcredito` INT NOT NULL AUTO_INCREMENT,
  `credito` FLOAT NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  PRIMARY KEY (`idcredito`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `banco`.`direccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`direccion` ;

CREATE TABLE IF NOT EXISTS `banco`.`direccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `calle` VARCHAR(80) NOT NULL,
  `numero_exterior` VARCHAR(10) NOT NULL,
  `numero_interior` VARCHAR(10) NULL,
  `codigo_postal` INT NOT NULL,
  `estado` VARCHAR(25) NOT NULL,
  `ciudad` VARCHAR(45) NULL,
  `colonia` VARCHAR(45) NULL,
  `municipio` VARCHAR(45) NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `banco`.`datos_contacto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`datos_contacto` ;

CREATE TABLE IF NOT EXISTS `banco`.`datos_contacto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `correo_electronico` VARCHAR(45) NULL,
  `telefono` INT NULL,
  `celular` INT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `banco`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`usuario` ;

CREATE TABLE IF NOT EXISTS `banco`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(15) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  `direccion_id` INT NOT NULL,
  `datos_contacto_id` INT NOT NULL,
  PRIMARY KEY (`id`, `direccion_id`, `datos_contacto_id`),
  CONSTRAINT `fk_usuario_direccion1`
    FOREIGN KEY (`direccion_id`)
    REFERENCES `banco`.`direccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_datos_contacto1`
    FOREIGN KEY (`datos_contacto_id`)
    REFERENCES `banco`.`datos_contacto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `fk_usuario_direccion1_idx` ON `banco`.`usuario` (`direccion_id` ASC);

CREATE INDEX `fk_usuario_datos_contacto1_idx` ON `banco`.`usuario` (`datos_contacto_id` ASC);

CREATE INDEX `apellidos_index` ON `banco`.`usuario` (`apellido` ASC);


-- -----------------------------------------------------
-- Table `banco`.`debito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`debito` ;

CREATE TABLE IF NOT EXISTS `banco`.`debito` (
  `id` INT NOT NULL,
  `saldo` FLOAT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `banco`.`relacion_typo_cuenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`relacion_typo_cuenta` ;

CREATE TABLE IF NOT EXISTS `banco`.`relacion_typo_cuenta` (
  `id` INT NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  `debito_id` INT NULL,
  `credito_id` INT NULL,
  PRIMARY KEY (`id`, `debito_id`, `credito_id`),
  CONSTRAINT `fk_table1_credito1`
    FOREIGN KEY (`credito_id`)
    REFERENCES `banco`.`credito` (`idcredito`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_debito1`
    FOREIGN KEY (`debito_id`)
    REFERENCES `banco`.`debito` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `fk_table1_credito1_idx` ON `banco`.`relacion_typo_cuenta` (`credito_id` ASC);

CREATE INDEX `fk_table1_debito1_idx` ON `banco`.`relacion_typo_cuenta` (`debito_id` ASC);


-- -----------------------------------------------------
-- Table `banco`.`cuenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`cuenta` ;

CREATE TABLE IF NOT EXISTS `banco`.`cuenta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero_cuenta` DOUBLE NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  `usuario_id` INT NOT NULL,
  `usuario_direccion_id` INT NOT NULL,
  `relacion_typo_cuenta_id` INT NOT NULL,
  `usuario_datos_contacto_id` INT NOT NULL,
  `relacion_typo_cuenta_credito_idcredito` INT NOT NULL,
  `relacion_typo_cuenta_debito_id1` INT NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`, `usuario_direccion_id`, `relacion_typo_cuenta_id`, `usuario_datos_contacto_id`, `relacion_typo_cuenta_credito_idcredito`, `relacion_typo_cuenta_debito_id1`),
  CONSTRAINT `fk_cuenta_usuario1`
    FOREIGN KEY (`usuario_id` , `usuario_direccion_id` , `usuario_datos_contacto_id`)
    REFERENCES `banco`.`usuario` (`id` , `direccion_id` , `datos_contacto_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuenta_relacion_typo_cuenta1`
    FOREIGN KEY (`relacion_typo_cuenta_id` , `relacion_typo_cuenta_credito_idcredito` , `relacion_typo_cuenta_debito_id1`)
    REFERENCES `banco`.`relacion_typo_cuenta` (`id` , `credito_id` , `debito_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE UNIQUE INDEX `numero_cuenta_UNIQUE` ON `banco`.`cuenta` (`numero_cuenta` ASC);

CREATE INDEX `fk_cuenta_usuario1_idx` ON `banco`.`cuenta` (`usuario_id` ASC, `usuario_direccion_id` ASC, `usuario_datos_contacto_id` ASC);

CREATE INDEX `fk_cuenta_relacion_typo_cuenta1_idx` ON `banco`.`cuenta` (`relacion_typo_cuenta_id` ASC, `relacion_typo_cuenta_credito_idcredito` ASC, `relacion_typo_cuenta_debito_id1` ASC);


-- -----------------------------------------------------
-- Table `banco`.`comisiones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`comisiones` ;

CREATE TABLE IF NOT EXISTS `banco`.`comisiones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tasa` FLOAT NOT NULL,
  `detalle` VARCHAR(140) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `banco`.`relacion_movimiento_credito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`relacion_movimiento_credito` ;

CREATE TABLE IF NOT EXISTS `banco`.`relacion_movimiento_credito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `movimiento_id` INT NOT NULL,
  `movimiento_operacion_id` INT NOT NULL,
  `credito_idcredito` INT NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  `comisiones_id` INT NOT NULL,
  PRIMARY KEY (`id`, `movimiento_id`, `movimiento_operacion_id`, `credito_idcredito`, `comisiones_id`),
  CONSTRAINT `fk_relacion_movimiento_movimiento1`
    FOREIGN KEY (`movimiento_id` , `movimiento_operacion_id`)
    REFERENCES `banco`.`movimiento` (`id` , `operacion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relacion_movimiento_credito1`
    FOREIGN KEY (`credito_idcredito`)
    REFERENCES `banco`.`credito` (`idcredito`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relacion_movimiento_credito_comisiones1`
    FOREIGN KEY (`comisiones_id`)
    REFERENCES `banco`.`comisiones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `fk_relacion_movimiento_movimiento1_idx` ON `banco`.`relacion_movimiento_credito` (`movimiento_id` ASC, `movimiento_operacion_id` ASC);

CREATE INDEX `fk_relacion_movimiento_credito1_idx` ON `banco`.`relacion_movimiento_credito` (`credito_idcredito` ASC);

CREATE INDEX `fk_relacion_movimiento_credito_comisiones1_idx` ON `banco`.`relacion_movimiento_credito` (`comisiones_id` ASC);


-- -----------------------------------------------------
-- Table `banco`.`relacion_movimiento_debito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco`.`relacion_movimiento_debito` ;

CREATE TABLE IF NOT EXISTS `banco`.`relacion_movimiento_debito` (
  `movimiento_id` INT NOT NULL,
  `movimiento_operacion_id` INT NOT NULL,
  `debito_id` INT NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  PRIMARY KEY (`movimiento_id`, `movimiento_operacion_id`, `debito_id`),
  CONSTRAINT `fk_relacion_movimiento_debito_movimiento1`
    FOREIGN KEY (`movimiento_id` , `movimiento_operacion_id`)
    REFERENCES `banco`.`movimiento` (`id` , `operacion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relacion_movimiento_debito_debito1`
    FOREIGN KEY (`debito_id`)
    REFERENCES `banco`.`debito` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `fk_relacion_movimiento_debito_debito1_idx` ON `banco`.`relacion_movimiento_debito` (`debito_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
