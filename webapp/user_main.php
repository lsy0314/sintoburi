<?php
session_start();

// if user does do log-in, go to login.html webapge.
if(!isset($_SESSION['id']))
{
   header('Location: ./user_login.html');
}
echo "<br><br>";
echo "홈(로그인 성공)";
echo "<br><br>";
echo "<a href=user_logout.php>로그아웃</a>";

?>
