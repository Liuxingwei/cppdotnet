<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
    require_once('./include/my_func.inc.php');
	require_once('./include/setlang.php');
	$url_oj="../oj/";

	$id=$_GET['job_id'];
	$sql="SELECT `cpnuser`,`compname`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`exp`,`edu`,`descrp`,`status` FROM `job_list` WHERE `id`=".$id;
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

	$job_data=Array();
	$row=mysqli_fetch_object($result);

	$status=$row->status;
	if($status!=1){
	    $view_errors="此信息尚未通过审核！";
	    require("template/".$OJ_TEMPLATE."/error.php");
	    exit(0);
	}

		$job_data['cpnuser']=$row->cpnuser;
		$job_data['compname']=$row->compname;
		$job_data['position']=$row->position;
	    $job_data['place']=$row->place;
	   	$job_data['propt']=$row->propt; 
	   	$job_data['salary']=$row->salary; 
	   	$job_data['salary_min']=$row->salary_min; 
	   	$job_data['salary_max']=$row->salary_max; 
	   	$job_data['exp']=$row->exp; 
	   	$job_data['edu']=$row->edu;  
	   	$job_data['descrp']=$row->descrp;
	
	mysqli_free_result($result);
	if ($job_data['salary']=='2') {
		$salary_min_view=$job_data['salary_min']*0.001;
		$salary_max_view=$job_data['salary_max']*0.001;
		$salary="<span style='color: green;'>".$salary_min_view." - ".$salary_max_view." k /月</span>";
	}
	else {
		$salary="<span style='color: red;'>面议</span>";
	}

	$sql="SELECT `compname`,`industry`,`address`,`website`,`stage`,`size` FROM `users_cpn` WHERE `cpnuser`='".$job_data['cpnuser']."'";
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

	$job_data['descrp'] = preg_replace('/\n/','<br>',$job_data['descrp']);

	if (isset($_SESSION['administrator']) || isset($_SESSION['user_cpn']) && $_SESSION['user_cpn']==$job_data['cpnuser']) {
		$arr_send=Array();
		$sql="SELECT `user_id`,`send_time` FROM `resume_send` WHERE `job_id`='".$id."'";
		$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
		$i=0;
		while ($row=mysqli_fetch_object($result)) {
			$arr_send[$i][0]="<a href='/home/".$row->user_id."'>".getNickByid($row->user_id)."</a>";
			$arr_send[$i][1]="<a href='".$url_oj."resume.php?user_id=".$row->user_id."'>".getNickByid($row->user_id)."的简历</a>";
			$arr_send[$i][2]=$row->send_time;
			$i++;
		}
	}

	$view_title= $job_data['position']."招聘 - ".$job_data['compname']." - C语言网";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="互联网招聘，在线求职，在线招聘。对口、靠谱！">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>
    <!-- <link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/css/"?>job_detail.css"> -->
    <style type="text/css">
    	.wrap {
			background: #E9EAEC;
		}
		.container .jumbotron {
			background: #FFF;
			padding: 0px;
			border-radius: 0px;
		}
		.mod_job {
			border: 1px solid #DDD;
			background: #FAFAFA;
		}
		.head1 {
			font-size: 20px;
			line-height: 40px;
			margin: 0px;
			padding: 5px 15px;
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
		.head1_top {
			border-top: 1px solid #DDD;
		}
		.mod_detail {
			padding: 20px 25px;
			font-size: 14px;
			line-height: 45px;
		}
		.mod_detail_1 {
			min-height: 180px;
		}
		.title_1 {
			/*font-size: 16px;*/
			line-height: 30px;
			padding-left: 15px;
			border-left: 6px solid #4071FD;
		}
		/*.div-s-3 {
			float: left;
		}*/
		.div-s-2 {
			width: 350px;
			float: left;
			font-size: 15px;
			color: #666;
		}
		.descrp {
			font-size: 16px;
			color: #666;
		}
		.div-n-1 {
			color: #666;
			clear: both;
		}
		.mod_job_left {
			width: 30%;
		}
		.mod_job_right {
			width: 70%;
		}
		.icon_job {
			background-repeat: no-repeat;
			background-size: 22px;
		}
		.icon_001 {
			background-image: url(../oj/template/bs3/img/icon001.png);
		}
		.icon_014 {
			background-image: url(../oj/template/bs3/img/icon014.png);
		}
		.icon_015 {
			background-image: url(../oj/template/bs3/img/icon015.png);
		}
		.icon_016 {
			background-image: url(../oj/template/bs3/img/icon016.png);
		}
		.icon_017 {
			background-image: url(../oj/template/bs3/img/icon017.png);
		}
    </style>
  </head>
  <body>
  	<div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
    		
			<div class="col-lg-9 mod_job_right">
				<div class="mod_job">
	    			<div class="head1">
	    				招聘详情
	    				<?php if (isset($_SESSION['user_cpn']) && $_SESSION['user_cpn']==$job_data['cpnuser']) {
	    					echo "<span style='font-size: 14px;'><a href='".$url_oj."job_release_refresh.php?job_id=".$id."'>刷新更新时间</a>　|　<a href='".$url_oj."job_modify.php?id=".$id."'>编辑招聘信息</a></span>";
	    				} ?>
	    			</div>
	    			<br>
	    			<h4 class="title_1">基本信息</h4>
	    			<div class="mod_detail mod_detail_1">
	    				<div class="div-s-2">需求职位：<?php echo $job_data['position'];?></div>
	    				<div class="div-s-2">薪资范围：<?php echo $salary;?></div>
	    				<div class="div-s-2">工作地点：<?php echo $job_data['place'];?></div>
	    				<div class="div-s-2">工作经验：<?php echo $job_data['exp'];?></div>
	    				<div class="div-s-2">工作性质：<?php echo $job_data['propt'];?></div>
	    				<div class="div-s-2">学历要求：<?php echo $job_data['edu'];?></div>
    				</div>
    				<h4 class="title_1">详细描述</h4>
    				<div class="mod_detail">
	    				<div class="div-n-1">
	    					<p class="descrp"><?php echo $job_data['descrp'];?></p>
	    				</div>
	    				<div style="height: 48px;">
	    				<?php if (!isset($_SESSION['user_cpn'])) {
	    					echo "<div style='margin-left: 40%;display: inline-block;'><a href='".$url_oj."resume_bsend.php?id=".$id."'><button style='width: 160px;' type='button' class='btn btn-primary light_blue'>投递简历</button></a></div>";
	    				} ?>

	    				<div style="float: right;" class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
	    				</div>
	    			</div>
	    			<?php if (isset($_SESSION['administrator']) || isset($_SESSION['user_cpn']) && $_SESSION['user_cpn']==$job_data['cpnuser']) { ?>
					<div class="head1 head1_top">
						投递记录
					</div>
					<div>
				    	<table class='table table-striped'>
							<tr class="toprow">
								<td width="40%">用　　户</td>
								<td width="40%">TA的简历</td>
								<td width="20%">投递时间</td>
							</tr>
							<?php
								foreach ($arr_send as $row_tr) {
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
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-3 mod_job_left">
    			<div class="mod_job">
	    			<div class="head1">
	    				企业信息
	    			</div>
	    			<div class="mod_detail">
	    				<div style="font-size: 16px;"><?php echo $comp_data[0];?></div>
	    				<div class="div-n-1"><span class="icon_job icon_017">　　所属行业：<?php echo $comp_data[1];?></span></div>
	    				<div class="div-n-1"><span class="icon_job icon_016">　　发展阶段：<?php echo $comp_data[4];?></span></div>
	    				<div class="div-n-1"><span class="icon_job icon_015">　　企业规模：<?php echo $comp_data[5];?></span></div>
	    				<div class="div-n-1"><span class="icon_job icon_001">　　<?php echo $comp_data[2];?></span></div>
	    				<div class="div-n-1"><span class="icon_job icon_014">　　<?php echo $comp_data[3];?></span></div>
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
	<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["mshare","qzone","tsina","weixin","renren","tqq","tieba","douban","sqq"],"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
  </body>
</html>