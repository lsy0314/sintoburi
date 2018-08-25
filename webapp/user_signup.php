<?php
require ("./menu2.php");
include('webapp_config.php');
$mysqli=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
?>
<br><br>
 <form action = "./user_signup_do.php" method="post">
 <div>
 <label for="id"> 아이디 </label>
 <input type="text" name="id"/>
 </div>
 <div>
 <label for="pw"> 암호  </label>
 <input type="text" name="pw"/>
 </div>
 <div>
 <label for="pwc"> 암호 재확인 </label>
 <input type="text" name="pwc"/>
 </div>
 
 <div>
 <label for="name"> 상점명 </label>
 <input type="text" name="name"/>
 </div>
 <div>
 <label for="email"> E-mail </label>
 <input type="text" name="email"/>
 </div>
<br>
 <div class="button">
 <input type="submit" value="submit">
 </div>
 </form>
</body>
</html>
