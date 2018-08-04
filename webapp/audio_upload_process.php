<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>파일 업로드</title>
</head>
<body>
<?php

// Author: Hyunjoon Lim, Suyeon Lim
// Title: a program to upload an audio file that user want to upload
// Date: Jul-06-2018
// License: Star License
//

include('webapp_config.php');

// change last character to 0.
// For example, convert 201805051635 to 201805051630
date_default_timezone_set("Asia/Seoul");


// This line is used for just debugging.
//$t=time();
//$curr_time = date("YmdHi",$t);
//$curr_time = substr_replace($curr_time, "", -1)."0";

$store_name = $_POST['store'];
$audio_msg = $_POST['message']; 
$time_start_year = $_POST['start_year'];
$time_start_month = $_POST['start_month'];
$time_start_day = $_POST['start_day'];
$time_start_hour = $_POST['start_hour'];
$time_start_minute = $_POST['start_minute'];
$time= $time_start_year . $time_start_month . $time_start_day . $time_start_hour . $time_start_minute;
$time_date_folder = $time_start_year . $time_start_month . $time_start_day;

// ----------------------calculate the number of audio data

// connect to mysql database
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$count = 0; 
// https://dev.mysql.com/doc/refman/8.0/en/pattern-matching.html
// Pattern Matching: Use the LIKE or NOT LIKE comparison operators 
$query = "SELECT file_id, name_orig, name_save, reg_time, store_name, audio_msg FROM upload_file WHERE name_save LIKE '".$time."%' ORDER BY reg_time DESC";
$stmt = mysqli_prepare($db_conn, $query);
$exec = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)) {
    $count= $count+1;
} 
mysqli_free_result($result); 
mysqli_stmt_close($stmt);
mysqli_close($db_conn);
//echo "current time: $time , audio data count: $count . <br>";
//die("just test.");


// if the number of audio data exceeds the declared number, do not upload audio file and stop this program.
if ($count > $max_audio_file)
    die("<br><br><font color = red>죄송합니다.</font> 오디오 파일을 업로드 할 수 없습니다.<br> 동일한 시간에 음성파일을 $max_audio_file개 까지 입력할 수 있기 때문입니다.<br>현재 등록된 음성파일 개수가 $count 입니다.<br><br> <br> <a href=./audio_file_list.php>오디오 파일 리스트로 이동하기</a>");
 
// ------------------------- upload audio file to mysql database and audio folder
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {
    $file = $_FILES['upfile'];
    $upload_directory = 'audio/'.$time_date_folder.'/';

    // create a date folder if it does not exists.
    if (!file_exists($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }
    $ext_str = "wav,mp3,m4a";
    $allowed_extensions = explode(',', $ext_str);
    
    $max_file_size = 5242880; # Maximum file upload is 5 Mbytes
    $ext = substr($file['name'], strrpos($file['name'], '.') + 1);
    
    // 확장자 체크
    if(!in_array($ext, $allowed_extensions)) {
        echo "업로드할 수 없는 확장자 입니다.";
    }
    
    // 파일 크기 체크
    if($file['size'] >= $max_file_size) {
        echo "죄송합니다. $max_file_size MB 까지만 업로드 가능합니다.";
    }
    
    $path = $time . "_" . md5(microtime()) . '.' . $ext;
   
    // upload audio file with move_uploaded_file() php function.
    if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {
        $query = "INSERT INTO upload_file (file_id, name_orig, name_save, reg_time, store_name, audio_msg) VALUES(?,?,?,now(),'$store_name', '$audio_msg')";
        $file_id = md5(uniqid(rand(), true));
        // remove all spaces out of a string data 
        // because data delivery technique of HTML+GET can not handle a space.
        $name_orig = str_replace(" ", "_", $file['name']);
        $name_save = $path;
        
        $stmt = mysqli_prepare($db_conn, $query);
        $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
        $exec = mysqli_stmt_execute($stmt);
     
        // run google-speech-api program.
        // then, save a transcripted text message (korean) into audio_msg field of the table.
        // @TODO: develop a AI bot program

        // disconnect mysql database connection. 
        mysqli_stmt_close($stmt);
      
        echo "<br><br>" ;
        echo "<h3>축하합니다. 오디오 파일을 성공적으로 업로드 하였습니다.</h3>";
        echo "<a href='./audio_file_list.php'>업로드 파일 목록</a>";
        
    }
} else {
    echo "<h3>파일이 업로드 되지 않았습니다.</h3>";
    echo "<a href='javascript:history.go(-1);'>이전 페이지</a>";
}

mysqli_close($db_conn);
?>
</body>
</html>
