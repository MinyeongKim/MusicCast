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
			}
			a:link { color: white; text-decoration: none;}
			a:visited { color: white; text-decoration: none;}
			a:hover { color: gray; text-decoration: none;}
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
						// connect DB
						$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 
						// select DB
						mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');
						$composer = $_SESSION['login_composer'];
						$composer = $_SESSION['login_composer'];
						$nick = $_SESSION['login_nick'];
						// check user is composer or user, if composer, link the page.
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
					<!-- logout button -->
					<center><input type = "button" value = "Logout" onclick = "location.href = 'logout.php'">
				</div>
			</div>
				
			<div id = "main_div2">
				<?php
					// following list
					$nick = $_SESSION["login_nick"];
					$follower_num = "select count(*) from follow_list where nickname = '$nick'";
					$result = mysql_query($follower_num, $connect);
					$count = mysql_result($result, 0, 0);

					if($count <= 0){
						echo "Please follow composer";
					}
					else{
						$follower = "select composer from follow_list where nickname = '$nick'";
						$result = mysql_query($follower, $connect);


						$composers = "select * from composer";
						$result2 = mysql_query($composers, $connect);
						$row2 = mysql_fetch_array($result2);

						while($row = mysql_fetch_array($result)){
							echo "<td><a href = \"$row2[h_address]\">$row2[nickname]</a> </td>";
						}
					}
					// close DB
					mysql_close($connect);
				?>
			</div>
		</div>
	</body>
</html>
