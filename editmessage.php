<?php
    include "connection.php";
    $id=$_GET["id"];
    $row=$pdo->query("SELECT * FROM `message` WHERE `id`=$id")->fetch();
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
    <div id="edit_modal" class="modal" style="display:block;">
        <div class="inner_modal">
            <div class="inner_modal_bar">
                <h2 class="m-auto">訪客留言 - 編輯</h2>
                <button class="btn-warning mr-3" onclick="exit()">回留言列表</button>
            </div>
            <form action="messageeditback.php" method="POST">
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">姓名</p>
                    <input class="form-control w-50" type="text" name="user" id="user" value="<?= $row['user'];?>" required>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0 ml-4">E-mail</p>
                    <input class="form-control w-50" type="text" name="email" id="email" value="<?= $row['email'];?>" pattern="(.*\..*@.*)|(.*@.*\.*)" placeholder="必須包含一個@和." required>
                    <input type="checkbox" name="h_email" value="顯示" <?php if($row["h_email"]==null){ echo "checked"; }?>>
                    <p class="m-0">顯示</p>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">電話</p>
                    <input class="form-control w-50" type="number" name="phone" pattern="([0-9]|-)+" value="<?= $row['phone'];?>" id="phone" placeholder="必須只包含數字和-" required>
                    <input type="checkbox" name="h_phone" value="顯示"<?php if(!isset($row["h_phone"])){ echo "checked"; }?>>
                    <p class="m-0">顯示</p>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">內容</p>
                    <textarea class="form-control w-50" name="description" id="description" required><?= $row['message'];?></textarea>
                </div>
                <input type="hidden" name="id" value="<?= $id?>">
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
    function menu(x){
        x.classList.toggle("change");
        document.getElementsByClassName("menu_box")[0].classList.toggle("change");
    }
    function exit(){
        location.href="message.php";
    }
    function resetForm(){
        document.querySelectorAll(".form-control").forEach(function(input){
            input.value=""; 
        })
    }
</script>