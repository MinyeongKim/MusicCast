<?php

session_start();
$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

// DB 선택
mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');



		function mq($sql){
		global $db; // 외부에서 선언된 $sql 을 함수내에서 쓸 수 있도록 글로벌화
		return mysql_query($sql,$connect);
	}
?>