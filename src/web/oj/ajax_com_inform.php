<?php
////////////////////////////Common head
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php'); 
require_once('./include/setlang.php');

if(!isset($_GET['comment_id'])){
    echo 'error comment_id';
    exit(0);
}
$comment_id=intval($_GET['comment_id']);
if(!isset($_SESSION['user_id'])){
	echo "not have been login.";
	exit(0);
}
$now =time()-10;
if($now<$_SESSION['last_com_inform']){
	echo "time limit";
	exit(0);
}
$tmp='com_inform_'.$comment_id;
if(isset($_SESSION[$tmp])){
	echo 'already inform';
	exit(0);
}
$user_id=$_SESSION['user_id'];
$sql="UPDATE `comment` SET `status`=2,`inform_user_id`='$user_id' WHERE `comment_id`='$comment_id'";
mysqli_query($mysqli, $sql) or die('error');
echo 'true';
$_SESSION['last_com_inform']=time();

$_SESSION[$tmp]=1;
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>
