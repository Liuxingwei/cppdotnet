<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>企业用户管理</title>

<?php
	require_once ("admin-header.php");

	if (isset($_GET['job_id'])) {
		$id=$_GET['job_id'];
		$sql="SELECT `cpnuser`,`email`,`compname`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`exp`,`edu`,`descrp` FROM `job_list` WHERE `id`=".$id;
	}
	if (isset($_GET['modify_id'])) {
		$id=$_GET['modify_id'];
		$sql="SELECT `cpnuser`,`email`,`compname`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`exp`,`edu`,`descrp` FROM `job_list_modify` WHERE `id`=".$id;
	}
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

	$job_data=Array();
	$row=mysqli_fetch_object($result);

		$job_data['cpnuser']=$row->cpnuser;
		$job_data['email']=$row->email;
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
		$salary=$salary_min_view." - ".$salary_max_view." k /月";
	}
	else {
		$salary="面议";
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

?>

</head>
    <!-- <link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/css/"?>job_detail.css"> -->
    <?php include("../template/$OJ_TEMPLATE/css.php");
        echo "<link rel='stylesheet' href='/oj/template/$OJ_TEMPLATE/css/login.css'>";
    ?>
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
			font-size: 24px;
			line-height: 40px;
			margin: 0px;
			padding: 5px 15px;
			border-top: 1px solid #DDD;
			border-bottom: 1px solid #DDD;
			background: -webkit-linear-gradient(bottom, #F9F9F9 0%, #EDEDED 100%);
			background: -o-linear-gradient(bottom, #F9F9F9 0%, #EDEDED 100%);
			background: linear-gradient(to top, #F9F9F9 0%, #EDEDED 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#F9F9F9,endColorstr=#EDEDED,GradientType=0);
		}
		.head1 span {
			font-size: 16px;
			float: right;
		}
		.head1_top {
			border-top: 0px;
		}
		.mod_detail {
			padding: 20px 30px;
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
    <style type="text/css">
        form.job_release {
            margin: 0px;
            width: 100%;
        }
        .div-form {
            width: 80%;
            margin: auto;
        }
        .div-float {
            height: 160px;
        }
        .form-group-float {
            float: left;
            width: 50%;
        }
        .form-group-float label.label_text {
            width: 100px;
        }
        .form-group-large label.label_text {
            width: 100px;
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
    				企业信息
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
    				招聘详情
    				<?php if (isset($_SESSION['user_cpn']) && $_SESSION['user_cpn']==$job_data['cpnuser']) {
    					echo "<span><a href='job_modify.php?id=".$id."'>编辑招聘信息</a></span>";
    				} ?>
    			</div>
    			<div class="mod_detail">
		            <form action="ver_job_admin_ok.php?id=<?php echo $id; ?>" method="post" class="form-horizontal col-lg-8 col-lg-offset-2 job_release" id="form">
		                <div class="div-float">
		                    <div class="form-group form-group-float">
		                        <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">需求职位</label>
		                         <div class="col-lg-8 col-lg-5-reg"><input type="text" name="position" class="form-control" placeholder="15字以下" maxlength="30" value="<?php echo $job_data['position']?>"></div>
		                         <label for="" class="col-lg-4 col-lg-4-reg" id="position_xx"></label>
		                    </div>
		                    <div class="form-group form-group-float">
		                        <label class="label_text col-lg-3 col-lg-3-reg control-label">工作地点</label>
		                        <div class="col-lg-8 col-lg-5-reg"><input type="text" class="form-control" name="place" placeholder="所在城市" maxlength="10" value="<?php echo $job_data['place']?>"></div>
		                        <label for="" class="col-lg-4 col-lg-4-reg" id="place_xx"></label>
		                    </div>
		                    <div class="form-group form-group-float">
		                        <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">工作性质</label>
		                        <div class="col-lg-8 col-lg-5-reg">
		                        <select class="form-control" name="propt" id="propt">
		                            <option value="0" <?php if ($job_data['propt']=="全职") echo "selected"?>>全职</option>
		                            <option value="1" <?php if ($job_data['propt']=="兼职") echo "selected"?>>兼职</option>
		                            <option value="2" <?php if ($job_data['propt']=="实习") echo "selected"?>>实习</option>
		                        </select>
		                        </div>
		                        <label for="" class="col-lg-4 col-lg-4-reg" id="propt_xx"></label>
		                    </div>
		                    <div class="form-group form-group-float">
		                        <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">工作经验</label>
		                        <div class="col-lg-8 col-lg-5-reg">
		                        <select class="form-control" name="exp" id="exp">
		                            <option value="0" <?php if ($job_data['exp']=="不限") echo "selected"?>>不限</option>
		                            <option value="1" <?php if ($job_data['exp']=="应届生") echo "selected"?>>应届生</option>
		                            <option value="2" <?php if ($job_data['exp']=="1年以下") echo "selected"?>>1年以下</option>
		                            <option value="3" <?php if ($job_data['exp']=="1-3年") echo "selected"?>>1-3年</option>
		                            <option value="4" <?php if ($job_data['exp']=="3年-5年") echo "selected"?>>3年-5年</option>
		                            <option value="5" <?php if ($job_data['exp']=="5年以上") echo "selected"?>>5年以上</option>
		                        </select>
		                        </div>
		                        <label for="" class="col-lg-4 col-lg-4-reg" id="exp_xx"></label>
		                    </div>
		                    <div class="form-group form-group-float">
		                        <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">学历要求</label>
		                        <div class="col-lg-8 col-lg-5-reg">
		                        <select class="form-control" name="edu" id="edu">
		                            <option value="0" <?php if ($job_data['edu']=="不限") echo "selected"?>>不限</option>
		                            <option value="1" <?php if ($job_data['edu']=="专科") echo "selected"?>>专科</option>
		                            <option value="2" <?php if ($job_data['edu']=="本科") echo "selected"?>>本科</option>
		                            <option value="3" <?php if ($job_data['edu']=="硕士") echo "selected"?>>硕士</option>
		                            <option value="4" <?php if ($job_data['edu']=="博士") echo "selected"?>>博士</option>
		                        </select>
		                        </div>
		                        <label for="" class="col-lg-4 col-lg-4-reg" id="edu_xx"></label>
		                    </div>
		                </div>
		                <div class="form-group form-group-large" style="clear: both;">
	                        <label class="label_text col-lg-3 col-lg-3-reg control-label">接收邮箱</label>
	                        <div class="col-lg-9 col-lg-5-reg"><input type="text" class="form-control" name="email" value="<?php echo $job_data['email']?>" placeholder="用于接收用户简历，请确保邮箱真实有效（不在招聘信息中显示）。"></div>
	                        <!-- <label for="" class="col-lg-4 col-lg-4-reg" id="place_xx"></label> -->
	                    </div>
		                <div class="form-group form-group-large form-inline">
		                    <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">薪资范围</label>
		                    <div class="col-lg-2 col-lg-5-reg">
		                        <label class="radio-inline">
		                            <input type="radio" name="salary_radio" id="salary_radio1" value="1" <?php if ($job_data['salary']!='2') echo "checked='checked'";?>> 面议
		                        </label>
		                        <label class="radio-inline">
		                            <input type="radio" name="salary_radio" id="salary_radio2" value="2" <?php if ($job_data['salary']=='2') echo "checked='checked'";?>> 指定
		                        </label>
		                    </div>
		                    <div class="col-lg-8 col-lg-5-reg">
		                        <div class="input-group col-lg-5">
		                            <div class="input-group-addon">￥</div>
		                            <input type="tel" min="0" name="salary_min" class="form-control salary_int" placeholder="最低" maxlength="3" value="<?php echo $salary_min_view?>">
		                            <div class="input-group-addon">K</div>
		                        </div>
		                        <lable>-</lable>
		                        <div class="input-group col-lg-5">
		                            <div class="input-group-addon">￥</div>
		                            <input type="tel" min="0" name="salary_max" class="form-control salary_int" placeholder="最高" maxlength="3" value="<?php echo $salary_max_view?>">
		                            <div class="input-group-addon">K</div>
		                        </div>
		                    </div>
		                    <label for="" class="col-lg-4 col-lg-4-reg" id="salary_xx"></label>
		                </div>
		                <div class="form-group form-group-large">
		                      <label for="" class="label_text col-lg-3 control-label">详细描述</label>
		                      <div class="col-lg-9"><textarea class="form-control" rows="4" name="descrp" placeholder="1000字以下" maxlength="1500"><?php echo $job_data['descrp'];?></textarea></div>
		                </div>
		                <!-- <?php if($OJ_VCODE){ ?>
		                <div class="form-group form-group-float">
		                    <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">验 证 码</label>
		                    <div class="col-lg-5 vcode-reg"><input type="text" class="form-control" id="vcode" name="vcode" maxlength="4"></div>
		                    <img alt="换一张" id="img_vcode" src="vcode.php" onclick="this.src='vcode.php?+'+Math.random()" class="col-lg-3" height=30>
		                </div>
		                <?php }?> -->
		                <div class="form-group button-reg form-group-float">
		                    <button type="submit" id="tijiao" class="btn btn-primary col-lg-offset-4 light_blue">提　　交</button>
		                    <!-- <button id="chongzhi" class="btn btn-default" type="reset" value="Reset" name="reset">重　　置</button> -->
		                </div>
		            </form>
    			
    				<!-- <div class="div-s-2">需求职位：<?php echo $job_data['position'];?></div>
    				<div class="div-s-2">薪资范围：<?php echo $salary;?></div>
    				<div class="div-s-2">工作地点：<?php echo $job_data['place'];?></div>
    				<div class="div-s-2">工作经验：<?php echo $job_data['exp'];?></div>
    				<div class="div-s-2">工作性质：<?php echo $job_data['propt'];?></div>
    				<div class="div-s-2">学历要求：<?php echo $job_data['edu'];?></div>
    				<div class="div-n-1">
    					<p>详细描述：</p>
    					<p><?php echo $job_data['descrp'];?></p>
    				</div> -->
    				<?php 
    				if (isset($_GET['job_id'])) {
    					echo "<span><a href='ver_job_rel_ok.php?id=".$id."'>审查通过</a></span>";
    				} 
    				if (isset($_GET['modify_id'])) {
    					echo "<span><a href='ver_job_mod_ok.php?id=".$id."'>审查通过</a></span>";
    				}
    				?>
    			</div>
    	</div>
    </div>
    </div>
   <?php
	require("../oj-footer.php");
	?>
  </body>
</html>