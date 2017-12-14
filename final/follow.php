<?php
session_start();

/*if(!isset($_SESSION["user"]) || !is_array($_SESSION["user"]) || empty($_SESSION["user"])) {
      // redirect to login page
}*/

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

// DB 선택
mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');


// DB 연결완료
$nickname = $_SESSION['login_nick'];
$sql_follow = "select count(*) from follow_list where nickname = '$nickname' and composer = 'DAMIN0912'";
$result = mysql_query($sql_follow, $connect);
$count = mysql_result($result, 0, 0);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)  //count가 1이라는 것은 아이디와 패스워드가 일치하는 db가 하나 있음을 의미합니다. 
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