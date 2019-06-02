<?php require_once ("admin-header.php");
/*require_once("../include/check_post_key.php");*/

$sql="SELECT `id`,`compname`,`position`,`place`,`propt`,`salary`,`release_time` FROM `job_list` WHERE `status`='1' ORDER BY `release_time` DESC";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

	$job_data=Array();
	$i=0;
	while ($row=mysqli_fetch_object($result)){
		$job_data[$i]=Array();
		$job_data[$i][0]="<a href='ver_job_detail.php?job_id=".$row->id."'>".$row->position."</a>";
		$job_data[$i][1]=$row->compname;
	    $job_data[$i][2]=$row->place;
	   	$job_data[$i][3]=$row->propt;  
	   	$job_data[$i][4]=$row->release_time; 
		$i++;
	}
	mysqli_free_result($result);

?>
<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>发布招聘审核</title>
<link rel="stylesheet" href="../template/<?php echo $OJ_TEMPLATE;?>/css/verify_admin.css">
</head>

<body leftmargin="30" >
<div class="container">
<div class="h-label">
	<label class="lable-0">
		<a href="job_rel_0.php">
		<h2>
			待审核招聘信息
		</h2>
		</a>
	</label>
	<label class="lable-1">
		<h2>
			已过审招聘信息
		</h2>
	</label>
	<label class="lable-0">
		<a href="job_rel_2.php">
		<h2>
			信息重编辑审核
		</h2>
		</a>
	</label>
</div>
<div class="c-table">
	<table class='table table-striped' width=90% border=1>
		<tr>
			<td width="25%">需求职位</td>
			<td width="35%">公司名称</td>
			<td width="15%">工作地点</td>
			<td width="10%">工作性质</td>
			<td width="15%">发布时间</td>
		</tr>
		<?php
			foreach ($job_data as $row_tr) {
				echo "<tr>";
				foreach ($row_tr as $row_td) {
					echo "<td>";
	                echo $row_td;
	                echo "</td>";
				}
			echo "</tr>";
			}
		?>
	</table>
</div>
</div>
<?php
require("../oj-footer.php");
?>
</body>
</html>