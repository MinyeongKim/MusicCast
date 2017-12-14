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

<?php
   $mysql_username = 'root';
   $mysql_password = 'apmsetup';
   $mysql_database = 'musiccast';
   //php에서 session을 이용하기 위해서는 session_start()를 무조건 해줘야함
   session_start();
   // DB 연결
   $connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

   // DB 선택
   mysql_select_db($mysql_database, $connect) or die('Fail DB selection');

   //$login_sql = "UPDATE user_info SET plag = 0 WHERE email = '$_SESSION['login_email']'";
   //mysql_query($login_sql, $connect);
   //session으로 로그인을 유지했기 때문에 이를 없애주는 것
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
	<center><table> <tr> <td align="center">Login completed successfully.</td></tr>
	<tr><td align="center">If you want to login, <a href = "login.php">Click</a> Please.</td></tr></table></div>



</html>