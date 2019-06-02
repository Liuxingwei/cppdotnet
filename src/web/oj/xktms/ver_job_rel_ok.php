<?php 
require_once("admin-header.php");

$id=$_GET['id'];
$sql="UPDATE `job_list` set `status`=1 WHERE `id`='$id'";
@mysqli_query($mysqli,$sql) or die(mysqli_error());
echo "操作成功，通过审核！";

require("../oj-footer.php");
?>