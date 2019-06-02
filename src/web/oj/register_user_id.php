<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
$user_id = $_GET['user_id'];
$sql="SELECT `user_id` FROM `users` WHERE `users`.`user_id` = '".$user_id."'";
$result=mysqli_query($mysqli,$sql);
$rows_cnt=mysqli_num_rows($result);
mysqli_free_result($result);
if ($rows_cnt == 1){
	print '0';
}else{
	print '1';
}
exit(0);
?>
