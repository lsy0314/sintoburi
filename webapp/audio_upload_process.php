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
$t=time();
$curr_time = date("YmdHi",$t);
$curr_time = substr_replace($curr_time, "", -1)."0";

// ----------------------calculate the number of audio data

// connect to mysql database
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$count = 0; 
// https://dev.mysql.com/doc/refman/8.0/en/pattern-matching.html
// Pattern Matching: Use the LIKE or NOT LIKE comparison operators 
$query = "SELECT file_id, name_orig, name_save, reg_time, store_name, audio_msg FROM upload_file WHERE name_save LIKE '".$curr_time."%' ORDER BY reg_time DESC";
$stmt = mysqli_prepare($db_conn, $query);
$exec = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)) {
    $count= $count+1;
} 
mysqli_free_result($result); 
mysqli_stmt_close($stmt);
mysqli_close($db_conn);
//echo "current time: $curr_time , audio data count: $count . <br>";
//die("just test.");


// if the number of audio data exceeds 5, stop program.
$max_audio_file = 1;
if ($count > $max_audio_file)
    die("Unable to upload audio file because seller can upload audio files until 5. <br> <a href=./audio_file_list.php>오디오 파일 리스트로 이동하기</a>");
 
// ------------------------- upload audio file to mysql database and audio folder
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {
    $file = $_FILES['upfile'];
    $upload_directory = 'audio/';
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
        echo "5MB 까지만 업로드 가능합니다.";
    }
   
   $store_name = $_POST['store'];
   $audio_msg = $_POST['message']; 
   $time = $_POST['time'];
 
    
    $path = $time . "_" . md5(microtime()) . '.' . $ext;

    if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {
        $query = "INSERT INTO upload_file (file_id, name_orig, name_save, reg_time, store_name, audio_msg) VALUES(?,?,?,now(),'$store_name', '$audio_msg')";
        $file_id = md5(uniqid(rand(), true));
        $name_orig = $file['name'];
        $name_save = $path;
        
        $stmt = mysqli_prepare($db_conn, $query);
        $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
        $exec = mysqli_stmt_execute($stmt);
      
        mysqli_stmt_close($stmt);
        
        echo"<h3>파일 업로드 성공</h3>";
        echo '<a href="audio_file_list.php">업로드 파일 목록</a>';
        
    }
} else {
    echo "<h3>파일이 업로드 되지 않았습니다.</h3>";
    echo '<a href="javascript:history.go(-1);">이전 페이지</a>';
}

mysqli_close($db_conn);
?>
</body>
</html>
