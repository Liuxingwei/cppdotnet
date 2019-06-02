<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title; ?></title>  
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
    <div class="wrap" style="background-image: url(/oj/template/bs3/img/simple_bg.jpg);">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">

    <div class="div-login">
      <div class="div_loginhead">
        <label class="login_h1 login_h1_2 border0_r text-center">程序员登录</label><a href="registerpage.php"><label class="login_h1 login_h1_1 border2_l text-center">程序员注册</label></a>
      </div>
      <div class="div_loginform">
        <div class="div_loginform_login">
        <form action="login.php" method="post" role="form" class="form-horizontal col-lg-6 col-lg-offset-2" id="form">
        	<div class="form-group">
        	<!-- <label class="col-sm-4 control-label">用户名</label> -->
          <div class="col-sm-8 col-sm-8-login"><input name="user_id" class="form-control" placeholder="用户名" type="text"></div>
          </div>
          <br>
        	<div class="form-group">
        	<!-- <label class="col-sm-4 control-label"><?php echo $MSG_PASSWORD?></label> -->
          <div class="col-sm-8 col-sm-8-login"><input name="password" class="form-control" onkeydown="input_text_submit(event)" placeholder="<?php echo $MSG_PASSWORD?>" type="password"></div>						
          </div>
          <br>
        <?php if($OJ_VCODE){?>

        	<div class="form-group">
        	<!-- <label class="col-sm-4 control-label"><?php echo $MSG_VCODE?></label> -->
          <div class="col-sm-4 input-login-vcode"><input name="vcode" id="vcode" class="form-control" placeholder="<?php echo $MSG_VCODE?>" onkeydown="input_text_submit(event)" type="text" maxlength=4></div>
          <div class="col-sm-4 img-login-vcode"><img alt="click to change" src="vcode.php" id="img_vcode" onclick="this.src='vcode.php?'+Math.random()" height="30px"></div>						
          </div>
          
        <?php }?>
        	<div class="form-group">
        	<div class="btn button-login">
        	<button type="button" id="tijiao" class="btn btn-default btn-primary btn-block">登录</button>
        	</div>
        	<!-- <div class="col-sm-4 a-forget">
          <a class="btn btn-link" href="lostpassword.php">忘记密码</a>
          <span style="text-align: right;">|</span>
          <a class="btn btn-link" href="registerpage_cpn.php">用户注册</a>
          </div> -->
        	</div>
        </form>
        </div>
      </div>
    </div>

    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/loginpage.js"></script>
  </body>
</html>
