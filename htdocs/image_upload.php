<!DOCTYPE html>
<!-- ���� �ʿ�, ���� ���� ������ ������ �����ϱ� ���ؼ� ���ο� â���� �̵��Ͽ� �Ѵ�. -->
<html>
<head>
</head>
<body>
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
</body>
</html>