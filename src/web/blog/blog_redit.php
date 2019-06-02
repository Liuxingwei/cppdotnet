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
$view_title= "重新编辑 - C语言网";

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=".$url_oj."loginpage.php>登录</a>后再写文章!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$nick=$_SESSION['nick'];
$blog_id=intval($_GET['blog_id']);
$sql="SELECT `user_id`,`title`,`content`,`problem_id` FROM `blog` WHERE `blog_id`='".$blog_id."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$tmprow=mysqli_fetch_array($result);
mysqli_free_result($result);

if ($tmprow['user_id']!==$_SESSION['user_id']) {
	$view_errors="无权操作!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$problem_id=$tmprow['problem_id'];
$sql="SELECT * FROM problem WHERE problem_id=$problem_id";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
mysqli_free_result($result);

require("template/".$OJ_TEMPLATE."/blog_redit.php");
?>