<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>快樂旅遊網 - 管理</title>
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
    <div class="container">
        <div class="login_bar">
            <h2 class="m-0">網站管理</h2>
        </div>
        <div class="mx-auto text-center">
            <h3>登入</h3>
            <form action="manageback.php" method="POST">
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">帳號</p>
                    <input class="form-control w-50" type="text" name="user" id="user" required>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">密碼</p>
                    <input class="form-control w-50" type="text" name="password" id="password" required>
                </div>
                <div class="d-flex justify-content-center align-items-center p-2">
                    <p class="m-0">圖片驗證碼</p>
                    <input class="form-control w-25" type="text" name="verify" id="verify" required>
                </div>
                <div class="mx-auto d-flex w-25 justify-content-around align-items-center p-2">
                    <div class="bg-secondary p-2">
                        <p class="m-0 user-select-none text-white" id="code"></p>
                    </div>
                    <button class="btn-warning" type="button" onclick="code()">驗證碼重新產生</button>
                </div>
                <input type="hidden" name="hiddencode" id="hiddencode">
                <div class="mx-auto d-flex w-25 justify-content-around">
                    <button class="btn-success">送出</button>
                    <button class="btn-danger" type="button" onclick="reset()">重設</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    function code(){
        let ans=Math.floor(Math.random()*(9999-1111)+1)+1111;
        document.getElementById("hiddencode").value=ans;
        document.getElementById("code").textContent=ans;
    }
    code();
    function menu(x){
        x.classList.toggle("change");
        document.getElementsByClassName("menu_box")[0].classList.toggle("change");
    }
    function reset(){
        document.querySelectorAll(".form-control").forEach(function(input){
            input.value="";
        })
    }
</script>