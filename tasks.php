        <?php
            require "database\Tasks.php";
            $tasks_class = new Task();
            if(isset($_POST['search']) && isset($_POST['select'])  ){
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], $_POST['select']);
            }
            else if(isset($_POST['select'])){
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], "false", $_POST['select']);
            }
            else if(isset($_POST['search'])){
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], $_POST['search'], "false");
            }
            else{
                $tasks = $tasks_class->all_tasks($_SESSION['user_id'], "false", "false");
            }

            if(isset($_POST['id_task'])){
                $oneTask = new Task();
                $oneTask = $oneTask->one_task($_POST['id_task']);
            }

            if(isset($_POST['act']) && $_POST['act'] == 'delete'){
                $tasks_class->delete_task($_POST['id'], "");
            }
            if(isset($_POST['act']) && $_POST['act'] == 'edit'){
                $tasks_class->edit_task($_POST['id_task'], $_POST['title'], $_POST['desc']);
            }
            
        ?>
        
        
        <div id="emptyTop"></div>
        <div id="notes">
            <?php
                var_dump($_POST);
                // var_dump($_GET);
            ?>

               <?php if(count($tasks) > 0){ 
                    foreach($tasks as $task) { ?>

                    <div class="oneNote">

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
                                <div onclick="editTask(<?=$task[0]?>)"><img src="images\pen.svg" alt=""></div>
                                <div onclick="deleteTask(<?=$task[0]?>)"><img src="images\trash-svgrepo-com 1.svg" alt=""></div>
                            </div>
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
            <form id="modalForm" onsubmit="createTask()">
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
            <form id="modalFormE" onsubmit="saveEdit()">
                <input type="hidden" name="id" id="modalFormIdE" value="<?= $oneTask[0] ?>">
                <input name="title" type="text" id="modalFormTitleE" value="<?= $oneTask[2]?>" placeholder="Заголовок записи...">
                <textarea name="content" id="modalFormContentE" placeholder="Содержание записи..."><?=$oneTask[3] ?></textarea>
            </form>
            <button id="modalLeftBtn" onclick="closeModalEdit()">Назад</button><input  type="submit" id="modalRightBtn" value="Ок" form="modalFormE">
        </div>
    </div>

    <div id="fixedBtn" onclick="seeWindowCreate()"><img src="images\Vector (2).svg" alt=""></div>

    <div id="toDos">
        
    </div>
    
    <script src="js\btns.js"></script>
    <script src="js\ajax.js"></script>