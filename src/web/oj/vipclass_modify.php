<?php
require_once("include/db_info.inc.php");
require_once('./include/setlang.php');

if(!isset($_SESSION['administrator'])){
    $view_errors="无权操作!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$view_title="编辑课程";
if (isset($_POST['lock_id'])) {

	$class=$_POST['class'];
	$lock_id=trim($_POST['lock_id']);
	$section=trim($_POST['section']);
	$title=trim($_POST['title']);
	$video=trim($_POST['video']);
	$descrp=trim($_POST['descrp']);
	$problem=trim($_POST['problem']);

	//课程题目删除
	$sql="DELETE FROM `vipclass_problem` WHERE `class_id`=$class";
	mysqli_query($mysqli,$sql);
	//课程信息更新
	$sql="UPDATE `vipclass` SET `lock_id`='$lock_id',`section`='$section',`title`='$title',`descrp`='$descrp',`video`='$video' WHERE `class_id`=$class";
	mysqli_query($mysqli,$sql) or die(mysqli_error());

	//课程题目插入
	$arr_problem = explode(",",$problem);
	if (count($arr_problem)>0 && strlen($arr_problem[0])>0){
		$sql_1="INSERT INTO `vipclass_problem`(`class_id`,`problem_id`,`num`) 
			VALUES ('$class','$arr_problem[0]',0)";
		for ($i=1;$i<count($arr_problem);$i++){
			$sql_1=$sql_1.",('$class','$arr_problem[$i]',$i)";
		}
		//echo $sql_1;
		mysqli_query($mysqli,$sql_1) or die(mysqli_error());
	}

	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	echo "<script charset='utf-8' language='javascript'>\n";
	echo "alert('编辑成功!');\n";
	echo "history.go(-1);\n";
	echo "</script>";
}
else {
	$class_id=intval($_GET['class']);
	$sql="SELECT * FROM `vipclass` WHERE `class_id`=$class_id";
	$result=mysqli_query($mysqli,$sql);
	if (mysqli_num_rows($result)!=1){
		$view_errors="课程编号错误!";
	    require("template/".$OJ_TEMPLATE."/error.php");
	    exit(0);
	}
	$row=mysqli_fetch_object($result);
	$lock_id=$row->lock_id;
	$section=$row->section;
	$title=$row->title;
	$video=$row->video;
	$descrp=$row->descrp;
	mysqli_free_result($result);
	$str_problem="";
	$sql="SELECT `problem_id` FROM `vipclass_problem` WHERE `class_id`=$class_id ORDER BY `num`";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	for ($i=mysqli_num_rows($result);$i>0;$i--){
		$row=mysqli_fetch_row($result);
		$str_problem=$str_problem.$row[0];
		if ($i>1) $str_problem=$str_problem.',';
	}

	require("template/".$OJ_TEMPLATE."/vipclass_modify.php");
}
?>