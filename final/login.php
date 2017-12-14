<html>
   <head>
      <style type="text/css">
      @import url(main.css);
         @font-face {
            font-family: "ABC";
            src: url('경필명조B.eot');
            src: url('경필명조B.eot?#iefix') format('embedded-opentype');
         }

         @font-face {
            font-family: "RBC";
            src: url('경필명조B.woff') format('woff');
            src: url('경필명조B.ttf') format('truetype');
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
   <div id = "top_margin">
   <p></p>
   </div>
   <div id = "login_margin_left">
   <p></p>
   </div>
   <!-- 로고 이미지 -->
   <div id = "login_logo">
      <center><image src = "logo_icon.png" width = 60%>
   </div>
      <div id = "login">
         <form method = "post" action = "login_access.php">
         <center><table>
              <tr>
               <td>
                 &nbsp;&nbsp;&nbsp;E-MAIL :&nbsp;&nbsp;&nbsp;
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
         <center><p><input type="submit" value="Login"/>&nbsp;&nbsp;&nbsp;<input type = "button" value = "Join" onclick = "location.href = 'enroll.php'"></p>
      <!--<p><a href = "ID_PW.php">ID/PW 찾기</a></p>-->
      </div>
   <div id = login_margin_right>
   <p></p>
   </div>
   </body>
</html>