<html>
<body>
<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: a program to remove audio file and database data
// Date: Jul-06-2018
// License: Star License
//

// $_GET retrieves variables from the querystring, or your URL.>
// $_REQUEST is a merging of $_GET and $_POST where $_POST overrides $_GET.
// Good to use $_REQUEST on self refrential forms for validations.

$file_id   = $_REQUEST['file_id'];
$name_orig = $_REQUEST['name_orig'];
$name_save = $_REQUEST['name_save'];

echo ("<br>");
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
    echo "<font color=red><b>축하합니다.</font><b> 선택하신 음성파일을 성공적으로 삭제되었습니다.";
} else {
    echo "<font color=red><b>죄송합니다.</font><b> 선택하신 음성파일을 삭제하지 못하였습니다." . mysqli_error($db_conn);
}

// get folder name from $name_save (e.g., 201807231430_a872sadj29w891092d.m4a)
$audio_folder = substr($name_save,0,8);
echo ("<br>");
echo ("<br>");
echo ("오디오 파일의 폴더명은 ".$audio_folder."입니다.");

// Remove audito file in the specified directory
unlink("audio/".$audio_folder."/".$name_save);

mysqli_close($db_conn);
?>
<br><br>
<a href="./audio_file_list.php"><img src=./images/file-list.png alt="오디오 파일리스트로 이동하기" title="오디오 파일리스트로 이동하기" border=0 width=50 height=50></img></a>
</body>
</html>
