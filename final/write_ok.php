<?php
	session_start();

	$mysql_hostname = 'localhost';
	$mysql_username = 'root';
	$mysql_password = 'apmsetup';
	$mysql_database = 'musiccast';

	// DB connect
	$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

	// DB select
	mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
	
	// Get video information that the composer entered
	$title =$_POST['title'];
	$content =$_POST['content'];
	$category=$_POST['category'];
	$nick = $_SESSION['login_nick'];
	$date = date('Y-m-d');
	$email = $_SESSION['login_email'];
	
	// Check uploaded video file by user
	$sql_find = "select v_num from h_video where nickname = '$nick' and v_check = 1";
	$video_number = mysql_query($sql_find, $connect);
	$row = mysql_fetch_array($video_number);
	$video_num = $row["v_num"];
	
	// Update video information to DB
	$sql = "update h_video set title = '$title', category = '$category', upload_date = '$date', context = '$content', v_check = 0 where v_num = '$video_num'";
	
	if (mysql_query($sql, $connect)) {
		echo "<script>alert('Complete writing');</script> "; 
		echo ("<script>location.replace('DAMIN_composer.php');</script>");
	}
	else {
		echo "<script>alert('Fail writing');</script> "; 
		echo ("<script>location.replace('DAMIN_composer.php');</script>");
	}
	mysql_close($connect);
?>
