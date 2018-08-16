<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<style type="text/css">
    .green option{ background-color:#0F0; }
    .mycolor option{ background-color:#AAAAAA; }
    select{
       width: 140px;
       height: 25px;
       color: gray;
     }
    select option { color: black; }
    select option:first-child { color:blue; }
</style>

<body bgcolor=gray text=#000000 link=#0000cc vlink=#551a8b alink=#ff0000>

<font size=2><b>Sintoburi </b>
<!--<select size=1 onchange="if(this.value) window.open(this.value);" class="mycolor"> //-->
<select size=1 onchange="if(this.value) parent.framebody.location=this.value;">
        <option value="./body_store.php" selected class=green>[ 상점주인 ]</option>
        <option value="./user_main.php">회원 관리</option>
        <option value="./audio_file_list.php">음성파일 관리</option>
        <option value="./event_file_list.php">이벤트 관리</option>
</select>
&nbsp;

<!--<select size=1 onchange="if(this.value) window.open(this.value);" class="mycolor"> //-->
<select size=1 onchange="if(this.value) parent.framebody.location=this.value;">
        <option value="./body_customer.php" selected>[  고객용 ]</option>
        <option value="./event_announce.php">상점 이벤트 알림</option>
</select>
&nbsp;

</font>
</body>
</html>

