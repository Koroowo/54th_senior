<?php
    error_reporting(0);
    include "connection.php";
    $usercode=$_POST["verify"];
    $hiddencode=$_POST["hiddencode"];
    if($usercode==$hiddencode){
        $username=$_POST["user"];
        $user=$pdo->query("SELECT * FROM `admin` WHERE `user`='$username'")->fetch();
        if($user["user"]){
            $id=$user["id"];
            $password=$_POST["password"];
            $user=$pdo->query("SELECT * FROM `admin` WHERE `password`='$password' AND `id`='$id'")->fetch();
            if($user["password"]){
                $_SESSION["firstverify"]="true";
                header("location:secondverify.php");
            }
        }else{
            echo "<script>alert('帳號/密碼登入失敗'); location.href='manage.php';</script>";
        }
    }else{
        echo "<script>alert('驗證碼輸入失敗'); location.href='manage.php';</script>";
    }
?>