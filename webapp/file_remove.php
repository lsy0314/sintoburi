<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "ggghhh03";
$dbname = "sbdb";

$file_id = $_REQUEST['file_id'];
$name_save = $_REQUEST['name_save'];

echo ("file_id = '$file_id'");

# $file_id="0576966f0e8d425f4f06f32e5e8d5202";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM upload_file WHERE file_id='$file_id'";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

unlink("audio/".$name_save);
mysqli_close($conn);
?>
<br><br>
<a href="./file_list.php">음성 파일 리스트 화면으로 이동하기</a>
</body>
</html>
