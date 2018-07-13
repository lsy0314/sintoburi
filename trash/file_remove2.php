<html>
<body>
<?php
$file_id="0576966f0e8d425f4f06f32e5e8d5202";

echo ("file_id = $file_id");
$db_conn = mysqli_connect("localhost", "root", "ggghhh03", "sbdb");

$query = "DELETE FROM upload_file WHERE file_id='$file_id'";
       
$stmt = mysqli_prepare($db_conn, $query);
$bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
$exec = mysqli_stmt_execute($stmt);

if ($exec === TRUE) {
    echo "<font color=red>Data is deleted successfully</font>";
} else {
    echo "<font color=red>Error deleting data: " . $file_id . "</font>";
}
      
mysqli_stmt_close($stmt);
       
echo"<h3>파일 삭제 성공</h3>";
echo '<a href="file_list.php">업로드 파일 목록</a>';

mysqli_close($db_conn);
?>
</body>
</html>
