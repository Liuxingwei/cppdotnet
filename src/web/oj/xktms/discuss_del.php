<?php
 require_once("admin-header.php");
ini_set("display_errors","On");
require_once("../include/check_get_key.php");
if (!(isset($_SESSION['administrator']))){
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
}
?> 
<?php

if(isset($_GET['discuss_id'])){
	$discuss_id=intval($_GET['discuss_id']);
	$sql="DELETE FROM `discuss` WHERE `discuss_id`=$discuss_id";
	mysqli_query($mysqli,$sql) or die(mysqli_error());
}else if(isset($_GET['comment_id'])){
	$comment_id=intval($_GET['comment_id']);
	$sql="DELETE FROM `comment` WHERE `comment_id`=$comment_id";
	mysqli_query($mysqli,$sql) or die(mysqli_error());
}else if(isset($_GET['blog_id'])){
	$blog_id=intval($_GET['blog_id']);
	$sql="DELETE FROM `blog` WHERE `blog_id`=$blog_id";
	mysqli_query($mysqli,$sql) or die(mysqli_error());
}else if(isset($_GET['blog_discuss_id'])){
	$blog_discuss_id=intval($_GET['blog_discuss_id']);
	$sql="DELETE FROM `blog_discuss` WHERE `discuss_id`=$blog_discuss_id";
	mysqli_query($mysqli,$sql) or die(mysqli_error());
}else if(isset($_GET['blog_comment_id'])){
	$blog_comment_id=intval($_GET['blog_comment_id']);
	$sql="DELETE FROM `blog_comment` WHERE `comment_id`=$blog_comment_id";
	mysqli_query($mysqli,$sql) or die(mysqli_error());
}
?>
<script language=javascript>
        history.go(-1);
</script>
