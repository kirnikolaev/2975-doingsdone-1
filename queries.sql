CREATE DATABASE doings
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE doings;

CREATE TABLE users (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	registration_date DATETIME,
	name CHAR(18),
	password CHAR(18),
	email CHAR(18),
	phone CHAR(12)
);

CREATE TABLE projects (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	project_name CHAR(16),
	usr INT UNSIGNED NOT NULL,
	FOREIGN KEY (usr) REFERENCES users(id)
);

CREATE TABLE tasks (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title CHAR(64),
	link CHAR(64) NULL DEFAULT NULL,
	project_id INT UNSIGNED NOT NULL ,
	user_id INT UNSIGNED NOT NULL,

	create_time DATETIME,
	execution DATE NULL DEFAULT NULL,
	date_completed DATETIME NULL DEFAULT NULL,
	done VARCHAR(5) NULL DEFAULT NULL,

	FOREIGN KEY (`project_id`) REFERENCES projects(id),
	FOREIGN KEY (`user_id`) REFERENCES users(id)
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX phone ON users(phone);
CREATE INDEX project_name ON projects(project_name);
CREATE INDEX title ON tasks(title);

INSERT INTO users (email, password, name, phone, registration_date)
VALUES
('user1@example.ru', 'secret','Константин', '79219001221', '2018-01-04'),
('usr@example.ru', 'melon', 'Фродо', '79117655521', '2018-09-05'),
('london@capital.com', 'Hoffman', 'Джордж', '79311312487', '2018-04-22'),
('paris@capital.com', 'napoleon', 'Жерар', '79051312487', '2018-04-15')
;

INSERT INTO projects (project_name, usr)
VALUES
('Входящие', '1'),
('Учеба', '1'),
('Работа', '1'),
('Домашние дела', '1'),
('Авто', '1')
;

INSERT INTO projects (project_name, usr)
VALUES
('Входящие', '2'),
('Учеба', '2'),
('Работа', '2'),
('Домашние дела', '2')
;

INSERT INTO tasks (project_id, user_id, title, link, create_time, execution, date_completed, done)
VALUES
('3', '1', 'Собеседование в IT компании','Home.psd', '2018-04-01 12:07:00','2018-06-01',NULL, NULL),
('3', '1', 'Выполнить тестовое задание', 'Home.psd', '2018-04-01 12:07:00', '2018-05-25', NULL, NULL),
('4', '1', 'Купить корм для кота', NULL, '2018-04-01 12:07:00', NULL, NULL, NULL),
('4', '1', 'Заказать пиццу', NULL, '2018-04-01 12:07:00', NULL, NULL, NULL),
('1', '1', 'Встреча с другом', NULL, '2018-04-01 12:07:00', '2018-04-15', '2018-04-15 17:24:00', TRUE),
('2', '1', 'Сделать задание первого раздела', NULL, '2018-04-01 12:07:00', '2018-05-15', NULL, NULL),
('3', '2', 'Собеседование в ИП Пупкин', 'Home.psd', '2018-04-01 12:07:00', '2018-06-01', NULL, NULL),
('3', '2', 'Написать тестовое задание', 'Home.psd', '2018-04-01 12:07:00', '2018-05-25', NULL, NULL),
('4', '2', 'Купить арбуз', NULL, '2018-04-01 12:07:00', NULL, NULL, NULL),
('2', '2', 'Сделать задание второго раздела', NULL, '2018-04-01 12:07:00', '2018-05-15', NULL, NULL)
;

/* список из всех проектов для одного пользователя*/
SELECT project_name FROM projects
WHERE user_id = '1'
GROUP BY project_name
;

/* список из всех задач для одного проекта*/
SELECT * FROM tasks
WHERE project_id = '2'
;

/* пометить задачу как выполненную*/

UPDATE tasks SET done = NULL WHERE id = '6';

/* получить все задачи для завтрашнего дня*/
SELECT * FROM tasks
WHERE execution
LIKE '%2018-05-15%'
;


/* обновить название задачи по её идентификатору*/
UPDATE tasks SET title='Выполнить задание третьего раздела'
WHERE id='6'
;
