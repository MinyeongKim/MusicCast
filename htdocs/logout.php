<?php
	$mysql_username = 'root';
	$mysql_password = 'apmsetup';
	$mysql_database = 'musiccast';
	//php���� session�� �̿��ϱ� ���ؼ��� session_start()�� ������ �������
	session_start();
	// DB ����
	$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

	// DB ����
	mysql_select_db($mysql_database, $connect) or die('DB ���� ����');

	//$login_sql = "UPDATE user_info SET plag = 0 WHERE email = '$_SESSION['login_email']'";
	//mysql_query($login_sql, $connect);
	//session���� �α����� �����߱� ������ �̸� �����ִ� ��
	session_destroy();

	echo "�α׾ƿ��� �Ϸ�Ǿ����ϴ�.";
	echo "<br>�α����� ���� �� <a href = \"login.php\">Ŭ��</a>���ּ���.";
?>