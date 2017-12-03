<?php
	$mysql_username = 'root';
	$mysql_password = 'apmsetup';
	$mysql_database = 'musiccast';
	//php에서 session을 이용하기 위해서는 session_start()를 무조건 해줘야함
	session_start();
	// DB 연결
	$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

	// DB 선택
	mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

	//$login_sql = "UPDATE user_info SET plag = 0 WHERE email = '$_SESSION['login_email']'";
	//mysql_query($login_sql, $connect);
	//session으로 로그인을 유지했기 때문에 이를 없애주는 것
	session_destroy();

	echo "로그아웃이 완료되었습니다.";
	echo "<br>로그인을 원할 시 <a href = \"login.php\">클릭</a>해주세요.";
?>