INSERT INTO users
SET email = 'user1@example.ru', password = 'secret', name ='Константин', phone = '79219001221', registration_date = '2018-01-04';
INSERT INTO users
SET email = 'usr@example.ru', password = 'melon', name ='Фродо', phone = '79117655521', registration_date = '2018-09-05';

INSERT INTO projects
SET project_name = 'Входящие';
INSERT INTO projects
SET project_name = 'Учеба';
INSERT INTO projects
SET project_name = 'Работа';
INSERT INTO projects
SET project_name = 'Домашние дела';
INSERT INTO projects
SET project_name = 'Авто';

INSERT INTO tasks
SET project_id='3', user_id='1', task_title ='Собеседование в IT компании', file_link = 'Home.psd', create_time = '2018-04-01 12:07:00', execution_date='2018-06-01 12:00:00';
INSERT INTO tasks
SET project_id='3', user_id='1', task_title ='Выполнить тестовое задание', file_link = 'Home.psd', create_time = '2018-04-01 12:07:00', execution_date='2018-05-25 12:00:00';

INSERT INTO tasks
SET project_id='4', user_id='1', task_title ='Купить корм для кота', create_time = '2018-04-01 12:07:00';
INSERT INTO tasks
SET project_id='4', user_id='1', task_title ='Заказать пиццу', create_time = '2018-04-01 12:07:00';

INSERT INTO tasks
SET project_id='1', user_id='1', task_title ='Встреча с другом', create_time = '2018-04-01 12:07:00', execution_date='2018-04-15 17:30:00',  date_completed ='2018-04-15 17:24:00';

INSERT INTO tasks
SET project_id='2', user_id='1', task_title ='Сделать задание первого раздела', create_time = '2018-04-01 12:07:00', execution_date='2018-05-15 17:30:00';

INSERT INTO tasks
SET project_id='3', user_id='2', task_title ='Собеседование в ИП Пупкин', file_link = 'Home.psd', create_time = '2018-04-01 12:07:00', execution_date='2018-06-01 12:00:00';
INSERT INTO tasks
SET project_id='3', user_id='2', task_title ='Написать тестовое задание', file_link = 'Home.psd', create_time = '2018-04-01 12:07:00', execution_date='2018-05-25 12:00:00';

INSERT INTO tasks
SET project_id='4', user_id='2', task_title ='Купить арбуз', create_time = '2018-04-01 12:07:00';

INSERT INTO tasks
SET project_id='2', user_id='2', task_title ='Сделать задание второго раздела', create_time = '2018-04-01 12:07:00', execution_date='2018-05-15 17:30:00';

/* список из всех проектов для одного пользователя*/
SELECT project_name FROM projects
JOIN tasks
ON projects.project_id=tasks.project_id
WHERE user_id = '2'
GROUP BY project_name
;

/* список из всех задач для одного проекта*/
SELECT * FROM tasks
WHERE project_id = '4'
;

/* пометить задачу как выполненную*/
UPDATE tasks
SET date_completed='2018-05-20 02:42:00'
WHERE task_id='8'
;

/* получить все задачи для завтрашнего дня*/
SELECT * FROM tasks
WHERE execution_date
LIKE '%2018-05-15%'
;

/* обновить название задачи по её идентификатору*/
UPDATE tasks
SET task_title='Выполнить задание третьего раздела'
WHERE task_id='10'
;
