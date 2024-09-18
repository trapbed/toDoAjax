<?php
    session_start();

    if(isset($_SESSION['mess'])){
        echo "<script>
            alert('".$_SESSION['mess']."');
        </script>";
        unset($_SESSION['mess']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="mainIndex">
        <div id="imgNForm">
            <div id="leftImg">
                <img id="leftMan" src="images\leftMan.svg" alt="">
            </div>
            
            <div id="formRegAuth">
                <h1>Добро пожаловать</h1>
                <p>Создайте шаги для достижения целей</p>
                <form id="forms" action="/toDoListAjax/user/redirection.php" method="post">
                    <h6> <?= !isset($_GET['auth']) ? 'Регистрация':'Авторизация' ?></h6>
                    <label class="rowForms">Логин<input type="text" name="login" value="<?= isset($_SESSION['login']) ? $_SESSION['login'] : false?>"></label>
                    <label class="rowForms">Пароль<input type="password" name="pass" value="<?= isset($_SESSION['pass']) ? $_SESSION['pass'] : false?>"></label>
                    <input type="hidden" name="auth" value="<?= isset($_GET['auth']) ? 'true' : 'false' ?>">
                    <input type="submit" value="<?= !isset($_GET['auth']) ? 'Зарегистрироваться':'Войти' ?>" id="submit">
                    <p>Уже есть аккаунт? <a href="<?= !isset($_GET['auth']) ? '../toDoListAjax/index.php?auth=true' : '../toDoListAjax/index.php' ?> "> <?= !isset($_GET['auth']) ? 'Войдите':'Зарегистрируйтесь' ?></a></p>
                </form>
            </div>
            <div id="rightImg">
                <img id="rightGirl" src="images\rightGirl.svg" alt="">
            </div>
        </div>
    </div>
</body>
</html>