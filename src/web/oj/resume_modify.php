<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');

    if(!isset($_SESSION['user_id'])){
        $view_errors="请<a href=loginpage.php>登录</a>后再编辑简历信息!";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }

    $user_id=$_SESSION['user_id'];
    $view_title= "编辑简历 - C语言网";

  $sql="SELECT `name`,`age`,`sex`,`email`,`birth`,`address`,`phone`,`school`,`edu`,`gra`,`prize`,`skill`,`lang`,`jobs`,`descrp` FROM `resume` WHERE `user_id`='".$user_id."'";
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
    <?php include("template/$OJ_TEMPLATE/css.php");
        echo "<link rel='stylesheet' href='template/$OJ_TEMPLATE/css/login.css'>";
    ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <style type="text/css">
        form.resume {
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
        .form-group-float label {
            width: 100px;
        }
        .form-group-large label {
            width: 100px;
        }
        .col-lg-9 {
          width: 78%;
        }
  </style>
  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
        <div class="">
        <!-- <ul class="tabs">
        <li>
        <input type="radio" name="tabs" id="tab1" checked />
        <label class="label-tab" for="tab1"><h1 class="text-center">用户注册</h1></label>
            <div id="tab-content1" class="tab-content"> -->
            <h1 class="text-center">编辑简历信息</h1>
            <br>
            <form action="resume_modify_post.php" method="post" class="form-horizontal col-lg-8 col-lg-offset-2 resume" id="form" enctype="multipart/form-data">
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">姓名</label>
                     <div class="col-lg-8 col-lg-5-reg"><input type="text" name="name" class="form-control" maxlength="10" value="<?php echo $name;?>"></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="name_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label class="col-lg-3 col-lg-3-reg control-label">年龄</label>
                    <div class="col-lg-8 col-lg-5-reg"><input type="text" class="form-control" name="age" maxlength="10" value="<?php echo $age;?>"></div>
                    <!--<label for="" class="col-lg-4 col-lg-4-reg" id="age_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">性别</label>
                     <div class="col-lg-8 col-lg-5-reg"><input type="text" name="sex" class="form-control" maxlength="10" value="<?php echo $sex;?>"></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="sex_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">出生日期</label>
                     <div class="col-lg-8 col-lg-5-reg"><input type="text" name="birth" class="form-control" maxlength="30" value="<?php echo $birth;?>"></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="sex_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">现所在地</label>
                     <div class="col-lg-8 col-lg-5-reg"><input type="text" name="address" class="form-control" maxlength="100" value="<?php echo $address;?>"></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="sex_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label class="col-lg-3 col-lg-3-reg control-label">邮箱</label>
                    <div class="col-lg-8 col-lg-5-reg"><input type="text" class="form-control" name="email" maxlength="30" value="<?php echo $email;?>"></div>
                    <!--<label for="" class="col-lg-4 col-lg-4-reg" id="email_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">电话</label>
                     <div class="col-lg-8 col-lg-5-reg"><input type="text" name="phone" class="form-control" maxlength="30" value="<?php echo $phone;?>"></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="phone_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">毕业学院</label>
                     <div class="col-lg-8 col-lg-5-reg"><input type="text" name="school" class="form-control" maxlength="100" value="<?php echo $school;?>"></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="school_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">学历学位</label>
                     <div class="col-lg-8 col-lg-5-reg"><input type="text" name="edu" class="form-control" maxlength="30" value="<?php echo $edu;?>"></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="edu_xx"></label>-->
                </div>
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">专业</label>
                     <div class="col-lg-8 col-lg-5-reg"><input type="text" name="gra" class="form-control" maxlength="30" value="<?php echo $gra;?>"></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="gra_xx"></label>-->
                </div>
                <div class="form-group form-group-large">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">荣誉奖励</label>
                     <div class="col-lg-9 col-lg-5-reg"><textarea rows="4" name="prize" class="form-control" maxlength="300"><?php echo $prize;?></textarea></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="prize_xx"></label>-->
                </div>
                <div class="form-group form-group-large">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">职业技能</label>
                     <div class="col-lg-9 col-lg-5-reg"><textarea rows="4" name="skill" class="form-control" maxlength="300"><?php echo $skill;?></textarea></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="skill_xx"></label>-->
                </div>
                <div class="form-group form-group-large">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">外语掌握</label>
                     <div class="col-lg-9 col-lg-5-reg"><textarea rows="4" name="lang" class="form-control" maxlength="300"><?php echo $lang;?></textarea></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="skill_xx"></label>-->
                </div>
                <div class="form-group form-group-large">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">工作经历</label>
                     <div class="col-lg-9 col-lg-5-reg"><textarea rows="4" name="jobs" class="form-control" maxlength="300"><?php echo $jobs;?></textarea></div>
                     <!--<label for="" class="col-lg-4 col-lg-4-reg" id="jobs_xx"></label>-->
                </div>
                <div class="form-group form-group-large">
                      <label for="" class="col-lg-3 control-label">自我评价</label>
                      <div class="col-lg-9"><textarea class="form-control" rows="4" name="descrp" placeholder="200字以下" maxlength="300"><?php echo $descrp;?></textarea></div>
                </div>
                <?php if($OJ_VCODE){ ?>
                <div class="form-group form-group-float">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">验 证 码</label>
                    <div class="col-lg-5 vcode-reg"><input type="text" class="form-control" id="vcode" name="vcode" maxlength="4"></div>
                    <img alt="换一张" id="img_vcode" src="vcode.php" onclick="this.src='vcode.php?+'+Math.random()" class="col-lg-3" height=30>
                </div>
                <?php }?>
                <div class="form-group form-group-float button-reg">
                    <button type="button" id="tijiao" class="btn btn-primary col-lg-offset-4 light_blue">提　　交</button>
                    <button id="chongzhi" class="btn btn-default" type="reset" value="Reset" name="reset">重　　置</button>
                </div>
            </form>
        </div>
        <br>
    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
   <script src="template/<?php echo $OJ_TEMPLATE;?>/js/job_release.js"></script>
  </body>
</html>