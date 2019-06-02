<?php

require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/my_func.inc.php');
require_once('./include/setlang.php');

$contest_id=$_GET['contest_id'];
$sql="SELECT `private` FROM `contest` WHERE `contest_id`=$contest_id";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$private=intval($row->private);
if ($private!=0) {
	$view_errors="私有比赛无法预约!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再预约比赛!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$userid=$_SESSION['user_id'];

$sql="SELECT * FROM `users` WHERE `user_id`='$userid'";
$result=mysqli_query($mysqli, $sql);
if($row=mysqli_fetch_object($result)){
	$nick=$row->nick;
	$age=intval($row->age);
	$school=$row->school;
	$subject=$row->subject;
	$phone=$row->phone;
	$email=$row->email;
	$address=$row->address;
	if($row->is_work=='0'){
		$iswork='学生';
	}else if($row->is_work=='1'){
		$iswork='在职';
	}else{
		$iswork='待业';
	}
}

require("template/".$OJ_TEMPLATE."/info_check.php");

?>