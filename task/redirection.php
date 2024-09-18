<?php
    require "../database/Tasks.php";
    session_start();

    $tasks = new Task();

    // DELETE & EDIT
    if(isset($_GET['idTask'])){
        
        $taskD = new Task();
        $taskD = $taskD->delete_task($_GET['idTask'], $_GET['name']);
               
    }
    else if(isset($_POST['act'])){
        if($_POST['act'] == 'create'){
            if(mb_strlen($_POST['title'])>0 && mb_strlen($_POST['content'])>0){
                $create_task = new Task();
                $create_task = $create_task->create_task($_SESSION['user_id'], $_POST['title'], $_POST['content']);
            }
            else{
                $_SESSION['mess'] = "Заполните все поля!";
                $_SESSION['title'] = $_POST['title'];
                $_SESSION['content'] = $_POST['content'];
                header('Location: toDos.php ');
            }
        }
        if($_POST['act']=='create'){
            if(mb_strlen($_POST['title'])>0 && mb_strlen($_POST['content'])>0){
                $tasks = new Task();
                $tasks = $tasks->edit_task($_POST['id_task'], $_POST['title'], $_POST['content']);
            }
            else{
                $_SESSION['mess'] = "Заполните все поля!";
                $_SESSION['title'] = $_POST['title'];
                $_SESSION['content'] = $_POST['content'];
                header('Location: toDos.php ');
            }
        }
    }
    else if(isset($_POST['taskSort']) && $_POST['taskSort'] !=''){
        $tasks = $tasks->tasksWithSort( $_SESSION['user_id'], $_POST['taskSort'], isset($_POST['searchTask']) ? $_POST['searchTask'] : "");
    }
    else if(isset($_POST['search'])){
        $tasks = $tasks->search_task($_POST['search']);
    }
    else{
        $tasks = $tasks->all_tasks($_SESSION['user_id'], isset($_POST['searchTask']) ? $_POST['searchTask'] : "");
    }

    
    
?>