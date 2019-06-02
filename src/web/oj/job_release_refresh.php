<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");

if(!isset($_SESSION['user_cpn'])){
        $view_errors="企业用户请<a href=loginpage_cpn.php>登录</a>后再进行修改操作!";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }

$email=$_SESSION['user_cpn'];
$job_id=$_GET['job_id'];
$ckname=md5("refresh$job_id");
$sql="SELECT `id` FROM `job_list` WHERE `id`='".$job_id."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$rows_cnt=mysqli_num_rows($result);
	mysqli_free_result($result);
if ($rows_cnt!=0) {
	if(isset($_COOKIE[$ckname])){
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' >alert('1天内不可重复刷新!')</script>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
	}

	$sql="UPDATE `job_list` SET"
		."`release_time`=NOW()"
		."WHERE `id`='".$job_id."'";
		mysqli_query($mysqli,$sql) or die("Insert Error!\n");
		setcookie(md5("refresh$job_id"),md5("bs981jk2j"),time()+60*60*24);
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' >alert('刷新成功，更新时间为最新!')</script>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-1);\n";
		echo "</script>";
}
?>