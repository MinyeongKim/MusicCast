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
$sql_nickname = "select nickname from user_info where email = '$email'";
$result = mysql_query($sql_nickname, $connect);
$nickname = mysql_result($result,0);

$target_dir = ('C:\APM_Setup\htdocs\\');
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
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo header('Location: individual.php');
        
        $now = date("y-n-j");

        $sql = "insert into h_video (v_num, p_img, title, category, upload_date, nickname, view, n_like, v_file, source,
 context) values (2,'abc','Test','rr','$now','$nickname',0,0,'$target_file','rrr','rrr')";
        if(mysql_query($sql, $connect)){
            echo 'success inserting';
        }
        else{
            echo 'fail to insert sql';
        }
    } 
    else {
        echo header('Location: individual.php');
    }
}
mysql_close($connect);
?>