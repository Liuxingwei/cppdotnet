<?php 
	ini_set("display_errors","On");
require_once("admin-header.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>批量编辑</title>
<center><h2>批量编辑</h2></center>
<?php
	require_once("../include/db_info.inc.php");
	require_once("../include/const.inc.php");
if(isset($_POST['pro_tagedit'])) {
	$pro_id_arr = $_POST['pid'];

require_once("../include/check_post_key.php");
if(!(isset($_SESSION["p$id"])||isset($_SESSION['administrator']))) exit();	

$hint=$_POST['hint'];
$difficulty=$_POST['difficulty'];
$mark_=$_POST['mark_'];
$source=$_POST['source'];

echo "<br>变更题目：";
foreach($pro_id_arr as $i){
	echo $i."，";
}
echo "<br>";
if (get_magic_quotes_gpc ()) {
	
//	$test_input = stripslashes ( $test_input);
//	$test_output = stripslashes ( $test_output);
	$hint = stripslashes ( $hint);
	$difficulty=stripslashes($difficulty);
	$source = stripslashes ( $source);
	$mark_=stripslashes($mark_);
	$source = stripslashes ( $source );
}


//	$test_input=($test_input);
//	$test_output=($test_output);
	$difficulty=mysqli_real_escape_string($mysqli, $difficulty);
	$mark_=mysqli_real_escape_string($mysqli, $mark_);
	$hint=mysqli_real_escape_string($mysqli,$hint);
	$source=mysqli_real_escape_string($mysqli,$source);
//	$spj=($spj);
	

if ($hint!=="auto") {
	foreach($pro_id_arr as $i){
		$sql="UPDATE `problem` set`hint`='$hint',`in_date`=NOW()
			WHERE `problem_id`=$i";
			@mysqli_query($mysqli,$sql) or die(mysqli_error());
	}
}
if ($source!=="auto") {
	foreach($pro_id_arr as $i){
		$sql="UPDATE `problem` set`source`=CONCAT_WS(' ',source,'$source'),`in_date`=NOW()
			WHERE `problem_id`=$i";
			@mysqli_query($mysqli,$sql) or die(mysqli_error());
	}
}
if ($difficulty!=="auto") {
	foreach($pro_id_arr as $i){
		$sql="UPDATE `problem` set`difficulty`=$difficulty,`in_date`=NOW()
			WHERE `problem_id`=$i";
			@mysqli_query($mysqli,$sql) or die(mysqli_error());
	}
}
if ($mark_!=="auto") {
	foreach($pro_id_arr as $i){
		$sql="UPDATE `problem` set`mark`=$mark_,`in_date`=NOW()
			WHERE `problem_id`=$i";
			@mysqli_query($mysqli,$sql) or die(mysqli_error());
	}
}

echo "Edit OK!";
require_once("../oj-footer.php");
}
?>
</body>
</html>

