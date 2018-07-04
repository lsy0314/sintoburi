<?php
// @Author: Hyunjoon Lim, Suyeon Lim
// @Title: File uploading software
// @Date: Jul-03-2018
// @License: Star License
// @Description: This webpage is to upload files.
// @reference:
//  http://offbyone.tistory.com/279

// uploading folder
$save_dir = "./data/";

if(isset($_POST['submit'])) {
     // Check if we can upload the file with HTTP POST method.
     if(is_uploaded_file($_FILES["upload_file"]["tmp_name"])){
          echo "업로드한 파일명 : " . $_FILES["upload_file"]["name"];
          // Define directory and file name that we want to save
          $dest = $save_dir . $_FILES["upload_file"]["name"];
          // Save the file into specified directory
          echo "<br><br><br>";
          if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $dest))
               echo "Okay. Uploading file is succeeded.<br>";
          else
               die("Oooops. Uploading file is failed.<br>");
     } else {
          echo "Oooops. The file is not existed.<vbr>";
     }
    echo "<a href=file-upload.html>Go to file-upload.html!!!</a><br>";

    // display upload files in ./data/ folder.
    echo "<br><br>";
    echo "<li> File list</li>";
    echo "<pre>";
    $result=system("ls ./data/");
    echo "</pre>";
}
?>

