<?php
   $mysql_hostname = 'localhost';
   $mysql_username = 'root';
   $mysql_password = 'apmsetup';
   $mysql_database = 'musiccast';
   session_start();
   // DB 연결
   $connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

   // DB 선택
   mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');
    $myusername=$_POST['user_email']; 
    $mypassword=$_POST['user_pw']; 


   //sql : 입력한 email과 password가 동일한지 확인하는 query문
   //result : query문을 db에서 실행
   //count : query문을 실행한 결과 줄의 수
   $sql = "select count(*) from user_info where email = '$myusername' and password = '$mypassword'";
   $result = mysql_query($sql, $connect);
   $count = mysql_result($result, 0, 0);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1)  //count가 1이라는 것은 아이디와 패스워드가 일치하는 db가 하나 있음을 의미합니다. 
    {
        //session_register("myusername");
        $_SESSION['login_email']=$myusername;
      $_SESSION['login_pw'] = $mypassword;

      $sql2 = "select nickname from user_info where email = '$myusername'";
      $result = mysql_query($sql2, $connect);
      $data = mysql_fetch_array($result);
      $_SESSION['login_nick'] = $data["nickname"];

      $nick = $_SESSION["login_nick"];
      $sql3 = "select is_composer from user_info where nickname = '$nick'";
      $result = mysql_query($sql3, $connect);
      $data = mysql_fetch_array($result);
      $_SESSION['login_composer'] = $data["is_composer"];

      echo "". $_SESSION['login_email'] ."";
      echo "". $_SESSION['login_nick'] ."";
      //session외에도 plag로 로그인 여부를 확인해야되는지 확인하기
      //$login_sql = "UPDATE user_info SET plag = 1 WHERE email = '$myusername'";
      mysql_query($login_sql, $connect);
      //login을 성공했을 시에, home.php로 이동
      echo("<script>location.replace('home.php');</script>");
    }
    else 
    {
      echo "<script>alert('Login failed');</script> "; 
      echo ("<script>location.replace('login.php');</script>");
    }
   mysql_close($connect);
?>