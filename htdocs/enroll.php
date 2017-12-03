<html>
	<head> 
		<title>나린아토</title>
		<meta charset = "euckr" />
		<style type="text/css">
			@import url(main.css);
			body 
			{
				background-image : url("background.png");
				background-repeat : no-repeat;
				background-size : 1956px;
			}
		</style>

		<script language="javascript"> 
			function check() { 
				if (!document.member.mail.value) { 
					alert("email를 입력해주세요"); 
					document.member.id.focus(); 
					return false; 
				} 
				if (!document.member.passwd.value) { 
					alert("비밀번호를 입력해주세요"); 
					document.member.passwd.focus(); 
					return false; 
				}
				if (!document.member.Q_answer.value) { 
					alert("질문답변을 입력해주세요"); 
					document.member.passwd.focus(); 
					return false; 
				} 
				if (!document.member.nickname.value) { 
					alert("닉네임을 입력해주세요"); 
					document.member.passwd.focus(); 
					return false; 
				}
			} 
		</script>
	</head>

	<body>
		<br>

			<form name="member" method="post" ENCTYPE="multipart/form-data" onsubmit="return check();" action = "member_enroll.php"> 
				<table width="500" align="center" border="0" cellpadding="3"> 
					<tr>	
						<td>e-mail :</td> 
						<td><input type="text" name="mail"></td>
					</tr>  
					<tr> 
						<td>비밀번호 :</td> 
						<td><input type="password" name="passwd" ></td> 
					</tr> 
					<?php
						$mysql_hostname = 'localhost';
						$mysql_username = 'root';
						$mysql_password = 'apmsetup';
						$mysql_database = 'musiccast';

						// DB 연결
						$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

						// DB 선택
						mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

						$question_select = "SELECT Q_contents FROM question";
						$result = mysql_query($question_select, $connect);
						echo "<tr>
							<td align=\"center\" style=\"font-family:Sans-Serif\";>질문:</td>
							<td> <select name = \"question\"> <option value = \"1\">";
							$row = mysql_fetch_array($result);
							print_r($row[Q_contents]);
						echo "</option>
							<option value = \"2\">";
							$row = mysql_fetch_array($result);
							print_r($row[Q_contents]);
						echo "</option>
							<option value = \"3\">";
							$row = mysql_fetch_array($result);
							print_r($row[Q_contents]);
						echo "</option>
							</select>
							</td>
							</tr>";
					?>

					<tr>
						<td align="center" style="font-family:Sans-Serif;">질문답변:</td>	
						<td>&nbsp;&nbsp; <input type="text" name="Q_answer" size="20" value=""></td>
					</tr>
					<tr>
						<td>닉네임 :</td> 
						<td><input type="text" name="nickname"></td> 
					</tr>
					<tr>
					<td align="center" style="font-family:Sans-Serif;">선호 장르:</td>
					<td>
						<input type="radio" name="prefer" checked value = "곡두">곡두
						<input type="radio" name="prefer" value = "깜냥깜냥">깜냥깜냥
						<input type="radio" name="prefer" value = "나비잠">나비잠
						<input type="radio" name="prefer" value = "다솜">다솜
						<input type="radio" name="prefer" value = "달비슬">달비슬
						<br>
						<input type="radio" name="prefer" value = "라온">라온
						<input type="radio" name="prefer" value = "미르">미르
						<input type="radio" name="prefer" value = "슬품">슬품
						<input type="radio" name="prefer" value = "시나브로">시나브로
						<input type="radio" name="prefer" value = "우레">우레
						<br>
						<input type="radio" name="prefer" value = "은가비">은가비
						<input type="radio" name="prefer" value = "허무룩">허무룩
					</td>	
					</tr> 
					<tr> 
					    <td align="right"colspan="2"><input type="submit" value="회원가입"><input type="reset" value="취소"></td>
					</tr> 
				</table>
			</form>
		</div>


		<div id="bottom">

		</div>

		<?php
		// DB 연결 종료
		mysql_close($connect);
		?>
	</body>
</html>