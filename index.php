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
</body>
</html>
<script>
    function menu(x){
        x.classList.toggle("change");
        document.getElementsByClassName("menu_box")[0].classList.toggle("change");
    }
</script>