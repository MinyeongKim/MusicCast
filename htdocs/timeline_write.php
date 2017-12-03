<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

// DB 선택
mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
$content =$_POST['content'];
$nickname = $_SESSION['login_nick'];

//include "../db.php";
$date = date('Y-m-d-H:i');
$sql = "insert into timeline(indx, h_address, nickname ,context,upload_date) values(0, 'http://192.168.0.116/DAMIN_composer', '$nickname','$content','$date')";
mysql_query($sql, $connect);

echo "<script>alert('Complete writing');</script> "; 
mysql_close($connect);
?>
<meta http-equiv="refresh" content="0 url=/timeline.php" />