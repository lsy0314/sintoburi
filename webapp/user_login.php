<?php
require("./menu.php");
?>


<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no">
 <title>login page</title>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>
<br>
 <form method="post" action="./user_login_check.php">
 <div>
<br> <br> <br>
 <label for="id">아이디 </label>
 <input type="text" name="id"/>
 </div>
<br> <br>
 <div>
 <label for="pw">패스워드 </label>
 <input type="text" name="pw"/>
 </div>

 <br> 
 <div class="button">
 <button type="submit">로그인 </button>
 </div>
 </form>
 <button onclick="location.href='user_signup.html'"> 회원가입 </button>
</body>
</html>
