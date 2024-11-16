<?php
    include "connection.php";
    $user=$_POST["user"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $description=$_POST["description"];
    $comment_num=$_POST["comment_num"];
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y/m/d H:i:s");
    $pdo->query("INSERT INTO `message`(`user`, `message`, `email`, `phone`, `add_date`,`change_date`,`comment_number`) VALUES ('$user','$description','$email','$phone','$time','$time','$comment_num')");
?>