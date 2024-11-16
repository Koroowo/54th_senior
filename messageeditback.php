<?php
    include "connection.php";
    $user=$_POST["user"];
    $email=$_POST["email"];
    if(!isset($_POST["h_email"])){
        $h_email=true;
    }else{
        $h_email=null;
    }
    $phone=$_POST["phone"];
    if(!isset($_POST["h_phone"])){
        $h_phone=true;
    }else{
        $h_phone=null;
    }
    $description=$_POST["description"];
    $id=$_POST["id"];
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y/m/d H:i:s");
    $pdo->query("UPDATE `message` SET `user`='$user',`message`='$description',`email`='$email',`phone`='$phone',`h_email`='$h_email',`h_phone`='$h_phone',`edit_date`='$time',`change_date`='$time' WHERE `id`='$id'");
    header("location:message.php");
?>