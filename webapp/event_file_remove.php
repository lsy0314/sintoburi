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
$password  = $_POST['pass'];

echo ("<br>");
echo ("<br>");
//echo ("<li>파일 ID = '$file_id'</li>");
//echo ("<li>업로드 파일명 = '$name_orig'</li>");
//echo ("<li>저장된 파일명 = '$name_save'</li>");
echo ("<br><br>");

// Create db_connection
include('webapp_config.php');
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check db_connection
if (!$db_conn) {
    die("Connection failed: " . mysqli_db_connect_error());
}

// compare your password and database password.
// echo ("[DEBUG] select count(*) FROM $table_name_event WHERE file_id = '$file_id' and password = '$password' <br>");
$sql = "select count(*) FROM $table_name_event WHERE file_id = '$file_id' and password = '$password'";
$result_count=mysqli_query($db_conn, $sql);
$result_row=mysqli_fetch_row($result_count);
$total_row = $result_row[0];

//echo ("[DEBUG] matched count is $total_row .<br>");
//die ("[DEBUG] Let's do debugging");

// if $total_row is 0, do not remove audio file and db data.
if ($total_row <=0)
    echo ("<font color=red>죄송합니다.</font> 비밀번호가 틀립니다. 올바르게 비밀번호를 입력하여 주세요.");
else {
    // sql to delete a record
    $sql = "DELETE FROM $table_name_event WHERE file_id='$file_id'";
    
    if (mysqli_query($db_conn, $sql)) {
        echo "<font color=red><b>축하합니다.</font><b> 선택하신 이벤트 일정을 성공적으로 삭제되었습니다.";
    } else {
        echo "<font color=red><b>죄송합니다.</font><b> 선택하신 이벤트 일정을 삭제하지 못하였습니다." . mysqli_error($db_conn);
    }
    
    // get folder name from $name_save (e.g., 201807231430_a872sadj29w891092d.m4a)
   // $audio_folder = substr($name_save,0,8);
  //  echo ("<br>");
   // echo ("<br>");
   // echo ("이벤트 일정의 날짜 폴더명은 ".$event_folder."입니다.");
    
    // Remove audio files in the specified directory
   // unlink("audio/".$audio_folder."/".$name_save);
   // if (file_exists("audio/".$audio_folder."/".$name_save.".txt")){
    //    unlink("audio/".$audio_folder."/".$name_save.".txt");
   // }
    mysqli_close($db_conn);
}
?>

<br><br>
<a href="./event_file_list.php"><img src=./images/file-list.png alt="상점행사 관리 리스트로 이동하기" title="상점행사 관리 리스트로 이동하기" border=0 width=50 height=50></img></a>
</body>
</html>
