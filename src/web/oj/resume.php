<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "个人简历 - C语言网";

	$user_id=$_GET['user_id'];

    if(!isset($_SESSION['user_cpn']) && !isset($_SESSION['user_id'])){
        $view_errors="您尚未登录，请先<a href=loginpage.php>登录</a>！";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    if(isset($_SESSION['user_cpn']) && $user_id==""){
        $view_errors="您所在用户组错误！";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    if (isset($_SESSION['user_id']) && $user_id!=$_SESSION['user_id'] && !isset($_SESSION['administrator'])) {
    	$view_errors="无权查看！";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }

	$sql="SELECT `name`,`age`,`sex`,`birth`,`address`,`email`,`phone`,`school`,`edu`,`gra`,`prize`,`skill`,`lang`,`jobs`,`descrp` FROM `resume` WHERE `user_id`='".$user_id."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

	$row=mysqli_fetch_object($result);
		$name=$row->name;
		$age=$row->age;
		$sex=$row->sex;
        $birth=$row->birth;
        $address=$row->address;
	    $email=$row->email;
	   	$phone=$row->phone; 
	   	$school=$row->school; 
	   	$edu=$row->edu; 
	   	$gra=$row->gra;  
	   	$prize=$row->prize;
	   	$skill=$row->skill;
        $lang=$row->lang;
	   	$jobs=$row->jobs;
	   	$descrp=$row->descrp;

	mysqli_free_result($result);
$prize = preg_replace('/\n/','<br>',$prize);
$skill = preg_replace('/\n/','<br>',$skill);
$lang = preg_replace('/\n/','<br>',$lang);
$jobs = preg_replace('/\n/','<br>',$jobs);
$descrp = preg_replace('/\n/','<br>',$descrp);
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
    	.wrap {
			background: #FAFAFA;
		}
		.container .jumbotron {
			background: #FFF;
			padding: 0px;
			border-radius: 0px;
			border: 1px solid #DDD;
		}
		.head1 {
			font-size: 20px;
			line-height: 30px;
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
			font-size: 14px;
			float: right;
		}
		.head1_top {
			border-top: 0px;
		}
		.mod_detail {
			padding: 20px 30px;
			font-size: 16px;
			line-height: 45px;
		}
		.mod_detail-1 {
			height: 350px;
		}
		.mod_detail-2 {
			height: 200px;
		}
		.div-s-3 {
			width: 300px;
			float: left;
		}
		.div-s-2 {
			width: 480px;
			float: left;
		}
        .div-s-1 {
            width: 100%;
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
    		
    			<div class="head1 head1_top">
    				基本信息
    				<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']==$user_id) {
    					echo "<span><a href='resume_modify.php'>编辑我的简历</a></span>";
    				} ?>
    			</div>
    			<div class="mod_detail mod_detail-1">
    				<div class="div-s-2">姓　　名：<?php echo $name;?></div>
    				<div class="div-s-2">性　　别：<?php echo $sex;?></div>
    				<div class="div-s-2">年　　龄：<?php echo $age;?></div>
                    <div class="div-s-2">出生日期：<?php echo $birth;?></div>
                    <div class="div-s-1">现所在地：<?php echo $address;?></div>
    				<div class="div-s-2">邮　　箱：<?php echo $email;?></div>
    				<div class="div-s-2">电　　话：<?php echo $phone;?></div>
    			<!-- </div>
    			<div class="head1">
    				学校信息
    			</div>
    			<div class="mod_detail mod_detail-2"> -->
    				<div class="div-s-2">毕业学院：<?php echo $school;?></div>
    				<div class="div-s-2">学历学位：<?php echo $edu;?></div>
    				<div class="div-s-2">专　　业：<?php echo $gra;?></div>
                    <!-- <div class="div-s-2"><a href="myvalue.php?user=<?php echo $user_id;?>">我在C语言网的表现</a></div> -->
    			</div>
    			<div class="head1">
    				专业技能
    			</div>
    			<div class="mod_detail">
    				<div class="div-n-1">
    					<?php echo $skill;?>
    				</div>
    			</div>
                <div class="head1">
                    外语掌握
                </div>
                <div class="mod_detail">
                    <div class="div-n-1">
                        <?php echo $lang;?>
                    </div>
                </div>
    			<div class="head1">
    				奖励奖项
    			</div>
    			<div class="mod_detail">
    				<div class="div-n-1">
    					<?php echo $prize;?>
    				</div>
    			</div>
    			<div class="head1">
    				工作经历
    			</div>
    			<div class="mod_detail">
    				<div class="div-n-1">
    					<?php echo $jobs;?>
    				</div>
    			</div>
    			<div class="head1">
    				自我评价
    			</div>
    			<div class="mod_detail">
    				<div class="div-n-1">
    					<?php echo $descrp;?>
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