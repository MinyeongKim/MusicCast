<?php session_start(); ?>
<html>
	<head> 
		<title>NARINATO</title>
		<style type="text/css">
			@import url(main.css);
			body 
			{
				background-image : url("home_back.png");
				background-repeat : no-repeat;
				background-size : 100%;
			}
			#main_div1
			{
				border-left:5px solid white;
				border-right:5px solid white;
				border-top:5px solid white;
				border-bottom:5px solid white;
				width : 300px;
				height : 70%;
				float : left;
				margin : 0px 0px 0px 72px;
			}
			#main_div2
			{
				border-left:5px solid white;
				border-right:5px solid white;
				border-top:5px solid white;
				border-bottom:5px solid white;
				float : left;
				width : 800px;
				height : 70%;
			}
			table, th, td
			{
				border: 0px solid white;
				color: white;
				text-align: center;
			}
			a:link { color: white; text-decoration: none;}
			a:visited { color: white; text-decoration: none;}
			a:hover { color: white; text-decoration: none;}
		</style>
	</head>

	<body>
		<div id="main">
			<a class="p1" align="left">NARINATO</a>

<div id="menu">
<ul>
<li><a href="home.php">Home</a></li>
<li><a href="ranking.php">Ranking</a></li>
<li><a href="video.php">Video</a></li>
<li><a href="composer.php">Composer</a></li>
</ul>
</div>

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
	?>
	<div id = "main_div1">
		<?php 
			$mysql_hostname = 'localhost';
			$mysql_username = 'root';
			$mysql_password = 'apmsetup';
			$mysql_database = 'musiccast';

			// DB 연결
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

			// DB 선택
			mysql_select_db($mysql_database, $connect) or die('Fail DB seletion');
			$composer = $_SESSION['login_composer'];
			if (strcmp($composer, "YES") == 0)
				echo "COMPOSER";
			else
				echo "USER";
			echo "<br><br>Welcome ". $_SESSION['login_nick'] ."";
			echo "<center><input type = \"button\" value = \"Logout\" onclick = \"location.href = 'logout.php'\">";
			echo "<div id=\"menu\">
			<ul>
				<li><a href=\"DAMIN_composer.php\">VIDEO</a></li>
				<li><a href=\"timeline.php\">TIMELINE</a></li>
			</ul>
			</div>";
		?>
	</div>
	<div id = "main_div2">
		<div id ="board_area">
			<table class = "list-table">
				<thead>
				<tr>
				<th width ="70">Index</th>
				<th width ="500">Title</th>
				<th width ="120">Composer</th>
				<th width ="100">Date</th>
				<th width ="100">Views</th>
				</tr>
				</thead>
				
		<?php
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
<td width="70"><?php echo $board['v_num']; ?></td>
<td width="500"><a href="read.php?indx=<?php echo $board['v_num'];?>"><?php echo $title;?></a></td>
<td width="70"><?php echo $board['nickname']; ?></td>
<td width="70"><?php echo $board['upload_date']; ?></td>
<td width="100"><?php echo $board['hit']; ?></td>
</tr>
</tbody>
<?php } ?>
</table>
<?php 

				echo "<form action=\"write.php\">
				<div>
				<button>Write</button>
				</div>
				</form>";
	?>
</div>
		<?php	mysql_close($connect);?>
	</div>
	</div>
</body>
</html>