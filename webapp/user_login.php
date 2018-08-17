<?php
require("./menu2.php");
?>

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

