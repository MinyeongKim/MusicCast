<html>
   <head> 
      <title>NARINATO</title>
      <meta charset = "utf8" />
      <style type="text/css">
         @import url(main.css);
         body 
         {
            color : white;
            background-image : url("background.png");
            background-repeat : no-repeat;
            background-size : 100%;
         }
         #top_margin {
            height : 10%;
         }
         #login_logo {
         float : left;
         height : 25%;
            width : 60%;
            margin : 0px 10% 0px 10%;
         }
         #login_margin_left {
            width : 10%;
            height : 100%;
            float : left;
         }
         #login_margn_right {
            width : 10%;
            height : 100%;
            float : right;
         }
         #main1 {
			background-color : rgba(165,165,165,0.2);
            width : 40%;
            float : left;
			height : 30%;
         }
         #main2 {
			background-color : rgba(165,165,165,0.2);
            width : 40%;            
            float : left;
			height : 30%;
         }

         #button {
         width : 80%;
         float : left;
         margin : 3% 0px 10px 0px;
         }
      </style>

      <script language="javascript"> 
         function check() { 
            if (!document.member.mail.value) { 
               alert("Enter E-mail please"); 
               document.member.id.focus(); 
               return false; 
            } 
            if (!document.member.passwd.value) { 
               alert("Enter Password please"); 
               document.member.passwd.focus(); 
               return false; 
            }
            if (!document.member.Q_answer.value) { 
               alert("Enter Answer to Question please"); 
               document.member.passwd.focus(); 
               return false; 
            } 
            if (!document.member.nickname.value) { 
               alert("Enter nickname please"); 
               document.member.passwd.focus(); 
               return false; 
            }
         } 
      </script>
   </head>

   <body>
      <div id = "top_margin">
      <p></p>
      </div>

      <div id = "login_margin_left">
      <p></p>
      </div>

      <div id = "login_logo">
         <center><image src = "logo_icon.png" width = 60%>
      </div>
      <form name="member" method="post" ENCTYPE="multipart/form-data" onsubmit="return check();" action = "member_enroll.php"> 
         <div id = "main1">
            <table width="500" align="right" border="0" cellpadding="3"> 
               <tr>   
                  <td align = "right">E-mail :</td> 
                  <td><input type="text" name="mail"></td>
               </tr>  
               <tr> 
                  <td align = "right">Password :</td> 
                  <td><input type="password" name="passwd" ></td> 
               </tr> 
               <?php
                  $mysql_hostname = 'localhost';
                  $mysql_username = 'root';
                  $mysql_password = 'apmsetup';
                  $mysql_database = 'musiccast';

                  // DB ¿¬°á
                  $connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 

                  // DB ¼±ÅÃ
                  mysql_select_db($mysql_database, $connect) or die('DB ¼±ÅÃ ½ÇÆÐ');

                  $question_select = "SELECT Q_contents FROM question";
                  $result = mysql_query($question_select, $connect);
                  echo "<tr>
                     <td align=\"right\";>Question:</td>
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
                  <td align="right">Answer:</td>   
                  <td><input type="text" name="Q_answer" size="20" value=""></td>
               </tr>
               <tr>
                  <td align = "right">Nickname :</td> 
                  <td><input type="text" name="nickname"></td> 
               </tr>
            </table>
         </div>
         <div id = "main2">
            <center><table>
               <tr>
                  <td align="center"><font size = "5"><b>&lt; Preference Genre &gt;</b></td></font>
               </tr>
               <tr>
                  <td></td>
               </tr>
               <tr>
                  <td>
                     <input type="radio" name="prefer" checked value = "fear">Fear <!--°øÆ÷-->
                     <input type="radio" name="prefer" value = "cheer">cheer <!--ÀÀ¿ø-->
                     <input type="radio" name="prefer" value = "drowsy">Drowsy <!--³ª¸¥-->
                     <input type="radio" name="prefer" value = "dear">Dear <!--¾ÖÆ¶-->
                     <br>
                     <input type="radio" name="prefer" value = "dreamlike">Dreamlike <!--¸ùÈ¯-->
                     <input type="radio" name="prefer" value = "pleasant">Pleasant <!--½Å³²/Áñ°Å¿î-->
                     <input type="radio" name="prefer" value = "magnificent">Magnificent <!--¿õÀå-->
                     <br>
                     <input type="radio" name="prefer" value = "sad">Sad <!--½½ÇÄ-->
                     <input type="radio" name="prefer" value = "thrill">Thrill <!--¼³·½-->
                     <input type="radio" name="prefer" value = "anger">Anger <!--ºÐ³ë-->
                     <input type="radio" name="prefer" value = "quiet">Quiet <!--ÀÜÀÜ-->
                     <input type="radio" name="prefer" value = "lonely">Lonely <!--¾µ¾µ-->
                  </td>   
               </tr> 
            </table>
         </div>
         <div id = "button">
         <p></p>
            <center><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Cancel" onclick = "location.href = 'login.php'">
         </div>
      </form>
      <div id = login_margin_right>
      <p></p>
      </div>
      
      <div id="bottom">

      </div>

      <?php
      // DB ¿¬°á Á¾·á
      mysql_close($connect);
      ?>
   </body>
</html>