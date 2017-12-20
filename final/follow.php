<?php
	session_start();

	$mysql_hostname = 'localhost';
	$mysql_username = 'root';
	$mysql_password = 'apmsetup';
	$mysql_database = 'musiccast';

	// connect DB
	$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

	// select DB
	mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

	$nickname = $_SESSION['login_nick'];
	$sql_follow = "select count(*) from follow_list where nickname = '$nickname' and composer = 'DAMIN0912'";
	$result = mysql_query($sql_follow, $connect);
	$count = mysql_result($result, 0, 0);

	// delete follow, if user is following. insert follow, if user is not following
	if($count==1) {
		$sql = "delete from follow_list where nickname = '$nickname' and composer = 'DAMIN0912'";
	}
	else {
		$sql = "insert into follow_list (nickname, composer) values ('$nickname', 'DAMIN0912')";
	}

	// alert message and return DAMIN_composer.php
	if(mysql_query($sql, $connect)) {
		echo "<script>alert('Success!');</script>";
		echo ("<script>location.replace('DAMIN_composer.php');</script>");
	}
	else {
		echo "<script>alert('Fail!');</script>";
		echo ("<script>location.replace('DAMIN_composer.php');</script>");
	}
?>
