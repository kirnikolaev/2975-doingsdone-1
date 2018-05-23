<?php
require ('functions.php');
date_default_timezone_set('Europe/Moscow');
$show_complete_tasks = rand(0, 1);
$con = mysqli_connect("localhost", "root", "weider32", "doings");

$sql2 = "SELECT project_name, COUNT(project_name) FROM tasks JOIN projects ON tasks.project_id = projects.id WHERE user_id ='1' GROUP BY project_name;";
$result2 = mysqli_query($con, $sql2);
$projects = mysqli_fetch_all($result2, MYSQLI_ASSOC);

$sql = "SELECT *, Unix_timestamp(execution) AS execution_unix FROM tasks WHERE done IS NULL AND user_id=1";
$result = mysqli_query($con, $sql);
$tasks_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

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

