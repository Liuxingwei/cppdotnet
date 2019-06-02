<?php
////////////////////////////Common head
/*$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');*/
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

if(!isset($_GET['blog_id'])){
    echo 'error blog_id';
    exit(0);
}
$blog_id=intval($_GET['blog_id']);
$sql = "SELECT blog_id FROM blog where blog_id=$blog_id";
$result=mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)!=1){
    echo 'error blog_id';
    exit(0);
}
mysqli_free_result($result);
$ckname=md5("blognice$blog_id");
$tmp="blog_nice_".$blog_id;
if(isset($_SESSION[$tmp]) || isset($_COOKIE[$ckname])){
	echo 'have been nice';
	exit(0);
}

$sql = "UPDATE blog SET nice=nice+1 WHERE blog_id=$blog_id";
mysqli_query($mysqli, $sql) or die('error');
echo "true";
setcookie(md5("blognice$blog_id"),md5("as981jk2j"),time()+60*60*24);
$_SESSION[$tmp]=1;
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>