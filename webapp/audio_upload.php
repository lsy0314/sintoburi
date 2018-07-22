<!DOCTYPE html>
<html lang="ko">
<head>
<title>상점 주인용: 오디오 파일 업로드</title>
<script type="text/javascript">
function formSubmit(f) {
	var extArray = new Array('wav','mp3','m4a');
	var path = document.getElementById("upfile").value;
	if(path == "") {
		alert("파일을 선택해 주세요.");
		return false;
	}
	var pos = path.indexOf(".");
	if(pos < 0) {
		alert("확장자가 없는파일 입니다.");
		return false;
	}	var ext = path.slice(path.indexOf(".") + 1).toLowerCase();
	var checkExt = false;
	for(var i = 0; i < extArray.length; i++) {
		if(ext == extArray[i]) {
			checkExt = true;
			break;
		}
	}

	if(checkExt == false) {
		alert("업로드 할 수 없는 파일 확장자 입니다.");
	    return false;
	}
	
	return true;
}</script>
</head>
<body>
<form name="uploadForm" id="uploadForm" method="post" action="audio_upload_process.php" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
<div>
<br><br>
<font size=7  Color=purple> 음성 오디오 파일 업로드 화면</font>
<br><br><br>
<font size=5  Color=black>상점명 <INPUT TYPE=TEXT NAME=store STYLE="BACKGROUND-COLOR: YELLOW" SIZE=20 MAXLENGTH=20> <br><br> </font>
<!--
<font size=5  Color=black>시작 시간 <INPUT TYPE=TEXT NAME=time STYLE="BACKGROUND-COLOR: YELLOW" SIZE=12 MAXLENGTH=12><br><br> </font>
//-->
<?php
date_default_timezone_set("Asia/Seoul");
$input_year   = date("Y");
$input_month  = date("m");
$input_day    = date("d");
$input_hour   = date("H");
$input_minute = floor(date("i")/10)*10;

?>
<font size=5  Color=black>시작 시간  </font>
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
<select name="start_hour"STYLE="BACKGROUND-COLOR: YELLOW">
            <option value="<?=$input_hour ?>" STYLE="BACKGROUND-COLOR: YELLOW" selected(초기 선택된 항목)><?=$input_hour ?></option>
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
            <option value="00" STYLE="BACKGROUND-COLOR: YELLOW">00</option>
</select>시 
<select name="start_minute"STYLE="BACKGROUND-COLOR: YELLOW">
            <option value="<?=$input_minute ?>" STYLE="BACKGROUND-COLOR: YELLOW" selected(초기 선택된 항목)><?=$input_minute ?></option>
            <option value="00" STYLE="BACKGROUND-COLOR: YELLOW">00</option>
            <option value="10" STYLE="BACKGROUND-COLOR: YELLOW">10</option>
            <option value="20" STYLE="BACKGROUND-COLOR: YELLOW">20</option>
            <option value="30" STYLE="BACKGROUND-COLOR: YELLOW">30</option>
            <option value="40" STYLE="BACKGROUND-COLOR: YELLOW">40</option>
            <option value="50" STYLE="BACKGROUND-COLOR: YELLOW">50</option>
</select>분
<br>
(입력방법: 오디오 플레이 시작시간은 10분 단위로 입력하여 주세요.)       



<br>
<br>
<font size=5  Color=black>음성메세지 <INPUT TYPE=TEXT NAME=message STYLE="BACKGROUND-COLOR: YELLOW" SIZE=50 MAXLENGTH=50> <br><br> </font>
<label for="upfile"> </label><font size=5 color=black>음성파일 <input type="file" name="upfile" id="upfile" /></font>
</div>
<br>
모바일폰에 "<b>삼성 음성 녹음</b>" 또는 "<b>곰레코더</b>"를 설치후에<br>
*.m4a으로 녹음한 음성파일을 업로드 하여 주세요. 
<br>
<br>
<br>
<input type="submit" value="등록하기" />
</form>
<br><br>
<br><br> 
<br><br>
<a href="./audio_file_list.php"><img src=./images/file-list.png alt="오디오 파일리스트로 이동하기" title="오디오 파일리스트로 이동하기" border=0 width=50 height=50></img></a>

</body>
</html>
