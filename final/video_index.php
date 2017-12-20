<?php
//   include "db.php";
?>
<!doctype html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<title>NARINATO</title>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>

		<?php 
			if(!($_SESSION['login_email'])) {
				echo ("<script>location.replace('login.php');</script>");
			}
			$mysql_hostname = 'localhost';
			$mysql_username = 'root';
			$mysql_password = 'apmsetup';
			$mysql_database = 'musiccast';

			// DB 연결
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 
			
			// DB 선택
			mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

			$nick = $_SESSION['login_nick'];
			$sql_find = "select v_num from h_video where nickname = '$nick' and v_check = 1";
			$video_number = mysql_query($sql_find, $connect);
			$row = mysql_fetch_array($video_number);
			$video_num = $row["v_num"];
			$sql_delete = "delete from h_video where v_num = '$video_num'";
			mysql_query($sql_delete, $connect);
			mysql_close($connect);

		?>


		<h1>자유게시판</h1>
		<h4>게시판 테스트 중</h4>

		<div id ="board_area">
			<table class = "list-table">
				<thead>
				<tr>
				<th width ="70">번호</th>
				<th width ="500">제목</th>
				<th width ="120">글쓴이</th>
				<th width ="100">작성일</th>
				<th width ="100">조회수</th>
				</tr>
				</thead>
<?php

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

// DB 선택
mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

   $sql = "select * from h_video order by v_num desc";
   // mq - mysql_query 의 약자
   // BoardTest 안의 모든 컬럼들을 가져오고 index 번호에 따라 내림차순으로 5개 출력.
   $result = mysql_query($sql, $connect);
   //echo $result;
   while($board = mysql_fetch_array($result)){
   // 보냈던 쿼리의 행이 끝날때까지 자동으로 반복실행
   $title = $board[title]; // board 테이블의 title 값 저장
   if(strlen($title)>30){
      $title = str_replace($board[title],mb_substr($board[title],0,30,"utf-8")."...",$board['title']);
      // 제목이 일정 길이 초과시 초과한 문자 대신 '...' 출력 (31 부터는 ... 출력)
   }
?>

<tbody>
<tr>
<td width="70"><?php echo $board['upload_date']; ?></td>
<td width="500"><a href="read.php?indx=<?php echo $board['indx'];?>"><?php echo $title;?></a></td>
<td width="100"><?php echo $board['hit']; ?></td>
</tr>
</tbody>
<?php } ?>
</table>
<form action="write.php">
<div class="write_btn">
<button>글쓰기</button>
</div>
</form>
</div>
	</body>
</html>
