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
if (!(isset($_SESSION['administrator'])||isset($_SESSION['problem_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php
include_once("kindeditor.php") ;
?>
<h1 >Add New problem</h1>

<form method=POST action=problem_add.php>
<input type=hidden name=problem_id value="New Problem">
<p align=left>Problem Id:&nbsp;&nbsp;New Problem</p>
<p align=left>Title:<input class="input input-xxlarge" type=text name=title size=71></p>
<p align=left>Time Limit:<input type=text name=time_limit size=20 value=1>S</p>
<p align=left>Memory Limit:<input type=text name=memory_limit size=20 value=128>MByte</p>
<p align=left>Description:<br>
<textarea class="kindeditor" rows=13 name=description cols=80></textarea>

</p>

<p align=left>Input:<br>
<textarea  class="kindeditor" rows=13 name=input cols=80></textarea>

</p>

</p>
<p align=left>Output:<br>
<textarea  class="kindeditor" rows=13 name=output cols=80></textarea>



</p>
<p align=left>Sample Input:<br><textarea  class="input input-xxlarge"  rows=13 name=sample_input cols=80></textarea></p>
<p align=left>Sample Output:<br><textarea  class="input input-xxlarge"  rows=13 name=sample_output cols=80></textarea></p>
<p align=left>Test Input:<br><textarea  class="input input-xxlarge" rows=13 name=test_input cols=80></textarea></p>
<p align=left>Test Output:<br><textarea  class="input input-xxlarge"  rows=13 name=test_output cols=80></textarea></p>
<p align=left>Hint:<br>
<textarea class="kindeditor" rows=13 name=hint cols=80></textarea>
</p>
<p>SpecialJudge: N<input type=radio name=spj value='0' checked>Y<input type=radio name=spj value='1'></p>
<p align=left>Source(tag)(多个标签之间空格分开):<br><textarea name=source rows=1 cols=70></textarea></p>
<p align=left>contest:
	<select  name=contest_id>
<?php $sql="SELECT `contest_id`,`title` FROM `contest` WHERE `start_time`>NOW() order by `contest_id`";
$result=mysqli_query($mysqli,$sql);
echo "<option value=''>none</option>";
if (mysqli_num_rows($result)==0){
}else{
	for (;$row=mysqli_fetch_object($result);)
		echo "<option value='$row->contest_id'>$row->contest_id $row->title</option>";
}
?>
	</select>
</p>
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
</body></html>

