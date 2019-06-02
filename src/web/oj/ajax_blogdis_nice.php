<?php
////////////////////////////Common head
/*$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');*/
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

if(!isset($_GET['discuss_id'])){
    echo 'error discuss_id';
    exit(0);
}
$discuss_id=intval($_GET['discuss_id']);
$sql = "SELECT discuss_id FROM blog_discuss where discuss_id=$discuss_id";
$result=mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)!=1){
    echo 'error discuss_id';
    exit(0);
}
mysqli_free_result($result);
$ckname=md5("blogdisnice$discuss_id");
$tmp="dis_nick_".$discuss_id;
if(isset($_SESSION[$tmp]) || isset($_COOKIE[$ckname])){
	echo 'have been nice';
	exit(0);
}

$sql = "UPDATE blog_discuss SET nice=nice+1 WHERE discuss_id=$discuss_id";
mysqli_query($mysqli, $sql) or die('error');
echo "true";
setcookie(md5("blogdisnice$discuss_id"),md5("as981jk2j"),time()+60*60*24);
$_SESSION[$tmp]=1;
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>
