<?php
    require "Connect.php";
    session_start();
    class Task extends Connect{
        public function all_tasks($user_id, $search, $select){
            if($select != "false" && $search == "false"){
                $query = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM tasks WHERE user_id=$user_id AND exist= '1' AND is_completed='$select'"));
            }
            else if($search != "false" && $select == "false"){
                $query = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1'"));
            }
            else if($select!="false" && $search != "false"){
                $query = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select'"));
            }
            else{
                $query = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM tasks WHERE user_id=$user_id AND exist= '1'"));
            }
            return $query;
        }

        public function one_task($id){
            $query = mysqli_fetch_array(mysqli_query($this->conn, "SELECT * FROM `tasks` WHERE id=$id"));
            return $query;
        }

        // public function search_task($user_id, $search){
        //     $query = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM `tasks` WHERE title LIKE '%$search%' AND user_id=$user_id"));
        //     return $query;
        // }

        public function tasksWithSort( $user_id, $sort, $search){
            // echo $_POST['taskSort'];
            $query = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id= $user_id AND is_completed='$sort' AND exist='1'"));
            return $query;
        }

        public function checked($id){
            if(mysqli_query($this->conn, "UPDATE `tasks` SET `is_completed` = '1', `updated_at` = NOW() WHERE `tasks`.`id` = $id;")){
                $_SESSION['mess'] = 'Задача выполнена!';
            }
            else{
                $_SESSION['mess'] = 'Выполните эту задачу!';
            }
            // header('Location:../toDos.php');
        }

        public function unchecked($id){
            if(mysqli_query($this->conn, "UPDATE `tasks` SET `is_completed` = '0', `updated_at` = NOW() WHERE `tasks`.`id` = $id;")){
                $_SESSION['mess'] = 'Выполните эту задачу!';
            }
            else{
                $_SESSION['mess'] = 'Задача все  еще выполнена!';
            }
        }

        public function create_task($user, $title, $content){
            $query = "INSERT INTO `tasks` (`user_id`, `title`, `description`, `is_completed`, `created_at`, `updated_at`) VALUES ($user, '$title', '$content', '0', NOW(), NOW());";
            if(mysqli_query($this->conn, $query)){
                $_SESSION['mess'] = "Задача создана!";
            }
            else{
                $_SESSION['mess'] = "Не удалось создать задачу!";
            }
        }

        public function edit_task($id_task, $title, $desc){
            $query = mysqli_query($this->conn, "UPDATE `tasks` SET `title` = '$title', `description` = '$desc', `updated_at` = NOW() WHERE `tasks`.`id` = $id_task;");
        }
        public function delete_task($id, $name){
            $query = "UPDATE `tasks` SET `exist` = '0',  `updated_at` = NOW() WHERE `tasks`.`id` = $id";
            if(mysqli_query($this->conn, $query)){
                $_SESSION['mess'] = "Задача $name удалена";
            }
            else{
                $_SESSION['mess'] = "Задача $name еще существует";
            }
            header('Location: ../toDos.php');
        }

        
    }
?>