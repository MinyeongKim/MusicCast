<!--- 게시글 수정 -->
<?php
	session_start();
	//include "../db.php";
	//header('Content-Type: text/html; charset=utf-8');


$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'apmsetup';
$mysql_database = 'musiccast';

// DB 연결
$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
// DB 선택
mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

	$bno = $_GET["indx"];
	$sql = "select * from h_video where v_num='".$bno."'";
	$result = mysql_query($sql, $connect);
	$board = mysql_fetch_array($result);
	$nick = $_SESSION['login_nick'];
	if (strcmp($nick, $board['nickname']) != 0) {
		echo "<script>alert('작성자가 아닙니다.');</script> ";
		echo ("<script>location.replace('DAMIN_composer.php');</script>");
	}
 ?>
 <!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title>게시판</title>
  <link rel="stylesheet" href="/style.css" />
 </head>
 <body>
 <h4>글수정</h4>
        <div id="board_write">
            <form action="modify_ok.php?indx=<?php echo $board['indx']; ?>" method="post">
            <input type="hidden" name="indx" value="<?=$bno?>">
                    <table id="boardWrite">
                        <tr>
                            <td class="tb"><label for="uname">이름</label></td>
                            <td height="30"><input type="text" value="<?php echo $board['name']; ?>" name="name" id="uname" size="50" class="inh"/></td>
                        </tr>
                        <tr>
                            <td class="tb"><label for="upw">비밀번호</label></td>
                            <td height="30"><input type="password" name="pw" id="upw" size="50"/></td>
                        </tr>
                        <tr>
                            <td class="tb"><label for="utitle">제목</label></td>
                            <td height="30"><input type="text" value="<?php echo $board['title']; ?>" name="title" id="utitle" size="50"/></td>
                        </tr>
                        <tr>
                            <td class="tb"><label for="ucontent">내용</label></td>
                            <td height="30"><textarea name="content" id="ucontent" rows="10" cols="37"><?php echo $board['content']; ?></textarea></td>
                        </tr>
                    </table>
                <div class="bt_se">
                    <button>작성</button>
                </div>
            </form>
        </div>
    </body>
</html>
