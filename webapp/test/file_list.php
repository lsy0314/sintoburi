
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>업로드 파일 목록</title>
</head>
<body>
<h3>음성 파일 업로드 화면</h3>
<table border="1">
<tr>
	<th>시작 시각</th>
	<th>상점명</th>
	<th>음성 내용</th>
</tr>
<?php
$db_conn = mysqli_connect("localhost", "testdbadm", "testdbadm", "testdb");
$query = "SELECT file_id, name_orig, name_save FROM upload_file ORDER BY reg_time DESC";
$stmt = mysqli_prepare($db_conn, $query);
$exec = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
  <td><?= $row['file_id'] ?></td>
  <td><a href="download.php?file_id=<?= $row['file_id'] ?>" target="_blank"><?= $row['name_orig'] ?></a></td>
  <td><?= $row['name_save'] ?></td>
</tr>
<?php
} 

mysqli_free_result($result); 
mysqli_stmt_close($stmt);
mysqli_close($db_conn);
?>
</table>
<a href="upload.php">업로드 페이지</a>
</body>
</html>
