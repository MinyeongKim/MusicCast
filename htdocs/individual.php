<!-- �α��� ������ �̿��ϱ� ���ؼ� �ʼ����� -->

<html>
<head> 
<title>��������</title>
<style type="text/css">
@import url(main.css);
</style>
</head>

<body>
<div id="main">
<a class="p1" align="left">��������</a>

<div id="menu">
<ul>
<li><a href="home.php">Home</a></li>
<li><a href="ranking.php">Ranking</a></li>
<li><a href="video.php">Video</a></li>
<li><a href="composer.php">Composer</a></li>
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
   <div id="submenu">
	<ul>
	<div id="submenu">
   <ul>
   <li><a href="individual.php">Home</a></li>
   <li><a href="ownmusic.php">Video</a></li>
   <li><a href="timelind.php">TimeLine</a></li>
   <li><a href="cheer.php">Cheer</a></li>
   </ul>
   </div>
	</ul>
	</div>
   <br><br>
   <img class="composerimage" src="https://image.freepik.com/free-vector/circle-made-of-music-instruments_23-2147509304.jpg" alt="composer" align=left>
   <p class="composerRecommand">Name:</p><br>
   <p class="composerRecommand">Tendency:</p><br>
   <p class="composerRecommand">Introduce:</p><br>
   </div>
   <div class="videolist">
		<div id="big-form" class="well auth-box">
			<form class="form-horizontal"  action="video_upload.php" method="post" enctype="multipart/form-data">
				<!-- Form Name -->
				<legend>Uploading as <?= $_SESSION["user"]["firstname"] ?></legend>

				<!-- Textarea -->
				<div class="form-group">
					<div class="">              
						<input type="file" name="fileToUpload" id="fileToUpload">
					</div>
			    </div>
				<div class="form-group">
					<div class="col-md-8">
						<button id="updateprofile" value="Upload Video" name="updateprofile" class="btn btn-success">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
 </div>
</div>
<div id="bottom">

</div>
</body>
</html>