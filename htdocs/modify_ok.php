<?php
	//include "../db.php";
	header('Content-Type: text/html; charset=utf-8');

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'boardtest';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
// DB 선택
mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

	$bno = $_POST['indx'];
	$sql = "select * from board where indx='$bno'";

	$name = $_POST['name'];
	$pw = $_POST['pw'];
	$title = $_POST['title'];
	$content =$_POST['content'];


	$sql2 = "update board set name='".$_POST['name']."',pw='".$_POST['pw']."',title='".$_POST['title']."',content='".$_POST['content']."' where indx='".$bno."'";
	mysql_query($sql2,$connect);
	echo "<script>alert('수정되었습니다.');</script>";
	mysql_close($connect);
?>
<meta http-equiv="refresh" content="0 url=index.php" />
