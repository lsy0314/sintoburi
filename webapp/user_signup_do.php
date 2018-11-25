<?php
require("./menu2.php");
include('webapp_config.php');
$mysqli=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
mysqli_query($mysqli, "SET NAMES utf8");
?>

<?php
$id=$_POST['id'];
$pw=$_POST['pw'];
$pwc=$_POST['pwc'];
$name=$_POST['name'];
$email=$_POST['email'];

if($pw!=$pwc) //비밀번호와 비밀번호 확인 문자열이 맞지 않을 경우
{
    echo "비밀번호와 비밀번호 확인이 서로 다릅니다.";
    echo "<a href=user_signup.php>back page</a>";
    exit();
}

if($id==NULL || $pw==NULL || $name==NULL || $email==NULL) //
{
    echo "빈 칸을 모두 채워주세요";
    echo "<a href=user_signup.php>back page</a>";
    exit();
}

include('webapp_config.php');

$mysqli=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
mysqli_query($mysqli, "SET NAMES utf8");

$check="SELECT *from store_info WHERE id='$id'";
$result=$mysqli->query($check);

if($result->num_rows==1)
{
    echo "중복된 아이디입니다.";
    echo "<br><br>";
    echo "<a href=user_signup.php>back page</a>";
    exit();
}
$signup=mysqli_query($mysqli,"INSERT INTO store_info (id, password, name, email) 
VALUES ('$id','$pw','$name','$email')");
if($signup){
    echo "회원가입을 성공적으로 등록하였습니다.";
    echo "<br>";
    echo "<a href=user_login.php>로그인 화면</a>";
}
?>
</body>
</html>
