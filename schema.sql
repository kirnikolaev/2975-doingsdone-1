CREATE DATABASE doings
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE doings;

CREATE TABLE `projects` (
	project_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`project_name` CHAR(16)
);


CREATE TABLE `users` (
	user_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`registration_date` DATETIME,
	`name` CHAR(18),
	`password` CHAR(18),
	`email` CHAR(18),
	`phone` CHAR(12)
);


CREATE TABLE `tasks` (
	task_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`task_title` CHAR(64),
	`file_link` CHAR(64),
	project_id INT UNSIGNED NOT NULL ,
	user_id INT UNSIGNED NOT NULL,

	`create_time` DATETIME,
	`execution_date` DATETIME,
	`date_completed` DATETIME,

	FOREIGN KEY (project_id) REFERENCES projects(project_id),
	FOREIGN KEY (`user_id`) REFERENCES users(user_id)
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX phone ON users(phone);
CREATE UNIQUE INDEX project_name ON projects(project_name);
CREATE INDEX task_title ON tasks(task_title);

