

<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<title> User main</title>
</head>
<body>

<style>
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 20%;
    background-color: gray;
    color: white;
    text-align: left;
}
</style>

<div class="footer">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>sintoburi</b></p>
</div>
<?php
session_start();

//require("./menu.php");

// if user does do log-in, go to login.html webapge.
if(!isset($_SESSION['id'])) {
    header('Location: ./user_login.php');
}
else{
    echo "<br><br>";
    echo "<b><font color=red>로그인 성공!!!</font></b><br>";
    echo "<br>";
    echo "<li>상점아이디: ".$_SESSION['id']."</li>";
    echo "<li>상점명: ".$_SESSION['name']."</li>";
    echo "<li>비밀번호: (<font color=white>".$_SESSION['password']."</font>)</li>";
    echo "<br><br>";
    echo "<a href=user_logout.php>로그아웃</a>";
}
?>
<meta name="viewport" content="width=device-width, user-scalable=no">
