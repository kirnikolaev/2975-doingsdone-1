<?php
require_once ('functions.php');
date_default_timezone_set('Europe/Moscow');
$show_complete_tasks = rand(0, 1);
$user_id =1;
$con = connect_db();
$errors = [];

$projects = get_project_list($con, $show_complete_tasks);
$tasks_list = get_tasks_list($con, $show_complete_tasks);
$all_tasks = get_all_tasks($con, $show_complete_tasks);

if (!$con) {
    $error = mysqli_connect_error();
    print $content = render('error', ['error' => $error]);
}

else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = [];
        $sql = '';
        $data = [];
        if ( (isset($_POST['add_pro']) ) ) {
            $project_add = isset($_POST['project_add']) ? $_POST['project_add']: ''; 
            
            if (empty($project_add)) {
                $errors['project_add'] = "придумайте название проекта";
            }   
            if ( !count($errors) ) {
                $data = [$user_id, $project_add];
                $sql = "Insert into projects (usr, project_name) VALUES (?, ?)";
                $stmt = db_get_prepare_stmt($con, $sql, $data);
                $res = mysqli_stmt_execute($stmt);
                if ($res) {
                header("Location: index.php");
                }
                else {
                print $print_layout;
            }       
        }
 
    }  

        if ( (isset($_POST['add_task'])) ) {
            $project_id = $_POST['project_id'];
            $title = isset($_POST['title']) ? $_POST['title']: '';
            $execution = isset($_POST['execution']) ? $_POST['execution']: '';
            $link = isset($_POST['file']) ? $_POST['file']: '';

            if (empty($title)) {
                $errors['title_add'] = "придумайте название для задачи";
            }   

            if ( !count($errors) ) {
                $data = [$project_id, $user_id, $title];
                $additional_insert = "";
            
                if ($execution) {
                    array_push($data, $execution);
                    $additional_insert .= ',execution';
                }

                if ($link) {
                    array_push($data, $link);
                    $additional_insert .= ',link';
                    $link = "uploads/".$FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], $link);      
                }
            
                $additional_values = implode(",", array_fill(0, count($data), '?'));

                $sql = "Insert into tasks (create_time, project_id, user_id, title".$additional_insert.") VALUES (NOW(),".$additional_values.")";    
            }
        }  
    }    
}

    $print_main = render('index', ['show_complete_tasks'=>$show_complete_tasks, 'tasks_list'=>$tasks_list, 'all_tasks'=>$all_tasks]);
    $print_layout = render('layout', [
    'projects' => $projects,
    'tasks_list'=>$tasks_list,
    'all_tasks'=>$all_tasks,
    'title'=>'Локальные дела в порядке',
    'content'=>$print_main,
    'username'=>'Имя пользователя',
    'errors'=>$errors
]);


print $print_layout;



?>

