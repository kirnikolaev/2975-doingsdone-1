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

    
    $sql_inner = ' (SELECT COUNT(tasks.project_id) FROM tasks WHERE tasks.project_id = projects.id ';
    if ($show_complete == 0) {
        $sql_inner .= ' AND done IS NULL';
    }

    $sql = 'SELECT project_name, id, ' . $sql_inner  . ' )as total FROM projects WHERE usr = 1';

    $result = mysqli_query($con, $sql);
    $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $projects;
}

function get_all_tasks ($con, $show_complete) {

    $sql = 'SELECT *, Unix_timestamp(execution) AS execution_unix FROM tasks WHERE user_id=1';
    
    if ($show_complete == 0) {
        $sql .= ' AND done IS NULL';
    }
    
    $result = mysqli_query($con, $sql);
    $all_tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_tasks;
}


function get_tasks_list ($con, $show_complete) {
    $sql = 'SELECT *, Unix_timestamp(execution) AS execution_unix FROM tasks WHERE user_id=1';

    if (isset($_GET['project']) && $_GET['project'] !=='all') {

        $project_id = $_GET['project'];
        $sql .= ' AND project_id=' . $project_id  . ' ';

        if ($show_complete == 0) {
        $sql .= ' AND done IS NULL';
        }
    }

    else {
        header("HTTP/1.0 404 Not Found");
    }

    $result = mysqli_query($con, $sql);
    $tasks_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    return $tasks_list;
}

function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}

?>