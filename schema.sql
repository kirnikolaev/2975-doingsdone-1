CREATE DATABASE doings
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE doings;

CREATE TABLE `projects` (
id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
`project_name` CHAR(16)
);

CREATE TABLE `tasks` (
id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`create_time` DATETIME,
	`execution_date` DATE,
	`task_title` CHAR(64),
	`due_date` DATETIME,
	`file_link` CHAR(64)
);

CREATE TABLE `users` (
id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`registration_date` DATE,
	`name` CHAR(18),
	`password` CHAR(18),
	`email` CHAR(18),
	`phone` TINYINT(13)
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX phone ON users(phone);
CREATE INDEX task_title ON tasks(task_title);
