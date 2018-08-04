<?php
include('webapp_config.php');
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$file_id  = $_REQUEST['file_id'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>업로드 오디오 파일 목록</title>
</head>
<body>

<br>
<br>
<a href="./audio_file_list.php"><img src=./images/file-list.png border=0 width=50 height=50></img></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<br>

<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: a detail view of file id
// Date: Aug-03-2018
// License: Star License
//

$query = "SELECT * FROM upload_file WHERE file_id = '$file_id'";
$stmt = mysqli_prepare($db_conn, $query);
$exec = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)) {
?>

<?php
// The statement is how to create a dialog with “yes” and “no” options before removing a audio file
// https://stackoverflow.com/questions/9334636/how-to-create-a-dialog-with-yes-and-no-options
?>

<table border="1">
<tr>
  <td bgcolor=green>삭제</td>
  <td><a href=audio_file_remove.php?file_id=<?= $row['file_id'] ?>&name_orig=<?= $row['name_orig'] ?>&name_save=<?= $row['name_save'] ?>>
       <img src=./images/remove.png border=0 height=20 width=20 onclick="return confirm('이 파일을 정말로 삭제하시겠습니까?')"></img>
      </a>
  </td>
</tr>
<tr>
  <td bgcolor=green>업로드 시각</td>
  <td><?=$row['reg_time'] ?>
</tr>
<tr>
  <td bgcolor=green>상점명</td>
  <td width=100 style="table-layout:fixed; word-break:break-all;"><?=$row['store_name'] ?></td>
</tr>
<tr>
  <td bgcolor=green>음성 내용</td>
  <td width=350 style="table-layout:fixed; word-break:break-all;"><?=$row['audio_msg'] ?></td>
</tr>
<tr>
  <td bgcolor=green>파일 ID</td> 
  <td><?= $row['file_id'] ?></td>
</tr>
<tr>
  <td bgcolor=green>업로드 파일명</td>
  <td width=500 style="table-layout:fixed; word-break:break-all;"><a href="audio_download.php?file_id=<?= $row['file_id'] ?>" target="_blank"><?= $row['name_orig'] ?></a></td>
</tr>
<tr>
  <td  bgcolor=green >저장된 파일명(*)</td>
  <td><?= $row['name_save'] ?></td>
</tr>
</table>

<?php
} 
mysqli_free_result($result); 
mysqli_stmt_close($stmt);
mysqli_close($db_conn);
?>
<br>
<br>

</font>
</td>
</tr>
</table>
<br><br>
</body>
</html>
