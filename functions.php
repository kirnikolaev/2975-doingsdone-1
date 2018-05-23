<?php function get_projects_count($some_project, array $some_tasks_list) {

    if ($some_project == 'Все'){
        return count($some_tasks_list);
    }
    
    $projects_count = 0;
    foreach ($some_tasks_list as $task) {
        if ($some_project == $task['id']) {
            $projects_count++;
        }

    }

    return $projects_count;
}

function render($template_name, $vars = array()) {
    if(file_exists('templates/'.$template_name.'.php')){
        ob_start();
        extract($vars);
        require 'templates/'.$template_name.'.php';
        return ob_get_clean();
    }
}

function is_important_task ($execution_date) {
    if ($execution_date - time() < 86000 && !is_null($execution_date)){
        return 'task--important';
    }
}

function connect_db (){
    return mysqli_connect("localhost", "root", "weider32", "doings");
}

function get_project_list ($con, $show_complete) {

    if ($show_complete == 0){
        $sql2 = "SELECT project_name, COUNT(project_name) FROM tasks JOIN projects ON tasks.project_id = projects.id WHERE user_id ='1' AND done IS NULL GROUP BY project_name";
        $result2 = mysqli_query($con, $sql2);
        $projects = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    }

    else {
        $sql2 = "SELECT project_name, COUNT(project_name) FROM tasks JOIN projects ON tasks.project_id = projects.id WHERE user_id ='1' GROUP BY project_name";
        $result2 = mysqli_query($con, $sql2);
        $projects = mysqli_fetch_all($result2, MYSQLI_ASSOC);    
    }

    return $projects;
}

function get_tasks_list ($con, $show_complete) {

    if ($show_complete == 0){
        $sql2 = "SELECT *, Unix_timestamp(execution) AS execution_unix FROM tasks WHERE done IS NULL AND user_id=1";
        $result2 = mysqli_query($con, $sql2);
        $tasks_list = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    }

    else {
        $sql2 = "SELECT *, Unix_timestamp(execution) AS execution_unix FROM tasks WHERE user_id=1";
        $result2 = mysqli_query($con, $sql2);
        $tasks_list = mysqli_fetch_all($result2, MYSQLI_ASSOC);    
    }

    return $tasks_list;
}

?>