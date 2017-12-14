<?php session_start(); ?>
<html>
	<head> 
		<title>NARINTO</title>
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
			a:link { color: white; text-decoration: none;}
			a:visited { color: white; text-decoration: none;}
			a:hover { color: gray; text-decoration: none;}
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
	<!-- �α����� ������ ��, login.php�� �̵������ش�. -->

		<?php 
			if(!($_SESSION['login_email'])) {
				echo ("<script>location.replace('login.php');</script>");
			}
			$mysql_hostname = 'localhost';
			$mysql_username = 'root';
			$mysql_password = 'apmsetup';
			$mysql_database = 'musiccast';

			// DB ����
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 
			
			// DB ����
			mysql_select_db($mysql_database, $connect) or die('DB ���� ����');

			$nick = $_SESSION['login_nick'];
			$sql_find = "select v_num from h_video where nickname = '$nick' and v_check = 1";
			$video_number = mysql_query($sql_find, $connect);
			$row = mysql_fetch_array($video_number);
			$video_num = $row["v_num"];
			$sql_delete = "delete from h_video where v_num = '$video_num'";
			mysql_query($sql_delete, $connect);
			mysql_close($connect);

		?>
	<div id = "main_div1">
		<div id ="main_sub_div1">
		<?php 
			$mysql_hostname = 'localhost';
			$mysql_username = 'root';
			$mysql_password = 'apmsetup';
			$mysql_database = 'musiccast';

			// DB ����
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

			// DB ����
			mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
			$nickname = $_SESSION['login_nick'];

			$sql_follow = "select count(*) from follow_list where nickname = '$nickname' and composer = 'DAMIN0912'";
			$result = mysql_query($sql_follow, $connect);
			$count = mysql_result($result, 0, 0);
			// If result matched $myusername and $mypassword, table row must be 1 row
			echo "DAMIN0912's page<br>";
			if (strcmp($nickname, "DAMIN0912") != 0) {
			if($count==1)  //count�� 1�̶�� ���� ���̵�� �н����尡 ��ġ�ϴ� db�� �ϳ� ������ �ǹ��մϴ�. 
			{
				echo "<form action=\"follow.php\">
				<div>
				<button>Following</button>
				</div>
				</form><br><br>";
			}
			else
			{
				echo "<form action=\"follow.php\">
				<div>
				<button>+Follow</button>
				</div>
				</form><br><br>";
			}
			}
			
			$composer = $_SESSION['login_composer'];

				if ($composer == 1) {
					$sql_composer = "select * from composer where nickname = '$nickname'";
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
   // mq - mysql_query �� ����
   // BoardTest ���� ��� �÷����� �������� index ��ȣ�� ���� ������������ 5�� ���.
   $result = mysql_query($sql, $connect);
   //echo $result;
   while($board = mysql_fetch_array($result)){
   // ���´� ������ ���� ���������� �ڵ����� �ݺ�����
   $title = $board[title]; // board ���̺��� title �� ����
   if(strlen($title)>30){
      $title = str_replace($board[title],mb_substr($board[title],0,30,"utf-8")."...",$board['title']);
      // ������ ���� ���� �ʰ��� �ʰ��� ���� ��� '...' ��� (31 ���ʹ� ... ���)
   }
?>

<tbody>
<tr>
<td width="70"><?php echo $board['v_num']; ?></td>
<td width="500"><a href="read.php?indx=<?php echo $board['v_num'];?>"><?php echo $title;?></a></td>
<td width="70"><?php echo $board['nickname']; ?></td>
<td width="70"><?php echo $board['upload_date']; ?></td>
<td width="100"><?php echo $board['view']; ?></td>
</tr>
</tbody>
<?php } ?>
</table>
<?php 

				echo "<form action=\"individual.php\">
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