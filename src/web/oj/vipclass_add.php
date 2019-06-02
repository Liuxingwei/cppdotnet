<?php
require_once("include/db_info.inc.php");
require_once('./include/setlang.php');

if(!isset($_SESSION['administrator'])){
    $view_errors="无权操作!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$view_title="添加课程";
if (isset($_POST['lock_id'])) {

	$lock_id=trim($_POST['lock_id']);
	$section=trim($_POST['section']);
	$title=trim($_POST['title']);
	$video=trim($_POST['video']);
	$descrp=trim($_POST['descrp']);
	$problem=trim($_POST['problem']);

	//课程信息插入
	$sql="INSERT INTO `vipclass`(`lock_id`,`section`,`title`,`descrp`,`video`)
			VALUES('$lock_id','$section','$title','$descrp','$video')";
	mysqli_query($mysqli,$sql) or die(mysqli_error());

	//课程题目插入
	$sql="SELECT `class_id` FROM `vipclass` WHERE `lock_id`='$lock_id'";
	$result=mysqli_query($mysqli, $sql);
	$row=mysqli_fetch_object($result);
	$class_id=$row->class_id;
	$arr_problem = explode(",",$problem);
	if (count($arr_problem)>0 && strlen($arr_problem[0])>0){
		$sql_1="INSERT INTO `vipclass_problem`(`class_id`,`problem_id`,`num`) 
			VALUES ('$class_id','$arr_problem[0]',0)";
		for ($i=1;$i<count($arr_problem);$i++){
			$sql_1=$sql_1.",('$class_id','$arr_problem[$i]',$i)";
		}
		//echo $sql_1;
		mysqli_query($mysqli,$sql_1) or die(mysqli_error());
	}

	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	echo "<script charset='utf-8' language='javascript'>\n";
	echo "alert('添加成功!');\n";
	echo "history.go(-1);\n";
	echo "</script>";
}
else {
	require("template/".$OJ_TEMPLATE."/vipclass_add.php");
}
?>
