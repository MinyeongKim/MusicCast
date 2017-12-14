<?php session_start(); ?>
<html>
	<head> 
		<title>NARINATO</title>
		<meta charset="UTF-8">
		<style type="text/css">
			@import url(main.css);
			body 
			{
				background-image : url("home_back.png");
				background-repeat : no-repeat;
				background-size : 100%;
			}
			
			#main_sub_div1
			{
				width : 200px;
				height : 70px;
				margin: 10px 10px 10px 40px;
			}
			table, th, td
			{
				border: 0px solid white;
				color: white;
			}
		</style>
	</head>

	<body>
		<div id="main">
			<a class="p1" align="left"><img src="logo_icon.png" height=35px vspace='50'></a>


<div id="menu">
<ul>
				<li><a href="home.php"><img src="Home_icon.png" height=30px vspace='40'></a></li>
				<li><a href="ranking.php"><img src="ranking_icon.png" height=30px vspace='40'></a></li>
				<li><a href="video.php"><img src="video_icon.png" height=30px vspace='40'></a></li>
				<li><a href="composer.php"><img src="composer_icon.png" height=30px vspace='40'></a></li>
</ul>
</div>

<!-- DB연동해서 검색하는거 구현 해야됨 -->
			<div id = "search">
				<form method = "get" action ="search.php">
					<table border="0" align="right">
						<tr>
							<td align ="center">
								<select name="ser">
								<option value="composer">Composer</option>
								<option value="title">Title</option>
								</select>
							</td>
							<td>
								<input type="text" size="30" name="keyWord"> 
							</td>
							<td>
								<input type="submit" value="Search">
							</td>
						</tr>
					</table>
				</form>
			</div>

</div>
<br>
	<div id = "body">
	<!-- 로그인을 안했을 시, login.php로 이동시켜준다. -->
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
			
			$sql_find = "select v_num, v_file from h_video where nickname = '$nick' and v_check = 1";
			$video_number = mysql_query($sql_find, $connect);
			if($row = mysql_fetch_array($video_number)){

			$video_num = $row["v_num"];
			$video_title = $row["v_file"];
			unlink($video_title);
			$sql_delete = "delete from h_video where v_num = '$video_num'";
			mysql_query($sql_delete, $connect);
			}


			mysql_close($connect);

		?>
	<div id = "main_div1">
		<div id ="main_sub_div1">
		<?php 
			$mysql_hostname = 'localhost';
			$mysql_username = 'root';
			$mysql_password = 'apmsetup';
			$mysql_database = 'musiccast';

			// DB 연결
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

			// DB 선택
			mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
			echo "DAMIN0912's page<br><br>";
			$composer = $_SESSION['login_composer'];
				$nick = $_SESSION['login_nick'];

				if ($composer == 1) {
					$sql_composer = "select * from composer where nickname = '$nick'";
					$video_number = mysql_query($sql_composer, $connect);
					if($row = mysql_fetch_array($video_number)){
						echo "<a href = \"$row[h_address]\">COMPOSER</a>";
					}
				}
				else
					echo "USER";
			echo "<br><br>Welcome ". $_SESSION['login_nick'] ."<br><br>";
			echo "<input type = \"button\" value = \"Logout\" onclick = \"location.href = 'logout.php'\">";
			echo "<div id=\"menu\">
			<ul>
				<li><a href=\"DAMIN_composer.php\">VIDEO</a></li>
				<li><a href=\"timeline.php\">TIMELINE</a></li>
			</ul>
			</div>";
		?>
	<center>
		</div>
	</div>
	<div id = "main_div2">
		<form action="timeline_write.php" method="post">
                    <center><table id="boardWrite">
                        <tr>
                            <td class="tb"><label for="ucontent">Context</label></td>
                            <td height="30"><textarea name="content" id="ucontent" rows="10" cols="37"></textarea></td>
							<td><button>Write</button></td>
                        </tr>
                    </table>
            </form>
		<div id ="board_area">
			<table>
				<thead>
				<tr>
				<th width ="120">Writer</th>
				<th width ="500">Context</th>
				<th width ="100">Date</th>
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
mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
   $sql = "select * from timeline order by indx desc";
   // mq - mysql_query 의 약자
   // BoardTest 안의 모든 컬럼들을 가져오고 index 번호에 따라 내림차순으로 5개 출력.
   $result = mysql_query($sql, $connect);
   //echo $result;
   while($board = mysql_fetch_array($result)){
   // 보냈던 쿼리의 행이 끝날때까지 자동으로 반복실행
   $title = $board[indx]; // board 테이블의 title 값 저장
?>

<tbody>
<tr>
<td width="120"><?php echo $board['nickname']; ?></td>
<td width="500"><?php echo $board['context'];?></td>
<td width="100"><?php echo $board['upload_date']; ?></td>
<!-- 글을 읽을때 해당 글의 번호를 가져옴 -->

</tr>
</tbody>
<?php } ?>
</table>
</div>
	</div>
	</div>
</body>
</html>