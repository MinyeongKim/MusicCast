<?php
session_start();

/*if(!isset($_SESSION["user"]) || !is_array($_SESSION["user"]) || empty($_SESSION["user"])) {
      // redirect to login page
}*/

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB ����
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

// DB ����
mysql_select_db($mysql_database, $connect) or die('DB ���� ����');


// DB ����Ϸ�
$nickname = $_SESSION['login_nick'];
$sql_follow = "select count(*) from follow_list where nickname = '$nickname' and composer = 'DAMIN0912'";
$result = mysql_query($sql_follow, $connect);
$count = mysql_result($result, 0, 0);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)  //count�� 1�̶�� ���� ���̵�� �н����尡 ��ġ�ϴ� db�� �ϳ� ������ �ǹ��մϴ�. 
{
	$sql = "delete from follow_list where nickname = '$nickname' and composer = 'DAMIN0912'";
}
else
{
	$sql = "insert into follow_list (nickname, composer) values ('$nickname', 'DAMIN0912')";
}



if(mysql_query($sql, $connect)){
	echo "<script>alert('Success!');</script>";
	echo ("<script>location.replace('DAMIN_composer.php');</script>");
}
else{
	echo "<script>alert('Fail!');</script>";
	echo ("<script>location.replace('DAMIN_composer.php');</script>");
}
?>