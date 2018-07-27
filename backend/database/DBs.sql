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

CREATE TABLE `verification`(
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_login`  VARCHAR(25) NOT NULL,
  `f_name` VARCHAR(30) NOT NULL,
  `pin` int(11) NOT NULL
);

CREATE TABLE `sessions`(
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(11) NOT NULL,
    `user_login` VARCHAR(25) NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `session_id` VARCHAR(64) NOT NULL,
    `expir_date` datetime NOT NULL,
    `user_country` VARCHAR(64) NOT NULL,
    `user_city` VARCHAR(64) NULL,
    `user_lat` DECIMAL(10, 8) NULL,
    `user_lon` DECIMAL(11, 8) NULL
);

CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `category` varchar(64)  NOT NULL,
  `description` varchar(400)  NOT NULL,
  `tags` varchar(400) NOT NULL,
  `picture` varchar(200) NULL,
  `group_country` VARCHAR(64) NULL,
  `group_city` VARCHAR(64) NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE `group_particitants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL,
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
  `event_country` varchar(64) NOT NULL,
  `event_city` varchar(64) NOT NULL,
  `event_lat` DECIMAL(10, 8) NOT NULL,
  `event_lon` DECIMAL(11, 8) NOT NULL,
  `tags` varchar(400) NOT NULL,
  `event_host` varchar(64) NOT NULL,
  `privacy` int(11) NOT NULL,
  `group_host_id` int(11) NOT NULL,
  `user_host_id` int(11) NOT NULL,
  `picture` varchar(200) NULL,
  `price` int(11) NOT NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);



CREATE TABLE `event_participants` (
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
  `event_id` int(11) NULL,  
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE 'messages' (  
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'sender_id' int(11) NOT NULL,
  'receiver_id' int(11) NOT NULL,
  'message' varchar(400) NOT NULL,
  'send_time' datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id')
);


CREATE TABLE `help_articles`(
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `author_id` int(11) NOT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `title` VARCHAR(100) NOT NULL,
    `content` VARCHAR(1500) NOT NULL,
    `kind` VARCHAR(25) NOT NULL,
    `sticky` INT(11) NOT NULL,
    `parent_article_id` INT(11) NULL,
    `re_step` INT(11) NULL,  
    `password` VARCHAR(4) NULL,
    `hits` INT(11) NOT NULL DEFAULT 0,
    `tags` VARCHAR(250) NULL,
    `files` VARCHAR(500) NULL,
    `child_articles` VARCHAR(70) NULL
);/* mapping table for tags as for groups*/

CREATE TABLE `parent`(
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `author_id` int(11) NOT NULL,
    `comment` VARCHAR(200) NOT NULL,
    `
);
CREATE TABLE `children`(

)