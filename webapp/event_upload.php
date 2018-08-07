<!DOCTYPE html>
<html lang="ko">
<head>
<title>고객용:이벤트 일정 업로드</title>
</head>
<body>
<form name="uploadForm" id="uploadForm" method="post" action="event_upload_process.php" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
<div>
<a href="./event_file_list.php"><img src=./images/file-list.png alt="이벤트 일정 리스트로 이동하기" title="이벤트 일정 리스트로 이동하기" border=0 width=50 height=50></img></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./event_upload.php"><img src=./images/upload.png border=0 width=50 height=50></img></a>
<br>
<font size=7  Color=purple> 이벤트 일정 업로드 화면</font>
<br><br><br>
<font size=5  Color=black><img src=images/item.png border=0 height=25 width=25 />상점명<font color=red>*</font> <INPUT TYPE=TEXT NAME=store STYLE="BACKGROUND-COLOR: YELLOW" SIZE=20 MAXLENGTH=20> <br><br> </font>
<!--
<font size=5  Color=black>시작 시간 <INPUT TYPE=TEXT NAME=time STYLE="BACKGROUND-COLOR: YELLOW" SIZE=12 MAXLENGTH=12><br><br> </font>
//-->
<?php
date_default_timezone_set("Asia/Seoul");
$input_year   = date("Y");
$input_month  = date("m");
$input_day    = date("d");
//$input_hour   = date("H");
//$input_minute = floor(date("i")/10)*10;
// if a minute value is 0, let's modify the value with "00".
//if ($input_minute ==  "0")
//    $input_minute = "00";

?>
<font size=5  Color=black><img src=images/item.png border=0 height=25 width=25 />시작 시간  </font>
<select name="start_year" STYLE="BACKGROUND-COLOR: YELLOW">
            <option value="<?=$input_year ?>" STYLE="BACKGROUND-COLOR: YELLOW" selected(초기 선택된 항목)><?=$input_year ?></option>
            <option value="2018" STYLE="BACKGROUND-COLOR: YELLOW">2018</option>
            <option value="2019" STYLE="BACKGROUND-COLOR: YELLOW">2019</option>
            <option value="2020" STYLE="BACKGROUND-COLOR: YELLOW">2020</option>
            <option value="2021" STYLE="BACKGROUND-COLOR: YELLOW">2021</option>
</select>년 
<select name="start_month"STYLE="BACKGROUND-COLOR: YELLOW">
            <option value="<?=$input_month ?>" STYLE="BACKGROUND-COLOR: YELLOW" selected(초기 선택된 항목)><?=$input_month ?></option>
            <option value="01" STYLE="BACKGROUND-COLOR: YELLOW">01</option>
            <option value="02" STYLE="BACKGROUND-COLOR: YELLOW">02</option>
            <option value="03" STYLE="BACKGROUND-COLOR: YELLOW">03</option>
            <option value="04" STYLE="BACKGROUND-COLOR: YELLOW">04</option>
            <option value="05" STYLE="BACKGROUND-COLOR: YELLOW">05</option>
            <option value="06" STYLE="BACKGROUND-COLOR: YELLOW">06</option>
            <option value="07" STYLE="BACKGROUND-COLOR: YELLOW">07</option>
            <option value="08" STYLE="BACKGROUND-COLOR: YELLOW">08</option>
            <option value="09" STYLE="BACKGROUND-COLOR: YELLOW">09</option>
            <option value="10" STYLE="BACKGROUND-COLOR: YELLOW">10</option>
            <option value="11" STYLE="BACKGROUND-COLOR: YELLOW">11</option>
            <option value="12" STYLE="BACKGROUND-COLOR: YELLOW">12</option>

