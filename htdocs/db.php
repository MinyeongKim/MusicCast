<?php

session_start();
$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB ����
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

// DB ����
mysql_select_db($mysql_database, $connect) or die('DB ���� ����');



		function mq($sql){
		global $db; // �ܺο��� ����� $sql �� �Լ������� �� �� �ֵ��� �۷ι�ȭ
		return mysql_query($sql,$connect);
	}
?>