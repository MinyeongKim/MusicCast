<?php
	$mysql_hostname = 'localhost';
	$mysql_username = 'root';
	$mysql_password = 'apmsetup';
	$mysql_database = 'musiccast';

	// DB 연결
	$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

	// DB 선택
	mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

	$email=$_POST['mail'];
	$password=$_POST['passwd'];
	$nickname=$_POST['nickname'];
	$Q_num=$_POST['question'];
	$Q_answer=$_POST['Q_answer'];
	$preference1=$_POST['prefer'];
	
	//이메일 중복 확인
	mysql_query("set names euckr");
	$e_sql = "select count(*) from user_info where email = '$email'";
	$result = mysql_query($e_sql, $connect);
	$data = mysql_result($result, 0, 0);

	if($data == 0) {
		//닉네임 중복 확인
		$n_sql = "select count(*) from user_info where nickname = '$nickname'";
		$result = mysql_query($n_sql, $connect);
		$data = mysql_result($result, 0, 0);

		if($data == 0) {
			//이메일, 닉네임이 중복이 아닐시 DB에 업로드
			$sql = "insert into user_info (email, nickname, password, Q_num, Q_answer, preference1) values ('$email','$nickname','$password','$Q_num','$Q_answer','$preference1')";
			if(mysql_query($sql, $connect)){
				echo "<script>alert('가입에 성공하셨습니다.');</script> ";
				echo ("<script>location.replace('login.php');</script>");
			}
			else{
				echo "<script>alert('가입에 실패하셨습니다.');</script> ";
				echo ("<script>location.replace('enroll.php');</script>");
			}
		}
		else {
			echo "<script>alert('닉네임이 중복되셨습니다.');</script> ";
			echo ("<script>location.replace('enroll.php');</script>");
		}
	}
	else {
		echo "<script>alert('이메일이 중복되셨습니다.');</script> ";
		echo ("<script>location.replace('enroll.php');</script>");
	}


 mysql_close($connect);
?>