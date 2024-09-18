<?php
    print_r($_GET);
    print_r($_POST);

    require "../database/Tasks.php";

    $act = isset($_POST['act']) ? $_POST['act'] : false;
    $id = isset($_POST['id']) ? $_POST['id'] : false;

    if($act && $id){
        $check = new Task();
        if($act=="checked"){
            $check = $check->unchecked($id);
        }
        else{
            $check = $check->checked($id);
        }
    }
    else{

    }

?>