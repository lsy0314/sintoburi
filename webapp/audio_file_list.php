
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>업로드 오디오 파일 목록</title>
</head>
<body>
<font size=5 color=blue>신토불이: 음성 파일 리스트 화면</font>
<br>
<br>
<a href="./audio_file_list.php"><img src=./images/file-list.png border=0 width=50 height=50></img></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./audio_upload.php"><img src=./images/upload.png border=0 width=50 height=50></img></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./audio/?C=N;O=D"><img src=./images/audio-folder.png border=0 width=50 height=50></img></a>
<br>

<table border="1">
<tr bgcolor=yellow>
	<th>삭제</th>
	<th>업로드 시각</th>
	<th>상점명</th>
<!--	<th>음성 내용</th> //-->
<!--	<th>파일 ID</th>   //-->
	<th>업로드 파일명</th>
	<th>저장된 파일명(*)</th>
</tr>
<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: a program to display store information
// Date: Jul-06-2018
// License: Star License
//
include('webapp_config.php');
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$query = "SELECT file_id, name_orig, name_save, reg_time, store_name, audio_msg FROM upload_file ORDER BY name_save DESC";
$stmt = mysqli_prepare($db_conn, $query);
$exec = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)) {
?>

<?php
// The statement is how to create a dialog with “yes” and “no” options before removing a audio file
// https://stackoverflow.com/questions/9334636/how-to-create-a-dialog-with-yes-and-no-options
// <img src=./images/remove.png border=0 height=20 width=20 onclick="return confirm('이 파일을 정말로 삭제하시겠습니까?')"></img>
?>

<tr>
  <td><a href=audio_file_remove.php?file_id=<?= $row['file_id'] ?>&name_orig=<?= $row['name_orig'] ?>&name_save=<?= $row['name_save'] ?>>
       <img src=./images/remove.png border=0 height=20 width=20></img>
  </td>
  <td><?=$row['reg_time'] ?></td>
  <td><?=$row['store_name'] ?></td>
<!--  <td><?=$row['audio_msg'] ?></td>  //-->
<!--  <td><?= $row['file_id'] ?></td>   //-->
  <td><a href="audio_download.php?file_id=<?= $row['file_id'] ?>" target="_blank"><?= $row['name_orig'] ?></a></td>
  <td><?= $row['name_save'] ?></td>
</tr>

<?php
} 

mysqli_free_result($result); 
mysqli_stmt_close($stmt);
mysqli_close($db_conn);
?>
</table>
<br>
<br>
</body>
</html>
