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

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>       
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
        <div class="div-login div-reg">
            <h1 class="text-center">完善信息</h1>
            <br>    
            <form action="verify_sub.php" method="post" class="form-horizontal col-lg-8 col-lg-offset-2" id="form">
                <div class="form-group" style="display: none">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">verify_code</label>
                    <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="50" value="<?php echo $vrfcode?>" name="verify_code" id="verify_code"></div>
                    <label for="" class="col-lg-4 col-lg-4-reg"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">企业名称</label>
                     <div class="col-lg-5 col-lg-5-reg"><input type="text" name="compname" id="compname" class="form-control" value="<?php echo $compname?>"></div>
                     <label for="" class="col-lg-4 col-lg-4-reg" id="compname_xx"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">联系电话</label>
                    <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="30" placeholder="必填　座机请加上区号" name="phone" id="phone"></div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="phone_xx"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">公司地址</label>
                    <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="50" placeholder="必填　具体至区县即可" name="address" id="address"></div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="address_xx"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">官网地址</label>
                    <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="30" name="website" id="website"></div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="website_xx"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">所属行业</label>
                    <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="30" placeholder="必填" name="industry" id="industry"></div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="industry_xx"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">发展阶段</label>
                    <div class="col-lg-5 col-lg-5-reg">
                    <select class="form-control" name="stage" id="stage">
                        <option value="0" selected="">请选择</option>
                        <option value="1">初创新星</option>
                        <option value="2">正在成长</option>
                        <option value="3">成熟发展</option>
                        <option value="4">现已上市</option>
                    </select>
                    </div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="stage_xx"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">企业规模</label>
                    <div class="col-lg-5 col-lg-5-reg">
                    <select class="form-control" name="size" id="size">
                        <option value="0" selected="">请选择</option>
                        <option value="1">15人以下</option>
                        <option value="2">15人-50人</option>
                        <option value="3">50人-150人</option>
                        <option value="4">150人-500人</option>
                        <option value="5">500人-1500人</option>
                        <option value="6">1500人以上</option>
                    </select>
                    </div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="size_xx"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">登录邮箱</label>
                    <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" name="email" id="email"  value="<?php echo $loginemail?>" readonly="readonly"></div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="email_xx"></label>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">登录密码</label>
                    <div class="col-lg-5 col-lg-5-reg"><input type="password" class="form-control" placeholder="必填　6字以上" name="password" id="pswd" maxlength="20"></div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="pswd_xx"></label>
                </div>
                 <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">重复密码</label>
                    <div class="col-lg-5 col-lg-5-reg"><input type="password" class="form-control" placeholder="必填" name="rptpassword" id="rpswd" maxlength="20"></div>
                    <label for="" class="col-lg-4 col-lg-4-reg" id="rpswd_xx"></label>
                </div>
                <?php if($OJ_VCODE){ ?>
                <div class="form-group">
                    <label for="" class="col-lg-3 col-lg-3-reg control-label">验 证 码</label>
                    <div class="col-lg-3 vcode-reg"><input type="text" class="form-control" id="vcode" name="vcode" maxlength="4"></div>
                    <img alt="换一张" id="img_vcode" src="vcode.php" onclick="this.src='vcode.php?+'+Math.random()" class="col-lg-2" height=30>
                </div>
                <?php }?>
                <div class="form-group button-reg">
                    <button type="button" id="tijiao" class="btn btn-primary col-lg-offset-4 light_blue">提　　交</button>
                    <button id="chongzhi" class="btn btn-default" type="reset" value="Reset" name="reset">重　　置</button>
                </div>
            </form>
            </div>
        <br>
    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php");?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>        
   <script src="template/<?php echo $OJ_TEMPLATE;?>/js/verify_sub.js"></script>
  </body>
</html>