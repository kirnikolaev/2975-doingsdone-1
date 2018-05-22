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

?>