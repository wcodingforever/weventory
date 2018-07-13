

CREATE TABLE `Account`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` VARCHAR(15) NOT NULL,
    `password` VARCHAR(30) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `f_name` VARCHAR(30) NOT NULL,
    `m_nam` VARCHAR(30) NULL,
    `l_name` VARCHAR(30) NOT NULL,
    `b_day` DATE NOT NULL,
    `pic` VARCHAR(200) NULL,
    `bio` VARCHAR(400) NULL,
    `interests` VARCHAR(200) NULL,
    `create_date` DATE NOT NULL,
);