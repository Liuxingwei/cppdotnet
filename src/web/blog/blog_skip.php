<?php
require_once('include/db_info.inc.php');
require_once('include/setlang.php');
require_once('include/my_func.inc.php');

$blog_id=$_GET['blog_id'];
$page=$_GET['page'];

$sql="SELECT `user_id` FROM `blog` WHERE `blog_id`='".$blog_id."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_array($result);
mysqli_free_result($result);

$user_id=$row['user_id'];

if (isset($_GET['page'])) {
	header("location:/".$user_id."/".$blog_id."-".$page);
}
else {
	header("location:/".$user_id."/".$blog_id);
}
?>