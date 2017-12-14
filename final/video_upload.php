<?php
session_start();

/*if(!isset($_SESSION["user"]) || !is_array($_SESSION["user"]) || empty($_SESSION["user"])) {
      // redirect to login page
}*/

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

// DB 선택
mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');


// DB 연결완료
$email = $_SESSION['login_email'];
$nickname = $_SESSION['login_nick'];

$target_dir = ("C:\APM_Setup\htdocs\\".date("YmdHis")."_");
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

/*
// Allow certain file formats
if($imageFileType != "mp4" ) {
    echo "Sorry, only MP4, MOV, M4V, MKV & AVI files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	echo $email;
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
		$sql_number =  "select count(*)  from h_video ";
		$result_number = mysql_query($sql_number, $connect);
		$video_number = mysql_result($result_number, 0, 0)+1;
		
		$now = date("y-n-j");
		$file_name = (date("YmdHis")."_". basename($_FILES["fileToUpload"]["name"]));
        $sql = "insert into h_video (v_num, p_img, title, category, upload_date, nickname, view, n_like, v_file, source,
 context, v_check) values ('$video_number','image','title', 'category','date','$nickname', 0, 0, '$file_name', 'source', 'text', 1)";
        if(mysql_query($sql, $connect)){
            echo "<script>alert('Choose video');</script>";
			echo ("<script>location.replace('write.php');</script>");
        }
        else{
            echo "fail to insert sql";
        }
    } 
    else {
		echo "fail";
    }
}
mysql_close($connect);
?>