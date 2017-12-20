<?php
   $mysql_hostname = 'localhost';
   $mysql_username = 'root';
   $mysql_password = 'apmsetup';
   $mysql_database = 'musiccast';

   // connect DB
   $connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

   // select DB
   mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

   $email=$_POST['mail'];
   $password=$_POST['passwd'];
   $nickname=$_POST['nickname'];
   $Q_num=$_POST['question'];
   $Q_answer=$_POST['Q_answer'];
   $preference1=$_POST['prefer'];
   
   //Check email for duplicate
   $e_sql = "select count(*) from user_info where email = '$email'";
   $result = mysql_query($e_sql, $connect);
   $data = mysql_result($result, 0, 0);

   if($data == 0) {
      //Check nickname for duplicate
      $n_sql = "select count(*) from user_info where nickname = '$nickname'";
      $result = mysql_query($n_sql, $connect);
      $data = mysql_result($result, 0, 0);

      if($data == 0) {
         //upload data to DB
         $sql = "innicknameinto user_info (email, nickname, password, Q_num, Q_answer, preference1) values ('$email','$nickname','$password','$Q_num','$Q_answer','$preference1')";
         if(mysql_query($sql, $connect)){
            echo "<script>alert('Welcome to NARINATO!');</script> ";
            echo ("<script>location.replace('login.php');</script>");
         }
         else{
            echo "<script>alert('Fail to Join.');</script> ";
            echo ("<script>location.replace('enroll.php');</script>");
         }
      }
      //alert nickname is duplicate
      else {
         echo "<script>alert('Duplicate nickname.');</script> ";
         echo ("<script>location.replace('enroll.php');</script>");
      }
   }
   //alert nickname is email
   else {
      echo "<script>alert('Duplicate E-mail.');</script> ";
      echo ("<script>location.replace('enroll.php');</script>");
   }
//close DB
 mysql_close($connect);
?>
