<?php
////////////////////////////Common head
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

///////////////////////////MAIN	
if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再创建比赛!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$ctype="main";
if (isset($_GET['ctype'])) {
 	$ctype=$_GET['ctype'];
}
if ($ctype=="diy") {
	$view_title= "创建自主比赛";
	$user_id=$_SESSION['user_id'];
	$sql="SELECT `user_lvl` FROM `users` WHERE `user_id`='$user_id'";
	$result=mysqli_query($mysqli, $sql);
	$row=mysqli_fetch_object($result);
	$user_lvl=$row->user_lvl;
	if ($user_lvl<2) {
		$view_errors="您的账号等级太低无法创建比赛，请达到P2等级(EXP>100)再来吧！";
	    require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	}
}
else {
	$view_title= "创建比赛";
		
	if(!isset($_SESSION['contest_creator']) && !isset($_SESSION['administrator'])){
		$view_errors="创建标准比赛需要相关权限，如有需求请 <a href=/oj/contactus.php>联系我们</a>！";
	    require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	}
}
$sql="SELECT MAX(`problem_id`) AS mpid FROM problem";
$page_size=100;
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$max_pid=$row->mpid;
$page_cnt=intval(($max_pid-1000)/$page_size)+1;
// echo "<script>console.log('".$page_cnt."')</script>";
mysqli_free_result($result);
$sql="SELECT `problem_id`,`title` FROM problem WHERE `problem_id`>=1000 AND `problem_id`<=1099 AND `defunct`='N' AND `vip`='0' ORDER BY `problem_id`";
$result=mysqli_query($mysqli, $sql);
$problem_cnt=0;
while($row=mysqli_fetch_object($result)){
	$view_problem[$problem_cnt]['problem_id']=$row->problem_id;
	$view_problem[$problem_cnt]['title']=$row->title;
	$problem_cnt++;
}
mysqli_free_result($result);

if(function_exists('apc_cache_info')){
	 $_apc_cache_info = apc_cache_info(); 
		$view_apc_info =_apc_cache_info;
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/contest_add.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
