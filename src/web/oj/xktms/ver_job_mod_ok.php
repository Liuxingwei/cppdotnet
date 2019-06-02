<?php 
require_once("admin-header.php");

$id=$_GET['id'];
$sql="SELECT `email`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`exp`,`edu`,`descrp` FROM `job_list_modify` WHERE `id`=".$id;
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$row=mysqli_fetch_object($result);

	$email=$row->email;
	$position=$row->position;
    $place=$row->place;
   	$propt=$row->propt; 
   	$salary=$row->salary; 
   	$salary_min=$row->salary_min; 
   	$salary_max=$row->salary_max; 
   	$exp=$row->exp; 
   	$edu=$row->edu;  
   	$descrp=$row->descrp;

mysqli_free_result($result);

$sql="UPDATE `job_list` SET"
		."`email`='".$email."',"
		."`position`='".$position."',"
		."`place`='".$place."',"
		."`propt`='".$propt."',"
		."`salary`='".$salary."',"
		."`salary_min`='".$salary_min."',"
		."`salary_max`='".$salary_max."',"
		."`exp`='".$exp."',"
		."`edu`='".$edu."',"
		."`descrp`='".$descrp."'"
		."WHERE `id`='".$id."'";
	mysqli_query($mysqli,$sql); // or die("Insert Error!\n");

$sql="DELETE FROM job_list_modify WHERE `id`='".$id."'";
mysqli_query($mysqli,$sql); // or die("Insert Error!\n");
echo "操作成功，通过审核！";

require("../oj-footer.php");
?>