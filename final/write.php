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
		<!-- the top of page -->
		<div id="main">
			<a class="p1" align="left"><img src="logo_icon.png" height=35px vspace='50'></a>
			<!-- menu -->
			<div id="menu">
				<ul>
					<li><a href="home.php"><img src="Home_icon.png" height=30px vspace='40'></a></li>
					<li><a href="ranking.php"><img src="ranking_icon.png" height=30px vspace='40'></a></li>
					<li><a href="video.php"><img src="video_icon.png" height=30px vspace='40'></a></li>
					<li><a href="composer.php"><img src="composer_icon.png" height=30px vspace='40'></a></li>
				</ul>
			</div>
			<!-- search bar -->
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
			<!-- check login state and video -->
			<?php 
				// if user is not login state, go login page
				if(!($_SESSION['login_email'])) {
					echo ("<script>location.replace('login.php');</script>");
				}
				$mysql_hostname = 'localhost';
				$mysql_username = 'root';
				$mysql_password = 'apmsetup';
				$mysql_database = 'musiccast';
				// connect DB
				$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 
				// select DB
				mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');
				// check uploaded video file by user
				$nick = $_SESSION['login_nick'];
				$sql_find = "select v_num from h_video where nickname = '$nick' and v_check = 1";
				$video_number = mysql_query($sql_find, $connect);
				// if there is video not to be finished to upload, delete that
				$row = mysql_fetch_array($video_number);
				$video_num = $row["v_num"];
				$sql_delete = "delete from h_video where v_num = '$video_num'";
				mysql_query($sql_delete, $connect);
				// close DB
				mysql_close($connect);
			?>
			<div id = "main_div1">
				<div id ="main_sub_div1">
				<?php 
					$mysql_hostname = 'localhost';
					$mysql_username = 'root';
					$mysql_password = 'apmsetup';
					$mysql_database = 'musiccast';

					// DB connect
					$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

					// DB select
					mysql_select_db($mysql_database, $connect) or die('Fail DB seletion');
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
			</div>
			<div id = "main_div2" align="center">

					<div>
						<form action="write_ok.php" method="post">
								<table>
										<td><label>Title</label></td>
										<td height="30"><input type="text" name="title" size="50"/></td>
									</tr>
									<tr>
										<td><label>component</label></td>
										<td height="30"><textarea name="content" rows="10" cols="37"></textarea></td>
									</tr>
									<tr>
										<td align="center" style="font-family:Sans-Serif;">category:</td>
										<td>
											<input type="radio" name="category" checked value = "lonely">Lonely
											<input type="radio" name="category" value = "fear">Fear
											<input type="radio" name="category" value = "cheer">Cheer
											<input type="radio" name="category" value = "drowsy">Drowsy
											<input type="radio" name="category" value = "dear">Dear
											<br>
											<input type="radio" name="category" value = "dreamlike">Dreamlike
											<input type="radio" name="category" value = "pleasant">Pleasant
											<input type="radio" name="category" value = "magnificent">Magnificent
											<input type="radio" name="category" value = "sad">Sad
											<input type="radio" name="category" value = "thrill">Thrill
											<br>
											<input type="radio" name="category" value = "anger">Anger
											<input type="radio" name="category" value = "quiet">Quiet
										</td>	
									</tr>
									<tr>
										<td align="right"colspan="2"><input type="submit" value="Submit"></td>
									</tr>
								</table>
						</form>
				</div>
			</div>
		</body>
</html>


