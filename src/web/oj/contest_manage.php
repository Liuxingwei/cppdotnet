<?php
////////////////////////////Common head
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title= "我创建的比赛";
	
///////////////////////////MAIN	
if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再管理比赛!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
/*if(!isset($_SESSION['contest_creator']) && !isset($_SESSION['administrator'])){
	$view_errors="你没有权限管理比赛!!!请联系管理员!";
    require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}*/
$user_id=$_SESSION['user_id'];
$sql="SELECT `rightstr` FROM `privilege` WHERE `user_id`='$user_id' AND `rightstr` LIKE 'm%' ORDER BY `rightstr` DESC ";
// echo "<script>console.log('".$sql."')</script>";
$result=mysqli_query($mysqli, $sql);
$contest_cnt=0;
while($row=mysqli_fetch_object($result)){
	$cid=substr($row->rightstr,1);
	$sql="SELECT `contest_id`,`title`,`start_time`,`end_time`,`defunct`,`private` FROM `contest` WHERE `contest_id`=$cid";
	$tmp_result=mysqli_query($mysqli,$sql);
	$tmp_row=mysqli_fetch_object($tmp_result);
	$view_contest[$contest_cnt]['contest_id']=$tmp_row->contest_id;
	$view_contest[$contest_cnt]['title']=$tmp_row->title;
	$view_contest[$contest_cnt]['start_time']=$tmp_row->start_time;
	$view_contest[$contest_cnt]['end_time']=$tmp_row->end_time;
	$view_contest[$contest_cnt]['defunct']=$tmp_row->defunct;
	$view_contest[$contest_cnt]['private']=$tmp_row->private;
	$contest_cnt++;
	mysqli_free_result($tmp_result);
}

mysqli_free_result($result);

if(function_exists('apc_cache_info')){
	 $_apc_cache_info = apc_cache_info(); 
		$view_apc_info =_apc_cache_info;
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/contest_manage.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
