<?php session_start(); ?>
<html lang="ko">
	<head> 
		<title>나린아토</title>
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
			#main_div1
			{
				border-left:5px solid white;
				border-right:5px solid white;
				border-top:5px solid white;
				border-bottom:5px solid white;
				width : 300px;
				height : 500px;
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
				height : auto;
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
			<a class="p1" align="left">narinato</a>

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
			mysql_select_db($mysql_database, $connect) or die('Fail DB selection');
			$composer = $_SESSION['login_composer'];
			if (strcmp($composer, "YES") == 0)
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

	$sql_hit = "select * from h_video where v_num ='".$bno."'";
	$result_hit = mysql_query($sql_hit,$connect);
	$hit = mysql_fetch_array($result_hit);
	$hit = $hit['hit'] + 1;
	$fet = mysql_query("update h_video set hit = '".$hit."' where v_num = '".$bno."'", $connect);
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
							<td class="read_con">&nbsp;<?php echo $board['hit']+1;?></td>
						</tr>
						<tr>
							<td class="read_nl fl">Context</td>
							<td class="read_nl_con"><?php echo nl2br("$board[context]");  ?></td>
							<td><?php echo("<br><br><video src=$board[v_file] controls></video>");?></td>
						</tr>
						<tr>
							<td width = "150"><a href="DAMIN_composer.php">[go to list]</a></td>
							<td width = \"150\"><a href="modify.php?indx=<?php echo $board['v_num']; ?>">[modify]</a></td>
							<td width = "150"><a href="delete.php?indx=<?php echo $board['v_num']; ?>">[delete]</a></td>
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