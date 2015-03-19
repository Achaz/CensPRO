SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `home_binit` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `home_binit` ;

-- -----------------------------------------------------
-- Table `home_binit`.`censpro_ethnicity`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_ethnicity` (
  `ethnicId` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`ethnicId`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_religion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_religion` (
  `religionId` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`religionId`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_record_personnel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_record_personnel` (
  `recordPersonId` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  PRIMARY KEY (`recordPersonId`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_country`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_country` (
  `country_id` INT NOT NULL AUTO_INCREMENT ,
  `country_name` VARCHAR(45) NULL ,
  PRIMARY KEY (`country_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_district`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_district` (
  `discrict_id` INT NOT NULL AUTO_INCREMENT ,
  `district_name` VARCHAR(45) NULL ,
  `country_id` INT NOT NULL ,
  PRIMARY KEY (`discrict_id`, `country_id`) ,
  INDEX `fk_censpro_district_censpro_country1_idx` (`country_id` ASC) ,
  CONSTRAINT `fk_censpro_district_censpro_country1`
    FOREIGN KEY (`country_id` )
    REFERENCES `home_binit`.`censpro_country` (`country_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_household`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_household` (
  `household_id` INT NOT NULL AUTO_INCREMENT ,
  `recordPerson_id` INT NOT NULL ,
  `date_recorded` DATE NOT NULL ,
  `head_personId` INT NOT NULL ,
  `location` VARCHAR(45) NULL ,
  `discrict_id` INT NOT NULL ,
  PRIMARY KEY (`household_id`, `recordPerson_id`, `head_personId`, `discrict_id`) ,
  INDEX `fk_household_record_personnel1_idx` (`recordPerson_id` ASC) ,
  INDEX `fk_household_person1_idx` (`head_personId` ASC) ,
  INDEX `fk_censpro_household_censpro_district1_idx` (`discrict_id` ASC) ,
  CONSTRAINT `fk_household_record_personnel1`
    FOREIGN KEY (`recordPerson_id` )
    REFERENCES `home_binit`.`censpro_record_personnel` (`recordPersonId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_household_person1`
    FOREIGN KEY (`head_personId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_censpro_household_censpro_district1`
    FOREIGN KEY (`discrict_id` )
    REFERENCES `home_binit`.`censpro_district` (`discrict_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_person`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_person` (
  `personId` INT NOT NULL AUTO_INCREMENT ,
  `dateOfBirth` DATE NOT NULL ,
  `birthCertificate` BLOB NULL ,
  `fatherId` INT NULL ,
  `motherId` INT NULL ,
  `ethnicId` INT NULL ,
  `religionId` INT NULL ,
  `recordPersonId` INT NULL ,
  `name` VARCHAR(45) NULL ,
  `gender` ENUM('male','female') NULL ,
  `household_id` INT NULL ,
  PRIMARY KEY (`personId`) ,
  INDEX `fk_person_person_idx` (`fatherId` ASC) ,
  INDEX `fk_person_person1_idx` (`motherId` ASC) ,
  INDEX `fk_person_ethnicity1_idx` (`ethnicId` ASC) ,
  INDEX `fk_person_religion1_idx` (`religionId` ASC) ,
  INDEX `fk_person_record_personnel1_idx` (`recordPersonId` ASC) ,
  INDEX `fk_person_household1_idx` (`household_id` ASC) ,
  CONSTRAINT `fk_person_person`
    FOREIGN KEY (`fatherId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_person1`
    FOREIGN KEY (`motherId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_ethnicity1`
    FOREIGN KEY (`ethnicId` )
    REFERENCES `home_binit`.`censpro_ethnicity` (`ethnicId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_religion1`
    FOREIGN KEY (`religionId` )
    REFERENCES `home_binit`.`censpro_religion` (`religionId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_record_personnel1`
    FOREIGN KEY (`recordPersonId` )
    REFERENCES `home_binit`.`censpro_record_personnel` (`recordPersonId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_disability`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_disability` (
  `disableId` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`disableId`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_person_Disability`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_person_Disability` (
  `personId` INT NOT NULL ,
  `disableId` INT NOT NULL ,
  PRIMARY KEY (`personId`, `disableId`) ,
  INDEX `fk_person_has_Disability_Disability1_idx` (`disableId` ASC) ,
  INDEX `fk_person_has_Disability_person1_idx` (`personId` ASC) ,
  CONSTRAINT `fk_person_has_Disability_person1`
    FOREIGN KEY (`personId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_has_Disability_Disability1`
    FOREIGN KEY (`disableId` )
    REFERENCES `home_binit`.`censpro_disability` (`disableId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_education`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_education` (
  `personId` INT NOT NULL ,
  `qualification` VARCHAR(45) NOT NULL ,
  `yearAttained` YEAR NOT NULL ,
  `awardingInstitute` VARCHAR(45) NOT NULL ,
  INDEX `fk_education_person1_idx` (`personId` ASC) ,
  CONSTRAINT `fk_education_person1`
    FOREIGN KEY (`personId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_Literacy`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_Literacy` (
  `personId` INT NOT NULL ,
  `canRead` TINYINT NULL ,
  `canWrite` TINYINT NULL ,
  `speaksEnglish` TINYINT NULL ,
  `ownsMobilePhone` TINYINT NULL ,
  `internetSavy` TINYINT NULL ,
  PRIMARY KEY (`personId`) ,
  CONSTRAINT `fk_Literacy_person1`
    FOREIGN KEY (`personId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_death_cause`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_death_cause` (
  `cause_id` INT NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`cause_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_person_death`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_person_death` (
  `dateDeceased` DATE NOT NULL ,
  `personId` INT NOT NULL ,
  `cause_id` INT NOT NULL ,
  `date_recorded` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`personId`, `cause_id`) ,
  INDEX `fk_person_death_death_cause1_idx` (`cause_id` ASC) ,
  CONSTRAINT `fk_person_death_person1`
    FOREIGN KEY (`personId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_death_death_cause1`
    FOREIGN KEY (`cause_id` )
    REFERENCES `home_binit`.`censpro_death_cause` (`cause_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_asset`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_asset` (
  `asset_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`asset_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_enterprise`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_enterprise` (
  `description` INT NULL ,
  `person_id` INT NOT NULL ,
  `date_recorded` DATE NOT NULL ,
  `business_name` VARCHAR(45) NULL ,
  PRIMARY KEY (`person_id`) ,
  INDEX `fk_enterprise_person2_idx` (`person_id` ASC) ,
  CONSTRAINT `fk_enterprise_person2`
    FOREIGN KEY (`person_id` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_livelihood_source`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_livelihood_source` (
  `source_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`source_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_household_livelihood`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_household_livelihood` (
  `date_recorded` DATE NOT NULL ,
  `source_id` INT NOT NULL ,
  `household_id` INT NOT NULL ,
  PRIMARY KEY (`source_id`, `household_id`) ,
  INDEX `fk_household_livelihood_livelihood source1_idx` (`source_id` ASC) ,
  INDEX `fk_household_livelihood_household1_idx` (`household_id` ASC) ,
  CONSTRAINT `fk_household_livelihood_livelihood source1`
    FOREIGN KEY (`source_id` )
    REFERENCES `home_binit`.`censpro_livelihood_source` (`source_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_household_livelihood_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_remittance`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_remittance` (
  `remittance_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  `household_id` INT NOT NULL ,
  `country_id` INT NOT NULL ,
  `date_recorded` DATE NOT NULL ,
  PRIMARY KEY (`remittance_id`, `household_id`, `country_id`) ,
  INDEX `fk_remittance_household1_idx` (`household_id` ASC) ,
  INDEX `fk_remittance_country1_idx` (`country_id` ASC) ,
  CONSTRAINT `fk_remittance_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remittance_country1`
    FOREIGN KEY (`country_id` )
    REFERENCES `home_binit`.`censpro_country` (`country_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_disposal_method`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_disposal_method` (
  `disposal_method_id` INT NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`disposal_method_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_waste_disposal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_waste_disposal` (
  `disposal_id` INT NOT NULL ,
  `household_id` INT NOT NULL ,
  `disposal_method_id` INT NOT NULL ,
  `date_recorded` DATE NOT NULL ,
  PRIMARY KEY (`disposal_id`, `household_id`, `disposal_method_id`) ,
  INDEX `fk_waste_disposal_household1_idx` (`household_id` ASC) ,
  INDEX `fk_waste_disposal_disposal_method1_idx` (`disposal_method_id` ASC) ,
  CONSTRAINT `fk_waste_disposal_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_waste_disposal_disposal_method1`
    FOREIGN KEY (`disposal_method_id` )
    REFERENCES `home_binit`.`censpro_disposal_method` (`disposal_method_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_kitchen_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_kitchen_type` (
  `kitchen_type_id` INT NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`kitchen_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_kitchen`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_kitchen` (
  `kitchen_id` INT NOT NULL ,
  `kitchen_type_id` INT NOT NULL ,
  `household_id` INT NOT NULL ,
  `date_recorded` DATE NOT NULL ,
  PRIMARY KEY (`kitchen_id`, `kitchen_type_id`, `household_id`) ,
  INDEX `fk_kitchen_kitchen_type1_idx` (`kitchen_type_id` ASC) ,
  INDEX `fk_kitchen_household1_idx` (`household_id` ASC) ,
  CONSTRAINT `fk_kitchen_kitchen_type1`
    FOREIGN KEY (`kitchen_type_id` )
    REFERENCES `home_binit`.`censpro_kitchen_type` (`kitchen_type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kitchen_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_household_asset`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_household_asset` (
  `household_id` INT NOT NULL ,
  `asset_id` INT NOT NULL ,
  `quantity` INT NULL ,
  `date_recorded` DATE NOT NULL ,
  INDEX `fk_household_has_asset_asset1_idx` (`asset_id` ASC) ,
  INDEX `fk_household_has_asset_household1_idx` (`household_id` ASC) ,
  CONSTRAINT `fk_household_has_asset_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_household_has_asset_asset1`
    FOREIGN KEY (`asset_id` )
    REFERENCES `home_binit`.`censpro_asset` (`asset_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_community_service`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_community_service` (
  `household_id` INT NOT NULL ,
  `date_recorded` DATE NOT NULL ,
  `dst_public_health_facility` INT NULL ,
  `dst_private_health_facility` INT NULL ,
  `dst_public_primary_school` INT NULL ,
  `dst_private_primary_school` INT NULL ,
  `dst_public_secondary_school` INT NULL ,
  `dst_private_secondary_school` INT NULL ,
  `dst_police` INT NULL ,
  PRIMARY KEY (`household_id`) ,
  CONSTRAINT `fk_community_service_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_occupancy`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_occupancy` (
  `occupancy_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`occupancy_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_energy_source`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_energy_source` (
  `source_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`source_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_dwelling_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_dwelling_type` (
  `dwelling_type_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`dwelling_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_construction_material`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_construction_material` (
  `material_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`material_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_water_source`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_water_source` (
  `source_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`source_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_toilet_facility`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_toilet_facility` (
  `toilet_facility_id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`toilet_facility_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_housing_condition`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_housing_condition` (
  `date_recorded` DATE NOT NULL ,
  `housing_condition_id` INT NULL AUTO_INCREMENT ,
  `household_id` INT NOT NULL ,
  `occupancy_id` INT NULL ,
  `energy_source_id` INT NULL ,
  `dwelling_type_id` INT NULL ,
  `wall_material_id` INT NULL ,
  `water_source_id` INT NULL ,
  `toilet_facility_id` INT NULL ,
  `roof_material_id` INT NULL ,
  `floor_material_id` INT NULL ,
  PRIMARY KEY (`housing_condition_id`, `household_id`, `occupancy_id`, `energy_source_id`, `dwelling_type_id`, `wall_material_id`, `water_source_id`, `toilet_facility_id`, `roof_material_id`, `floor_material_id`) ,
  INDEX `fk_housing_condition_household1_idx` (`household_id` ASC) ,
  INDEX `fk_housing_condition_occupancy1_idx` (`occupancy_id` ASC) ,
  INDEX `fk_housing_condition_energy_source1_idx` (`energy_source_id` ASC) ,
  INDEX `fk_housing_condition_dwelling_type1_idx` (`dwelling_type_id` ASC) ,
  INDEX `fk_housing_condition_construction_material1_idx` (`wall_material_id` ASC) ,
  INDEX `fk_housing_condition_water_source1_idx` (`water_source_id` ASC) ,
  INDEX `fk_housing_condition_toilet_facility1_idx` (`toilet_facility_id` ASC) ,
  INDEX `fk_housing_condition_construction_material2_idx` (`roof_material_id` ASC) ,
  INDEX `fk_housing_condition_construction_material3_idx` (`floor_material_id` ASC) ,
  CONSTRAINT `fk_housing_condition_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_housing_condition_occupancy1`
    FOREIGN KEY (`occupancy_id` )
    REFERENCES `home_binit`.`censpro_occupancy` (`occupancy_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_housing_condition_energy_source1`
    FOREIGN KEY (`energy_source_id` )
    REFERENCES `home_binit`.`censpro_energy_source` (`source_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_housing_condition_dwelling_type1`
    FOREIGN KEY (`dwelling_type_id` )
    REFERENCES `home_binit`.`censpro_dwelling_type` (`dwelling_type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_housing_condition_construction_material1`
    FOREIGN KEY (`wall_material_id` )
    REFERENCES `home_binit`.`censpro_construction_material` (`material_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_housing_condition_water_source1`
    FOREIGN KEY (`water_source_id` )
    REFERENCES `home_binit`.`censpro_water_source` (`source_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_housing_condition_toilet_facility1`
    FOREIGN KEY (`toilet_facility_id` )
    REFERENCES `home_binit`.`censpro_toilet_facility` (`toilet_facility_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_housing_condition_construction_material2`
    FOREIGN KEY (`roof_material_id` )
    REFERENCES `home_binit`.`censpro_construction_material` (`material_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_housing_condition_construction_material3`
    FOREIGN KEY (`floor_material_id` )
    REFERENCES `home_binit`.`censpro_construction_material` (`material_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_crop`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_crop` (
  `crop_id` INT NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`crop_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_plant_agriculture`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_plant_agriculture` (
  `agriculture_id` INT NOT NULL AUTO_INCREMENT ,
  `date_recorded` DATE NOT NULL ,
  `no_crops` INT NULL ,
  `purpose` VARCHAR(45) NULL ,
  `crop_id` INT NOT NULL ,
  `household_id` INT NOT NULL ,
  `location` VARCHAR(45) NULL ,
  `discrict_id` INT NOT NULL ,
  PRIMARY KEY (`agriculture_id`, `crop_id`, `household_id`, `discrict_id`) ,
  INDEX `fk_plant_agriculture_crop1_idx` (`crop_id` ASC) ,
  INDEX `fk_plant_agriculture_household1_idx` (`household_id` ASC) ,
  INDEX `fk_censpro_plant_agriculture_censpro_district1_idx` (`discrict_id` ASC) ,
  CONSTRAINT `fk_plant_agriculture_crop1`
    FOREIGN KEY (`crop_id` )
    REFERENCES `home_binit`.`censpro_crop` (`crop_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plant_agriculture_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_censpro_plant_agriculture_censpro_district1`
    FOREIGN KEY (`discrict_id` )
    REFERENCES `home_binit`.`censpro_district` (`discrict_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_livestock`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_livestock` (
  `livestock_id` INT NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`livestock_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_animal_agriculture`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_animal_agriculture` (
  `agriculture_id` INT NOT NULL AUTO_INCREMENT ,
  `date_recorded` DATE NOT NULL ,
  `no_animals` INT NULL ,
  `purpose` VARCHAR(45) NULL ,
  `livestock_id` INT NOT NULL ,
  `household_id` INT NOT NULL ,
  `location` VARCHAR(45) NULL ,
  `discrict_id` INT NOT NULL ,
  PRIMARY KEY (`agriculture_id`, `livestock_id`, `household_id`, `discrict_id`) ,
  INDEX `fk_animal_agriculture_livestock1_idx` (`livestock_id` ASC) ,
  INDEX `fk_animal_agriculture_household1_idx` (`household_id` ASC) ,
  INDEX `fk_censpro_animal_agriculture_censpro_district1_idx` (`discrict_id` ASC) ,
  CONSTRAINT `fk_animal_agriculture_livestock1`
    FOREIGN KEY (`livestock_id` )
    REFERENCES `home_binit`.`censpro_livestock` (`livestock_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animal_agriculture_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `home_binit`.`censpro_household` (`household_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_censpro_animal_agriculture_censpro_district1`
    FOREIGN KEY (`discrict_id` )
    REFERENCES `home_binit`.`censpro_district` (`discrict_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_school_attended`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_school_attended` (
  `year_attended` YEAR NULL ,
  `class` VARCHAR(10) NOT NULL ,
  `personId` INT NOT NULL ,
  `school_name` VARCHAR(45) NULL ,
  INDEX `fk_school_attended_person1_idx` (`personId` ASC) ,
  CONSTRAINT `fk_school_attended_person1`
    FOREIGN KEY (`personId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `home_binit`.`censpro_occupation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `home_binit`.`censpro_occupation` (
  `date` DATE NOT NULL ,
  `description` VARCHAR(45) NULL ,
  `personId` INT NOT NULL ,
  PRIMARY KEY (`date`, `personId`) ,
  INDEX `fk_occupation_person1_idx` (`personId` ASC) ,
  CONSTRAINT `fk_occupation_person1`
    FOREIGN KEY (`personId` )
    REFERENCES `home_binit`.`censpro_person` (`personId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `home_binit` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
