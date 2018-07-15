<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>파일 업로드</title>
</head>
<body>
<?php
$db_conn = mysqli_connect("localhost", "root", "ggghhh03", "sbdb");

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

 
   // change last character to 0.
   // For example, convert 201805051635 to 201805051630
    date_default_timezone_set("Asia/Seoul");
    $t=time();
    $curr_time = date("YmdHi",$t);
    $curr_time = substr_replace($curr_time, "", -1)."0";
    
    $path = $curr_time . "_" . md5(microtime()) . '.' . $ext;

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
