<?php
    include "connection.php";
    $data_id=$_GET["id"];
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y/m/d H:i:s");
    $pdo->query("UPDATE `message` SET `del_date`='$time',`change_date`='$time' WHERE `id`='$data_id'");
    header("location:message.php");
?>