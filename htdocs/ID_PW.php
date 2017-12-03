<!-- 추후 넣을지 안넣을지 결정 -->
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

<style>
	input.id { width: 140px; background: url("./images/id.png") no-repeat; }
	input.id_focus { width: 140px; }
	input.pw { width: 140px; background: url("./images/pw.png") no-repeat; }
	input.pw_focus { width: 140px; }
	input.login_img { width: 69px; height: 44px; }
	</style>
</head>

<body>
<br>

<div id="background">
	<div id = "body">
<center>
<h1 style="font-family:Sans-Serif; margin-left:-490px;">ID 찾기</h1>
<table bgcolor="#ffffff" border="1" callspacing="0" cellpadding="0"
width="600" height="100" align="center">
 
<form>
<tr>
<td align="center" style="font-family:Sans-Serif;">이름</td>
<td>&nbsp;&nbsp;
<input type="name" name="name" id="name" size="49" value="">
</td>
</tr>
 
<tr>
<td align="center" style="font-family:Sans-Serif;">이메일</td>
<td>&nbsp;&nbsp;
<input type="text" name="email" id="email" size="20" value=""> @ <select name="aff">
<option value="">주소를 선택해 주세요</option>
<option value="">naver.com</option>
<option value="">gmail.com</option>
</select>
</td>
</tr>
 
<tr>
<td align="center" style="font-family:Sans-Serif;">연락처</td>
<td>&nbsp;&nbsp;
<input type="text" name="phone1" id="phone1" size="4" value=""> -
<input type="text" name="phone2" id="phone2" size="4" value=""> -
<input type="text" name="phone3" id="phone3" size="4" value="">
</td>
</tr>
 
</form>
</table>
<p>&nbsp;</p>
<input type="button" value="ID찾기">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="다시작성">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="취소">
 
<h1 style="font-family:Sans-Serif; margin-left:-490px;">PW 찾기</h1>
<table bgcolor="#ffffff" border="1" callspacing="0" cellpadding="0"
width="600" height="100" align="center">
 
<form>
<tr>
<td align="center" style="font-family:Sans-Serif;">아이디</td>
<td>&nbsp;&nbsp;
<input type="text" name="userid" id="id" size="49" value="">
</td>
</tr>
 
<tr>
<td align="center" style="font-family:Sans-Serif;">이름</td>
<td>&nbsp;&nbsp;
<input type="name" name="name" id="name" size="49" value="">
</td>
</tr>
 
<tr>
<td align="center" style="font-family:Sans-Serif;">이메일</td>
<td>&nbsp;&nbsp;
<input type="text" name="email" id="email" size="20" value=""> @ <select name="aff">
<option value="">주소를 선택해 주세요</option>
<option value="">naver.com</option>
<option value="">gmail.com</option>
</select>
</td>
</tr>
 
</form>
</table>
<p>&nbsp;</p>
<input type="button" value="PW찾기">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="다시작성">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="취소">
	
</div>
</div>

<div id="bottom">

</div>
</body>
</html>