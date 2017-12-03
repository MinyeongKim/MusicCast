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

			@import url('https://fonts.googleapis.com/css?family=Roboto');
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
			mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');
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
	<div id = "main_div2">
		<form method = "post" action="video_access.php">
		<div class="radio-group">
		<input type="radio" value="A" name="selector"><label for="A">A</label>
		<input type="radio" value="B" name="selector"><label for="B">B</label>
		<input type="radio" value="C" name="selector"><label for="C">C</label>
		<input type="radio" value="D" name="selector"><label for="D">D</label>
		<input type="radio" value="E" name="selector"><label for="E">E</label>
		<input type="radio" value="F" name="selector"><label for="F">F</label>
		<br>
		<input type="radio" value="G" name="selector"><label for="G">G</label>
		<input type="radio" value="H" name="selector"><label for="H">H</label>
		<input type="radio" value="I" name="selector"><label for="I">I</label>
		<input type="radio" value="J" name="selector"><label for="J">J</label>
		<input type="radio" value="K" name="selector"><label for="K">K</label>
		</div>
		<br><br><input type="submit" value="search">
		</form>
	</div>
	</div>
</body>
</html>