<?php
////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');

if(!isset($_SESSION['user_id'])){
    $_SESSION['prev_page']=curPageURL();
    // echo "<!-- ".$_SESSION['prev_page']." -->";
}

$url_oj_home="https://www.dotcpp.com";
$url_oj="https://www.dotcpp.com/oj/";
$now=strftime("%Y-%m-%d %H:%M",time());
$view_title= "写文章 - C语言网";

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=".$url_oj."loginpage.php>登录</a>后再写文章!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$nick=$_SESSION['nick'];

$user_id=$_SESSION['user_id'];
$sql="SELECT `user_lvl` FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$user_lvl=$row->user_lvl;
if ($user_lvl<3) {
	$view_errors="您的账号等级太低无法发表文章，请达到P3等级(EXP>500)再来吧！";
    require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}

require("template/".$OJ_TEMPLATE."/userblog_edit.php");
?>