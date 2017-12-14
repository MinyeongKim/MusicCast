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
			$bg: #332f35;
			$fg: lighten($bg,20%);
			$borderWidth: 3px;


			input[type=radio] {
			  position: absolute;
			  visibility: hidden;
			  display: none;
			}

			label {
			  color: lighten($bg,40%);
			  display: inline-block;
			  cursor: pointer;
			  font-weight: bold;
			  padding: 5px 20px;
			}

			input[type=radio]:checked + label{
			  color: lighten($bg,60%);
			  background: $fg;
			}

			label + input[type=radio] + label {
			  border-left: solid $borderWidth $fg;
			}
			.radio-group {
			  border: solid;
			  display: inline-block;
			  margin: 20px;
			  border-radius: 10px;
			  overflow: hidden;
			  float : left;
			}
			table, th, td
			{
				border: 0px solid white;
				color: white;
			}
			a:link { color: white; text-decoration: none;}
			a:visited { color: white; text-decoration: none;}
			a:hover { color: gray; text-decoration: none;}
			@import url('https://fonts.googleapis.com/css?family=Roboto');
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
		<center><form method = "post" action="video_access.php">
		<div class="radio-group">
		<input type="radio" value="my" name="selector" checked><label for="My">My</label>
		<input type="radio" value="anger" name="selector"><label for="Anger">Anger</label>
		<input type="radio" value="cheer" name="selector"><label for="Cheer">cheer</label>
		<input type="radio" value="dear" name="selector"><label for="Dear">Dear</label><br>
		<input type="radio" value="dreamlike" name="selector"><label for="Dreamlike">Dreamlike</label>
		<input type="radio" value="drowsy" name="selector"><label for="Drowsy">Drowsy</label>
		<input type="radio" value="fear" name="selector"><label for="Fear">Fear</label>
		<input type="radio" value="lonely" name="selector"><label for="Lonely">Lonely</label><br>
		<input type="radio" value="magnificant" name="selector"><label for="Magnificanf">Magnificant</label>
		<input type="radio" value="pleasant" name="selector"><label for="Pleasant">Pleasant</label>
		<input type="radio" value="quiet" name="selector"><label for="Quiet">Quiet</label>
		<input type="radio" value="sad" name="selector"><label for="Sad">Sad</label>
		<input type="radio" value="thrill" name="selector"><label for="Thrill">Thrill</label>
		</div>
		<br><br><br><center><input type="submit" value="search">
		</form>
	</div>
	</div>
</body>
</html>