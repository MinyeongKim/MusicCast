<?php
//	include "../db.php";
	header('Content-Type: text/html; charset=utf-8');


$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
// DB 선택
mysql_select_db($mysql_database, $connect) or die('Fail DB selection');

	$bno = $_GET["indx"];
	$sql_find = "select * from h_video where v_num = '$bno'";
	$result = mysql_query($sql_find, $connect);
	$row = mysql_fetch_array($result);
	unlink($row["v_file"]);

	$sql = "delete from h_video where v_num='$bno'";
	mysql_query($sql,$connect);

	$sql = "update h_video set v_num = v_num-1 where v_num > '$bno'";
	mysql_query($sql,$connect);
	
	echo "<script>alert('삭제되었습니다.');</script>";

	// hit 수정해야함 - 삭제한 것 후의 게시물 hit--
	

?>
<meta http-equiv="refresh" content="0 url=DAMIN_composer.php" />