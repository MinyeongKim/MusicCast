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
				text-align: center;
			}
			a:link { color: white; text-decoration: none;}
			a:visited { color: white; text-decoration: none;}
			a:hover { color: white; text-decoration: none;}
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

<!-- DB연동해서 검색하는거 구현 해야됨 -->
<div id = "search">
<form name = "search" method = "get" action ="a.jsp" onsubmit="return check()">
 <table width="500" border="0" align="right">
  <tr>
   <td align ="center" valign="bottom">
    <select name="keyField">
     <option value="subject">All</option>
     <option value="writer">Composer</option>
     <option value="content">Title</option>
     </select>
     </td>
     
   <td>
    <input type="text" size="50" name="keyWord"> 
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
			mysql_select_db($mysql_database, $connect) or die('Fail DB seletion');
			$composer = $_SESSION['login_composer'];
			if (strcmp($composer, "YES") == 0)
				echo "COMPOSER";
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
	<div id = "main_div2" align="center">
		<?php
		$mysql_hostname = 'localhost';
		$mysql_username = 'root';
		$mysql_password = 'apmsetup';
		$mysql_database = 'musiccast';

		// DB 연결
		$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
		// DB 선택
		mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');
		$nick = $_SESSION['login_nick'];
		$sql = "select is_composer from user_info where nickname = '".$nick."'";
				$result = mysql_query($sql, $connect);
				$count = mysql_result($result, 0, 0);
				/*
				if (count < 1) {
					echo "<script>alert('composer가 아닙니다.');</script> ";
					echo ("<script>location.replace('DAMIN_composer.php');</script>");
				}*/
				mysql_close($connect);
			 ?>
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
									<input type="radio" name="category" checked value = "a">a
									<input type="radio" name="category" value = "a">a
									<input type="radio" name="category" value = "b">b
									<input type="radio" name="category" value = "c">c
									<input type="radio" name="category" value = "d">d
									<br>
									<input type="radio" name="category" value = "e">e
									<input type="radio" name="category" value = "f">f
									<input type="radio" name="category" value = "g">g
									<input type="radio" name="category" value = "h">h
									<input type="radio" name="category" value = "i">i
									<br>
									<input type="radio" name="category" value = "j">k
									<input type="radio" name="category" value = "l">l
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


