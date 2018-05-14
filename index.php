<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$projects = [
    "Все", "Входящие", "Учеба", "Работа","Домашние дела", "Авто"
];

$tasks_list = [
    [
    'title' => 'Собеседование в IT компании',
    'execution' => '01.06.2018',
    'project' => 'Работа',
    'done' => false
    ],
    [
    'title' => 'Выполнить тестовое задание',
    'execution' => '25.05.2018',
    'project' => 'Работа',
    'done' => false
    ],
    [
    'title' => 'Сделать задание первого раздела',
    'execution' => '21.04.2018',
    'project' => 'Учеба',
    'done' => false
    ],
    [
    'title' => 'Встреча с другом',
    'execution' => '22.04.2018',
    'project' => 'Входящие',
    'done' => true
    ],
    [
    'title' => 'Купить корм для кота',
    'execution' => 'нет',
    'project' => 'Домашние дела',
    'done' => false
    ],
    [
    'title' => 'Заказать пиццу',
    'execution' => 'нет',
    'project' => 'Домашние дела',
    'done' => false
    ]
];


require ('functions.php');
$print_main = render('index', ['show_complete_tasks'=>$show_complete_tasks, 'tasks_list'=>$tasks_list]);
$print_layout = render('layout', [
    'projects' => $projects,
    'tasks_list'=>$tasks_list,
    'title'=>'Дела в порядке',
    'content'=>$print_main,
    'username'=>'Имя пользователя'
]);

print $print_layout;
?>