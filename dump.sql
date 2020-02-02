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

INSERT INTO `boards` (`id`, `name`) VALUES ('1', 'CSM'), ('2', 'CSMB');

INSERT INTO `students` (`id`, `name`, `board_id`) VALUES
  ('1', 'John Smith',  '1'),
  ('2', 'Jane Walker', '1'),
  ('3', 'Jack Brigs',  '1'),
  ('4', 'Max Cage',    '2'),
  ('5', 'Ann Stewart', '2'),
  ('6', 'Terry Haze',  '2');

INSERT INTO `grades` (`id`, `student_id`, `grade`) VALUES
(NULL, '1', '9'),
(NULL, '1', '8'),
(NULL, '1', '5'),
(NULL, '2', '7'),
(NULL, '2', '6'),
(NULL, '3', '7'),
(NULL, '3', '5'),
(NULL, '3', '9'),
(NULL, '4', '7'),
(NULL, '4', '7'),
(NULL, '4', '9'),
(NULL, '5', '8'),
(NULL, '5', '8'),
(NULL, '5', '7'),
(NULL, '6', '9'),
(NULL, '6', '10'),
(NULL, '6', '9'),
(NULL, '6', '8');