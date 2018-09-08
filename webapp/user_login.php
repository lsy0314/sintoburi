<?php
require("./menu2.php");
include('webapp_config.php');
$mysqli=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
?>
<img src=./images/carrot-login.gif width=240 height=100 border=0></img>
<br>
 <form method="post" action="./user_login_check.php">
 <div>
 <label for="id">아이디 </label>&nbsp;&nbsp;
 <input type="text" name="id"/>
 </div>
<br>
 <div>
 <label for="pw">패스워드 </label>
 <input type="password" name="pw"/>
 </div>

 <br> 
 <div class="button">
 <button type="submit">로그인 </button>
 </div>
 </form>
<br>
 <button onclick="location.href='user_signup.php'"> 회원가입 </button>
<?php
include('./information_footer.php');
?>
</body>
</html>

