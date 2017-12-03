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
			table, th, td
			{
				border: 0px solid white;
				color: white;
			}
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
		<table>
			<tr>
				<td width = "100">Ranking</td>
				<td width = "300">Title</td>
				<td width = "150">Nickname</td>
				<td width = "100">Hit</td>
				<td width = "150">Move</td>
			</tr>
			<?php
				$sql = "select * from h_video order by hit desc limit 0,2";
				$result = mysql_query($sql, $connect);
				$count = 1;
				while($row = mysql_fetch_array($result)) {
					?>
					<tbody>
					<tr>
						<?php echo "<td> $count </td>";?>
						<td><a href="read.php?indx=<?php echo $row['v_num'];?>"><?php echo $row[title];?></a></td>
						<?php echo "<td>$row[nickname] </td>"; ?>
						<?php echo "<td> $row[hit] </td>"; ?>
						<td></td>
					</tr>
					</tbody>
					<?php $count = $count + 1; }?>
		</table>
	</div>
	</div>
</body>
</html>