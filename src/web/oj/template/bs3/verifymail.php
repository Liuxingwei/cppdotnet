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


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- <div class="container"> -->
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
     <div class="container" id="body">
      <h1 class="text-center">邮箱验证</h1>
<form action="verifymail.php" method="post" class="form-horizontal col-lg-6 col-lg-offset-2">
    <div class="form-group">
          <label for="" class="col-lg-5 control-label">邮箱</label>
          <div class="col-lg-7"><input type="text" name="mail" id="mail" class="form-control" value="<?php  echo isset($mail)?$mail:htmlentities($user_mail,ENT_QUOTES,"UTF-8")?>" placeholder="请输入您的邮箱地址" maxlength="90">
            <button type="button" onclick="getCCode()" id="getCheckCode" class="btn  btn-warning" style="position:absolute;top:0px;left:67%;">获得验证码</button>
          </div>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-5 control-label">校验码</label>
          <div class="col-lg-7"><input type="text" class="form-control" name="ckcode" maxlength="16"></div>
    </div>
    <div class="form-group">
          <button class="btn btn-primary col-lg-offset-6 light_blue" type="submit">保存</button>
    </div>
    </form>     
     </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
 <script src="template/<?php echo $OJ_TEMPLATE;?>/js/verifymail.js"></script>
  </body>
</html>
