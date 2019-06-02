<?php	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Welcome To Online Judge";
	if (!isset($_SESSION['user_id'])){
		$view_errors= "<a href=./loginpage.php>$MSG_Login</a>";
		
		require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	}

$sql="SELECT * FROM `users` WHERE `user_id`='".$_SESSION['user_id']."'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);

mysqli_free_result($result);

$nick_change=true;
$user_id=$_SESSION['user_id'];
$now=strftime("%Y-%m-%d %X",time()-(60*60*24*90));
$sql="SELECT `last_nick_time` from `users` where `user_id`='$user_id' and last_nick_time>'$now' order by `last_nick_time` desc limit 1";
$result = mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)==1){
	$nick_change=false;
	$tmprow=mysqli_fetch_object($result);
	$next_nick_time=strftime("%Y-%m-%d %X",strtotime($tmprow->last_nick_time)+(60*60*24*90));
}
mysqli_free_result($result);
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/modifypage.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

