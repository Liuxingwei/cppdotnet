<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Edit Problem</title>
</head>
<body>
<center>
<?php require_once("../include/db_info.inc.php");?>
<!-- <?php require_once("../include/const.inc.php");?> -->
<?php require_once("admin-header.php");
$difficulty_name=Array("入门题", "普及题", "提高题", "难题");
if(!isset($_SESSION['mark_name'])){
	$sql = "SELECT attr_value FROM others WHERE attr_name LIKE 'mark%' ORDER BY attr_name";
	$result=mysqli_query($mysqli, $sql);
	$tmpcnt=0;
	while($row = mysqli_fetch_object($result)){
		$mark_name[$tmpcnt]=$row->attr_value;
		$tmpcnt++;
	}
	$_SESSION['mark_name']=$mark_name;
}else $mark_name=$_SESSION['mark_name'];
if (!(isset($_SESSION['administrator'])
      ||isset($_SESSION['problem_editor'])
     )){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php
include_once("kindeditor.php") ;
?>
<p align="center"><font color="#333399" size="4">Welcome To Administrator's Page of Judge Online of ACM ICPC, <?php echo $OJ_NAME?>.</font>
<td width="100"></td>
</center>
<hr>
<?php if(isset($_GET['id'])){
;//	require_once("../include/check_get_key.php");
?>
<h1>Edit problem</h1>
<form method=POST action=problem_edit.php>
<input type=hidden name=problem_id value=New Problem>
<?php $sql="SELECT * FROM `problem` WHERE `problem_id`=".intval($_GET['id']);
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
?>
<p>Problem Id: <?php echo $row->problem_id?></p>
<input type=hidden name=problem_id value='<?php echo $row->problem_id?>'>
<p>Title:<input type=text name=title size=71 value='<?php echo htmlentities($row->title,ENT_QUOTES,"UTF-8")?>'></p>
<p>Time Limit:<input type=text name=time_limit size=20 value='<?php echo $row->time_limit?>'>S</p>
<p>Memory Limit:<input type=text name=memory_limit size=20 value='<?php echo $row->memory_limit?>'>MByte</p>
<p>Description:<br><textarea class="kindeditor" rows=13 name=description cols=120><?php echo htmlentities($row->description,ENT_QUOTES,"UTF-8")?></textarea></p>
<p>Input:<br><textarea class="kindeditor" rows=13 name=input cols=120><?php echo htmlentities($row->input,ENT_QUOTES,"UTF-8")?></textarea></p>
<p>Output:<br><textarea class="kindeditor" rows=13 name=output cols=120><?php echo htmlentities($row->output,ENT_QUOTES,"UTF-8")?></textarea></p>

<p>Sample Input:<br><textarea rows=13 name=sample_input cols=120><?php echo htmlentities($row->sample_input,ENT_QUOTES,"UTF-8")?></textarea></p>
<p>Sample Output:<br><textarea rows=13 name=sample_output cols=120><?php echo htmlentities($row->sample_output,ENT_QUOTES,"UTF-8")?></textarea></p>
<p>Hint:<br>
<textarea class="kindeditor" rows=13 name=hint cols=120><?php echo htmlentities($row->hint,ENT_QUOTES,"UTF-8")?></textarea></p>
</p>
<p>SpecialJudge: 
N<input type=radio name=spj value='0' <?php echo $row->spj=="0"?"checked":""?>>
Y<input type=radio name=spj value='1' <?php echo $row->spj=="1"?"checked":""?>></p>
<p>Source(tag)(多个标签之间空格分开):<br><textarea name=source rows=1 cols=70><?php echo htmlentities($row->source,ENT_QUOTES,"UTF-8")?></textarea></p>
<p>Difficulty: <select name="difficulty">
	<option value="0" <?php if($row->difficulty==0) echo "selected";?>><?php echo $difficulty_name[0];?></option>
	<option value="1" <?php if($row->difficulty==1) echo "selected";?>><?php echo $difficulty_name[1];?></option>
	<option value="2" <?php if($row->difficulty==2) echo "selected";?>><?php echo $difficulty_name[2];?></option>
	<option value="3" <?php if($row->difficulty==3) echo "selected";?>><?php echo $difficulty_name[3];?></option>
</select> </p>
<p>Mark: <select name="mark_">
	<option value="0" <?php if($row->mark==0) echo "selected";?>><?php echo $mark_name[0];?></option>
	<option value="1" <?php if($row->mark==1) echo "selected";?>><?php echo $mark_name[1];?></option>
	<option value="2" <?php if($row->mark==2) echo "selected";?>><?php echo $mark_name[2];?></option>
	<option value="3" <?php if($row->mark==3) echo "selected";?>><?php echo $mark_name[3];?></option>
	<option value="4" <?php if($row->mark==4) echo "selected";?>><?php echo $mark_name[4];?></option>
	<option value="5" <?php if($row->mark==5) echo "selected";?>><?php echo $mark_name[5];?></option>
	<option value="6" <?php if($row->mark==6) echo "selected";?>><?php echo $mark_name[6];?></option>
	<option value="7" <?php if($row->mark==7) echo "selected";?>><?php echo $mark_name[7];?></option>
	</select>
</p>
<div align=center>
<?php require_once("../include/set_post_key.php");?>
<input type=submit value=Submit name=submit>
</div></form>
<p>
<?php require_once("../oj-footer.php");?>
<?php }else{
require_once("../include/check_post_key.php");
$id=intval($_POST['problem_id']);
if(!(isset($_SESSION["p$id"])||isset($_SESSION['administrator'])||isset($_SESSION['problem_editor']))) exit();	
$title=$_POST['title'];
$time_limit=$_POST['time_limit'];
$memory_limit=$_POST['memory_limit'];
$description=$_POST['description'];
$input=$_POST['input'];
$output=$_POST['output'];
$sample_input=$_POST['sample_input'];
$sample_output=$_POST['sample_output'];
$hint=$_POST['hint'];
$difficulty=$_POST['difficulty'];
$mark_=$_POST['mark_'];
$source=$_POST['source'];
$spj=$_POST['spj'];
if (get_magic_quotes_gpc ()) {
	$title = stripslashes ( $title);
	$time_limit = stripslashes ( $time_limit);
	$memory_limit = stripslashes ( $memory_limit);
	$description = stripslashes ( $description);
	$input = stripslashes ( $input);
	$output = stripslashes ( $output);
	$sample_input = stripslashes ( $sample_input);
	$sample_output = stripslashes ( $sample_output);
//	$test_input = stripslashes ( $test_input);
//	$test_output = stripslashes ( $test_output);
	$hint = stripslashes ( $hint);
	$difficulty=stripslashes($difficulty);
	$source = stripslashes ( $source);
	$mark_=stripslashes($mark_);
	$spj = stripslashes ( $spj);
	$source = stripslashes ( $source );
}
$basedir=$OJ_DATA."/$id";
echo "Sample data file in $basedir Updated!<br>";

	if($sample_input){
		//mkdir($basedir);
		$fp=fopen($basedir."/sample.in","w");
		fputs($fp,preg_replace("(\r\n)","\n",$sample_input));
		fclose($fp);
		
		$fp=fopen($basedir."/sample.out","w");
		fputs($fp,preg_replace("(\r\n)","\n",$sample_output));
		fclose($fp);
	}
	$title=mysqli_real_escape_string($mysqli,$title);
	$time_limit=mysqli_real_escape_string($mysqli,$time_limit);
	$memory_limit=mysqli_real_escape_string($mysqli,$memory_limit);
	$description=mysqli_real_escape_string($mysqli,$description);
	$input=mysqli_real_escape_string($mysqli,$input);
	$output=mysqli_real_escape_string($mysqli,$output);
	$sample_input=mysqli_real_escape_string($mysqli,$sample_input);
	$sample_output=mysqli_real_escape_string($mysqli,$sample_output);
//	$test_input=($test_input);
//	$test_output=($test_output);
	$difficulty=mysqli_real_escape_string($mysqli, $difficulty);
	$mark_=mysqli_real_escape_string($mysqli, $mark_);
	$hint=mysqli_real_escape_string($mysqli,$hint);
	$source=mysqli_real_escape_string($mysqli,$source);
//	$spj=($spj);
	
$sql="UPDATE `problem` set `title`='$title',`time_limit`='$time_limit',`memory_limit`='$memory_limit',
	`description`='$description',`input`='$input',`output`='$output',`difficulty`=$difficulty,`mark`=$mark_,`sample_input`='$sample_input',`sample_output`='$sample_output',`hint`='$hint',`source`='$source',`spj`=$spj,`in_date`=NOW()
	WHERE `problem_id`=$id";

@mysqli_query($mysqli,$sql) or die(mysqli_error());
echo "Edit OK!";


		
echo "<a href='../problem.php?id=$id'>See The Problem!</a>";
}
?>
</body>
</html>

