<?php
    session_start();
    print_r($_POST);

    require "../database/User.php";

    $login = isset($_POST['login']) ? $_POST['login'] : false;
    $pass = isset($_POST['pass']) ? $_POST['pass'] : false;
    $_SESSION['login'] = isset($_POST['login']) ? $_POST['login'] : false;


    if(isset($_GET['act'])){
        if($_GET['act'] == 'logout'){
            unset($_SESSION['login']);
            unset($_SESSION['user_id']);
            $_SESSION['mess'] = "Вы вышли из аккаунта!";
            header('Location: /toDoListAjax/regAuth.php');
        }
    }
    else{
        if($pass && $login){
            if($_POST['auth'] == 'false'){
                $newUser = new User();
                $newUser->registration($login, $pass);
            }
            else{
                $user = new User();
                $user->authorization($login, $pass);
            }
        }
        else{
            $_SESSION['mess'] = 'Заполните все поля';
            if($_POST['auth'] == true){
                header('Location: ../regAuth.php?auth=true');
            }
            else{
                header('Location: ../index.php');
            }
        }

    }

    
    
?>