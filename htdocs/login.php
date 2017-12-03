<html>
	<head>
		<style type="text/css">
		@import url(main.css);
		body 
		{
			background-image : url("background.png");
			background-repeat : no-repeat;
			background-size : 100%;
		}
		#login_logo {
		}
		</style>
	</head>
	<body>
		<div id = "login">
			<form method = "post" action = "login_access.php">
			<center><table>
  				<tr>
					<td>
  					&nbsp;&nbsp;&nbsp;E-MAIL :&nbsp;&nbsp;&nbsp;&nbsp;
					<input class="id" name = "user_email" type="text" onfocus="this.className='id_focus'" onblur="if(this.value.length==0) {this.className='id'}"/>
  					</td>
			  	</tr>
				<tr></tr><tr></tr><tr></tr>
				<tr>
			  		<td>
					PASSWORD : 
					<input class="pw" name = "user_pw" type="password" onfocus="this.className='pw_focus'" onblur="if(this.value.length==0){this.className='pw'}"/>
			  		</td>
			  	</tr>
			</table>
			</form>
			<center><p><input type="submit" value="로그인"/>&nbsp;&nbsp;&nbsp;<input type = "button" value = "회원가입" onclick = "location.href = 'enroll.php'"></p>
		<!--<p><a href = "ID_PW.php">ID/PW 찾기</a></p>-->
		</div>
	</body>
</html>