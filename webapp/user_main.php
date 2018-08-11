<?php
session_start();

require("./menu.php");

// if user does do log-in, go to login.html webapge.
if(!isset($_SESSION['id'])) {
    header('Location: ./user_login.php');
}
else{
    echo "<br><br>";
    echo "<b>로그인 성공!!!</b><br>";
    echo "<li>상점아이디: ".$_SESSION['id']."</li>";
    echo "<li>상점명: ".$_SESSION['name']."</li>";
    echo "<li>비밀번호: ".$_SESSION['password']."</li>";
    echo "<br><br>";
    echo "<a href=user_logout.php>로그아웃</a>";
}
?>
