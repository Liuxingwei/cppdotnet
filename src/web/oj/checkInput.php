<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
$id = $_GET['id'];
$sql="SELECT * FROM `liveshow` WHERE `id` = '".$id."'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
mysqli_free_result($result);
echo json_encode($row);
exit(0);
?>
