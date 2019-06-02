<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "企业详情 - C语言网";
	$url_oj="../oj/";
	if(isset($_SESSION['administrator'])){
		if (isset($_GET['cpn'])) {
			$cpnuser=$_GET['cpn'];
		}
		else {
			echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
			echo "<script  charset='utf-8' language='javascript'>\n";
			echo "history.go(-1);\n";
			echo "</script>";
			exit(0);
		}
	}
 	else {
 		if(isset($_SESSION['user_id'])){
		    $view_errors="所在用户组无此权限!";
		    require("template/".$OJ_TEMPLATE."/error.php");
		    exit(0);
		}
 		if(!isset($_SESSION['user_cpn'])){
		    $view_errors="企业用户<a href=".$url_oj."loginpage_cpn.php>登录</a>后才能查看信息!";
		    require("template/".$OJ_TEMPLATE."/error.php");
		    exit(0);
		}
		$cpnuser=$_SESSION['user_cpn'];
 	}
	

	$sql="SELECT `compname`,`industry`,`address`,`website`,`stage`,`size` FROM `users_cpn` WHERE `cpnuser`='".$cpnuser."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	
	$comp_data=Array();
	$row=mysqli_fetch_object($result);
		$comp_data[0]=$row->compname;
		$comp_data[1]=$row->industry;
		$comp_data[2]=$row->address;
		$comp_data[3]=$row->website;
		$comp_data[4]=$row->stage;
		$comp_data[5]=$row->size;

	mysqli_free_result($result);

	$sql="SELECT `id`,`compname`,`position`,`place`,`propt`,`salary`,`exp`,`edu`,`status` FROM `job_list` WHERE `cpnuser`='".$cpnuser."' ORDER BY `release_time`";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

	$usercpn_data=Array();
	$i=0;
	while ($row=mysqli_fetch_object($result)){
		$usercpn_data[$i]=Array();
		$usercpn_data[$i][0]="<a href='/job/".$row->id.".html'>".$row->position."</a>";
		$usercpn_data[$i][1]=$row->compname;
	    $usercpn_data[$i][2]=$row->place;
	   	$usercpn_data[$i][3]=$row->propt;  
	   	if ($row->status=='1') {
	   		$usercpn_data[$i][4]="通过审核";
	   	}
	   	else {
	   		$usercpn_data[$i][4]="正在审核";
	   	}
	   	$usercpn_data[$i][5]="<a href='/oj/job_release_refresh.php?job_id=".$row->id."'>刷新置顶</a>　|　<a href='/oj/job_modify.php?id=".$row->id."'>编辑</a>";
		$i++;
	}
	mysqli_free_result($result);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>
    <!-- <link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/css/"?>job_detail.css"> -->
    <style type="text/css">
		.container .jumbotron {
			background: #FFF;
			padding: 0px;
			border-radius: 0px;
		}
		.head1 {
			font-size: 24px;
			line-height: 40px;
			margin: 0px;
			padding: 5px 15px;
			border-top: 1px solid #DDD;
			border-bottom: 1px solid #DDD;
			background: #E5ECF9;
			/*background: -webkit-linear-gradient(bottom, #F9F9F9 0%, #EDEDED 100%);
			background: -o-linear-gradient(bottom, #F9F9F9 0%, #EDEDED 100%);
			background: linear-gradient(to top, #F9F9F9 0%, #EDEDED 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#F9F9F9,endColorstr=#EDEDED,GradientType=0);*/
		}
		.head1 span {
			font-size: 16px;
			float: right;
		}
		/*.head1_top {
			border-top: 0px;
		}*/
		.mod_detail {
			padding: 20px 20px;
			font-size: 18px;
			line-height: 45px;
		}
		.div-s-3 {
			width: 300px;
			float: left;
		}
		.div-s-2 {
			width: 480px;
			float: left;
		}
		.div-n-1 {
			padding-top: 10px;
			clear: both;
		}
    </style>
  </head>
  <body>
  	<div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
    	<div class="jumbotron">
    		<div class="col-lg-3">
    			<div class="content_box">
					<ul class="nav nav-stacked nav-pills text-center">
	                    <li><p style="text-align: left;padding: 10px 15px;margin: 0;line-height: 30px;font-size: 16px;font-weight: bold;">公司信息管理</p></li>
	                    <li><a href="/job/cpn">公司基本信息</a></li>
	                    <li><a href="/oj/cpn_modify.php">编辑公司信息</a></li>
	                    <li><a href="/oj/job_release.php">发布招聘信息</a></li>
	                </ul>
                </div>
    		</div>
    		<div class="col-lg-9">
    			<div class="content_box">

    			<div class="head1 head1_top">
    				企业基本信息
    				<span><a href="<?php echo $url_oj;?>cpn_modify.php">点击编辑</a></span>
    			</div>
    			<div class="mod_detail">
    				<h3 style="margin-top: 10px;margin-bottom: 20px;"><?php echo $comp_data[0];?></h3>
    				<div class="div-s-3">所属行业：<?php echo $comp_data[1];?></div>
    				<div class="div-s-3">发展阶段：<?php echo $comp_data[4];?></div>
    				<div class="div-s-3">企业规模：<?php echo $comp_data[5];?></div>
    				<div class="div-n-1">所在地址：<?php echo $comp_data[2];?></div>
    				<div class="div-n-1">官网地址：<?php echo $comp_data[3];?></div>
    			</div>
    			<div class="head1">
    				已发布的信息
    			</div>
    			<div>
    				<table class='table table-striped'>
						<tr class="toprow">
							<td width="20%">需求职位</td>
							<td width="25%">公司名称</td>
							<td width="15%">工作地点</td>
							<td width="10%">工作性质</td>
							<td width="10%">审核情况</td>
							<td>编辑刷新</td>
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

			</div>
    	</div>
    </div>
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php include("template/$OJ_TEMPLATE/js.php");?>
  </body>
</html>