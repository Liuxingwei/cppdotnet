<?php 
require_once("admin-header.php");

$id=$_GET['id'];
$email=trim($_POST['email']);
$position=trim($_POST['position']);
$place=trim($_POST['place']);

$propt=trim($_POST['propt']);
$salary=$_POST['salary_radio'];
if ($salary=='2') {
	$salary_min_view=$_POST['salary_min'];
	$salary_max_view=$_POST['salary_max'];
	$salary_min=$salary_min_view*1000;
	$salary_max=$salary_max_view*1000;
}
else {
	$salary_min=0;
	$salary_max=0;
}

$exp=trim($_POST['exp']);
$edu=trim($_POST['edu']);
switch ($propt) {
	case 0:
		$propt="全职";
		break;
	case 1:
		$propt="兼职";
		break;
	case 2:
		$propt="实习";
		break;
	default:
		$propt="全职";
		break;
}
switch ($exp) {
	case 0:
		$exp="不限";
		break;
	case 1:
		$exp="应届生";
		break;
	case 2:
		$exp="1年以下";
		break;
	case 3:
		$exp="1-3年";
		break;
	case 4:
		$exp="3年-5年";
		break;
	case 5:
		$exp="5年以上";
		break;
	default:
		$exp="不限";
		break;
}
switch ($edu) {
	case 0:
		$edu="不限";
		break;
	case 1:
		$edu="专科";
		break;
	case 2:
		$edu="本科";
		break;
	case 3:
		$edu="硕士";
		break;
	case 4:
		$edu="博士";
		break;
	default:
		$edu="不限";
		break;
}

$descrp=trim($_POST['descrp']);

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
		."`descrp`='".$descrp."',"
		."`status`='1'"
		."WHERE `id`='".$id."'";
	mysqli_query($mysqli,$sql); // or die("Insert Error!\n");

$sql="SELECT COUNT(1) AS modify_cnt FROM `job_list_modify` WHERE `id`=".$id;
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$row_cnt=mysqli_fetch_object($result);
if ($row_cnt->modify_cnt !=0) {
	$sql="DELETE FROM job_list_modify WHERE `id`='".$id."'";
	mysqli_query($mysqli,$sql); // or die("Insert Error!\n");
}
echo "管理员编辑成功！";

require("../oj-footer.php");
?>