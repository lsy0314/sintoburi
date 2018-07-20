<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: a program to display upload UI for users
// Date: Jul-06-2018
// License: Star License
//

?>

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
	}
	
	var ext = path.slice(path.indexOf(".") + 1).toLowerCase();
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
}
</script>
</head>
<body>
<form name="uploadForm" id="uploadForm" method="post" action="audio_upload_process.php" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
<div>
<br><br>
<font size=7  Color=purple> 음성 오디오 파일 업로드 화면</font>
<br><br><br>
<font size=5  Color=black>상점명 <INPUT TYPE=TEXT NAME=store STYLE="BACKGROUND-COLOR: YELLOW" SIZE=20 MAXLENGTH=20> <br><br> </font>
<font size=5  Color=black>시작 시간 <INPUT TYPE=TEXT NAME=time STYLE="BACKGROUND-COLOR: YELLOW" SIZE=12 MAXLENGTH=12> <br><br> </font>
<font size=5  Color=black>음성메세지 <INPUT TYPE=TEXT NAME=message STYLE="BACKGROUND-COLOR: YELLOW" SIZE=50 MAXLENGTH=50> <br><br> </font>
<label for="upfile"> </label>
<font size=5 color=black>음성파일 <input type="file" name="upfile" id="upfile" /></font>
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
<br><br>
<a href="./audio_file_list.php">음성 파일 리스트 메뉴로 이동하기</a>
</body>
</html>
