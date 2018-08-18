<?php
session_start();
require("./menu2.php");

$id=$_POST['id'];
$pw=$_POST['pw'];

$mysqli=mysqli_connect("localhost","root","ggghhh03","sbdb");
mysqli_query($mysqli, "SET NAMES utf8");
$check="SELECT * FROM store_info WHERE id='$id'";
$result=$mysqli->query($check); 

if($result->num_rows==1){
    $row=$result->fetch_array(MYSQLI_ASSOC); //하나의 열을 배열로 가져오기
   
    if($row['password']==$pw){ //MYSQLI_ASSOC 필드명으로 첨자 가능
    //로그인 성공 시 세션 변수 만들기
    $_SESSION['id']=$id;
    $_SESSION['name']=$row['name'];
    $_SESSION['password']=$row['password'];
   
       if(isset($_SESSION['id'])) //세션 변수가 참일 때
       {
       header('Location: ./user_main.php'); //로그인 성공 시 페이지 이동
       }
       else{
       echo "<br><br> <font color=red> 죄송합니다. 세션 정보들을 저장하는 작업을 실패하였습니다.</font>";
       } 
    }
    else{
       echo "<br><br> <font color=red> 죄송합니다. 아이디 또는 암호를 잘못 입력하신것 같습니다.</font>";
    }
}
else{
 echo "<br><br> <font color=red> 죄송합니다. 아이디 또는 암호를 잘못 입력하신것 같습니다.</font>";
}
?>
