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
				text-align: center;
			}
			a:link { color: white; text-decoration: none;}
			a:visited { color: white; text-decoration: none;}
			a:hover { color: white; text-decoration: none;}
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

			<!-- DB�����ؼ� �˻��ϴ°� ���� �ؾߵ� -->
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
				mysql_select_db($mysql_database, $connect) or die('DB ���� ����');
				mysql_query("set names euckr");
				$composer = $_SESSION['login_composer'];
				if (strcmp($composer, "YES") == 0)
					echo "<a href = \"composer_damin.php\">COMPOSER</a>";
				else
					echo "USER";

			?>
			<?php echo "<br>Welcome ". $_SESSION['login_nick'] ." <br>"; ?>
		<center><input type = "button" value = "Logout" onclick = "location.href = 'logout.php'">
		</div>
		</div>
		<div id = "main_div2">
		<div id ="board_area">
			<table class = "list-table">
				<thead>
				<tr>
				<th width ="500">Title</th>
				<th width ="120">Composer</th>
				<th width ="100">Date</th>
				<th width ="100">Views</th>
				</tr>
				</thead>
				
				<?php
					$nick = $_SESSION['login_nick'];
					$type = $_POST['selector'];
					if (strcmp($type, "my") == 0) {
						$sql_prefer = "select preference1 from user_info where nickname = '$nick'";
						$result_ = mysql_query($sql_prefer, $connect);
						$type2 = mysql_fetch_array($result_);
						$sql = "select * from h_video where category='$type2[preference1]' order by v_num desc";
					}
					else {
						$sql = "select * from h_video where category='$type' order by v_num desc";
					}
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
			<td width="500"><a href="read.php?indx=<?php echo $board['v_num'];?>"><?php echo $title;?></a></td>
			<td width="70"><?php echo $board['nickname']; ?></td>
			<td width="70"><?php echo $board['upload_date']; ?></td>
			<td width="100"><?php echo $board['view']; ?></td>
			</tr>
			</tbody>
			<?php } ?>
			</table>
		<?php mysql_close($connect);?>
		</div>
		</div>
	</body>
</html>

