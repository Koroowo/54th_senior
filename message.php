<!-- 
    新增留言的版面跟燈箱一樣
-->
<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>快樂旅遊網 - 首頁</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top_header">
        <h1 style="margin:0px;" onclick="location.href='message.php'">快樂旅遊網</h1>
        <a href="message.php">訪客留言</a>
        <a href="userroom.php">訪客訂房</a>
        <a href="userfood.php">訪客訂餐</a>
        <a href="manage.php">網站管理</a>
        <div class="menu_container" onclick="menu(this)">
            <div class="menu_bar1"></div>
            <div class="menu_bar2"></div>
            <div class="menu_bar3"></div>
        </div>
    </div>
    <div class="menu_box">
        <div class="menu_item">
            <a href="message.php">訪客留言</a>
        </div>
        <div class="menu_item">
            <a class="menu_item" href="userroom.php">訪客訂房</a>
        </div>
        <div class="menu_item">
            <a class="menu_item" href="userfood.php">訪客訂餐</a>
        </div>
        <div class="menu_item">
            <a class="menu_item" href="manage.php">網站管理</a>
        </div>
    </div>
    <div class="container overflow-auto">
        <div class="table_top">
            <div class="table_text">
                <h2>訪客留言列表</h2>
            </div>
            <button class="btn-success" onclick="add()">新增留言</button>
        </div>
        <table class="table table-dark">
            <?php
                $rows=$pdo->query("SELECT * FROM `message` ORDER BY `change_date` DESC")->fetchAll();
                foreach($rows as $row){
            ?>
                <tr class="text-center">
                    <td class="col-2"><?= $row["user"]?></td>
                    <td class="col-7"><?php if($row['del_date']==null){ echo $row["message"];}?></td>
                    <td class="col-3 align-middle" rowspan="3">
                        <?php 
                            if($row["del_date"]!=null){
                                echo "<h2>已刪除</h2>";
                            }else{
                        ?>
                        留言序號:
                        <input type="text" id="<?= $row["id"]?>">
                        <div class="d-flex justify-content-center">
                            <button class="edit btn-warning mr-2 mt-2" data-id="<?= $row['id']?>" data-num="<?= $row['comment_number']?>">編輯</button>
                            <button class="del btn-danger ml-2 mt-2" data-id="<?= $row['id']?>" data-num="<?= $row['comment_number']?>">刪除</button>
                        </div>
                        <?php }; ?>
                    </td>
                </tr>
                <tr class="text-center">
                    <td class="col-9" colspan="2">發表於 <?= $row["add_date"]?><?php if($row["del_date"]!=null){ echo " , 刪除於 ".$row["del_date"];}else if($row["edit_date"]!=null){ echo " , 修改於 ".$row["edit_date"];}?></td>
                </tr>
                <?php
                    if(($row['del_date']==null) && ($row['h_email']==null || $row['h_phone']==null)){
                ?>
                <tr class="text-center">
                    <td class="col-9" colspan="2">
                        <?php if($row['h_email']==null){ echo "E-mail: ".$row['email'] ;} if($row['h_phone']==null){ echo " 電話: ".$row['phone']; }?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            <?php
                }
            ?>
        </table>
    </div>
    <div id="add_modal" class="modal">
        <div class="inner_modal">
            <div class="inner_modal_bar">
                <h2 class="m-auto">訪客留言 - 新增</h2>
                <button class="btn-warning mr-3" onclick="exit()">回留言列表</button>
            </div>
            <form action="messageback.php" method="POST">
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">姓名</p>
                    <input class="form-control w-50" type="text" name="user" id="user" required>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">E-mail</p>
                    <input class="form-control w-50" type="text" name="email" id="email" pattern="(.*\..*@.*)|(.*@.*\.*)" placeholder="必須包含一個@和." required>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">電話</p>
                    <input class="form-control w-50" type="number" name="phone" pattern="([0-9]|-)+" id="phone" placeholder="必須只包含數字和-" required>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">內容</p>
                    <textarea class="form-control w-50" name="description" id="description" required></textarea>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">留言序號</p>
                    <input class="form-control w-50" type="text" name="comment_num" id="comment_num" pattern="[a-z0-9]{3}" placeholder="必須為3位由數字及小寫英文字母" required>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-around w-50">
                        <button class="btn-success">送出</button>
                        <button class="btn-danger" type="button" onclick="resetForm()">重設</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    let edit_modal=document.getElementById("edit_modal");
    let add_modal=document.getElementById("add_modal");
    function menu(x){
        x.classList.toggle("change");
        document.getElementsByClassName("menu_box")[0].classList.toggle("change");
    }
    document.querySelectorAll(".edit").forEach(function(btns){
        btns.onclick=function(){
            if(document.getElementById(btns.dataset.id).value==btns.dataset.num){
                location.href="editmessage.php?id="+btns.dataset.id;
            }else{
                alert("留言序號錯誤");
            }
        }
    })
    document.querySelectorAll(".del").forEach(function(btns){
        btns.onclick=function(){
            if(document.getElementById(btns.dataset.id).value==btns.dataset.num){
                if(window.confirm("是否刪除該留言?")==true){
                    location.href="deletecomment.php?id="+btns.dataset.id;
                }
            }else{
                alert("留言序號錯誤");
            }
        }
    })
    function add(){
        add_modal.style.display="block";
    }
    function exit(){
        add_modal.style.display="none";
    }
    function resetForm(){
        document.querySelectorAll(".form-control").forEach(function(input){
            input.value=""; 
        })
    }
</script>