<?php
    require "database\Tasks.php";

    $tasks_class = new Task();
    var_dump($_POST);
    if(isset($_POST['act']) && $_POST['act'] == 'edit'){
        $tasks_class->edit_task($_POST['id_task'], $_POST['title'], $_POST['desc']);
    }
?>