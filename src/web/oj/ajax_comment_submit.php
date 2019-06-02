<?php
////////////////////////////Common head
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

if(!isset($_POST['discuss_id'])){
    echo 'error discuss_id';
    exit(0);
}
$discuss_id=intval($_POST['discuss_id']);
$reply_to_user_id=mysqli_real_escape_string($mysqli, $_POST['reply_to']);
$sql = "SELECT discuss_id FROM discuss where discuss_id=$discuss_id";
$result=mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)!=1){
    echo 'error discuss_id';
    exit(0);
}
mysqli_free_result($result);
if(!isset($_SESSION['user_id'])){
	echo 'not login';
	exit(0);
}
$comment_content=mysqli_real_escape_string($mysqli,trim($_POST['comment_msg']));

$user_id = $_SESSION['user_id'];

$now=strftime("%Y-%m-%d %X",time()-10);
$sql="SELECT `post_time` from `comment` where `user_id`='$user_id' and post_time>'$now' order by `post_time` desc limit 1";
$res=mysqli_query($mysqli,$sql);
if (mysqli_num_rows($res)==1){
	echo "too fast";
	exit(0);
}
mysqli_free_result($result);
if(!empty($reply_to_user_id)){
	$comment_content="@".$reply_to_user_id." ".$comment_content;
}
$sql = "INSERT INTO comment (user_id,post_time,content,discuss_id,status) VALUES ('$user_id', NOW(), '$comment_content',$discuss_id,1)";
mysqli_query($mysqli, $sql) or die('error');
echo 'true';
$sql="SELECT user_id,discuss.problem_id,title FROM `discuss`,`problem` WHERE `discuss_id`=$discuss_id && discuss.problem_id=problem.problem_id";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
if($row && $row->user_id!=$user_id){
	$to_user=$row->user_id;
	$title="您的讨论收到了回复";
	$content="您在问题".$row->problem_id."(".$row->title.")的讨论收到了回复, 快去看看吧.<a href=\"discuss$row->problem_id.html#$discuss_id\">传送门</a>";
	$sql = "INSERT INTO `mail` (`to_user`, `from_user`, `title`, `content`, `new_mail`, `reply`, `in_date`, `defunct`) VALUES ('$to_user', 'sy','$title', '$content', 1, 0, NOW(), 'N')";
	// echo $sql;
	mysqli_query($mysqli, $sql);
}

if(!empty($reply_to_user_id)){
	$sql="SELECT discuss.problem_id,title FROM `discuss`,`problem` WHERE `discuss_id`=$discuss_id && discuss.problem_id=problem.problem_id";
	$result=mysqli_query($mysqli, $sql);
	$row=mysqli_fetch_object($result);
	if($row){
		$to_user=$reply_to_user_id;
		$title="您的讨论收到了回复";
		$content="您在问题".$row->problem_id."(".$row->title.")的讨论收到了回复, 快去看看吧.<a href=\"discuss$row->problem_id.html#$discuss_id\">传送门</a>";
		$sql = "INSERT INTO `mail` (`to_user`, `from_user`, `title`, `content`, `new_mail`, `reply`, `in_date`, `defunct`) VALUES ('$to_user', 'sy','$title', '$content', 1, 0, NOW(), 'N')";
		// echo $sql;
		mysqli_query($mysqli, $sql);
	}
}
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>
