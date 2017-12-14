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


