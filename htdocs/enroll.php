<html>
	<head> 
		<title>��������</title>
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
					alert("email�� �Է����ּ���"); 
					document.member.id.focus(); 
					return false; 
				} 
				if (!document.member.passwd.value) { 
					alert("��й�ȣ�� �Է����ּ���"); 
					document.member.passwd.focus(); 
					return false; 
				}
				if (!document.member.Q_answer.value) { 
					alert("�����亯�� �Է����ּ���"); 
					document.member.passwd.focus(); 
					return false; 
				} 
				if (!document.member.nickname.value) { 
					alert("�г����� �Է����ּ���"); 
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
						<td>��й�ȣ :</td> 
						<td><input type="password" name="passwd" ></td> 
					</tr> 
					<?php
						$mysql_hostname = 'localhost';
						$mysql_username = 'root';
						$mysql_password = 'apmsetup';
						$mysql_database = 'musiccast';

						// DB ����
						$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

						// DB ����
						mysql_select_db($mysql_database, $connect) or die('DB ���� ����');

						$question_select = "SELECT Q_contents FROM question";
						$result = mysql_query($question_select, $connect);
						echo "<tr>
							<td align=\"center\" style=\"font-family:Sans-Serif\";>����:</td>
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
						<td align="center" style="font-family:Sans-Serif;">�����亯:</td>	
						<td>&nbsp;&nbsp; <input type="text" name="Q_answer" size="20" value=""></td>
					</tr>
					<tr>
						<td>�г��� :</td> 
						<td><input type="text" name="nickname"></td> 
					</tr>
					<tr>
					<td align="center" style="font-family:Sans-Serif;">��ȣ �帣:</td>
					<td>
						<input type="radio" name="prefer" checked value = "���">���
						<input type="radio" name="prefer" value = "���ɱ���">���ɱ���
						<input type="radio" name="prefer" value = "������">������
						<input type="radio" name="prefer" value = "�ټ�">�ټ�
						<input type="radio" name="prefer" value = "�޺�">�޺�
						<br>
						<input type="radio" name="prefer" value = "���">���
						<input type="radio" name="prefer" value = "�̸�">�̸�
						<input type="radio" name="prefer" value = "��ǰ">��ǰ
						<input type="radio" name="prefer" value = "�ó����">�ó����
						<input type="radio" name="prefer" value = "�췹">�췹
						<br>
						<input type="radio" name="prefer" value = "������">������
						<input type="radio" name="prefer" value = "�㹫��">�㹫��
					</td>	
					</tr> 
					<tr> 
					    <td align="right"colspan="2"><input type="submit" value="ȸ������"><input type="reset" value="���"></td>
					</tr> 
				</table>
			</form>
		</div>


		<div id="bottom">

		</div>

		<?php
		// DB ���� ����
		mysql_close($connect);
		?>
	</body>
</html>