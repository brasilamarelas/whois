SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `whois` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `whois` ;

-- -----------------------------------------------------
-- Table `whois`.`pessoa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `whois`.`pessoa` (
  `nic_hdl_br` VARCHAR(10) NOT NULL ,
  `pessoa` VARCHAR(255) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `criado` INT(8) NOT NULL ,
  `alterado` INT(8) NOT NULL ,
  PRIMARY KEY (`nic_hdl_br`) )
ENGINE = InnoDB, 
COMMENT = 'Entidade Responsavel, representa algum tipo de responsavel (' /* comment truncated */ ;


-- -----------------------------------------------------
-- Table `whois`.`papel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `whois`.`papel` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `titulo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `whois`.`dominio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `whois`.`dominio` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `pessoa_nic_hdl_br` VARCHAR(10) NOT NULL ,
  `nome` VARCHAR(255) NOT NULL ,
  `criado` INT(8) NOT NULL ,
  `expira` INT(8) NOT NULL ,
  `alterado` INT(8) NOT NULL ,
  `status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_dominio_pessoa1`
    FOREIGN KEY (`pessoa_nic_hdl_br` )
    REFERENCES `whois`.`pessoa` (`nic_hdl_br` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_dominio_pessoa1` ON `whois`.`dominio` (`pessoa_nic_hdl_br` ASC) ;


-- -----------------------------------------------------
-- Table `whois`.`servidor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `whois`.`servidor` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `nserver` VARCHAR(35) NOT NULL ,
  `nsstat` VARCHAR(17) NOT NULL ,
  `nslastaa` VARCHAR(12) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `whois`.`hospede`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `whois`.`hospede` (
  `servidor_id` BIGINT NOT NULL ,
  `dominio_id` BIGINT NOT NULL ,
  PRIMARY KEY (`servidor_id`, `dominio_id`) ,
  CONSTRAINT `fk_servidor_has_dominio_servidor`
    FOREIGN KEY (`servidor_id` )
    REFERENCES `whois`.`servidor` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servidor_has_dominio_dominio1`
    FOREIGN KEY (`dominio_id` )
    REFERENCES `whois`.`dominio` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_servidor_has_dominio_dominio1` ON `whois`.`hospede` (`dominio_id` ASC) ;

CREATE INDEX `fk_servidor_has_dominio_servidor` ON `whois`.`hospede` (`servidor_id` ASC) ;


-- -----------------------------------------------------
-- Table `whois`.`responsabilidade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `whois`.`responsabilidade` (
  `dominio_id` BIGINT NOT NULL ,
  `pessoa_nic_hdl_br` VARCHAR(10) NOT NULL ,
  `papel_id` INT NOT NULL ,
  PRIMARY KEY (`dominio_id`, `pessoa_nic_hdl_br`, `papel_id`) ,
  CONSTRAINT `fk_dominio_has_pessoa_dominio1`
    FOREIGN KEY (`dominio_id` )
    REFERENCES `whois`.`dominio` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dominio_has_pessoa_pessoa1`
    FOREIGN KEY (`pessoa_nic_hdl_br` )
    REFERENCES `whois`.`pessoa` (`nic_hdl_br` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_responsabilidade_papel1`
    FOREIGN KEY (`papel_id` )
    REFERENCES `whois`.`papel` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_dominio_has_pessoa_pessoa1` ON `whois`.`responsabilidade` (`pessoa_nic_hdl_br` ASC) ;

CREATE INDEX `fk_dominio_has_pessoa_dominio1` ON `whois`.`responsabilidade` (`dominio_id` ASC) ;

CREATE INDEX `fk_responsabilidade_papel1` ON `whois`.`responsabilidade` (`papel_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `whois`.`papel`
-- -----------------------------------------------------
START TRANSACTION;
USE `whois`;
INSERT INTO `whois`.`papel` (`id`, `titulo`) VALUES (NULL, 'Dono');
INSERT INTO `whois`.`papel` (`id`, `titulo`) VALUES (NULL, 'Administrador');
INSERT INTO `whois`.`papel` (`id`, `titulo`) VALUES (NULL, 'Financeiro');
INSERT INTO `whois`.`papel` (`id`, `titulo`) VALUES (NULL, 'Tecnico');

COMMIT;
