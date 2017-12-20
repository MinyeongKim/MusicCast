<?php
   $mysql_hostname = 'localhost';
   $mysql_username = 'root';
   $mysql_password = 'apmsetup';
   $mysql_database = 'musiccast';
   session_start();
   // connect DB
   $connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

   // select DB
   mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

   $myusername=$_POST['user_email']; 
   $mypassword=$_POST['user_pw']; 

   // check if user is or not.
   $sql = "select count(*) from user_info where email = '$myusername' and password = '$mypassword'";
   $result = mysql_query($sql, $connect);
   $count = mysql_result($result, 0, 0);

  // if there is information about this user in DB
   if($count==1) {
      $_SESSION['login_email']=$myusername;
      $_SESSION['login_pw'] = $mypassword;
      
      // bring user's nickname
      $sql2 = "select nickname from user_info where email = '$myusername'";
      $result = mysql_query($sql2, $connect);
      $data = mysql_fetch_array($result);
      $_SESSION['login_nick'] = $data["nickname"];

      // bring user is composer or not
      $nick = $_SESSION["login_nick"];
      $sql3 = "select is_composer from user_info where nickname = '$nick'";
      $result = mysql_query($sql3, $connect);
      $data = mysql_fetch_array($result);
      $_SESSION['login_composer'] = $data["is_composer"];

      echo("<script>location.replace('home.php');</script>");
   }

   else {
      echo "<script>alert('Login failed');</script> "; 
      echo ("<script>location.replace('login.php');</script>");
    }
   //close DB
   mysql_close($connect);
?>
