CREATE DATABASE doings
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE doings;

CREATE TABLE `projects` (
id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
`project_name` CHAR(64)
);

CREATE TABLE `tasks` (
id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`create_time` DATETIME,
	`execution_date` DATE,
	`task_title` CHAR(255),
	`due_date` DATETIME,
	`file_link` CHAR(64)
);

CREATE TABLE `users` (
id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`registration_date` DATE,
	`name` CHAR(62),
	`password` CHAR(32),
	`email` CHAR(32),
	`phone` TINYINT(13)

);
