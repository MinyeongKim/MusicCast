<?php @session_start(); ?>
<html>
	<head>
		<title>NARINATO</title>
			<style type="text/css">
				@import url(main.css);
				body 
				{	
					background-image : url("home_back.png");
					background-repeat : no-repeat;
					background-size : 100%;
				}
			</style>
	</head>
	<body>
		<?php 
			$composer = $_SESSION['login_composer'];
			//if user is not composer, user can't write video.
			if ($composer != 1) {
				echo "<script>alert('Not composer');</script>";
				echo "<script>location.replace('DAMIN_composer.php');</script>";
			}
			
			//if user is not login, return login page
			if(!($_SESSION['login_email'])) {
				echo ("<script>location.replace('login.php');</script>");
			}
		
			$mysql_hostname = 'localhost';
			$mysql_username = 'root';
			$mysql_password = 'apmsetup';
			$mysql_database = 'musiccast';

			// connect DB
			$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password); 
			
			// select DB
			mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

			// check uploaded video file by user
			$nick = $_SESSION['login_nick'];
			$sql_find = "select v_num from h_video where nickname = '$nick' and v_check = 1";
			$video_number = mysql_query($sql_find, $connect);
		
			// if there is video not to be finished to upload, delete that
			$row = mysql_fetch_array($video_number);
			$video_num = $row["v_num"];
			$sql_delete = "delete from h_video where v_num = '$video_num'";
			mysql_query($sql_delete, $connect);
		
			//close DB
			mysql_close($connect);
		?>
		<!-- to upload file -->
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
	</body>
</html>
