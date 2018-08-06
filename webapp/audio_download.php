<?php
// Author: Hyunjoon Lim, Suyeon Lim
// Title: a program to download an audio file that user presses.
// Date: Jul-06-2018
// License: Star License


$file_id = $_REQUEST['file_id'];

// connect to database
include('webapp_config.php');
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// mysql sql query to display data
$query = "SELECT file_id, name_orig, name_save FROM $table_name_audio WHERE file_id = ?";
$stmt = mysqli_prepare($db_conn, $query);

$bind = mysqli_stmt_bind_param($stmt, "s", $file_id);
$exec = mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$name_orig = $row['name_orig'];
$name_save = $row['name_save'];

// get only folder date from $name_save.
$audio_folder = substr($name_save,0,8);

$fileDir = "audio"."/".$audio_folder;
$fullPath = $fileDir."/".$name_save;
$length = filesize($fullPath);

header("Content-Type: application/octet-stream");
header("Content-Length: $length");
header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$name_orig));
header("Content-Transfer-Encoding: binary");

$fh = fopen($fullPath, "r");
fpassthru($fh);

mysqli_free_result($result);
mysqli_stmt_close($stmt);
mysqli_close($db_conn);

exit;
?>
