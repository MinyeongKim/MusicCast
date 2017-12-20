<?php
	header('Content-Type: text/html; charset=utf-8');

	$mysql_hostname = 'localhost';
	$mysql_username = 'root';
	$mysql_password = 'apmsetup';
	$mysql_database = 'musiccast';

	// connect DB
	$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
	// select DB
	mysql_select_db($mysql_database, $connect) or die('Fail DB selection');

	// find video number
	$bno = $_GET["indx"];
	$sql_find = "select * from h_video where v_num = '$bno'";
	$result = mysql_query($sql_find, $connect);
	$row = mysql_fetch_array($result);

	// delete video file
	unlink($row["v_file"]);
	// delete tuple about video
	$sql = "delete from h_video where v_num='$bno'";
	mysql_query($sql,$connect);
	// change v_num
	$sql = "update h_video set v_num = v_num-1 where v_num > '$bno'";
	mysql_query($sql,$connect);

	echo "<script>alert('삭제되었습니다.');</script>";
?>

<meta http-equiv="refresh" content="0 url=DAMIN_composer.php" />
