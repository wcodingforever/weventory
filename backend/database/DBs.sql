CREATE TABLE `account`(
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_login` VARCHAR(25) NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `f_name` VARCHAR(30) NOT NULL,
    `l_name` VARCHAR(30) NOT NULL,
    `b_day` DATE NOT NULL,
    `pic` VARCHAR(200) NULL,
    `bio` VARCHAR(400) NULL,
    `interests` VARCHAR(200) NULL,
    `create_date` datetime NOT NULL DEFAULT NOW()
);


CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `category` varchar(64)  NOT NULL,
  `description` varchar(400)  NOT NULL,
  `tags` varchar(400)  NOT NULL,
  `picture` varchar(200) NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);


CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `datefrom` int(32) NOT NULL,
  `dateto` int(32) NULL,
  `category` varchar(32)  NOT NULL,
  `description` varchar(20) NOT NULL,
  `location` varchar(128) NOT NULL,
  `tags` varchar(400) NOT NULL,
  `event_host` varchar(64) NOT NULL,
  `privacy` int(11),
  `group_host_id` int(11) NOT NULL,
  `user_host_id` int(11) NOT NULL,
  `picture` varchar(200) NULL,
  `price` int(11) NOT NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);



CREATE TABLE `eventparticipants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);



CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` varchar(11) NOT NULL,
  `views` int(11)  NOT NULL,
  `content` varchar(100) NULL,
  `sticky` int(11) NOT NULL,
  `parent_comment_id` int(32)  NOT NULL,  
  `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);




CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `content` varchar(400)  NOT NULL,
  `reason` varchar(100)  NOT NULL,
  `group_id` int(11)  NULL,
  `account_id` int(11) NULL,
  `event_id` int(1) NULL,  
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);