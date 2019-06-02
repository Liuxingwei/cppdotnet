<?php session_start();

require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/my_func.inc.php');
require_once('./include/const.inc.php');
require_once('./include/setlang.php');
require_once ("./include/email_class.php"); 

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再预约比赛!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

if (isset($_GET['contest_id'])){
	$contest_id = htmlentities($_GET['contest_id']);
	$user_id=$_SESSION['user_id'];

	$sql="SELECT `start_time` FROM `contest` WHERE `contest_id`='".$contest_id."'";
	$result=mysqli_query($mysqli, $sql);
	$row=mysqli_fetch_row($result);

	$start_time=strtotime($row[0]);
	$now=time();
	$contest_date=date("Y-m-d",$start_time);
	$order_time=strtotime($contest_date)-25200;
	mysqli_free_result($result);

	if($now>$order_time){
	    $view_errors="太晚了！！！本次比赛预约功能已关闭！！！";
	    require("template/".$OJ_TEMPLATE."/error.php");
	    exit(0);
	}

	$sql="SELECT * FROM `users` WHERE `user_id`='".$user_id."' AND find_in_set('".$contest_id."',order_contest)";
	$result=mysqli_query($mysqli, $sql);

	if (mysqli_num_rows($result) !==0)
	{
		$view_errors="您已经预约过该比赛了，我们会在比赛开始前一天的晚6点给您发送提醒邮件！<br />　　请在个人资料修改正确的邮箱地址！";
	    require("template/".$OJ_TEMPLATE."/order_message.php");
	    exit(0);
	}
	else
	{
		$sql="UPDATE users SET order_contest=CONCAT(order_contest,'".$contest_id.",') WHERE user_id='".$user_id."'";
	    $view_errors="预约成功！<br />　　我们会在比赛开始前一天的晚6点给您发送提醒邮件，若您的邮箱地址不正确或尚未填写，请尽快修改正确的邮箱地址！";
	    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
	    require("template/".$OJ_TEMPLATE."/order_message.php");
	    exit(0);
	}

}

?>