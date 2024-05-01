CREATE TABLE IF NOT EXISTS `TarcDining`.`user` (
  `email` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(300) NULL,
  `role` VARCHAR(45) NULL,
  PRIMARY KEY (`email`),
  UNIQUE INDEX `user_email_UNIQUE` (`email`)
);

CREATE TABLE IF NOT EXISTS `TarcDining`.`staff` (
  `email` VARCHAR(45) NOT NULL,
  `Role` VARCHAR(300) NULL,
  `serv_iD` INT NULL,
  `staffcol` VARCHAR(45) NULL,
  PRIMARY KEY (`email`),
  CONSTRAINT `fk_staff_user`
    FOREIGN KEY (`email`)
    REFERENCES `TarcDining`.`user` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `TarcDining`.`Admin` (
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(300) NULL,
  `revenue` DECIMAL(10,2) NULL,
  `wrkHrs` VARCHAR(45) NULL,
  PRIMARY KEY (`email`),
  CONSTRAINT `fk_admin_user`
    FOREIGN KEY (`email`)
    REFERENCES `TarcDining`.`user` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `TarcDining`.`student` (
  `email` VARCHAR(45) NOT NULL,
  `tokenCnt` INT NULL,
  PRIMARY KEY (`email`),
  CONSTRAINT `fk_student_user`
    FOREIGN KEY (`email`)
    REFERENCES `TarcDining`.`user` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `TarcDining`.`feedback` (
  `email` VARCHAR(45) NULL,
  `text` VARCHAR(45) NULL,
  `mealRating` VARCHAR(45) NULL,
  PRIMARY KEY (`email`)
  CONSTRAINT `fk_feedback_student`
    FOREIGN KEY (`email`)
    REFERENCES `TarcDining`.`student` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `TarcDining`.`curMenu` (
  `f_id` INT NOT NULL AUTO_INCREMENT,
  `img` VARCHAR(45) NULL,
  `name` VARCHAR(45) NULL,
  `type` VARCHAR(45) NULL,
  `rating` INT NULL,
  `adminEmail` VARCHAR(45) NULL,
  `token` INT NULL,
  `time` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  `sellCount` INT NULL,
  PRIMARY KEY (`f_id`)
);

CREATE TABLE IF NOT EXISTS `TarcDining`.`payment` (
  `c_id` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NULL,
  `amount` VARCHAR(45) NULL,
  `trn_id` VARCHAR(45) NULL,
  `method` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE INDEX `trn_id_UNIQUE` (`trn_id`),
  CONSTRAINT `fk_payment_student`
    FOREIGN KEY (`email`)
    REFERENCES `TarcDining`.`student` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `TarcDining`.`cart` (
  `email` VARCHAR(45) NOT NULL,
  `f_id` INT NOT NULL,
  `token` INT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`email`, `f_id`),
  CONSTRAINT `fk_cart_student`
    FOREIGN KEY (`email`)
    REFERENCES `TarcDining`.`student` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cart_curMenu`
    FOREIGN KEY (`f_id`)
    REFERENCES `TarcDining`.`curMenu` (`f_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
CREATE TABLE IF NOT EXISTS TarcDining.`feedback` (
  feedback_id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(45) NOT NULL,
  text VARCHAR(255) NULL,
  mealRating VARCHAR(20) NULL, -- Adjusted data type to VARCHAR
  CONSTRAINT fk_feedback_student
    FOREIGN KEY (email)
    REFERENCES TarcDining.`student` (email)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
