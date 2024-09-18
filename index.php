<?php
    // print_r($_GET);
    // var_dump($_POST);
    
    require "../toDoListAjax/database/Tasks.php";

    

    session_start();

    if(isset($_SESSION['mess'])){
        echo "<script>
            alert('".$_SESSION['mess']."');
        </script>";
        unset($_SESSION['mess']);
    }

    if(!isset($_SESSION['login']) || !isset($_SESSION['user_id'])){
        $_SESSION['mess'] = "Для того, что бы создавать и просматривать записи нужно авторизоваться!";
        unset($_SESSION['mess']);
        header("Location: regAuth.php");
    }
    
    $tasks = new Task();

    // if(isset($_POST['taskSort']) && $_POST['taskSort'] !=''){
    //     $tasks = $tasks->tasksWithSort( $_SESSION['user_id'], $_POST['taskSort'], isset($_POST['searchTask']) ? $_POST['searchTask'] : "");
    // }
    // else{
    //     $tasks = $tasks->all_tasks($_SESSION['user_id']);
    // }
    // var_dump( $_POST['taskSort']== "1");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заметки</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js\jquery-3.7.1.min.js"></script>
    <script>
        
        $.ajax({
            type : "POST",
            url: "tasks.php",
            data: "id="+ <?=$_SESSION['user_id']?>,
            success: function input(response){
                $('#toDos').html(response);
            }
        })
        
        function select(){
            let data = {
                search: $('#searchHeader').val(),
                select: $("#selectHeader").val(),
            }
            $.ajax({
                method : "POST",
                url: "tasks.php",
                data: data,
                success: function sele(response){
                    $('#toDos').html(response);
                }
            })
        }

        function searching(){
            let data = {
                search: $('#searchHeader').val(),
                select: $("#selectHeader").val(),
            }
            $.ajax({
                type : "POST",
                url: "tasks.php",
                data: data,
                success: function search(response){
                    $('#toDos').html(response);
                }
            })
        };

        
        // function edit(){
        //     $.ajax({
        //         type : "POST",
        //         url: "tasks.php",
        //         data: "edit="+$('.edit').attr('edit-item'),
        //         success: function edit(edit){
        //             $('#toDos').html(edit);
        //         }
        //     })
        // }
        function deleteTask(id){
            const data = {
                id: id,
                act: 'delete',
                };
            $.ajax({
                type : "POST",
                url: "taskAct.php",
                data: data,
                success: function deleteTask(response){
                    $('#toDos').html(response);
                    
                }
            }).then(
                $.ajax({
                    type : "POST",
                    url: "tasks.php",
                    data: "id="+ <?=$_SESSION['user_id']?>,
                    success: function input(response){
                        $('#toDos').html(response);
                    }
                })
            )
        }

        function seeWindowCreate(){
            $("#backgroundNewTask").css("display", "flex");   
        }

        function closeModalCreate(){
            $("#backgroundNewTask").css("display", "none");
        }
        
        function editTask(index){
            const data = {
                id_task: index,
                act: 'oneTask',
                };
            $.ajax({
                type : "POST",
                url: "tasks.php",
                data: data,
                success: function edit(edit){
                    $('#toDos').html(edit);
                }
            }).then(function form(){
                $("#backgroundEditTask").css("display", "flex");

            })
            
        }

        function closeModalEdit(){
            $("#backgroundEditTask").css("display", "none");
        }

        function saveEdit(){
            const data ={
                act: "edit",
                id_task: $("#modalFormIdE").val(),
                title: $("#modalFormTitleE").val(),
                desc: $("#modalFormContentE").val(),
            }
            $.ajax({
                type : "POST",
                url: "taskAct.php",
                data: data,
                success: function edit(edit){
                    $('#toDos').html(edit);
                    
                }
            })
        }

        function createTask(){
            const data = {
                act: "create",
                title: $("#modalFormTitle").val(),
                desc: $("#modalFormContent").val(),
                };
            $.ajax({
                type : "POST",
                url: "taskAct.php",
                data: data,
                success: function edit(edit){
                    
                }
            })
        }

        // function darkTheme(){
        //     $("body").addClass("darkBG");
        // }

        function completed(id){
            // document.write(id);
            const data = {
                act: "completed",
                id: id,
                search: $('#searchHeader').val(),
                select: $("#selectHeader").val(),
                };
            $.ajax({
                type : "POST",
                url: "taskAct.php",
                data: data,
                success: function edit(response){
                    // $('#toDos').html(response);
                }
            }).then(
                $.ajax({
                    type : "POST",
                    url: "tasks.php",
                    data: "id="+ <?=$_SESSION['user_id']?>,
                    success: function input(response){
                        $('#toDos').html(response);
                    }
                })
            )
        }


        function uncompleted(id){
            // document.write(id);
            const data = {
                act: "uncompleted",
                id: id,
                search: $('#searchHeader').val(),
                select: $("#selectHeader").val(),
                };
            $.ajax({
                type : "POST",
                url: "taskAct.php",
                data: data,
                success: function edit(response){
                    // $('#toDos').html(response);
                }
            }).then(
                $.ajax({
                    type : "POST",
                    url: "tasks.php",
                    data: "id="+ <?=$_SESSION['user_id']?>,
                    success: function input(response){
                        $('#toDos').html(response);
                    }
                })
            )
        }
        
        

        // function seeWindowEdit(){
        //     $.ajax({
        //         type : "POST",
        //         url: "tasks.php",
        //         data: "windowEdit="+$('.edit').attr('data-item'),
        //         success: function edit(edit){
        //             $('#toDos').html(edit);
        //             console.log($('.edit').attr('data-item'));
        //         }
        //     })
        // }
        
    </script>
</head>
<body>
<?php
   if(isset($_GET['act']) && $_GET['act'] == 'edit'){
    $tasks=$tasks->one_task($_GET['idTask']); 
?>

<?php
    }
?>
    
    <div id="mainPageDiv">
        <div id="header">
            <div id="inHeader">
                <h1 id="title">
                    Список дел
                    <?php
                        if(isset($_SESSION['login'])){
                    ?>
                    <div>
                        <span><?=$_SESSION['login']?></span>
                        <a href="user\redirection.php?act=logout"><img src="images\sign-out.png" alt=""></a>
                    </div>
                    <?php
                        }
                    ?>
                </h1>
                <div id="formTheme">
                    <form  id="formHeader">
                        <input oninput="searching()" type="text" name="searchTask" placeholder="Запись..." id="searchHeader" value="<?= isset($_POST['searchTask']) ? $_POST['searchTask'] : '' ?>">
                        <select onchange="select()" name="selectHeader" id="selectHeader">
                            <option value="" >ВСЕ</option>
                            <option value="1" >✓</option>
                            <option value="0" >-</option>
                        </select>
                        
                        <button id="colorBtnHeader">
                            <img src="images/Vector (1).svg" alt="">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="toDos">
        
        </div>
        
        
        <?php
            
        ?>
        
        <script src="js\jquery-3.7.1.min.js"></script>    