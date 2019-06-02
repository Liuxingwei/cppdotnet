<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Problem</title>
</head>
<body leftmargin="30" >

<?php require_once("../include/db_info.inc.php");?>
<?php require_once("admin-header.php");

if (!(isset($_SESSION['administrator'])||isset($_SESSION['problem_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php
	if(isset($_POST['mark0'])){
		require_once("../include/check_post_key.php");
		$mark_group=Array();
		for($i=0;$i<8;$i++){
			$tmp_index='mark'.$i;
			array_push($mark_group,trim($_POST[$tmp_index]));
			if(get_magic_quotes_gpc())
				$mark_group[$i]=stripslashes($mark_group[$i]);
			$mark_group[$i]=mysqli_real_escape_string($mysqli, $mark_group[$i]);
			$sql="UPDATE others SET attr_value='".$mark_group[$i]."' WHERE attr_name='mark$i'";
			// echo " <script>console.log($sql)</script> ";
			@mysqli_query($mysqli,$sql) or die(mysqli_error());
		}
		echo "<h1 style='color:red;'>Success!</h1>";
	}
	$sql = "SELECT attr_value FROM others WHERE attr_name LIKE 'mark%' ORDER BY attr_name";
	$result=mysqli_query($mysqli, $sql);
	$tmpcnt=0;
	while($row = mysqli_fetch_object($result)){
		$mark_name[$tmpcnt]=$row->attr_value;
		$tmpcnt++;
	}
	$_SESSION['mark_name']=$mark_name;
?>
<h1 >Modify mark</h1>
<form action="mark_edit.php" method="POST">
	<?php
		for($i=0;$i<8;$i++){
			echo "<p>Mark$i: <input type='text' name='mark$i' value='".$mark_name[$i]."'></p>";
		}
	?>
	<?php require_once("../include/set_post_key.php");?>
	<button type="submit">submit</button>
</form>

<p>
<?php require_once("../oj-footer.php");?>
</body></html>

