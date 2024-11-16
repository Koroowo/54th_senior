<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>快樂旅遊網 - 客房訂餐</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="rwd.css">
</head>
<body>
    <div class="top_header mx-auto">
        <h1 style="margin:0px;" class="header" onclick="location.href='message.php'">快樂旅遊網</h1>
        <a class="hide" href="message.php">訪客留言</a>
        <a class="hide" href="userroom.php">訪客訂房</a>
        <a class="hide" href="userfood.php">訪客訂餐</a>
        <a class="hide" href="manage.php">網站管理</a>
        <div class="menu_container" onclick="menu(this)">
            <div class="menu_bar1"></div>
            <div class="menu_bar2"></div>
            <div class="menu_bar3"></div>
        </div>
    </div>
    <div class="menu_box">
        <div class="menu_item">
            <a class="menu_item" href="message.php">訪客留言</a>
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
    <div style="overflow-x:auto;">
        <div class="grid mx-auto mt-3">
            <div class="p-2 mx-auto">
                <img src="picture.jpg" class="image" id="1" alt="">
            </div>
            <div class="p-2 mx-auto">
                <img src="picture.jpg" class="image" id="2" alt="">
            </div>
            <div class="p-2 mx-auto">
                <img src="picture2.jpg" class="image" id="3" alt="">
            </div>
            <div class="p-2 mx-auto">
                <img src="picture.jpg" class="image" id="4" alt="">
            </div>
            <div class="p-2 mx-auto">
                <img src="picture.jpg" class="image" id="5" alt="">
            </div>
            <div class="p-2 mx-auto">
                <img src="picture2.jpg" class="image" id="6" alt="">
            </div>
            <div class="p-2 mx-auto">
                <img src="picture.jpg" class="image" id="7" alt="">
            </div>
            <div class="p-2 mx-auto">
                <img src="picture.jpg" class="image" id="8" alt="">
            </div>
        </div>
    </div>
    <div class="image_outer_modal" id="modal">
        <div class="image_modal overflow-auto">
            <div class="image_modal_bar justify-content-end">
                <button class="btn-danger" id="quit">X</button>
            </div>
            <img class="box_image" id="box_image" style="opacity:1;" src="" alt="">
            <div class="d-flex mx-auto justify-content-center">
                <button class="btn btn-info m-3" id="down"><</button>
                <button class="btn btn-info m-3" id="revert">o</button>
                <button class="btn btn-info m-3" id="up">></button>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    document.getElementById("quit").addEventListener("click",function(){
        document.getElementById("modal").style.display="none";
    });
    document.querySelectorAll(".btn-info").forEach(function(btns){
        let id=btns.id;
        let image=document.getElementById("box_image");
        btns.addEventListener("click",function(){
            switch(id){
                case "down":
                    image.style.opacity=Math.max(0,parseFloat(image.style.opacity) - 0.1);
                    break;
                case "revert":
                    image.style.opacity=1;
                    break;
                case "up":
                    image.style.opacity=Math.min(1,parseFloat(image.style.opacity) + 0.1);
                    break;
            }
        })
    });
    function menu(x){
        x.classList.toggle("change");
        document.getElementsByClassName("menu_box")[0].classList.toggle("change");
    }
    document.querySelectorAll(".image").forEach(function(image){
        image.addEventListener("click",function(){
            let id=image.id;
            toggleimg(id);
        });
    });
    function toggleimg(image){
        document.getElementById("modal").style.display="block";
        let imagesrc=document.getElementById(image).src;
        document.getElementById("box_image").src=imagesrc;
    }
</script>