<?php
   $mysql_hostname = 'localhost';
   $mysql_username = 'root';
   $mysql_password = 'apmsetup';
   $mysql_database = 'musiccast';
   session_start();
   // DB ����
   $connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

   // DB ����
   mysql_select_db($mysql_database, $connect) or die('DB ���� ����');
    $myusername=$_POST['user_email']; 
    $mypassword=$_POST['user_pw']; 


   //sql : �Է��� email�� password�� �������� Ȯ���ϴ� query��
   //result : query���� db���� ����
   //count : query���� ������ ��� ���� ��
   $sql = "select count(*) from user_info where email = '$myusername' and password = '$mypassword'";
   $result = mysql_query($sql, $connect);
   $count = mysql_result($result, 0, 0);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1)  //count�� 1�̶�� ���� ���̵�� �н����尡 ��ġ�ϴ� db�� �ϳ� ������ �ǹ��մϴ�. 
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
      //session�ܿ��� plag�� �α��� ���θ� Ȯ���ؾߵǴ��� Ȯ���ϱ�
      //$login_sql = "UPDATE user_info SET plag = 1 WHERE email = '$myusername'";
      mysql_query($login_sql, $connect);
      //login�� �������� �ÿ�, home.php�� �̵�
      echo("<script>location.replace('home.php');</script>");
    }
    else 
    {
      echo "<script>alert('Login failed');</script> "; 
      echo ("<script>location.replace('login.php');</script>");
    }
   mysql_close($connect);
?>