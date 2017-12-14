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
				mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');
				$composer = $_SESSION['login_composer'];
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

			?>
			<?php echo "<br>Welcome ". $_SESSION['login_nick'] ." <br>"; ?>
		<center><input type = "button" value = "Logout" onclick = "location.href = 'logout.php'">
			</div>
		</div>
		<div id = "main_div2">
			<?php
				$composers = "select * from composer order by rand() limit 3";
				$result = mysql_query($composers, $connect);
				?>
				

				<table>
				<?php
					while($row = mysql_fetch_array($result)) {
				?>
					<tbody>
						<tr>
							<?php echo "<td><a href = \"$row[h_address]\">$row[nickname]</a> </td>"; ?>
						</tr>
					</tbody>
				<?php } ?>
				</table>
				<?php
				mysql_close($connect);
				?>
		</div>
		</div>
	</body>
</html>