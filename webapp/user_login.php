<?php
require("./menu2.php");
include('webapp_config.php');
$mysqli=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
?>
<style>
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    height: 20%;
    width: 100%;
    background-color: gray;
    color: white;
    text-align: left;
}
</style>

<div class="footer">
  <p><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>sintoburi</b></p>
</div>

<br><br>
 <form method="post" action="./user_login_check.php">
 <div>
 <label for="id">아이디 </label>
 <input type="text" name="id"/>
 </div>
<br> <br>
 <div>
 <label for="pw">패스워드 </label>
 <input type="password" name="pw"/>
 </div>

 <br> 
 <div class="button">
 <button type="submit">로그인 </button>
 </div>
 </form>
 <button onclick="location.href='user_signup.php'"> 회원가입 </button>
</body>
</html>

