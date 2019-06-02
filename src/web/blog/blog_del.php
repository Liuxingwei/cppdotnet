<?php
////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');

$blog_id=intval($_GET['blog_id']);
$sql="SELECT `user_id` FROM `blog` WHERE `blog_id`='".$blog_id."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_array($result);
mysqli_free_result($result);

if($_SESSION['user_id']!==$row['user_id']){
    $view_errors="无权操作!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$sql="UPDATE `blog` SET"
    ."`status`='0'"
    ."WHERE `blog_id`='".$blog_id."'";
mysqli_query($mysqli,$sql) or die("Update Error!\n");
$view_errors="删除成功!";
require("template/".$OJ_TEMPLATE."/error.php");

?>