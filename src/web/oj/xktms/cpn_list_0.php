<?php require_once ("admin-header.php");
/*require_once("../include/check_post_key.php");*/

$sql="SELECT `reg_time`,`compname`,`email`,`phone`,`address`,`industry`,`stage`,`size` FROM `users_cpn` WHERE `status`=0 ORDER BY `reg_time` DESC";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$usercpn_data=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
	$usercpn_data[$i]=Array();
	$usercpn_data[$i][0]="<a href='verify_ok.php?id=".$row->email."'>通过</a>";
	$usercpn_data[$i][1]=$row->reg_time;
	$usercpn_data[$i][2]=$row->compname;
	$usercpn_data[$i][3]=$row->email;
    $usercpn_data[$i][4]=$row->phone;
   	$usercpn_data[$i][5]=$row->address; 
	$usercpn_data[$i][6]=$row->industry;
	$usercpn_data[$i][7]=$row->stage;
	$usercpn_data[$i][8]=$row->size;
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
<title>企业用户管理</title>
<link rel="stylesheet" href="../template/<?php echo $OJ_TEMPLATE;?>/css/verify_admin.css">
</head>

<body leftmargin="30" >
<div class="container">
<div class="h-label">
	<label class="lable-1">
		<h2>
			待审核企业用户
		</h2>
	</label>
	<label class="lable-0">
		<a href="cpn_list_1.php">
		<h2>
			已过审企业用户
		</h2>
		</a>
	</label>
</div>
<div class="c-table">
	<table class='table table-striped' width=90% border=1>
		<tr>
			<td>是否通过</td>
			<td>申请时间</td>
			<td>公司名称</td>
			<td>登录邮箱</td>
			<td>联系电话</td>
			<td>所在地址</td>
			<td>所属行业</td>
			<td>发展状况</td>
			<td>企业规模</td>
		</tr>
		<?php
			foreach ($usercpn_data as $row_tr) {
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