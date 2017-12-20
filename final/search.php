<?php session_start(); ?>
<html lang="ko">
	<head> 
		<title>NARINATO</title>
		<link rel="stylesheet" href="style.css"/>
		<style type="text/css">
			@import url(main.css);
			body 
			{
				background-color : rgb(4,7,14);
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
			video {  
				width:100%; 
				max-width:auto; 
				height:400px; 
			}
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
			//if user is not login state, go login page
			if(!($_SESSION['login_email'])) {
				echo ("<script>location.replace('login.php');</script>");
			}
			$mysql_hostname = 'localhost';
			$mysql_username = 'root';
			$mysql_password = 'apmsetup';
			$mysql_database = 'musiccast';

			// DB connect
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 
			
			// DB select
			mysql_select_db($mysql_database, $connect) or die('Fail DB select');

			// check uploaded video file by user
			$nick = $_SESSION['login_nick'];
			$sql_find = "select v_num from h_video where nickname = '$nick' and v_check = 1";
			$video_number = mysql_query($sql_find, $connect);
		
			// if there is video not to be finished to upload, delete that
			$row = mysql_fetch_array($video_number);
			$video_num = $row["v_num"];
			$sql_delete = "delete from h_video where v_num = '$video_num'";
			mysql_query($sql_delete, $connect);
			
			// DB close
			mysql_close($connect);

		?>
	<div id = "main_div1">
		<div id = "main_sub_div1">
		<?php 
				$mysql_hostname = 'localhost';
				$mysql_username = 'root';
				$mysql_password = 'apmsetup';
				$mysql_database = 'musiccast';

				// DB connect
				$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

				// DB select
				mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
				
				$composer = $_SESSION['login_composer'];
				$nick = $_SESSION['login_nick'];
				
			
				// check if user is composer
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
	<?php
//include "../db.php";

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB connect
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
// DB select
mysql_select_db($mysql_database, $connect) or die('Fail DB select');

	$bno = $_GET["indx"];
	$sql = "select * from h_video where v_num='".$bno."'";

	$result = mysql_query($sql, $connect);
	$board = mysql_fetch_array($result);
	
	// Add views of video when user watch it
	$sql_hit = "select * from h_video where v_num ='".$bno."'";
	$result_hit = mysql_query($sql_hit,$connect);
	$hit = mysql_fetch_array($result_hit);
	$hit = $hit['hit'] + 1;
	$fet = mysql_query("update h_video set hit = '".$hit."' where v_num = '".$bno."'", $connect);
	?>

	<div id = "main_div2">
		<?php
			$cate=$_GET['ser']; 
			$text=$_GET['keyWord'];
			// When search category is 'composer', print composer with search content
			if (strcmp($cate, 'composer') == 0) {
				$sql = "select * from composer where nickname like '%$text%'";
		?>
			<table>
				<?php
					$result = mysql_query($sql, $connect);
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
			}
			
			// When search category is 'title', print video with search content
			else if (strcmp($cate, 'title') == 0) {
				$sql = "select * from h_video where title like '%$text%'";
				?>
				<table>
					<?php
					$result = mysql_query($sql, $connect);
					while($row = mysql_fetch_array($result)) {
					?>
					<tbody>
						<tr>
							<td><a href="read.php?indx=<?php echo $row['v_num'];?>"><?php echo $row[title];?></a></td>
							<?php echo "<td>$row[nickname] </td>"; ?>
							<?php echo "<td> $row[hit] </td>"; ?>
							<td></td>
						</tr>
					</tbody>
					<?php } ?>
				</table>
				<?php
			}
			mysql_close($connect);
		?>
	</div>
</div>
</body>
</html>
