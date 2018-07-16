
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>업로드 오디오 파일 목록</title>
</head>
<body>
<font size=5 color=blue>음성 파일 리스트 화면</font>
<table border="1">
<tr bgcolor=yellow>
	<th>삭제</th>
	<th>업로드 시각</th>
	<th>상점명</th>
	<th>음성 내용</th>
	<th>파일 ID</th>
	<th>기존 오디오 파일</th>
	<th>저장된 오디오 파일</th>
</tr>
<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: a program to display store information
// Date: Jul-06-2018
// License: Star License
//
$db_conn = mysqli_connect("localhost", "root", "ggghhh03", "sbdb");
$query = "SELECT file_id, name_orig, name_save, reg_time, store_name, audio_msg FROM upload_file ORDER BY reg_time DESC";
$stmt = mysqli_prepare($db_conn, $query);
$exec = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
  <td><a href=audio_file_remove.php?file_id=<?= $row['file_id'] ?>&name_save=<?= $row['name_save'] ?>>Remove</td>
  <td><?=$row['reg_time'] ?></td>
  <td><?=$row['store_name'] ?></td>
  <td><?=$row['audio_msg'] ?></td>
  <td><?= $row['file_id'] ?></td>
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
<a href="audio_upload.php">업로드 페이지</a>
<br>
<a href="./audio">오디오 파일 리스트</a>
</body>
</html>
