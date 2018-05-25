<?php
require_once ('functions.php');
date_default_timezone_set('Europe/Moscow');
$show_complete_tasks = rand(0, 1);

$con = connect_db();

$projects = get_project_list($con, $show_complete_tasks);
$tasks_list = get_tasks_list($con, $show_complete_tasks);
$all_tasks = get_all_tasks($con, $show_complete_tasks);

if (!$con) {
    $error = mysqli_connect_error();
    print $content = render('error', ['error' => $error]);
}

else {
    $print_main = render('index', ['show_complete_tasks'=>$show_complete_tasks, 'tasks_list'=>$tasks_list, 'all_tasks'=>$all_tasks]);
    $print_layout = render('layout', [
    'projects' => $projects,
    'tasks_list'=>$tasks_list,
    'all_tasks'=>$all_tasks,
    'title'=>'Дела в порядке',
    'content'=>$print_main,
    'username'=>'Имя пользователя'
]);

print $print_layout;
}

?>

