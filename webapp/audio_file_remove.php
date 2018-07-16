<html>
<body>
<?php

// Author: Hyunjoon Lim, Suyeon Lim
// Title: a program to remove audio file and database data
// Date: Jul-06-2018
// License: Star License
//

$servername = "localhost";
$username = "root";
$password = "ggghhh03";
$dbname = "sbdb";

$file_id = $_REQUEST['file_id'];
$name_save = $_REQUEST['name_save'];

echo ("file_id = '$file_id'");
echo ("<br><br>");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM upload_file WHERE file_id='$file_id'";

if (mysqli_query($conn, $sql)) {
    echo "The data is successfully removed.";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
// Remove audito file in the specified directory
unlink("audio/".$name_save);

mysqli_close($conn);
?>
<br><br>
<a href="./audio_file_list.php">음성 파일 리스트 화면으로 이동하기</a>
</body>
</html>
