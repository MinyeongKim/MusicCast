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
				color : white;
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

			// DB 연결
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

			// DB 선택
			mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
			$composer = $_SESSION['login_composer'];
			if ($composer == 1)
				echo "COMPOSER";
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
	<?php
//include "../db.php";

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
// DB 선택
mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

	$bno = $_GET["indx"];
	$sql = "select * from h_video where v_num='".$bno."'";

	$result = mysql_query($sql, $connect);
	$board = mysql_fetch_array($result);
/* 조회수 카운트 */

	$sql_view = "select * from h_video where v_num ='".$bno."'";
	$result_view = mysql_query($sql_view,$connect);
	$view = mysql_fetch_array($result_view);
	$view = $view['view'] + 1;
	$fet = mysql_query("update h_video set view = '".$view."' where v_num = '".$bno."'", $connect);
	?>

	<div id = "main_div2">
		<form action="timeline_write.php" method="post">
                    <center><div id="board_read">
					<table>
						<tr>
							<td class="read w10 fl">Title</td>
							<td class="read_con" width = "150">&nbsp;<?php echo $board['title'];?></td>
							<td class="read w5 fl">Index</td>
							<td class="read_con" width = "150">&nbsp;<?php echo $board['v_num'];?></td>
							<td rowspan = "2" class="read w10 fl">Writer</td>
							<td rowspan = "2" class="read_con" width = "150">&nbsp;<?php echo $board['nickname'];?></td>
							<td></td>
						</tr>
						<tr>
							<td class="read w10 fl">Date</td>
							<td class="read_con">&nbsp;<?php echo $board['upload_date'];?></td>
							<td class="read w10 fl">Views</td>
							<td class="read_con">&nbsp;<?php echo $board['view']+1;?></td>
						</tr>
						<tr>
							<td class="read_nl fl">Context</td>
							<td class="read_nl_con"><?php echo nl2br("$board[context]");  ?></td>
							<td colspan = "3"><?php 
							echo ("<video src={$board[v_file]} controls></video>"); ?> </td>
							
						</tr>
						<tr>
							<td width = "150"><a href="DAMIN_composer.php">[go to list]</a></td>
						<?php
						$nick = $_SESSION['login_nick'];
						if (strcmp($board['nickname'], $nick) == 0){
							?>
							<td width = "150"><a href="modify.php?indx=<?php echo $bno; ?>">[modify]</a></td>
							<td width = "150"><a href="delete.php?indx=<?php echo $bno; ?>">[delete]</a></td>
						<?php } ?>
						</tr>

					</table>
					</div>
					<div class="bo_ser">
						<ul>
							
						</ul>
					</div>
            </form>
	</div>
</div>
</body>
</html>