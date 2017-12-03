<?php
	session_start();

	$mysql_hostname = 'localhost';
	$mysql_username = 'root';
	$mysql_password = 'apmsetup';
	$mysql_database = 'musiccast';

	// DB 연결
	$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

	// DB 선택
	mysql_select_db($mysql_database, $connect) or die('Fail DB selection');

	$title =$_POST['title'];
	$content =$_POST['content'];
	$category=$_POST['category'];
	$nick = $_SESSION['login_nick'];
	$date = date('Y-m-d');

	$sql = "insert into h_video (v_num, title, category, upload_date, nickname, context, hit) values(0, '$title', '$category', '$date', '$nick', '$content', '0')";
	
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