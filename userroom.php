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
    <?php
        $year=(isset($_GET["year"])?$_GET["year"]:2024);
        $month=(isset($_GET["month"])?$_GET["month"]:12);
    ?>
    <div class="calender_container">
        <div class="calender_bar">
            <button class="btn" onclick="location.href='userroom.php?year=<?= $month-1<1?$year-1:$year ?>&month=<?= $month-1<1?12:$month-1 ?>'">前一個月<<</button>
            <div class="d-flex">
                <h3><?= $year?>&nbsp;</h3>
                <h3><?= $month?>月</h3>
            </div>
            <button class="btn" onclick="location.href='userroom.php?year=<?= $month+1>12?$year+1:$year ?>&month=<?= $month+1>12?1:$month+1 ?>'">>>下一個月</button>
        </div>
        <div class="calender">
            <div class="calender_top_div">
                <h4 style="margin:0px;" class="mx-auto">日</h4>
            </div>
            <div class="calender_top_div">
                <h4 style="margin:0px;" class="mx-auto">一</h4>
            </div>
            <div class="calender_top_div">
                <h4 style="margin:0px;" class="mx-auto">二</h4>
            </div>
            <div class="calender_top_div">
                <h4 style="margin:0px;" class="mx-auto">三</h4>
            </div>
            <div class="calender_top_div">
                <h4 style="margin:0px;" class="mx-auto">四</h4>
            </div>
            <div class="calender_top_div">
                <h4 style="margin:0px;" class="mx-auto">五</h4>
            </div>
            <div class="calender_top_div">
                <h4 style="margin:0px;" class="mx-auto" >六</h4>
            </div>
            <?php
                $firstday=date("w",strtotime("$year-$month-1"));
                $totaldays=date("t",strtotime("$year-$month-1"));
                $date=1;
                for($i=1;$i<=42;$i++){
                    $norooms=[];
                    if($firstday<$i && $totaldays>=$date){
                        $allrooms=[1,2,3,4,5,6,7,8];
                        $ocupyrooms=$pdo->query("SELECT * FROM `userroom` WHERE `year`=$year AND `month`=$month AND `firstday`<=$date AND $date<=`lastday`")->fetchAll();
                        foreach($ocupyrooms as $ocupyroom){
                            $delroom=intval(str_replace("Room0","",$ocupyroom["roomno"]));
                            unset($allrooms[$delroom]);
                            array_push($norooms,$delroom);
                        }
                        $allroomsnum=count($allrooms);
                        $roomdate=$year.'-'.$month.'-'.$date;
                        echo "<div class='calender_div calender_div_true' data-num='$allroomsnum' data-date='$roomdate' data-left='".implode(",",$allrooms)."' data-del='".implode(",",$norooms)."' id='$date'>
                            <h4 style='margin:0px;'>$date</h4>
                            <p style='margin:0px;'>$5,000</p>
                            <p style='margin:0px;'>$allroomsnum 間</p>
                        </div>";
                        $date=$date+1;
                    }else{
                        echo "<div class='calender_div'></div>";
                    }
                }
            ?>
        </div>
        <div class="d-flex mt-3">
            <h4 style="margin:0px;">訂房間數</h4>
            <select id="select_num">
                <option value=''>選擇房間數</option>
            </select>
        </div>
        <div class="d-flex mt-3">
            <h4 style="margin:0px;">入住天數</h4>
            <input type="text" id="days" disabled>
        </div>
        <div class="d-flex mt-3">
            <h4 style="margin:0px;">入住日期</h4>
            <input type="text" id="startday" disabled>
            <h4 style="margin: 0px;">到</h4>
            <input type="text" id="endday" disabled>
        </div>
        <div class="d-flex mt-3">
            <h4 style="margin:0px;">房號</h4>
            <input type="text" disabled>
            <button>自動產生房號</button>
            <button>選擇房號</button>
        </div>
        <div class="d-flex mt-3">
            <button>確定訂房</button>
            <button onclick="window.location.reload();">取消</button>
        </div>
    </div>
</body>
</html>
<script>
    function menu(x){
        x.classList.toggle("change");
        document.getElementsByClassName("menu_box")[0].classList.toggle("change");
    }
    let startday;
    let endday;
    let roomnum=8;
    let currentdiv;
    let leftroomnum=8;
    let leftroom=[1,2,3,4,5,6,7,8];
    let select_num=document.getElementById("select_num");
    let days=document.getElementById("days");
    document.querySelectorAll(".calender_div_true").forEach(function(div){  
        div.addEventListener("click",function(){
            let clickid=parseInt(div.id);
            if(startday==null && endday==null){
                startday=clickid;
                endday=clickid;
            }else if(endday==startday){
                if(startday<=clickid){
                    endday=clickid;
                }
            }
            for(i=startday;i<=endday;i++){
                currentdiv=document.getElementById(i);
                currentdiv.classList.add("calender_selected");
                let currentdelrooms=div.dataset.del.split(",");
                for(j=0;j<currentdelrooms.length;j++){
                    let currentdelroom=currentdelrooms[j];
                    console.log(leftroom.includes(currentdelroom.toString()));
                    if(leftroom.includes(currentdelroom.toString())){
                        leftroom.splice(parseInt(currentdelroom),1);
                        console.log(leftroom);
                    }
                }
                let currentleftroom=div.dataset.left.split(",");
                if(leftroomnum > currentleftroom.length){
                    leftroomnum=currentleftroom.length;
                }
                delroom=div.dataset.del.split(",");
            }
            days.value=endday-startday+1+" 天";
            let starttime=document.getElementById(startday).dataset.date;
            let endtime=document.getElementById(endday).dataset.date;
            document.getElementById("startday").value=starttime;
            document.getElementById("endday").value=endtime;
            rooms(leftroom);
        });
    });
    function rooms(totalrooms){
        select_num.innerHTML = "<option value=''>選擇房間數</option>";
        for (let i=1;i<=totalrooms;i++) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            select_num.appendChild(option);
        }
    }
</script>