<?php
require ('functions.php');
date_default_timezone_set('Europe/Moscow');
$show_complete_tasks = rand(0, 1);

$con = connect_db();
$projects = get_project_list($con, $show_complete_tasks);
$tasks_list = get_tasks_list($con, $show_complete_tasks);

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

