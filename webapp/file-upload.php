<?php
if(isset($_POST['submit'])) {
     $save_dir = "./data/";
     //파일이 HTTP POST 방식을 통해 정상적으로 업로드되었는지 확인한다.
     if(is_uploaded_file($_FILES["upload_file"]["tmp_name"])){
          echo "업로드한 파일명 : " . $_FILES["upload_file"]["name"];
          //파일을 저장할 디렉토리 및 파일명
          $dest = $save_dir . $_FILES["upload_file"]["name"];
          //파일을 지정한 디렉토리에 저장
          if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $dest))
               echo "success";
          else
               die("fail2");
     } else {
          echo "fail1";
     }
}
?>

<form enctype="multipart/form-data" method="post"
action="<?php echo $_SERVER['PHP_SELF']; ?>">
     <input type="file" name="upload_file" /><br />
     <input type="submit" value="upload" name="submit"/>
</form>
