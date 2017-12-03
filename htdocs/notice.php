<html>
<head> 
<title>Welcome to Incheon</title>
<style type="text/css">
@import url(main.css);
<script type="text/javascript">
 function check(){
  if(document.search.keyWord.value==''){
   alert('검색어를 입력하세요'); 
   document.search.keyWord.focus();
   return false; 
  }  
 }
</script>
</style>
</head>

<body>
<div id="main">
<a class="p1" align="left">나린아토</a>

<div id="menu">
<ul>
<li><a href="home.php">Home</a></li>
<li><a href="ranking.php">Ranking</a></li>
<li><a href="video.php">Video</a></li>
<li><a href="composer.php">Composer</a></li>
<li><a href="notice.php">Notice</a></li>
</ul>
</div>

<div id = "search">
<form name = "search" method = "get" action ="a.jsp" onsubmit="return check()">
 <table width="500" border="0" align="right">
  <tr>
   <td align ="center" valign="bottom">
    <select name="keyField">
     <option value="subject">전체</option>
     <option value="writer">작곡가</option>
     <option value="content">제목</option>
     </select>
     </td>
     
   <td>
    <input type="text" size="50" name="keyWord"> 
   </td>
   
   <td>
    <input type="submit" value="검색">
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
     <th>번호</th>
     <th>제목</th>
     <th>작성자</th>
     <th>날짜</th>
  </tr>
 </thead>
</table>
</div>

<div id="bottom">

</div>
</body>
</html>