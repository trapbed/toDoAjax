<?php
    
    session_start();
    require "Connect.php";

    class User extends Connect{
        public function registration($login, $pass){ 
            if(mb_strlen($login) < 6 || mb_strlen($pass) < 6){
                $_SESSION['mess'] = 'Длинна логина и пароля не должна быть меньше 6 символов';
                header('Location: ../regAuth.php');
            }
            else{
                $check_exist = "SELECT * FROM users WHERE username='$login'";
                if(mysqli_num_rows(mysqli_query($this->conn, $check_exist)) != 1){
                    $pass = password_hash($pass, PASSWORD_BCRYPT);
                    $add = "INSERT INTO `users`(`username`, `password_hash`) VALUES ('$login', '$pass')";
                    echo $add;
                    if(mysqli_query($this->conn, $add)){
                        $_SESSION['user_id'] = mysqli_insert_id($this->conn);
                        $_SESSION['mess'] = 'Вы успешно зарегистрировались!';
                        header('Location: ../index.php');
                    }
                    else{
                        $_SESSION['mess'] = 'Не удалось зарегистрироваться!';
                        header('Location: ../regAuth.php');
                    }
                }
                else{
                    $_SESSION['mess'] = 'У вас уже есть аккаунт, войдите!';
                    header('Location: ../regAuth.php?auth=true');
                }

            }
        }

        public function authorization($login, $pass){
            $check_exist = "SELECT * FROM users WHERE username='$login'";
            if(mysqli_num_rows(mysqli_query($this->conn, $check_exist))>0){
                $hashed_password = mysqli_fetch_array(mysqli_query($this->conn, $check_exist))[2];
                // echo $hashed_password;
                if(password_verify($pass, $hashed_password)){
                    $_SESSION['user_id'] = mysqli_fetch_array(mysqli_query($this->conn, $check_exist))[0];
                    $_SESSION['mess'] = 'Вы успешно вошли в аккаунт!';
                    header('Location:../index.php');
                }
                else{
                    $_SESSION['mess'] = "Пароль введен не верно. Попробуйте снова!";
                    header('Location: ../regAuth.php?auth=true');
                }

            }
            else{
                $_SESSION['mess'] = "Такого пользователя нет! Загеристрируйтесь!";
                header('Location: ../regAuth.php');
            }
            // header('Location: ../index.php?auth=true');
        }
    }
?>