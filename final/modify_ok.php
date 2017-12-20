<?php
	session_start();

	$mysql_hostname = 'localhost';
	$mysql_username = 'root';
	$mysql_password = 'apmsetup';
	$mysql_database = 'musiccast';

	// connect DB
	$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

	// select DB
	mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
	$bno = $_GET["indx"];
	$title =$_POST['title'];
	$content =$_POST['content'];
	$category=$_POST['category'];
	$nick = $_SESSION['login_nick'];
	$date = date('Y-m-d');
	$email = $_SESSION['login_email'];

	// modify video data
	$sql = "update h_video set title = '$title', category = '$category', upload_date = '$date', context = '$content', v_check = 0 where v_num = '$bno'";
	
	if (mysql_query($sql, $connect)) {
		echo "<script>alert('Complete writing');</script> "; 
		echo ("<script>location.replace('DAMIN_composer.php');</script>");
	}
	else {
		echo "<script>alert('Fail writing');</script> "; 
		echo ("<script>location.replace('DAMIN_composer.php');</script>");
	}

	// close DB
	mysql_close($connect);
?>
