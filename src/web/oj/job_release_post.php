<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");
$err_str="";
$err_cnt=0;
$len;
$position=trim($_POST['position']);

if ($position==""){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('";
	print "请填写职位！";
	print "');\n history.go(-1);\n</script>";
	exit(0);
}

$place=trim($_POST['place']);
$getemail=trim($_POST['email']);

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
$vcode=trim($_POST['vcode']);
if($OJ_VCODE&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
	$_SESSION["vcode"]=null;
	$err_str=$err_str."验证码错误!\\n";
	$err_cnt++;
}
if ($err_cnt>0){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('";
	print $err_str;
	print "');\n history.go(-1);\n</script>";
	exit(0);
}
$email=mysqli_real_escape_string($mysqli,htmlentities($getemail,ENT_QUOTES,"UTF-8"));

$cpnuser=$_SESSION['user_cpn'];

$sql="SELECT `compname` FROM `users_cpn` WHERE `cpnuser` = '".$cpnuser."'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
$compname=$row->compname;
mysqli_free_result($result);

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	/*重编辑不审核——start*/
	/*$sql="SELECT `id` FROM `job_list` WHERE `id`='".$id."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$rows_cnt=mysqli_num_rows($result);
	mysqli_free_result($result);
	if ($rows_cnt!=0) {
		$sql="UPDATE `job_list` SET"
		."`email`='".$email."',"
		."`compname`='".$compname."',"
		."`release_time`=NOW(),"
		."`ip`='".$_SERVER['REMOTE_ADDR']."',"
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
		mysqli_query($mysqli,$sql) or die("Insert Error!(update)\n");

		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' >alert('编辑成功!')</script>";//——，请等待审核
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-2);\n";
		echo "</script>";
		exit(0);
	}
	else {
		$sql="INSERT INTO `job_list`("
		."`email`,`compname`,`ip`,`release_time`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`exp`,`edu`,`descrp`,`id`,`status`)"
		."VALUES('".$email."','".$compname."','".$_SERVER['REMOTE_ADDR']."',NOW(),'".$position."','".$place."','".$propt."','".$salary."','".$salary_min."','".$salary_max."','".$exp."','".$edu."','".$descrp."','".$id."',1)";
		mysqli_query($mysqli,$sql); // or die("Insert Error!\n");

		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' >alert('编辑成功!')</script>";//——，请等待审核
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-2);\n";
		echo "</script>";
		exit(0);
	}*/
	/*重编辑不审核——end*/

	/*重编辑审核——start*/
	$sql="SELECT `id` FROM `job_list_modify` WHERE `id`='".$id."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$rows_cnt=mysqli_num_rows($result);
	mysqli_free_result($result);
	if ($rows_cnt!=0) {
		$sql="UPDATE `job_list_modify` SET"
		."`email`='".$email."',"
		."`compname`='".$compname."',"
		."`release_time`=NOW(),"
		."`ip`='".$_SERVER['REMOTE_ADDR']."',"
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
		mysqli_query($mysqli,$sql) or die("Insert Error!\n");

		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' >alert('编辑成功，请等待审核!')</script>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-2);\n";
		echo "</script>";
		exit(0);
	}
	else {
		$sql="INSERT INTO `job_list_modify`("
		."`cpnuser`,`email`,`compname`,`ip`,`release_time`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`exp`,`edu`,`descrp`,`id`)"
		."VALUES('".$cpnuser."','".$email."','".$compname."','".$_SERVER['REMOTE_ADDR']."',NOW(),'".$position."','".$place."','".$propt."','".$salary."','".$salary_min."','".$salary_max."','".$exp."','".$edu."','".$descrp."','".$id."')";
		mysqli_query($mysqli,$sql); // or die("Insert Error!\n");

		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' >alert('编辑成功，请等待审核!')</script>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-2);\n";
		echo "</script>";
		exit(0);
	}
	/*重编辑审核——end*/
}
else {
	$sql="INSERT INTO `job_list`("
	."`cpnuser`,`email`,`compname`,`ip`,`release_time`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`exp`,`edu`,`descrp`,`status`)"
	."VALUES('".$cpnuser."','".$email."','".$compname."','".$_SERVER['REMOTE_ADDR']."',NOW(),'".$position."','".$place."','".$propt."','".$salary."','".$salary_min."','".$salary_max."','".$exp."','".$edu."','".$descrp."',0)";
	mysqli_query($mysqli,$sql); // or die("Insert Error!\n");
	/*需审核时此语句`status`为0*/

	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	echo "<script charset='utf-8' >alert('发布成功，请等待审核!')</script>";/*——，请等待审核*/
	echo "<script charset='utf-8' language='javascript'>\n";
	echo "history.go(-2);\n";
	echo "</script>";
	exit(0);
}
?>