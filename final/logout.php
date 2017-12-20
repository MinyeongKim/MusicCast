<?php session_start();?>
<html>
   <head>
      <style type="text/css">
         @import url(main.css);
         @font-face {
            font-family : '경필명조B';
            src : url('resources/fonts/DX경필명조B.ttf');
         }
         body
         {
            background-image : url("background.png");
            background-repeat : no-repeat;
            background-size : 100%;
            font-family : '경필명조B';
            color : white;
         }
         #top_margin {
            height : 10%;
         }
         #login_logo {
            float : left;
            height : 25%;
            width : 60%;
         }
         #login_margin_left {
            width : 20%;
            height : 100%;
            float : left;
         }
         #login_margn_right {
            width : 20%;
            height : 100%;
            float : right;
         }

      </style>
   </head>
	<body>
		<?php
			$mysql_username = 'root';
			$mysql_password = 'apmsetup';
			$mysql_database = 'musiccast';
			session_start();

			// connect DB
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

			// select DB
			mysql_select_db($mysql_database, $connect) or die('Fail DB selection');

			// destroy session for logout
			session_destroy();
		?> 
   		<div id = "top_margin">
   			<p></p>
   		</div>
   		<div id = "login_margin_left">
   			<p></p>
   		</div>
   		<div id = "login_logo">
    			<center><image src = "logo_icon.png" width = 60%>
		</div>
		<div id = "login">
			<center><table> 
				<tr> 
					<td align="center">Login completed successfully.</td>
				</tr>
				<tr>
					<td align="center">If you want to login, <a href = "login.php">Click</a> Please.</td>
				</tr>
			</table>
		</div>
	</body>
</html>
