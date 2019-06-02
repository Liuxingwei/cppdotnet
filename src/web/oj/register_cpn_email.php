<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
$cpnuser = $_GET['cpnuser'];
$sql="SELECT `cpnuser` FROM `users_cpn` WHERE `cpnuser` = '".$cpnuser."'";
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