</select>월
<select name="start_day"STYLE="BACKGROUND-COLOR: YELLOW">
            <option value="<?=$input_day ?>" selected(초기 선택된 항목)><?=$input_day ?></option>
            <option value="01" STYLE="BACKGROUND-COLOR: YELLOW">01</option>
            <option value="02" STYLE="BACKGROUND-COLOR: YELLOW">02</option>
            <option value="03" STYLE="BACKGROUND-COLOR: YELLOW">03</option>
            <option value="04" STYLE="BACKGROUND-COLOR: YELLOW">04</option>
            <option value="05" STYLE="BACKGROUND-COLOR: YELLOW">05</option>
            <option value="06" STYLE="BACKGROUND-COLOR: YELLOW">06</option>
            <option value="07" STYLE="BACKGROUND-COLOR: YELLOW">07</option>
            <option value="08" STYLE="BACKGROUND-COLOR: YELLOW">08</option>
            <option value="09" STYLE="BACKGROUND-COLOR: YELLOW">09</option>
            <option value="10" STYLE="BACKGROUND-COLOR: YELLOW">10</option>
            <option value="11" STYLE="BACKGROUND-COLOR: YELLOW">11</option>
            <option value="12" STYLE="BACKGROUND-COLOR: YELLOW">12</option>
            <option value="10" STYLE="BACKGROUND-COLOR: YELLOW">10</option>
            <option value="11" STYLE="BACKGROUND-COLOR: YELLOW">11</option>
            <option value="12" STYLE="BACKGROUND-COLOR: YELLOW">12</option>
            <option value="13" STYLE="BACKGROUND-COLOR: YELLOW">13</option>
            <option value="14" STYLE="BACKGROUND-COLOR: YELLOW">14</option>
            <option value="15" STYLE="BACKGROUND-COLOR: YELLOW">15</option>
            <option value="16" STYLE="BACKGROUND-COLOR: YELLOW">16</option>
            <option value="17" STYLE="BACKGROUND-COLOR: YELLOW">17</option>
            <option value="18" STYLE="BACKGROUND-COLOR: YELLOW">18</option>
            <option value="19" STYLE="BACKGROUND-COLOR: YELLOW">19</option>
            <option value="20" STYLE="BACKGROUND-COLOR: YELLOW">20</option>
            <option value="21" STYLE="BACKGROUND-COLOR: YELLOW">21</option>
            <option value="22" STYLE="BACKGROUND-COLOR: YELLOW">22</option>
            <option value="23" STYLE="BACKGROUND-COLOR: YELLOW">23</option>
            <option value="24" STYLE="BACKGROUND-COLOR: YELLOW">24</option>
            <option value="25" STYLE="BACKGROUND-COLOR: YELLOW">25</option>
            <option value="26" STYLE="BACKGROUND-COLOR: YELLOW">26</option>
            <option value="27" STYLE="BACKGROUND-COLOR: YELLOW">27</option>
            <option value="28" STYLE="BACKGROUND-COLOR: YELLOW">28</option>
            <option value="29" STYLE="BACKGROUND-COLOR: YELLOW">29</option>
            <option value="30" STYLE="BACKGROUND-COLOR: YELLOW">30</option>
            <option value="31" STYLE="BACKGROUND-COLOR: YELLOW">31</option>
</select>일


<br><br>
<font size=5  Color=black><img src=images/item.png border=0 height=25 width=25 />입력 내용 <INPUT TYPE=TEXT NAME=message STYLE="BACKGROUND-COLOR: YELLOW" SIZE=60 MAXLENGTH=60><br><br>

</font>
<font size=5  Color=black><img src=images/item.png border=0 height=25 width=25 />비밀번호  <INPUT TYPE=TEXT NAME=password VALUE="1234" STYLE="BACKGROUND-COLOR: YELLOW" SIZE=30 MAXLENGTH=30>
</font>
<br>
<font color=blue>
(비밀번호를 입력하지 않으면 기본값인 1234가 적용됩니다.)<br><br>
</font>
<br>
<br>
<br>
<input type="submit" value="등록하기" />
</form>

</body>
</html>

