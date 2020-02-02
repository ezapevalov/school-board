CREATE TABLE `school-board`.`students` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `board_id` INT(11) UNSIGNED NOT NULL ,

  PRIMARY KEY (`id`),
  INDEX (`board_id`)
)
ENGINE = InnoDB;

CREATE TABLE `school-board`.`boards` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,

  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

ALTER TABLE `students`
ADD CONSTRAINT `students_board_id_fk` FOREIGN KEY (`board_id`)
REFERENCES `boards`(`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE `school-board`.`grades` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `student_id` INT(11) UNSIGNED NOT NULL ,
  `grade` TINYINT(2) UNSIGNED NOT NULL ,

  PRIMARY KEY (`id`),
  INDEX (`student_id`)
)
ENGINE = InnoDB;

ALTER TABLE `grades`
ADD CONSTRAINT `grades_student_id_fk` FOREIGN KEY (`student_id`)
REFERENCES `students`(`id`)
ON DELETE CASCADE ON UPDATE CASCADE;