<?php
////////////////////////////Common head
/*$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');*/
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

if(!isset($_GET['blog_id']) && !isset($_GET['user_id'])){
    exit(0);
}
if (isset($_GET['blog_id'])) {
	$blog_id=intval($_GET['blog_id']);
	$sql = "SELECT blog_id FROM blog where blog_id=$blog_id";
	$result=mysqli_query($mysqli, $sql);
	if(mysqli_num_rows($result)!=1){
	    exit(0);
	}
	mysqli_free_result($result);
	$ckname=md5("blogscan$blog_id");
	$tmp="blog_scan_".$blog_id;
	if(isset($_SESSION[$tmp]) || isset($_COOKIE[$ckname])){
		exit(0);
	}

	$sql = "UPDATE blog SET scan=scan+1 WHERE blog_id=$blog_id";
	mysqli_query($mysqli, $sql) or die('error');
	setcookie(md5("blogscan$blog_id"),md5("as981jk2j"),time()+60*60*24);
	$_SESSION[$tmp]=1;
}
if (isset($_GET['user_id'])) {
	$user_id=$_GET['user_id'];
	$sql = "SELECT user_id FROM users where user_id='$user_id'";
	$result=mysqli_query($mysqli, $sql);
	if(mysqli_num_rows($result)!=1){
	    exit(0);
	}
	mysqli_free_result($result);
	$ckname=md5("userscan$user_id");
	$tmp="user_scan_".$user_id;
	if(isset($_SESSION[$tmp]) || isset($_COOKIE[$ckname])){
		exit(0);
	}

	$sql = "UPDATE users SET scan=scan+1 WHERE user_id='$user_id'";
	mysqli_query($mysqli, $sql) or die('error');
	setcookie(md5("userscan$user_id"),md5("as981jk2j"),time()+60*60*24);
	$_SESSION[$tmp]=1;
}
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>