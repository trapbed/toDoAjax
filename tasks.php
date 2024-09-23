        <?php
            require "database\Tasks.php";
            $tasks_class = new Task();

            if(isset($_POST['act'])){
                if( $_POST['act'] == 'create'){
                    $tasks_class->create_task($_SESSION['user_id'], $_POST['title'], $_POST['desc']);
                }
                else if($_POST['act'] == 'completed'){
                    $tasks_class->checked($_POST['id']);
                }
                else if($_POST['act'] == 'uncompleted'){
                    $tasks_class->unchecked($_POST['id']);
                }
                else if($_POST['act'] == 'delete'){
                    $tasks_class->delete_task($_POST['id_task']);
                }
                else if($_POST['act'] == 'edit'){
                    $tasks_class->edit_task($_POST['id_task'], $_POST['title'], $_POST['desc']);
                    echo "<script>
                        searching();
                    </script>";
                }
            }

            if(isset($_POST['search']) && $_POST['search']!="" && isset($_POST['select']) && $_POST['select']!=""  && isset($_POST['newest']) && $_POST['newest']!="" && isset($_POST['passed']) && $_POST['passed']!=""){
                // echo "aaaaa";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], $_POST['select'] == "" ? "false" :$_POST['select'], $_POST['newest'], $_POST['passed']);
            }
            else if(isset($_POST['search']) && $_POST['search'] !="" && isset($_POST['select']) && $_POST['select'] !="" && isset($_POST['newest']) && $_POST['newest'] !=""){
                // echo "bbbbb";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], $_POST['select'] == "" ? "false" :$_POST['select'], $_POST['newest'], "false");
            }
            else if(isset($_POST['search']) && $_POST['search'] !="" && isset($_POST['select']) && $_POST['select'] !="" && isset($_POST['passed']) && $_POST['passed'] !=""){
                // echo "ccccccccc";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], $_POST['select'] == "" ? "false" :$_POST['select'], "false", $_POST['passed']);

            }
            else if(isset($_POST['passed']) && $_POST['passed']!= "" && isset($_POST['select']) && $_POST['select']!= "" && isset($_POST['newest']) && $_POST['newest']!= ""){
                // echo "ddddd";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], "", $_POST['select'] == "" ? "false" :$_POST['select'], $_POST['newest'], $_POST['passed']);

            }
            else if(isset($_POST['search']) && $_POST['search'] != "" && isset($_POST['passed']) && $_POST['passed']!= "" && isset($_POST['newest']) && $_POST['newest']!= ""){
                // echo "eeeeeeeee";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], "false" , $_POST['newest'], $_POST['passed']);
            }
            else if(isset($_POST['search']) && $_POST['search']!= "" && isset($_POST['select']) && $_POST['select']!= ""){
                // echo "ffff";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], $_POST['select'] == "" ? "false" :$_POST["select"], "false", "false");

            }
            else if(isset($_POST['newest']) && $_POST['newest']!= "" && isset($_POST['select']) && $_POST['select']!= ""){
                // echo "ggggggg";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], "", $_POST['select'] == "" ? "false" :$_POST['select'], $_POST['newest'], "false");

            }
            else if(isset($_POST['passed']) && $_POST['passed']!= "" && isset($_POST['select']) && $_POST['select']!= ""){
                // echo "hhhhhhhh";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], "", $_POST['select'] == "" ? "false" :$_POST['select'], "false", $_POST['passed']);

            }
            else if(isset($_POST['search']) && $_POST['search']!= "" && isset($_POST['newest']) && $_POST['newest']!= ""){
                // echo "iiiiiiii";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], "false", $_POST['newest'], "false");

            }
            else if(isset($_POST['search']) && $_POST['search']!= "" && isset($_POST['passed']) && $_POST['passed']!= ""){
                // echo "jjjjjjjj";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], "false" , "false", $_POST['passed']);

            }
            else if(isset($_POST['newest']) && $_POST['newest']!= "" && isset($_POST['passed']) && $_POST['passed']!= ""){
                // echo "kkkkkkkkkk";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], "false", $_POST['newest'], $_POST['passed']);

            }
            else if(isset($_POST['search']) && $_POST['search']!= ""){
                // echo "llllllllll";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], "false", "false", "false");

            }
            else if(isset($_POST['select']) && $_POST['select']!= ""){
                // echo "mmmmmmmm";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], "", $_POST['select'], "false", "false");

            }
            else if(isset($_POST['newest']) && $_POST['newest']!= ""){
                // echo "nnnnnn";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], "", "false", $_POST['newest'], "false");

            }
            else if(isset($_POST['passed']) && $_POST['passed']!= ""){
                // echo "ooooooo";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'],"", "false", "false", $_POST['passed']);

            }
            else{
                // echo "ppppp";
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], "", "false", "false", "false");
            }
            
            if(isset($_POST['id_task'])){
                $oneTask = new Task();
                $oneTask = $oneTask->one_task($_POST['id_task']);
            }

            if(isset($_POST['act']) && $_POST['act'] == 'delete'){
                $tasks_class->delete_task($_POST['id_task']);
            }
            if(isset($_POST['act']) && $_POST['act'] == 'edit'){
                $tasks_class->edit_task($_POST['id_task'], $_POST['title'], $_POST['desc']);
                echo "<script>
                    search_before(".$_POST['search'].", ".$_POST['select'].");
                </script>";
            }
            
        ?>
        
        
        <div id="emptyTop"></div>
        <div id="notes">
            <?php
                // var_dump($_POST);
                // var_dump($_GET);
            ?>

               <?php if(count($tasks) > 0){ 
                    foreach($tasks as $task) { ?>

                    <div class="oneNote">
                        <div class="allinOneNote">
                            <div class="checkboxOneNote">
                                <form class="formCheck" action="" method="POST">
                                    <input 
                                        <?php
                                            if($task[4]=='0'){
                                        ?>
                                        onclick='completed(<?= $task[0]?>)'
                                        <?php
                                            }else{
                                        ?>
                                        onclick='uncompleted(<?= $task[0]?>)'
                                        <?php
                                            }
                                        ?>
                                    class="changeComplete checkedNote " type="checkbox" name="checkTask"  <?= $task[4] == '1' ? "checked" : "" ?>>
                                    <input type="hidden" name="act" value="<?= $task[4] == '1' ? "checked" : "unchecked" ?>" >
                                    <input type="hidden" name="id" value="<?= $task[0]?>">
                                </form>
                            </div>
                            <div class="titleNote <?= $task[4] == '1' ? 'checkedTaskDel' : ''?>">
                                <p><?= $task[2] ?></p>
                                <div class="btnsOneNote">
                                    <?php
                                        $search = isset($_POST['search'])?$_POST['search']:'';
                                        $select = isset($_POST['select'])?$_POST['select']:'';
                                    ?>
                                    <div onclick="editTask(<?=$task[0]?>)"><img src="images\pen.svg" alt=""></div>
                                    <div onclick="deleteTask(<?=$task[0]?>)"><img src="images\trash-svgrepo-com 1.svg" alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="oneNoteDesc">
                            <div class="emptyDesc"></div><span><?=$task[3]?></span>
                        </div>
                    </div>

                    <hr class="betweenNotes">
                    <?php }
                    }
                    else{?>

                    <div id="emptyTasks">
                        <img src="images\empty.svg" alt="" >
                        <p>Нет записей...</p>
                    </div>
        <?php
                }

        ?>

        </div>
    </div>
    <div id="backgroundNewTask">
        <div id="modalNewtask">
            <span id="modalTitle">Новая запись</span>
            <form id="modalForm" method="POST" onsubmit="createTask()">
                <input type="hidden" name="hiddenSearchNew" id="hiddenSearchNew">
                <input type="hidden" name="hiddenSelectNew" id="hiddenSelectNew">


                <input type="hidden" name="act" value="create">
                <input name="title" type="text" id="modalFormTitle" value="<?=isset($_GET['act']) ?  $_GET['name'] : ""?>" placeholder="Заголовок записи..." required>
                <textarea name="content" id="modalFormContent" placeholder="Содержание записи..." required></textarea>
            </form>
            <button id="modalLeftBtn" onclick="closeModalCreate()">Назад</button><input type="submit" id="modalRightBtn" value="Создать" form="modalForm">
        </div>
    </div>

    <div id="backgroundEditTask">
        <div id="modalNewtask">
            <span id="modalTitle">Редактировать</span>
            <?php
                $search = isset($_POST['search']) ? $_POST['search'] :'';
                $select = isset($_POST['select']) ? $_POST['select'] :'';
            ?>
            <form id="modalFormE" method="POST" >
                <input type="hidden" name="hiddenSearchEdit" id="hiddenSearchEdit" value="<?=isset($_POST['search'])?$_POST['search']:''?>">
                <input type="hidden" name="hiddenSelectEdit" id="hiddenSelectEdit" value="<?=isset($_POST['select'])?$_POST['select']:''?>">

                <!-- <input type="hidden" name="hiddenSearchEditS" id="hiddenSearchEditS" value="<?=$search?>">
                <input type="hidden" name="hiddenSelectEditS" id="hiddenSelectEditS" value="<?=$select?>"> -->


                <input type="hidden" name="id" id="modalFormIdE" value="<?= $oneTask[0] ?>">
                <input name="title" type="text" id="modalFormTitleE" value="<?= $oneTask[2]?>" placeholder="Заголовок записи...">
                <textarea name="content" id="modalFormContentE" placeholder="Содержание записи..."><?=$oneTask[3] ?></textarea>
            </form>
            <button id="modalLeftBtn" onclick="closeModalEdit()">Назад</button><button onclick="saveEdit(); return false;" type="submit" id="modalRightBtn"form="modalFormE">Ок</button>
        </div>
    </div>

    <div id="fixedBtn" onclick="seeWindowCreate()"><img src="images\Vector (2).svg" alt=""></div>

    <div id="toDos">
        
    </div>
<!-- 
    <div id="modalText">
        Не удалось создать задачу!
    </div> -->
    
    <script src="js\btns.js"></script>
    <script src="js\ajax.js"></script>