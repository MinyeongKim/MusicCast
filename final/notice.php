<html>
<head> 
<title>Welcome to Incheon</title>
<style type="text/css">
@import url(main.css);
<script type="text/javascript">
 function check(){
  if(document.search.keyWord.value==''){
   alert('�˻�� �Է��ϼ���'); 
   document.search.keyWord.focus();
   return false; 
  }  
 }
</script>
</style>
</head>

<body>
<div id="main">
<a class="p1" align="left">��������</a>

<div id="menu">
<ul>
<li><a href="home.php"><img src="Home_icon.png" height=30px></a></li>
<li><a href="ranking.php"><img src="ranking_icon.png" height=30px></a></li>
<li><a href="video.php"><img src="video_icon.png" height=30px></a></li>
<li><a href="composer.php"><img src="composer_icon.png" height=30px></a></li>
</ul>
</div>

<div id = "search">
<form name = "search" method = "get" action ="a.jsp" onsubmit="return check()">
 <table width="500" border="0" align="right">
  <tr>
   <td align ="center" valign="bottom">
    <select name="keyField">
     <option value="subject">��ü</option>
     <option value="writer">�۰</option>
     <option value="content">����</option>
     </select>
     </td>
     
   <td>
    <input type="text" size="50" name="keyWord"> 
   </td>
   
   <td>
    <input type="submit" value="�˻�">
   </td>  

  </tr>
 </table>
</form>
</div>

</div>
<br>

<div id="background">
   <table align="center" border=1>
 <thead>
  <tr>
     <th>��ȣ</th>
     <th>����</th>
     <th>�ۼ���</th>
     <th>��¥</th>
  </tr>
 </thead>
</table>
</div>

<div id="bottom">

</div>
</body>
</html>