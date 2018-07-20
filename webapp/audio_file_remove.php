<html>
<body>
<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: a program to remove audio file and database data
// Date: Jul-06-2018
// License: Star License
//

$file_id = $_REQUEST['file_id'];
$name_orig = $_REQUEST['name_orig'];
$name_save = $_REQUEST['name_save'];

echo ("<br>");
echo ("<li>파일 ID = '$file_id'</li>");
echo ("<li>업로드 파일명 = '$name_orig'</li>");
echo ("<li>저장된 파일명 = '$name_save'</li>");
echo ("<br><br>");

// Create db_connection
include('webapp_config.php');
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check db_connection
if (!$db_conn) {
    die("Connection failed: " . mysqli_db_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM upload_file WHERE file_id='$file_id'";

if (mysqli_query($db_conn, $sql)) {
    echo "축하합니다. 선택하신 음성파일을 성공적으로 삭제되었습니다.";
} else {
    echo "죄송합니다. 선택하신 음성파일을 삭제하지 못하였습니다." . mysqli_error($db_conn);
}
// Remove audito file in the specified directory
unlink("audio/".$name_save);

mysqli_close($db_conn);
?>
<br><br>
<a href="./audio_file_list.php">음성 파일 리스트 화면으로 이동하기</a>
</body>
</html>
