<?php
date_default_timezone_set("Asia/Seoul");
$t=time();
$curr_time = date("YmdHi",$t);
$curr_time = substr_replace($curr_time, "", -1)."0";
echo $curr_time . "<br><br>";
?>

