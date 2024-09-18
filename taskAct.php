<?php
    require "database\Tasks.php";

    $tasks = new Task();
    var_dump($_POST);
    if($_POST['act'] == 'create'){
        $tasks->create_task($_SESSION['user_id'], $_POST['title'], $_POST['desc']);
    }
    else if($_POST['act'] == 'completed'){
        $tasks->checked($_POST['id']);
    }
    else if($_POST['act'] == 'uncompleted'){
        $tasks->unchecked($_POST['id']);
    }
    else if($_POST['act'] == 'delete'){
        $tasks->delete_task($_POST['id'], "");
    }
    else if($_POST['act'] == 'edit'){
    $tasks->edit_task($_POST['id_task'], $_POST['title'], $_POST['desc']);
    }
?>