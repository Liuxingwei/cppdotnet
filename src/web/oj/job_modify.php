<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');

    if(isset($_SESSION['user_id'])){
        $view_errors="无权操作！";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    if(!isset($_SESSION['user_cpn'])){
        $view_errors="企业用户请<a href=loginpage_cpn.php>登录</a>后再进行修改操作!";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }

	$view_title= "编辑招聘信息 - C语言网";

    $id=$_GET['id'];
    $sql="SELECT `cpnuser`,`email`,`compname`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`exp`,`edu`,`descrp` FROM `job_list` WHERE `id`='".$id."'";
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    $row=mysqli_fetch_object($result);
        $cpnuser=$row->cpnuser;
        $email=$row->email;
        $compname=$row->compname;
        $position=$row->position;
        $place=$row->place;
        $propt=$row->propt;
        $salary=$row->salary;
        if ($salary=='2') {
            $salary_min_view=$row->salary_min*0.001;
            $salary_max_view=$row->salary_max*0.001;
        }
        else {
            $salary_min_view="";
            $salary_max_view="";
        }
        $exp=$row->exp;
        $edu=$row->edu;
        $descrp=$row->descrp;
    
    mysqli_free_result($result);

    if($_SESSION['user_cpn'] != $cpnuser){
        $view_errors="无权操作!";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
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
    <style type="text/css">
        form.job_release {
            margin: 0px;
            width: 100%;
        }
        .div-form {
            width: 80%;
            height: 500px;
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
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

            <div class="div-form">
            <!-- <ul class="tabs">
            <li>
            <input type="radio" name="tabs" id="tab1" checked />
            <label class="label-tab" for="tab1"><h1 class="text-center">用户注册</h1></label>
                <div id="tab-content1" class="tab-content"> -->
                <h1 class="text-center">编辑招聘信息</h1>
                <br>
                <form action="job_release_post.php?id=<?php echo $id; ?>" method="post" class="form-horizontal col-lg-8 col-lg-offset-2 job_release" id="form">
                    <div class="div-float">
                        <div class="form-group form-group-float">
                            <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">需求职位</label>
                             <div class="col-lg-8 col-lg-5-reg"><input type="text" name="position" class="form-control" placeholder="15字以下" maxlength="30" value="<?php echo $position?>"></div>
                             <label for="" class="col-lg-4 col-lg-4-reg" id="position_xx"></label>
                        </div>
                        <div class="form-group form-group-float">
                            <label class="label_text col-lg-3 col-lg-3-reg control-label">工作地点</label>
                            <div class="col-lg-8 col-lg-5-reg"><input type="text" class="form-control" name="place" placeholder="所在城市" maxlength="10" value="<?php echo $place?>"></div>
                            <label for="" class="col-lg-4 col-lg-4-reg" id="place_xx"></label>
                        </div>
                        <div class="form-group form-group-float">
                            <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">工作性质</label>
                            <div class="col-lg-8 col-lg-5-reg">
                            <select class="form-control" name="propt" id="propt">
                                <option value="0" <?php if ($propt=="全职") echo "selected"?>>全职</option>
                                <option value="1" <?php if ($propt=="兼职") echo "selected"?>>兼职</option>
                                <option value="2" <?php if ($propt=="实习") echo "selected"?>>实习</option>
                            </select>
                            </div>
                            <label for="" class="col-lg-4 col-lg-4-reg" id="propt_xx"></label>
                        </div>
                        <div class="form-group form-group-float">
                            <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">工作经验</label>
                            <div class="col-lg-8 col-lg-5-reg">
                            <select class="form-control" name="exp" id="exp">
                                <option value="0" <?php if ($exp=="不限") echo "selected"?>>不限</option>
                                <option value="1" <?php if ($exp=="应届生") echo "selected"?>>应届生</option>
                                <option value="2" <?php if ($exp=="1年以下") echo "selected"?>>1年以下</option>
                                <option value="3" <?php if ($exp=="1-3年") echo "selected"?>>1-3年</option>
                                <option value="4" <?php if ($exp=="3年-5年") echo "selected"?>>3年-5年</option>
                                <option value="5" <?php if ($exp=="5年以上") echo "selected"?>>5年以上</option>
                            </select>
                            </div>
                            <label for="" class="col-lg-4 col-lg-4-reg" id="exp_xx"></label>
                        </div>
                        <div class="form-group form-group-float">
                            <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">学历要求</label>
                            <div class="col-lg-8 col-lg-5-reg">
                            <select class="form-control" name="edu" id="edu">
                                <option value="0" <?php if ($edu=="不限") echo "selected"?>>不限</option>
                                <option value="1" <?php if ($edu=="专科") echo "selected"?>>专科</option>
                                <option value="2" <?php if ($edu=="本科") echo "selected"?>>本科</option>
                                <option value="3" <?php if ($edu=="硕士") echo "selected"?>>硕士</option>
                                <option value="4" <?php if ($edu=="博士") echo "selected"?>>博士</option>
                            </select>
                            </div>
                            <label for="" class="col-lg-4 col-lg-4-reg" id="edu_xx"></label>
                        </div>
                    </div>
                    <div class="form-group form-group-large" style="clear: both;">
                        <label class="label_text col-lg-3 col-lg-3-reg control-label">接收邮箱</label>
                        <div class="col-lg-9 col-lg-5-reg"><input type="text" class="form-control" name="email" value="<?php echo $email?>" placeholder="用于接收用户简历，请确保邮箱真实有效（不在招聘信息中显示）。"></div>
                        <!-- <label for="" class="col-lg-4 col-lg-4-reg" id="place_xx"></label> -->
                    </div>
                    <div class="form-group form-group-large form-inline">
                        <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">薪资范围</label>
                        <div class="col-lg-3 col-lg-5-reg">
                            <label class="radio-inline">
                                <input type="radio" name="salary_radio" id="salary_radio1" value="1" <?php if ($salary!='2') echo "checked='checked'";?>> 面议
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="salary_radio" id="salary_radio2" value="2" <?php if ($salary=='2') echo "checked='checked'";?>> 指定
                            </label>
                        </div>
                        <div class="col-lg-7 col-lg-5-reg">
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
                          <div class="col-lg-9"><textarea class="form-control" rows="4" name="descrp" placeholder="1000字以下" maxlength="1500"><?php echo $descrp?></textarea></div>
                    </div>
                    <?php if($OJ_VCODE){ ?>
                    <div class="form-group form-group-float">
                        <label for="" class="label_text col-lg-3 col-lg-3-reg control-label">验 证 码</label>
                        <div class="col-lg-5 vcode-reg"><input type="text" class="form-control" id="vcode" name="vcode" maxlength="4"></div>
                        <img alt="换一张" id="img_vcode" src="vcode.php" onclick="this.src='vcode.php?+'+Math.random()" class="col-lg-3" height=30>
                    </div>
                    <?php }?>
                    <div class="form-group button-reg form-group-float">
                        <button type="button" id="tijiao" class="btn btn-primary col-lg-offset-4 light_blue">提　　交</button>
                        <button id="chongzhi" class="btn btn-default" type="reset" value="Reset" name="reset">重　　置</button>
                    </div>
                </form>
            </div>

            </div>
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
   <script type="text/javascript">
        $(function(){
            if ($("#salary_radio1").attr("checked")=="checked") {
                $(".salary_int").attr("readonly",true);
            }
            $("#salary_radio1").click(function(){
                $(".salary_int").attr("readonly",true);
            });
            $("#salary_radio2").click(function(){
                $(".salary_int").attr("readonly",false);
            });
        });
   </script>
  </body>
</html>