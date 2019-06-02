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
        echo "<link rel='stylesheet' href='template/$OJ_TEMPLATE/css/drag.css?v=201811231757'>";
    ?>	    

    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="wrap" style="background-image: url(/oj/template/bs3/img/simple_bg.jpg);">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
        <div class="div-login div-reg">
        <!-- <ul class="tabs">
        <li>
        <input type="radio" name="tabs" id="tab1" checked />
        <label class="label-tab" for="tab1"><h1 class="text-center">用户注册</h1></label>
            <div id="tab-content1" class="tab-content"> -->
            <div class="div_loginhead">
                <a href="loginpage.php"><label class="login_h1 login_h1_1 border2_r text-center">程序员登录</label></a><label class="login_h1 login_h1_2 border0_l text-center">程序员注册</label>
            </div>
            <div class="div_loginform">
                <form action="register.php" method="post" class="form-horizontal col-lg-8 col-lg-offset-2" id="form">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">昵 　 称</label>
                         <div class="col-lg-5 col-lg-5-reg"><input type="text" name="nick" id="nick" class="form-control" placeholder="10字以下" maxlength="10"></div>
                         <label for="" class="col-lg-4 col-lg-4-reg" id="nick_xx"></label>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 col-lg-3-reg control-label">用 户 名</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" placeholder="3到15字,必填" name="user_id" id="user_id" maxlength="15"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="user_id_xx"></label>
                    </div>
                    <!-- <div class="form-group">
                        <label for="" class="col-lg-5 col-lg-5-reg control-label">签名</label>
                         <div class="col-lg-7"><input type="text" name="user_sign" class="form-control" placeholder="30字以下" size="20"></div>
                    </div> -->
                    <div class="form-group">
                         <label for="" class="col-lg-3 col-lg-3-reg control-label">密 　 码</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="password" class="form-control" placeholder="6字以上,必填" name="password" id="pswd" maxlength="20"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="pswd_xx"></label>
                    </div>
                     <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">重复密码</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="password" class="form-control" placeholder="必填" name="rptpassword" id="rpswd" maxlength="20"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="rpswd_xx"></label>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">学 　 校</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" placeholder="20字以下" maxlength="20" name="school" id="school"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="school_xx"></label>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">邮 　 箱</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" placeholder="30字以下" name="email" id="email" maxlength="30"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="email_xx"></label>
                    </div>
                    <div class="form-group">
                        <div id="mpanel5"></div>
                    </div>
                    <?php if($OJ_VCODE){ ?>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">验 证 码</label>
                        <div class="col-lg-3 vcode-reg"><input type="text" class="form-control" id="vcode" name="vcode" maxlength="4"></div>
                        <img alt="换一张" id="img_vcode" src="vcode.php" onclick="this.src='vcode.php?+'+Math.random()" class="col-lg-2" height=30>
                    </div>
                    <?php }?>
                    <div class="form-group button-reg">
                        <button type="button" id="tijiao" class="btn btn-primary col-lg-offset-4 light_blue">注　　册</button>
                        <button id="chongzhi" class="btn btn-default" type="reset" value="Reset" name="reset">重　　置</button>
                    </div>
                </form>
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
   <script src="template/<?php echo $OJ_TEMPLATE;?>/js/registerpage2.js?v=201811231757"></script>
   <script src="template/<?php echo $OJ_TEMPLATE;?>/js/drag.js?v=201811231757"></script>
   <script type="text/javascript">
        
    </script>
  </body>
</html>
