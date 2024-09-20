<?php
    require "Connect.php";
    session_start();
    class Task extends Connect{
        public function all_tasks($user_id, $search, $select, $newest, $passed){
            // echo $user_id, $search, $select, $newest, $passed;
            if($search!="false" && $select!="false" && $newest!="false" && $passed!="false"){
                // echo 1;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select' ORDER BY `tasks`.`created_at` $newest, `tasks`.`is_completed` $passed";
            }
            else if($select!="false" && $search!="false" && $newest!="false"){
                // echo 2;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select' ORDER BY `tasks`.`created_at` $newest";

            }
            else if($select!="false" && $search!="false" && $passed!="false"){
                // echo 3;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select' ORDER BY  `tasks`.`is_completed` $passed";

            }
            else if($select!="false" && $newest!="false" && $passed!="false"){
                // echo 4;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select' ORDER BY `tasks`.`created_at` $newest, `tasks`.`is_completed` $passed";

            }
            else if($search!="false" && $newest!="false" && $passed!="false"){
                // echo 5;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' ORDER BY `tasks`.`created_at` $newest, `tasks`.`is_completed` $passed";
                
            }
            else if($select!="false" && $search!="false"){
                // echo 6;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select' ";
                
            }
            else if($select!="false" && $newest!="false"){
                // echo 7;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select' ORDER BY `tasks`.`created_at` $newest";
                
            }
            else if($select!="false" && $passed!="false"){
                // echo 8;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select' ORDER BY `tasks`.`is_completed` $passed";
                
            }
            else if($search!="false" && $newest!="false"){
                // echo 9;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' ORDER BY `tasks`.`created_at` $newest";
                
            }
            else if($search!="false" && $passed!="false"){
                // echo 10;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' ORDER BY `tasks`.`is_completed` $passed";
                
            }
            else if($newest!="false" && $passed!="false"){
                // echo 11;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' ORDER BY `tasks`.`created_at` $newest, `tasks`.`is_completed` $passed";

            }
            else if($select!="false"){
                // echo 12;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' AND is_completed='$select'";

            }
            else if($search!="false"){
                // echo 13;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' ";
                
            }
            else if($newest!="false"){
                // echo 14;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1'  ORDER BY `tasks`.`created_at` $newest";
                
            }
            else if($passed!="false"){
                // echo 15;
                $query_t = "SELECT * FROM tasks WHERE title LIKE '%$search%' AND user_id=$user_id AND exist= '1' ORDER BY `tasks`.`is_completed` $passed";
                
            }
            
            else{
                // echo 16;
                $query_t = "SELECT * FROM tasks WHERE user_id=$user_id AND exist= '1'";
                // $query = mysqli_fetch_all(mysqli_query($this->conn, $query_t));
            }
            // echo $query_t;
            $query = mysqli_fetch_all(mysqli_query($this->conn, $query_t));
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
            $query= mysqli_query($this->conn, "UPDATE `tasks` SET `is_completed` = '1', `updated_at` = NOW() WHERE `tasks`.`id` = $id;");
            // if(mysqli_query($this->conn, "UPDATE `tasks` SET `is_completed` = '1', `updated_at` = NOW() WHERE `tasks`.`id` = $id;")){
            //     $_SESSION['mess'] = 'Задача выполнена!';
            // }
            // else{
            //     $_SESSION['mess'] = 'Выполните эту задачу!';
            // }
            // header('Location:../toDos.php');
        }

        public function unchecked($id){
            $query = mysqli_query($this->conn, "UPDATE `tasks` SET `is_completed` = '0', `updated_at` = NOW() WHERE `tasks`.`id` = $id;");
            // if(mysqli_query($this->conn, "UPDATE `tasks` SET `is_completed` = '0', `updated_at` = NOW() WHERE `tasks`.`id` = $id;")){
            //     $_SESSION['mess'] = 'Выполните эту задачу!';
            // }
            // else{
            //     $_SESSION['mess'] = 'Задача все  еще выполнена!';
            // }
        }

        // if($query == true){
            //     $_SESSION['mess'] = "Задача создана!";
            // }
            // else{
            //     $_SESSION['mess'] = "Не удалось создать задачу!";
            // }
        public function create_task($user, $title, $content){
            $query = mysqli_query($this->conn, "INSERT INTO `tasks` (`user_id`, `title`, `description`, `is_completed`, `created_at`, `updated_at`) VALUES ($user, '$title', '$content', '0', NOW(), NOW());");
            
        }

        public function edit_task($id_task, $title, $desc){
            $query = mysqli_query($this->conn, "UPDATE `tasks` SET `title` = '$title', `description` = '$desc', `updated_at` = NOW() WHERE `tasks`.`id` = $id_task;");
        }
        public function delete_task($id){
            $query = mysqli_query($this->conn,"UPDATE `tasks` SET `exist` = '0',  `updated_at` = NOW() WHERE `tasks`.`id` = $id");
            // if(mysqli_query($this->conn, $query)){
            //     $_SESSION['mess'] = "Задача $name удалена";
            // }
            // else{
            //     $_SESSION['mess'] = "Задача $name еще существует";
            // }
            // header('Location: ../toDos.php');
        }

        
    }
?>