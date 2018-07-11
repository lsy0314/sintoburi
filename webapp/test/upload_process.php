<!DOCTYPE html>
<html lang="ko">
<head>
<title>파일 업로드</title>
<script type="text/javascript">
function formSubmit(f) {
	var extArray = new Array('hwp','xls','doc','xlsx','docx','pdf','jpg','gif','png','txt','ppt','pptx');
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
<form name="uploadForm" id="uploadForm" method="post" action="upload_process.php" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
<div>
<label for="upfile">첨부파일</label>
<input type="file" name="upfile" id="upfile" />
</div>
<input type="submit" value="업로드" />
</form>
<a href="javascript:history.go(-1);">이전 페이지</a>
</body>
</html>
